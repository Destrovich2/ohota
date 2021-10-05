<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!CModule::IncludeModule("iblock")) return;

$wizardSiteId = defined("WIZARD_SITE_ID") ? WIZARD_SITE_ID : $GLOBALS['WIZARD_SITE_ID'];
$wizardSiteDir = defined("WIZARD_SITE_DIR") ? WIZARD_SITE_DIR : $GLOBALS['WIZARD_SITE_DIR'];
$wizardSitePath = defined("WIZARD_SITE_PATH") ? WIZARD_SITE_PATH : $GLOBALS['WIZARD_SITE_PATH'];
if(!$wizardSiteId || !$wizardSiteDir || !$wizardSitePath) return;
if(!defined("WIZARD_TEMPLATE_ID")) return;
if(!defined("WIZARD_TEMPLATE_ABSOLUTE_PATH")) return;
if(!defined("WIZARD_THEME_ID")) return;

$bitrixTemplateDir = $_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/templates/".WIZARD_TEMPLATE_ID."/";
//$bitrixTemplateDir = $_SERVER["DOCUMENT_ROOT"]."/local/templates/".WIZARD_TEMPLATE_ID."/";

$iblockShortCODE = "catalog_info";
$iblockXMLFile = WIZARD_SERVICE_RELATIVE_PATH."/xml/".LANGUAGE_ID."/".$iblockShortCODE.".xml";
$iblockTYPE = "aspro_max_catalog";
$iblockXMLID = "aspro_max_".$iblockShortCODE."_".WIZARD_SITE_ID;
$iblockCODE = "aspro_max_".$iblockShortCODE;
$iblockID = false;

$rsIBlock = CIBlock::GetList(array(), array("XML_ID" => $iblockXMLID, "TYPE" => $iblockTYPE));
if ($arIBlock = $rsIBlock->Fetch()) {
	$iblockID = $arIBlock["ID"];
	if (WIZARD_INSTALL_DEMO_DATA) {
		// delete if already exist & need install demo
		CIBlock::Delete($arIBlock["ID"]);
		$iblockID = false;
	}
}

