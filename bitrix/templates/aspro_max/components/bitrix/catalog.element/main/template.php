<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc;?>
<?php /*echo "<pre>";
echo var_dump($arResult);
echo "</pre>"; */?><!--

--><?php /*echo "<pre>";
echo var_dump($arParams);
echo "</pre>"; */?>
<div class="basket_props_block" id="bx_basket_div_<?=$arResult["ID"];?>" style="display: none;">
	<?if (!empty($arResult['PRODUCT_PROPERTIES_FILL'])){
		foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo){?>
			<input type="hidden" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>">
			<?if (isset($arResult['PRODUCT_PROPERTIES'][$propID]))
				unset($arResult['PRODUCT_PROPERTIES'][$propID]);
		}
	}
	$arResult["EMPTY_PROPS_JS"]="Y";
	$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
	if (!$emptyProductProperties){
		$arResult["EMPTY_PROPS_JS"]="N";?>
		<div class="wrapper">
			<table>
				<?foreach ($arResult['PRODUCT_PROPERTIES'] as $propID => $propInfo){?>
					<tr>
						<td><? echo $arResult['PROPERTIES'][$propID]['NAME']; ?></td>
						<td>
							<?if('L' == $arResult['PROPERTIES'][$propID]['PROPERTY_TYPE'] && 'C' == $arResult['PROPERTIES'][$propID]['LIST_TYPE']){
								foreach($propInfo['VALUES'] as $valueID => $value){?>
									<label>
										<input type="radio" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? '"checked"' : ''); ?>><? echo $value; ?>
									</label>
								<?}
							}else{?>
								<select name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]">
									<?foreach($propInfo['VALUES'] as $valueID => $value){?>
										<option value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? '"selected"' : ''); ?>><? echo $value; ?></option>
									<?}?>
								</select>
							<?}?>
						</td>
					</tr>
				<?}?>
			</table>
		</div>
	<?}?>
</div>

<?
$currencyList = '';
if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$bComplect = $arResult["PROPERTIES"]["PRODUCT_SET"]["VALUE"] === "Y";
$addParams = array();
if($bComplect){
	$addParams = array("DISPLAY_WISH_BUTTONS" => "N");
}

$templateData = array(
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList,
	'STORES' => array(
		"USE_STORE_PHONE" => $arParams["USE_STORE_PHONE"],
		"SCHEDULE" => $arParams["SCHEDULE"],
		"USE_MIN_AMOUNT" => $arParams["USE_MIN_AMOUNT"],
		"MIN_AMOUNT" => $arParams["MIN_AMOUNT"],
		"ELEMENT_ID" => $arResult["ID"],
		"STORE_PATH"  =>  $arParams["STORE_PATH"],
		"MAIN_TITLE"  =>  $arParams["MAIN_TITLE"],
		"MAX_AMOUNT"=>$arParams["MAX_AMOUNT"],
		"USE_ONLY_MAX_AMOUNT" => $arParams["USE_ONLY_MAX_AMOUNT"],
		"SHOW_EMPTY_STORE" => $arParams['SHOW_EMPTY_STORE'],
		"SHOW_GENERAL_STORE_INFORMATION" => $arParams['SHOW_GENERAL_STORE_INFORMATION'],
		"USE_ONLY_MAX_AMOUNT" => $arParams["USE_ONLY_MAX_AMOUNT"],
		"USER_FIELDS" => $arParams['USER_FIELDS'],
		"FIELDS" => $arParams['FIELDS'],
		"STORES_FILTER_ORDER" => $arParams['STORES_FILTER_ORDER'],
		"STORES_FILTER" => $arParams['STORES_FILTER'],
		"STORES" => $arParams['STORES'] = array_diff($arParams['STORES'], array('')),
		"SET_ITEMS" => $arResult["SET_ITEMS"],
	),
	'OFFERS_INFO' => array(
		'OFFERS' => $arResult['OFFERS'],
		'OFFER_GROUP' => $arResult['OFFER_GROUP'],
		'OFFERS_IBLOCK' => $arResult['OFFERS_IBLOCK'],
	),
	'LINK_SALES' => $arResult['STOCK'],
	'LINK_SERVICES' => $arResult['SERVICES'],
	//'LINK_BUY_SERVICES' => $arResult['BUY_SERVICES'],
	'LINK_NEWS' => $arResult['NEWS'],
	'LINK_TIZERS' => $arParams['SECTION_TIZERS'],
	'LINK_REVIEWS' => $arResult['LINK_REVIEWS'],
	'LINK_BLOG' => $arResult['BLOG'],
	'LINK_STAFF' => $arResult['LINK_STAFF'],
	'LINK_VACANCY' => $arResult['LINK_VACANCY'],
	'CATALOG_SETS' => array(
		'SET_ITEMS_QUANTITY' => $arResult["SET_ITEMS_QUANTITY"],
		'SET_ITEMS' => $arResult["SET_ITEMS"]
	),
	'VIDEO' => $arResult['VIDEO'],
	'ASSOCIATED' => $arResult['ASSOCIATED'],
	'EXPANDABLES' => $arResult['EXPANDABLES'],
	'PRODUCT_SET_OPTIONS' => array(
		'PRODUCT_SET' => $bComplect,
		'PRODUCT_SET_FILTER' => $arResult["PROPERTIES"]["PRODUCT_SET_FILTER"]["~VALUE"],
		'PRODUCT_SET_GROUP' => $arResult["PROPERTIES"]["PRODUCT_SET_GROUP"]["VALUE"] === "Y",
	),
);
unset($currencyList, $templateLibrary);

if($arResult["PROPERTIES"]["YM_ELEMENT_ID"] && $arResult["PROPERTIES"]["YM_ELEMENT_ID"]["VALUE"])
	$templateData["YM_ELEMENT_ID"] = $arResult["PROPERTIES"]["YM_ELEMENT_ID"]["VALUE"];

$arSkuTemplate = array();
if(!empty($arResult['SKU_PROPS']))
	$arSkuTemplate=CMax::GetSKUPropsArray($arResult['SKU_PROPS'], $arResult["SKU_IBLOCK_ID"], "list", $arParams["OFFER_HIDE_NAME_PROPS"], "N", array(), $arParams['OFFER_SHOW_PREVIEW_PICTURE_PROPS']);
	//$arSkuTemplate=CMax::GetSKUPropsArray($arResult['SKU_PROPS'], $arResult["SKU_IBLOCK_ID"], "list", $arParams["OFFER_HIDE_NAME_PROPS"]);

$strMainID = $this->GetEditAreaId($arResult['ID']);
$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);

$arResult["strMainID"] = $this->GetEditAreaId($arResult['ID']);
$arItemIDs=CMax::GetItemsIDs($arResult, "Y");
$templateData['TOTAL_COUNT'] = $totalCount = CMax::GetTotalCount($arResult, $arParams);

$templateData['QUANTITY_DATA'] = $arQuantityData = CMax::GetQuantityArray($totalCount, $arItemIDs["ALL_ITEM_IDS"], ($arParams["USE_STORE"] == "Y" && $arResult["STORES_COUNT"] && $arResult['CATALOG_TYPE'] != CCatalogProduct::TYPE_SET && (!$arResult["OFFERS"] || ($arResult["OFFERS"] && $arParams["TYPE_SKU"]!="N")) ? "Y" : "N"));
$templateData['ID_OFFER_GROUP'] = $arItemIDs['ALL_ITEM_IDS']['OFFER_GROUP'];

$arParams["BASKET_ITEMS"]=($arParams["BASKET_ITEMS"] ? $arParams["BASKET_ITEMS"] : array());
$useStores = $arParams["USE_STORE"] == "Y" && $arResult["STORES_COUNT"] && $arQuantityData["RIGHTS"]["SHOW_QUANTITY"] && $arResult['CATALOG_TYPE'] != CCatalogProduct::TYPE_SET;
$templateData['STORES']['USE_STORES'] = $useStores;

$showCustomOffer=(($arResult['OFFERS'] && $arParams["TYPE_SKU"] !="N") ? true : false);
if($showCustomOffer)
	$templateData['JS_OBJ'] = $strObName;

$strMeasure='';
$arAddToBasketData = array();

$templateData['STR_ID'] = $strObName;
$item_id = $arResult["ID"];

$bUseSkuProps = ($arResult["OFFERS"] && !empty($arResult['OFFERS_PROP']));

if($arResult["OFFERS"])
{
	$strMeasure=$arResult["MIN_PRICE"]["CATALOG_MEASURE_NAME"];
	$templateData["STORES"]["OFFERS"]="Y";
	foreach($arResult["OFFERS"] as $arOffer)
	{
		$templateData["STORES"]["OFFERS_ID"][]=$arOffer["ID"];
	}
}
else
{
	if(($arParams["SHOW_MEASURE"]=="Y")&&($arResult["CATALOG_MEASURE"]))
	{
		$arMeasure = CCatalogMeasure::getList(array(), array("ID"=>$arResult["CATALOG_MEASURE"]), false, false, array())->GetNext();
		$strMeasure=$arMeasure["SYMBOL_RUS"];
	}
	$arAddToBasketData = CMax::GetAddToBasketArray($arResult, $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], true, $arItemIDs["ALL_ITEM_IDS"], 'btn-lg', $arParams);
}
$arOfferProps = implode(';', $arParams['OFFERS_CART_PROPERTIES']);

// save item viewed
$arFirstPhoto = reset($arResult['MORE_PHOTO']);
$arItemPrices = $arResult['MIN_PRICE'];
if(isset($arResult['PRICE_MATRIX']) && $arResult['PRICE_MATRIX'])
{
	$rangSelected = $arResult['ITEM_QUANTITY_RANGE_SELECTED'];
	$priceSelected = $arResult['ITEM_PRICE_SELECTED'];
	if(isset($arResult['FIX_PRICE_MATRIX']) && $arResult['FIX_PRICE_MATRIX'])
	{
		$rangSelected = $arResult['FIX_PRICE_MATRIX']['RANGE_SELECT'];
		$priceSelected = $arResult['FIX_PRICE_MATRIX']['PRICE_SELECT'];
	}
	$arItemPrices = $arResult['ITEM_PRICES'][$priceSelected];
	$arItemPrices['VALUE'] = $arItemPrices['BASE_PRICE'];
	$arItemPrices['PRINT_VALUE'] = \Aspro\Functions\CAsproMaxItem::getCurrentPrice('BASE_PRICE', $arItemPrices);
	$arItemPrices['DISCOUNT_VALUE'] = $arItemPrices['PRICE'];
	$arItemPrices['PRINT_DISCOUNT_VALUE'] = \Aspro\Functions\CAsproMaxItem::getCurrentPrice('PRICE', $arItemPrices);
}

