<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc,
	  \Bitrix\Main\Web\Json;?>
	  
<?if($arResult["ITEMS"]):?>
	<?
	$currencyList = '';
	if (!empty($arResult['CURRENCIES'])){
		$templateLibrary[] = 'currency';
		$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
	}
	$templateData = array(
		'TEMPLATE_LIBRARY' => $templateLibrary,
		'CURRENCIES' => $currencyList
	);
	unset($currencyList, $templateLibrary);

	// params for catalog elements compact view
	$arParamsCE_CMP = $arParams;
	$arParamsCE_CMP['TYPE_SKU'] = 'N';

							
	$bHasBottomPager = $arParams["DISPLAY_BOTTOM_PAGER"] == "Y" && $arResult["NAV_STRING"];
	?>

	<?if($arParams["AJAX_REQUEST"] != "Y"):?>
		<?$bSlide = (isset($arParams['SLIDE_ITEMS']) && $arParams['SLIDE_ITEMS']);?>
		<?$bGiftblock = (isset($arParams['GIFT_ITEMS']) && $arParams['GIFT_ITEMS']);?>

	<div class="top_wrapper items_wrapper <?=$templateName;?>_template <?=$arParams['IS_COMPACT_SLIDER'] ? 'compact-catalog-slider' : ''?>">
		<div class="fast_view_params" data-params="<?=urlencode(serialize($arTransferParams));?>"></div>
		<div class="catalog_block items row <?=$arParams['IS_COMPACT_SLIDER'] ? 'swipeignore mobile-overflow' : ''?> margin0 <?=$bHasBottomPager ? 'has-bottom-nav' : ''?> js_append ajax_load block flexbox<?=($bSlide ? ' owl-carousel owl-theme owl-bg-nav visible-nav short-nav hidden-dots swipeignore ' : '');?>"<?if($bSlide):?>data-plugin-options='{"nav": true, "autoplay" : false,  "autoplayTimeout" : "3000", "smartSpeed":1000, <?=(count($arResult["ITEMS"]) > 4 ? "\"loop\": true," : "")?> "responsiveClass": true, "responsive":{"0":{"items": 2},"600":{"items": 2},"768":{"items": 3},"1200":{"items": 4}}}'<?endif;?>>
	<?endif;?>
		<?
		if(is_array($arParams['OFFERS_CART_PROPERTIES'])){
			$arOfferProps = implode(';', $arParams['OFFERS_CART_PROPERTIES']);
		} else {
			$arOfferProps = '';
		}
		?>
		
		<?
