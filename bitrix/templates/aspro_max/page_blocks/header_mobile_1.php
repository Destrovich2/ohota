<?
global $arTheme, $arRegion;
$logoClass = ($arTheme['COLORED_LOGO']['VALUE'] !== 'Y' ? '' : ' colored');
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
          <svg width="30" height="30" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                <a href="/auth/registration/?register=yes&backurl=/" class="header__auth-link">Регистрация</a> /
                <a rel="nofollow" title="Вход" data-event="jqm" data-param-type="auth" data-param-backurl="/" data-name="auth" href="/personal/" class="header__auth-link"><span class="wrap"><span class="name">Вход</span></a>
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

                   </div>     
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
              
        


              <!--<div class="header__btns">
                <span class="header__btn-wrapper">
                  <a href="#" class="header__btn">
                    <span class="header__btn-ico">
                      <sv g width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.80398 4.94398C10.1453 4.94398 11.3603 5.48831 12.2399 6.36792L9.776 8.8319H15.6079V3L13.6153 4.99255C12.3858 3.76302 10.6848 3 8.80398 3C5.37774 3 2.54926 5.53688 2.07788 8.8319H4.04127C4.49325 6.61578 6.45181 4.94398 8.80398 4.94398Z" fill="#fff"></path>
                        <path d="M14.2859 13.8226C14.9322 12.9429 15.3696 11.9029 15.53 10.7754H13.5666C13.1147 12.9915 11.1561 14.6633 8.80387 14.6633C7.46253 14.6633 6.24754 14.119 5.36792 13.2394L7.8319 10.7754H2V16.6073L3.99255 14.6147C5.22213 15.8443 6.92308 16.6073 8.80387 16.6073C10.3105 16.6073 11.7004 16.1116 12.8279 15.2805L17.5517 19.9995L19 18.5512L14.2859 13.8226Z" fill="#fff"></path>
                      </svg>
                    </span>
                    <div class="header__btn-text">Сравнение товаров</div>
                  </a>
                  <div class="header__btn-complete" style="display: none">
                    <button class="header__btn-complete-close">
                      <img src="assets/images/header__btn-complete-close.svg" alt="Закрыть">
                    </button>
                    <div class="header__btn-complete-text">Товар успешно добавлен для сравнения.</div>
                  </div>
                </span>
                <span class="header__btn-wrapper">
                  <a href="#" class="header__btn">
                    <span class="header__btn-ico">
                      <sv g width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M18.6092 7.12061C18.857 7.33859 19.0418 7.62014 19.1441 7.93475C19.2463 8.24936 19.2623 8.58581 19.1899 8.90782C19.1118 9.25521 18.9346 9.57089 18.6786 9.82048L16.1617 12.2739L16.7558 15.7382C16.8476 16.2736 16.7002 16.819 16.3507 17.2335C15.9996 17.65 15.4863 17.8897 14.9428 17.8897C14.6462 17.8897 14.3506 17.8162 14.0867 17.6774L10.9756 16.0418L7.86457 17.6774C7.60074 17.8161 7.3051 17.8897 7.00844 17.8897C6.46497 17.8897 5.95166 17.65 5.60057 17.2335C5.2511 16.819 5.10368 16.2736 5.19548 15.7382L5.78966 12.2739L3.27275 9.8205C3.01668 9.57093 2.83945 9.25519 2.76137 8.90782C2.68903 8.58583 2.70504 8.24941 2.80725 7.9348C2.90949 7.62016 3.09425 7.33857 3.34208 7.1206C3.60945 6.88544 3.93838 6.73421 4.29222 6.6828L7.77053 6.17739L9.32607 3.02545C9.48431 2.70482 9.72977 2.4387 10.036 2.25708C10.3199 2.08873 10.6448 2 10.9756 2C11.3065 2 11.6314 2.08878 11.9152 2.25708C12.2215 2.4387 12.467 2.70485 12.6252 3.02544L14.1807 6.17736L17.6591 6.6828C18.0129 6.73422 18.3418 6.88547 18.6092 7.12061ZM13.3959 7.81593L17.4097 8.39918C17.4308 8.40224 17.4487 8.4109 17.463 8.42312L17.4679 8.57851L14.5635 11.4097C14.3974 11.5717 14.3215 11.8051 14.3608 12.0339L15.0464 16.0315C15.0526 16.0676 15.0423 16.0957 15.023 16.1176C15.0013 16.1421 14.9708 16.1553 14.9428 16.1553C14.929 16.1553 14.9127 16.1522 14.8938 16.1423L11.3038 14.2549C11.2011 14.2009 11.0883 14.1739 10.9757 14.1739C10.863 14.1739 10.7502 14.2009 10.6475 14.2549L7.05748 16.1423C7.03871 16.1522 7.02236 16.1553 7.00849 16.1553C6.98049 16.1553 6.95 16.1421 6.9283 16.1176C6.90898 16.0957 6.89874 16.0676 6.90494 16.0314L7.59057 12.0339C7.62985 11.8051 7.55396 11.5717 7.38779 11.4097L4.48332 8.57851C4.42095 8.51771 4.45536 8.41172 4.5416 8.39917L8.5554 7.81593C8.78508 7.78256 8.98361 7.63829 9.08633 7.43018L10.8814 3.793C10.8924 3.77063 10.9064 3.75735 10.9207 3.7489C10.936 3.73981 10.9551 3.7344 10.9756 3.7344C10.9962 3.7344 11.0153 3.73981 11.0306 3.7489C11.0448 3.75735 11.0589 3.77065 11.0699 3.79301L12.865 7.43022C12.9677 7.63823 13.1661 7.78255 13.3959 7.81593Z" fill="#fff"></path>
                      </svg>
                    </span>
                    <div class="header__btn-text">Избранное</div>
                  </a>
                  <div class="header__btn-complete" style="display: none">
                    <button class="header__btn-complete-close">
                      <img src="assets/images/header__btn-complete-close.svg" alt="Закрыть">
                    </button>
                    <div class="header__btn-complete-text">Товар успешно добавлен в избранное.</div>
                  </div>
                </span>
                <span class="header__btn-wrapper">
                  <a href="#" class="header__btn jsShowBasket">
                    <span class="header__btn-ico" style="display: flex;">
                      <sv g width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.4579 19.8327C13.0105 19.8327 13.5404 19.6132 13.9311 19.2225C14.3218 18.8318 14.5413 18.3019 14.5413 17.7493C14.5413 17.1968 14.3218 16.6669 13.9311 16.2762C13.5404 15.8855 13.0105 15.666 12.4579 15.666C11.9054 15.666 11.3755 15.8855 10.9848 16.2762C10.5941 16.6669 10.3746 17.1968 10.3746 17.7493C10.3746 18.3019 10.5941 18.8318 10.9848 19.2225C11.3755 19.6132 11.9054 19.8327 12.4579 19.8327ZM5.16626 19.8327C5.71879 19.8327 6.24869 19.6132 6.63939 19.2225C7.0301 18.8318 7.24959 18.3019 7.24959 17.7493C7.24959 17.1968 7.0301 16.6669 6.63939 16.2762C6.24869 15.8855 5.71879 15.666 5.16626 15.666C4.61372 15.666 4.08382 15.8855 3.69312 16.2762C3.30242 16.6669 3.08292 17.1968 3.08292 17.7493C3.08292 18.3019 3.30242 18.8318 3.69312 19.2225C4.08382 19.6132 4.61372 19.8327 5.16626 19.8327ZM18.7475 5.16914C19.0075 5.16075 19.2541 5.05156 19.4351 4.86464C19.6161 4.67773 19.7173 4.42775 19.7173 4.16758C19.7173 3.9074 19.6161 3.65743 19.4351 3.47051C19.2541 3.2836 19.0075 3.1744 18.7475 3.16602H17.5485C16.609 3.16602 15.7965 3.8181 15.5923 4.73477L14.2871 10.6118C14.0829 11.5285 13.2704 12.1806 12.3308 12.1806H4.50584L3.00376 6.17018H12.7381C12.9957 6.15843 13.2389 6.04783 13.417 5.86138C13.5951 5.67494 13.6945 5.427 13.6945 5.16914C13.6945 4.91128 13.5951 4.66334 13.417 4.4769C13.2389 4.29045 12.9957 4.17985 12.7381 4.1681H3.00376C2.69924 4.16801 2.39871 4.23735 2.12502 4.37084C1.85133 4.50434 1.61167 4.69848 1.42427 4.9385C1.23688 5.17852 1.10667 5.45811 1.04355 5.75601C0.980425 6.05391 0.986055 6.36228 1.06001 6.65768L2.56209 12.666C2.67038 13.0996 2.92052 13.4844 3.27272 13.7594C3.62493 14.0345 4.05898 14.1838 4.50584 14.1837H12.3308C13.2425 14.1838 14.127 13.873 14.8381 13.3026C15.5493 12.7321 16.0446 11.9362 16.2423 11.0462L17.5485 5.16914H18.7475Z" fill="#fff"></path>
                      </svg>
                      <div class="header__btn-badge">2</div>
                    </span>
                    <div class="header__btn-text">Корзина</div>
                  </a>
                  <div class="header__btn-complete" style="display: none">
                    <button class="header__btn-complete-close">
                      <img src="assets/images/header__btn-complete-close.svg" alt="Закрыть">
                    </button>
                    <div class="header__btn-complete-text">Товар успешно добавлен в корзину.</div>
                  </div>
                  <div class="header__basket" style="display: none">
                    <div class="header__basket-title">Корзина товаров</div>
                    <button class="header__basket-close jsCloseBasket">
                      <sv g width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.4158 6.00373L11.7158 1.71373C11.9041 1.52542 12.0099 1.27003 12.0099 1.00373C12.0099 0.737424 11.9041 0.482029 11.7158 0.293726C11.5275 0.105422 11.2721 -0.000366211 11.0058 -0.000366211C10.7395 -0.000366211 10.4841 0.105422 10.2958 0.293726L6.0058 4.59373L1.7158 0.293726C1.52749 0.105422 1.2721 -0.000366213 1.0058 -0.000366211C0.739497 -0.000366209 0.484102 0.105422 0.295798 0.293726C0.107495 0.482029 0.0017066 0.737424 0.0017066 1.00373C0.0017066 1.27003 0.107495 1.52542 0.295798 1.71373L4.5958 6.00373L0.295798 10.2937C0.20207 10.3867 0.127676 10.4973 0.0769072 10.6191C0.0261385 10.741 0 10.8717 0 11.0037C0 11.1357 0.0261385 11.2664 0.0769072 11.3883C0.127676 11.5102 0.20207 11.6208 0.295798 11.7137C0.388761 11.8075 0.499362 11.8819 0.621222 11.9326C0.743081 11.9834 0.873786 12.0095 1.0058 12.0095C1.13781 12.0095 1.26852 11.9834 1.39038 11.9326C1.51223 11.8819 1.62284 11.8075 1.7158 11.7137L6.0058 7.41373L10.2958 11.7137C10.3888 11.8075 10.4994 11.8819 10.6212 11.9326C10.7431 11.9834 10.8738 12.0095 11.0058 12.0095C11.1378 12.0095 11.2685 11.9834 11.3904 11.9326C11.5122 11.8819 11.6228 11.8075 11.7158 11.7137C11.8095 11.6208 11.8839 11.5102 11.9347 11.3883C11.9855 11.2664 12.0116 11.1357 12.0116 11.0037C12.0116 10.8717 11.9855 10.741 11.9347 10.6191C11.8839 10.4973 11.8095 10.3867 11.7158 10.2937L7.4158 6.00373Z" fill="#fff"></path>
                      </svg>
                    </button>

                    <a href="#" class="header__basket-item">
                      <div class="header__basket-img">
                        <img src="assets/images/carousel-2__prod.jpg">
                      </div>
                      <div class="header__basket-name">
                        <div class="header__basket-name-title">Производитель: FORWARD Модель: Quadro 3.0 D (2014) 17 сер.мат</div>
                        <div class="header__basket-name-subtitle">темно-синий-серебристый, 19"</div>
                      </div>
                      <div class="header__basket-price">23 080 ₽</div>
                      <button class="header__basket-remove">
                        <img src="assets/images/header__basket-remove.svg" alt="Удалить">
                      </button>
                    </a>
                    <a href="#" class="header__basket-item">
                      <div class="header__basket-img">
                        <img src="assets/images/carousel-2__prod.jpg">
                      </div>
                      <div class="header__basket-name">
                        <div class="header__basket-name-title">Производитель: FORWARD Модель: Quadro 3.0 D (2014) 17 сер.мат</div>
                        <div class="header__basket-name-subtitle">темно-синий-серебристый, 19"</div>
                      </div>
                      <div class="header__basket-price">23 080 ₽</div>
                      <button class="header__basket-remove">
                        <img src="assets/images/header__basket-remove.svg" alt="Удалить">
                      </button>
                    </a>
                    <div class="header__basket-footer">
                      <div class="header__basket-total">Общая стоимость: <span>44 040 ₽</span></div>
                      <a href="#" class="header__basket-order btn-1">Перейти к оформлению</a>
                    </div>
                  </div>
                </span>
              </div>-->
            </div>
          </div>
      </header>
<script type="text/javascript">
// Открытие фильтра на мобильных
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
    $(".wrapper1").toggleClass("close");
    $(".header__mob-search-trigger").toggleClass("z-index__low");
  });
  $(".header__mob-search-trigger").on("click", function (e) {
    e.preventDefault();
    $(".header__search").fadeIn();
    $(".mob-burger").fadeOut();
    $(".header__mob-search-trigger").fadeOut();
    $(".header__mob-search-trigger").css('opacity','0');
    //$(".mob-burger").fadeOut();
  });
</script>