$arViewedData = array(
	'PRODUCT_ID' => $arResult['ID'],
	'IBLOCK_ID' => $arResult['IBLOCK_ID'],
	'NAME' => $arResult['NAME'],
	'DETAIL_PAGE_URL' => $arResult['DETAIL_PAGE_URL'],
	'PICTURE_ID' => $arResult['PREVIEW_PICTURE'] ? $arResult['PREVIEW_PICTURE']['ID'] : ($arFirstPhoto ? $arFirstPhoto['ID'] : false),
	'CATALOG_MEASURE_NAME' => $arResult['CATALOG_MEASURE_NAME'],
	'MIN_PRICE' => $arItemPrices,
	'CAN_BUY' => $arResult['CAN_BUY'] ? 'Y' : 'N',
	'IS_OFFER' => 'N',
	'WITH_OFFERS' => $arResult['OFFERS'] ? 'Y' : 'N',
);
$actualItem = $arResult["OFFERS"] ? (isset($arResult['OFFERS'][$arResult['OFFERS_SELECTED']]) ? $arResult['OFFERS'][$arResult['OFFERS_SELECTED']] : reset($arResult['OFFERS'])) : $arResult;
if($arResult["OFFERS"] && $arParams["TYPE_SKU"]=="N")
	unset($templateData['STORES']);

$iCountProps = count($arResult['DISPLAY_PROPERTIES']);?>

<?if($arResult["OFFERS"] && $arParams["TYPE_SKU"]=="N"):?>
	<?$templateData['OFFERS_INFO']['OFFERS_MORE'] = true;?>
	<?
	$showSkUName = ((in_array('NAME', $arParams['OFFERS_FIELD_CODE'])));
	$showSkUImages = false;
	if(((in_array('PREVIEW_PICTURE', $arParams['OFFERS_FIELD_CODE']) || in_array('DETAIL_PICTURE', $arParams['OFFERS_FIELD_CODE']))))
	{
		foreach ($arResult["OFFERS"] as $key => $arSKU)
		{
			if($arSKU['PREVIEW_PICTURE'] || $arSKU['DETAIL_PICTURE'])
			{
				$showSkUImages = true;
				break;
			}
		}
	}?>

	<?//list offers TYPE_2?>
	<?if($arResult["OFFERS"] && $arParams["TYPE_SKU"] !== "TYPE_1"):?>
		<?$this->SetViewTarget('PRODUCT_OFFERS_INFO');?>
			<div class="list-offers ajax_load">
				<div class="bx_sku_props" style="display:none;">
					<?$arSkuKeysProp='';
					$propSKU=$arParams["OFFERS_CART_PROPERTIES"];
					if($propSKU){
						$arSkuKeysProp=base64_encode(serialize(array_keys($propSKU)));
					}?>
					<input type="hidden" value="<?=$arSkuKeysProp;?>" />
				</div>

			</div>
		<?$this->EndViewTarget();?>
	<?endif;?>
