<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc,
	  \Bitrix\Main\Web\Json;?>

<style type="text/css">
.cat__cards {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}
.list-item {
    padding: 40px 20px;
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    width: 100%;
}
.list-item__available {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    font-family: "Open Sans", sans-serif;
    position: absolute;
    top: 20px;
    left: 20px;
}
.list-item__available-ico {
    width: 13px;
    margin-right: 8px;
}
.list-item__available-ico svg {
    display: block;
    width: 100%;
    height: auto;
}
.list-item__available-text {
    font-size: 12px;
    color: #78A962;
    font-family: "Open Sans", sans-serif;
}
.list-item__img {
    width: 233px;
    margin-right: 100px;
    -webkit-box-flex: 0;
    -ms-flex: 0 0 auto;
    flex: 0 0 auto;
}
.list-item__img img {
    display: block;
    width: 100%;
    height: auto;
}
.list-item__cont {
    width: 100%;
}
.list-item__title {
    font-family: "Open Sans", sans-serif;
    font-size: 18px;
    line-height: 1.3;
    color: #000;
    margin-bottom: 20px;
    display: block;
}
.list-item__descr {
    font-size: 14px;
    color: #000;
    line-height: 1.4;
    font-family: "Open Sans", sans-serif;
    margin-bottom: 20px;
}
.list-item__specs {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
}
.list-item__specs-item {
    font-size: 10px;
    color: #1C1C1C;
    width: 50%;
}
.list-item__specs-item strong {
    font-weight: bold;
}
.list-item__colors {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    padding-bottom: 4px;
    -webkit-transition: all 320ms;
    transition: all 320ms;
    opacity: 0;
    margin-top: 16px;
}
.list-item__right {
    margin-left: 100px;
    -webkit-box-flex: 0;
    -ms-flex: 0 0 auto;
    flex: 0 0 auto;
    width: 200px;
}
.list-item__prices-old {
    font-size: 18px;
    line-height: 24px;
    color: #666666;
    font-family: "Open Sans", sans-serif;
    text-decoration: line-through;
}
.list-item__prices-current {
    font-size: 24px;
    line-height: 30px;
    color: #000;
    font-weight: bold;
    font-family: "Open Sans", sans-serif;
}
.list-item__footer {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-transition: all 320ms;
    transition: all 320ms;
    opacity: 0;
    margin-top: 30px;
}
.list-item__footer-more {
    margin-right: auto;
    width: 130px;
    height: 37px;
    font-size: 18px;
}
.btn-1 {
    background-color: #fc6001;
    color: #fff;
    border-radius: 0;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-transition: all 320ms;
    transition: all 320ms;
    cursor: pointer;
    border: 0;
    text-decoration: none;
}
.list-item__footer-compare {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    width: 20px;
    cursor: pointer;
}

.list-item__footer-compare svg {
    display: block;
    width: 100%;
    height: auto;
}
.list-item__footer-fav {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    width: 20px;
    margin-left: 10px;
    cursor: pointer;
}
.list-item__footer-fav svg {
    display: block;
    width: 100%;
    height: auto;
}
.list-item__prices-current {
    font-size: 24px;
    line-height: 30px;
    color: #000;
    font-weight: bold;
    font-family: "Open Sans", sans-serif;
}
.list-item__colors-item {
    width: 14px;
    height: 14px;
    border-radius: 100px;
    margin-right: 5px;
}
.list-item__footer-more {
    margin-right: auto;
    width: 130px;
    height: 37px;
    font-size: 18px;
}
.list-item + .list-item {
    border-top: 1px solid #C4C4C4;
}
.menu_top_block.catalog_block .dropdown > li.full.v_bottom.opened > a {
    padding-bottom: 7px;
    border-bottom: none;
    display: none;
}
.menu_top_block.catalog_block .dropdown > li.full:hover > a, .left_menu > li:hover > a {
    background: #fafafa;
    background: var(--card_bg_black);
    display: none;
}
body .menu_top_block.catalog_block .menu li.v_bottom.full>.dropdown {
    padding: 0;
}
.menu_top_block.catalog_block .dropdown > li.full.v_bottom > .dropdown > li, header .menu.top.menu_top_block.catalogfirst li.full.v_bottom > .dropdown > li {
    float: none;
    display: block;
    font-size: 16px;
    width: auto;
    padding: 16px 20px 16px 20px;
    background: #fff;
}
.menu_top_block.catalog_block .dropdown > li.full.v_bottom > .dropdown > li > a, header .menu_top_block.catalogfirst li.full.v_bottom > .dropdown > li > a {
    padding-left: 0px;
    padding-top: 0px;
    font-weight: normal;
    font-size: 16px;
}
.font_upper_md {
    font-size: .733em;
    line-height: 1.3em;
    text-transform: uppercase;
    letter-spacing: .8px;
    display: none;
}
.menu_top_block.catalog_block .menu {
    margin: 0px;
    border: 1px solid #C4C4C4;
}
header .menu_top_block li .dropdown > li > a, .menu_top_block.catalog_block .dropdown > li.full > a, .left_menu > li > a {
    display: none;
    padding: 15px 30px 17px 15px;
    background: #fff;
    background: var(--black_bg_black);
    text-decoration: none;
    text-align: left;
    transition: padding 0.2s ease;
}

