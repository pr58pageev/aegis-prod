<?php

use Sotbit\Origami\Helper\Config;
?>



<?php
global $mainBanner;
$mainBanner = [
  'ACTIVE' => 'Y',
  'PROPERTY_BANNER_TYPE' => Config::getBanner(['MAIN', 'SIDE']),
];
$useRegion = (Config::get('USE_REGIONS') == 'Y') ? true : false;

if ($useRegion && $_SESSION['SOTBIT_REGIONS']['ID']) {
  $mainBanner['PROPERTY_REGIONS'] = [
    false,
    $_SESSION['SOTBIT_REGIONS']['ID']
  ];
}

?>
<?/*
<link href="/blocks/banner_side_right_20/main.css" rel="stylesheet"/>
<script src="/blocks/banner_side_right_20/bundle.js"></script>

<!-- hero -->
<section class="hero-section j_custom-cursor" style="margin: -15px 0 -40px 0;">

    
  <canvas class="hero-canvas" resize></canvas>

  <div class="container">
    <!-- wrap -->
    <div class="hero-wrap">
      <h1 class="hero-title"><i>Э</i><i>Г</i><i>И</i><i>Д</i><i>А</i></h1>

      <div class="hero-content">
        <div class="hero-content-item">
          <h4 class="hero-content-item__title">Эффективность</h4>
          <p class="hero-content-item__text">
            Глубокое понимание потребностей рынка, постоянный поиск новых продуктов, профессиональные консультации по
            применению продукции - это основа нашей работы. А так же собственная служба доставки, ежедневное
            планирование поставок продукции и слаженная работа сотрудников всех подразделений позволяют нам работать
            по-настоящему эффективно.

          </p>
        </div>
        <div class="hero-content-item">
          <h4 class="hero-content-item__title">Гарантии</h4>
          <p class="hero-content-item__text">
            Вы можете быть абсолютно уверены, что мы поставим нужную продукцию точно в срок и в нужном количестве. Мы
            заключаем официальные договоры поставок, заранее планируем необходимый объем товара у поставщиков и
            бронируем продукцию на складе под ваши заказы, что позволяет нам своевременно выполнять отгрузки любого
            объема заказов.
          </p>
        </div>
        <div class="hero-content-item">
          <h4 class="hero-content-item__title">Инновации</h4>
          <p class="hero-content-item__text">
            Мы постоянно следим за новыми технологиями в сфере профессиональной химии для клининга и можем поставить
            самые современные продукты для решения сложных профессиональных задач. Технологии клининга постоянно
            меняются и мы готовы подобрать для вас оптимальное решения исходя из требований, предъявляемых к сложности
            продукта и стоимости квадратного метра уборки.
          </p>
        </div>
        <div class="hero-content-item">
          <h4 class="hero-content-item__title">Доверие</h4>
          <p class="hero-content-item__text">
            Мы уже 25 лет работаем на рынке профессиональной химии, гигиенической продукции, хозяйственных товаров,
            товаров для гостиниц и уборочного инвентаря. Такой долгий срок работы с постоянными клиентами невозможен без
            идеальной репутации и добросовестного выполнения своих обязательств. Доверие - это основа наших отношений с
            клиентами.
          </p>
        </div>
        <div class="hero-content-item">
          <h4 class="hero-content-item__title">Актуальность</h4>
          <p class="hero-content-item__text">
            Мы постоянно сотрудничаем более чем с 40 производителями и дистрибьютерами бытовой химии. Постоянный
            мониторинг закупочных цен и цен продукции на рынке позволяет нам предоставлять своим клиентам выгодные
            цены на продукцию. Мы постоянно следим за остатками самых ходовых продуктов на своем складе и предоставляем
            возможность самовывоза в день формирования заказа.
          </p>
        </div>
      </div>
    </div>
    <!-- ./End of wrap -->
  </div>
  <!-- ./ End of container -->
  <div class="hero-line-text">
    Снабжение организаций
  </div>
</section>
<!-- ./ End of hero -->

*/

  $APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "origami_banner_2",
    array(
      "ACTIVE_DATE_FORMAT" => "j F Y",
      "ADD_SECTIONS_CHAIN" => "N",
      "AJAX_MODE" => "N",
      "AJAX_OPTION_ADDITIONAL" => "",
      "AJAX_OPTION_HISTORY" => "N",
      "AJAX_OPTION_JUMP" => "N",
      "AJAX_OPTION_STYLE" => "Y",
      "CACHE_FILTER" => "N",
      "CACHE_GROUPS" => "Y",
      "CACHE_TIME" => "36000000",
      "CACHE_TYPE" => "A",
      "CHECK_DATES" => "Y",
      "DETAIL_URL" => "",
      "DISPLAY_BOTTOM_PAGER" => "N",
      "DISPLAY_DATE" => "Y",
      "DISPLAY_NAME" => "Y",
      "DISPLAY_PICTURE" => "Y",
      "DISPLAY_PREVIEW_TEXT" => "Y",
      "DISPLAY_TOP_PAGER" => "N",
      "FIELD_CODE" => array(
        0 => "NAME",
        1 => "PREVIEW_TEXT",
        2 => "PREVIEW_PICTURE",
        3 => "DETAIL_TEXT",
        4 => "DETAIL_PICTURE",
        5 => "DATE_ACTIVE_FROM",
        6 => "ACTIVE_FROM",
        7 => "",
      ),
      "FILTER_NAME" => "mainBanner",
      "HIDE_LINK_WHEN_NO_DETAIL" => "N",
      "IBLOCK_ID" => Config::get("IBLOCK_ID_BANNERS"),
      "IBLOCK_TYPE" => Config::get("IBLOCK_TYPE_BANNERS"),
      "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
      "INCLUDE_SUBSECTIONS" => "Y",
      "MESSAGE_404" => "",
      "NEWS_COUNT" => "20",
      "PAGER_BASE_LINK_ENABLE" => "N",
      "PAGER_DESC_NUMBERING" => "N",
      "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
      "PAGER_SHOW_ALL" => "N",
      "PAGER_SHOW_ALWAYS" => "N",
      "PAGER_TEMPLATE" => ".default",
      "PAGER_TITLE" => "",
      "PARENT_SECTION" => "",
      "PARENT_SECTION_CODE" => "banner_2",
      "PREVIEW_TRUNCATE_LEN" => "120",
      "PROPERTY_CODE" => array(
        0 => "",
        1 => "NEW_TAB",
        2 => "URL",
        3 => "VIDEO_URL",
        4 => "BUTTON_TEXT",
        5 => "BANNER_TYPE",
        6 => "",
      ),
      "SET_BROWSER_TITLE" => "N",
      "SET_LAST_MODIFIED" => "N",
      "SET_META_DESCRIPTION" => "N",
      "SET_META_KEYWORDS" => "N",
      "SET_STATUS_404" => "N",
      "SET_TITLE" => "N",
      "SHOW_404" => "N",
      "SORT_BY1" => "SORT",
      "SORT_BY2" => "ACTIVE_FROM",
      "SORT_ORDER1" => "DESC",
      "SORT_ORDER2" => "ASC",
      "STRICT_SECTION_CHECK" => "N",
      "COMPONENT_TEMPLATE" => "origami_banner_2",
      "TEMPLATE_THEME" => "blue",
      "MEDIA_PROPERTY" => "",
      "SLIDER_PROPERTY" => "",
      "SEARCH_PAGE" => "/search/",
      "USE_RATING" => "N",
      "USE_SHARE" => "N",
      "COMPOSITE_FRAME_MODE" => "A",
      "COMPOSITE_FRAME_TYPE" => "AUTO"
    ),
    false
  );
  ?><!--
</div>-->