//echo '<pre>';
//print_r($arResult["SECTIONS_ID"]);
//echo '</pre>';


		?>

		<? //foreach ($arResult["SECTION_ID_VARIABLE"] as $s => $arSect):?>	
		
		<!--<div class="main__section_title" id="<?=$arSect["CODE"]?>"><?=$arSect["NAME"]?></div>  -->
		<div class="cat__cards">
		<?foreach($arResult["ITEMS"] as $arItem):?>

	
			<div class="carousel-2__item" data-id="<?=$arItem["ID"]?>" data-product_type="<?=$arItem["CATALOG_TYPE"]?>">
			      <div class="carousel-2__available">

	               	<? 
	               /* Выводим остатки всех торговых предложений товара */	
							$res = CCatalogSKU::getOffersList(
        $arItem["ID"], // массив ID товаров
         // указываете ID инфоблока только в том случае, когда ВЕСЬ массив товаров из одного инфоблока и он известен
        $skuFilter = array(), // дополнительный фильтр предложений. по умолчанию пуст.
        $fields = array(),  // массив полей предложений. даже если пуст - вернет ID и IBLOCK_ID
        $propertyFilter = array() /* свойства предложений. имеет 2 ключа:
                               ID - массив ID свойств предложений
                                      либо
                               CODE - массив символьных кодов свойств предложений
                                     если указаны оба ключа, приоритет имеет ID*/
 );
							if($res){
								
							foreach($res as $resItem)	{
							


							foreach($resItem as $resItem2)	{
							$rsStore = CCatalogStoreProduct::GetList(array(), array('PRODUCT_ID' =>$resItem2["ID"], 'STORE_ID' => '1'), false, false, array('AMOUNT')); 
							if ($arStore = $rsStore->Fetch()){
								//echo $arStore['AMOUNT'];
								$sum+= $arStore['AMOUNT'];
							}
							
							}
							//echo $sum; //Общее количество товара по всем торговым предложениям
							if($sum != 0){
			               	   		$text_one_coll = 'В наличии, ';
			               	   		$text_two_coll = 'есть на складе';
			               	   		$css_coll = 'greencoll';
			               	   } 
			               	   if($sum === 1) {
			               	   		$text_one_coll = 'В наличии, ';
			               	   		$text_two_coll = 'осталась одна штука';
			               	   		$css_coll = 'yellowcoll';
			               	   } 
			               	   if($sum === 0){
										$text_one_coll = 'Нет в наличии';
										$text_two_coll = '';
										$css_coll = 'redcoll';
									
			               	   }
							}
							} else {
									$collItem = $arItem['CATALOG_QUANTITY'];
			               	//echo $collItem;
			               	   if($collItem != 0){
			               	   		$text_one_coll = 'В наличии, ';
			               	   		$text_two_coll = 'есть на складе';
			               	   		$css_coll = 'greencoll';
			               	   } 
			               	   if($collItem === 1) {
			               	   		$text_one_coll = 'В наличии, ';
			               	   		$text_two_coll = 'осталась одна штука';
			               	   		$css_coll = 'yellowcoll';
			               	   } 
			               	   if($collItem === 0){
										$text_one_coll = 'Нет в наличии';
										$text_two_coll = '';
										$css_coll = 'redcoll';
									
			               	   }
							}
							
