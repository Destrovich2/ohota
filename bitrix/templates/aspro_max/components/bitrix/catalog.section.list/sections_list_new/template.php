<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';?>
<? $this->setFrameMode( true ); ?>
<?use \Bitrix\Main\Localization\Loc;?>

<style type="text/css">
.carousel-2 {
    margin-bottom: 110px;
    position: relative;
    z-index: 2;
}  
.slick-slider .slick-track, .slick-slider .slick-list {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
}
.container-2 {
    max-width: 1430px;
    height: 556px;
    padding: 0 15px;
    margin: 0 auto;
}
.carousel-2__tabs {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    margin-bottom: 20px;
    position: relative;
    z-index: 5;
}
.carousel-2__tab.--active {
    border-bottom-color: #FFD300;
    color: #000000;
}
.carousel-2__tab {
    font-size: 16px;
    font-weight: bold;
    font-family: "EXO 2", sans-serif;
    color: #878787;
    border-bottom: 2px solid transparent;
    padding-bottom: 3px;
    -webkit-transition: all 320ms;
    transition: all 320ms;
}
.carousel-2__tab + .carousel-2__tab {
    margin-left: 50px;
}
.carousel-2__wrapper {
    padding-left: 356px;
    width: 100%;
    position: relative;
    padding-top: 1px;
    padding-bottom: 1px;
}
.carousel-2__category {
    width: 350px;
    /*height: 556px;*/
    max-height: 556px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    position: relative;
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    margin-right: 6px;
    z-index: 10;
    -webkit-transition: all 700ms;
    transition: all 700;
}
.carousel-2__category::before {
    content: "";
    position: absolute;
    right: 100%;
    top: 0;
    bottom: 0;
    background-color: #fff;
    width: 50vw;
}
.carousel-2__category-img-wrapper {
    position: absolute;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    overflow: hidden;
}
.carousel-2__category-img {
    position: absolute;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    background-size: cover;
    background-position: center center;
    -webkit-transition: all 700ms;
    transition: all 700ms;
}
.carousel-2__category-name {
    font-size: 36px;
    font-family: "EXO 2", sans-serif;
    color: #fff;
    position: relative;
    z-index: 5;
    text-align: center;
}
.carousel-2__category-name-desk {
    display: block;
}
.carousel-2__category-name-mobile {
    display: none;
}
.carousel-2__category-goto {
    position: absolute;
    bottom: 44px;
    left: 20px;
    right: 20px;
    font-size: 16px;
    font-family: "EXO 2", sans-serif;
    color: #fff;
    text-align: center;
}
.carousel-2__category-goto:hover {
    color: #FEC223;
}
.carousel-2__category::after {
    content: "";
    position: absolute;
    left: 0;
    right: 0;
    top: 100%;
    background-color: #fff;
}
.carousel-2__tab:hover {
    color: #FEC223;
}
.carousel-2__category-goto:hover {
    color: #FEC223;
}
.carousel-2__img{
    width: 350px;
    height: 556px;
    -webkit-transition: all 700ms;
    transition: all 700ms;
}
.carousel-2__category:hover .carousel-2__category-img {
    -webkit-transform: scale(1.05, 1.05);
    transform: scale(1.05, 1.05);
}
.carousel-2__img:hover{
    
    -webkit-transition: all 700ms;
    transition: all 700ms;
}
.carousel-2__carousel-wrapper {
    margin-bottom: -66px;
}
.carousel-2__carousel {
    padding-top: 1px;
    padding-bottom: 1px;
}
.slick-slider {
    position: relative;
    display: block;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    -ms-touch-action: pan-y;
    touch-action: pan-y;
    -webkit-tap-highlight-color: transparent;
}
.carousel-2__carousel .slick-prev {
    left: 0;
    border-radius: 0 100px 100px 0;
    background-image: url(../images/carousel__arrow-left.svg);
}
.carousel-2__carousel .slick-arrow {
    border: 0;
    padding: 0;
    background-color: rgba(51, 51, 51, 0.5);
    width: 36px;
    height: 48px;
    background-repeat: no-repeat;
    background-size: 8px 12px;
    background-position: center center;
    position: absolute;
    top: 50%;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    margin-top: -30px;
    text-indent: -9999px;
    z-index: 10;
    cursor: pointer;
    -webkit-transition: all 320ms;
    transition: all 320ms;
}
.carousel-2__carousel .slick-next {
    right: 0;
    border-radius: 100px 0 0 100px;
    background-image: url(../images/carousel__arrow-right.svg);
}
.carousel-2__carousel .slick-list {
    padding-bottom: 100px;
    margin-bottom: -100px;
    padding-top: 50px;
    margin-top: -50px;
}
.slick-list {
    position: relative;
    overflow: hidden;
    display: block;
    margin: 0;
    padding: 0;
}
.carousel-2__carousel .slick-arrow:hover {
    background-color: #FEC223;
}
.slick-initialized .slick-slide {
    display: flex;
    /*height: 556px;*/
    flex-direction: column;
    justify-content: space-between;
}
.slick-track {
    display: flex;
    height: 556px;
}
.carousel-2__item {
    padding: 24px;
    padding-bottom: 30px;
    -webkit-transition: all 320ms;
    transition: all 320ms;
    background-color: #fff;
    position: relative;
}
.slick-slide {
    float: left;
    height: 100%;
    min-height: 1px;
    display: none;
}   
.carousel-2__item:hover {
    -webkit-box-shadow: 0px 8px 30px 8px rgb(0 0 0 / 13%);
    box-shadow: 0px 8px 30px 8px rgb(0 0 0 / 13%);
    z-index: 3;
}
.carousel-2__available {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    margin-bottom: 8px;
    font-family: "EXO 2", sans-serif;
}
.carousel-2__available-ico {
    width: 10px;
    margin-right: 8px;
}
.carousel-2__available-ico svg {
    display: block;
    width: 100%;
    height: auto;
}
.carousel-2__available-text {
    font-size: 10px;
    color: #78a962;
    font-family: "EXO 2", sans-serif;
}
.carousel-2__item:hover .carousel-2__specs {
    opacity: 1;
}
.carousel-2__specs {
    -webkit-transition: all 320ms;
    transition: all 320ms;
    opacity: 0;
}
.carousel-2__specs-item {
    font-size: 10px;
    color: #1c1c1c;
    line-height: 1.5;
}
.carousel-2__specs-item strong {
    font-weight: bold;
}
.carousel-2__img {
    display: block;
    width: auto;
    height: auto;
}
.carousel-2__img img {
    display: block;
    width: 100%;
    height: auto;
}
.slick-slide img {
    display: block;
}
.carousel-2__title {
    font-size: 13px;
    color: #000;
    /*margin-bottom: 30px;*/
}
.carousel-2__prices-n-colors {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -webkit-box-align: end;
    -ms-flex-align: end;
    align-items: flex-end;
    margin-top: 5px;
}
.carousel-2__item:hover .carousel-2__colors {
    opacity: 1;
}
.carousel-2__colors {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    padding-bottom: 4px;
    -webkit-transition: all 320ms;
    transition: all 320ms;
    opacity: 0;
}
.carousel-2__prices-old {
    font-size: 18px;
    line-height: 24px;
    color: #666666;
    font-family: "EXO 2", sans-serif;
    text-decoration: line-through;
}
.carousel-2__prices-current {
    font-size: 24px;
    line-height: 30px;
    color: #000;
    font-weight: bold;
    font-family: "EXO 2", sans-serif;
}
.carousel-2__colors-item {
    width: 14px;
    height: 14px;
    border-radius: 100px;
}
.carousel-2__colors-item + .carousel-2__colors-item {
    margin-left: 6px;
}
.carousel-2__item:hover .carousel-2__footer {
    opacity: 1;
}
.carousel-2__footer {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-transition: all 320ms;
    transition: all 320ms;
    opacity: 0;
    /*margin-top: 30px;*/
}
.carousel-2__footer-more {
    margin-right: auto;
    width: 130px;
    height: 37px;
    font-size: 18px;
}
.btn-1 {
    background-color: #008E1F;
    color: #fff !important;
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

.btn-1:hover {
    background-color: #008E1F;
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

.carousel-2__footer-compare {
    display: block;
    width: 20px;
    cursor: pointer;
}
.carousel-2__footer-compare svg {
    display: block;
    width: 100%;
    height: auto;
}
.carousel-2__footer-fav {
    display: block;
    width: 20px;
    margin-left: 10px;
    cursor: pointer;
}
.carousel-2__footer-fav svg {
    display: block;
    width: 100%;
    height: auto;
}
.wrapper_inner, .maxwidth-theme{
    padding: 0;
}
.greencoll{color: #78a962}
.yellowcoll{color: #dc8708}
.redcoll{color: #a72214}
@media (min-width: 1023px){

  
}
</style>

<?if($arResult["SECTIONS"]){?>
	<?global $arTheme;
	$iVisibleItemsMenu = CMax::GetFrontParametrValue('MAX_VISIBLE_ITEMS_MENU');
	$bSlide = false;
	$bSlick = ($arParams['NO_MARGIN'] == 'Y');
	$bSmallBlock = ($arParams['VIEW_TYPE'] == 'sm');
	$bSlideBlock = ($arParams['VIEW_TYPE'] == 'slide');
	$bBigBlock = ($arParams['VIEW_TYPE'] == 'lg');
	$bIcons = ($arParams['SHOW_ICONS'] == 'Y');?>

    <? //Вывод инфоблока ?>
    <? //echo '<pre>'; ?>
    <? //print_r($arSect); ?>
    <? //echo '</pre>'; ?>
     <div class="carousels">
		<?foreach( $arResult["SECTIONS"] as $arItems ){
			$this->AddEditAction($arItems['ID'], $arItems['EDIT_LINK'], CIBlock::GetArrayByID($arItems["IBLOCK_ID"], "SECTION_EDIT"));
			$this->AddDeleteAction($arItems['ID'], $arItems['DELETE_LINK'], CIBlock::GetArrayByID($arItems["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_SECTION_DELETE_CONFIRM')));
		?>


   
       
        <div class="carousel-2">
          <div class="container-2">
            <div class="carousel-2__tabs">
                <?php $count = 0; ?>
            <?$tab_i = 0?>
              <a href="#" class="carousel-2__tab --active">Популярные</a>
          		  <?foreach($arItems["SECTIONS"] as $arSect ):?>
                    <?php if ($count < 8) { ?>
                    <a href="<?=$arSect['SECTION_PAGE_URL']?>" class="carousel-2__tab"><?=$arSect['NAME']?></a>
                          <?php $count++; ?>
                      <?php }?>
        				<? $tab_i++; endforeach;?>
            </div>

            <? //Вывод инфоблока ?>
            <? //echo '<pre>'; ?>
            <? //print_r($arItems); ?>
            <? //echo '</pre>'; ?>

            

            <div class="carousel-2__wrapper-2">
                <div class="carousel-2__wrapper">
                  <a href="<?=$arItems['SECTION_PAGE_URL']?>" class="carousel-2__category">
                    <div class="carousel-2__category-img-wrapper">
                      <? $UrlDetPic = CFile::GetPath($arItems['DETAIL_PICTURE']) ?>
                      <div class="carousel-2__category-img carousel-2__img" style="background-image: url('<?=$UrlDetPic?>')">
                          <div class="black_cover"></div>
                      </div>
                    </div>
                    <div class="carousel-2__category-name">
                      <span class="carousel-2__category-name-desk"><?=$arItems['NAME']?></span>
                      <span class="carousel-2__category-name-mobile"><?=$arItems['NAME']?></span>
                    </div>
                    <div class="carousel-2__category-goto">Перейти в раздел</div>
                  </a>

                  <div class="carousel-2__carousel-wrapper">
                  <div class="carousel-2__carousel">
                 

                            <?foreach($arItems["SECTIONS"] as $arSect ):?>

                                <? $APPLICATION->IncludeComponent(
                                              "bitrix:catalog.section", 
                                              "catalog_block_new",
                                              array(
                                                "IBLOCK_ID" => "55",
                                                "SHOW_ALL_WO_SECTION" => "Y",
                                                "COMPONENT_TEMPLATE" => "catalog_block",
                                                "IBLOCK_TYPE" => "aspro_max_catalog",
                                                "SECTION_ID" => $arSect['ID'],
                                                "SECTION_CODE" => "",
                                                "SECTION_USER_FIELDS" => array(
                                                  0 => "",
                                                  1 => "",
                                                ),
                                                "FILTER_NAME" => "arrFilter",
                                                "INCLUDE_SUBSECTIONS" => "Y",
                                                "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
                                                "HIDE_NOT_AVAILABLE" => "N",
                                                "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                                                "ELEMENT_SORT_FIELD" => "sort",
                                                "ELEMENT_SORT_ORDER" => "asc",
                                                "ELEMENT_SORT_FIELD2" => "id",
                                                "ELEMENT_SORT_ORDER2" => "desc",
                                                "PAGE_ELEMENT_COUNT" => "18",
                                                "LINE_ELEMENT_COUNT" => "3",
                                                "OFFERS_LIMIT" => "5",
                                                "BACKGROUND_IMAGE" => "-",
                                                "SECTION_URL" => "",
                                                "DETAIL_URL" => "",
                                                "SECTION_ID_VARIABLE" => "SECTION_ID",
                                                "SEF_MODE" => "N",
                                                "AJAX_MODE" => "N",
                                                "AJAX_OPTION_JUMP" => "N",
                                                "AJAX_OPTION_STYLE" => "Y",
                                                "AJAX_OPTION_HISTORY" => "N",
                                                "AJAX_OPTION_ADDITIONAL" => "",
                                                "CACHE_TYPE" => "A",
                                                "CACHE_TIME" => "36000000",
                                                "CACHE_GROUPS" => "Y",
                                                "SET_TITLE" => "Y",
                                                "SET_BROWSER_TITLE" => "Y",
                                                "BROWSER_TITLE" => "-",
                                                "SET_META_KEYWORDS" => "Y",
                                                "META_KEYWORDS" => "-",
                                                "SET_META_DESCRIPTION" => "Y",
                                                "META_DESCRIPTION" => "-",
                                                "SET_LAST_MODIFIED" => "N",
                                                "USE_MAIN_ELEMENT_SECTION" => "N",
                                                "ADD_SECTIONS_CHAIN" => "N",
                                                "CACHE_FILTER" => "N",
                                                "SHOW_RATING" => "Y",
                                                "ACTION_VARIABLE" => "action",
                                                "PRODUCT_ID_VARIABLE" => "id",
                                                "PRICE_CODE" => array(
                                                ),
                                                "USE_PRICE_COUNT" => "N",
                                                "SHOW_PRICE_COUNT" => "1",
                                                "PRICE_VAT_INCLUDE" => "Y",
                                                "CONVERT_CURRENCY" => "N", 
                                                "BASKET_URL" => "/personal/basket.php",
                                                "USE_PRODUCT_QUANTITY" => "N",
                                                "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                                                "ADD_PROPERTIES_TO_BASKET" => "Y",
                                                "PRODUCT_PROPS_VARIABLE" => "prop",
                                                "PARTIAL_PRODUCT_PROPERTIES" => "N",
                                                "DISPLAY_COMPARE" => "N",
                                                "PAGER_TEMPLATE" => ".default",
                                                "DISPLAY_TOP_PAGER" => "N",
                                                "DISPLAY_BOTTOM_PAGER" => "Y",
                                                "PAGER_TITLE" => "Товары",
                                                "PAGER_SHOW_ALWAYS" => "N",
                                                "PAGER_DESC_NUMBERING" => "N",
                                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                                "PAGER_SHOW_ALL" => "N",
                                                "PAGER_BASE_LINK_ENABLE" => "N",
                                                "SET_STATUS_404" => "N",
                                                "SHOW_404" => "N",
                                                "MESSAGE_404" => "",
                                                "COMPATIBLE_MODE" => "Y",
                                                "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                                                "OFFERS_SORT_FIELD" => "sort",
                                                "OFFERS_SORT_ORDER" => "asc",
                                                "OFFERS_SORT_FIELD2" => "id",
                                                "OFFERS_SORT_ORDER2" => "desc",
                                                "OFFERS_FIELD_CODE" => array(
                                                  0 => "",
                                                  1 => "",
                                                )
                                              ),
                                              false
                                            );?>
                            <?endforeach;?>
                         
                  </div>
              </div>
            </div>
        </div>
      </div>
    </div>    

		<?}?>

	
<?}?>
</div>
    <script type="text/javascript">
       
      $(".carousel-2__carousel").slick({
        slidesToShow: 3,
        slidesToScroll: 3,
        swipeToSlide: true,
        responsive: [
          {
            breakpoint: 1260,
            settings: {
              variableWidth: true,
              slidesToScroll: 1,
            },
          },
        ],
      });


        
    </script>