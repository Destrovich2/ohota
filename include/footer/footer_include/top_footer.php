<?global $APPLICATION, $arRegion, $arSite, $arTheme, $bIndexBot, $is404, $isForm, $isIndex;?>
<?if($APPLICATION->GetProperty("viewed_show") == "Y" || $is404):?>
	<?$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	"main", 
	array(
		"COMPONENT_TEMPLATE" => "main",
		"PATH" => "",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "",
		"AREA_FILE_RECURSIVE" => "Y",
		"EDIT_TEMPLATE" => "standard.php",
		"PRICE_CODE" => array(
			0 => "BASE",
			1 => "",
		),
		"STORES" => array(
			0 => "",
			1 => "",
		),
		"BIG_DATA_RCM_TYPE" => "bestsell",
		"STIKERS_PROP" => "",
		"SALE_STIKER" => "",
		"SHOW_DISCOUNT_PERCENT_NUMBER" => "N"
	),
	false
);?>
<?endif;?>
<?CMax::ShowPageType('footer');?>

<?include_once('top_footer_custom.php');?>

<!-- marketnig popups -->
<?$APPLICATION->IncludeComponent(
	"aspro:marketing.popup.max", 
	".default", 
	array(),
	false, array('HIDE_ICONS' => 'Y')
);?>
<!-- /marketnig popups -->