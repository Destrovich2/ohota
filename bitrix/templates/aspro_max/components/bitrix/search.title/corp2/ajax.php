<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?if (empty($arResult["CATEGORIES"])) return;?>
<div class="bx_searche scrollblock">
	<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
		<?foreach($arCategory["ITEMS"] as $i => $arItem):?>
			<?//=$arCategory["TITLE"]?>
			<?if(isset($arResult["ELEMENTS"][$arItem["ITEM_ID"]]) && $category_id !== "all"):
				$arElement = $arResult["ELEMENTS"][$arItem["ITEM_ID"]];?>
				<a class="bx_item_block" href="<?=$arItem["URL"]?>">
					<div class="maxwidth-theme">
						<div class="bx_img_element">
							<?if(is_array($arElement["PICTURE"])):?>
								<img src="<?=$arElement["PICTURE"]["src"]?>">
							<?else:?>
								<img src="<?=SITE_TEMPLATE_PATH?>/images/svg/noimage_product.svg" width="38" height="38">
							<?endif;?>
						</div> 
						<div class="bx_item_element" style="display: flex;width: 100%;justify-content: space-between;align-content: space-around;">
							<span style="display: flex;align-items: center;"><?=$arItem["NAME"]?></span>
							<div class="price cost prices">
								<div class="title-search-price">


									
									<?if(isset($arElement["MIN_PRICE"]) && $arElement["MIN_PRICE"]){?>
										<?if($arElement["MIN_PRICE"]["DISCOUNT_VALUE"] < $arElement["MIN_PRICE"]["VALUE"]):?>
											<div style="display: flex;flex-direction: column;">
												
												<div class="price discount">
													<strike><?=$arElement["MIN_PRICE"]["PRINT_VALUE"]?></strike>
												</div>
												<div class="price"><?=$arElement["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"]?></div>

											</div>
									
										<?else:?>
											<div style="display: flex;flex-direction: column;">
												<div class="price"><?=$arElement["MIN_PRICE"]["PRINT_VALUE"]?></div>
											</div>
										<?endif;?>
									<?}else{?>
										<?foreach($arElement["PRICES"] as $code=>$arPrice):?>
											<?if($arPrice["CAN_ACCESS"]):?>
												<?if (count($arElement["PRICES"])>1):?>
													<div style="display: flex;flex-direction: column;">
														<div class="search_price_wrap">
														<div class="price_name"><?=$arResult["PRICES"][$code]["TITLE"];?></div>
													</div>
												<?endif;?>
												<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
													<div style="display: flex;flex-direction: column;">
														
														<div class="price discount">
															<strike><?=$arPrice["PRINT_VALUE"]?></strike>
														</div>
														<div class="price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></div>
													</div>
												<?else:?>
													<div style="display: flex;flex-direction: column;">
														<div class="price"><?=$arPrice["PRINT_VALUE"]?></div>
													</div>
												<?endif;?>
												<?if (count($arElement["PRICES"])>1):?>
													</div>
												<?endif;?>
											<?endif;?>
										<?endforeach;?>
									<?}?>
								</div>
							</div>
						</div>
						<div style="clear:both;"></div>
					</div>
				</a>				
			<?endif;?>
		<?endforeach;?>
	<?endforeach;?>
</div>

