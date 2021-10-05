<?global $arTheme, $USER;
$bHideOnNarrow = $arTheme['BIGBANNER_HIDEONNARROW']['VALUE'] === 'Y';?>


<style type="text/css">
.hhshghsi{
	background-color: #111111;
	padding: 75px 0 15px 0;
}
@media (max-width: 1259px){
	.hhshghsi{
	background-color: #111111;
	padding: 0;
}
.top_slider_wrapp .main-slider, .top_slider_wrapp .main-slider__item, .top_slider_wrapp .main-slider__item td, .top_slider_wrapp .main-slider__item tr {
    height: 907px;
}
.main-banner__price {
    position: relative;
    margin-top: 20px !important;
}
.main-banner__price-old {
    position: absolute;
    bottom: 100%;
    left: 0;
    color: #E16E03;
    font-size: 30px !important;
    font-family: "Open Sans", sans-serif;
    margin-bottom: 14px;
    text-decoration: line-through;
}
.main-banner__price-current {
    color: #fff;
    font-size: 50px !important;
    font-family: "Open Sans", sans-serif;
    font-weight: 700;
}
.main-banner__review svg {
    width: 67px !important;
    display: block;
    height: auto;
    margin-right: 15px;
}
.main-banner__review {
    font-size: 25px !important;
    font-family: "Open Sans", sans-serif;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    color: #fff;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
}
}
</style>

