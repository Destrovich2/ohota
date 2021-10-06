<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<div class="footer__social">
	<?if(
		$arParams["SOCIAL_TITLE"] && (
			!empty($arResult["SOCIAL_VK"]) || 
			!empty($arResult["SOCIAL_ODNOKLASSNIKI"]) || 
			!empty($arResult["SOCIAL_FACEBOOK"]) || 
			!empty($arResult["SOCIAL_TWITTER"]) || 
			!empty($arResult["SOCIAL_INSTAGRAM"]) || 
			!empty($arResult["SOCIAL_MAIL"]) || 
			!empty($arResult["SOCIAL_YOUTUBE"]) || 
			//!empty($arResult["SOCIAL_GOOGLEPLUS"])) ||
			!empty($arResult["SOCIAL_VIBER"]) ||
			!empty($arResult["SOCIAL_WHATS"]) ||
			!empty($arResult["SOCIAL_WHATS_CUSTOM"]) ||
			!empty($arResult["SOCIAL_VIBER_CUSTOM_DESKTOP"]) ||
			!empty($arResult["SOCIAL_VIBER_CUSTOM_MOBILE"]) ||
			!empty($arResult["SOCIAL_ZEN"]) ||
			!empty($arResult["SOCIAL_PINTEREST"]) ||
			!empty($arResult["SOCIAL_SNAPCHAT"]) ||
			!empty($arResult["SOCIAL_TIKTOK"]) ||
			!empty($arResult["SOCIAL_LINKEDIN"])
		)
	):?>
		<!--<div class="small_title"><?=$arParams["SOCIAL_TITLE"];?></div>-->
	<?endif;?>
	<!-- noindex -->



			<?if(!empty($arResult['SOCIAL_INSTAGRAM'])):?>
 			<a href="<?=$arResult['SOCIAL_INSTAGRAM']?>" class="footer__social-item"><img style="display: block;width: 17px;" src="/images/insta.svg"></a>

                
                <?endif;?>

                <?if(!empty($arResult['SOCIAL_WHATS']) || !empty($arResult["SOCIAL_WHATS_CUSTOM"]) ):?>
		            <?
					if( strlen(trim($arResult["SOCIAL_WHATS_CUSTOM"])) ){
						$whatsHref = $arResult["SOCIAL_WHATS_CUSTOM"];
					} else {
						if(defined('LANG_CHARSET') && strtolower(LANG_CHARSET) == 'windows-1251'){
							$text = iconv("windows-1251","utf-8", $arResult['SOCIAL_WHATS_TEXT']);
						} else {
							$text = $arResult['SOCIAL_WHATS_TEXT'];
						}
						$bWhatsText = !empty($arResult['SOCIAL_WHATS_TEXT']);
						$whatsText = $bWhatsText ? '?text='.rawurlencode($text) : '';
						$whatsHref = 'https://wa.me/'.$arResult['SOCIAL_WHATS'].$whatsText;
					}			
					?>
                <a href="<?=$whatsHref?>" class="footer__social-item">
                  <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0)">
                      <path d="M11.8941 0.0144578C5.29163 0.32883 0.0813465 5.82741 0.101376 12.4374C0.107474 14.4506 0.593502 16.3508 1.45088 18.0298L0.134499 24.4197C0.0632901 24.7653 0.375032 25.068 0.718401 24.9867L6.97972 23.5032C8.58835 24.3045 10.3952 24.7673 12.3074 24.7965C19.0558 24.8996 24.6827 19.5412 24.8931 12.7954C25.1185 5.56428 19.1505 -0.331124 11.8941 0.0144578ZM19.3652 19.2639C17.5315 21.0976 15.0935 22.1074 12.5003 22.1074C10.9819 22.1074 9.52818 21.7668 8.17939 21.0949L7.30742 20.6605L3.46859 21.5701L4.27664 17.6475L3.84706 16.8062C3.14686 15.435 2.79183 13.9521 2.79183 12.399C2.79183 9.80573 3.80168 7.36776 5.63535 5.53403C7.45265 3.71673 9.93044 2.69045 12.5005 2.69045C15.0937 2.69051 17.5316 3.70035 19.3652 5.53397C21.1989 7.36764 22.2088 9.80561 22.2088 12.3988C22.2088 14.9689 21.1825 17.4467 19.3652 19.2639Z" fill="#7AD06D"></path>
                      <path d="M18.5176 15.0879L16.1159 14.3983C15.8002 14.3076 15.4602 14.3972 15.2301 14.6316L14.6428 15.23C14.3951 15.4823 14.0194 15.5634 13.6916 15.4308C12.5555 14.971 10.1656 12.8461 9.55525 11.7832C9.37917 11.4766 9.40829 11.0933 9.62448 10.8135L10.1372 10.1502C10.3381 9.89026 10.3805 9.54121 10.2477 9.24077L9.23723 6.95544C8.9952 6.40807 8.29573 6.24873 7.83876 6.63521C7.16846 7.20213 6.37314 8.06363 6.27646 9.01805C6.106 10.7008 6.82766 12.822 9.55662 15.369C12.7093 18.3115 15.234 18.7003 16.8778 18.3021C17.8101 18.0763 18.5552 17.1709 19.0255 16.4297C19.346 15.9243 19.0929 15.2531 18.5176 15.0879Z" fill="#7AD06D"></path>
                    </g>
                    <defs>
                      <clipPath id="clip0">
                        <rect width="25" height="25" fill="white"></rect>
                      </clipPath>
                    </defs>
                  </svg>
                </a>
                <?endif;?>
	<!-- /noindex -->
</div>