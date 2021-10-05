<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */

$this->setFrameMode(true);

$class_block="s_".$this->randString();

$arTab=array();
$arParams["DISPLAY_BOTTOM_PAGER"] = "Y";
$arParams['SET_TITLE'] = 'N';
$arTmp = reset($arResult["TABS"]);
$arParams["FILTER_HIT_PROP"] = $arTmp["CODE"];
$arParamsTmp = urlencode(serialize($arParams));

echo __FILE__;

//echo '<pre>';
//print_r($arParams);
//echo '</pre>';

$json = json_encode($arParams);
$file = fopen('/data.json','w+');
fwrite($file, $json);
fclose($file);