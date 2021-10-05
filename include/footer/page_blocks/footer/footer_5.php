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
    font-size: 24px;
    font-weight: 300;
    color: #fff;
    line-height: 87%;
    margin-bottom: 24px;
}
.footer__tel {
    display: block;
    color: #878787;
    font-size: 16px;
    margin-bottom: 12px;
}
.footer__tel:hover {
    display: block;
    color: #878787;
    font-size: 16px;
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
    margin-top: -10px;
}
.footer__social-item {
    display: block;
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
              <a href="mailto:onlyride@yandex.ru" class="footer__mail"><?=CMax::showEmail('email blocks')?></a>
              <div class="footer__addr">
                г. Ростов-на-Дону<br>
                ул. Улица 14/23
              </div>
            </div>
            <div class="footer__col --hide-mobile">
              <div class="footer__title">Всё о нас</div>
              <a href="#" class="footer__nav">О компании</a>
              <a href="#" class="footer__nav">Наш магазин</a>
              <a href="#" class="footer__nav">Вакансии</a>
              <a href="#" class="footer__nav">Сертификаты</a>
            </div>
            <div class="footer__col --hide-mobile">
              <div class="footer__title">Покупателям</div>
              <a href="#" class="footer__nav">Каталог</a>
              <a href="#" class="footer__nav">Доставка</a>
              <a href="#" class="footer__nav">Гарантия и ремонт</a>
              <a href="#" class="footer__nav">Пользовательское<br>
                соглашение</a>
            </div>
            <div class="footer__col">
              <div class="footer__title">Связь с нами:</div>
              <div class="footer__social">
                <a href="#" class="footer__social-item">
                  <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24.9249 7.34634C24.864 6.01578 24.6527 5.10712 24.3437 4.31213C24.0299 3.47805 23.5378 2.72255 22.9019 2.09808C22.2776 1.46217 21.5219 0.969887 20.6879 0.655937C19.8927 0.347137 18.9842 0.135994 17.6537 0.075531C16.3206 0.0144958 15.8947 0 12.5 0C9.1053 0 8.67939 0.0144958 7.34634 0.0751495C6.01578 0.135994 5.10731 0.347328 4.31213 0.656319C3.47805 0.970078 2.72255 1.46217 2.09808 2.09808C1.46217 2.72236 0.969887 3.47786 0.655937 4.31194C0.347137 5.10712 0.135994 6.01578 0.075531 7.34615C0.0144958 8.67939 0 9.10511 0 12.4998C0 15.8947 0.0144958 16.3206 0.075531 17.6537C0.136185 18.984 0.347519 19.8927 0.656509 20.6879C0.970268 21.5218 1.46236 22.2775 2.09827 22.9017C2.72255 23.5376 3.47824 24.0297 4.31232 24.3435C5.10731 24.6527 6.01597 24.8638 7.34653 24.9247C8.67977 24.9855 9.10549 24.9998 12.5002 24.9998C15.8949 24.9998 16.3208 24.9855 17.6538 24.9247C18.9844 24.8638 19.8929 24.6527 20.6881 24.3435C22.3671 23.6942 23.6944 22.3669 24.3437 20.6879C24.6529 19.8927 24.864 18.984 24.9249 17.6537C24.9855 16.3204 25 15.8947 25 12.5C25 9.10511 24.9855 8.67939 24.9249 7.34634ZM22.6748 17.5512C22.6192 18.77 22.4155 19.4319 22.2445 19.8723C21.8239 20.9625 20.9623 21.8241 19.8721 22.2446C19.4317 22.4157 18.7698 22.6194 17.551 22.6749C16.2333 22.7352 15.8379 22.7478 12.5 22.7478C9.16195 22.7478 8.76675 22.7352 7.44877 22.6749C6.23016 22.6194 5.56831 22.4157 5.12772 22.2446C4.58488 22.0442 4.09374 21.7247 3.69053 21.3095C3.2753 20.9063 2.95582 20.4153 2.75536 19.8723C2.58427 19.4319 2.38056 18.77 2.32506 17.5512C2.26498 16.2333 2.2522 15.8379 2.2522 12.5002C2.2522 9.16233 2.26498 8.76713 2.32506 7.44896C2.38075 6.23016 2.58427 5.56831 2.75536 5.12791C2.95582 4.58488 3.27549 4.09374 3.69053 3.69053C4.09374 3.2753 4.58488 2.95582 5.12791 2.75555C5.56831 2.58427 6.23016 2.38075 7.44896 2.32506C8.76694 2.26498 9.16233 2.2522 12.5 2.2522H12.4998C15.8375 2.2522 16.2329 2.26498 17.551 2.32525C18.7698 2.38075 19.4315 2.58446 19.8721 2.75555C20.4149 2.95601 20.9061 3.27549 21.3093 3.69053C21.7245 4.09374 22.044 4.58488 22.2443 5.12791C22.4155 5.56831 22.6192 6.23016 22.6748 7.44896C22.7348 8.76694 22.7476 9.16233 22.7476 12.5C22.7476 15.8379 22.735 16.2331 22.6748 17.5512Z" fill="url(#paint0_linear)"></path>
                    <path d="M12.4996 6.08105C8.95461 6.08105 6.08081 8.95505 6.08081 12.5C6.08081 16.045 8.95461 18.9188 12.4996 18.9188C16.0448 18.9188 18.9186 16.045 18.9186 12.5C18.9186 8.95505 16.0448 6.08105 12.4996 6.08105ZM12.4996 16.6666C10.1986 16.6665 8.33301 14.8011 8.3332 12.4999C8.3332 10.1988 10.1986 8.33325 12.4998 8.33325C14.801 8.33344 16.6664 10.1988 16.6664 12.4999C16.6664 14.8011 14.8008 16.6666 12.4996 16.6666Z" fill="url(#paint1_linear)"></path>
                    <path d="M20.6722 5.82752C20.6722 6.65588 20.0006 7.32746 19.1722 7.32746C18.3437 7.32746 17.6721 6.65588 17.6721 5.82752C17.6721 4.99897 18.3437 4.32739 19.1722 4.32739C20.0006 4.32739 20.6722 4.99897 20.6722 5.82752Z" fill="url(#paint2_linear)"></path>
                    <defs>
                      <linearGradient id="paint0_linear" x1="2.09796" y1="22.9018" x2="22.902" y2="2.09776" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#FFD600"></stop>
                        <stop offset="0.5" stop-color="#FF0100"></stop>
                        <stop offset="1" stop-color="#D800B9"></stop>
                      </linearGradient>
                      <linearGradient id="paint1_linear" x1="7.96089" y1="17.0388" x2="17.0386" y2="7.96112" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#FF6400"></stop>
                        <stop offset="0.5" stop-color="#FF0100"></stop>
                        <stop offset="1" stop-color="#FD0056"></stop>
                      </linearGradient>
                      <linearGradient id="paint2_linear" x1="18.1115" y1="6.88807" x2="20.2328" y2="4.7668" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#F30072"></stop>
                        <stop offset="1" stop-color="#E50097"></stop>
                      </linearGradient>
                    </defs>
                  </svg>
                </a>
                <a href="#" class="footer__social-item">
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
              </div>
              <div class="footer__title">Принимаем к оплате:</div>
              <div class="footer__payment">
                <img src="assets/images/footer__payment.png">
              </div>
            </div>
          </div>
        </div>
      </footer>





