<div class="top_slider_wrapp hhshghsi maxwidth-banner view_<?=$arResult['BIGBANNER_MOBILE']?><?=($bHideOnNarrow ? ' hidden_narrow' : '')?>"
	style="">
	<?
	$arOptions = [
		// Disable preloading of all images
		'preloadImages' => false,
		// Enable lazy loading
		'lazy' => [
			'loadPrevNext' => true,
		],
		//enable hash navigation
  		// 'hashNavigation' =>  true,
		//   'loopFillGroupWithBlank' => true,
		'keyboard' => true,
		'init' => false,
		'countSlides' => count($arResult["ITEMS"][$arParams["BANNER_TYPE_THEME"]]["ITEMS"]),
		'type' => 'main_banner'
	];
	if ($arOptions['countSlides'] > 10) {
		$arOptions['pagination']['dynamicBullets'] = true;
		$arOptions['pagination']['dynamicMainBullets'] = 3;
	}
	if ($arOptions['countSlides'] > 1) {
		$arOptions['loop'] = true;
	}
	?>
	<div class="swiper-container main-slider navigation_on_hover navigation_offset" data-plugin-options='<?=json_encode($arOptions)?>'>
		<div class="swiper-wrapper main-slider__wrapper">
			<?$bBannerLight = $bShowH1 = false;?>
			<?$strTypeHitProp = \Bitrix\Main\Config\Option::get('aspro.max', 'ITEM_STICKER_CLASS_SOURCE', 'PROPERTY_VALUE');?>
			<?foreach($arResult["ITEMS"][$arParams["BANNER_TYPE_THEME"]]["ITEMS"] as $i => $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				$background = is_array($arItem["DETAIL_PICTURE"]) ? $arItem["DETAIL_PICTURE"]["SRC"] : $this->GetFolder()."/images/background.jpg";
				$target = $arItem["PROPERTIES"]["TARGETS"]["VALUE_XML_ID"];
				$arItem["NAME"] = strip_tags($arItem["~NAME"]);

				if(!$i && ($arItem["PROPERTIES"]["DARK_MENU_COLOR"]["VALUE"] != "Y"))
					$bBannerLight = true;

				// video options
				$videoSource = strlen($arItem['PROPERTIES']['VIDEO_SOURCE']['VALUE_XML_ID']) ? $arItem['PROPERTIES']['VIDEO_SOURCE']['VALUE_XML_ID'] : 'LINK';
				$videoSrc = $arItem['PROPERTIES']['VIDEO_SRC']['VALUE'];
				if($videoFileID = $arItem['PROPERTIES']['VIDEO']['VALUE']){
					$videoFileSrc = CFile::GetPath($videoFileID);
				}
				$videoPlayer = $videoPlayerSrc = '';
				if($bShowVideo = $arItem['PROPERTIES']['SHOW_VIDEO']['VALUE_XML_ID'] === 'YES' && ($videoSource == 'LINK' ? strlen($videoSrc) : strlen($videoFileSrc))){
					$colorSubstrates = ($arItem['PROPERTIES']['COLOR_SUBSTRATES']['VALUE_XML_ID'] ? $arItem['PROPERTIES']['COLOR_SUBSTRATES']['VALUE_XML_ID'] : '');
					$buttonVideoText = $arItem['PROPERTIES']['BUTTON_VIDEO_TEXT']['VALUE'];
					$bVideoLoop = $arItem['PROPERTIES']['VIDEO_LOOP']['VALUE_XML_ID'] === 'YES';
					$bVideoDisableSound = $arItem['PROPERTIES']['VIDEO_DISABLE_SOUND']['VALUE_XML_ID'] === 'YES';
					$bVideoAutoStart = $arItem['PROPERTIES']['VIDEO_AUTOSTART']['VALUE_XML_ID'] === 'YES';
					$bVideoCover = $arItem['PROPERTIES']['VIDEO_COVER']['VALUE_XML_ID'] === 'YES';
					$bVideoUnderText = $arItem['PROPERTIES']['VIDEO_UNDER_TEXT']['VALUE_XML_ID'] === 'YES';
					if(strlen($videoSrc) && $videoSource === 'LINK'){
						// videoSrc available values
						// YOTUBE:
						// https://youtu.be/WxUOLN933Ko
						// <iframe width="560" height="315" src="https://www.youtube.com/embed/WxUOLN933Ko" frameborder="0" allowfullscreen></iframe>
						// VIMEO:
						// https://vimeo.com/211336204
						// <iframe src="https://player.vimeo.com/video/211336204?title=0&byline=0&portrait=0" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
						// RUTUBE:
						// <iframe width="720" height="405" src="//rutube.ru/play/embed/10314281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowfullscreen></iframe>
						
						$videoPlayer = 'YOUTUBE';
						$videoSrc = htmlspecialchars_decode($videoSrc);
						if(strpos($videoSrc, 'iframe') !== false){
							$re = '/<iframe.*src=\"(.*)\".*><\/iframe>/isU';
							preg_match_all($re, $videoSrc, $arMatch);
							$videoSrc = $arMatch[1][0];
						}
						$videoPlayerSrc = $videoSrc;

						switch($videoSrc){
							case(($v = strpos($videoSrc, 'vimeo.com/')) !== false):
								$videoPlayer = 'VIMEO';
								if(strpos($videoSrc, 'player.vimeo.com/') === false){
									$videoPlayerSrc = str_replace('vimeo.com/', 'player.vimeo.com/', $videoPlayerSrc);
								}
								if(strpos($videoSrc, 'vimeo.com/video/') === false){
									$videoPlayerSrc = str_replace('vimeo.com/', 'vimeo.com/video/', $videoPlayerSrc);
								}
								break;
							case(($v = strpos($videoSrc, 'rutube.ru/')) !== false):
								$videoPlayer = 'RUTUBE';
								break;
							case(strpos($videoSrc, 'watch?') !== false && ($v = strpos($videoSrc, 'v=')) !== false):
								$videoPlayerSrc = 'https://www.youtube.com/embed/'.substr($videoSrc, $v + 2, 11);
								break;
							case(strpos($videoSrc, 'youtu.be/') !== false && $v = strpos($videoSrc, 'youtu.be/')):
								$videoPlayerSrc = 'https://www.youtube.com/embed/'.substr($videoSrc, $v + 9, 11);
								break;
							case(strpos($videoSrc, 'embed/') !== false && $v = strpos($videoSrc, 'embed/')):
								$videoPlayerSrc = 'https://www.youtube.com/embed/'.substr($videoSrc, $v + 6, 11);
								break;
						}

						$bVideoPlayerYoutube = $videoPlayer === 'YOUTUBE';
						$bVideoPlayerVimeo = $videoPlayer === 'VIMEO';
						$bVideoPlayerRutube = $videoPlayer === 'RUTUBE';

						if(strlen($videoPlayerSrc)){
							$videoPlayerSrc = trim($videoPlayerSrc.
								($bVideoPlayerYoutube ? '?autoplay=1&enablejsapi=1&controls=0&showinfo=0&rel=0&disablekb=1&iv_load_policy=3' :
								($bVideoPlayerVimeo ? '?autoplay=1&badge=0&byline=0&portrait=0&title=0' :
								($bVideoPlayerRutube ? '?quality=1&autoStart=0&sTitle=false&sAuthor=false&platform=someplatform' : '')))
							);
						}
					}
					else{
						$videoPlayer = 'HTML5';
						$videoPlayerSrc = $videoFileSrc;
					}
				}
				if ($bShowVideo && $videoPlayerSrc) {
					$templateData['HAS_VIDEO'] = true;
				}
				?>
				<div class="swiper-slide main-slider__item box swiper-lazy <?=($arItem["PROPERTIES"]["TEXTCOLOR"]["VALUE_XML_ID"] ? " ".$arItem["PROPERTIES"]["TEXTCOLOR"]["VALUE_XML_ID"] : "");?><?=($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] ? " ".$arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] : " left");?><?=($bShowVideo ? ' wvideo' : '');?>"
					data-nav_color="<?=($arItem["PROPERTIES"]["NAV_COLOR"]["VALUE_XML_ID"] ? $arItem["PROPERTIES"]["NAV_COLOR"]["VALUE_XML_ID"] : "");?>"
					data-text_color="<?=($arItem["PROPERTIES"]["DARK_MENU_COLOR"]["VALUE"] != "Y" ? "light" : "");?>"
					data-slide_index="<?=$i?>"
					<?=($bShowVideo ? ' data-video_source="'.$videoSource.'"' : '')?>
					<?=(strlen($videoPlayer) ? ' data-video_player="'.$videoPlayer.'"' : '')?>
					<?=(strlen($videoPlayerSrc) ? ' data-video_src="'.$videoPlayerSrc.'"' : '')?>
					<?=($bVideoAutoStart ? ' data-video_autoplay="1"' : '')?>
					<?=($bVideoDisableSound ? ' data-video_disable_sound="1"' : '')?>
					<?=($bVideoLoop ? ' data-video_loop="1"' : '')?>
					<?=($bVideoCover ? ' data-video_cover="1"' : '')?>					
					style="background-image: url('<?=\Aspro\Functions\CAsproMax::showBlankImg($background)?>') !important;"
					data-background="<?=$background;?>"
				>
					<div id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<?if($arItem["PROPERTIES"]["URL_STRING"]["VALUE"]):?>
							<a class="target" href="<?=$arItem["PROPERTIES"]["URL_STRING"]["VALUE"]?>" <?=(strlen($target) ? 'target="'.$target.'"' : '')?>></a>
						<?endif;?>
						<div class="wrapper_inner">	
							<? 
							$position = "0% 100%";
							if($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"])
							{
								if($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] == "left")
									$position = "100% 100%";
								elseif($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] == "right")
									$position = "0% 100%";
								else
									$position = "center center";									
							}
							?>
							<table>
								<tbody>
									
									<?if($arResult['BIGBANNER_MOBILE'] == 1) {
										$tabletImgSrc = ($arItem["PROPERTIES"]['TABLET_IMAGE']['VALUE'] ? CFile::GetPath($arItem["PROPERTIES"]['TABLET_IMAGE']['VALUE']) : $background);
									}?>
									<tr class="main_info swiper-lazy" style="background-image: url('<?=\Aspro\Functions\CAsproMax::showBlankImg($arResult['BIGBANNER_MOBILE'] == 1 ? $tabletImgSrc : $background)?>');" data-background="<?=($arResult['BIGBANNER_MOBILE'] == 1 ? $tabletImgSrc : $background)?>">
										<?if($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] != "image"):?>
											<?ob_start();?>
												<td class="text <?=$arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"];?>">
													<?if($arItem["PROPERTIES"]["LINK_ITEM"]["VALUE"]):?>
														<?
														$hitProp = (isset($arParams["HIT_PROP"]) ? $arParams["HIT_PROP"] : "HIT");
														$saleProp = (isset($arParams["SALE_PROP"]) ? $arParams["SALE_PROP"] : "SALE_TEXT");

														$arSelect = array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "PROPERTY_vote_count", "PROPERTY_rating", "PROPERTY_vote_sum", "CATALOG_TYPE", "PROPERTY_EXTENDED_REVIEWS_RAITING", "PROPERTY_EXTENDED_REVIEWS_COUNT");
														if($hitProp)
															$arSelect[] = "PROPERTY_".$hitProp;
														if($saleProp)
															$arSelect[] = "PROPERTY_".$saleProp;

														$arPricesID = array();
														if(!$arParams["PRICE_CODE_IDS"])
														{
															$dbPriceType = \CCatalogGroup::GetList(
																array("SORT" => "ASC"),
																array("NAME" => $arParams["PRICE_CODE"])
																);
															while($arPriceType = $dbPriceType->Fetch())
															{
																$arParams["PRICE_CODE_IDS"][] = array(
																	"ID" => $arPriceType["ID"]
																);
															}
														}
														if($arParams["PRICE_CODE_IDS"])
														{
															foreach($arParams["PRICE_CODE_IDS"] as $arPrices)
															{
																$arSelect[] = "CATALOG_GROUP_".$arPrices["ID"];
																$arPricesID[] = $arPrices["ID"];
															}
														}
														$arProduct = CMaxCache::CIBLockElement_GetList(array('CACHE' => array("MULTI" => "N", "TAG" => CMaxCache::GetIBlockCacheTag($arItem["PROPERTIES"]["LINK_ITEM"]["LINK_IBLOCK_ID"]))), array("IBLOCK_ID" => $arItem["PROPERTIES"]["LINK_ITEM"]["LINK_IBLOCK_ID"], "ACTIVE"=>"Y", "ACTIVE_DATE" => "Y", "ID" => $arItem["PROPERTIES"]["LINK_ITEM"]["VALUE"]), false, false, $arSelect);
														$arPriceList = \Aspro\Functions\CAsproMax::getPriceList($arProduct["ID"], $arPricesID, 1, true);
														
														?>






														<!--<div class="banner_title item_info">
															<?if((($hitProp && $arProduct['PROPERTY_'.$hitProp.'_VALUE']) || ($saleProp && $arProduct['PROPERTY_'.$saleProp.'_VALUE'])) && $arItem["PROPERTIES"]["SHOW_STICKERS"]["VALUE"] == "Y"):?>
																<div class="stickers">
																	<?if($saleProp && $arProduct['PROPERTY_'.$saleProp.'_VALUE']):?>
																		<div class="sticker_sale_text"><?=$arProduct['PROPERTY_'.$saleProp.'_VALUE']?></div>
																	<?endif;?>
																	<?if($hitProp && $arProduct['PROPERTY_'.$hitProp.'_VALUE']):?>
																		<?foreach((array)$arProduct['PROPERTY_'.$hitProp.'_VALUE'] as $key => $value):?>
																			<?
																			$enumID = ((is_array($arProduct['PROPERTY_'.$hitProp.'_ENUM_ID'])) ? $arProduct['PROPERTY_'.$hitProp.'_ENUM_ID'][$key] : $arProduct['PROPERTY_'.$hitProp.'_ENUM_ID']);
																			$arTmpEnum = CIBlockPropertyEnum::GetByID($enumID);?>
																			<div class="sticker_<?=($strTypeHitProp == "PROPERTY_VALUE" ? CUtil::translit($value, 'ru') : strtolower($arTmpEnum["XML_ID"]));?>"><?=$value?></div>
																		<?endforeach;?>
																	<?endif;?>
																</div>
															<?endif;?>

															<?if($arItem['PROPERTIES']['TITLE_H1']['VALUE'] == "Y" && !$bShowH1):?>
																
															<?else:?>
																
															<?endif;?>

																<?if($arProduct["DETAIL_PAGE_URL"]):?>
																	<a href="<?=$arProduct["DETAIL_PAGE_URL"]?>" <?=(strlen($target) ? 'target="'.$target.'"' : '')?>>
																<?endif;?>
																<?=$arProduct["NAME"];?>
																<?if($arProduct["DETAIL_PAGE_URL"]):?>
																	</a>
																<?endif;?>

															<?if($arItem['PROPERTIES']['TITLE_H1']['VALUE'] == "Y" && !$bShowH1):?>
																<?$bShowH1 = true;?>
																</h1>
															<?else:?>
																</span>
															<?endif;?>
															<?
															$bHasOffers = (isset($arProduct["CATALOG_TYPE"]) && $arProduct["CATALOG_TYPE"] == 3);

															if($bHasOffers)
															{
																$arSelect = array("ID", "IBLOCK_ID", "NAME", "CATALOG_QUANTITY");												
																$arOffers = CMaxCache::CIBLockElement_GetList(array('CACHE' => array("MULTI" => "Y", "TAG" => CMaxCache::GetIBlockCacheTag($arItem["PROPERTIES"]["LINK_ITEM"]["LINK_IBLOCK_ID"]))), array("PROPERTY_CML2_LINK" => $arProduct["ID"], "ACTIVE"=>"Y", "ACTIVE_DATE" => "Y"), false, false, $arSelect);
																$arProduct["OFFERS"] = $arOffers;
															}

															$arPrice = CCatalogProduct::GetOptimalPrice($arProduct["ID"], 1, $USER->GetUserGroupArray(), 'N', $arPriceList);
															$totalCount = CMax::GetTotalCount($arProduct, $arParams);
															$arQuantityData = CMax::GetQuantityArray($totalCount, array('ID' => $arProduct["ID"]), "N", (($arProduct["OFFERS"] || $arProduct['CATALOG_TYPE'] == CCatalogProduct::TYPE_SET || !$arResult['STORES_COUNT']) ? false : true) );
															$strMeasure = '';

															if($arProduct["CATALOG_MEASURE"])
															{
																$arMeasure = CCatalogMeasure::getList(array(), array("ID" => $arProduct["CATALOG_MEASURE"]), false, false, array())->GetNext();
																$strMeasure = $arMeasure["SYMBOL_RUS"];
															}?>

															<?if($arQuantityData["HTML"] || $arItem['PROPERTIES']['SHOW_RATING']['VALUE'] == "Y"):?>
															
																<div class="votes_block nstar">
																	<?if($arItem['PROPERTIES']['SHOW_RATING']['VALUE'] == "Y"):?>
																		<div class="ratings">
																			<?
																			if($arParams['REVIEWS_VIEW'] == 'EXTENDED'):?>
																				<?$message = $arProduct['PROPERTY_EXTENDED_REVIEWS_RAITING_VALUE'] ? GetMessage('VOTES_RESULT', array('#VALUE#' => $arProduct['PROPERTY_EXTENDED_REVIEWS_RAITING_VALUE'])) : GetMessage('VOTES_RESULT_NONE')?>
																				<div class="inner_rating" title="<?=$message?>">
																					<?for($i=1;$i<=5;$i++):?>
																						<div class="item-rating <?=$i<=$arProduct['PROPERTY_EXTENDED_REVIEWS_RAITING_VALUE'] ? 'filed' : ''?>"><?=CMax::showIconSvg("star", SITE_TEMPLATE_PATH."/images/svg/catalog/star_small.svg");?></div>
																					<?endfor;?>
																					
																	
																				</div>
																			<?else:?>
																				<?
																				if($arProduct["PROPERTY_VOTE_COUNT_VALUE"])
																					$display_rating = round($arProduct["PROPERTY_VOTE_SUM_VALUE"]/$arProduct["PROPERTY_VOTE_COUNT_VALUE"], 2);
																				else
																					$display_rating = 0;
																				?>
																				<div class="inner_rating">
																					<?for($i=1;$i<=5;$i++):?>
																						<div class="item-rating <?=(round($display_rating) >= $i ? "filed" : "");?>"><?=CMax::showIconSvg("star", SITE_TEMPLATE_PATH."/images/svg/star.svg");?></div>
																					<?endfor;?>
																				</div>
																			<?endif;?>
																		</div>
																	<?endif;?>
																	<div class="sa_block">
																		<?if($arQuantityData["HTML"]):?>
																			<?=$arQuantityData["HTML"];?>
																		<?endif;?>
																	</div>
																</div>
															<?endif;?>

															<?if($arItem['PROPERTIES']['SHOW_DATE_SALE']['VALUE'] == "Y"):?>
																<?\Aspro\Functions\CAsproMax::showDiscountCounter($totalCount, $arPrice["DISCOUNT"], $arQuantityData, $arProduct, $strMeasure);?>
															<?endif;?>

															<?if($arPrice["RESULT_PRICE"] && $arItem['PROPERTIES']['SHOW_PRICES']['VALUE'] == "Y"):?>
																<?
																$price = $arPrice["RESULT_PRICE"]["DISCOUNT_PRICE"];
																$arFormatPrice = $arPrice["RESULT_PRICE"];
																$arCurrencyParams = array();
																if($arParams["CONVERT_CURRENCY"] != "Y" && $arPrice["RESULT_PRICE"]["CURRENCY"] != $arPrice["PRICE"]["CURRENCY"])
																{
																	$price = roundEx(CCurrencyRates::ConvertCurrency($arPrice["RESULT_PRICE"]["DISCOUNT_PRICE"], $arPrice["RESULT_PRICE"]["CURRENCY"], $arPrice["PRICE"]["CURRENCY"]),CATALOG_VALUE_PRECISION);
																	$arFormatPrice = $arPrice["PRICE"];
																}
																if($arParams["CONVERT_CURRENCY"] == "Y" && $arParams["CURRENCY_ID"])
																{
																	$arCurrencyInfo = CCurrency::GetByID($arParams["CURRENCY_ID"]);
																	if (is_array($arCurrencyInfo) && !empty($arCurrencyInfo))
																	{
																		$arCurrencyParams["CURRENCY_ID"] = $arCurrencyInfo["CURRENCY"];
																		$price = CCurrencyRates::ConvertCurrency($arPrice["RESULT_PRICE"]["DISCOUNT_PRICE"], $arPrice["RESULT_PRICE"]["CURRENCY"], $arCurrencyParams["CURRENCY_ID"]);
																		$arFormatPrice["CURRENCY"] = $arCurrencyParams["CURRENCY_ID"];
																	}
																}
																?>
																<!--<div class="prices">
																	<span class="price font_lg">
																		<span class="values_wrapper"><?=($bHasOffers ? GetMessage("FROM")." " : "");?><?=\Aspro\Functions\CAsproMaxItem::getCurrentPrice($price, $arFormatPrice, false);?></span>
																		<?if($strMeasure):?><span class="price_measure">/<?=$strMeasure?></span><?endif;?>
																	</span>
																	<?if($arItem['PROPERTIES']['SHOW_OLD_PRICE']['VALUE'] == "Y" && ($arPrice["RESULT_PRICE"]["BASE_PRICE"] != $arPrice["RESULT_PRICE"]["DISCOUNT_PRICE"])):?>
																		<span class="price price_old font_sm">
																			<?if($arCurrencyParams)
																				$arPrice["RESULT_PRICE"]["BASE_PRICE"] = CCurrencyRates::ConvertCurrency($arPrice["RESULT_PRICE"]["BASE_PRICE"], $arPrice["RESULT_PRICE"]["CURRENCY"], $arCurrencyParams["CURRENCY_ID"])?>
																			<span class="values_wrapper"><?=($bHasOffers ? GetMessage("FROM")." " : "");?><?=\Aspro\Functions\CAsproMaxItem::getCurrentPrice($arPrice["RESULT_PRICE"]["BASE_PRICE"], $arFormatPrice, false);?></span>
																			<?if($strMeasure):?><span class="price_measure">/<?=$strMeasure?></span><?endif;?>
																		</span>
																	<?endif;?>
																</div>-->
																<!--<?if($arItem['PROPERTIES']['SHOW_DISCOUNT']['VALUE'] == "Y" && $arPrice["RESULT_PRICE"]["DISCOUNT"]):?>
																	<div class="sale_block">
																		<div class="sale-number rounded2 font_xxs">
																			<div class="value">-<span><?=$arPrice["RESULT_PRICE"]["PERCENT"]?></span>%</div>
																			<div class="inner-sale rounded1">
																				<span><?=GetMessage("CATALOG_ITEM_ECONOMY");?></span>
																				<span class="price">
																					<?if($arCurrencyParams)
																					$arPrice["RESULT_PRICE"]["DISCOUNT"] = CCurrencyRates::ConvertCurrency($arPrice["RESULT_PRICE"]["DISCOUNT"], $arPrice["RESULT_PRICE"]["CURRENCY"], $arCurrencyParams["CURRENCY_ID"])?>
																					<span class="values_wrapper"><?=\Aspro\Functions\CAsproMaxItem::getCurrentPrice($arPrice["RESULT_PRICE"]["DISCOUNT"], $arFormatPrice, false);?></span>
																				</span>
																			</div>
																		</div>
																	</div>
																<?endif;?>
															<?endif;?>
														</div>-->

														<div class="banner_buttons with_actions <?=$arProduct["CATALOG_TYPE"];?>">
															<a href="<?=$arProduct["DETAIL_PAGE_URL"]?>" class="<?=!empty($arItem["PROPERTIES"]["BUTTON1CLASS"]["VALUE"]) ? $arItem["PROPERTIES"]["BUTTON1CLASS"]["VALUE"] : "btn btn-default btn-lg"?>" <?=(strlen($target) ? 'target="'.$target.'"' : '')?>>
																<?=$arItem["PROPERTIES"]["BUTTON1TEXT"]["VALUE"]?>
															</a>
															<?if($arItem['PROPERTIES']['SHOW_BUTTONS']['VALUE'] == "Y"):?>
																<div class="wraps_buttons" data-id="<?=$arProduct["ID"];?>" data-iblockid="<?=$arProduct["IBLOCK_ID"];?>">
																	<?$arAllPrices = \CIBlockPriceTools::GetCatalogPrices(false, $arParams["PRICE_CODE"]);
																	$arProduct["CAN_BUY"] = CIBlockPriceTools::CanBuy($arProduct["IBLOCK_ID"], $arAllPrices, $arProduct);
																	?>
																	<?if($arPrice && $arProduct["CATALOG_TYPE"] == 1):?>
																		<?if($arProduct["CAN_BUY"]):?>
																			<div class="wrap colored_theme_hover_bg option-round  basket_item_add" data-title="<?=$arTheme["EXPRESSION_ADDTOBASKET_BUTTON_DEFAULT"]["VALUE"];?>" title="<?=$arTheme["EXPRESSION_ADDTOBASKET_BUTTON_DEFAULT"]["VALUE"];?>" data-href="<?=$arTheme["BASKET_PAGE_URL"]["VALUE"];?>" data-title2="<?=$arTheme["EXPRESSION_ADDEDTOBASKET_BUTTON_DEFAULT"]["VALUE"];?>">
																				<?=CMax::showIconSvg("basket ", SITE_TEMPLATE_PATH."/images/svg/basket.svg");?>
																				<?=CMax::showIconSvg("basket-added", SITE_TEMPLATE_PATH."/images/svg/inbasket.svg");?>
																			</div>
																		<?endif;?>
																		<div class="wrap colored_theme_hover_bg option-round  wish_item_add" data-title="<?=GetMessage("CATALOG_ITEM_DELAY");?>" title="<?=GetMessage("CATALOG_ITEM_DELAY");?>" data-title2="<?=GetMessage("CATALOG_ITEM_DELAYED");?>">
																			<?=CMax::showIconSvg("wish ", SITE_TEMPLATE_PATH."/images/svg/chosen.svg");?>
																		</div>
																	<?endif;?>
																	<?if($arTheme['CATALOG_COMPARE']['VALUE'] != 'N'):?>
																		<div class="wrap colored_theme_hover_bg option-round  compare_item_add" data-title="<?=GetMessage("CATALOG_ITEM_COMPARE");?>" title="<?=GetMessage("CATALOG_ITEM_COMPARE");?>" data-title2="<?=GetMessage("CATALOG_ITEM_COMPARED");?>">
																			<?=CMax::showIconSvg("compare ", SITE_TEMPLATE_PATH."/images/svg/compare.svg");?>
																		</div>
																	<?endif;?>																	
																</div>
															<?endif;?>	
								
														</div>
													<?else:?>
														<?
															$bShowButton1 = (strlen($arItem['PROPERTIES']['BUTTON1TEXT']['VALUE']) && strlen($arItem['PROPERTIES']['BUTTON1LINK']['VALUE']));
															$bShowButton2 = (strlen($arItem['PROPERTIES']['BUTTON2TEXT']['VALUE']) && strlen($arItem['PROPERTIES']['BUTTON2LINK']['VALUE']));
														?>

														<?if($arItem["PREVIEW_TEXT"]):?>
															<div class="banner_text"><?=$arItem["PREVIEW_TEXT"];?></div>
														<?endif;?>														
							
													<?endif;?>
												</td>
											<?$text = ob_get_clean();?>
										<?endif;?>
										<?ob_start();?>
											<?$bHasVideo = ($bShowVideo && !$bVideoAutoStart && $arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] == "image");?>
											<td class="img <?=($bHasVideo ? 'with_video' : '');?>">
												<?if($bHasVideo):?>
													<div class="video_block">
														<span class="play btn btn-video  <?=(strlen($arItem['PROPERTIES']['BUTTON_VIDEO_CLASS']['VALUE_XML_ID']) ? $arItem['PROPERTIES']['BUTTON_VIDEO_CLASS']['VALUE_XML_ID'] : 'btn-default')?>" title="<?=$buttonVideoText?>"></span>
													</div>
												<?elseif($arItem["PREVIEW_PICTURE"]):?>
													<?if(!empty($arItem["PROPERTIES"]["URL_STRING"]["VALUE"])):?>
														<a href="<?=$arItem["PROPERTIES"]["URL_STRING"]["VALUE"]?>" <?=(strlen($target) ? 'target="'.$target.'"' : '')?>>
													<?endif;?>
													<img class="plaxy swiper-lazy" data-src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" src="<?=\Aspro\Functions\CAsproMax::showBlankImg($arItem['PREVIEW_PICTURE']['SRC'])?>" alt="<?=($arItem['PREVIEW_PICTURE']['ALT'] ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($arItem['PREVIEW_PICTURE']['TITLE'] ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" />
													<?if(!empty($arItem["PROPERTIES"]["URL_STRING"]["VALUE"])):?>
														</a>
													<?endif;?>
												<?endif;?>									
											</td>
										<?$image = ob_get_clean();?>
										<? 
										if($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"]){
											if($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] == "left"){
												echo $text.$image;
											}
											elseif($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] == "right"){
												echo $image.$text;
											}
											elseif($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] == "center"){
												echo $text;
											}
											elseif($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] == "image"){
												echo $image;
											}
										}
										else{
											echo $text.$image;
										}
										?>
									</tr>
								<?if($arResult['BIGBANNER_MOBILE'] == 1):?>
									<tr class="adaptive_info">
										<?if($arResult['BIGBANNER_MOBILE'] == 1):?>
											<td class="tablet_text"<?=(strlen($text) && strlen($image) ? ' colspan="2"' : '')?>>
												<?ob_start();?>
													<?if($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] != "image"):?>
														<?if($arItem["PROPERTIES"]["LINK_ITEM"]["VALUE"]):?>
															<?
															$hitProp = (isset($arParams["HIT_PROP"]) ? $arParams["HIT_PROP"] : "HIT");
															$saleProp = (isset($arParams["SALE_PROP"]) ? $arParams["SALE_PROP"] : "SALE_TEXT");

															$arSelect = array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "PROPERTY_vote_count", "PROPERTY_rating", "PROPERTY_vote_sum", "CATALOG_TYPE", "PROPERTY_EXTENDED_REVIEWS_RAITING", "PROPERTY_EXTENDED_REVIEWS_COUNT");
															if($hitProp)
																$arSelect[] = "PROPERTY_".$hitProp;
															if($saleProp)
																$arSelect[] = "PROPERTY_".$saleProp;

															$arPricesID = array();
															if(!$arParams["PRICE_CODE_IDS"])
															{
																$dbPriceType = \CCatalogGroup::GetList(
																	array("SORT" => "ASC"),
																	array("NAME" => $arParams["PRICE_CODE"])
																	);
																while($arPriceType = $dbPriceType->Fetch())
																{
																	$arParams["PRICE_CODE_IDS"][] = array(
																		"ID" => $arPriceType["ID"]
																	);
																}
															}
															if($arParams["PRICE_CODE_IDS"])
															{
																foreach($arParams["PRICE_CODE_IDS"] as $arPrices)
																{
																	$arSelect[] = "CATALOG_GROUP_".$arPrices["ID"];
																	$arPricesID[] = $arPrices["ID"];
																}
															}
															$arProduct = CMaxCache::CIBLockElement_GetList(array('CACHE' => array("MULTI" => "N", "TAG" => CMaxCache::GetIBlockCacheTag($arItem["PROPERTIES"]["LINK_ITEM"]["LINK_IBLOCK_ID"]))), array("IBLOCK_ID" => $arItem["PROPERTIES"]["LINK_ITEM"]["LINK_IBLOCK_ID"], "ACTIVE"=>"Y", "ACTIVE_DATE" => "Y", "ID" => $arItem["PROPERTIES"]["LINK_ITEM"]["VALUE"]), false, false, $arSelect);
															$arPriceList = \Aspro\Functions\CAsproMax::getPriceList($arProduct["ID"], $arPricesID, 1, true);
															
															?>
															<div class="banner_title item_info">
																<?if((($hitProp && $arProduct['PROPERTY_'.$hitProp.'_VALUE']) || ($saleProp && $arProduct['PROPERTY_'.$saleProp.'_VALUE'])) && $arItem["PROPERTIES"]["SHOW_STICKERS"]["VALUE"] == "Y"):?>
																	<div class="stickers">
																		<?if($saleProp && $arProduct['PROPERTY_'.$saleProp.'_VALUE']):?>
																			<div class="sticker_sale_text"><?=$arProduct['PROPERTY_'.$saleProp.'_VALUE']?></div>
																		<?endif;?>
																		<?if($hitProp && $arProduct['PROPERTY_'.$hitProp.'_VALUE']):?>
																			<?foreach((array)$arProduct['PROPERTY_'.$hitProp.'_VALUE'] as $key => $value):?>
																				<?
																				$enumID = ((is_array($arProduct['PROPERTY_'.$hitProp.'_ENUM_ID'])) ? $arProduct['PROPERTY_'.$hitProp.'_ENUM_ID'][$key] : $arProduct['PROPERTY_'.$hitProp.'_ENUM_ID']);
																				$arTmpEnum = CIBlockPropertyEnum::GetByID($enumID);?>
																				<div class="sticker_<?=($strTypeHitProp == "PROPERTY_VALUE" ? CUtil::translit($value, 'ru') : strtolower($arTmpEnum["XML_ID"]));?>"><?=$value?></div>
																			<?endforeach;?>
																		<?endif;?>
																	</div>
																<?endif;?>

																<?if($arItem['PROPERTIES']['TITLE_H1']['VALUE'] == "Y" && !$bShowH1):?>
																	
																<?else:?>
																
																<?endif;?>

																	<?if($arProduct["DETAIL_PAGE_URL"]):?>
																		<a href="<?=$arProduct["DETAIL_PAGE_URL"]?>" <?=(strlen($target) ? 'target="'.$target.'"' : '')?>>
																	<?endif;?>
																	<?=$arProduct["NAME"];?>
																	<?if($arProduct["DETAIL_PAGE_URL"]):?>
																		</a>
																	<?endif;?>
																
																<?if($arItem['PROPERTIES']['TITLE_H1']['VALUE'] == "Y" && !$bShowH1):?>
																	<?$bShowH1 = true;?>
																	</h1>
																<?else:?>
																	</span>
																<?endif;?>
																<?
																$bHasOffers = (isset($arProduct["CATALOG_TYPE"]) && $arProduct["CATALOG_TYPE"] == 3);

																if($bHasOffers)
																{
																	$arSelect = array("ID", "IBLOCK_ID", "NAME", "CATALOG_QUANTITY");												
																	$arOffers = CMaxCache::CIBLockElement_GetList(array('CACHE' => array("MULTI" => "Y", "TAG" => CMaxCache::GetIBlockCacheTag($arItem["PROPERTIES"]["LINK_ITEM"]["LINK_IBLOCK_ID"]))), array("PROPERTY_CML2_LINK" => $arProduct["ID"], "ACTIVE"=>"Y", "ACTIVE_DATE" => "Y"), false, false, $arSelect);
																	$arProduct["OFFERS"] = $arOffers;
																}

																$arPrice = CCatalogProduct::GetOptimalPrice($arProduct["ID"], 1, $USER->GetUserGroupArray(), 'N', $arPriceList);
																$totalCount = CMax::GetTotalCount($arProduct, $arParams);
																$arQuantityData = CMax::GetQuantityArray($totalCount, array('ID' => $arProduct["ID"]), "N", (($arProduct["OFFERS"] || $arProduct['CATALOG_TYPE'] == CCatalogProduct::TYPE_SET || !$arResult['STORES_COUNT']) ? false : true) );
																$strMeasure = '';

																if($arProduct["CATALOG_MEASURE"])
																{
																	$arMeasure = CCatalogMeasure::getList(array(), array("ID" => $arProduct["CATALOG_MEASURE"]), false, false, array())->GetNext();
																	$strMeasure = $arMeasure["SYMBOL_RUS"];
																}?>

																<?if($arQuantityData["HTML"] || $arItem['PROPERTIES']['SHOW_RATING']['VALUE'] == "Y"):?>
																
																	<div class="votes_block nstar">
																		<?if($arItem['PROPERTIES']['SHOW_RATING']['VALUE'] == "Y"):?>
																			<div class="ratings">
																				<?
																				if($arParams['REVIEWS_VIEW'] == 'EXTENDED'):?>
																					<?$message = $arProduct['PROPERTY_EXTENDED_REVIEWS_RAITING_VALUE'] ? GetMessage('VOTES_RESULT', array('#VALUE#' => $arProduct['PROPERTY_EXTENDED_REVIEWS_RAITING_VALUE'])) : GetMessage('VOTES_RESULT_NONE')?>
																					<div class="inner_rating" title="<?=$message?>">
																						<?for($i=1;$i<=5;$i++):?>
																							<div class="item-rating <?=$i<=$arProduct['PROPERTY_EXTENDED_REVIEWS_RAITING_VALUE'] ? 'filed' : ''?>"><?=CMax::showIconSvg("star", SITE_TEMPLATE_PATH."/images/svg/catalog/star_small.svg");?></div>
																						<?endfor;?>
																						
															
																					</div>
																				<?else:?>
																					<?
																					if($arProduct["PROPERTY_VOTE_COUNT_VALUE"])
																						$display_rating = round($arProduct["PROPERTY_VOTE_SUM_VALUE"]/$arProduct["PROPERTY_VOTE_COUNT_VALUE"], 2);
																					else
																						$display_rating = 0;
																					?>
																					<div class="inner_rating">
																						<?for($i=1;$i<=5;$i++):?>
																							<div class="item-rating <?=(round($display_rating) >= $i ? "filed" : "");?>"><?=CMax::showIconSvg("star", SITE_TEMPLATE_PATH."/images/svg/star.svg");?></div>
																						<?endfor;?>
																					</div>
																				<?endif;?>
																			</div>
																		<?endif;?>
																		<div class="sa_block">
																			<?if($arQuantityData["HTML"]):?>
																				<?=$arQuantityData["HTML"];?>
																			<?endif;?>
																		</div>
																	</div>
																<?endif;?>

																<div class="price_adaptive_wrapper">

																	<?if($arItem['PROPERTIES']['SHOW_DATE_SALE']['VALUE'] == "Y"):?>
																		<?\Aspro\Functions\CAsproMax::showDiscountCounter($totalCount, $arPrice["DISCOUNT"], $arQuantityData, $arProduct, $strMeasure);?>
																	<?endif;?>

																	<?if($arPrice["RESULT_PRICE"] && $arItem['PROPERTIES']['SHOW_PRICES']['VALUE'] == "Y"):?>
																		<div class="price_adaptive_wrapper_inner">
																			<?
																			$price = $arPrice["RESULT_PRICE"]["DISCOUNT_PRICE"];
																			$arFormatPrice = $arPrice["RESULT_PRICE"];
																			$arCurrencyParams = array();
																			if($arParams["CONVERT_CURRENCY"] != "Y" && $arPrice["RESULT_PRICE"]["CURRENCY"] != $arPrice["PRICE"]["CURRENCY"])
																			{
																				$price = roundEx(CCurrencyRates::ConvertCurrency($arPrice["RESULT_PRICE"]["DISCOUNT_PRICE"], $arPrice["RESULT_PRICE"]["CURRENCY"], $arPrice["PRICE"]["CURRENCY"]),CATALOG_VALUE_PRECISION);
																				$arFormatPrice = $arPrice["PRICE"];
																			}
																			if($arParams["CONVERT_CURRENCY"] == "Y" && $arParams["CURRENCY_ID"])
																			{
																				$arCurrencyInfo = CCurrency::GetByID($arParams["CURRENCY_ID"]);
																				if (is_array($arCurrencyInfo) && !empty($arCurrencyInfo))
																				{
																					$arCurrencyParams["CURRENCY_ID"] = $arCurrencyInfo["CURRENCY"];
																					$price = CCurrencyRates::ConvertCurrency($arPrice["RESULT_PRICE"]["DISCOUNT_PRICE"], $arPrice["RESULT_PRICE"]["CURRENCY"], $arCurrencyParams["CURRENCY_ID"]);
																					$arFormatPrice["CURRENCY"] = $arCurrencyParams["CURRENCY_ID"];
																				}
																			}
																			?>
																			<!--<div class="prices">
																				<span class="price font_lg">
																					<span class="values_wrapper"><?=($bHasOffers ? GetMessage("FROM")." " : "");?><?=\Aspro\Functions\CAsproMaxItem::getCurrentPrice($price, $arFormatPrice, false);?></span>
																					<?if($strMeasure):?><span class="price_measure">/<?=$strMeasure?></span><?endif;?>
																				</span>
																				<?if($arItem['PROPERTIES']['SHOW_OLD_PRICE']['VALUE'] == "Y" && ($arPrice["RESULT_PRICE"]["BASE_PRICE"] != $arPrice["RESULT_PRICE"]["DISCOUNT_PRICE"])):?>
																					<span class="price price_old font_sm">
																						<?if($arCurrencyParams)
																							$arPrice["RESULT_PRICE"]["BASE_PRICE"] = CCurrencyRates::ConvertCurrency($arPrice["RESULT_PRICE"]["BASE_PRICE"], $arPrice["RESULT_PRICE"]["CURRENCY"], $arCurrencyParams["CURRENCY_ID"])?>
																						<span class="values_wrapper"><?=($bHasOffers ? GetMessage("FROM")." " : "");?><?=\Aspro\Functions\CAsproMaxItem::getCurrentPrice($arPrice["RESULT_PRICE"]["BASE_PRICE"], $arFormatPrice, false);?></span>
																						<?if($strMeasure):?><span class="price_measure">/<?=$strMeasure?></span><?endif;?>
																					</span>
																				<?endif;?>
																			</div>-->
																			<?if($arItem['PROPERTIES']['SHOW_DISCOUNT']['VALUE'] == "Y" && $arPrice["RESULT_PRICE"]["DISCOUNT"]):?>
																				<div class="sale_block">
																					<div class="sale-number rounded2 font_xxs">
																						<div class="value">-<span><?=$arPrice["RESULT_PRICE"]["PERCENT"]?></span>%</div>
																						<div class="inner-sale rounded1">
																							<span><?=GetMessage("CATALOG_ITEM_ECONOMY");?></span>
																							<span class="price">
																								<?if($arCurrencyParams)
																								$arPrice["RESULT_PRICE"]["DISCOUNT"] = CCurrencyRates::ConvertCurrency($arPrice["RESULT_PRICE"]["DISCOUNT"], $arPrice["RESULT_PRICE"]["CURRENCY"], $arCurrencyParams["CURRENCY_ID"])?>
																								<span class="values_wrapper"><?=\Aspro\Functions\CAsproMaxItem::getCurrentPrice($arPrice["RESULT_PRICE"]["DISCOUNT"], $arFormatPrice, false);?></span>
																							</span>
																						</div>
																					</div>
																				</div>
																			<?endif;?>
																		</div>
																	<?endif;?>

																</div>
															</div>

															<div class="banner_buttons with_actions <?=$arProduct["CATALOG_TYPE"];?>">
																<a href="<?=$arProduct["DETAIL_PAGE_URL"]?>" class="<?=!empty($arItem["PROPERTIES"]["BUTTON1CLASS"]["VALUE"]) ? $arItem["PROPERTIES"]["BUTTON1CLASS"]["VALUE"] : "btn btn-default btn-lg"?>" <?=(strlen($target) ? 'target="'.$target.'"' : '')?>>
																	<?=$arItem["PROPERTIES"]["BUTTON1TEXT"]["VALUE"]?>
																</a>
																<?if($arItem['PROPERTIES']['SHOW_BUTTONS']['VALUE'] == "Y"):?>
																	<div class="wraps_buttons" data-id="<?=$arProduct["ID"];?>" data-iblockid="<?=$arProduct["IBLOCK_ID"];?>">
																		<?$arAllPrices = \CIBlockPriceTools::GetCatalogPrices(false, $arParams["PRICE_CODE"]);
																		$arProduct["CAN_BUY"] = CIBlockPriceTools::CanBuy($arProduct["IBLOCK_ID"], $arAllPrices, $arProduct);
																		?>
																		<?if($arPrice && $arProduct["CATALOG_TYPE"] == 1):?>
																			<?if($arProduct["CAN_BUY"]):?>
																				<div class="wrap colored_theme_hover_bg option-round  basket_item_add" data-title="<?=$arTheme["EXPRESSION_ADDTOBASKET_BUTTON_DEFAULT"]["VALUE"];?>" title="<?=$arTheme["EXPRESSION_ADDTOBASKET_BUTTON_DEFAULT"]["VALUE"];?>" data-href="<?=$arTheme["BASKET_PAGE_URL"]["VALUE"];?>" data-title2="<?=$arTheme["EXPRESSION_ADDEDTOBASKET_BUTTON_DEFAULT"]["VALUE"];?>">
																					<?=CMax::showIconSvg("basket ", SITE_TEMPLATE_PATH."/images/svg/basket.svg");?>
																					<?=CMax::showIconSvg("basket-added", SITE_TEMPLATE_PATH."/images/svg/inbasket.svg");?>
																				</div>
																			<?endif;?>
																			<div class="wrap colored_theme_hover_bg option-round  wish_item_add" data-title="<?=GetMessage("CATALOG_ITEM_DELAY");?>" title="<?=GetMessage("CATALOG_ITEM_DELAY");?>" data-title2="<?=GetMessage("CATALOG_ITEM_DELAYED");?>">
																				<?=CMax::showIconSvg("wish ", SITE_TEMPLATE_PATH."/images/svg/chosen.svg");?>
																			</div>
																		<?endif;?>
																		<?if($arTheme['CATALOG_COMPARE']['VALUE'] != 'N'):?>
																			<div class="wrap colored_theme_hover_bg option-round  compare_item_add" data-title="<?=GetMessage("CATALOG_ITEM_COMPARE");?>" title="<?=GetMessage("CATALOG_ITEM_COMPARE");?>" data-title2="<?=GetMessage("CATALOG_ITEM_COMPARED");?>">
																				<?=CMax::showIconSvg("compare ", SITE_TEMPLATE_PATH."/images/svg/compare.svg");?>
																			</div>
																		<?endif;?>
																		<?if($bShowVideo && !$bVideoAutoStart):?>
																			<span class="btn <?=(strlen($arItem['PROPERTIES']['BUTTON_VIDEO_CLASS']['VALUE_XML_ID']) ? $arItem['PROPERTIES']['BUTTON_VIDEO_CLASS']['VALUE_XML_ID'] : 'btn-default')?> btn-video" title="<?=$buttonVideoText?>"></span>
																		<?endif;?>
																	</div>
																<?endif;?>
															</div>
														<?else:?>
															<?
																$bShowButton1 = (strlen($arItem['PROPERTIES']['BUTTON1TEXT']['VALUE']) && strlen($arItem['PROPERTIES']['BUTTON1LINK']['VALUE']));
																$bShowButton2 = (strlen($arItem['PROPERTIES']['BUTTON2TEXT']['VALUE']) && strlen($arItem['PROPERTIES']['BUTTON2LINK']['VALUE']));
															?>
															<?if($arItem["NAME"]):?>
																<div class="banner_title">
																	<?if($arItem['PROPERTIES']['TITLE_H1']['VALUE'] == "Y" && !$bShowH1):?>
																		
																	<?else:?>
																		
																	<?endif;?>

																		<?if($arItem["PROPERTIES"]["URL_STRING"]["VALUE"]):?>
																			<a href="<?=$arItem["PROPERTIES"]["URL_STRING"]["VALUE"]?>" <?=(strlen($target) ? 'target="'.$target.'"' : '')?>>
																		<?endif;?>
																		<?=strip_tags($arItem["~NAME"], "<br><br/>");?>
																		<?if($arItem["PROPERTIES"]["URL_STRING"]["VALUE"]):?>
																			</a>
																		<?endif;?>
																	
																	<?if($arItem['PROPERTIES']['TITLE_H1']['VALUE'] == "Y" && !$bShowH1):?>
																		<?$bShowH1 = true;?>
																		</h1>
																	<?else:?>
																		</span>
																	<?endif;?>

																</div>
															<?endif;?>
															<?if($arItem["PREVIEW_TEXT"]):?>
																<div class="banner_text"><?=$arItem["PREVIEW_TEXT"];?></div>
															<?endif;?>
															<?if($bShowButton1 || $bShowButton2 || ($bShowVideo && !$bVideoAutoStart)):?>
																<div class="banner_buttons">
																	<?if($bShowVideo && !$bVideoAutoStart && !$bShowButton1 && !$bShowButton2):?>
																		<span class="btn <?=(strlen($arItem['PROPERTIES']['BUTTON_VIDEO_CLASS']['VALUE_XML_ID']) ? $arItem['PROPERTIES']['BUTTON_VIDEO_CLASS']['VALUE_XML_ID'] : 'btn-default')?> btn-video" title="<?=$buttonVideoText?>"></span>
																	<?elseif($bShowButton1 || $bShowButton2):?>
																		<?if($bShowVideo && !$bVideoAutoStart):?>
																			<span class="btn <?=(strlen($arItem['PROPERTIES']['BUTTON_VIDEO_CLASS']['VALUE_XML_ID']) ? $arItem['PROPERTIES']['BUTTON_VIDEO_CLASS']['VALUE_XML_ID'] : 'btn-default')?> btn-video" title="<?=$buttonVideoText?>"></span>
																		<?endif;?>
																		<?if($bShowButton1):?>
																			<a href="<?=$arItem["PROPERTIES"]["BUTTON1LINK"]["VALUE"]?>" class="<?=!empty($arItem["PROPERTIES"]["BUTTON1CLASS"]["VALUE"]) ? $arItem["PROPERTIES"]["BUTTON1CLASS"]["VALUE"] : "btn btn-default btn-lg"?>" <?=(strlen($target) ? 'target="'.$target.'"' : '')?>>
																				<?=$arItem["PROPERTIES"]["BUTTON1TEXT"]["VALUE"]?>
																			</a>
																		<?endif;?>
																		<?if($bShowButton2):?>
																			<a href="<?=$arItem["PROPERTIES"]["BUTTON2LINK"]["VALUE"]?>" class="<?=!empty( $arItem["PROPERTIES"]["BUTTON2CLASS"]["VALUE"]) ? $arItem["PROPERTIES"]["BUTTON2CLASS"]["VALUE"] : "btn btn-transparent-border btn-lg"?>" <?=(strlen($target) ? 'target="'.$target.'"' : '')?>>
																				<?=$arItem["PROPERTIES"]["BUTTON2TEXT"]["VALUE"]?>
																			</a>
																		<?endif;?>
																	<?endif;?>
																</div>
															<?endif;?>
														<?endif;?>
													<?else:?>
														<?if($bShowVideo && !$bVideoAutoStart):?>
															<div class="banner_buttons" style="margin-top:0;">
																<span class="btn <?=(strlen($arItem['PROPERTIES']['BUTTON_VIDEO_CLASS']['VALUE_XML_ID']) ? $arItem['PROPERTIES']['BUTTON_VIDEO_CLASS']['VALUE_XML_ID'] : 'btn-default')?> btn-video" title="<?=$buttonVideoText?>"><?=CMax::showIconSvg('playpause', SITE_TEMPLATE_PATH.'/images/svg/play_pause.svg', '', 'svg-playpause');?></span>
															</div>
														<?endif;?>
													<?endif;?>
												<?$tablet_text = trim(ob_get_clean());?>
												<div class="wrap"><?if(strlen($tablet_text)):?><div class="inner"><?=$tablet_text?></div><?endif;?></div>
											</td>
										<?endif;?>
									</tr>
								<?endif;?>
							</tbody>
							</table>
						</div>
					</div>
				</div>
			<?endforeach;?>
		</div>
		<?if ($arOptions['countSlides'] > 1):?>
			<div class="swiper-pagination"></div>
			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>
		<?endif;?>
	</div>
