<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Localization\Loc;

$arTemplateParameters = array(
	"GOOGLE_PLACE_ID" => Array(
		"NAME" => Loc::GetMessage("GOOGLE_PLACE_ID"),
		"TYPE" => "STRING",
		"DEFAULT" => ""
	),
	"GOOGLE_PLACE_API_KEY" => Array(
		"NAME" => Loc::GetMessage("GOOGLE_PLACE_API_KEY"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"CACHE_TIME" => Array(
		"DEFAULT"=>3600
	),
);
?>