<?endif;?>
<?//top info?>
<div class="product-info <?=(!$showCustomOffer ? "noffer" : "");?> bordered rounded3" id="<?=$arItemIDs["strMainID"];?>">
	<script type="text/javascript">setViewedProduct(<?=$arResult['ID']?>, <?=CUtil::PhpToJSObject($arViewedData, false)?>);</script>

	<?//meta?>
	<meta itemprop="name" content="<?=$name = strip_tags(!empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] : $arResult['NAME'])?>" />
	<link itemprop="url" href="<?=$arResult['DETAIL_PAGE_URL']?>" />
	<meta itemprop="category" content="<?=$arResult['CATEGORY_PATH']?>" />
	<meta itemprop="description" content="<?=(strlen(strip_tags($arResult['PREVIEW_TEXT'])) ? strip_tags($arResult['PREVIEW_TEXT']) : (strlen(strip_tags($arResult['DETAIL_TEXT'])) ? strip_tags($arResult['DETAIL_TEXT']) : $name))?>" />
	<meta itemprop="sku" content="<?=$arResult['ID'];?>" />

	<?//brand,article,rating?>
	<div class="product-info-headnote clearfix">
		<div class="flexbox flexbox--row align-items-center justify-content-between flex-wrap">
			<div class="col-auto">
				<div class="product-info-headnote__inner">
					<?$isArticle=(strlen($arResult["CML2_ARTICLE"]["VALUE"]) || ($arResult['SHOW_OFFERS_PROPS'] && $showCustomOffer));?>
					
	
					<?if($isArticle):?>
						<div class="product-info-headnote__article">
							<div class="article muted font_xs" itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue" <?if($arResult['SHOW_OFFERS_PROPS']){?>id="<? echo $arItemIDs["ALL_ITEM_IDS"]['DISPLAY_PROP_ARTICLE_DIV'] ?>" style="display: none;"<?}?>>
								<span class="article__title" itemprop="name"><?=$arResult["CML2_ARTICLE"]["NAME"];?>:</span>
								<span class="article__value" itemprop="value"><?=$arResult["CML2_ARTICLE"]["VALUE"]?></span>
							</div>
						</div>
					<?endif;?>
				</div>
			</div>
			<div class="col-auto">
				<div class="product-info-headnote__inner">
					<?if($arResult["BRAND_ITEM"]){?>
						<div class="product-info-headnote__brand">
							<div class="brand">
								<meta itemprop="brand" content="<?=$arResult["BRAND_ITEM"]["NAME"]?>" />
								<?if(!$arResult["BRAND_ITEM"]["IMAGE"]):?>
									<a href="<?=$arResult["BRAND_ITEM"]["DETAIL_PAGE_URL"]?>" class="brand__link dark_link"><?=$arResult["BRAND_ITEM"]["NAME"]?></a>
								<?else:?>
									<a class="brand__picture" href="<?=$arResult["BRAND_ITEM"]["DETAIL_PAGE_URL"]?>">
										<img  src="<?=$arResult["BRAND_ITEM"]["IMAGE"]["src"]?>" alt="<?=$arResult["BRAND_ITEM"]["IMAGE"]["ALT"]?>" title="<?=$arResult["BRAND_ITEM"]["IMAGE"]["TITLE"]?>" />
									</a>
								<?endif;?>
							</div>
						</div>
					<?}?>
					<div class="product-info-headnote__toolbar">
						<?\Aspro\Functions\CAsproMaxItem::showDelayCompareBtn(array_merge($arParams, $addParams), $arResult, $arAddToBasketData, $totalCount, $bUseSkuProps, 'list static icons long', false, false, '_small', $currentSKUID, $currentSKUIBlock);?>
					</div>
				</div>
			</div>
		</div>
	</div>





	<?//main gallery?>
	<?$bVertical = ($arParams['GALLERY_THUMB_POSITION'] == 'vertical');?>
	<div class="product-detail-gallery swipeignore left_info">
		<div class="product-detail-gallery__container<?=($bVertical ? ' product-detail-gallery__container--vertical' : '');?>">
			<?reset($arResult['MORE_PHOTO']);
			$countPhoto = count($arResult["MORE_PHOTO"]);
			$arFirstPhoto = ($arParams['ADD_DETAIL_TO_SLIDER'] != 'Y' ? $arResult['PREVIEW_PICTURE'] : current($arResult['MORE_PHOTO']));
			$viewImgType=$arParams["DETAIL_PICTURE_MODE"];
			$bMagnifier = ($viewImgType=="MAGNIFIER");?>
			<?$bIsOneImage = $bMagnifier; ?>

			<?if($arResult["OFFERS"] && $arResult["FIRST_SKU_PICTURE"]):?>
				<link class="first_sku_picture" href="<?=$arResult["FIRST_SKU_PICTURE"]["src"];?>"/>
			<?endif;?>

			<link href="<?=($arFirstPhoto["BIG"]["src"]);?>" itemprop="image"/>
			<div class="product-detail-gallery__slider<?if(!$bMagnifier):?> owl-carousel owl-theme big owl-bg-nav short-nav<?else:?> hidden-xs<?endif;?> <?=$arParams['PICTURE_RATIO'];?>" data-plugin-options='{"items": "1", "dots": true, "nav": true, "relatedTo": ".product-detail-gallery__slider.thmb", "loop": true}'>
				<?if($showCustomOffer && !empty($arResult['OFFERS_PROP'])){?>
					<?$alt=$arFirstPhoto["ALT"];
					$title=$arFirstPhoto["TITLE"];?>
					<div id="photo-sku" class="product-detail-gallery__item product-detail-gallery__item--big text-center">
						<?if($arFirstPhoto["BIG"]["src"]):?>
							<a href="<?=($viewImgType=="POPUP" ? $arFirstPhoto["BIG"]["src"] : "javascript:void(0)");?>" <?=($bIsOneImage ? '' : 'data-fancybox="gallery"')?> class="product-detail-gallery__link <?=($viewImgType=="POPUP" ? "popup_link fancy" : "line_link fancy_zoom");?>" title="<?=$title;?>">
								<img id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PICT']; ?>" class="lazy product-detail-gallery__picture <?=($viewImgType=="MAGNIFIER" ? "zoom_picture" : "");?>" data-src="<?=($arFirstPhoto["SMALL"]["src"] ? $arFirstPhoto["SMALL"]["src"] : $arFirstPhoto["SRC"])?>" src="<?=\Aspro\Functions\CAsproMax::showBlankImg(($arFirstPhoto["SMALL"]["src"] ? $arFirstPhoto["SMALL"]["src"] : $arFirstPhoto["SRC"]))?>" <?=($viewImgType=="MAGNIFIER" ? 'data-xoriginal="'.$arFirstPhoto["BIG"]["src"].'" data-xpreview="'.$arFirstPhoto["THUMB"]["src"].'"' : "");?> alt="<?=$alt;?>" title="<?=$title;?>"/>
							</a>
						<?else:?>
							<img id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PICT']; ?>" class="lazy product-detail-gallery__picture one" data-src="<?=\Aspro\Functions\CAsproMax::showBlankImg($arFirstPhoto["SRC"])?>" src="<?=$arFirstPhoto["SRC"]?>" alt="<?=$alt;?>" title="<?=$title;?>" />
						<?endif;?>
					</div>
				<?}else{
					if($arResult["MORE_PHOTO"]){?>
						<?foreach($arResult["MORE_PHOTO"] as $i => $arImage){
							if($i && $bMagnifier):?>
								<?continue;?>
							<?endif;?>
							<?$isEmpty=($arImage["SMALL"]["src"] ? false : true );?>
							<?
							$alt=$arImage["ALT"];
							$title=$arImage["TITLE"];
							?>
							<div id="photo-<?=$i?>" class="product-detail-gallery__item product-detail-gallery__item--big text-center">
								<?if(!$isEmpty){?>
									<a href="<?=($viewImgType=="POPUP" ? $arImage["BIG"]["src"] : "javascript:void(0)");?>" <?=($bIsOneImage ? '' : 'data-fancybox="gallery"')?> class="product-detail-gallery__link <?=($viewImgType=="POPUP" ? "popup_link fancy" : "line_link fancy_zoom");?>" title="<?=$title;?>">
										<img class="lazy product-detail-gallery__picture <?=($viewImgType=="MAGNIFIER" ? "zoom_picture" : "");?>" data-src="<?=$arImage["SMALL"]["src"]?>" src="<?=\Aspro\Functions\CAsproMax::showBlankImg($arImage["SMALL"]["src"])?>" <?=($viewImgType=="MAGNIFIER" ? 'data-xoriginal="'.$arImage["BIG"]["src"].'" data-xpreview="'.$arImage["THUMB"]["src"].'"' : "");?> alt="<?=$alt;?>" title="<?=$title;?>"<?//=(!$i ? ' itemprop="image"' : '')?>/>
									</a>
								<?}else{?>
									<img class="lazy product-detail-gallery__picture one" src="<?=\Aspro\Functions\CAsproMax::showBlankImg($arImage["SRC"])?>" data-src="<?=$arImage["SRC"]?>" alt="<?=$alt;?>" title="<?=$title;?>" />
								<?}?>
							</div>
						<?}?>
					<?}
				}?>
			</div>
			<?if($bMagnifier):?>
				<div class="product-detail-gallery__slider owl-carousel owl-theme big visible-xs <?=$arParams['PICTURE_RATIO'];?>" data-plugin-options='{"items": "1", "dots": true, "nav": true, "loop": false}'>
					<?if($showCustomOffer && !empty($arResult['OFFERS_PROP'])){?>
						<?$alt=$arFirstPhoto["ALT"];
						$title=$arFirstPhoto["TITLE"];?>
						<div id="photo-sku" class="product-detail-gallery__item product-detail-gallery__item--big text-center">
							<?if($arFirstPhoto["BIG"]["src"]):?>
								<a href="<?=$arFirstPhoto["BIG"]["src"];?>" data-fancybox="gallery" class="product-detail-gallery__link popup_link fancy" title="<?=$title;?>">
									<img id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PICT']; ?>" class="lazy product-detail-gallery__picture" data-src="<?=$arFirstPhoto["SMALL"]["src"]?>" src="<?=\Aspro\Functions\CAsproMax::showBlankImg($arFirstPhoto["SMALL"]["src"])?>" alt="<?=$alt;?>" title="<?=$title;?>"<?//=(!$i ? ' itemprop="image"' : '')?>/>
								</a>
							<?else:?>
								<img id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PICT']; ?>" class="lazy product-detail-gallery__picture" data-src="<?=\Aspro\Functions\CAsproMax::showBlankImg($arFirstPhoto["SRC"])?>" src="<?=$arFirstPhoto["SRC"]?>" alt="<?=$alt;?>" title="<?=$title;?>" />
							<?endif;?>
						</div>
					<?}else{
						if($arResult["MORE_PHOTO"]){?>
							<?foreach($arResult["MORE_PHOTO"] as $i => $arImage){?>
								<?$isEmpty=($arImage["SMALL"]["src"] ? false : true );?>
								<?
								$alt=$arImage["ALT"];
								$title=$arImage["TITLE"];
								?>
								<div id="photo-<?=$i?>" class="product-detail-gallery__item product-detail-gallery__item--big text-center">
									<?if(!$isEmpty){?>
										<a href="<?=$arImage["BIG"]["src"];?>" data-fancybox="gallery" class="product-detail-gallery__link popup_link fancy" title="<?=$title;?>">
											<img class="lazy product-detail-gallery__picture" data-src="<?=$arImage["SMALL"]["src"]?>" src="<?=\Aspro\Functions\CAsproMax::showBlankImg($arImage["SMALL"]["src"])?>" alt="<?=$alt;?>" title="<?=$title;?>"<?//=(!$i ? ' itemprop="image"' : '')?>/>
										</a>
									<?}else{?>
										<img class="lazy product-detail-gallery__picture" data-src="<?=\Aspro\Functions\CAsproMax::showBlankImg($arImage["SRC"])?>" src="<?=$arImage["SRC"]?>" alt="<?=$alt;?>" title="<?=$title;?>" />
									<?}?>
								</div>
							<?}?>
						<?}
					}?>
				</div>
			<?endif;?>
			<div class="product-detail-gallery__thmb-container text-center">
				<div class="product-detail-gallery__thmb-inner">
					<?if(!$showCustomOffer || empty($arResult['OFFERS_PROP'])):?>
						<?if($countPhoto  > 1):?>
							<div class="product-detail-gallery__slider owl-carousel owl-theme thmb<?=($bVertical ? ' product-detail-gallery__slider--vertical' : '');?>" data-size="<?=$countPhoto;?>" data-plugin-options='{"items": "4", "nav": true, "loop": true, "clickTo": ".product-detail-gallery__slider.big", "dots": false, "autoWidth": true, "margin": 10<?//if($bVertical):?>, "mouseDrag": false, "pullDrag": false<?//endif;?><?if($bMagnifier):?>, "magnifier": true<?endif;?>}' style="max-width:<?=ceil((($countPhoto <= 4 ? $countPhoto : 4) * 70) - 10)?>px;">
								<?if($arResult["MORE_PHOTO"]):?>
									<?foreach($arResult["MORE_PHOTO"] as $i => $arImage):?>
										<div id="photo-<?=$i?>" class="product-detail-gallery__item text-center  product-detail-gallery__item--thmb" data-big="<?=$arImage["BIG"]["src"];?>">
											<?if(!$isEmpty){?>
												<img class="lazy product-detail-gallery__picture" data-src="<?=$arImage["SMALL"]["src"]?>" src="<?=\Aspro\Functions\CAsproMax::showBlankImg($arImage["SMALL"]["src"])?>" alt="<?=$alt;?>" title="<?=$title;?>"/>
											<?}else{?>
												<img class="lazy product-detail-gallery__picture" data-src="<?=\Aspro\Functions\CAsproMax::showBlankImg($arImage["SRC"])?>" src="<?=$arImage["SRC"]?>" alt="<?=$alt;?>" title="<?=$title;?>" />
											<?}?>
										</div>
									<?endforeach;?>
								<?endif;?>
							</div>
						<?endif;?>
						<?if($arResult['PROPERTIES']['POPUP_VIDEO']['VALUE']):?>
							<div class="video-block popup_video <?=($countPhoto > 4 ? 'fromtop' : '');?> sm"><a class="various video_link image dark_link" href="<?=$arResult['PROPERTIES']['POPUP_VIDEO']['VALUE'];?>" title="<?=Loc::getMessage("VIDEO")?>"><span class="play text-upper font_xs"><?=Loc::getMessage("VIDEO")?></span></a></div>
						<?endif;?>
					<?else:?>
						<div class="product-detail-gallery__slider owl-carousel owl-theme thmb<?=($bVertical ? ' product-detail-gallery__slider--vertical' : '');?>" data-size="<?=$countPhoto;?>" data-plugin-options='{"items": "4", "nav": true, "loop": false, "clickTo": ".product-detail-gallery__slider.big", "dots": false, "autoWidth": true, "margin": 10<?//if($bVertical):?>, "mouseDrag": false, "pullDrag": false<?//endif;?><?if($bMagnifier):?>, "magnifier": true<?endif;?>}' style="max-width:<?=ceil((($countPhoto <= 4 ? $countPhoto : 4) * 70) - 10)?>px;">
						</div>
					<?endif;?>
				</div>
			</div>
		</div>
	</div>


	<div class="right_info">
		<div class="info_item hidden-md hidden-lg">



			<?ob_start()?>
				<?$bShowMoreLink = ($iCountProps > $arParams['VISIBLE_PROP_COUNT']);?>
				<?if( ($arResult['DISPLAY_PROPERTIES'] || $arResult['DISPLAY_PROPERTIES_OFFERS']) && $arParams['VISIBLE_PROP_COUNT'] > 0 ):?>
					<div class="char-side">
						<div class="char-side__title font_sm darken"><?=($arParams["T_CHARACTERISTICS"] ? $arParams["T_CHARACTERISTICS"] : Loc::getMessage("T_CHARACTERISTICS"));?></div>
						<div class="properties list">
							<div class="properties__container properties">
								<?$j=0;?>
								<?foreach($arResult['DISPLAY_PROPERTIES'] as $arProp):?>
									<?if($j<$arParams['VISIBLE_PROP_COUNT']):?>
										<div class="properties__item properties__item--compact font_xs">
											<div class="properties__title muted properties__item--inline">
												<?=$arProp['NAME']?>
												<?if($arProp["HINT"] && $arParams["SHOW_HINTS"]=="Y"):?>
													<div class="hint">
														<span class="icon colored_theme_hover_bg"><i>?</i></span>
														<div class="tooltip"><?=$arProp["HINT"]?></div>
													</div>
												<?endif;?>
											</div>
											<div class="properties__hr muted properties__item--inline">&mdash;</div>
											<div class="properties__value darken properties__item--inline">
												<?if(count($arProp["DISPLAY_VALUE"]) > 1):?>
													<?=implode(', ', $arProp["DISPLAY_VALUE"]);?>
												<?else:?>
													<?=$arProp["DISPLAY_VALUE"];?>
												<?endif;?>
											</div>
										</div>
									<?endif;?>
									<?$j++;?>
								<?endforeach;?>
							</div>
							<div class="properties__container properties js-offers-props"></div>
						</div>
						<?if($bShowMoreLink):?>
							<div class="more-char-link"><span class="choise colored_theme_text_with_hover font_sxs dotted" data-block=".js-scrolled"><?=Loc::getMessage('ALL_CHARS');?></span></div>
						<?endif;?>
					</div>
				<?endif;?>
			<?$productProps = ob_get_clean();?>


			<div class="main_item_wrapper js-offers-calc product-action">
				<?$frame = $this->createFrame()->begin('');?>
					<div class="prices_block">
						<?ob_start()?>
							<?if($bComplect):?>
		
							<?else:?>
		
								<h1 class="card__main-title"><?=CMax::formatJsName($arResult["NAME"]);?></h1>
								<p class="card__main-subtitle">Артикул: <?=$arResult['PROPERTIES']['CML2_ARTICLE']['VALUE']?></p>

								<div class="product-info-headnote__rating">
									
										<div class="rating">
			
												<div class="blog-info__rating--top-info pointer">
													<div class="votes_block nstar with-text" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
														<meta itemprop="ratingValue" content="<?=($arResult['PROPERTIES']['EXTENDED_REVIEWS_RAITING']['VALUE'] ? $arResult['PROPERTIES']['EXTENDED_REVIEWS_RAITING']['VALUE'] : 5)?>" />
														<meta itemprop="reviewCount" content="<?=(intval($arResult['PROPERTIES']['EXTENDED_REVIEWS_COUNT']['VALUE']) ? intval($arResult['PROPERTIES']['EXTENDED_REVIEWS_COUNT']['VALUE']) : 1)?>" />
														<meta itemprop="bestRating" content="5" />
														<meta itemprop="worstRating" content="0" />
														<div class="ratings">
															<?$message = $arResult['PROPERTIES']['EXTENDED_REVIEWS_COUNT']['VALUE'] ? GetMessage('VOTES_RESULT', array('#VALUE#' => $arResult['PROPERTIES']['EXTENDED_REVIEWS_RAITING']['VALUE'])) : GetMessage('VOTES_RESULT_NONE')?>
															<div class="inner_rating" title="<?=$message?>">
																<?for($i=1;$i<=5;$i++):?>
																	<div class="item-rating <?=$i<=$arResult['PROPERTIES']['EXTENDED_REVIEWS_RAITING']['VALUE'] ? 'filed' : ''?>"><?=CMax::showIconSvg("star", SITE_TEMPLATE_PATH."/images/svg/catalog/star_small.svg");?></div>
																<?endfor;?>
															</div>

														</div>
													</div>
													<?if($arResult['PROPERTIES']['EXTENDED_REVIEWS_COUNT']['VALUE']):?>
														<span class="font_sxs">(<?=$arResult['PROPERTIES']['EXTENDED_REVIEWS_COUNT']['VALUE']?>)</span>
													<?endif;?>
												</div>

						<div style="display: flex;">

							<div class="compare_item_button" style="margin-right: 10px;cursor: pointer;">
                                <span class="compare_item to rounded3 carousel-2__footer-compare" data-iblock="55" data-item="<?=$arResult["ID"]?>" tabindex="0">
                                    <svg width="25" height="25" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.80277 3.37222C7.74959 3.37222 8.60724 3.75645 9.22814 4.37736L7.4889 6.11664H11.6055V2L10.199 3.40651C9.33109 2.5386 8.13038 2 6.80277 2C4.38424 2 2.38767 3.79074 2.05493 6.11664H3.44086C3.7599 4.55232 5.14241 3.37222 6.80277 3.37222Z" fill="#9D9D9D"></path>
                                    <path d="M10.6724 9.6402C11.1286 9.01926 11.4374 8.28515 11.5506 7.48926H10.1647C9.84564 9.05358 8.46312 10.2337 6.80273 10.2337C5.85591 10.2337 4.99826 9.84944 4.37736 9.22854L6.11664 7.48926H2V11.6059L3.40651 10.1994C4.27444 11.0673 5.47512 11.6059 6.80273 11.6059C7.86621 11.6059 8.84732 11.256 9.64321 10.6694L12.9777 14.0004L14 12.9781L10.6724 9.6402Z" fill="#9D9D9D"></path>
                                    </svg>
                                </span>
                                <span class="compare_item in added rounded3 carousel-2__footer-compare" style="display: none;" data-iblock="55" data-item="<?=$arResult["ID"]?>" tabindex="0" >
                                    <svg width="25" height="25" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.80277 3.37222C7.74959 3.37222 8.60724 3.75645 9.22814 4.37736L7.4889 6.11664H11.6055V2L10.199 3.40651C9.33109 2.5386 8.13038 2 6.80277 2C4.38424 2 2.38767 3.79074 2.05493 6.11664H3.44086C3.7599 4.55232 5.14241 3.37222 6.80277 3.37222Z" fill="#ff0000"></path>
                                    <path d="M10.6724 9.6402C11.1286 9.01926 11.4374 8.28515 11.5506 7.48926H10.1647C9.84564 9.05358 8.46312 10.2337 6.80273 10.2337C5.85591 10.2337 4.99826 9.84944 4.37736 9.22854L6.11664 7.48926H2V11.6059L3.40651 10.1994C4.27444 11.0673 5.47512 11.6059 6.80273 11.6059C7.86621 11.6059 8.84732 11.256 9.64321 10.6694L12.9777 14.0004L14 12.9781L10.6724 9.6402Z" fill="#ff0000"></path>
                                    </svg>
                                </span>
                			</div>	
                			<div class="wish_item_button" style="cursor: pointer;">
                                <span data-quantity="1" class="wish_item to rounded3 carousel-2__footer-fav" data-item="<?=$arResult["ID"]?>" data-iblock="55">
                                     <svg width="25" height="25" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.09003 11.24C2.69003 11.24 2.31003 11.06 2.04003 10.76C1.78003 10.45 1.67003 10.05 1.73003 9.65L2.13003 7.29L0.420029 5.61C0.230029 5.43 0.0900293 5.19 0.0300293 4.93C-0.0199707 4.69 -0.0099707 4.44 0.0600293 4.2C0.140029 3.97 0.270029 3.76 0.460029 3.59C0.660029 3.41 0.900029 3.3 1.17003 3.26L3.54003 2.91L4.59003 0.76C4.71003 0.52 4.89003 0.32 5.12003 0.19C5.33003 0.07 5.57003 0 5.82003 0C6.07003 0 6.31003 0.06 6.52003 0.19C6.75003 0.33 6.93003 0.52 7.05003 0.76L8.12003 2.9L10.49 3.24C10.75 3.28 11 3.39 11.2 3.56C11.39 3.72 11.52 3.93 11.6 4.16C11.68 4.4 11.69 4.65 11.64 4.89C11.58 5.15 11.45 5.38 11.26 5.57L9.55003 7.25L9.96003 9.61C10.03 10.01 9.92003 10.42 9.66003 10.73C9.40003 11.04 9.02003 11.22 8.61003 11.22C8.39003 11.22 8.17003 11.17 7.97003 11.07L5.85003 9.96L3.73003 11.08C3.54003 11.18 3.32003 11.24 3.09003 11.24ZM4.60003 3.91C4.52003 4.08 4.35003 4.2 4.16003 4.23L1.37003 4.65L3.41003 6.58C3.55003 6.71 3.61003 6.91 3.58003 7.1L3.11003 9.87L5.57003 8.53C5.66003 8.49 5.75003 8.46 5.84003 8.46C5.93003 8.46 6.03003 8.48 6.11003 8.53L8.61003 9.83L8.10003 7.07C8.07003 6.89 8.14003 6.69 8.27003 6.56L10.28 4.58L7.50003 4.22C7.31003 4.19 7.15003 4.07 7.06003 3.9L5.82003 1.41L4.60003 3.91Z" fill="#FCB500"></path>
                                  </svg>
                                </span>

                                <span data-quantity="1" class="wish_item in added rounded3 carousel-2__footer-fav" style="display: none;" data-item="<?=$arResult["ID"]?>" data-iblock="55">
                                    <svg width="25" height="25" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.09003 11.24C2.69003 11.24 2.31003 11.06 2.04003 10.76C1.78003 10.45 1.67003 10.05 1.73003 9.65L2.13003 7.29L0.420029 5.61C0.230029 5.43 0.0900293 5.19 0.0300293 4.93C-0.0199707 4.69 -0.0099707 4.44 0.0600293 4.2C0.140029 3.97 0.270029 3.76 0.460029 3.59C0.660029 3.41 0.900029 3.3 1.17003 3.26L3.54003 2.91L4.59003 0.76C4.71003 0.52 4.89003 0.32 5.12003 0.19C5.33003 0.07 5.57003 0 5.82003 0C6.07003 0 6.31003 0.06 6.52003 0.19C6.75003 0.33 6.93003 0.52 7.05003 0.76L8.12003 2.9L10.49 3.24C10.75 3.28 11 3.39 11.2 3.56C11.39 3.72 11.52 3.93 11.6 4.16C11.68 4.4 11.69 4.65 11.64 4.89C11.58 5.15 11.45 5.38 11.26 5.57L9.55003 7.25L9.96003 9.61C10.03 10.01 9.92003 10.42 9.66003 10.73C9.40003 11.04 9.02003 11.22 8.61003 11.22C8.39003 11.22 8.17003 11.17 7.97003 11.07L5.85003 9.96L3.73003 11.08C3.54003 11.18 3.32003 11.24 3.09003 11.24ZM4.60003 3.91C4.52003 4.08 4.35003 4.2 4.16003 4.23L1.37003 4.65L3.41003 6.58C3.55003 6.71 3.61003 6.91 3.58003 7.1L3.11003 9.87L5.57003 8.53C5.66003 8.49 5.75003 8.46 5.84003 8.46C5.93003 8.46 6.03003 8.48 6.11003 8.53L8.61003 9.83L8.10003 7.07C8.07003 6.89 8.14003 6.69 8.27003 6.56L10.28 4.58L7.50003 4.22C7.31003 4.19 7.15003 4.07 7.06003 3.9L5.82003 1.41L4.60003 3.91Z" fill="#ff0000"></path>
                                  </svg>
                                </span>
                                </div>
                            </div>


										</div>
								
								</div>
									
		
						


								<div class="card__main-price">

									<?if($arResult['PRICES']['BASE']['VALUE_VAT'] != $arResult['PRICES']['BASE']['ROUND_VALUE_VAT']):?>
								  		<div class="card__main-price-old"><?=$arResult['PRICES']['BASE']['PRINT_VALUE_VAT']?></div>
								  	<?endif;?>	
								  	<div class="card__main-price-current"><?=$arResult['PRICES']['BASE']['PRINT_DISCOUNT_VALUE_NOVAT']?></div>
								</div>


		
	
						<?endif;?>				
						<?$productPrice = ob_get_clean();?>

						<?//prices?>
						<?$this->SetViewTarget('PRODUCT_SIDE_INFO', 300);?>
							<?=$productPrice;?>
						<?$this->EndViewTarget();?>

					</div>
					
					<?if(!$bComplect):?>
						<?//buttons?>
						<?$this->SetViewTarget('PRODUCT_SIDE_INFO', 500);?>
							<div class="js-prices-in-side product-action">
								<div class="buy_block">
									<?if($arResult["OFFERS"] && $showCustomOffer):?>
										<div class="sku_props">
											<?if (!empty($arResult['OFFERS_PROP'])){?>
												<div class="bx_catalog_item_scu wrapper_sku" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PROP_DIV']; ?>">
													<?foreach ($arSkuTemplate as $code => $strTemplate){
														if (!isset($arResult['OFFERS_PROP'][$code]))
															continue;
														echo str_replace('#ITEM#_prop_', $arItemIDs["ALL_ITEM_IDS"]['PROP'], $strTemplate);
													}?>
												</div>
											<?}?>
											<?$arItemJSParams=CMax::GetSKUJSParams($arResult, $arParams, $arResult, "Y");?>
											<script type="text/javascript">
												var <? echo $arItemIDs["strObName"]; ?> = new JCCatalogElement(<? echo CUtil::PhpToJSObject($arItemJSParams, false, true); ?>);
											</script>
										</div>
									<?endif;?>
									<?if($arResult["SIZE_PATH"]):?>
										<div class="table_sizes muted777 font_xs">
											<span>
												<?=CMax::showIconSvg("cheaper", SITE_TEMPLATE_PATH.'/images/svg/catalog/sizestable.svg', '', '', true, false);?>
												<span class="animate-load dotted" data-event="jqm" data-param-form_id="TABLES_SIZE" data-param-url="<?=$arResult["SIZE_PATH"];?>" data-name="TABLES_SIZE"><?=GetMessage("TABLES_SIZE");?></span>
											</span>
										</div>
									<?endif;?>
									<?if(!$arResult["OFFERS"]):?>
										<div class="counter_wrapp list big clearfix ">
								
											<div id="<?=$arItemIDs["ALL_ITEM_IDS"]['BASKET_ACTIONS']?>">

												<span data-value="<?=$arResult['PRICES']['BASE']['DISCOUNT_VALUE_VAT']?>" data-currency="RUB" class="card__main-buy btn-1 to-cart" data-item="<?=$arResult['ID']?>" data-float_ratio="" data-ratio="1" data-bakset_div="bx_basket_div_<?=$arResult['ID']?>" data-props="" data-part_props="N" data-add_props="Y" data-empty_props="Y" data-offers="" data-iblockid="55" data-quantity="1">
													<span>В корзину</span>
												</span>

												<a rel="nofollow" href="/basket/" class="card__main-buy btn-1 in-cart has-ripple" data-item="<?=$arResult['ID']?>" style="display:none;">
												<span>В корзине</span>
												</a>

											</div>


												<?=\Aspro\Functions\CAsproMax::showItemCounter($arAddToBasketData, $arResult["ID"], $arItemIDs, $arParams, 'md', '', true, true);?>
										</div>


										<span class="card__main-consult" data-event="jqm" data-param-form_id="CALLBACK" data-name="callback">Получить консультацию</span>




										<?if(isset($arResult['PRICE_MATRIX']) && $arResult['PRICE_MATRIX']) // USE_PRICE_COUNT
										{?>
											<?if($arResult['ITEM_PRICE_MODE'] == 'Q' && count($arResult['PRICE_MATRIX']['ROWS']) > 1):?>
												<?$arOnlyItemJSParams = array(
													"ITEM_PRICES" => $arResult["ITEM_PRICES"],
													"ITEM_PRICE_MODE" => $arResult["ITEM_PRICE_MODE"],
													"ITEM_QUANTITY_RANGES" => $arResult["ITEM_QUANTITY_RANGES"],
													"MIN_QUANTITY_BUY" => $arAddToBasketData["MIN_QUANTITY_BUY"],
													"SHOW_DISCOUNT_PERCENT_NUMBER" => $arParams["SHOW_DISCOUNT_PERCENT_NUMBER"],
													"ID" => $arItemIDs["strMainID"],
												)?>
												<script type="text/javascript">
													var <? echo $arItemIDs["strObName"]; ?>el = new JCCatalogOnlyElement(<? echo CUtil::PhpToJSObject($arOnlyItemJSParams, false, true); ?>);
												</script>
											<?endif;?>
										<?}?>
										<?if($arAddToBasketData["ACTION"] !== "NOTHING"):?>
											<?=\Aspro\Functions\CAsproMax::showItemOCB($arAddToBasketData, $arResult, $arParams, false, '');?>
										<?endif;?>
									<?elseif($arResult["OFFERS"] && $arParams['TYPE_SKU'] == 'TYPE_1'):?>
										<div class="offer_buy_block buys_wrapp" style="display:none;">
											<div class="counter_wrapp list clearfix"></div>
										</div>
									<?elseif($arResult["OFFERS"] && $arParams['TYPE_SKU'] != 'TYPE_1'):?>
										<span class="btn btn-default btn-lg slide_offer type_block"><i></i><span><?=\Bitrix\Main\Config\Option::get("aspro.max", "EXPRESSION_READ_MORE_OFFERS_DEFAULT", GetMessage("MORE_TEXT_BOTTOM"));?></span></span>
									<?endif;?>
								</div>
							</div>
						<?$this->EndViewTarget();?>
					<?endif;?>
					<div class="adaptive-block">
						<?=$productDiscount;?>
						<?=$productPrice;?>
						<?$productForms = str_replace(' id=', ' data-id=', $productForms);?>
						<?=$productForms;?>

						<div class="" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
							<meta itemprop="price" content="<?=($arResult['MIN_PRICE']['DISCOUNT_VALUE'] ? $arResult['MIN_PRICE']['DISCOUNT_VALUE'] : $arResult['MIN_PRICE']['VALUE'])?>" />
							<meta itemprop="priceCurrency" content="<?=$arResult['MIN_PRICE']['CURRENCY']?>" />
							<link itemprop="availability" href="http://schema.org/<?=($templateData['TOTAL_COUNT'] ? 'InStock' : 'OutOfStock')?>" />
							<?
							if($arDiscount["ACTIVE_TO"]){?>
								<meta itemprop="priceValidUntil" content="<?=date("Y-m-d", MakeTimeStamp($arDiscount["ACTIVE_TO"]))?>" />
							<?}?>
							<link itemprop="url" href="<?=$arResult["DETAIL_PAGE_URL"]?>" />
						</div>

						<div class="js-prices-in-item"></div>
						<div class="js-services-in-item"></div>

						<?=$productCalcDelivery;?>
						<?=$sendGiftForm;?>
						<?=$productHelpText;?>
						<?=$productProps;?>
					</div>

				<?$frame->end();?>
			</div>

			<?//delivery calculate?>
			<?if(
				(
					!$arResult["OFFERS"] &&
					$arAddToBasketData["ACTION"] == "ADD" &&
					$arAddToBasketData["CAN_BUY"] && 
					!$bComplect
				) ||
				(
					$arResult["OFFERS"] &&
					$arParams['TYPE_SKU'] === 'TYPE_1'
				)
			):?>
				<?$this->SetViewTarget('PRODUCT_SIDE_INFO', 600);?>
					<?=$productCalcDelivery;?>
				<?$this->EndViewTarget();?>
			<?endif;?>

			<?$this->SetViewTarget('PRODUCT_SIDE_INFO', 610);?>
				<?=$sendGiftForm;?>
			<?$this->EndViewTarget();?>

			<?//help text?>
			<?$this->SetViewTarget('PRODUCT_SIDE_INFO', 700);?>
				<?if($arResult['HELP_TEXT']):?>
					<?=$productHelpText;?>
				<?endif;?>
			<?$this->EndViewTarget();?>

			<?//props side?>
			<?$this->SetViewTarget('PRODUCT_SIDE_INFO', 750);?>
				<?=$productProps;?>
			<?$this->EndViewTarget();?>



			<?//brand?>
			<?$this->SetViewTarget('PRODUCT_SIDE_INFO', 900);?>
				<?if($arResult['BRAND_ITEM']):?>
					<div class="brand-detail">
						<div class="brand-detail-info bordered rounded3">
							<?if($arResult['BRAND_ITEM']["IMAGE"]):?>
								<div class="brand-detail-info__image"><a href="<?=$arResult['BRAND_ITEM']["DETAIL_PAGE_URL"];?>"><img src="<?=$arResult['BRAND_ITEM']["IMAGE"]["src"];?>" alt="<?=$arResult['BRAND_ITEM']["NAME"];?>" title="<?=$arResult['BRAND_ITEM']["NAME"];?>" itemprop="image"></a></div>
							<?endif;?>
							<div class="brand-detail-info__preview">
								<?if($arResult['BRAND_ITEM']["PREVIEW_TEXT"]):?>
									<div class="text muted777 font_xs"><?=$arResult['BRAND_ITEM']["PREVIEW_TEXT"];?></div>
								<?endif;?>
								<?if($arResult['SECTION']):?>
									<div class="link font_xs"><a href="<?= $arResult['BRAND_ITEM']['CATALOG_PAGE_URL'] ?>" target="_blank"><?=GetMessage("ITEMS_BY_SECTION")?></a></div>
								<?endif;?>
								<div class="link font_xs"><a href="<?=$arResult['BRAND_ITEM']["DETAIL_PAGE_URL"];?>" target="_blank"><?=GetMessage("ITEMS_BY_BRAND", array("#BRAND#" => $arResult['BRAND_ITEM']["NAME"]))?></a></div>
							</div>
						</div>
					</div>
				<?endif;?>
			<?$this->EndViewTarget();?>
		</div>
	</div>
	<?$bPriceCount = ($arParams['USE_PRICE_COUNT'] == 'Y');?>
	<?if($arResult['OFFERS']):?>
		<span itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer" style="display:none;">
			<meta itemprop="offerCount" content="<?=count($arResult['OFFERS'])?>" />
			<meta itemprop="lowPrice" content="<?=($arResult['MIN_PRICE']['DISCOUNT_VALUE'] ? $arResult['MIN_PRICE']['DISCOUNT_VALUE'] : $arResult['MIN_PRICE']['VALUE'] )?>" />
			<meta itemprop="highPrice" content="<?=($arResult['MAX_PRICE']['DISCOUNT_VALUE'] ? $arResult['MAX_PRICE']['DISCOUNT_VALUE'] : $arResult['MAX_PRICE']['VALUE'] )?>" />
			<meta itemprop="priceCurrency" content="<?=$arResult['MIN_PRICE']['CURRENCY']?>" />
			<?foreach($arResult['OFFERS'] as $arOffer):?>
				<?$currentOffersList = array();?>
				<?foreach($arOffer['TREE'] as $propName => $skuId):?>
					<?$propId = (int)substr($propName, 5);?>
					<?foreach($arResult['SKU_PROPS'] as $prop):?>
						<?if($prop['ID'] == $propId):?>
							<?foreach($prop['VALUES'] as $propId => $propValue):?>
								<?if($propId == $skuId):?>
									<?$currentOffersList[] = $propValue['NAME'];?>
									<?break;?>
								<?endif;?>
							<?endforeach;?>
						<?endif;?>
					<?endforeach;?>
				<?endforeach;?>
				<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
					<meta itemprop="sku" content="<?=implode('/', $currentOffersList)?>" />
					<a href="<?=$arOffer['DETAIL_PAGE_URL']?>" itemprop="url"></a>
					<meta itemprop="price" content="<?=($arOffer['MIN_PRICE']['DISCOUNT_VALUE']) ? $arOffer['MIN_PRICE']['DISCOUNT_VALUE'] : $arOffer['MIN_PRICE']['VALUE']?>" />
					<meta itemprop="priceCurrency" content="<?=$arOffer['MIN_PRICE']['CURRENCY']?>" />
					<link itemprop="availability" href="http://schema.org/<?=($arOffer['CAN_BUY'] ? 'InStock' : 'OutOfStock')?>" />
					<?
					if($arDiscount["ACTIVE_TO"]){?>
						<meta itemprop="priceValidUntil" content="<?=date("Y-m-d", MakeTimeStamp($arDiscount["ACTIVE_TO"]))?>" />
					<?}?>
				</span>
			<?endforeach;?>
		</span>
		<?unset($arOffer, $currentOffersList);?>
	<?else:?>
		<?if(!$bPriceCount):?>
			<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
				<meta itemprop="price" content="<?=($arResult['MIN_PRICE']['DISCOUNT_VALUE'] ? $arResult['MIN_PRICE']['DISCOUNT_VALUE'] : $arResult['MIN_PRICE']['VALUE'])?>" />
				<meta itemprop="priceCurrency" content="<?=$arResult['MIN_PRICE']['CURRENCY']?>" />
				<link itemprop="availability" href="http://schema.org/<?=($arResult['MIN_PRICE']['CAN_BUY'] ? 'InStock' : 'OutOfStock')?>" />
				<?
				if($arDiscount["ACTIVE_TO"]){?>
					<meta itemprop="priceValidUntil" content="<?=date("Y-m-d", MakeTimeStamp($arDiscount["ACTIVE_TO"]))?>" />
				<?}?>
				<link itemprop="url" href="<?=$arResult["DETAIL_PAGE_URL"]?>" />
			</span>
		<?endif;?>
	<?endif;?>
	<script type="text/javascript">
		BX.message({
			QUANTITY_AVAILIABLE: '<? echo COption::GetOptionString("aspro.max", "EXPRESSION_FOR_EXISTS", GetMessage("EXPRESSION_FOR_EXISTS_DEFAULT"), SITE_ID); ?>',
			QUANTITY_NOT_AVAILIABLE: '<? echo COption::GetOptionString("aspro.max", "EXPRESSION_FOR_NOTEXISTS", GetMessage("EXPRESSION_FOR_NOTEXISTS"), SITE_ID); ?>',
			ADD_ERROR_BASKET: '<? echo GetMessage("ADD_ERROR_BASKET"); ?>',
			ADD_ERROR_COMPARE: '<? echo GetMessage("ADD_ERROR_COMPARE"); ?>',
			ONE_CLICK_BUY: '<? echo GetMessage("ONE_CLICK_BUY"); ?>',
			MORE_TEXT_BOTTOM: '<?=\Bitrix\Main\Config\Option::get("aspro.max", "EXPRESSION_READ_MORE_OFFERS_DEFAULT", GetMessage("MORE_TEXT_BOTTOM"));?>',
			TYPE_SKU: '<? echo $arParams['TYPE_SKU']; ?>',
			HAS_SKU_PROPS: '<? echo ($arResult['OFFERS_PROP'] ? 'Y' : 'N'); ?>',
			SITE_ID: '<? echo SITE_ID; ?>'
		})
	</script>
