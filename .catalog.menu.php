    <?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    global $APPLICATION;
    $aMenuLinksExt = $APPLICATION->IncludeComponent(
     "bitrix:menu.sections",
     "",
     array(
     "IS_SEF" => "Y",
     "ID" => $_REQUEST["ID"],
     "IBLOCK_TYPE" => "catalog",
     "IBLOCK_ID" => 55,//Укажите реальный ID инфоблока каталога
     "SECTION_URL" => "",
     "DEPTH_LEVEL" => "4",//Количество уровней меню
     "CACHE_TYPE" => "Y",//Настройки кеширования
     "CACHE_TIME" => "3600",
     //Настройки ЧПУ каталога
     "SEF_BASE_URL" => "/catalog/",
     "SECTION_PAGE_URL" => "#SECTION_CODE_PATH#/",
     "DETAIL_PAGE_URL" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/"
     ),
     false
    );
    $aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);