    <? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    if (!empty($arResult)):?>
      <div class="header__catalog-wrapper dv-btncatalog" href="/catalog/">
            <button class="header__catalog"><svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="16" height="2"></rect><rect y="6" width="16" height="2"></rect><rect y="12" width="16" height="2"></rect></svg>Каталог</button>
            <ul style="display:none" class="dv-ulcatalog">
    <?function getItems($a) {?>
      
                        
      
      <?
    foreach($a as $arItem):?>
     <li <?=$arItem["SELECTED"]?' class="active"':''/*выделяем активный пункт (текущий раздел)*/?>> <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
     <?if($arItem["IS_PARENT"]):?>
     <ul>
     <?getItems($arItem["CHILDREN"])?>
     </ul>
     <?endif?>
     </li>
    <?endforeach;?>
 
    
    <? }
    getItems($arResult);?>
    <?endif?>
       </ul>
    </div>
  <style type="text/css">
    .dv-btncatalog:hover .dv-ulcatalog{display: block!important;}
    .dv-btncatalog{position: relative;}
    .dv-ulcatalog ul{margin: 0;display: none;}
    .dv-ulcatalog{position: absolute;margin-top: 0;padding: 0;top: 70px;left: 0;background-color: #1A1A1A;width: 200px;}
    .dv-ulcatalog>li{margin: 0;padding: 0; list-style: none;padding: 0 22px;position: unset;}
    .dv-ulcatalog>li:hover {background-color: #FFD300;}
    .dv-ulcatalog>li:hover>a:after {
    content: "";
    position: absolute;
    right: -22px;
    top: 0;
    bottom: -1px;
    width: 22px;
    background-color: #030303;
    background-image: url("/images/catalog-menu__arrow.svg");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: 8px 16px;
}
    .dv-ulcatalog li:before{display: none;}
    .dv-ulcatalog>li>a{display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
height: 54px;
border-bottom: 1px solid #383838;
font-size: 16px;
color: #fff;
padding: 0 8px;
position: relative;
transition: none;
-webkit-transition: none;}
.dv-ulcatalog>li:hover>a{border-bottom-color: transparent;color: black;}
.dv-ulcatalog>li:last-of-type>a {border-bottom: 0;}
.dv-ulcatalog>li:hover ul{display: block;}
.dv-ulcatalog>li:hover>ul>li:nth-child(odd){margin-right: 40px;}
.dv-ulcatalog>li:hover>ul>li>ul{margin-bottom: 20px;}
.dv-ulcatalog>li:hover>ul>li>ul>a{font-size: 14px;
color: #2F2F2F;
display: block;
padding: 4px 0;}
.dv-ulcatalog>li:hover>ul>li>ul li{margin-left: 0;}
.dv-ulcatalog>li>ul {
    position: absolute;
    left: 100%;
    top: 0;
    display: none;
    background-color: #fff;
    padding: 30px 30px;
    width: 520px;
    height: auto;
    columns: 210px auto;
}
.dv-ulcatalog>li:hover>ul>li {
    margin: 0;
    display: inline-block;
    width: 210px;
}
.dv-ulcatalog>li:hover>ul>li>a {
    font-size: 16px;
    font-weight: bold;
    color: #000000;
    padding-bottom: 15px;
    border-bottom: 1px solid #C4C4C4;
    text-decoration: none !important;
    display: inline-block;
    width: 100%;
    margin-bottom: 8px;
}
</style>
<!-- <script src="/js/jquery.matchHeight-min.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {

    $('.dv-ulcatalog>li:hover>ul>li').matchHeight();

});
</script> -->