</div>



<?//additional gallery?>
<?if($arResult['ADDITIONAL_GALLERY']):?>
	<?$bShowSmallGallery = $arParams['ADDITIONAL_GALLERY_TYPE'] === 'SMALL';?>
	<?$templateData['ADDITIONAL_GALLERY'] = true;?>
	<?$this->SetViewTarget('PRODUCT_ADDITIONAL_GALLERY_INFO');?>
		<div class="ordered-block">
			<div class="additional-gallery <?=($arResult['OFFERS'] && 'TYPE_1' === $arParams['TYPE_SKU'] ? ' hidden' : '')?>">
				<div class="ordered-block__title font_lg option-font-bold">
					<?=$arParams['BLOCK_ADDITIONAL_GALLERY_NAME'];?>
				</div>
				<?//switch gallery?>
				<div class="switch-item-block">
					<div class="flexbox flexbox--row">
						<div class="switch-item-block__count muted777 font_xs">
							<div class="switch-item-block__count-wrapper switch-item-block__count-wrapper--small" <?=($bShowSmallGallery ? "" : "style='display:none;'");?>>
								<span class="switch-item-block__count-value"><?=count($arResult['ADDITIONAL_GALLERY']);?></span>
								<?=Loc::getMessage('PHOTO');?>
								<span class="switch-item-block__count-separate">&mdash;</span>
							</div>
							<div class="switch-item-block__count-wrapper switch-item-block__count-wrapper--big" <?=($bShowSmallGallery ? "style='display:none;'" : "");?>>
								<span class="switch-item-block__count-value">1/<?=count($arResult['ADDITIONAL_GALLERY']);?></span>
								<span class="switch-item-block__count-separate">&mdash;</span>
							</div>
						</div>
						<div class="switch-item-block__icons-wrapper">
							<span class="switch-item-block__icons<?=(!$bShowSmallGallery ? ' active' : '');?> switch-item-block__icons--big" title="<?=Loc::getMessage("BIG_GALLERY");?>"><?=CMax::showIconSvg("gallery", SITE_TEMPLATE_PATH."/images/svg/gallery_alone.svg", "", "colored_theme_hover_bg-el-svg", true, false);?></span>
							<span class="switch-item-block__icons<?=($bShowSmallGallery ? ' active' : '');?> switch-item-block__icons--small" title="<?=Loc::getMessage("SMALL_GALLERY");?>"><?=CMax::showIconSvg("gallery", SITE_TEMPLATE_PATH."/images/svg/gallery_list.svg", "", "colored_theme_hover_bg-el-svg", true, false);?></span>
						</div>
					</div>
				</div>

				<?//big gallery?>
				<div class="big-gallery-block"<?=($bShowSmallGallery ? ' style="display:none;"' : '');?> >
					<div class="owl-carousel owl-theme owl-bg-nav short-nav" data-plugin-options='{"items": "1", "autoplay" : false, "autoplayTimeout" : "3000", "smartSpeed":1000, "dots": true, "nav": true, "loop": false, "index": true, "margin": 5}'>
						<?foreach($arResult['ADDITIONAL_GALLERY'] as $i => $arPhoto):?>
							<div class="item">
								<a href="<?=$arPhoto['DETAIL']['SRC']?>" class="fancy" data-fancybox="big-gallery" target="_blank" title="<?=$arPhoto['TITLE']?>">
									<img data-src="<?=$arPhoto['PREVIEW']['src']?>" src="<?=\Aspro\Functions\CAsproMax::showBlankImg($arPhoto['PREVIEW']['src']);?>" class="img-responsive inline lazy" title="<?=$arPhoto['TITLE']?>" alt="<?=$arPhoto['ALT']?>" />
								</a>
							</div>
						<?endforeach;?>
					</div>
				</div>

				<?//small gallery?>
				<div class="small-gallery-block"<?=($bShowSmallGallery ? '' : ' style="display:none;"');?>>
					<div class="row flexbox flexbox--row">
						<?foreach($arResult['ADDITIONAL_GALLERY'] as $i => $arPhoto):?>
							<div class="col-md-3 col-sm-4 col-xs-6">
								<div class="item">
									<div class="wrap"><a href="<?=$arPhoto['DETAIL']['SRC']?>" class="fancy" data-fancybox="small-gallery" target="_blank" title="<?=$arPhoto['TITLE']?>">
										<img data-src="<?=$arPhoto['PREVIEW']['src']?>" src="<?=\Aspro\Functions\CAsproMax::showBlankImg($arPhoto['PREVIEW']['src']);?>" class="lazy img-responsive inline" title="<?=$arPhoto['TITLE']?>" alt="<?=$arPhoto['ALT']?>" /></a>
									</div>
								</div>
							</div>
						<?endforeach;?>
					</div>
				</div>
			</div>
		</div>
	<?$this->EndViewTarget();?>
