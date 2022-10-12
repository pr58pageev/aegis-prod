<?php

use Sotbit\Origami\Helper\Config;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

global $settings;

$ajaxMode = $settings['fields']['ajax']['value'];
if (!in_array($ajaxMode, array('Y', 'N')))
  $ajaxMode = 'Y';

$productsNumber = intval($settings['fields']['products_number']['value']);
if (!is_integer($productsNumber))
  $productsNumber = 0;

$APPLICATION->IncludeComponent(
	"sotbit:crosssell.collection", 
	"origami_default", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/cart/",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"COLLECTION_LIST" => array(
			0 => "e1",
		),
		"COMPATIBLE_MODE" => "N",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_COMPARE" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilter",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => Config::get("IBLOCK_ID"),
		"IBLOCK_TYPE" => Config::get("IBLOCK_TYPE"),
		"INCLUDE_SUBSECTIONS" => "Y",
		"LINE_ELEMENT_COUNT" => "5",
		"PAGE_ELEMENT_COUNT" => $productsNumber,
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_CART_PROPERTIES" => array(
			0 => "SIZES_SHOES",
			1 => "SIZES_CLOTHES",
			2 => "COLOR_REF",
		),
		"OFFERS_FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_PICTURE",
			2 => "DETAIL_PICTURE",
			3 => "DETAIL_PAGE_URL",
		),
		"OFFERS_LIMIT" => "500",
		"OFFERS_PROPERTY_CODE" => array(
			1 => "CML2_BAR_CODE",
			2 => "CML2_ARTICLE",
			5 => "CML2_BASE_UNIT",
			7 => "MORE_PHOTO",
			8 => "FILES",
			9 => "CML2_MANUFACTURER",
			10 => "PROTSESSOR",
			11 => "CHASTOTA_PROTSESSORA",
			12 => "KOLICHESTVO_YADER_PROTSESORA",
			13 => "OBEM_OPERATICHNOY_PAMYATI",
			14 => "TIP_VIDEOKARTY",
			15 => "OBEM_VIDEOPAMYATI",
			16 => "USTANOVLENNAYA_OS",
			17 => "OBEM_PAMYATI",
			18 => "RAZMER",
			19 => "TSVET",
			20 => "TSVET_1",
			21 => "VIDEOKARTA",
		),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_ORDER2" => "desc",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "origami",
		"PAGER_TITLE" => "Товары",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => \SotbitOrigami::GetComponentPrices(["BASE","OPT","SMALL_OPT","test","ZAKUP_SNDS","tst"]),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => "",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"SECTION_TEMPLATE" => "origami_default",
		"COLLECTION_LIST_TEMPLATE" => "origami_default",
		"SECTION_URL" => "",
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "Y",
		"OFFER_TREE_PROPS" => array(
			1 => "PROTSESSOR",
			2 => "OBEM_OPERATICHNOY_PAMYATI",
			3 => "OBEM_PAMYATI",
			4 => "RAZMER",
			5 => "CHASTOTA_PROTSESSORA",
			6 => "TIP_VIDEOKARTY",
			7 => "TSVET",
			8 => "KOLICHESTVO_YADER_PROTSESORA",
			9 => "OBEM_VIDEOPAMYATI",
			10 => "TSVET_1",
			11 => "USTANOVLENNAYA_OS",
			12 => "CML2_MANUFACTURER",
		),
		"PRODUCT_DISPLAY_MODE" => "Y",
		"ADD_PICT_PROP" => "MORE_PHOTO",
		"OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_MAX_QUANTITY" => "Y",
		"USE_VOTE_RATING" => "Y",
		"COMPARE_PATH" => Config::get("COMPARE_PAGE"),
		"COMPARE_NAME" => "CATALOG_COMPARE_LIST",
		"USE_COMPARE_LIST" => "Y",
		"PAGER_PARAMS_NAME" => "arrPager",
		"ACTION_PRODUCTS" => array(
			0 => "ADMIN",
		),
		"VARIANT_LIST_VIEW" => "template_3",
		"COMPONENT_TEMPLATE" => "origami_default",
		"SECTION_ID" => $_REQUEST["SECTION_ID"]
	),
	false
);
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
<?
/*
 * $APPLICATION->IncludeComponent(
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

 */
?>
</div>

<div class="person-banner">
  <div class="block-wrapper-inner block-wrapper-inner-changed">
    <div class="advantage">
      <a href="/b2bcabinet/" class="person-banner__image-wrapper">
        <img src="/upload/person-banner.jpg" class="person-banner__image">
      </a>
    </div>
  </div>
  <div class="block-wrapper-inner block-wrapper-inner-changed">
    <div class="advantage" style="background-color: #F5F7FA; padding: 15px;">
      <div class="block_main_advantage main-container">
        <div class="block_main_advantage__one" id="bx_651765591_68">
          <div class="block_main_advantage_item">
            <div class="block_main_advantage_icons">
              <img src="/upload/personal-baner_img-1.png"
                   alt="Статистика заказов и создание заказа за 1 минуту"
                   title="Статистика заказов и создание заказа за 1 минуту">
            </div>
            <div class="block_main_advantage_title fonts__small_weight_title">
              Статистика заказов и создание заказа за 1 минуту
            </div>
          </div>
        </div>
        <div class="block_main_advantage__one" id="bx_651765591_67">
          <div class="block_main_advantage_item">
            <div class="block_main_advantage_icons">
              <img src="/upload/personal-baner_img-2.png"
                   alt="Индивидуальные товары, доступные вашей компании"
                   title="Индивидуальные товары, доступные вашей компании">
            </div>
            <div class="block_main_advantage_title fonts__small_weight_title">
              Индивидуальные товары, доступные вашей компании
            </div>
          </div>
        </div>
        <div class="block_main_advantage__one" id="bx_651765591_66">
          <div class="block_main_advantage_item">
            <div class="block_main_advantage_icons">
              <img src="/upload/personal-baner_img-3.png"
                   alt="Персональные цены на товары для вашей компании "
                   title="Персональные цены на товары для вашей компании">
            </div>
            <div class="block_main_advantage_title fonts__small_weight_title">
              Персональные цены на товары для вашей компании
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .person-banner .block_main_advantage__one {
    flex: 1;
    max-width: none;
  }

	.person-banner .block_main_advantage_icons {
    height: 94px;
    min-height: 94px;
		max-height: 94px;
		width: 94px;
		min-width: 94px;
    max-width: 94px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

	.person-banner .block_main_advantage_icons img {
		height: 58px;
		min-height: 58px;
		max-height: 58px;
		width: unset;
		min-width: unset;
		max-width: 58px;
		border-radius: unset;
	}

  .person-banner .person-banner__image {
    height: auto;
    max-width: 100%;
  }

  .person-banner .person-banner__image-wrapper {
    position: relative;
  }
</style>

