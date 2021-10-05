<?if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true ) die();?>
<?$this->setFrameMode(true);?>
<?
$INPUT_ID = trim($arParams["~INPUT_ID"]);
if(strlen($INPUT_ID) <= 0)
	$INPUT_ID = "title-search-input_corp";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);
$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if(strlen($CONTAINER_ID) <= 0)
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

global $isFixedTopSearch;
$INPUT_ID_TMP = $INPUT_ID;
if(isset($isFixedTopSearch) && $isFixedTopSearch)
{
	$CONTAINER_ID .= 'tf';
	$INPUT_ID .= 'tf';
	$isFixedTopSearch = false;
}
?>
<?if($arParams["SHOW_INPUT"] !== "N"):?>
	<?if($arParams["SHOW_INPUT_FIXED"] != "Y"):?>
		<div class="inline-search-block with-close fixed corp">
			<div class="maxwidth-theme">
				<div class="row">
					<div class="col-md-10">
	<?endif;?>



		
				<div id="<?=$CONTAINER_ID?>">
					<form action="<?=$arResult["FORM_ACTION"]?>" class="">
						
							<input class="header__search-input" id="<?=$INPUT_ID?>" type="text" name="q" value="" placeholder="Введите название товара" size="20" maxlength="50" autocomplete="off" />
						
			
					</form>
				</div>
		


			
	<?if($arParams["SHOW_INPUT_FIXED"] != "Y"):?>
					</div>
				</div>
			</div>
		</div>
	<?endif;?>
<?endif;?>
<script type="text/javascript">
	var jsControl = new JCTitleSearch4({
		//'WAIT_IMAGE': '/bitrix/themes/.default/images/wait.gif',
		'AJAX_PAGE' : '<?=CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
		'CONTAINER_ID': '<?=$CONTAINER_ID?>',
		'INPUT_ID': '<?=$INPUT_ID?>',
		'INPUT_ID_TMP': '<?=$INPUT_ID_TMP?>',
		'MIN_QUERY_LEN': 2
	});
</script>