<?endif;?>


<?if($arParams["SHOW_HOW_BUY"] == "Y"):?>
	<?$this->SetViewTarget('PRODUCT_HOW_BUY_INFO');?>
		<?$APPLICATION->IncludeFile(SITE_DIR."include/tab_catalog_detail_howbuy.php", array(), array("MODE" => "html", "NAME" => GetMessage('TITLE_HOW_BUY')));?>
	<?$this->EndViewTarget();?>
<?endif;?>

<?//detail description?>
<?if($arResult['DETAIL_TEXT']):?>
	<?$templateData['DETAIL_TEXT'] = true;?>
	<?$this->SetViewTarget('PRODUCT_DETAIL_TEXT_INFO');?>
		<div class="content" itemprop="description">
			<?=$arResult['DETAIL_TEXT'];?>
		</div>
	<?$this->EndViewTarget();?>
<?endif;?>

<?//props content?>
<?if(($arResult['DISPLAY_PROPERTIES'] || $arResult['DISPLAY_PROPERTIES_OFFERS']) && ($iCountProps > $arParams['VISIBLE_PROP_COUNT'])):?>
	<?$templateData['CHARACTERISTICS'] = true;?>
	<?$this->SetViewTarget('PRODUCT_PROPS_INFO');?>
		<?$strGrupperType = $arParams["GRUPPER_PROPS"];?>
		<?if($strGrupperType == "GRUPPER"):?>
			<div class="char_block bordered rounded3 js-scrolled">
				<?$APPLICATION->IncludeComponent(
					"redsign:grupper.list",
					"",
					Array(
						"CACHE_TIME" => "3600000",
						"CACHE_TYPE" => "A",
						"COMPOSITE_FRAME_MODE" => "A",
						"COMPOSITE_FRAME_TYPE" => "AUTO",
						"DISPLAY_PROPERTIES" => $arResult["GROUPS_PROPS"]
					),
					$component, array('HIDE_ICONS'=>'Y')
				);?>
				<table class="props_list" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['DISPLAY_PROP_DIV']; ?>"></table>
			</div>
		<?elseif($strGrupperType == "WEBDEBUG"):?>
			<div class="char_block bordered rounded3 js-scrolled">
				<?$APPLICATION->IncludeComponent(
					"webdebug:propsorter",
					"linear",
					array(
						"IBLOCK_TYPE" => $arResult['IBLOCK_TYPE'],
						"IBLOCK_ID" => $arResult['IBLOCK_ID'],
						"PROPERTIES" => $arResult['GROUPS_PROPS'],
						"EXCLUDE_PROPERTIES" => array(),
						"WARNING_IF_EMPTY" => "N",
						"WARNING_IF_EMPTY_TEXT" => "",
						"NOGROUP_SHOW" => "Y",
						"NOGROUP_NAME" => "",
						"MULTIPLE_SEPARATOR" => ", "
					),
					$component, array('HIDE_ICONS'=>'Y')
				);?>
				<table class="props_list" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['DISPLAY_PROP_DIV']; ?>"></table>
			</div>
		<?elseif($strGrupperType == "YENISITE_GRUPPER"):?>
			<div class="char_block bordered rounded3 js-scrolled">
				<?$APPLICATION->IncludeComponent(
					'yenisite:ipep.props_groups',
					'',
					array(
						'DISPLAY_PROPERTIES' => $arResult['GROUPS_PROPS'],
						'IBLOCK_ID' => $arParams['IBLOCK_ID']
					),
					$component, array('HIDE_ICONS'=>'Y')
				)?>
				<table class="props_list colored_char" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['DISPLAY_PROP_DIV']; ?>"></table>
			</div>
		<?else:?>
			<?if($arParams["PROPERTIES_DISPLAY_TYPE"] != "TABLE"):?>
				<div class="props_block js-scrolled clearfix flexbox row" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['DISPLAY_PROP_DIV']; ?>">
					<?foreach($arResult["DISPLAY_PROPERTIES"] as $propCode => $arProp):?>
						<div class="char col-lg-3 col-md-4 col-xs-6 bordered" itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
							<div class="char_name">
								<div class="props_item muted <?if($arProp["HINT"] && $arParams["SHOW_HINTS"] == "Y"){?>whint<?}?>">
									<span itemprop="name"><?=$arProp["NAME"]?></span>
								</div>
								<?if($arProp["HINT"] && $arParams["SHOW_HINTS"]=="Y"):?><div class="hint"><span class="icon"><i>?</i></span><div class="tooltip"><?=$arProp["HINT"]?></div></div><?endif;?>
							</div>
							<div class="char_value darken" itemprop="value">
								<?if(count($arProp["DISPLAY_VALUE"]) > 1):?>
									<?=implode(', ', $arProp["DISPLAY_VALUE"]);?>
								<?else:?>
									<?=$arProp["DISPLAY_VALUE"];?>
								<?endif;?>
							</div>
						</div>
					<?endforeach;?>
				</div>
			<?else:?>
				<div class="char_block bordered rounded3 js-scrolled">
					<table class="props_list nbg">
						<?foreach($arResult["DISPLAY_PROPERTIES"] as $arProp):?>
							<tr itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
								<td class="char_name">
									<div class="props_item <?if($arProp["HINT"] && $arParams["SHOW_HINTS"] == "Y"){?>whint<?}?>">
										<span itemprop="name"><?=$arProp["NAME"]?></span>
										<?if($arProp["HINT"] && $arParams["SHOW_HINTS"]=="Y"):?><div class="hint"><span class="icon"><i>?</i></span><div class="tooltip"><?=$arProp["HINT"]?></div></div><?endif;?>
									</div>
								</td>
								<td class="char_value">
									<span itemprop="value">
										<?if(count($arProp["DISPLAY_VALUE"]) > 1):?>
											<?=implode(', ', $arProp["DISPLAY_VALUE"]);?>
										<?else:?>
											<?=$arProp["DISPLAY_VALUE"];?>
										<?endif;?>
									</span>
								</td>
							</tr>
						<?endforeach;?>
					</table>
					<table class="props_list nbg" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['DISPLAY_PROP_DIV']; ?>"></table>
				</div>
			<?endif;?>
		<?endif;?>
	<?$this->EndViewTarget();?>
