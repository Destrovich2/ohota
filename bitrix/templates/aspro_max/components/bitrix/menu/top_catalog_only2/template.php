<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?$this->setFrameMode(true);?>
<?
global $arTheme;
$iVisibleItemsMenu = ($arTheme['MAX_VISIBLE_ITEMS_MENU']['VALUE'] ? $arTheme['MAX_VISIBLE_ITEMS_MENU']['VALUE'] : 10);
$MENU_TYPE = $arTheme['MEGA_MENU_TYPE']['VALUE'];
$bManyItemsMenu = ($MENU_TYPE == '4');
?>
<?if($arResult):?>
	<?if (!function_exists('showSubItemss')) {
		function showSubItemss($arParams = [
			'HAS_PICTURE' => false,
			'HAS_ICON' => false,
			'WIDE_MENU' => false,
			'SHOW_CHILDS' => false,
			'VISIBLE_ITEMS_MENU' => 0,
			'MAX_LEVEL' => 0,
			'ITEM' => [],
		]){?>



	
			<?if($arParams['ITEM']["LINK"]):?>
			<div class="catalog-menu__item">
				<a href="<?=$arParams['ITEM']["LINK"]?>" class="catalog-menu__item-link"><?=$arParams['ITEM']["TEXT"]?>
			<?endif;?>
		
			
				</a>
			
				<?if($arParams['ITEM']["CHILD"] && $arParams['SHOW_CHILDS']):?>
				<?$iCountChilds = count($arParams['ITEM']["CHILD"]);?>
				<div class="catalog-menu__dropdown">
                  <div class="catalog-menu__col">
                    <div class="catalog-menu__section">
						<?foreach($arParams['ITEM']["CHILD"] as $arSubSubItem):?>	
							<a href="<?=$arSubSubItem['LINK']?>" class="catalog-menu__link"><?=$arSubSubItem['TEXT']?></a>
						<?endforeach;?>
          			</div>
		           </div>
		         </div>
		         </div>
				<?endif;?>
		<?}?>
	<?}?>


	<div class="table-menu">
		<table>
			<tr>
				<?foreach($arResult as $arItem):?>
					
					<?$bShowChilds = $arParams["MAX_LEVEL"] === 3;
					$bWideMenu = ($arItem["PARAMS"]['FROM_IBLOCK'] || strpos($arItem["PARAMS"]["CLASS"], 'wide_menu') !== false);
					if(!$arItem['TEXT']) continue;?>

					<div class="header__catalog-wrapper" href="<?=$arItem["LINK"]?>">
						<button class="header__catalog"><svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="16" height="2"></rect><rect y="6" width="16" height="2"></rect><rect y="12" width="16" height="2"></rect></svg><?=$arItem["TEXT"]?></button>
							
						<?if($arItem["CHILD"] && $bShowChilds):?>
							<div class="catalog-menu">
								<?foreach($arItem["CHILD"] as $arSubItem):?>
									<?=showSubItemss([
										'HAS_PICTURE' => $bHasPicture,
										'HAS_ICON' => $bIcon,
										'WIDE_MENU' => $bWideMenu,
										'SHOW_CHILDS' => $bShowChilds,
										'VISIBLE_ITEMS_MENU' => $iVisibleItemsMenu,
										'ITEM' => $arSubItem,
										'MAX_LEVEL' => $arParams["MAX_LEVEL"]
									]);?>				
								<?endforeach;?>	
							</div>
									
					</div>
		</div>
							


							<?endif;?>
						</div>
					</td>
				<?endforeach;?>
			</tr>
		</table>
	</div>
<?endif;?>