/* Конец Вывода остатка всех торговых предложений товара */	

	               	?>
			        <div class="carousel-2__available-text <?=$css_coll?>"><strong class="<?=$css_coll?>"><?=$text_one_coll?></strong><?=$text_two_coll?></div>
			      </div>
			      <? $UrlDetPicCart = CFile::GetPath($arItem['PREVIEW_PICTURE']['ID']);
			      // echo '<pre>';
			      // print_r($arItem);
			      // echo '</pre>';
			?>
			      <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="carousel-2__img" tabindex="0"><img src="<?=$UrlDetPicCart?>"></a>
			      <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="carousel-2__title"><?=$arItem['NAME']?>, оптом</a>
			      <div class="carousel-2__prices-n-colors">
			        <div class="carousel-2__prices">
						<? global $USER; 
						$quantity = 1; 
						$renewal = 'N'; 
						$arPrice = CCatalogProduct::GetOptimalPrice($arItem["ID"],$quantity,$USER->GetUserGroupArray(), $renewal);


						$old_price = $arPrice['RESULT_PRICE']['BASE_PRICE'];
						$discont_price = $arPrice['RESULT_PRICE']['DISCOUNT_PRICE'];

						if($old_price === $discont_price){
							$ident_sale = 'N';
							$price_for_print = $discont_price;
						}

						if($old_price != $discont_price){
							$ident_sale = 'Y';
							$price_for_print = $discont_price;
						}							
						
						?>
					  
					
					  <?if($ident_sale === 'Y'): ?>
	                  <div class="carousel-2__prices-old"><?=$old_price?> ₽</div>
	                  <?endif;?>
	                  <div class="carousel-2__prices-current"><?=$price_for_print?> ₽</div>
			        </div>
			        <!--<div class="carousel-2__colors">
			          <a href="#" class="carousel-2__colors-item" style="background-color: #ffd704"></a>
			          <a href="#" class="carousel-2__colors-item" style="background-color: #ff0000"></a>
			          <a href="#" class="carousel-2__colors-item" style="background-color: #2d2d2d"></a>
			        </div>-->
			      </div>
			      <div class="carousel-2__footer">
			       


							<span data-value="<?=$price_for_print?>" data-currency="RUB" class="to-cart carousel-2__footer-more btn-1" data-item="<?=$arItem["ID"]?>" data-float_ratio="" data-ratio="1" data-bakset_div="bx_basket_div_<?=$arItem["ID"]?>" data-props="" data-part_props="N" data-add_props="Y" data-empty_props="Y" data-offers="" data-iblockid="55" data-quantity="1">Купить</span><a rel="nofollow" href="/basket/" class="in-cart carousel-2__footer-more btn-1" data-item="<?=$arItem["ID"]?>" style="display: none;"><span>В корзине</span></a>

			                <!--<a href="#" class="carousel-2__footer-more btn-1" tabindex="0">Купить</a>-->
			                <div class="compare_item_button">
				                <span class="compare_item to rounded3 carousel-2__footer-compare" data-iblock="55" data-item="<?=$arItem["ID"]?>" tabindex="0">
		                 			<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				                    <path d="M6.80277 3.37222C7.74959 3.37222 8.60724 3.75645 9.22814 4.37736L7.4889 6.11664H11.6055V2L10.199 3.40651C9.33109 2.5386 8.13038 2 6.80277 2C4.38424 2 2.38767 3.79074 2.05493 6.11664H3.44086C3.7599 4.55232 5.14241 3.37222 6.80277 3.37222Z" fill="#9D9D9D"></path>
				                    <path d="M10.6724 9.6402C11.1286 9.01926 11.4374 8.28515 11.5506 7.48926H10.1647C9.84564 9.05358 8.46312 10.2337 6.80273 10.2337C5.85591 10.2337 4.99826 9.84944 4.37736 9.22854L6.11664 7.48926H2V11.6059L3.40651 10.1994C4.27444 11.0673 5.47512 11.6059 6.80273 11.6059C7.86621 11.6059 8.84732 11.256 9.64321 10.6694L12.9777 14.0004L14 12.9781L10.6724 9.6402Z" fill="#9D9D9D"></path>
				                  	</svg>
				                </span>
				                <span class="compare_item in added rounded3 carousel-2__footer-compare" style="display: none;" data-iblock="55" data-item="<?=$arItem["ID"]?>" tabindex="0" >
		                 			<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				                    <path d="M6.80277 3.37222C7.74959 3.37222 8.60724 3.75645 9.22814 4.37736L7.4889 6.11664H11.6055V2L10.199 3.40651C9.33109 2.5386 8.13038 2 6.80277 2C4.38424 2 2.38767 3.79074 2.05493 6.11664H3.44086C3.7599 4.55232 5.14241 3.37222 6.80277 3.37222Z" fill="#ff0000"></path>
				                    <path d="M10.6724 9.6402C11.1286 9.01926 11.4374 8.28515 11.5506 7.48926H10.1647C9.84564 9.05358 8.46312 10.2337 6.80273 10.2337C5.85591 10.2337 4.99826 9.84944 4.37736 9.22854L6.11664 7.48926H2V11.6059L3.40651 10.1994C4.27444 11.0673 5.47512 11.6059 6.80273 11.6059C7.86621 11.6059 8.84732 11.256 9.64321 10.6694L12.9777 14.0004L14 12.9781L10.6724 9.6402Z" fill="#ff0000"></path>
				                  	</svg>
				                </span>
			                </div>
							<div class="wish_item_button">
								<span data-quantity="1" class="wish_item to rounded3 carousel-2__footer-fav" data-item="<?=$arItem["ID"]?>" data-iblock="55">
		                 			 <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				                    <path d="M3.09003 11.24C2.69003 11.24 2.31003 11.06 2.04003 10.76C1.78003 10.45 1.67003 10.05 1.73003 9.65L2.13003 7.29L0.420029 5.61C0.230029 5.43 0.0900293 5.19 0.0300293 4.93C-0.0199707 4.69 -0.0099707 4.44 0.0600293 4.2C0.140029 3.97 0.270029 3.76 0.460029 3.59C0.660029 3.41 0.900029 3.3 1.17003 3.26L3.54003 2.91L4.59003 0.76C4.71003 0.52 4.89003 0.32 5.12003 0.19C5.33003 0.07 5.57003 0 5.82003 0C6.07003 0 6.31003 0.06 6.52003 0.19C6.75003 0.33 6.93003 0.52 7.05003 0.76L8.12003 2.9L10.49 3.24C10.75 3.28 11 3.39 11.2 3.56C11.39 3.72 11.52 3.93 11.6 4.16C11.68 4.4 11.69 4.65 11.64 4.89C11.58 5.15 11.45 5.38 11.26 5.57L9.55003 7.25L9.96003 9.61C10.03 10.01 9.92003 10.42 9.66003 10.73C9.40003 11.04 9.02003 11.22 8.61003 11.22C8.39003 11.22 8.17003 11.17 7.97003 11.07L5.85003 9.96L3.73003 11.08C3.54003 11.18 3.32003 11.24 3.09003 11.24ZM4.60003 3.91C4.52003 4.08 4.35003 4.2 4.16003 4.23L1.37003 4.65L3.41003 6.58C3.55003 6.71 3.61003 6.91 3.58003 7.1L3.11003 9.87L5.57003 8.53C5.66003 8.49 5.75003 8.46 5.84003 8.46C5.93003 8.46 6.03003 8.48 6.11003 8.53L8.61003 9.83L8.10003 7.07C8.07003 6.89 8.14003 6.69 8.27003 6.56L10.28 4.58L7.50003 4.22C7.31003 4.19 7.15003 4.07 7.06003 3.9L5.82003 1.41L4.60003 3.91Z" fill="#FCB500"></path>
				                  </svg>
								</span>

								<span data-quantity="1" class="wish_item in added rounded3 carousel-2__footer-fav" style="display: none;" data-item="<?=$arItem["ID"]?>" data-iblock="55">
		                  			<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				                    <path d="M3.09003 11.24C2.69003 11.24 2.31003 11.06 2.04003 10.76C1.78003 10.45 1.67003 10.05 1.73003 9.65L2.13003 7.29L0.420029 5.61C0.230029 5.43 0.0900293 5.19 0.0300293 4.93C-0.0199707 4.69 -0.0099707 4.44 0.0600293 4.2C0.140029 3.97 0.270029 3.76 0.460029 3.59C0.660029 3.41 0.900029 3.3 1.17003 3.26L3.54003 2.91L4.59003 0.76C4.71003 0.52 4.89003 0.32 5.12003 0.19C5.33003 0.07 5.57003 0 5.82003 0C6.07003 0 6.31003 0.06 6.52003 0.19C6.75003 0.33 6.93003 0.52 7.05003 0.76L8.12003 2.9L10.49 3.24C10.75 3.28 11 3.39 11.2 3.56C11.39 3.72 11.52 3.93 11.6 4.16C11.68 4.4 11.69 4.65 11.64 4.89C11.58 5.15 11.45 5.38 11.26 5.57L9.55003 7.25L9.96003 9.61C10.03 10.01 9.92003 10.42 9.66003 10.73C9.40003 11.04 9.02003 11.22 8.61003 11.22C8.39003 11.22 8.17003 11.17 7.97003 11.07L5.85003 9.96L3.73003 11.08C3.54003 11.18 3.32003 11.24 3.09003 11.24ZM4.60003 3.91C4.52003 4.08 4.35003 4.2 4.16003 4.23L1.37003 4.65L3.41003 6.58C3.55003 6.71 3.61003 6.91 3.58003 7.1L3.11003 9.87L5.57003 8.53C5.66003 8.49 5.75003 8.46 5.84003 8.46C5.93003 8.46 6.03003 8.48 6.11003 8.53L8.61003 9.83L8.10003 7.07C8.07003 6.89 8.14003 6.69 8.27003 6.56L10.28 4.58L7.50003 4.22C7.31003 4.19 7.15003 4.07 7.06003 3.9L5.82003 1.41L4.60003 3.91Z" fill="#ff0000"></path>
				                  </svg>
								</span>
							</div>





			      </div>
			</div>

		
		<? endforeach; ?>
	</div>
	<? //endforeach; ?>

		<?if($arParams['IS_COMPACT_SLIDER'] && $bHasBottomPager):?>
			<?if($arParams["AJAX_REQUEST"]=="Y"):?>
				<div class="wrap_nav bottom_nav_wrapper">
			<?endif;?>

			<div class="bottom_nav mobile_slider animate-load-state block-type round-ignore" data-parent=".tabs_slider" data-append=".items" <?=($arParams["AJAX_REQUEST"]=="Y" ? "style='display: none; '" : "");?>>
				<?=CMax::showIconSvg('bottom_nav-icon colored_theme_svg', SITE_TEMPLATE_PATH.'/images/svg/mobileBottomNavLoader.svg');?>
				<?=$arResult["NAV_STRING"]?>
			</div>

			<?if($arParams["AJAX_REQUEST"]=="Y"):?>
				</div>
			<?endif;?>
		<?endif;?>

	<?if($arParams["AJAX_REQUEST"] != "Y"):?>
		</div>
	</div>
	<?endif;?>

	<?if($arParams["AJAX_REQUEST"]=="Y"):?>
		<div class="wrap_nav bottom_nav_wrapper">
	<?endif;?>

	<?$showAllCount = false;?>
	<?if($arParams['IS_CATALOG_PAGE'] == 'Y' && $arParams['SECTION_COUNT_ELEMENTS'] == 'Y'):?>
		<?if((int)$arResult['NAV_RESULT']->NavRecordCount > 0):?>
			<?$this->SetViewTarget("more_text_title");?>
				<span class="element-count-wrapper"><span class="element-count muted font_xs rounded3"><?=$arResult['NAV_RESULT']->NavRecordCount;?></span></span>
			<?$this->EndViewTarget();?>
			<?
			$showAllCount = true;
			$allCount = $arResult['NAV_RESULT']->NavRecordCount;
			?>
		<?endif;?>
	<?endif;?>

	<div class="bottom_nav animate-load-state block-type" <?=($showAllCount ? 'data-all_count="'.$allCount.'"' : '')?> data-parent=".tabs_slider" data-append=".items" <?=($arParams["AJAX_REQUEST"]=="Y" ? "style='display: none; '" : "");?>>
		<?if( $arParams["DISPLAY_BOTTOM_PAGER"] == "Y" ){?><?=$arResult["NAV_STRING"]?><?}?>
	</div>
	

	<?if($arParams["AJAX_REQUEST"]=="Y"):?>
		</div>
	<?endif;?>

	<script>
		// lazyLoadPagenBlock();
		<?if($bSlide):?>
			sliceItemBlockSlide();
		<?else:?>
			sliceItemBlock();
		<?endif;?>
	</script>
<?elseif($arParams['IS_CATALOG_PAGE'] == 'Y'):?>
	<div class="no_goods catalog_block_view">
		<div class="no_products">
			<div class="wrap_text_empty">
				<?if($_REQUEST["set_filter"]){?>
					<?$APPLICATION->IncludeFile(SITE_DIR."include/section_no_products_filter.php", Array(), Array("MODE" => "html",  "NAME" => GetMessage('EMPTY_CATALOG_DESCR')));?>
				<?}else{?>
					<?$APPLICATION->IncludeFile(SITE_DIR."include/section_no_products.php", Array(), Array("MODE" => "html",  "NAME" => GetMessage('EMPTY_CATALOG_DESCR')));?>
				<?}?>
			</div>
		</div>
	</div>
<?endif;?>