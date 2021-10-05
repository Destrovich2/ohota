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
.slick-slide {
    float: left;
    height: 100%;
    min-height: 1px;
    display: none;
}
.carousel__discount {
    font-size: 12px;
    color: #FEC223;
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
		<?foreach( $arResult["SECTIONS"] as $arItems ){
			$this->AddEditAction($arItems['ID'], $arItems['EDIT_LINK'], CIBlock::GetArrayByID($arItems["IBLOCK_ID"], "SECTION_EDIT"));
			$this->AddDeleteAction($arItems['ID'], $arItems['DELETE_LINK'], CIBlock::GetArrayByID($arItems["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_SECTION_DELETE_CONFIRM')));
		?>


  
              

	<?}?>

        </div>
    </div>  
</div>
<?}?>

<script type="text/javascript">

    $(".carousel__carousel").slick({
    slidesToShow: 6,
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