@media (min-width: 600px){
.cat__cards .carousel-2__item {
    width: 50% !important;
}
.carousel-2__item {
    padding: 16px;
}   
}
@media (max-width: 1259px){
 .carousel-2__item {
    width: 285px;
}   
}
@media (min-width: 1260px){
.list-item:hover {
    -webkit-box-shadow: 0px 8px 30px 8px rgb(0 0 0 / 13%);
    box-shadow: 0px 8px 30px 8px rgb(0 0 0 / 13%);
    z-index: 3;
    border-color: transparent !important;
}   
.list-item:hover .list-item__colors {
    opacity: 1;
}
.list-item:hover .list-item__footer {
    opacity: 1;
}
.list-item:hover + .list-item {
    border-color: transparent;
}
}
</style>


<?if( count( $arResult["ITEMS"] ) >= 1 ){?>
	<?if($arParams["AJAX_REQUEST"]=="N"){?>
		<div class="display_list <?=($arParams["SHOW_UNABLE_SKU_PROPS"] != "N" ? "show_un_props" : "unshow_un_props");?> js_append <?=$arParams["TYPE_VIEW_CATALOG_LIST"];?>  flexbox flexbox--row">
	<?}?>
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

		$arParams["BASKET_ITEMS"] = ($arParams["BASKET_ITEMS"] ? $arParams["BASKET_ITEMS"] : array());

		$arOfferProps = implode(';', $arParams['OFFERS_CART_PROPERTIES']);

		$bNormalView = ($arParams["TYPE_VIEW_CATALOG_LIST"] == "TYPE_1");

		// params for catalog elements compact view
		$arParamsCE_CMP = $arParams;
		$arParamsCE_CMP['TYPE_SKU'] = 'N';

		?>
		<div class="cat__cards">	
		<?foreach($arResult["ITEMS"] as $arItem){?>

		<div class="list-item">
                  <div class="list-item__available">
	               	<? $collItem = $arItem['CATALOG_QUANTITY'];
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

	               	?>
	               	 <div class="carousel-2__available-text <?=$css_coll?>"><strong class="<?=$css_coll?>"><?=$text_one_coll?></strong><?=$text_two_coll?></div>
                  </div>
                  <? $UrlDetPicCart = CFile::GetPath($arItem['DETAIL_PICTURE']['ID']) ?>
                  <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="list-item__img">
                    <img src="<?=$UrlDetPicCart?>">
                  </a>
                  <div class="list-item__cont">
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="list-item__title"><?=$arItem["NAME"]?></a>
                    <div class="list-item__descr"></div>
                  </div>
                  <div class="list-item__right">
                    <div class="list-item__prices">

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
	                  <div class="list-item__prices-old"><?=$old_price?> ₽</div>
	                  <?endif;?>
	                  <div class="list-item__prices-current"><?=$price_for_print?> ₽</div>
                    </div>



                    <div class="list-item__footer">


                     	<span data-value="<?=$price_for_print?>" data-currency="RUB" class="to-cart list-item__footer-more btn-1" data-item="<?=$arItem["ID"]?>" data-float_ratio="" data-ratio="1" data-bakset_div="bx_basket_div_<?=$arItem["ID"]?>" data-props="" data-part_props="N" data-add_props="Y" data-empty_props="Y" data-offers="" data-iblockid="55" data-quantity="1">Купить</span><a rel="nofollow" href="/basket/" class="in-cart list-item__footer-more btn-1" data-item="<?=$arItem["ID"]?>" style="display: none;"><span>В корзине</span></a>

			                <div class="compare_item_button">
				                <span class="compare_item to rounded3 list-item__footer-compare" data-iblock="55" data-item="<?=$arItem["ID"]?>" tabindex="0">
		                 			<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				                    <path d="M6.80277 3.37222C7.74959 3.37222 8.60724 3.75645 9.22814 4.37736L7.4889 6.11664H11.6055V2L10.199 3.40651C9.33109 2.5386 8.13038 2 6.80277 2C4.38424 2 2.38767 3.79074 2.05493 6.11664H3.44086C3.7599 4.55232 5.14241 3.37222 6.80277 3.37222Z" fill="#9D9D9D"></path>
				                    <path d="M10.6724 9.6402C11.1286 9.01926 11.4374 8.28515 11.5506 7.48926H10.1647C9.84564 9.05358 8.46312 10.2337 6.80273 10.2337C5.85591 10.2337 4.99826 9.84944 4.37736 9.22854L6.11664 7.48926H2V11.6059L3.40651 10.1994C4.27444 11.0673 5.47512 11.6059 6.80273 11.6059C7.86621 11.6059 8.84732 11.256 9.64321 10.6694L12.9777 14.0004L14 12.9781L10.6724 9.6402Z" fill="#9D9D9D"></path>
				                  	</svg>
				                </span>
				                <span class="compare_item in added rounded3 list-item__footer-compare" style="display: none;" data-iblock="55" data-item="<?=$arItem["ID"]?>" tabindex="0" >
		                 			<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				                    <path d="M6.80277 3.37222C7.74959 3.37222 8.60724 3.75645 9.22814 4.37736L7.4889 6.11664H11.6055V2L10.199 3.40651C9.33109 2.5386 8.13038 2 6.80277 2C4.38424 2 2.38767 3.79074 2.05493 6.11664H3.44086C3.7599 4.55232 5.14241 3.37222 6.80277 3.37222Z" fill="#ff0000"></path>
				                    <path d="M10.6724 9.6402C11.1286 9.01926 11.4374 8.28515 11.5506 7.48926H10.1647C9.84564 9.05358 8.46312 10.2337 6.80273 10.2337C5.85591 10.2337 4.99826 9.84944 4.37736 9.22854L6.11664 7.48926H2V11.6059L3.40651 10.1994C4.27444 11.0673 5.47512 11.6059 6.80273 11.6059C7.86621 11.6059 8.84732 11.256 9.64321 10.6694L12.9777 14.0004L14 12.9781L10.6724 9.6402Z" fill="#ff0000"></path>
				                  	</svg>
				                </span>
			                </div>
							<div class="wish_item_button">
								<span data-quantity="1" class="wish_item to rounded3 list-item__footer-fav" data-item="<?=$arItem["ID"]?>" data-iblock="55">
		                 			 <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				                    <path d="M3.09003 11.24C2.69003 11.24 2.31003 11.06 2.04003 10.76C1.78003 10.45 1.67003 10.05 1.73003 9.65L2.13003 7.29L0.420029 5.61C0.230029 5.43 0.0900293 5.19 0.0300293 4.93C-0.0199707 4.69 -0.0099707 4.44 0.0600293 4.2C0.140029 3.97 0.270029 3.76 0.460029 3.59C0.660029 3.41 0.900029 3.3 1.17003 3.26L3.54003 2.91L4.59003 0.76C4.71003 0.52 4.89003 0.32 5.12003 0.19C5.33003 0.07 5.57003 0 5.82003 0C6.07003 0 6.31003 0.06 6.52003 0.19C6.75003 0.33 6.93003 0.52 7.05003 0.76L8.12003 2.9L10.49 3.24C10.75 3.28 11 3.39 11.2 3.56C11.39 3.72 11.52 3.93 11.6 4.16C11.68 4.4 11.69 4.65 11.64 4.89C11.58 5.15 11.45 5.38 11.26 5.57L9.55003 7.25L9.96003 9.61C10.03 10.01 9.92003 10.42 9.66003 10.73C9.40003 11.04 9.02003 11.22 8.61003 11.22C8.39003 11.22 8.17003 11.17 7.97003 11.07L5.85003 9.96L3.73003 11.08C3.54003 11.18 3.32003 11.24 3.09003 11.24ZM4.60003 3.91C4.52003 4.08 4.35003 4.2 4.16003 4.23L1.37003 4.65L3.41003 6.58C3.55003 6.71 3.61003 6.91 3.58003 7.1L3.11003 9.87L5.57003 8.53C5.66003 8.49 5.75003 8.46 5.84003 8.46C5.93003 8.46 6.03003 8.48 6.11003 8.53L8.61003 9.83L8.10003 7.07C8.07003 6.89 8.14003 6.69 8.27003 6.56L10.28 4.58L7.50003 4.22C7.31003 4.19 7.15003 4.07 7.06003 3.9L5.82003 1.41L4.60003 3.91Z" fill="#FCB500"></path>
				                  </svg>
								</span>

								<span data-quantity="1" class="wish_item in added rounded3 list-item__footer-fav" style="display: none;" data-item="<?=$arItem["ID"]?>" data-iblock="55">
		                  			<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				                    <path d="M3.09003 11.24C2.69003 11.24 2.31003 11.06 2.04003 10.76C1.78003 10.45 1.67003 10.05 1.73003 9.65L2.13003 7.29L0.420029 5.61C0.230029 5.43 0.0900293 5.19 0.0300293 4.93C-0.0199707 4.69 -0.0099707 4.44 0.0600293 4.2C0.140029 3.97 0.270029 3.76 0.460029 3.59C0.660029 3.41 0.900029 3.3 1.17003 3.26L3.54003 2.91L4.59003 0.76C4.71003 0.52 4.89003 0.32 5.12003 0.19C5.33003 0.07 5.57003 0 5.82003 0C6.07003 0 6.31003 0.06 6.52003 0.19C6.75003 0.33 6.93003 0.52 7.05003 0.76L8.12003 2.9L10.49 3.24C10.75 3.28 11 3.39 11.2 3.56C11.39 3.72 11.52 3.93 11.6 4.16C11.68 4.4 11.69 4.65 11.64 4.89C11.58 5.15 11.45 5.38 11.26 5.57L9.55003 7.25L9.96003 9.61C10.03 10.01 9.92003 10.42 9.66003 10.73C9.40003 11.04 9.02003 11.22 8.61003 11.22C8.39003 11.22 8.17003 11.17 7.97003 11.07L5.85003 9.96L3.73003 11.08C3.54003 11.18 3.32003 11.24 3.09003 11.24ZM4.60003 3.91C4.52003 4.08 4.35003 4.2 4.16003 4.23L1.37003 4.65L3.41003 6.58C3.55003 6.71 3.61003 6.91 3.58003 7.1L3.11003 9.87L5.57003 8.53C5.66003 8.49 5.75003 8.46 5.84003 8.46C5.93003 8.46 6.03003 8.48 6.11003 8.53L8.61003 9.83L8.10003 7.07C8.07003 6.89 8.14003 6.69 8.27003 6.56L10.28 4.58L7.50003 4.22C7.31003 4.19 7.15003 4.07 7.06003 3.9L5.82003 1.41L4.60003 3.91Z" fill="#ff0000"></path>
				                  </svg>
								</span>
							</div>
                    </div>
                  </div>
                </div>



		<?}?>
		</div>
	<?if($arParams["AJAX_REQUEST"]=="N"){?>
		</div>
	<?}?>
	<?if($arParams["AJAX_REQUEST"]=="Y"){?>
		<div class="wrap_nav bottom_nav_wrapper">
	<?}?>

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

	<div class="bottom_nav <?=$arParams["DISPLAY_TYPE"];?>" <?=($showAllCount ? 'data-all_count="'.$allCount.'"' : '')?> <?=($arParams["AJAX_REQUEST"]=="Y" ? "style='display: none; '" : "");?>>
		<?if( $arParams["DISPLAY_BOTTOM_PAGER"] == "Y" ){?><?=$arResult["NAV_STRING"]?><?}?>
	</div>
	<?if($arParams["AJAX_REQUEST"]=="Y"){?>
		</div>


<?}?>

	

<?}else{?>
	<div class="no_goods">
		<div class="no_products">
			<div class="wrap_text_empty">
				<?if($_REQUEST["set_filter"]){?>
					<?$APPLICATION->IncludeFile(SITE_DIR."include/section_no_products_filter.php", Array(), Array("MODE" => "html",  "NAME" => GetMessage('EMPTY_CATALOG_DESCR')));?>
				<?}else{?>
					<?$APPLICATION->IncludeFile(SITE_DIR."include/section_no_products.php", Array(), Array("MODE" => "html",  "NAME" => GetMessage('EMPTY_CATALOG_DESCR')));?>
				<?}?>
			</div>
		</div>
		<?if($_REQUEST["set_filter"]){?>
			<span class="button wide btn btn-default"><?=GetMessage('RESET_FILTERS');?></span>
		<?}?>
	</div>
<?}?>
<script>
	BX.message({
		QUANTITY_AVAILIABLE: '<? echo COption::GetOptionString("aspro.max", "EXPRESSION_FOR_EXISTS", GetMessage("EXPRESSION_FOR_EXISTS_DEFAULT"), SITE_ID); ?>',
		QUANTITY_NOT_AVAILIABLE: '<? echo COption::GetOptionString("aspro.max", "EXPRESSION_FOR_NOTEXISTS", GetMessage("EXPRESSION_FOR_NOTEXISTS"), SITE_ID); ?>',
		ADD_ERROR_BASKET: '<? echo GetMessage("ADD_ERROR_BASKET"); ?>',
		ADD_ERROR_COMPARE: '<? echo GetMessage("ADD_ERROR_COMPARE"); ?>',
	})
</script>
