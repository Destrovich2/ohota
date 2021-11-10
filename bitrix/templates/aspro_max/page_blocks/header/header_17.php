<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?><?
global $arTheme, $arRegion, $bLongHeader, $dopClass, $USER;
$arRegions = CMaxRegionality::getRegions();
if($arRegion)
	$bPhone = ($arRegion['PHONES'] ? true : false);
else
	$bPhone = ((int)$arTheme['HEADER_PHONES'] ? true : false);
$logoClass = ($arTheme['COLORED_LOGO']['VALUE'] !== 'Y' ? '' : ' colored');
$bLongHeader = true;
$dopClass .= ' high_one_row_header';
?>



<header class="header">
        <button class="mob-burger jsBurger">
          <span class="mob-burger-top"></span>
          <span class="mob-burger-middle"></span>
          <span class="mob-burger-bottom"></span>
        </button>
        <div class="hamburger">
          <?$APPLICATION->IncludeComponent(
            	"bitrix:menu",
            	"menuburger",
            	Array(
            		"ALLOW_MULTI_SELECT" => "N",
            		"CHILD_MENU_TYPE" => "",
            		"DELAY" => "N",
            		"MAX_LEVEL" => "1",
            		"MENU_CACHE_GET_VARS" => array(""),
            		"MENU_CACHE_TIME" => "3600",
            		"MENU_CACHE_TYPE" => "Y",
            		"MENU_CACHE_USE_GROUPS" => "Y",
            		"ROOT_MENU_TYPE" => "menu_burger",
            		"USE_EXT" => "N"
            	)
            );?>
        </div>
        <button class="header__mob-search-trigger">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1534 13.6581C16.4727 11.9566 17.0944 9.81626 16.8922 7.67244C16.69 5.52862 15.6789 3.5424 14.0648 2.11786C12.4506 0.693311 10.3546 -0.0625465 8.20313 0.00405526C6.05167 0.070657 4.00638 0.954715 2.48335 2.47638C0.959004 3.99909 0.0724087 6.04599 0.00424256 8.19994C-0.0639235 10.3539 0.69147 12.4528 2.11649 14.0689C3.5415 15.6851 5.52889 16.6968 7.67366 16.8979C9.81843 17.0991 11.9592 16.4745 13.6596 15.1515L13.7051 15.1991L18.1929 19.6898C18.2912 19.7882 18.4079 19.8662 18.5364 19.9194C18.6648 19.9726 18.8024 20 18.9415 20C19.0805 20 19.2181 19.9726 19.3465 19.9194C19.475 19.8662 19.5917 19.7882 19.69 19.6898C19.7883 19.5915 19.8662 19.4748 19.9194 19.3463C19.9726 19.2178 20 19.0801 20 18.941C20 18.802 19.9726 18.6643 19.9194 18.5358C19.8662 18.4073 19.7883 18.2906 19.69 18.1922L15.201 13.7026C15.1856 13.6873 15.1697 13.6725 15.1534 13.6581V13.6581ZM12.9571 3.97398C13.5544 4.56189 14.0295 5.26229 14.3549 6.03479C14.6803 6.80728 14.8496 7.63659 14.853 8.47486C14.8564 9.31313 14.6939 10.1438 14.3748 10.9189C14.0557 11.694 13.5863 12.3983 12.9938 12.991C12.4013 13.5838 11.6973 14.0533 10.9225 14.3725C10.1477 14.6918 9.31739 14.8543 8.47945 14.8509C7.64151 14.8475 6.81254 14.6782 6.04035 14.3526C5.26816 14.0271 4.56804 13.5519 3.98036 12.9543C2.80595 11.7601 2.15079 10.1501 2.15761 8.47486C2.16443 6.79964 2.83267 5.19497 4.01677 4.0104C5.20087 2.82583 6.80489 2.15732 8.47945 2.1505C10.154 2.14368 11.7634 2.7991 12.9571 3.97398Z" fill="white"></path>
          </svg>
        </button>



        <div class="header__top">
          <div class="container44">
            <div class="header__wrapper">

   

              <?if($bPhone):?>	
              		<?CMax::ShowHeaderPhones('no-icons');?>
              		<!--<a href="tel:+79303200020" class="header__tel">+7 (930) 320-00-20</a>-->
	          <?endif?>
			  <?$callbackExploded = explode(',', $arTheme['SHOW_CALLBACK']['VALUE']);
				if( in_array('HEADER', $callbackExploded) ):?>
					<span class="header__callback" data-event="jqm" data-param-form_id="CALLBACK" data-name="callback">Обратный звонок</span>
			  <?endif;?>


              <!--<a href="#" class="">Обратный звонок</a>-->



              <div class="header__nav">
						<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
							array(
								"COMPONENT_TEMPLATE" => ".default",
								"PATH" => SITE_DIR."include/menu/menu.topest3.php",
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "",
								"AREA_FILE_RECURSIVE" => "Y",
								"EDIT_TEMPLATE" => "include_area.php"
							),
							false
						);?>
              </div>




              <a href="#" class="header__user" style="display: none">
                <div class="header__user-name">Дмитрий Б.</div>
                <div class="header__user-photo">
                  <img src="assets/images/header__user.jpg">
                </div>
              </a>




              <div class="header__auth">
                  <?if($USER->IsAuthorized()):?>
                    <a href="/personal/" class="header__user" style="">
                        <span>Личный кабинет</span>
                    </a>
                  <?else:?>
                <a href="/auth/registration/?register=yes&backurl=/" class="header__auth-link">Регистрация</a> /
                <a rel="nofollow" title="Вход" data-event="jqm" data-param-type="auth" data-param-backurl="/" data-name="auth" href="/personal/" class="header__auth-link"><span class="wrap"><span class="name">Вход</span></a>
                  <?endif;?>
            
                <!--<script>$('.svg-inline-cabinet').remove();</script>-->
              </div>
            </div>
          </div>
        </div>
        <div class="header__bottom">
          <div class="container44">

            <div class="header__wrapper">
              <a href="/" class="header__logo">
                <p>Охотник</p>
                <span>Оптовый Интернет-магазин</span>
              </a>



					<div class="pull-left">
							<div class="menu-row">
								<div class="menu-only">
									<nav class="mega-menu">
										<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
											array(
												"COMPONENT_TEMPLATE" => ".default",
												"PATH" => SITE_DIR."include/menu/menu.only_catalog2.php",
												"AREA_FILE_SHOW" => "file",
												"AREA_FILE_SUFFIX" => "",
												"AREA_FILE_RECURSIVE" => "Y",
												"EDIT_TEMPLATE" => "include_area.php"
											),
											false, array("HIDE_ICONS" => "Y")
										);?>
									</nav>
								</div>
							</div>
						</div>



	
              



              <!--<div class="header__search">
                <input type="search" class="header__search-input" placeholder="Введите название товара">
              </div>-->
               		<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_DIR."include/top_page/search.title.catalog2.php",
							"EDIT_TEMPLATE" => "include_area.php",
							'SEARCH_ICON' => 'Y',
						)
					);?>
              

              <?=CMax::ShowBasketWithCompareLink2('', 'big', '', 'wrap_icon wrap_basket baskets');?>

            </div>
          </div>
        </div>
      </header>
      <div class="header_space"></div>
