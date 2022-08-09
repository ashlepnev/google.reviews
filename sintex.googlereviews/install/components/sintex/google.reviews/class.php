<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Error;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\SystemException;
use \Bitrix\Main\Web\HttpClient;

Loc::loadMessages(__FILE__);

class GoogleReviews extends CBitrixComponent
{
	public function onPrepareComponentParams($arParams)
    {
        if(!isset($arParams["CACHE_TIME"]))
            $arParams["CACHE_TIME"] = 3600;
		
		if (!isset($arParams["GOOGLE_PLACE_ID"]) || empty($arParams["GOOGLE_PLACE_ID"]))
            ShowError(Loc::getMessage('SINTEX_GOOGLE_REVIEWS_EMPTY_GOOGLE_PLACE_ID'));
		
		if (!isset($arParams["GOOGLE_PLACE_API_KEY"]) || empty($arParams["GOOGLE_PLACE_API_KEY"]))
            ShowError(Loc::getMessage('SINTEX_GOOGLE_REVIEWS_EMPTY_GOOGLE_MAPS_API_KEY'));

        return $arParams;
    }

	protected function fetchReviews()
	{
		
		$url = "https://maps.googleapis.com/maps/api/place/details/json?placeid={$this->arParams["GOOGLE_PLACE_ID"]}&language=ru&key={$this->arParams['GOOGLE_PLACE_API_KEY']}";
		
		$httpClient = new HttpClient();
		$httpClient->setHeader('Content-Type', 'application/json', true);
		$httpClient->query(HttpClient::HTTP_GET, $url, $entityBody = null);
		
		$responseJSON = $httpClient->getResult();
		$response = json_decode($responseJSON, true);
		
		AddMessage2Log('$response = '.print_r($response, true),'');
		
		if ($response['status'] === 'OK')
		{
			return [
				'RATING' => $response['result']['rating'],
				'REVIEWS' => $response['result']['reviews'],
				'TOTAL_REVIEWS' => $response['result']['user_ratings_total'],
				'NAME' => $response['result']['name'],
				'URL' => $response['result']['url']
			];
		}
		
		throw new \Bitrix\Main\SystemException(Loc::getMessage('SINTEX_GOOGLE_REVIEWS_ERROR'));

	}
	
	protected function prepareResult()
	{
		$result = $this->fetchReviews();
		
		$reviewWordForms = [
			Loc::getMessage('SINTEX_GOOGLE_REVIEWS_WORD_REVIEW_1'),
			Loc::getMessage('SINTEX_GOOGLE_REVIEWS_WORD_REVIEW_2'),
			Loc::getMessage('SINTEX_GOOGLE_REVIEWS_WORD_REVIEW_3')
		];
		
		$reviewTotal = $result['TOTAL_REVIEWS'];
		$totalReviewsText = $this->plural($reviewWordForms, $reviewTotal);
		$result['TOTAL_REVIEWS'] = $reviewTotal . $totalReviewsText;
		
		return $result;
	}
	
	protected function plural($endings, $number)
	{
		$cases = [2, 0, 1, 1, 1, 2];
		$n = $number;
		return sprintf($endings[ ($n%100>4 && $n%100<20) ? 2 : $cases[min($n%10, 5)] ], $n);
	}

	public function executeComponent()
	{
		try
		{
			if ($this->StartResultCache())
			{
				$this->arResult = $this->prepareResult();
				$this->includeComponentTemplate();
			}

		}
		catch (SystemException $e)
		{
			$this->AbortResultCache();
			ShowError($e->getMessage());
		}
	}
}