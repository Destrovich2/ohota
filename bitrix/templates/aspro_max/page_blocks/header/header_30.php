<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
global $arTheme, $arRegion, $bLongHeader, $dopClass;
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
          <div class="hamburger__links">
            <a href="#" class="hamburger__link">Каталог товаров</a>
            <a href="#" class="hamburger__link">Подбор велосипеда</a>
            <a href="#" class="hamburger__link">Распродажа</a>
            <a href="#" class="hamburger__link">Ремонт и сервис</a>
            <a href="#" class="hamburger__link">Тест-драйв</a>
            <a href="#" class="hamburger__link">О нас</a>
          </div>
          <div class="hamburger__social">
            <a href="#" class="hamburger__social-item">
              <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M24.9249 7.34634C24.864 6.01578 24.6527 5.10712 24.3437 4.31213C24.0299 3.47805 23.5378 2.72255 22.9019 2.09808C22.2776 1.46217 21.5219 0.969887 20.6879 0.655937C19.8927 0.347137 18.9842 0.135994 17.6537 0.075531C16.3206 0.0144958 15.8947 0 12.5 0C9.1053 0 8.67939 0.0144958 7.34634 0.0751495C6.01578 0.135994 5.10731 0.347328 4.31213 0.656319C3.47805 0.970078 2.72255 1.46217 2.09808 2.09808C1.46217 2.72236 0.969887 3.47786 0.655937 4.31194C0.347137 5.10712 0.135994 6.01578 0.075531 7.34615C0.0144958 8.67939 0 9.10511 0 12.4998C0 15.8947 0.0144958 16.3206 0.075531 17.6537C0.136185 18.984 0.347519 19.8927 0.656509 20.6879C0.970268 21.5218 1.46236 22.2775 2.09827 22.9017C2.72255 23.5376 3.47824 24.0297 4.31232 24.3435C5.10731 24.6527 6.01597 24.8638 7.34653 24.9247C8.67977 24.9855 9.10549 24.9998 12.5002 24.9998C15.8949 24.9998 16.3208 24.9855 17.6538 24.9247C18.9844 24.8638 19.8929 24.6527 20.6881 24.3435C22.3671 23.6942 23.6944 22.3669 24.3437 20.6879C24.6529 19.8927 24.864 18.984 24.9249 17.6537C24.9855 16.3204 25 15.8947 25 12.5C25 9.10511 24.9855 8.67939 24.9249 7.34634ZM22.6748 17.5512C22.6192 18.77 22.4155 19.4319 22.2445 19.8723C21.8239 20.9625 20.9623 21.8241 19.8721 22.2446C19.4317 22.4157 18.7698 22.6194 17.551 22.6749C16.2333 22.7352 15.8379 22.7478 12.5 22.7478C9.16195 22.7478 8.76675 22.7352 7.44877 22.6749C6.23016 22.6194 5.56831 22.4157 5.12772 22.2446C4.58488 22.0442 4.09374 21.7247 3.69053 21.3095C3.2753 20.9063 2.95582 20.4153 2.75536 19.8723C2.58427 19.4319 2.38056 18.77 2.32506 17.5512C2.26498 16.2333 2.2522 15.8379 2.2522 12.5002C2.2522 9.16233 2.26498 8.76713 2.32506 7.44896C2.38075 6.23016 2.58427 5.56831 2.75536 5.12791C2.95582 4.58488 3.27549 4.09374 3.69053 3.69053C4.09374 3.2753 4.58488 2.95582 5.12791 2.75555C5.56831 2.58427 6.23016 2.38075 7.44896 2.32506C8.76694 2.26498 9.16233 2.2522 12.5 2.2522H12.4998C15.8375 2.2522 16.2329 2.26498 17.551 2.32525C18.7698 2.38075 19.4315 2.58446 19.8721 2.75555C20.4149 2.95601 20.9061 3.27549 21.3093 3.69053C21.7245 4.09374 22.044 4.58488 22.2443 5.12791C22.4155 5.56831 22.6192 6.23016 22.6748 7.44896C22.7348 8.76694 22.7476 9.16233 22.7476 12.5C22.7476 15.8379 22.735 16.2331 22.6748 17.5512Z" fill="url(#paint0_linear)" />
                <path d="M12.4996 6.08105C8.95461 6.08105 6.08081 8.95505 6.08081 12.5C6.08081 16.045 8.95461 18.9188 12.4996 18.9188C16.0448 18.9188 18.9186 16.045 18.9186 12.5C18.9186 8.95505 16.0448 6.08105 12.4996 6.08105ZM12.4996 16.6666C10.1986 16.6665 8.33301 14.8011 8.3332 12.4999C8.3332 10.1988 10.1986 8.33325 12.4998 8.33325C14.801 8.33344 16.6664 10.1988 16.6664 12.4999C16.6664 14.8011 14.8008 16.6666 12.4996 16.6666Z" fill="url(#paint1_linear)" />
                <path d="M20.6722 5.82752C20.6722 6.65588 20.0006 7.32746 19.1722 7.32746C18.3437 7.32746 17.6721 6.65588 17.6721 5.82752C17.6721 4.99897 18.3437 4.32739 19.1722 4.32739C20.0006 4.32739 20.6722 4.99897 20.6722 5.82752Z" fill="url(#paint2_linear)" />
                <defs>
                  <linearGradient id="paint0_linear" x1="2.09796" y1="22.9018" x2="22.902" y2="2.09776" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#FFD600" />
                    <stop offset="0.5" stop-color="#FF0100" />
                    <stop offset="1" stop-color="#D800B9" />
                  </linearGradient>
                  <linearGradient id="paint1_linear" x1="7.96089" y1="17.0388" x2="17.0386" y2="7.96112" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#FF6400" />
                    <stop offset="0.5" stop-color="#FF0100" />
                    <stop offset="1" stop-color="#FD0056" />
                  </linearGradient>
                  <linearGradient id="paint2_linear" x1="18.1115" y1="6.88807" x2="20.2328" y2="4.7668" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#F30072" />
                    <stop offset="1" stop-color="#E50097" />
                  </linearGradient>
                </defs>
              </svg>
            </a>
            <a href="#" class="hamburger__social-item">
              <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip10)">
                  <path d="M11.8941 0.0144578C5.29163 0.32883 0.0813465 5.82741 0.101376 12.4374C0.107474 14.4506 0.593502 16.3508 1.45088 18.0298L0.134499 24.4197C0.0632901 24.7653 0.375032 25.068 0.718401 24.9867L6.97972 23.5032C8.58835 24.3045 10.3952 24.7673 12.3074 24.7965C19.0558 24.8996 24.6827 19.5412 24.8931 12.7954C25.1185 5.56428 19.1505 -0.331124 11.8941 0.0144578ZM19.3652 19.2639C17.5315 21.0976 15.0935 22.1074 12.5003 22.1074C10.9819 22.1074 9.52818 21.7668 8.17939 21.0949L7.30742 20.6605L3.46859 21.5701L4.27664 17.6475L3.84706 16.8062C3.14686 15.435 2.79183 13.9521 2.79183 12.399C2.79183 9.80573 3.80168 7.36776 5.63535 5.53403C7.45265 3.71673 9.93044 2.69045 12.5005 2.69045C15.0937 2.69051 17.5316 3.70035 19.3652 5.53397C21.1989 7.36764 22.2088 9.80561 22.2088 12.3988C22.2088 14.9689 21.1825 17.4467 19.3652 19.2639Z" fill="#7AD06D" />
                  <path d="M18.5176 15.0879L16.1159 14.3983C15.8002 14.3076 15.4602 14.3972 15.2301 14.6316L14.6428 15.23C14.3951 15.4823 14.0194 15.5634 13.6916 15.4308C12.5555 14.971 10.1656 12.8461 9.55525 11.7832C9.37917 11.4766 9.40829 11.0933 9.62448 10.8135L10.1372 10.1502C10.3381 9.89026 10.3805 9.54121 10.2477 9.24077L9.23723 6.95544C8.9952 6.40807 8.29573 6.24873 7.83876 6.63521C7.16846 7.20213 6.37314 8.06363 6.27646 9.01805C6.106 10.7008 6.82766 12.822 9.55662 15.369C12.7093 18.3115 15.234 18.7003 16.8778 18.3021C17.8101 18.0763 18.5552 17.1709 19.0255 16.4297C19.346 15.9243 19.0929 15.2531 18.5176 15.0879Z" fill="#7AD06D" />
                </g>
                <defs>
                  <clipPath id="clip10">
                    <rect width="25" height="25" fill="white" />
                  </clipPath>
                </defs>
              </svg>
            </a>
          </div>
        </div>
        <button class="header__mob-search-trigger">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1534 13.6581C16.4727 11.9566 17.0944 9.81626 16.8922 7.67244C16.69 5.52862 15.6789 3.5424 14.0648 2.11786C12.4506 0.693311 10.3546 -0.0625465 8.20313 0.00405526C6.05167 0.070657 4.00638 0.954715 2.48335 2.47638C0.959004 3.99909 0.0724087 6.04599 0.00424256 8.19994C-0.0639235 10.3539 0.69147 12.4528 2.11649 14.0689C3.5415 15.6851 5.52889 16.6968 7.67366 16.8979C9.81843 17.0991 11.9592 16.4745 13.6596 15.1515L13.7051 15.1991L18.1929 19.6898C18.2912 19.7882 18.4079 19.8662 18.5364 19.9194C18.6648 19.9726 18.8024 20 18.9415 20C19.0805 20 19.2181 19.9726 19.3465 19.9194C19.475 19.8662 19.5917 19.7882 19.69 19.6898C19.7883 19.5915 19.8662 19.4748 19.9194 19.3463C19.9726 19.2178 20 19.0801 20 18.941C20 18.802 19.9726 18.6643 19.9194 18.5358C19.8662 18.4073 19.7883 18.2906 19.69 18.1922L15.201 13.7026C15.1856 13.6873 15.1697 13.6725 15.1534 13.6581V13.6581ZM12.9571 3.97398C13.5544 4.56189 14.0295 5.26229 14.3549 6.03479C14.6803 6.80728 14.8496 7.63659 14.853 8.47486C14.8564 9.31313 14.6939 10.1438 14.3748 10.9189C14.0557 11.694 13.5863 12.3983 12.9938 12.991C12.4013 13.5838 11.6973 14.0533 10.9225 14.3725C10.1477 14.6918 9.31739 14.8543 8.47945 14.8509C7.64151 14.8475 6.81254 14.6782 6.04035 14.3526C5.26816 14.0271 4.56804 13.5519 3.98036 12.9543C2.80595 11.7601 2.15079 10.1501 2.15761 8.47486C2.16443 6.79964 2.83267 5.19497 4.01677 4.0104C5.20087 2.82583 6.80489 2.15732 8.47945 2.1505C10.154 2.14368 11.7634 2.7991 12.9571 3.97398Z" fill="white" />
          </svg>
        </button>
        <div class="header__top">
          <div class="container">
            <div class="header__wrapper">
             
                   <a href="tel:" class="header__tel"><?=$arRegion['PHONES'][0]['PHONE']?></a>

                   <!--  <pre><?print_r($arRegion);?></pre> -->
                   
             
              <a href="#" class="header__callback">Обратный звонок</a>
              <div class="header__nav">