<script type="text/javascript">
$(".header__catalog-wrapper").hover(function () {
$(".header").toggleClass("--faded");
});

$(".header__search-input").on("keyup", function () {
var val = $(this).val();
if (val == "") {
  $(".header__search__search-results").fadeOut();
  $(".header").removeClass("--faded");
} else {
  $(".header__search__search-results").fadeIn();
  $(".header").addClass("--faded");
}
});	
// Открытие фильтра на мобильных
$(".cat__mobile-filter-trigger").on("click", function (e) {
e.preventDefault();
$(".cat__filter, .cat__search-categories").insertAfter(".header").addClass("--visible");
});

$(".cat__filter-header-close").on("click", function (e) {
e.preventDefault();
$(".cat__filter, .cat__search-categories").removeClass("--visible");
});
// Скрытие уведомлений в шапке
$(".header__btn-complete-close").on("click", function (e) {
$(this).closest(".header__btn-complete").fadeOut();
});
  $(".jsBurger").on("click", function (e) {
    e.preventDefault();
    $(".mob-burger").toggleClass("--active");
    $(".hamburger").toggleClass("--visible");
    $(".header__mob-search-trigger").toggleClass("z-index__low");
    $(".wrapper1").toggleClass("close_nigga");
    $("body").toggleClass("dont_move");
  });
  $(".header__mob-search-trigger").on("click", function (e) {
    e.preventDefault();
    $(".header__search").fadeIn();
    $(".mob-burger").fadeOut();
    $(".header__mob-search-trigger").fadeOut();
    $(".header__mob-search-trigger").css('opacity','0');
    $(".wrapper1").toggleClass("close_nigga");
    $("body").toggleClass("dont_move");
    //$(".mob-burger").fadeOut();
  });
  $(".header__search .close_search").on("click", function (e) {
    e.preventDefault();
    $(".header__search").fadeOut();
    $(".mob-burger").fadeIn();
    $(".header__mob-search-trigger").fadeIn();
    $(".wrapper1").toggleClass("close_nigga");
    $("body").toggleClass("dont_move");
  });
</script>