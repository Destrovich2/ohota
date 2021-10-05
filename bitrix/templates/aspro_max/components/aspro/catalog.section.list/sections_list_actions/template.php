<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';?>
<? $this->setFrameMode( true ); ?>
<?use \Bitrix\Main\Localization\Loc;?>

<style type="text/css">
.container33 {
    max-width: 1430px;
    padding: 0 15px;
    margin: 0 auto;
}
.carousel {
    padding-top: 65px;
    margin-bottom: 40px;
}
.carousel__header {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    width: 100%;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    margin-bottom: 16px;
    position: relative;
    z-index: 5;
}
.carousel__title {
    font-size: 24px;
    color: #111;
    font-family: "EXO 2", sans-serif;
}
.carousel__link {
    font-size: 13px;
    color: #878787;
    text-decoration: underline;
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
.carousel__carousel .slick-prev {
    left: 0;
    border-radius: 0 100px 100px 0;
    background-image: url(../images/carousel__arrow-left.svg);
}
.carousel__carousel .slick-arrow {
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
.carousel__carousel .slick-next {
    right: 0;
    border-radius: 100px 0 0 100px;
    background-image: url(../images/carousel__arrow-right.svg);
}
.carousel__carousel .slick-arrow {
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
.carousel__carousel .slick-list {
    padding-bottom: 100px;
    margin-bottom: -100px;
    padding-top: 50px;
    margin-top: -50px;
}
.slick-slider .slick-track, .slick-slider .slick-list {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
}
.slick-list {
    position: relative;
    overflow: hidden;
    display: block;
    margin: 0;
    padding: 0;
}
.slick-slider .slick-track, .slick-slider .slick-list {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
}
.slick-track{
    height: auto !important;
}
.slick-track {
    position: relative;
    left: 0;
    top: 0;
    display: block;
    margin-left: auto;
    margin-right: auto;
}
.slick-track:before, .slick-track:after {
    content: "";
    display: table;
}
.slick-initialized .slick-slide {
    display: block;
}
.carousel__carousel-item {
    padding: 0 24px;
    padding-bottom: 22px;
    -webkit-transition: all 320ms;
    transition: all 320ms;
    background-color: #fff;
}
.carousel__carousel-item:hover {
    -webkit-filter: drop-shadow(0px 8px 30px rgba(0, 0, 0, 0.13));
    filter: drop-shadow(0px 8px 30px rgba(0, 0, 0, 0.13));
}
.slick-slide {
    float: left;
    height: 100%;
    min-height: 1px;
    display: none;
}
.carousel__discount {
    font-size: 12px;
    color: #FEC223;
    padding-top: 25px;
}
.carousel__carousel-item:hover .carousel__footer {
    opacity: 1;
}
.carousel__discount-val {
    display: inline-block;
    font-size: 28px;
    font-weight: bold;
    font-family: "EXO 2", sans-serif;
    color: #ffe2d0;
}
.carousel__img {
    padding: 0 18px;
    display: block;
}
.carousel__img img {
    display: block;
    width: 100%;
    height: auto;
}
.slick-slide img {
    display: block;
}
.carousel__name {
    font-size: 13px;
    color: #000;
    font-family: "EXO 2", sans-serif;
    margin-top: 10px;
}
.carousel__prices {
    margin-top: 10px;
    margin-bottom: 14px;
}
.carousel__prices-old {
    height: 20px;
    font-size: 14px;
    color: #696969;
    font-family: "EXO 2", sans-serif;
    text-decoration: line-through;
}
.carousel__prices-current {
    font-size: 18px;
    font-weight: bold;
    color: #000;
    font-family: "EXO 2", sans-serif;
}
.carousel__footer {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-transition: all 320ms;
    transition: all 320ms;
    opacity: 0;
}
.carousel__footer-more {
    margin-right: auto;
    width: 110px;
    height: 27px;
    font-size: 12px;
}
.btn-1 {
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
.carousel__footer-compare {
    display: block;
    width: 16px;
}
.carousel__footer-compare svg {
    display: block;
    width: 100%;
    height: auto;
}
.carousel__footer-fav {
    display: block;
    width: 16px;
    margin-left: 10px;
}
.carousel__footer-fav svg {
    display: block;
    width: 100%;
    height: auto;
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

        <div class="carousel">
        <div class="container33">
          <div class="carousel__header">
            <div class="carousel__title">Распродажа и уценённые товары</div>
            <a href="#" class="carousel__link">Перейти ко всем акционным товарам</a>
          </div>
            <div class="carousel__carousel">
           
             
        <?
        CModule::IncludeModule("iblock");
        $arSelect = Array("ID", "IBLOCK_ID","NAME","ACTIVE","DETAIL_PICTURE","DETAIL_PAGE_URL","PROPERTY_RESULT_PRICE_VALUE","PROPERTY_BRASP_VALUE");
        $arFilter = Array("IBLOCK_ID" => 55);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

        
        while($element = $res->GetNext()) {?>

         <? //if($element['PROPERTY_BRASP_VALUE_VALUE'] === 'Y'): ?>

         <? global $USER;
            $quantity = 1; 
            $renewal = 'N'; 
            $arPrice = CCatalogProduct::GetOptimalPrice($element["ID"],$quantity,$USER->GetUserGroupArray(), $renewal);

            $old_price = $arPrice['RESULT_PRICE']['BASE_PRICE'];
            $discont_price = $arPrice['RESULT_PRICE']['DISCOUNT_PRICE'];

            $procent_discont = ((($discont_price * 100)/$old_price) - 100);
            $procent_discont = round($procent_discont, 1);
            ?>

            <?if($procent_discont != 0):?>
            <div class="carousel__carousel-item">
              <div class="carousel__carousel-item-inner">
                <div class="carousel__discount">
                    <div class="carousel__discount-val"><?=$procent_discont?>%</div> есть потёртости</div>
                
                    <? $UrlDetPicCart = CFile::GetPath($element['DETAIL_PICTURE']) ?>
                    <a href="<?=$element['DETAIL_PAGE_URL']?>" class="carousel__img">
                      <img src="<?=$UrlDetPicCart?>" />
                    </a>

                <a href="<?=$element['DETAIL_PAGE_URL']?>" class="carousel__name"><?=$element['NAME']?></a>
                <div class="carousel__prices">
                  <div class="carousel__prices-old">Р<?=$old_price?></div>
                  <div class="carousel__prices-current">Р<?=$discont_price?></div>
                </div>
                <div class="carousel__footer">
                  <a href="<?=$element['DETAIL_PAGE_URL']?>" class="carousel__footer-more btn-1">Купить</a>


                        <div class="compare_item_button">
                                <span class="compare_item to rounded3 carousel-2__footer-compare" data-iblock="55" data-item="<?=$element["ID"]?>" tabindex="0">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.80277 3.37222C7.74959 3.37222 8.60724 3.75645 9.22814 4.37736L7.4889 6.11664H11.6055V2L10.199 3.40651C9.33109 2.5386 8.13038 2 6.80277 2C4.38424 2 2.38767 3.79074 2.05493 6.11664H3.44086C3.7599 4.55232 5.14241 3.37222 6.80277 3.37222Z" fill="#9D9D9D"></path>
                                    <path d="M10.6724 9.6402C11.1286 9.01926 11.4374 8.28515 11.5506 7.48926H10.1647C9.84564 9.05358 8.46312 10.2337 6.80273 10.2337C5.85591 10.2337 4.99826 9.84944 4.37736 9.22854L6.11664 7.48926H2V11.6059L3.40651 10.1994C4.27444 11.0673 5.47512 11.6059 6.80273 11.6059C7.86621 11.6059 8.84732 11.256 9.64321 10.6694L12.9777 14.0004L14 12.9781L10.6724 9.6402Z" fill="#9D9D9D"></path>
                                    </svg>
                                </span>
                                <span class="compare_item in added rounded3 carousel-2__footer-compare" style="display: none;" data-iblock="55" data-item="<?=$element["ID"]?>" tabindex="0" >
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.80277 3.37222C7.74959 3.37222 8.60724 3.75645 9.22814 4.37736L7.4889 6.11664H11.6055V2L10.199 3.40651C9.33109 2.5386 8.13038 2 6.80277 2C4.38424 2 2.38767 3.79074 2.05493 6.11664H3.44086C3.7599 4.55232 5.14241 3.37222 6.80277 3.37222Z" fill="#ff0000"></path>
                                    <path d="M10.6724 9.6402C11.1286 9.01926 11.4374 8.28515 11.5506 7.48926H10.1647C9.84564 9.05358 8.46312 10.2337 6.80273 10.2337C5.85591 10.2337 4.99826 9.84944 4.37736 9.22854L6.11664 7.48926H2V11.6059L3.40651 10.1994C4.27444 11.0673 5.47512 11.6059 6.80273 11.6059C7.86621 11.6059 8.84732 11.256 9.64321 10.6694L12.9777 14.0004L14 12.9781L10.6724 9.6402Z" fill="#ff0000"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="wish_item_button">
                                <span data-quantity="1" class="wish_item to rounded3 carousel-2__footer-fav" data-item="<?=$element["ID"]?>" data-iblock="55">
                                     <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.09003 11.24C2.69003 11.24 2.31003 11.06 2.04003 10.76C1.78003 10.45 1.67003 10.05 1.73003 9.65L2.13003 7.29L0.420029 5.61C0.230029 5.43 0.0900293 5.19 0.0300293 4.93C-0.0199707 4.69 -0.0099707 4.44 0.0600293 4.2C0.140029 3.97 0.270029 3.76 0.460029 3.59C0.660029 3.41 0.900029 3.3 1.17003 3.26L3.54003 2.91L4.59003 0.76C4.71003 0.52 4.89003 0.32 5.12003 0.19C5.33003 0.07 5.57003 0 5.82003 0C6.07003 0 6.31003 0.06 6.52003 0.19C6.75003 0.33 6.93003 0.52 7.05003 0.76L8.12003 2.9L10.49 3.24C10.75 3.28 11 3.39 11.2 3.56C11.39 3.72 11.52 3.93 11.6 4.16C11.68 4.4 11.69 4.65 11.64 4.89C11.58 5.15 11.45 5.38 11.26 5.57L9.55003 7.25L9.96003 9.61C10.03 10.01 9.92003 10.42 9.66003 10.73C9.40003 11.04 9.02003 11.22 8.61003 11.22C8.39003 11.22 8.17003 11.17 7.97003 11.07L5.85003 9.96L3.73003 11.08C3.54003 11.18 3.32003 11.24 3.09003 11.24ZM4.60003 3.91C4.52003 4.08 4.35003 4.2 4.16003 4.23L1.37003 4.65L3.41003 6.58C3.55003 6.71 3.61003 6.91 3.58003 7.1L3.11003 9.87L5.57003 8.53C5.66003 8.49 5.75003 8.46 5.84003 8.46C5.93003 8.46 6.03003 8.48 6.11003 8.53L8.61003 9.83L8.10003 7.07C8.07003 6.89 8.14003 6.69 8.27003 6.56L10.28 4.58L7.50003 4.22C7.31003 4.19 7.15003 4.07 7.06003 3.9L5.82003 1.41L4.60003 3.91Z" fill="#FCB500"></path>
                                  </svg>
                                </span>

                                <span data-quantity="1" class="wish_item in added rounded3 carousel-2__footer-fav" style="display: none;" data-item="<?=$element["ID"]?>" data-iblock="55">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.09003 11.24C2.69003 11.24 2.31003 11.06 2.04003 10.76C1.78003 10.45 1.67003 10.05 1.73003 9.65L2.13003 7.29L0.420029 5.61C0.230029 5.43 0.0900293 5.19 0.0300293 4.93C-0.0199707 4.69 -0.0099707 4.44 0.0600293 4.2C0.140029 3.97 0.270029 3.76 0.460029 3.59C0.660029 3.41 0.900029 3.3 1.17003 3.26L3.54003 2.91L4.59003 0.76C4.71003 0.52 4.89003 0.32 5.12003 0.19C5.33003 0.07 5.57003 0 5.82003 0C6.07003 0 6.31003 0.06 6.52003 0.19C6.75003 0.33 6.93003 0.52 7.05003 0.76L8.12003 2.9L10.49 3.24C10.75 3.28 11 3.39 11.2 3.56C11.39 3.72 11.52 3.93 11.6 4.16C11.68 4.4 11.69 4.65 11.64 4.89C11.58 5.15 11.45 5.38 11.26 5.57L9.55003 7.25L9.96003 9.61C10.03 10.01 9.92003 10.42 9.66003 10.73C9.40003 11.04 9.02003 11.22 8.61003 11.22C8.39003 11.22 8.17003 11.17 7.97003 11.07L5.85003 9.96L3.73003 11.08C3.54003 11.18 3.32003 11.24 3.09003 11.24ZM4.60003 3.91C4.52003 4.08 4.35003 4.2 4.16003 4.23L1.37003 4.65L3.41003 6.58C3.55003 6.71 3.61003 6.91 3.58003 7.1L3.11003 9.87L5.57003 8.53C5.66003 8.49 5.75003 8.46 5.84003 8.46C5.93003 8.46 6.03003 8.48 6.11003 8.53L8.61003 9.83L8.10003 7.07C8.07003 6.89 8.14003 6.69 8.27003 6.56L10.28 4.58L7.50003 4.22C7.31003 4.19 7.15003 4.07 7.06003 3.9L5.82003 1.41L4.60003 3.91Z" fill="#ff0000"></path>
                                  </svg>
                                </span>
                            </div>

                </div>
              </div>
            </div>

        <?else:?>
        <?endif;?>


        <?//else:?>
        <?//endif;?>        
        <?  //echo '<pre>';
            //print_r($element);
            //echo '</pre>';



        }?>
                            



        </div>
    </div>  
</div>
<?}?>
<script type="text/javascript">
  $(".carousel__carousel").slick({
    slidesToShow: 5,
    swipeToSlide: true,
    responsive: [
      {
        breakpoint: 1260,
        settings: {
          variableWidth: true,
        },
      },
    ],
  });    
</script>