<?endif;?>


<?if($arParams["SHOW_PAYMENT"] == "Y"):?>
	<?$this->SetViewTarget('PRODUCT_PAYMENT_INFO');?>
		<?$APPLICATION->IncludeFile(SITE_DIR."include/tab_catalog_detail_payment.php", array(), array("MODE" => "html", "NAME" => GetMessage('TITLE_PAYMENT')));?>
	<?$this->EndViewTarget();?>
<?endif;?>

<?if($arParams["SHOW_DELIVERY"] == "Y"):?>
	<?$this->SetViewTarget('PRODUCT_DELIVERY_INFO');?>
		<?$APPLICATION->IncludeFile(SITE_DIR."include/tab_catalog_detail_delivery.php", array(), array("MODE" => "html", "NAME" => GetMessage('TITLE_DELIVERY')));?>
	<?$this->EndViewTarget();?>
<?endif;?>

<?if($arResult['VIDEO']):?>
	<?$this->SetViewTarget('PRODUCT_VIDEO_INFO');?>
		<div class="hidden_print">
			<div class="video_block row">
				<?if(count($arResult['VIDEO']) > 1):?>
					<?foreach($arResult['VIDEO'] as $v => $value):?>
						<div class="col-sm-6">
							<?=str_replace('src=', 'width="660" height="457" src=', str_replace(array('width', 'height'), array('data-width', 'data-height'), $value));?>
						</div>
					<?endforeach;?>
				<?else:?>
					<div class="col-md-12"><?=$arResult['VIDEO'][0]?></div>
				<?endif;?>
			</div>
		</div>
	<?$this->EndViewTarget();?>