<!--                 <a href="#" class="header__nav-item">О нас</a>
                <a href="#" class="header__nav-item">Рассрочка</a>
                <a href="#" class="header__nav-item">Акции</a>
                <a href="#" class="header__nav-item">Доставка</a> -->
                    <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
                    array(
                      "COMPONENT_TEMPLATE" => ".default",
                      "PATH" => SITE_DIR."include/menu/menu.".($arTheme["HEADER_TYPE"]["LIST"][$arTheme["HEADER_TYPE"]["VALUE"]]["ADDITIONAL_OPTIONS"]["MENU_HEADER_TYPE"]["VALUE"] == "Y" ? "top_catalog_wide" : "top").".php",
                      "AREA_FILE_SHOW" => "file",
                      "AREA_FILE_SUFFIX" => "",
                      "AREA_FILE_RECURSIVE" => "Y",
                      "EDIT_TEMPLATE" => "include_area.php"
                    ),
                    false, array("HIDE_ICONS" => "Y")
                  );?>
              </div>
              <a href="#" class="header__user" style="display: none">
                <div class="header__user-name">Дмитрий Б.</div>
                <div class="header__user-photo">
                  <img src="assets/images/header__user.jpg" />
                </div>
              </a>
              <div class="header__auth">
                <a href="#" class="header__auth-link">Регистрация</a> /
                <a href="#" class="header__auth-link">Вход</a>
              </div>
            </div>
          </div>
        </div>
        <div class="header__bottom">
          <div class="container">
            <div class="header__wrapper">
              <a href="#" class="header__logo">
                <p>Охотник</p>
               <!--  <?=CMax::ShowLogo();?> -->
                <span>Оптовый Интернет-магазин</span>
              </a>
              <div class="header__catalog-wrapper">
                <button class="header__catalog">
                  <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="16" height="2" fill="white" />
                    <rect y="6" width="16" height="2" fill="white" />
                    <rect y="12" width="16" height="2" fill="white" />
                  </svg>
                  Каталог
                </button>
                <div class="catalog-menu --active">
                  <div class="catalog-menu__item --active">
                    <a href="#" class="catalog-menu__item-link">Одежда</a>
                    <div class="catalog-menu__dropdown">
                      <div class="catalog-menu__col">
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Летняя одежда</a>
                          <a href="#" class="catalog-menu__link">Костюмы горки</a>
                          <a href="#" class="catalog-menu__link">Тактический одежда</a>
                          <a href="#" class="catalog-menu__link">Маскхалат</a>
                          <a href="#" class="catalog-menu__link">Военная одежда</a>
                          <a href="#" class="catalog-menu__link">Брюки милитари</a>
                          <a href="#" class="catalog-menu__link">Футболки</a>
                          <a href="#" class="catalog-menu__link">Шорты</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Демисезонные костюмы</a>
                          <a href="#" class="catalog-menu__link">Костюмы горки</a>
                          <a href="#" class="catalog-menu__link">Тактический одежда</a>
                          <a href="#" class="catalog-menu__link">Военная одежда</a>
                          <a href="#" class="catalog-menu__link">Брюки милитари</a>
                          <a href="#" class="catalog-menu__link">Куртки</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Зимние костюмы</a>
                          <a href="#" class="catalog-menu__link">Костюмы горки</a>
                          <a href="#" class="catalog-menu__link">Тактический одежда</a>
                          <a href="#" class="catalog-menu__link">Военная одежда</a>
                          <a href="#" class="catalog-menu__link">Брюки милитари</a>
                          <a href="#" class="catalog-menu__link">Куртки</a>
                          <a href="#" class="catalog-menu__link">Куртки Аляски</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Жилеты</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Свитеры</a>
                        </div>
                      </div>
                      <div class="catalog-menu__col">
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Термобелье</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Дождевики и Шуршуны</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="catalog-menu__item">
                    <a href="#" class="catalog-menu__item-link">Обувь</a>
                    <div class="catalog-menu__dropdown">
                      <div class="catalog-menu__col">
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Летняя обувь</a>
                          <a href="#" class="catalog-menu__link">Берцы</a>
                          <a href="#" class="catalog-menu__link">Кроссовки</a>
                          <a href="#" class="catalog-menu__link">Ботинки</a>
                          <a href="#" class="catalog-menu__link">Полуботинки</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Демисезонная обувь</a>
                          <a href="#" class="catalog-menu__link">Берцы</a>
                          <a href="#" class="catalog-menu__link">Обувь с мембраной</a>
                          <a href="#" class="catalog-menu__link">Ботинки</a>
                          <a href="#" class="catalog-menu__link">Полуботинки</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Зимняя обувь</a>
                          <a href="#" class="catalog-menu__link">Берцы</a>
                          <a href="#" class="catalog-menu__link">Обувь с мембраной</a>
                          <a href="#" class="catalog-menu__link">Ботинки</a>
                          <a href="#" class="catalog-menu__link">Полуботинки</a>
                          <a href="#" class="catalog-menu__link">Вкладыши</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Резиновые сапоги</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Сопутствующие товары</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="catalog-menu__item">
                    <a href="#" class="catalog-menu__item-link">Снаряжение</a>
                    <div class="catalog-menu__dropdown">
                      <div class="catalog-menu__col">
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Тактические рюкзаки</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Тактические подсумки</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Разгрузки</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Пантронтажи</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Тактические перчатки</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Кобура</a>
                        </div>
                      </div>
                      <div class="catalog-menu__col">
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Ягтдаши</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Бинокли</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Карематы и поджопники</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Фляги</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Наколенники и налокотники</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Нессесеры</a>
                        </div>
                      </div>
                      <div class="catalog-menu__col">
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Чехлы для ружья</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Ножи и мультитулы</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Тактические очки</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Спальные мешки</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Шлемы</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Гидраторы</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="catalog-menu__item">
                    <a href="#" class="catalog-menu__item-link">Головные уборы</a>
                    <div class="catalog-menu__dropdown">
                      <div class="catalog-menu__col">
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Бейсболки</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Шапки флисовые</a>
                          <a href="#" class="catalog-menu__link">Шапки-ушанки</a>
                          <a href="#" class="catalog-menu__link">Шапки зимние</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Фуражки</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Балаклавы</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Банданы</a>
                        </div>
                      </div>
                      <div class="catalog-menu__col">
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Панамы</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="catalog-menu__item">
                    <a href="#" class="catalog-menu__item-link">Спецодежда</a>
                  </div>
                  <div class="catalog-menu__item">
                    <a href="#" class="catalog-menu__item-link">Аксессуары</a>
                    <div class="catalog-menu__dropdown">
                      <div class="catalog-menu__col">
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Ремни</a>
                          <a href="#" class="catalog-menu__link">Тактические</a>
                          <a href="#" class="catalog-menu__link">Кожаные</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Часы</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="catalog-menu__item">
                    <a href="#" class="catalog-menu__item-link">Всякая всячина</a>
                    <div class="catalog-menu__dropdown">
                      <div class="catalog-menu__col">
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Оруженные сейфы</a>
                        </div>
                        <div class="catalog-menu__section">
                          <a href="#" class="catalog-menu__title">Маскировачная сеть</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="header__search">
                <input type="search" class="header__search-input" placeholder="Введите название товара" />
                <div class="header__search__search-results" style="display: none">
                  <div class="header__search__search-results-inner">
                    <a href="#" class="header__search__search-results-item">
                      <div class="header__search__search-results-img">
                        <img src="assets/images/carousel-2__prod.jpg" />
                      </div>
                      <div class="header__search__search-results-name"><span>Самокат</span> lobber FLOW 125 (2021) зеленый две строки под название</div>
                      <div class="header__search__search-results-price"><strong>7800</strong> Р.</div>
                    </a>
                    <a href="#" class="header__search__search-results-item">
                      <div class="header__search__search-results-img">
                        <img src="assets/images/carousel-2__prod.jpg" />
                      </div>
                      <div class="header__search__search-results-name"><span>Самокат</span> lobber FLOW 125 (2021) зеленый две строки под название</div>
                      <div class="header__search__search-results-price"><strong>7800</strong> Р.</div>
                    </a>
                    <a href="#" class="header__search__search-results-item">
                      <div class="header__search__search-results-img">
                        <img src="assets/images/carousel-2__prod.jpg" />
                      </div>
                      <div class="header__search__search-results-name"><span>Самокат</span> lobber FLOW 125 (2021) зеленый две строки под название</div>
                      <div class="header__search__search-results-price"><strong>7800</strong> Р.</div>
                    </a>
                    <a href="#" class="header__search__search-results-item">
                      <div class="header__search__search-results-img">
                        <img src="assets/images/carousel-2__prod.jpg" />
                      </div>
                      <div class="header__search__search-results-name"><span>Самокат</span> lobber FLOW 125 (2021) зеленый две строки под название</div>
                      <div class="header__search__search-results-price"><strong>7800</strong> Р.</div>
                    </a>
                    <a href="#" class="header__search__search-results-item">
                      <div class="header__search__search-results-img">
                        <img src="assets/images/carousel-2__prod.jpg" />
                      </div>
                      <div class="header__search__search-results-name"><span>Самокат</span> lobber FLOW 125 (2021) зеленый две строки под название</div>
                      <div class="header__search__search-results-price"><strong>7800</strong> Р.</div>
                    </a>
                  </div>
                </div>
              </div>
              <div class="header__btns">
                <span class="header__btn-wrapper">
                  <a href="#" class="header__btn">
                    <span class="header__btn-ico">
                      <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.80398 4.94398C10.1453 4.94398 11.3603 5.48831 12.2399 6.36792L9.776 8.8319H15.6079V3L13.6153 4.99255C12.3858 3.76302 10.6848 3 8.80398 3C5.37774 3 2.54926 5.53688 2.07788 8.8319H4.04127C4.49325 6.61578 6.45181 4.94398 8.80398 4.94398Z" fill="#008E1F" />
                        <path d="M14.2859 13.8226C14.9322 12.9429 15.3696 11.9029 15.53 10.7754H13.5666C13.1147 12.9915 11.1561 14.6633 8.80387 14.6633C7.46253 14.6633 6.24754 14.119 5.36792 13.2394L7.8319 10.7754H2V16.6073L3.99255 14.6147C5.22213 15.8443 6.92308 16.6073 8.80387 16.6073C10.3105 16.6073 11.7004 16.1116 12.8279 15.2805L17.5517 19.9995L19 18.5512L14.2859 13.8226Z" fill="#008E1F" />
                      </svg>
                    </span>
                    <div class="header__btn-text">Сравнение товаров</div>
                  </a>
                  <div class="header__btn-complete" style="display: none">
                    <button class="header__btn-complete-close">
                      <img src="assets/images/header__btn-complete-close.svg" alt="Закрыть" />
                    </button>
                    <div class="header__btn-complete-text">Товар успешно добавлен для сравнения.</div>
                  </div>
                </span>
                <span class="header__btn-wrapper">
                  <a href="#" class="header__btn">
                    <span class="header__btn-ico">
                      <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M18.6092 7.12061C18.857 7.33859 19.0418 7.62014 19.1441 7.93475C19.2463 8.24936 19.2623 8.58581 19.1899 8.90782C19.1118 9.25521 18.9346 9.57089 18.6786 9.82048L16.1617 12.2739L16.7558 15.7382C16.8476 16.2736 16.7002 16.819 16.3507 17.2335C15.9996 17.65 15.4863 17.8897 14.9428 17.8897C14.6462 17.8897 14.3506 17.8162 14.0867 17.6774L10.9756 16.0418L7.86457 17.6774C7.60074 17.8161 7.3051 17.8897 7.00844 17.8897C6.46497 17.8897 5.95166 17.65 5.60057 17.2335C5.2511 16.819 5.10368 16.2736 5.19548 15.7382L5.78966 12.2739L3.27275 9.8205C3.01668 9.57093 2.83945 9.25519 2.76137 8.90782C2.68903 8.58583 2.70504 8.24941 2.80725 7.9348C2.90949 7.62016 3.09425 7.33857 3.34208 7.1206C3.60945 6.88544 3.93838 6.73421 4.29222 6.6828L7.77053 6.17739L9.32607 3.02545C9.48431 2.70482 9.72977 2.4387 10.036 2.25708C10.3199 2.08873 10.6448 2 10.9756 2C11.3065 2 11.6314 2.08878 11.9152 2.25708C12.2215 2.4387 12.467 2.70485 12.6252 3.02544L14.1807 6.17736L17.6591 6.6828C18.0129 6.73422 18.3418 6.88547 18.6092 7.12061ZM13.3959 7.81593L17.4097 8.39918C17.4308 8.40224 17.4487 8.4109 17.463 8.42312L17.4679 8.57851L14.5635 11.4097C14.3974 11.5717 14.3215 11.8051 14.3608 12.0339L15.0464 16.0315C15.0526 16.0676 15.0423 16.0957 15.023 16.1176C15.0013 16.1421 14.9708 16.1553 14.9428 16.1553C14.929 16.1553 14.9127 16.1522 14.8938 16.1423L11.3038 14.2549C11.2011 14.2009 11.0883 14.1739 10.9757 14.1739C10.863 14.1739 10.7502 14.2009 10.6475 14.2549L7.05748 16.1423C7.03871 16.1522 7.02236 16.1553 7.00849 16.1553C6.98049 16.1553 6.95 16.1421 6.9283 16.1176C6.90898 16.0957 6.89874 16.0676 6.90494 16.0314L7.59057 12.0339C7.62985 11.8051 7.55396 11.5717 7.38779 11.4097L4.48332 8.57851C4.42095 8.51771 4.45536 8.41172 4.5416 8.39917L8.5554 7.81593C8.78508 7.78256 8.98361 7.63829 9.08633 7.43018L10.8814 3.793C10.8924 3.77063 10.9064 3.75735 10.9207 3.7489C10.936 3.73981 10.9551 3.7344 10.9756 3.7344C10.9962 3.7344 11.0153 3.73981 11.0306 3.7489C11.0448 3.75735 11.0589 3.77065 11.0699 3.79301L12.865 7.43022C12.9677 7.63823 13.1661 7.78255 13.3959 7.81593Z" fill="#FFC700" />
                      </svg>
                    </span>
                    <div class="header__btn-text">Избранное</div>
                  </a>
                  <div class="header__btn-complete" style="display: none">
                    <button class="header__btn-complete-close">
                      <img src="assets/images/header__btn-complete-close.svg" alt="Закрыть" />
                    </button>
                    <div class="header__btn-complete-text">Товар успешно добавлен в избранное.</div>
                  </div>
                </span>
                <span class="header__btn-wrapper">
                  <a href="#" class="header__btn jsShowBasket">
                    <span class="header__btn-ico">
                      <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.4579 19.8327C13.0105 19.8327 13.5404 19.6132 13.9311 19.2225C14.3218 18.8318 14.5413 18.3019 14.5413 17.7493C14.5413 17.1968 14.3218 16.6669 13.9311 16.2762C13.5404 15.8855 13.0105 15.666 12.4579 15.666C11.9054 15.666 11.3755 15.8855 10.9848 16.2762C10.5941 16.6669 10.3746 17.1968 10.3746 17.7493C10.3746 18.3019 10.5941 18.8318 10.9848 19.2225C11.3755 19.6132 11.9054 19.8327 12.4579 19.8327ZM5.16626 19.8327C5.71879 19.8327 6.24869 19.6132 6.63939 19.2225C7.0301 18.8318 7.24959 18.3019 7.24959 17.7493C7.24959 17.1968 7.0301 16.6669 6.63939 16.2762C6.24869 15.8855 5.71879 15.666 5.16626 15.666C4.61372 15.666 4.08382 15.8855 3.69312 16.2762C3.30242 16.6669 3.08292 17.1968 3.08292 17.7493C3.08292 18.3019 3.30242 18.8318 3.69312 19.2225C4.08382 19.6132 4.61372 19.8327 5.16626 19.8327ZM18.7475 5.16914C19.0075 5.16075 19.2541 5.05156 19.4351 4.86464C19.6161 4.67773 19.7173 4.42775 19.7173 4.16758C19.7173 3.9074 19.6161 3.65743 19.4351 3.47051C19.2541 3.2836 19.0075 3.1744 18.7475 3.16602H17.5485C16.609 3.16602 15.7965 3.8181 15.5923 4.73477L14.2871 10.6118C14.0829 11.5285 13.2704 12.1806 12.3308 12.1806H4.50584L3.00376 6.17018H12.7381C12.9957 6.15843 13.2389 6.04783 13.417 5.86138C13.5951 5.67494 13.6945 5.427 13.6945 5.16914C13.6945 4.91128 13.5951 4.66334 13.417 4.4769C13.2389 4.29045 12.9957 4.17985 12.7381 4.1681H3.00376C2.69924 4.16801 2.39871 4.23735 2.12502 4.37084C1.85133 4.50434 1.61167 4.69848 1.42427 4.9385C1.23688 5.17852 1.10667 5.45811 1.04355 5.75601C0.980425 6.05391 0.986055 6.36228 1.06001 6.65768L2.56209 12.666C2.67038 13.0996 2.92052 13.4844 3.27272 13.7594C3.62493 14.0345 4.05898 14.1838 4.50584 14.1837H12.3308C13.2425 14.1838 14.127 13.873 14.8381 13.3026C15.5493 12.7321 16.0446 11.9362 16.2423 11.0462L17.5485 5.16914H18.7475Z" fill="#FF7B01" />
                      </svg>
                      <div class="header__btn-badge">2</div>
                    </span>
                    <div class="header__btn-text">Корзина</div>
                  </a>
                  <div class="header__btn-complete" style="display: none">
                    <button class="header__btn-complete-close">
                      <img src="assets/images/header__btn-complete-close.svg" alt="Закрыть" />
                    </button>
                    <div class="header__btn-complete-text">Товар успешно добавлен в корзину.</div>
                  </div>
                  <div class="header__basket" style="display: none">
                    <div class="header__basket-title">Корзина товаров</div>
                    <button class="header__basket-close jsCloseBasket">
                      <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.4158 6.00373L11.7158 1.71373C11.9041 1.52542 12.0099 1.27003 12.0099 1.00373C12.0099 0.737424 11.9041 0.482029 11.7158 0.293726C11.5275 0.105422 11.2721 -0.000366211 11.0058 -0.000366211C10.7395 -0.000366211 10.4841 0.105422 10.2958 0.293726L6.0058 4.59373L1.7158 0.293726C1.52749 0.105422 1.2721 -0.000366213 1.0058 -0.000366211C0.739497 -0.000366209 0.484102 0.105422 0.295798 0.293726C0.107495 0.482029 0.0017066 0.737424 0.0017066 1.00373C0.0017066 1.27003 0.107495 1.52542 0.295798 1.71373L4.5958 6.00373L0.295798 10.2937C0.20207 10.3867 0.127676 10.4973 0.0769072 10.6191C0.0261385 10.741 0 10.8717 0 11.0037C0 11.1357 0.0261385 11.2664 0.0769072 11.3883C0.127676 11.5102 0.20207 11.6208 0.295798 11.7137C0.388761 11.8075 0.499362 11.8819 0.621222 11.9326C0.743081 11.9834 0.873786 12.0095 1.0058 12.0095C1.13781 12.0095 1.26852 11.9834 1.39038 11.9326C1.51223 11.8819 1.62284 11.8075 1.7158 11.7137L6.0058 7.41373L10.2958 11.7137C10.3888 11.8075 10.4994 11.8819 10.6212 11.9326C10.7431 11.9834 10.8738 12.0095 11.0058 12.0095C11.1378 12.0095 11.2685 11.9834 11.3904 11.9326C11.5122 11.8819 11.6228 11.8075 11.7158 11.7137C11.8095 11.6208 11.8839 11.5102 11.9347 11.3883C11.9855 11.2664 12.0116 11.1357 12.0116 11.0037C12.0116 10.8717 11.9855 10.741 11.9347 10.6191C11.8839 10.4973 11.8095 10.3867 11.7158 10.2937L7.4158 6.00373Z" fill="#C4C4C4" />
                      </svg>
                    </button>
                    <a href="#" class="header__basket-item">
                      <div class="header__basket-img">
                        <img src="assets/images/carousel-2__prod.jpg" />
                      </div>
                      <div class="header__basket-name">
                        <div class="header__basket-name-title">Производитель: FORWARD Модель: Quadro 3.0 D (2014) 17 сер.мат</div>
                        <div class="header__basket-name-subtitle">темно-синий-серебристый, 19"</div>
                      </div>
                      <div class="header__basket-price">23 080 ₽</div>
                      <button class="header__basket-remove">
                        <img src="assets/images/header__basket-remove.svg" alt="Удалить" />
                      </button>
                    </a>
                    <a href="#" class="header__basket-item">
                      <div class="header__basket-img">
                        <img src="assets/images/carousel-2__prod.jpg" />
                      </div>
                      <div class="header__basket-name">
                        <div class="header__basket-name-title">Производитель: FORWARD Модель: Quadro 3.0 D (2014) 17 сер.мат</div>
                        <div class="header__basket-name-subtitle">темно-синий-серебристый, 19"</div>
                      </div>
                      <div class="header__basket-price">23 080 ₽</div>
                      <button class="header__basket-remove">
                        <img src="assets/images/header__basket-remove.svg" alt="Удалить" />
                      </button>
                    </a>
                    <div class="header__basket-footer">
                      <div class="header__basket-total">Общая стоимость: <span>44 040 ₽</span></div>
                      <a href="#" class="header__basket-order btn-1">Перейти к оформлению</a>
                    </div>
                  </div>
                </span>
              </div>
            </div>
          </div>
        </div>
      </header>