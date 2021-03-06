<?global $APPLICATION, $arRegion, $arSite, $arTheme, $bIndexBot;?>

<?CMax::ShowPageType('mega_menu');?>

<?CMax::get_banners_position('TOP_HEADER');?>

<div class="header_wrap title-v<?=$arTheme["PAGE_TITLE"]["VALUE"];?><?=($isIndex ? ' index' : '')?> <?$APPLICATION->AddBufferContent(array('CMax', 'getBannerClass'))?>">
	<header id="header">
		<?CMax::ShowPageType('header');?>
	</header>
</div>
<?CMax::get_banners_position('TOP_UNDERHEADER');?>

<?if($arTheme["TOP_MENU_FIXED"]["VALUE"] == 'Y'):?>
	<div id="headerfixed">
		<?CMax::ShowPageType('header_fixed');?>
	</div>
<?endif;?>

<div id="mobilefilter" class="scrollbar-filter"></div>

<?$APPLICATION->ShowViewContent('section_bnr_top_content');?>

<?include_once('top_wrapper1_custom.php');?>