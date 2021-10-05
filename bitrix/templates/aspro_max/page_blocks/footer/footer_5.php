<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
global $arTheme;
?>

<style type="text/css">
.footer {
    margin-top: 70px;
    background-color: #151416;
    padding-top: 36px;
    padding-bottom: 55px;
}
.container55 {
    max-width: 1430px;
    padding: 0 15px;
    margin: 0 auto;
}	
.footer__wrapper {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    width: 100%;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
}
.footer__title {
    font-size: 30px;
    font-weight: 300;
    color: #fff;
    line-height: 87%;
    margin-bottom: 24px;
}
.footer__tel {
    display: block;
    color: #878787;
    font-size: 24px;
    margin-bottom: 12px;
}
.footer__tel:hover {
    display: block;
    color: #878787;
    font-size: 24px;
    margin-bottom: 12px;
}
.footer__hours {
    font-size: 14px;
    color: #FD6C03;
    margin-bottom: 12px;
}
.footer__mail {
    display: block;
    font-size: 14px;
    color: #878787;
    margin-bottom: 12px;
}
.footer__addr {
    display: block;
    font-size: 14px;
    color: #878787;
    line-height: 130%;
}
.footer__title {
    font-size: 24px;
    font-weight: 300;
    color: #fff;
    line-height: 87%;
    margin-bottom: 24px;
}
.footer__nav {
    font-size: 14px;
    color: #878787;
    margin-bottom: 12px;
    display: block;
}
.footer__social {
    margin-bottom: 26px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    margin-top: -5px;
}
.footer__social-item {
    display: block;
        margin-right: 10px
}
.footer__social-item svg {
    display: block;
    width: 16px;
    height: auto;
}
.footer__payment {
    width: 200px;
    margin-top: -16px;
}
.footer__payment img {
    display: block;
    width: 100%;
    height: auto;
}
</style>

<footer class="footer">
        <div class="container55">
          <div class="footer__wrapper">
            <div class="footer__col">
              <div class="footer__title">Контакты</div>
              <?CMax::ShowFootersPhones('no-icons');?>
              <div class="footer__hours">Пн.-Пт. с 10<sup>00</sup>о 19<sup>00</sup></div>
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





















