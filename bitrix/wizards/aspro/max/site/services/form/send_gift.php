<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
$bitrixTemplateDir = $_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/templates/".WIZARD_TEMPLATE_ID;
if(!CModule::IncludeModule("form")) return;
if(!CModule::IncludeModule("main")) return;

$FORM_SID = "SEND_GIFT";
$dbSite = CSite::GetByID(WIZARD_SITE_ID);
if($arSite = $dbSite -> Fetch()) $lang = $arSite["LANGUAGE_ID"];
if(strlen($lang) <= 0) $lang = "ru";
	
WizardServices::IncludeServiceLang("forms.php", $lang);

/*Добавляем почтовое событие*/
if($db_res = CEventType::GetList(array("TYPE_ID" => "FORM_FILLING_SEND_GIFT"))){ 
	$count = $db_res->SelectedRowsCount(); 
	if(!$count){
		$oEventType = new CEventType();
		$arFields = array("LID" => $lang, "EVENT_NAME" => "FORM_FILLING_SEND_GIFT", "NAME" => GetMessage("EVENT_NEW_SEND_GIFT_NAME"), "DESCRIPTION" => GetMessage("EVENT_NEW_SEND_GIFT_DESCRIPTION"));
		$oEventTypeSrcID = $oEventType->Add($arFields);
	}
}

/*Добавляем почтовый шаблон для данного сайта*/
$oEventMessage = new CEventMessage();
$by = "id"; $order = "asc";
$arFields = array("ACTIVE" => "Y", "EVENT_NAME" => "FORM_FILLING_SEND_GIFT", "LID" => WIZARD_SITE_ID, "EMAIL_FROM" => "#DEFAULT_EMAIL_FROM#", "EMAIL_TO" => "#EMAIL_RAW#", "SUBJECT" => GetMessage("NEW_SEND_GIFT_EMAIL_SUBJECT"), "MESSAGE" => GetMessage("NEW_SEND_GIFT_EMAIL_TEXT"), "BODY_TYPE" => "html", "SITE_TEMPLATE_ID" => "aspro_max_mail");
if($db_res = CEventMessage::GetList($by, $order, array("TYPE_ID" => "FORM_FILLING_SEND_GIFT", "SITE_ID" => array(WIZARD_SITE_ID)))){ 
	$count = $db_res->SelectedRowsCount(); 
	if($count > 0){
		while($res = $db_res->GetNext()){
			$oEventMessage->Update($res["ID"], $arFields);
		}
	}
	else{
		$oEventMessage->Add($arFields);
	}
}

/*Получить список шаблонов этого события*/
$arEventMessageIDs = array();
if($db_res = CEventMessage::GetList($by, $order, array ("TYPE_ID" => "FORM_FILLING_SEND_GIFT"))){ 
	while($res = $db_res->GetNext()){
		$arEventMessageIDs[] = $res["ID"];
	}
}

/*Получить форму и её сайты*/
$form_id = false;
$arFormSiteIDs = array();
if($arForm = CForm::GetBySID($FORM_SID)->Fetch()){
	if(($form_id = $arForm["ID"]) > 0){
		/*Форма есть*/
		$arFormSiteIDs = CForm::GetSiteArray($arForm['ID']);
	}
}
$arFormSiteIDs[] = WIZARD_SITE_ID;
$arFormSiteIDs = array_unique($arFormSiteIDs);

