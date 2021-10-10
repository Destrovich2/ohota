<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!--noindex-->
	<?$count=count($arResult);?>
	<?
    echo "<pre>";
    echo var_dump($arResult);
    echo "</pre>";
	$type_svg = '';
	if($arParams["CLASS_ICON"])
	{
		$tmp = explode(' ', $arParams["CLASS_ICON"]);
		$type_svg = '_'.$tmp[0];
	}
	?>
	<a class="header__btn" href="<?=$arParams["COMPARE_URL"]?>" title="">

		<span class="header__btn">
			<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.80398 4.94398C10.1453 4.94398 11.3603 5.48831 12.2399 6.36792L9.776 8.8319H15.6079V3L13.6153 4.99255C12.3858 3.76302 10.6848 3 8.80398 3C5.37774 3 2.54926 5.53688 2.07788 8.8319H4.04127C4.49325 6.61578 6.45181 4.94398 8.80398 4.94398Z" fill="#fff"></path>
                        <path d="M14.2859 13.8226C14.9322 12.9429 15.3696 11.9029 15.53 10.7754H13.5666C13.1147 12.9915 11.1561 14.6633 8.80387 14.6633C7.46253 14.6633 6.24754 14.119 5.36792 13.2394L7.8319 10.7754H2V16.6073L3.99255 14.6147C5.22213 15.8443 6.92308 16.6073 8.80387 16.6073C10.3105 16.6073 11.7004 16.1116 12.8279 15.2805L17.5517 19.9995L19 18.5512L14.2859 13.8226Z" fill="#fff"></path>
                      </svg>

		
                      <span class="count header__btn-badge" style="top: -12px;"><?=$count;?></span></span>
                      <div class="header__btn-text">Сравнение товаров</div>
	</a>
	<?global $compare_items;
	$compare_items = array_keys($arResult);?>
<!--/noindex-->