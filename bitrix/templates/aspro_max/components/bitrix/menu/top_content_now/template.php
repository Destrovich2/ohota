<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $this->setFrameMode( true ); ?>
<?if( !empty( $arResult ) ){?>
	<?foreach( $arResult as $key => $arItem ){?>
		<a href="<?=$arItem["LINK"]?>" class="header__nav-item"><?=$arItem["TEXT"]?></a>
	<?}?>

	<script data-skip-moving="true">
		InitTopestMenuGummi();
		CheckTopMenuPadding();
		CheckTopMenuOncePadding();
		CheckTopMenuDotted();
	</script>
<?}?>