/*Обновляем форму или создаем*/
if($form_id){
	$arFields = array(
		"arSITE"			=> $arFormSiteIDs,
		"arMAIL_TEMPLATE"	=> $arEventMessageIDs,
	);
	$form_id = CForm::Set($arFields, $form_id, "N");
	if($form_id < 0){
		return;
	}
}
else{
	$arFields = array(
		"NAME"				=> GetMessage("SEND_GIFT_FORM_NAME"),
		"SID"				=> $FORM_SID,
		"C_SORT"			=> 300,
		"BUTTON"			=> GetMessage("SEND_GIFT_BUTTON_NAME"),
		"DESCRIPTION"		=> GetMessage("SEND_GIFT_FORM_DESCRIPTION"),
		"DESCRIPTION_TYPE"	=> "text",
		"STAT_EVENT1"		=> "form",
		"STAT_EVENT2"		=> "",
		"arSITE"			=> $arFormSiteIDs,
		"arMENU"			=> array( "ru" => GetMessage("SEND_GIFT_FORM_NAME") ),
		"arGROUP"			=> array( "2" => "10" ),
		"arMAIL_TEMPLATE"	=> $arEventMessageIDs
	);
	$form_id = CForm::Set($arFields);
	if($form_id < 0){
		return;
	}
	
	/* Добавляем вопросы */
	$arANSWER = array();
	$arANSWER[] = array( "MESSAGE" => " ", "C_SORT" => 100, "ACTIVE" => "Y", "FIELD_TYPE" => "text", "FIELD_PARAM" => "" );
	$arFields = array( "FORM_ID" => $form_id, "ACTIVE" => "Y", "TITLE" => GetMessage("SEND_GIFT_FORM_QUESTION_1"), "TITLE_TYPE" => "text", "SID" => "FIO", "C_SORT" => 100, "ADDITIONAL" => "N", "REQUIRED" => "Y", "arANSWER" => $arANSWER );
	CFormField::Set($arFields);

	$arANSWER = array();
	$arANSWER[] = array( "MESSAGE" => " ", "C_SORT" => 100, "ACTIVE" => "Y", "FIELD_TYPE" => "text", "FIELD_PARAM" => "" );
	$arFields = array( "FORM_ID" => $form_id, "ACTIVE" => "Y", "TITLE" => GetMessage("SEND_GIFT_FORM_QUESTION_2"), "TITLE_TYPE" => "text", "SID" => "CLIENT_NAME", "C_SORT" => 100, "ADDITIONAL" => "N", "REQUIRED" => "Y", "arANSWER" => $arANSWER );
	CFormField::Set($arFields);

	$arANSWER = array();
	$arANSWER[] = array( "MESSAGE" => " ", "C_SORT" => 100, "ACTIVE" => "Y", "FIELD_TYPE" => "email", "FIELD_PARAM" => "" );
	$arFields = array( "FORM_ID" => $form_id, "ACTIVE" => "Y", "TITLE" => GetMessage("SEND_GIFT_FORM_QUESTION_3"), "TITLE_TYPE" => "text", "SID" => "EMAIL", "C_SORT" => 300, "ADDITIONAL" => "N", "REQUIRED" => "Y", "arANSWER" => $arANSWER );
	CFormField::Set($arFields);

	$arANSWER = array();
	$arANSWER[] = array( "MESSAGE" => " ", "C_SORT" => 100, "ACTIVE" => "Y", "FIELD_TYPE" => "hidden", "FIELD_PARAM" => "" );
	$arFields = array( "FORM_ID" => $form_id, "ACTIVE" => "Y", "TITLE" => GetMessage("SEND_GIFT_FORM_QUESTION_4"), "TITLE_TYPE" => "text", "SID" => "PRODUCT_ID", "C_SORT" => 500, "ADDITIONAL" => "N", "REQUIRED" => "N", "arANSWER" => $arANSWER );
	CFormField::Set($arFields);

	$arANSWER = array();
	$arANSWER[] = array( "MESSAGE" => " ", "C_SORT" => 100, "ACTIVE" => "Y", "FIELD_TYPE" => "hidden", "FIELD_PARAM" => "" );
	$arFields = array( "FORM_ID" => $form_id, "ACTIVE" => "Y", "TITLE" => GetMessage("SEND_GIFT_FORM_QUESTION_5"), "TITLE_TYPE" => "text", "SID" => "PRODUCT_NAME", "C_SORT" => 500, "ADDITIONAL" => "N", "REQUIRED" => "N", "arANSWER" => $arANSWER );
	CFormField::Set($arFields);

	$arANSWER = array();
	$arANSWER[] = array( "MESSAGE" => " ", "C_SORT" => 100, "ACTIVE" => "Y", "FIELD_TYPE" => "hidden", "FIELD_PARAM" => "" );
	$arFields = array( "FORM_ID" => $form_id, "ACTIVE" => "Y", "TITLE" => GetMessage("SEND_GIFT_FORM_QUESTION_6"), "TITLE_TYPE" => "text", "SID" => "PRODUCT_LINK", "C_SORT" => 500, "ADDITIONAL" => "N", "REQUIRED" => "N", "arANSWER" => $arANSWER );
	CFormField::Set($arFields);

	/* Добавляем статус */
	$arFields = array( "FORM_ID" => $form_id, "C_SORT" => 100, "ACTIVE" => "Y", "TITLE" => "DEFAULT", "DEFAULT_VALUE" => "Y", "arPERMISSION_VIEW" => array(2), "arPERMISSION_MOVE" => array(2), "arPERMISSION_EDIT" => array(2), "arPERMISSION_DELETE" => array(2) );
	CFormStatus::Set($arFields);
}

/*Заменяем макросы*/
CWizardUtil::ReplaceMacros($bitrixTemplateDir."/header.php", array("SEND_GIFT_FORM_ID" => $form_id));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."info/faq/index.php", array("SEND_GIFT_FORM_ID" => $form_id));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."catalog/index.php", array("SEND_GIFT_FORM_ID" => $form_id))
?>