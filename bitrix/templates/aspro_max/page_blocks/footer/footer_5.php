<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
global $arTheme;
?>
<footer class="footer">
        <div class="container55">
          <div class="footer__wrapper">
            <div class="footer__col">
              <div class="footer__title">Контакты</div>
              <?CMax::ShowFootersPhones('no-icons');?>
              <div class="footer__hours">Ежедневно, с 8<sup>00</sup>до 17<sup>00</sup> (по МСК)</div>
              <?=CMax::showEmail2('email blocks')?>
              <div class="footer__addr">
                <?=CMax::showAddress2('address blocks')?>
              </div>
            </div>
            <div class="footer__col --hide-mobile">
              <div class="footer__title">Всё о нас</div>
                    <?$APPLICATION->IncludeFile(SITE_DIR."include/footer/vse-o-nas.php", array(), array(
                            "MODE" => "html",
                            "NAME" => "Address",
                            "TEMPLATE" => "include_area.php",
                        )
                    );?>
            </div>
            <div class="footer__col --hide-mobile">
                <div class="footer__title">Покупателям</div>
                     <?$APPLICATION->IncludeFile(SITE_DIR."include/footer/pocupatel.php", array(), array(
                            "MODE" => "html",
                            "NAME" => "Address",
                            "TEMPLATE" => "include_area.php",
                        )
                    );?>               
            </div>
            <div class="footer__col">
            <div class="footer__title">Связь с нами:</div>   
            <div class="footer__social">
                <?$APPLICATION->IncludeComponent(
                    "aspro:social.info.max",
                    ".default",
                    array(
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "3600000",
                        "CACHE_GROUPS" => "N",
                        "COMPONENT_TEMPLATE" => ".default"
                    ),
                    false
                );?>
            </div>


              <div class="footer__title">Принимаем к оплате:</div>
              <div class="footer__payment">
                <img src="/images/footer__payment.png">
              </div>
            </div>
          </div>
        </div>
      </footer>





