<?endif;?>

<?//files?>
<?$instr_prop = ($arParams["DETAIL_DOCS_PROP"] ? $arParams["DETAIL_DOCS_PROP"] : "INSTRUCTIONS");?>
<?if((count($arResult["PROPERTIES"][$instr_prop]["VALUE"]) && is_array($arResult["PROPERTIES"][$instr_prop]["VALUE"])) || count($arResult["SECTION_FULL"]["UF_FILES"])):?>
	<?
	$arFiles = array();
	if($arResult["PROPERTIES"][$instr_prop]["VALUE"])
	{
		$arFiles = $arResult["PROPERTIES"][$instr_prop]["VALUE"];
	}
	else
	{
		$arFiles = $arResult["SECTION_FULL"]["UF_FILES"];
	}
	if(is_array($arFiles))
	{
		foreach($arFiles as $key => $value)
		{
			if(!intval($value))
			{
				unset($arFiles[$key]);
			}
		}
	}
	$templateData['FILES'] = $arFiles;
	if($arFiles):?>
		<?$this->SetViewTarget('PRODUCT_FILES_INFO');?>
			<div class="char_block rounded3 bordered files_block">
				<div class="row flexbox">
					<?foreach($arFiles as $arItem):?>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<?$arFile=CMax::GetFileInfo($arItem);?>
							<div class="file_type clearfix <?=$arFile["TYPE"];?>">
								<i class="icon"></i>
								<div class="description">
									<a target="_blank" href="<?=$arFile["SRC"];?>" class="dark_link font_sm"><?=$arFile["DESCRIPTION"];?></a>
									<span class="size font_xs muted">
										<?=$arFile["FILE_SIZE_FORMAT"];?>
									</span>
								</div>
							</div>
						</div>
					<?endforeach;?>
				</div>
			</div>
		<?$this->EndViewTarget();?>
	<?endif;?>
<?endif;?>