if(WIZARD_INSTALL_DEMO_DATA){
	if(!$iblockID){
		// add new iblock
		$permissions = array("1" => "X", "2" => "R");
		$dbGroup = CGroup::GetList($by = "", $order = "", array("STRING_ID" => "content_editor"));
		if($arGroup = $dbGroup->Fetch()){
			$permissions[$arGroup["ID"]] = "W";
		};

		// replace macros IN_XML_SITE_ID & IN_XML_SITE_DIR in xml file - for correct url links to site
		if(file_exists($_SERVER["DOCUMENT_ROOT"].$iblockXMLFile.".back")){
			@copy($_SERVER["DOCUMENT_ROOT"].$iblockXMLFile.".back", $_SERVER["DOCUMENT_ROOT"].$iblockXMLFile);
		}
		@copy($_SERVER["DOCUMENT_ROOT"].$iblockXMLFile, $_SERVER["DOCUMENT_ROOT"].$iblockXMLFile.".back");
		CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"].$iblockXMLFile, Array("IN_XML_SITE_DIR" => WIZARD_SITE_DIR));
		CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"].$iblockXMLFile, Array("IN_XML_SITE_ID" => WIZARD_SITE_ID));
		$iblockID = WizardServices::ImportIBlockFromXML($iblockXMLFile, $iblockCODE, $iblockTYPE, WIZARD_SITE_ID, $permissions);
		if(file_exists($_SERVER["DOCUMENT_ROOT"].$iblockXMLFile.".back")){
			@copy($_SERVER["DOCUMENT_ROOT"].$iblockXMLFile.".back", $_SERVER["DOCUMENT_ROOT"].$iblockXMLFile);
		}
		if ($iblockID < 1)	return;

		// iblock fields
		$iblock = new CIBlock;
		$arFields = array(
			"ACTIVE" => "Y",
			"CODE" => $iblockCODE,
			"XML_ID" => $iblockXMLID,
			"FIELDS" => array(
				"IBLOCK_SECTION" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "Array",
				),
				"ACTIVE" => array(
					"IS_REQUIRED" => "Y",
					"DEFAULT_VALUE"=> "Y",
				),
				"ACTIVE_FROM" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "",
				),
				"ACTIVE_TO" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "",
				),
				"SORT" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "0",
				),
				"NAME" => array(
					"IS_REQUIRED" => "Y",
					"DEFAULT_VALUE" => "",
				),
				"PREVIEW_PICTURE" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => array(
						"FROM_DETAIL" => "N",
						"SCALE" => "Y",
						"WIDTH" => "800",
						"HEIGHT" => "800",
						"IGNORE_ERRORS" => "N",
						"METHOD" => "resample",
						"COMPRESSION" => 95,
						"DELETE_WITH_DETAIL" => "N",
						"UPDATE_WITH_DETAIL" => "N",
					),
				),
				"PREVIEW_TEXT_TYPE" => array(
					"IS_REQUIRED" => "Y",
					"DEFAULT_VALUE" => "text",
				),
				"PREVIEW_TEXT" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "",
				),
				"DETAIL_PICTURE" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => array(
						"SCALE" => "Y",
						"WIDTH" => "2000",
						"HEIGHT" => "2000",
						"IGNORE_ERRORS" => "N",
						"METHOD" => "resample",
						"COMPRESSION" => 95,
					),
				),
				"DETAIL_TEXT_TYPE" => array(
					"IS_REQUIRED" => "Y",
					"DEFAULT_VALUE" => "text",
				),
				"DETAIL_TEXT" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "",
				),
				"XML_ID" =>  array(
					"IS_REQUIRED" => "Y",
					"DEFAULT_VALUE" => "",
				),
				"CODE" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => array(
						"UNIQUE" => "N",
						"TRANSLITERATION" => "N",
						"TRANS_LEN" => 100,
						"TRANS_CASE" => "L",
						"TRANS_SPACE" => "-",
						"TRANS_OTHER" => "-",
						"TRANS_EAT" => "Y",
						"USE_GOOGLE" => "N",
					),
				),
				"TAGS" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "",
				),
				"SECTION_NAME" => array(
					"IS_REQUIRED" => "Y",
					"DEFAULT_VALUE" => "",
				),
				"SECTION_PICTURE" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => array(
						"FROM_DETAIL" => "N",
						"SCALE" => "N",
						"WIDTH" => "",
						"HEIGHT" => "",
						"IGNORE_ERRORS" => "N",
						"METHOD" => "resample",
						"COMPRESSION" => 95,
						"DELETE_WITH_DETAIL" => "N",
						"UPDATE_WITH_DETAIL" => "N",
					),
				),
				"SECTION_DESCRIPTION_TYPE" => array(
					"IS_REQUIRED" => "Y",
					"DEFAULT_VALUE" => "text",
				),
				"SECTION_DESCRIPTION" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "",
				),
				"SECTION_DETAIL_PICTURE" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => array(
						"SCALE" => "N",
						"WIDTH" => "",
						"HEIGHT" => "",
						"IGNORE_ERRORS" => "N",
						"METHOD" => "resample",
						"COMPRESSION" => 95,
					),
				),
				"SECTION_XML_ID" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "",
				),
				"SECTION_CODE" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => array(
						"UNIQUE" => "N",
						"TRANSLITERATION" => "N",
						"TRANS_LEN" => 100,
						"TRANS_CASE" => "L",
						"TRANS_SPACE" => "-",
						"TRANS_OTHER" => "-",
						"TRANS_EAT" => "Y",
						"USE_GOOGLE" => "N",
					),
				),
			),
		);

		$iblock->Update($iblockID, $arFields);
	}
	else{
		// attach iblock to site
		$arSites = array();
		$db_res = CIBlock::GetSite($iblockID);
		while ($res = $db_res->Fetch())
			$arSites[] = $res["LID"];
		if (!in_array(WIZARD_SITE_ID, $arSites)){
			$arSites[] = WIZARD_SITE_ID;
			$iblock = new CIBlock;
			$iblock->Update($iblockID, array("LID" => $arSites));
		}
	}

	$_SESSION["WIZARD_MAXIMUM_CATALOG_INFO_IBLOCK_ID"] = $iblockID;

	// iblock user fields
	$dbSite = CSite::GetByID(WIZARD_SITE_ID);
	if($arSite = $dbSite -> Fetch()) $lang = $arSite["LANGUAGE_ID"];
	if(!strlen($lang)) $lang = "ru";
	WizardServices::IncludeServiceLang("iblocks/".$iblockShortCODE.".php", $lang);
	$arProperty = array();
	$dbProperty = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $iblockID));
	while($arProp = $dbProperty->Fetch())
		$arProperty[$arProp["CODE"]] = $arProp["ID"];

	// properties hints
	$ibp = new CIBlockProperty;
	$ibp->Update($arProperty["I_SKU_PAGE_TITLE"], array("HINT" => GetMessage("WZD_PROPERTY_HINT_1")));
	unset($ibp);
	$ibp = new CIBlockProperty;
	$ibp->Update($arProperty["I_SKU_PREVIEW_PICTURE_FILE_TITLE"], array("HINT" => GetMessage("WZD_PROPERTY_HINT_2")));
	unset($ibp);
	$ibp = new CIBlockProperty;
	$ibp->Update($arProperty["I_SKU_PREVIEW_PICTURE_FILE_ALT"], array("HINT" => GetMessage("WZD_PROPERTY_HINT_3")));
	unset($ibp);

	// edit form user options
	CUserOptions::SetOption("form", "form_element_".$iblockID, array(
		"tabs" => 'edit1--#--'.GetMessage("WZD_OPTION_0").'--,--ID--#--'.GetMessage("WZD_OPTION_2").'--,--ACTIVE--#--'.GetMessage("WZD_OPTION_4").'--,--NAME--#--'.GetMessage("WZD_OPTION_6").'--,--XML_ID--#--'.GetMessage("WZD_OPTION_8").'--,--SORT--#--'.GetMessage("WZD_OPTION_10").'--,--IBLOCK_ELEMENT_PROP_VALUE--#--'.GetMessage("WZD_OPTION_12").'--,--PROPERTY_'.$arProperty["SECTION"].'--#--'.GetMessage("WZD_OPTION_14").'--,--PROPERTY_'.$arProperty["SECTION_SERVICES"].'--#--'.GetMessage("WZD_OPTION_16").'--,--PROPERTY_'.$arProperty["FILTER_URL"].'--#--'.GetMessage("WZD_OPTION_18").'--,--PROPERTY_'.$arProperty["LINK_REGION"].'--#--'.GetMessage("WZD_OPTION_20").'--;--cedit1--#--'.GetMessage("WZD_OPTION_22").'--,--PROPERTY_'.$arProperty["FORM_QUESTION"].'--#--'.GetMessage("WZD_OPTION_24").'--,--PROPERTY_'.$arProperty["TIZERS"].'--#--'.GetMessage("WZD_OPTION_26").'--,--DETAIL_PICTURE--#--'.GetMessage("WZD_OPTION_28").'--,--PREVIEW_TEXT--#--'.GetMessage("WZD_OPTION_30").'--,--DETAIL_TEXT--#--'.GetMessage("WZD_OPTION_32").'--;--edit14--#--'.GetMessage("WZD_OPTION_34").'--,--IPROPERTY_TEMPLATES_ELEMENT_META_TITLE--#--'.GetMessage("WZD_OPTION_36").'--,--IPROPERTY_TEMPLATES_ELEMENT_META_KEYWORDS--#--'.GetMessage("WZD_OPTION_38").'--,--IPROPERTY_TEMPLATES_ELEMENT_META_DESCRIPTION--#--'.GetMessage("WZD_OPTION_40").'--,--IPROPERTY_TEMPLATES_ELEMENT_PAGE_TITLE--#--'.GetMessage("WZD_OPTION_42").'--,--IPROPERTY_TEMPLATES_ELEMENTS_PREVIEW_PICTURE--#--'.GetMessage("WZD_OPTION_44").'--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_ALT--#--'.GetMessage("WZD_OPTION_46").'--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_TITLE--#--'.GetMessage("WZD_OPTION_48").'--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_NAME--#--'.GetMessage("WZD_OPTION_50").'--,--IPROPERTY_TEMPLATES_ELEMENTS_DETAIL_PICTURE--#--'.GetMessage("WZD_OPTION_52").'--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_ALT--#--'.GetMessage("WZD_OPTION_46").'--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_TITLE--#--'.GetMessage("WZD_OPTION_48").'--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_NAME--#--'.GetMessage("WZD_OPTION_50").'--,--IPROPERTY_TEMPLATES_MANAGEMENT--#--'.GetMessage("WZD_OPTION_54").'--,--IPROPERTY_CLEAR_VALUES--#--'.GetMessage("WZD_OPTION_56").'--,--SEO_ADDITIONAL--#--'.GetMessage("WZD_OPTION_58").'--,--TAGS--#--'.GetMessage("WZD_OPTION_60").'--,--edit14_csection1--#--'.GetMessage("WZD_OPTION_62").'--,--PROPERTY_'.$arProperty["I_ELEMENT_PAGE_TITLE"].'--#--'.GetMessage("WZD_OPTION_64").'--,--PROPERTY_'.$arProperty["I_ELEMENT_PREVIEW_PICTURE_FILE_TITLE"].'--#--'.GetMessage("WZD_OPTION_66").'--,--PROPERTY_'.$arProperty["I_ELEMENT_PREVIEW_PICTURE_FILE_ALT"].'--#--'.GetMessage("WZD_OPTION_68").'--,--edit14_csection2--#--'.GetMessage("WZD_OPTION_70").'--,--PROPERTY_'.$arProperty["I_SKU_PAGE_TITLE"].'--#--'.GetMessage("WZD_OPTION_72").'--,--PROPERTY_'.$arProperty["I_SKU_PREVIEW_PICTURE_FILE_TITLE"].'--#--'.GetMessage("WZD_OPTION_74").'--,--PROPERTY_'.$arProperty["I_SKU_PREVIEW_PICTURE_FILE_ALT"].'--#--'.GetMessage("WZD_OPTION_76").'--;--edit2--#--'.GetMessage("WZD_OPTION_78").'--,--SECTIONS--#--'.GetMessage("WZD_OPTION_78").'--;--;--',
	));
	// list user options
	CUserOptions::SetOption("list", "tbl_iblock_list_".md5($iblockTYPE.".".$iblockID), array(
		'columns' => '', 'by' => '', 'order' => '', 'page_size' => '',
	));
}

if($iblockID){
	// replace macros IBLOCK_TYPE & IBLOCK_ID & IBLOCK_CODE
	CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("IBLOCK_CATALOG_INFO_TYPE" => $iblockTYPE));
	CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("IBLOCK_CATALOG_INFO_ID" => $iblockID));
	CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("IBLOCK_CATALOG_INFO_CODE" => $iblockCODE));
	CWizardUtil::ReplaceMacrosRecursive($bitrixTemplateDir, Array("IBLOCK_CATALOG_INFO_TYPE" => $iblockTYPE));
	CWizardUtil::ReplaceMacrosRecursive($bitrixTemplateDir, Array("IBLOCK_CATALOG_INFO_ID" => $iblockID));
	CWizardUtil::ReplaceMacrosRecursive($bitrixTemplateDir, Array("IBLOCK_CATALOG_INFO_CODE" => $iblockCODE));
}
?>
