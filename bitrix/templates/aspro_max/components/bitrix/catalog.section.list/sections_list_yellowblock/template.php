<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';?>
<? $this->setFrameMode( true ); ?>
<?use \Bitrix\Main\Localization\Loc;?>

<?if($arResult["SECTIONS"]){?>
	<?global $arTheme;
	$iVisibleItemsMenu = CMax::GetFrontParametrValue('MAX_VISIBLE_ITEMS_MENU');
	$bSlide = false;
	$bSlick = ($arParams['NO_MARGIN'] == 'Y');
	$bSmallBlock = ($arParams['VIEW_TYPE'] == 'sm');
	$bSlideBlock = ($arParams['VIEW_TYPE'] == 'slide');
	$bBigBlock = ($arParams['VIEW_TYPE'] == 'lg');
	$bIcons = ($arParams['SHOW_ICONS'] == 'Y');?>

    <? //Вывод инфоблока ?>
    <? //echo '<pre>'; ?>
    <? //print_r($arSect); ?>
    <? //echo '</pre>'; ?>
    <div class="drag-block container <?=$optionCode?> <?=$bTizersIndexClass;?>" data-class="<?=$subtype?>_drag" data-order="<?=++$key;?>">
        <div class="catalog-n-pick">
            <div class="container">
                <div class="catalog-n-pick__wrapper">
	               <?foreach( $arResult["SECTIONS"] as $arItems ){
        			$this->AddEditAction($arItems['ID'], $arItems['EDIT_LINK'], CIBlock::GetArrayByID($arItems["IBLOCK_ID"], "SECTION_EDIT"));
        			$this->AddDeleteAction($arItems['ID'], $arItems['DELETE_LINK'], CIBlock::GetArrayByID($arItems["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_SECTION_DELETE_CONFIRM')));
        			if ($arItems['NAME'] == "Одежда" || $arItems['NAME'] == "Снаряжение") {



        			?>

                        <div class="catalog-n-pick__item">
                          <a href="#" class="catalog-n-pick__title"><?=$arItems['NAME']?></a>
                          <div class="catalog-n-pick__catalog">
                              <?php $count = 0; ?>
                                  <?foreach($arItems["SECTIONS"] as $arSect ):?>
                                      <?php if ($count < 6) { ?>
                                      <a href="<?=$arSect['SECTION_PAGE_URL']?>" class="catalog-n-pick__catalog-item"><?=$arSect['NAME']?></a>
                                          <?php $count++; ?>
                                      <?php }?>
                                  <? endforeach;?>
                          </div>
                          <a href="<?=$arItems['SECTION_PAGE_URL']?>" class="catalog-n-pick__goto">
                            Перейти
                            <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M1 11.5L6 6.5L1 1.5" stroke="white" stroke-width="2" stroke-linecap="round" />
                            </svg>
                          </a>
                        </div>
                    <?php } ?>
		          <?}?>
            </div>
        </div>
      </div>
    </div>
<?}?>
