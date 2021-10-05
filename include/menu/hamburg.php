  <div class="hamburger__links">
    <a href="#" class="hamburger__link">Каталог товаров</a>
    <a href="#" class="hamburger__link">Подбор велосипеда</a>
    <a href="#" class="hamburger__link">Распродажа</a>
    <a href="#" class="hamburger__link">Ремонт и сервис</a>
    <a href="#" class="hamburger__link">Тест-драйв</a>
    <a href="#" class="hamburger__link">О нас</a>
  </div>
  <div class="hamburger__social">
                   <?$APPLICATION->IncludeComponent(
                    "aspro:social.info.max",
                    "burg",
                    array(
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "3600000",
                        "CACHE_GROUPS" => "N",
                        "COMPONENT_TEMPLATE" => ".default"
                    ),
                    false
                );?>
  </div>
