<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Localization\Loc;
$this->setFrameMode(true);

function starsRender($rating)
{
	$maxRating = 5;
	$filledStarsCount = floor($rating);
	$modulo = fmod($rating, 1);
	
	$starFilled = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z" fill="#fc0"/></svg>';
	$starHalf = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 5.173l2.335 4.817 5.305.732-3.861 3.71.942 5.27-4.721-2.524v-12.005zm0-4.586l-3.668 7.568-8.332 1.151 6.064 5.828-1.48 8.279 7.416-3.967 7.416 3.966-1.48-8.279 6.064-5.827-8.332-1.15-3.668-7.569z" fill="#fc0"/></svg>';
	$starEmpty = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 5.173l2.335 4.817 5.305.732-3.861 3.71.942 5.27-4.721-2.524-4.721 2.525.942-5.27-3.861-3.71 5.305-.733 2.335-4.817zm0-4.586l-3.668 7.568-8.332 1.151 6.064 5.828-1.48 8.279 7.416-3.967 7.416 3.966-1.48-8.279 6.064-5.827-8.332-1.15-3.668-7.569z" fill="#fc0"/></svg>';
	
	if ($modulo == 0)
	{
		$pseudoStar = 0;
	}
	elseif ($modulo > 0 && $modulo < 0.5) 
	{
		$moduloStar = $starEmpty;
		$pseudoStar = 1;
	} 
	else 
	{
		$moduloStar = $starHalf;
		$pseudoStar = 1;
	}
		
	for ($i = 0; $i < $filledStarsCount; $i++ )
	{
		$result .= $starFilled;
	}
	
	$result .= $moduloStar;
	
	for ($i = $pseudoStar; $i < ($maxRating - $filledStarsCount); $i++ )
	{
		$result .= $starEmpty;
	}
	
	return $result;
}
?>


<div class="sintex-google-reviews">
	<div class="sintex-google-reviews-header<?if (empty($arResult['REVIEWS'])) {?> sintex-google-reviews-header__empty<?}?>">
		<div class="sintex-google-reviews-header-top">
			<div class="sintex-google-reviews-header-name">
				<a href="<?=$arResult['URL']?>" target="_blank" rel="nofollow"><?=$arResult['NAME']?></a>
			</div>
			<div class="sintex-google-reviews-logo">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 85 36"><g fill="none"><path fill="#4285F4" d="M20.82 13.829h-9.86v2.926h6.994c-.346 4.104-3.76 5.854-6.983 5.854-4.123 0-7.72-3.244-7.72-7.791 0-4.43 3.43-7.841 7.73-7.841 3.317 0 5.272 2.115 5.272 2.115l2.05-2.122s-2.63-2.928-7.427-2.928C4.767 4.042.042 9.197.042 14.765c0 5.457 4.445 10.777 10.989 10.777 5.755 0 9.968-3.943 9.968-9.773 0-1.23-.178-1.94-.178-1.94z"></path><path fill="#EA4335" d="M28.9 11.71c-4.047 0-6.947 3.163-6.947 6.853 0 3.744 2.812 6.966 6.994 6.966 3.785 0 6.886-2.893 6.886-6.886 0-4.576-3.607-6.934-6.934-6.934zm.04 2.714c1.99 0 3.875 1.609 3.875 4.2 0 2.538-1.878 4.193-3.885 4.193-2.205 0-3.945-1.766-3.945-4.212 0-2.394 1.718-4.181 3.954-4.181z"></path><path fill="#FBBC05" d="M44.008 11.71c-4.047 0-6.947 3.163-6.947 6.853 0 3.744 2.813 6.966 6.994 6.966 3.785 0 6.886-2.893 6.886-6.886 0-4.576-3.607-6.934-6.933-6.934zm.04 2.714c1.99 0 3.876 1.609 3.876 4.2 0 2.538-1.878 4.193-3.885 4.193-2.206 0-3.945-1.766-3.945-4.212 0-2.394 1.718-4.181 3.954-4.181z"></path><path fill="#4285F4" d="M58.825 11.717c-3.714 0-6.633 3.253-6.633 6.904 0 4.16 3.384 6.918 6.57 6.918 1.969 0 3.016-.782 3.79-1.68v1.363c0 2.384-1.448 3.812-3.633 3.812-2.111 0-3.17-1.57-3.538-2.46l-2.655 1.11c.942 1.992 2.838 4.07 6.215 4.07 3.693 0 6.507-2.327 6.507-7.205V12.132h-2.897v1.17c-.89-.96-2.108-1.585-3.726-1.585zm.27 2.709c1.82 0 3.69 1.554 3.69 4.21 0 2.699-1.866 4.187-3.731 4.187-1.98 0-3.823-1.608-3.823-4.161 0-2.653 1.914-4.236 3.863-4.236z"></path><path fill="#EA4335" d="M78.33 11.7c-3.504 0-6.445 2.788-6.445 6.901 0 4.353 3.279 6.934 6.781 6.934 2.924 0 4.718-1.6 5.79-3.033l-2.39-1.589c-.62.962-1.656 1.902-3.385 1.902-1.942 0-2.836-1.064-3.389-2.094l9.266-3.845-.481-1.126c-.896-2.207-2.984-4.05-5.747-4.05zm.12 2.658c1.263 0 2.172.671 2.558 1.476L74.82 18.42c-.267-2.002 1.63-4.062 3.63-4.062z"></path><path fill="#34A853" d="M67.467 25.124h3.044V4.757h-3.044z"></path></g></svg>
				<?=Loc::getMessage("SINTEX_GOOGLE_REVIEWS_TEMPLATE_RATING");?>
			</div>
		</div>
		<div class="sintex-google-reviews-header-bottom">
			<div class="sintex-google-reviews-header-bottom-left">
				<?if (!empty($arResult['REVIEWS'])) {?>
				<div class="sintex-google-reviews-header-rating"><?=$arResult['RATING']?></div>
				<div class="sintex-google-reviews-header-rating-desc">
					<div class="sintex-google-reviews-header-rating-stars">
						<?=starsRender($arResult['RATING'])?>
					</div>
					<div class="sintex-google-reviews-header-rating-counter"><?=$arResult['TOTAL_REVIEWS']?></div>
				</div>
				<?} else {?>
				<?=Loc::getMessage("SINTEX_GOOGLE_REVIEWS_TEMPLATE_REVIEWS_EMPTY");?>
				<?}?>
			</div>
			<div class="sintex-google-reviews-header-bottom-right">
				<a href="<?=$arResult['URL']?>" target="_blank" class="sintex-google-reviews-add"><?=Loc::getMessage("SINTEX_GOOGLE_REVIEWS_TEMPLATE_REVIEWS_ADD");?></a>
			</div>
		</div>
	</div>
	<?if (!empty($arResult['REVIEWS'])) {?>
	<div class="sintex-google-reviews-list">
		<?foreach($arResult['REVIEWS'] as $review){?>
			<div class="sintex-google-review">
				<div class="sintex-google-review-header">
					<div class="sintex-google-review-avatar"><img height="40" width="40" src="<?=$review['profile_photo_url']?>"></div>
					<div class="sintex-google-review-name-rating">
						<div class="sintex-google-review-name"><?=$review['author_name']?></div>
						<div class="sintex-google-review-rating">
							<div class="sintex-google-reviews-header-rating-stars">
								<?=starsRender($review['rating'])?>
							</div>
						</div>
					</div>
				</div>
				<div class="sintex-google-review-text">
					<?=$review['text']?>
				</div>
			</div>
		<?}?>
	</div>
	<?}?>
</div>