<style type="text/css">
.main-banner__footer {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    width: 100%;
    height: 100px;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    align-items: center;
}
.main-banner__price {
    position: relative;
}
.main-banner__price-old {
    position: absolute;
    bottom: 100%;
    left: 0;
    color: #E16E03;
    font-size: 16px;
    font-family: "Open Sans", sans-serif;
    margin-bottom: 14px;
    text-decoration: line-through;
}
.main-banner__price-current {
    color: #fff;
    font-size: 32px;
    font-family: "Open Sans", sans-serif;
    font-weight: 700;
}
.main-banner__review {
    font-size: 14px;
    font-family: "Open Sans", sans-serif;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    color: #fff;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
}
.main-banner__review:hover {
    font-size: 14px;
    font-family: "Open Sans", sans-serif;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    color: #fff;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
}
.main-banner__review svg {
    width: 25px;
    display: block;
    height: auto;
    margin-right: 15px;
}	
.container34 {
    max-width: 1430px;
    padding: 0 15px;
    margin: 0 auto;
}
</style>
	<div class="container34">
	<div class="main-banner__footer">

		<?if($arItem['PROPERTIES']['SHOW_PRICES']['VALUE'] == "Y"):?>
                <div class="main-banner__price">
                <?if($arItem['PROPERTIES']['SHOW_OLD_PRICE']['VALUE'] == "Y"):?>
                  <div class="main-banner__price-old">Р<?=$arPrice["RESULT_PRICE"]["BASE_PRICE"]?></div>
                 <?endif;?>
                  <div class="main-banner__price-current">Р<?=$arPrice["RESULT_PRICE"]["DISCOUNT_PRICE"]?></div>
                </div>

		<?endif;?>	

		<?if($arItem['PROPERTIES']['SHOW_VIDEO']['VALUE']==='Y'):?>												
	        <a href="<?=$arItem['PROPERTIES']['VIDEO_SRC']['VALUE']?>" target="_blank" class="main-banner__review" tabindex="0">
	          <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
	            <circle cx="12.5" cy="12.5" r="12.5" fill="#FD6C03"></circle>
	            <path d="M16.9998 12.4863L10.2612 16.4029L10.2386 8.60875L16.9998 12.4863Z" fill="white"></path>
	          </svg>
	          Посмотреть обзор
	        </a>
        <?endif;?>
      </div>

      </div>
</div>

<?if ($bBannerLight) {
	$templateData["BANNER_LIGHT"] = true;
}?>

<?if($bInitYoutubeJSApi):?>
	<script type="text/javascript">
	BX.ready(function(){
		var tag = document.createElement('script');
		tag.src = "https://www.youtube.com/iframe_api";
		var firstScriptTag = document.getElementsByTagName('script')[0];
		firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	});
	</script>
<?endif;?>