<?
if($arResult['CATALOG'] && $actualItem['CAN_BUY'] && $arParams['USE_PREDICTION'] === 'Y' && \Bitrix\Main\ModuleManager::isModuleInstalled('sale')){
	$APPLICATION->IncludeComponent(
		'bitrix:sale.prediction.product.detail',
		'main',
		array(
			'BUTTON_ID' => false,
			'CUSTOM_SITE_ID' => isset($arParams['CUSTOM_SITE_ID']) ? $arParams['CUSTOM_SITE_ID'] : null,
			'POTENTIAL_PRODUCT_TO_BUY' => array(
				'ID' => $arResult['ID'],
				'MODULE' => isset($arResult['MODULE']) ? $arResult['MODULE'] : 'catalog',
				'PRODUCT_PROVIDER_CLASS' => isset($arResult['PRODUCT_PROVIDER_CLASS']) ? $arResult['PRODUCT_PROVIDER_CLASS'] : 'CCatalogProductProvider',
				'QUANTITY' => isset($arResult['QUANTITY']) ? $arResult['QUANTITY'] : null,
				'IBLOCK_ID' => $arResult['IBLOCK_ID'],
				'PRIMARY_OFFER_ID' => isset($arResult['OFFERS'][0]['ID']) ? $arResult['OFFERS'][0]['ID'] : null,
				'SECTION' => array(
					'ID' => isset($arResult['SECTION']['ID']) ? $arResult['SECTION']['ID'] : null,
					'IBLOCK_ID' => isset($arResult['SECTION']['IBLOCK_ID']) ? $arResult['SECTION']['IBLOCK_ID'] : null,
					'LEFT_MARGIN' => isset($arResult['SECTION']['LEFT_MARGIN']) ? $arResult['SECTION']['LEFT_MARGIN'] : null,
					'RIGHT_MARGIN' => isset($arResult['SECTION']['RIGHT_MARGIN']) ? $arResult['SECTION']['RIGHT_MARGIN'] : null,
				),
			)
		),
		$component,
		array('HIDE_ICONS' => 'Y')
	);
}
?>
<?$this->SetViewTarget('PRODUCT_GIFT_INFO');?>
<div class="gifts">
<?if ($arResult['CATALOG'] && $arParams['USE_GIFTS_DETAIL'] == 'Y' && \Bitrix\Main\ModuleManager::isModuleInstalled("sale"))
{
	$APPLICATION->IncludeComponent("bitrix:sale.gift.product", "main", array(
			"USE_REGION" => $arParams['USE_REGION'] !== 'N' ? 'Y' : 'N',
			"STORES" => $arParams['STORES'],
			"SHOW_UNABLE_SKU_PROPS"=>$arParams["SHOW_UNABLE_SKU_PROPS"],
			'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
			'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
			'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE'],
			'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
			'SUBSCRIBE_URL_TEMPLATE' => $arResult['~SUBSCRIBE_URL_TEMPLATE'],
			'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
			"OFFER_HIDE_NAME_PROPS" => $arParams["OFFER_HIDE_NAME_PROPS"],

			"SHOW_DISCOUNT_PERCENT" => "N",
			"SHOW_OLD_PRICE" => $arParams['GIFTS_SHOW_OLD_PRICE'],
			"PAGE_ELEMENT_COUNT" => $arParams['GIFTS_DETAIL_PAGE_ELEMENT_COUNT'],
			"LINE_ELEMENT_COUNT" => $arParams['GIFTS_DETAIL_PAGE_ELEMENT_COUNT'],
			"HIDE_BLOCK_TITLE" => $arParams['GIFTS_DETAIL_HIDE_BLOCK_TITLE'],
			"BLOCK_TITLE" => $arParams['GIFTS_DETAIL_BLOCK_TITLE'],
			"TEXT_LABEL_GIFT" => $arParams['GIFTS_DETAIL_TEXT_LABEL_GIFT'],
			"SHOW_NAME" => $arParams['GIFTS_SHOW_NAME'],
			"SHOW_IMAGE" => $arParams['GIFTS_SHOW_IMAGE'],
			"MESS_BTN_BUY" => $arParams['GIFTS_MESS_BTN_BUY'],

			"SHOW_PRODUCTS_{$arParams['IBLOCK_ID']}" => "Y",
			"HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
			"PRODUCT_SUBSCRIPTION" => $arParams["PRODUCT_SUBSCRIPTION"],
			"MESS_BTN_DETAIL" => $arParams["MESS_BTN_DETAIL"],
			"MESS_BTN_SUBSCRIBE" => $arParams["MESS_BTN_SUBSCRIBE"],
			"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
			"PRICE_CODE" => $arParams["PRICE_CODE"],
			"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
			"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
			"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
			"CURRENCY_ID" => $arParams["CURRENCY_ID"],
			"BASKET_URL" => $arParams["BASKET_URL"],
			"ADD_PROPERTIES_TO_BASKET" => $arParams["ADD_PROPERTIES_TO_BASKET"],
			"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
			"PARTIAL_PRODUCT_PROPERTIES" => $arParams["PARTIAL_PRODUCT_PROPERTIES"],
			"USE_PRODUCT_QUANTITY" => 'N',
			"OFFER_TREE_PROPS_{$arResult['OFFERS_IBLOCK']}" => $arParams['OFFER_TREE_PROPS'],
			"CART_PROPERTIES_{$arResult['OFFERS_IBLOCK']}" => $arParams['OFFERS_CART_PROPERTIES'],
			"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"SHOW_DISCOUNT_TIME" => "N",
			"SHOW_ONE_CLICK_BUY" => "N",
			"SHOW_DISCOUNT_PERCENT_NUMBER" => "N",
			"SALE_STIKER" => $arParams["SALE_STIKER"],
			"STIKERS_PROP" => $arParams["STIKERS_PROP"],
			"SHOW_OLD_PRICE" => $arParams["SHOW_OLD_PRICE"],
			"SHOW_MEASURE" => $arParams["SHOW_MEASURE"],
			"DISPLAY_TYPE" => "block",
			"SHOW_RATING" => $arParams["SHOW_RATING"],
			"DISPLAY_COMPARE" => $arParams["DISPLAY_COMPARE"],
			"DISPLAY_WISH_BUTTONS" => $arParams["DISPLAY_WISH_BUTTONS"],
			"DEFAULT_COUNT" => $arParams["DEFAULT_COUNT"],
			"TYPE_SKU" => "Y",

			"POTENTIAL_PRODUCT_TO_BUY" => array(
				'ID' => isset($arResult['ID']) ? $arResult['ID'] : null,
				'MODULE' => isset($arResult['MODULE']) ? $arResult['MODULE'] : 'catalog',
				'PRODUCT_PROVIDER_CLASS' => isset($arResult['PRODUCT_PROVIDER_CLASS']) ? $arResult['PRODUCT_PROVIDER_CLASS'] : 'CCatalogProductProvider',
				'QUANTITY' => isset($arResult['QUANTITY']) ? $arResult['QUANTITY'] : null,
				'IBLOCK_ID' => isset($arResult['IBLOCK_ID']) ? $arResult['IBLOCK_ID'] : null,

				'PRIMARY_OFFER_ID' => isset($arResult['OFFERS'][0]['ID']) ? $arResult['OFFERS'][0]['ID'] : null,
				'SECTION' => array(
					'ID' => isset($arResult['SECTION']['ID']) ? $arResult['SECTION']['ID'] : null,
					'IBLOCK_ID' => isset($arResult['SECTION']['IBLOCK_ID']) ? $arResult['SECTION']['IBLOCK_ID'] : null,
					'LEFT_MARGIN' => isset($arResult['SECTION']['LEFT_MARGIN']) ? $arResult['SECTION']['LEFT_MARGIN'] : null,
					'RIGHT_MARGIN' => isset($arResult['SECTION']['RIGHT_MARGIN']) ? $arResult['SECTION']['RIGHT_MARGIN'] : null,
				),
			)
		), $component, array("HIDE_ICONS" => "Y"));
}
if ($arResult['CATALOG'] && $arParams['USE_GIFTS_MAIN_PR_SECTION_LIST'] == 'Y' && \Bitrix\Main\ModuleManager::isModuleInstalled("sale"))
{
	$APPLICATION->IncludeComponent(
			"bitrix:sale.gift.main.products",
			"main",
			array(
				"USE_REGION" => $arParams['USE_REGION'] !== 'N' ? 'Y' : 'N',
				"STORES" => $arParams['STORES'],
				"SHOW_UNABLE_SKU_PROPS"=>$arParams["SHOW_UNABLE_SKU_PROPS"],
				"PAGE_ELEMENT_COUNT" => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT'],
				"BLOCK_TITLE" => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE'],

				"OFFERS_FIELD_CODE" => $arParams["OFFERS_FIELD_CODE"],
				"OFFERS_PROPERTY_CODE" => $arParams["OFFERS_PROPERTY_CODE"],

				"AJAX_MODE" => $arParams["AJAX_MODE"],
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],

				"ELEMENT_SORT_FIELD" => 'ID',
				"ELEMENT_SORT_ORDER" => 'DESC',
				//"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
				//"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
				"FILTER_NAME" => 'searchFilter',
				"SECTION_URL" => $arParams["SECTION_URL"],
				"DETAIL_URL" => $arParams["DETAIL_URL"],
				"BASKET_URL" => $arParams["BASKET_URL"],
				"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
				"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
				"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],

				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"SHOW_ONE_CLICK_BUY" => "N",
				"CACHE_TIME" => $arParams["CACHE_TIME"],

				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"SET_TITLE" => $arParams["SET_TITLE"],
				"PROPERTY_CODE" => "",
				"PRICE_CODE" => $arParams["PRICE_CODE"],
				"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
				"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

				"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
				"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
				"CURRENCY_ID" => $arParams["CURRENCY_ID"],
				"HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
				"TEMPLATE_THEME" => (isset($arParams["TEMPLATE_THEME"]) ? $arParams["TEMPLATE_THEME"] : ""),

				"ADD_PICT_PROP" => (isset($arParams["ADD_PICT_PROP"]) ? $arParams["ADD_PICT_PROP"] : ""),

				"LABEL_PROP" => (isset($arParams["LABEL_PROP"]) ? $arParams["LABEL_PROP"] : ""),
				"OFFER_ADD_PICT_PROP" => (isset($arParams["OFFER_ADD_PICT_PROP"]) ? $arParams["OFFER_ADD_PICT_PROP"] : ""),
				"OFFER_TREE_PROPS" => (isset($arParams["OFFER_TREE_PROPS"]) ? $arParams["OFFER_TREE_PROPS"] : ""),
				"SHOW_DISCOUNT_PERCENT" => "N",
				"SHOW_OLD_PRICE" => (isset($arParams["SHOW_OLD_PRICE"]) ? $arParams["SHOW_OLD_PRICE"] : ""),
				"MESS_BTN_BUY" => (isset($arParams["MESS_BTN_BUY"]) ? $arParams["MESS_BTN_BUY"] : ""),
				"MESS_BTN_ADD_TO_BASKET" => (isset($arParams["MESS_BTN_ADD_TO_BASKET"]) ? $arParams["MESS_BTN_ADD_TO_BASKET"] : ""),
				"MESS_BTN_DETAIL" => (isset($arParams["MESS_BTN_DETAIL"]) ? $arParams["MESS_BTN_DETAIL"] : ""),
				"MESS_NOT_AVAILABLE" => (isset($arParams["MESS_NOT_AVAILABLE"]) ? $arParams["MESS_NOT_AVAILABLE"] : ""),
				'ADD_TO_BASKET_ACTION' => (isset($arParams["ADD_TO_BASKET_ACTION"]) ? $arParams["ADD_TO_BASKET_ACTION"] : ""),
				'SHOW_CLOSE_POPUP' => (isset($arParams["SHOW_CLOSE_POPUP"]) ? $arParams["SHOW_CLOSE_POPUP"] : ""),
				'DISPLAY_COMPARE' => (isset($arParams['DISPLAY_COMPARE']) ? $arParams['DISPLAY_COMPARE'] : ''),
				'COMPARE_PATH' => (isset($arParams['COMPARE_PATH']) ? $arParams['COMPARE_PATH'] : ''),
				"SHOW_DISCOUNT_TIME" => "N",
				"SHOW_DISCOUNT_PERCENT_NUMBER" => "N",
				"SALE_STIKER" => $arParams["SALE_STIKER"],
				"STIKERS_PROP" => $arParams["STIKERS_PROP"],
				"SHOW_MEASURE" => $arParams["SHOW_MEASURE"],
				"DISPLAY_TYPE" => "block",
				"SHOW_RATING" => $arParams["SHOW_RATING"],
				"DISPLAY_WISH_BUTTONS" => $arParams["DISPLAY_WISH_BUTTONS"],
				"DEFAULT_COUNT" => $arParams["DEFAULT_COUNT"],
			)
			+ array(
				'OFFER_ID' => empty($arResult['OFFERS'][$arResult['OFFERS_SELECTED']]['ID']) ? $arResult['ID'] : $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]['ID'],
				'SECTION_ID' => $arResult['SECTION']['ID'],
				'ELEMENT_ID' => $arResult['ID'],
			),
			$component,
			array("HIDE_ICONS" => "Y")
	);
}
?>
</div>
<?$this->EndViewTarget();?>