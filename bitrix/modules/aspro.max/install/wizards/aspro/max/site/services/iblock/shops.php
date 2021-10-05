<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!CModule::IncludeModule("iblock")) return;

if(!defined("WIZARD_SITE_ID")) return;
if(!defined("WIZARD_SITE_DIR")) return;
if(!defined("WIZARD_SITE_PATH")) return;
if(!defined("WIZARD_TEMPLATE_ID")) return;
if(!defined("WIZARD_TEMPLATE_ABSOLUTE_PATH")) return;
if(!defined("WIZARD_THEME_ID")) return;

$bitrixTemplateDir = $_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/templates/".WIZARD_TEMPLATE_ID."/";
//$bitrixTemplateDir = $_SERVER["DOCUMENT_ROOT"]."/local/templates/".WIZARD_TEMPLATE_ID."/";

$iblockShortCODE = "shops";
$iblockXMLFile = WIZARD_SERVICE_RELATIVE_PATH."/xml/".LANGUAGE_ID."/".$iblockShortCODE.".xml";
$iblockTYPE = "aspro_max_content";
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
						"FROM_DETAIL" => "Y",
						"SCALE" => "Y",
						"WIDTH" => "200",
						"HEIGHT" => "200",
						"IGNORE_ERRORS" => "N",
						"METHOD" => "resample",
						"COMPRESSION" => 75,
						"DELETE_WITH_DETAIL" => "Y",
						"UPDATE_WITH_DETAIL" => "Y",
					),
				), 
				"PREVIEW_TEXT_TYPE" => array(
					"IS_REQUIRED" => "Y",
					"DEFAULT_VALUE" => "html",
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
						"COMPRESSION" => 75,
					),
				), 
				"DETAIL_TEXT_TYPE" => array(
					"IS_REQUIRED" => "Y",
					"DEFAULT_VALUE" => "html",
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
						"SCALE" => "Y",
						"WIDTH" => "2000",
						"HEIGHT" => "2000",
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

	// iblock user fields
	$dbSite = CSite::GetByID(WIZARD_SITE_ID);
	if($arSite = $dbSite -> Fetch()) $lang = $arSite["LANGUAGE_ID"];
	if(!strlen($lang)) $lang = "ru";
	WizardServices::IncludeServiceLang("editform_useroptions.php", $lang);
	WizardServices::IncludeServiceLang("properties_hints.php", $lang);
	$arProperty = array();
	$dbProperty = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $iblockID));
	while($arProp = $dbProperty->Fetch())
		$arProperty[$arProp["CODE"]] = $arProp["ID"];

	// properties hints

	// edit form user options
	CUserOptions::SetOption("form", "form_element_".$iblockID, array(
		"tabs" => 'edit1--#--'.GetMessage("WZD_OPTION_118").'--,--ACTIVE--#--'.GetMessage("WZD_OPTION_2").'--,--SORT--#--'.GetMessage("WZD_OPTION_8").'--,--NAME--#--'.GetMessage("WZD_OPTION_4").'--,--PROPERTY_'.$arProperty["ADDRESS"].'--#--'.GetMessage("WZD_OPTION_120").'--,--PROPERTY_'.$arProperty["PHONE"].'--#--'.GetMessage("WZD_OPTION_122").'--,--PROPERTY_'.$arProperty["EMAIL"].'--#--'.GetMessage("WZD_OPTION_124").'--,--PROPERTY_'.$arProperty["SCHEDULE"].'--#--'.GetMessage("WZD_OPTION_126").'--,--PROPERTY_'.$arProperty["METRO"].'--#--'.GetMessage("WZD_OPTION_128").'--,--PROPERTY_'.$arProperty["PAY_TYPE"].'--#--'.GetMessage("WZD_OPTION_130").'--,--DETAIL_TEXT--#--'.GetMessage("WZD_OPTION_132").'--,--PROPERTY_'.$arProperty["MAP"].'--#--'.GetMessage("WZD_OPTION_134").'--,--XML_ID--#--'.GetMessage("WZD_OPTION_102").'--;--cedit2--#--'.GetMessage("WZD_OPTION_112").'--,--PREVIEW_PICTURE--#--'.GetMessage("WZD_OPTION_136").'--,--DETAIL_PICTURE--#--'.GetMessage("WZD_OPTION_138").'--,--PROPERTY_'.$arProperty["MORE_PHOTOS"].'--#--'.GetMessage("WZD_OPTION_140").'--;--cedit1--#--'.GetMessage("WZD_OPTION_96").'--,--PROPERTY_'.$arProperty["STORE_ID"].'--#--'.GetMessage("WZD_OPTION_142").'--,--PROPERTY_'.$arProperty["LINK_REGION"].'--#--'.GetMessage("WZD_OPTION_98").'--;--edit14--#--'.GetMessage("WZD_OPTION_144").'--,--IPROPERTY_TEMPLATES_ELEMENT_META_TITLE--#--'.GetMessage("WZD_OPTION_146").'--,--IPROPERTY_TEMPLATES_ELEMENT_META_KEYWORDS--#--'.GetMessage("WZD_OPTION_148").'--,--IPROPERTY_TEMPLATES_ELEMENT_META_DESCRIPTION--#--'.GetMessage("WZD_OPTION_150").'--,--IPROPERTY_TEMPLATES_ELEMENT_PAGE_TITLE--#--'.GetMessage("WZD_OPTION_152").'--,--IPROPERTY_TEMPLATES_ELEMENTS_PREVIEW_PICTURE--#--'.GetMessage("WZD_OPTION_154").'--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_ALT--#--'.GetMessage("WZD_OPTION_156").'--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_TITLE--#--'.GetMessage("WZD_OPTION_158").'--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_NAME--#--'.GetMessage("WZD_OPTION_160").'--,--IPROPERTY_TEMPLATES_ELEMENTS_DETAIL_PICTURE--#--'.GetMessage("WZD_OPTION_162").'--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_ALT--#--'.GetMessage("WZD_OPTION_156").'--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_TITLE--#--'.GetMessage("WZD_OPTION_158").'--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_NAME--#--'.GetMessage("WZD_OPTION_160").'--,--SEO_ADDITIONAL--#--'.GetMessage("WZD_OPTION_164").'--,--TAGS--#--'.GetMessage("WZD_OPTION_166").'--;----#--'.GetMessage("WZD_OPTION_10").'--;--',
	));
	// list user options
	CUserOptions::SetOption("list", "tbl_iblock_list_".md5($iblockTYPE.".".$iblockID), array(
		'columns' => '', 'by' => '', 'order' => '', 'page_size' => '',
	));
}

if($iblockID){
	// replace macros IBLOCK_TYPE & IBLOCK_ID & IBLOCK_CODE
	CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("IBLOCK_SHOPS_TYPE" => $iblockTYPE));
	CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("IBLOCK_SHOPS_ID" => $iblockID));
	CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("IBLOCK_SHOPS_CODE" => $iblockCODE));
	CWizardUtil::ReplaceMacrosRecursive($bitrixTemplateDir, Array("IBLOCK_SHOPS_TYPE" => $iblockTYPE));
	CWizardUtil::ReplaceMacrosRecursive($bitrixTemplateDir, Array("IBLOCK_SHOPS_ID" => $iblockID));
	CWizardUtil::ReplaceMacrosRecursive($bitrixTemplateDir, Array("IBLOCK_SHOPS_CODE" => $iblockCODE));
}
?>
