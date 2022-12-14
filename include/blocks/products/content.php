<?php
use Sotbit\Origami\Helper\Config;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

global $settings;

$ajaxMode = $settings['fields']['ajax']['value'];
if (!in_array($ajaxMode, array('Y','N')))
    $ajaxMode = 'Y';

$productsNumber = intval($settings['fields']['products_number']['value']);
if(!is_integer($productsNumber))
    $productsNumber = 0;

$APPLICATION->IncludeComponent(
    "sotbit:crosssell.collection",
    "origami_default",
    Array(
        "ACTION_VARIABLE" => "action",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => $ajaxMode,
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
        "CACHE_TYPE" => "A",
        "COLLECTION_LIST" => array('e1'),
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
            22 => "CTM",
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
        "PAGER_TITLE" => "????????????",
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "PRICE_CODE" => \SotbitOrigami::GetComponentPrices(["OPT","SMALL_OPT","BASE"]),
        "PRICE_VAT_INCLUDE" => "Y",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_PROPERTIES" => array(),
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
        "SECTION_TEMPLATE" => $settings['fields']['template']['value'],
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
        "USE_PRODUCT_QUANTITY" => "N",
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
        "VARIANT_LIST_VIEW" => "template_1",
    )
);

?>
