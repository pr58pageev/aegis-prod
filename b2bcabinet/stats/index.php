<?

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Config\Option;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Статистика");
$APPLICATION->SetTitle("Статистика");

Loc::loadMessages(__FILE__);

$APPLICATION->SetTitle(Loc::getMessage('B2B_CABINET_MAIN_PAGE'));

Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/plugins/forms/inputs/touchspin.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/pages/form_input_groups.js");

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/js/plugins/media/simplelightbox/simpleLightbox.min.css");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/plugins/media/simplelightbox/simpleLightbox.min.js");


//if(!Loader::includeModule('sotbit.b2bcabinet'))
//{
//    header('Location: '.SITE_DIR.'b2bcabinet/');
//}
if (!empty($_GET['forgot_password'])) {
  $APPLICATION->IncludeComponent(
    "bitrix:main.auth.forgotpasswd",
    "",
    Array(
      "AUTH_AUTH_URL" => "/?AUTH_SHOW=Y",
      "AUTH_REGISTER_URL" => "/?AUTH_SHOW=Y",
      "COMPOSITE_FRAME_MODE" => "A",
      "COMPOSITE_FRAME_TYPE" => "AUTO"
    )
  );

}
if (!$USER->IsAuthorized() && empty($_GET['forgot_password'])) {
  // $APPLICATION->AuthForm('', false, false, 'N', false);
  LocalRedirect('/?AUTH_SHOW=Y');
} else {
  if (empty($_GET['forgot_password'])):
    ?>
    <section class="statistics-section">


      <?
      $APPLICATION->IncludeComponent(
        "bitrix:news.detail",
        "main_promo",
        Array(
          "ACTIVE_DATE_FORMAT" => "d.m.Y",
          "ADD_ELEMENT_CHAIN" => "N",
          "ADD_SECTIONS_CHAIN" => "N",
          "AJAX_MODE" => "N",
          "AJAX_OPTION_ADDITIONAL" => "",
          "AJAX_OPTION_HISTORY" => "N",
          "AJAX_OPTION_JUMP" => "N",
          "AJAX_OPTION_STYLE" => "Y",
          "BROWSER_TITLE" => "-",
          "CACHE_GROUPS" => "Y",
          "CACHE_TIME" => "36000000",
          "CACHE_TYPE" => "A",
          "CHECK_DATES" => "Y",
          "COMPOSITE_FRAME_MODE" => "A",
          "COMPOSITE_FRAME_TYPE" => "AUTO",
          "DETAIL_URL" => "",
          "DISPLAY_BOTTOM_PAGER" => "Y",
          "DISPLAY_DATE" => "Y",
          "DISPLAY_NAME" => "Y",
          "DISPLAY_PICTURE" => "Y",
          "DISPLAY_PREVIEW_TEXT" => "Y",
          "DISPLAY_TOP_PAGER" => "N",
          "ELEMENT_CODE" => "statistika",
          "ELEMENT_ID" => "",
          "FIELD_CODE" => array("", ""),
          "IBLOCK_ID" => "28",
          "IBLOCK_TYPE" => "sotbit_origami_content",
          "IBLOCK_URL" => "",
          "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
          "MESSAGE_404" => "",
          "META_DESCRIPTION" => "-",
          "META_KEYWORDS" => "-",
          "PAGER_BASE_LINK_ENABLE" => "N",
          "PAGER_SHOW_ALL" => "N",
          "PAGER_TEMPLATE" => ".default",
          "PAGER_TITLE" => "Страница",
          "PROPERTY_CODE" => array("", "FILE", ""),
          "SET_BROWSER_TITLE" => "N",
          "SET_CANONICAL_URL" => "N",
          "SET_LAST_MODIFIED" => "N",
          "SET_META_DESCRIPTION" => "N",
          "SET_META_KEYWORDS" => "N",
          "SET_STATUS_404" => "N",
          "SET_TITLE" => "N",
          "SHOW_404" => "N",
          "STRICT_SECTION_CHECK" => "N",
          "USE_PERMISSIONS" => "N",
          "USE_SHARE" => "N"
        )
      ); ?>


      <?
      $APPLICATION->IncludeComponent(
        "mediagroup:stats.order",
        "",
        Array()
      ); ?>


      <?


      $arBasketItems = array();

      $dbBasketItems = CSaleBasket::GetList(
        array(
          "NAME" => "ASC",
          "ID" => "ASC"
        ),
        array(
          "FUSER_ID" => CSaleBasket::GetBasketUserID(),
          "LID" => SITE_ID,
          "!ORDER_ID" => "NULL"
        ),
        false,
        false,
        array("ID", "MODULE",
          "PRODUCT_ID", "QUANTITY", "DELAY",
          "CAN_BUY", "PRICE", "WEIGHT")
      );
      while ($arItems = $dbBasketItems->Fetch()) {


        $intElementID = $arItems['PRODUCT_ID']; // ID предложения
        $mxResult = CCatalogSku::GetProductInfo(
          $intElementID
        );
        if (is_array($mxResult)) {

          $arBasketItems[] = $mxResult['ID'];
          $arCustomBasketItems[$mxResult['ID']]['OFFERS'][$arItems['PRODUCT_ID']]['COUNT']++;
        }


      }


      $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM");
      $arFilter = Array("IBLOCK_ID" => 15, "ID" => $arBasketItems);
      $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
      while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arResItems[$arFields['ID']] = $arFields;
      }


      foreach ($arCustomBasketItems as $key => $value) {
        foreach ($value['OFFERS'] as $key2 => $value2) {
          $arResItems[$key]['COUNT'] += $value2['COUNT'];
        }
      }


      function cmp_function_desc($a, $b)
      {
        return ($a['COUNT'] < $b['COUNT']);
      }

      uasort($arResItems, 'cmp_function_desc');

      $arResItems = array_slice($arResItems, 0, 11);

      foreach ($arResItems as $key => $value) {
        $filterIds [] = $value['ID'];
      }

      unset($_SESSION['BLANK_IDS']);


      $filter_name = "arrFilter";
      global ${$filter_name};
      ${$filter_name}['PROPERTY_' . VIDIMOST_OFFER_PROP_CODE] = 1;
      ${$filter_name}['ID'] = $filterIds;

      $APPLICATION->IncludeComponent(
        "bitrix:catalog",
        "new",
        array(
          "ACTION_VARIABLE" => "action",
          "ADD_ELEMENT_CHAIN" => "N",
          "ADD_PROPERTIES_TO_BASKET" => "Y",
          "ADD_SECTIONS_CHAIN" => "Y",
          "AJAX_MODE" => "N",
          "AJAX_OPTION_ADDITIONAL" => "",
          "AJAX_OPTION_HISTORY" => "N",
          "AJAX_OPTION_JUMP" => "N",
          "AJAX_OPTION_STYLE" => "Y",
          "BIG_DATA_RCM_TYPE" => "personal",
          "CACHE_FILTER" => "N",
          "CACHE_GROUPS" => "Y",
          "CACHE_TIME" => "36000000",
          "CACHE_TYPE" => "A",
          "COMMON_ADD_TO_BASKET_ACTION" => "ADD",
          "COMMON_SHOW_CLOSE_POPUP" => "N",
          "COMPATIBLE_MODE" => "Y",
          "CONVERT_CURRENCY" => "N",
          "DETAIL_ADD_DETAIL_TO_SLIDER" => "N",
          "DETAIL_ADD_TO_BASKET_ACTION" => array(
            0 => "BUY",
          ),
          "DETAIL_BACKGROUND_IMAGE" => "-",
          "DETAIL_BRAND_USE" => "N",
          "DETAIL_BROWSER_TITLE" => "-",
          "DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
          "DETAIL_DETAIL_PICTURE_MODE" => array(
            0 => "POPUP",
          ),
          "DETAIL_DISPLAY_NAME" => "Y",
          "DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
          "DETAIL_IMAGE_RESOLUTION" => "16by9",
          "DETAIL_META_DESCRIPTION" => "-",
          "DETAIL_META_KEYWORDS" => "-",
          "DETAIL_PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
          "DETAIL_PRODUCT_PAY_BLOCK_ORDER" => "rating,priceRanges,quantityLimit,quantity,buttons,price",
          "DETAIL_PROPERTY_CODE" => array(
            0 => "",
            1 => "",
          ),
          "DETAIL_SET_CANONICAL_URL" => "N",
          "DETAIL_SET_VIEWED_IN_COMPONENT" => "N",
          "DETAIL_SHOW_POPULAR" => "N",
          "DETAIL_SHOW_SLIDER" => "N",
          "DETAIL_SHOW_VIEWED" => "N",
          "DETAIL_STRICT_SECTION_CHECK" => "N",
          "DETAIL_USE_COMMENTS" => "N",
          "DETAIL_USE_VOTE_RATING" => "N",
          "DISABLE_INIT_JS_IN_COMPONENT" => "N",
          "DISPLAY_BOTTOM_PAGER" => "Y",
          "DISPLAY_TOP_PAGER" => "N",
          "ELEMENT_SORT_FIELD" => "sort",
          "ELEMENT_SORT_FIELD2" => "id",
          "ELEMENT_SORT_ORDER" => "asc",
          "ELEMENT_SORT_ORDER2" => "desc",
          "FILTER_HIDE_ON_MOBILE" => "N",
          "FILTER_VIEW_MODE" => "VERTICAL",
          "GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
          "GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
          "GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "4",
          "GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
          "GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
          "GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
          "GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "4",
          "GIFTS_MESS_BTN_BUY" => "Выбрать",
          "GIFTS_SECTION_LIST_BLOCK_TITLE" => "Подарки к товарам этого раздела",
          "GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE" => "N",
          "GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT" => "4",
          "GIFTS_SECTION_LIST_TEXT_LABEL_GIFT" => "Подарок",
          "GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
          "GIFTS_SHOW_IMAGE" => "Y",
          "GIFTS_SHOW_NAME" => "Y",
          "GIFTS_SHOW_OLD_PRICE" => "Y",
          "HIDE_NOT_AVAILABLE" => "L",
          "HIDE_NOT_AVAILABLE_OFFERS" => "L",
          "INCLUDE_SUBSECTIONS" => "Y",
          "INSTANT_RELOAD" => "N",
          "LAZY_LOAD" => "N",
          "LINE_ELEMENT_COUNT" => "3",
          "LINK_ELEMENTS_URL" => "",
          "LINK_IBLOCK_ID" => "",
          "LINK_IBLOCK_TYPE" => "",
          "LINK_PROPERTY_SID" => "",
          "LIST_BROWSER_TITLE" => "-",
          "LIST_META_DESCRIPTION" => "-",
          "LIST_META_KEYWORDS" => "-",
          "LIST_PROPERTY_CODE" => array(
            0 => "PROIZVODITEL_ATTR_E",
            1 => "CML2_ARTICLE",
            2 => "CML2_MEASURE_UNIT",
            3 => 'CML2_MEASURE_UNIT_KOEF,'
          ),
          "LOAD_ON_SCROLL" => "N",
          "MESSAGE_404" => "",
          "MESS_BTN_ADD_TO_BASKET" => "В корзину",
          "MESS_BTN_BUY" => "Купить",
          "MESS_BTN_COMPARE" => "Сравнение",
          "MESS_BTN_DETAIL" => "Подробнее",
          "MESS_BTN_SUBSCRIBE" => "Подписаться",
          "MESS_COMMENTS_TAB" => "Комментарии",
          "MESS_DESCRIPTION_TAB" => "Описание",
          "MESS_NOT_AVAILABLE" => "Нет в наличии",
          "MESS_PRICE_RANGES_TITLE" => "Цены",
          "MESS_PROPERTIES_TAB" => "Характеристики",
          "PAGER_BASE_LINK_ENABLE" => "N",
          "PAGER_DESC_NUMBERING" => "N",
          "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
          "PAGER_SHOW_ALL" => "N",
          "PAGER_SHOW_ALWAYS" => "N",
          "PAGER_TEMPLATE" => "b2b_catalog",
          "PAGER_TITLE" => "Товары",
          "PAGE_ELEMENT_COUNT" => "10",
          "PARTIAL_PRODUCT_PROPERTIES" => "N",
          "PRICE_CODE" => array(
            0 => "BASE",
          ),
          "PRICE_VAT_INCLUDE" => "Y",
          "PRICE_VAT_SHOW_VALUE" => "N",
          "PRODUCT_ID_VARIABLE" => "id",
          "PRODUCT_PROPERTIES" => "",
          "PRODUCT_PROPS_VARIABLE" => "prop",
          "PRODUCT_QUANTITY_VARIABLE" => "quantity",
          "PRODUCT_SUBSCRIPTION" => "Y",
          "SEARCH_CHECK_DATES" => "Y",
          "SEARCH_NO_WORD_LOGIC" => "Y",
          "SEARCH_PAGE_RESULT_COUNT" => "50",
          "SEARCH_RESTART" => "N",
          "SEARCH_USE_LANGUAGE_GUESS" => "Y",
          "SECTIONS_SHOW_PARENT_NAME" => "Y",
          "SECTIONS_VIEW_MODE" => "LIST",
          "SECTION_ADD_TO_BASKET_ACTION" => "ADD",
          "SECTION_BACKGROUND_IMAGE" => "-",
          "SECTION_COUNT_ELEMENTS" => "N",
          "SECTION_ID_VARIABLE" => "SECTION_ID",
          "SECTION_TOP_DEPTH" => "2",
          "SEF_MODE" => "N",
          "SET_LAST_MODIFIED" => "N",
          "SET_STATUS_404" => "N",
          "SET_TITLE" => "Y",
          "SHOW_404" => "N",
          "SHOW_DEACTIVATED" => "N",
          "SHOW_DISCOUNT_PERCENT" => "N",
          "SHOW_MAX_QUANTITY" => "N",
          "SHOW_OLD_PRICE" => "N",
          "SHOW_PRICE_COUNT" => "1",
          "SHOW_TOP_ELEMENTS" => "N",
          "SIDEBAR_DETAIL_SHOW" => "N",
          "SIDEBAR_PATH" => "",
          "SIDEBAR_SECTION_SHOW" => "Y",
          "TEMPLATE_THEME" => "black",
          "TOP_ADD_TO_BASKET_ACTION" => "ADD",
          "TOP_ELEMENT_COUNT" => "9",
          "TOP_ELEMENT_SORT_FIELD" => "sort",
          "TOP_ELEMENT_SORT_FIELD2" => "id",
          "TOP_ELEMENT_SORT_ORDER" => "asc",
          "TOP_ELEMENT_SORT_ORDER2" => "desc",
          "TOP_LINE_ELEMENT_COUNT" => "3",
          "TOP_PROPERTY_CODE" => array(
            0 => "",
            1 => "",
          ),
          "USER_CONSENT" => "N",
          "USER_CONSENT_ID" => "0",
          "USER_CONSENT_IS_CHECKED" => "Y",
          "USER_CONSENT_IS_LOADED" => "N",
          "USE_BIG_DATA" => "N",
          "USE_COMMON_SETTINGS_BASKET_POPUP" => "N",
          "USE_COMPARE" => "N",
          "USE_ELEMENT_COUNTER" => "Y",
          "USE_ENHANCED_ECOMMERCE" => "N",
          "USE_FILTER" => "Y",
          "USE_GIFTS_DETAIL" => "N",
          "USE_GIFTS_MAIN_PR_SECTION_LIST" => "N",
          "USE_GIFTS_SECTION" => "N",
          "USE_MAIN_ELEMENT_SECTION" => "N",
          "USE_PRICE_COUNT" => "Y",
          "USE_PRODUCT_QUANTITY" => "Y",
          "USE_REVIEW" => "N",
          "USE_SALE_BESTSELLERS" => "Y",
          "USE_STORE" => "N",
          "COMPONENT_TEMPLATE" => ".default",
          "ADD_PICT_PROP" => "-",
          "LABEL_PROP" => array(),
          "PRODUCT_DISPLAY_MODE" => "Y",
          "OFFER_ADD_PICT_PROP" => "-",
          "OFFER_TREE_PROPS" => "",
          "FILTER_NAME" => $filter_name,
          "FILTER_FIELD_CODE" => array(
            0 => "CODE",
            1 => "XML_ID",
            2 => "NAME",
            3 => "TAGS",
            4 => "DATE_ACTIVE_FROM",
            5 => "DATE_ACTIVE_TO",
            6 => "IBLOCK_NAME",
            7 => "IBLOCK_EXTERNAL_ID",
            8 => "",
          ),
          "FILTER_PROPERTY_CODE" => array(
            0 => "",
            1 => "PROIZVODITEL_ATTR_E",
            2 => "SEZON",
            3 => "POL",
            4 => "",
          ),
          "FILTER_PRICE_CODE" => array(
            0 => "BASE",
          ),
          "FILTER_OFFERS_FIELD_CODE" => array(
            0 => "ID",
            1 => "CODE",
            2 => "XML_ID",
            3 => "NAME",
            4 => "",
          ),
          "FILTER_OFFERS_PROPERTY_CODE" => array(
            0 => "CML2_ARTICLE",
            1 => "COLOR",
            2 => "",
          ),
          "OFFERS_CART_PROPERTIES" => "",
          "DETAIL_ADD_TO_BASKET_ACTION_PRIMARY" => array(
            0 => "BUY",
          ),
          "TOP_PROPERTY_CODE_MOBILE" => "",
          "TOP_OFFERS_FIELD_CODE" => array(
            0 => "",
            1 => "",
          ),
          "TOP_OFFERS_PROPERTY_CODE" => array(
            0 => "",
            1 => "",
          ),
          "TOP_OFFERS_LIMIT" => "5",
          "TOP_VIEW_MODE" => "SECTION",
          "TOP_PRODUCT_BLOCKS_ORDER" => "props,sku,quantityLimit,quantity,buttons,price",
          "TOP_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
          "TOP_ENLARGE_PRODUCT" => "STRICT",
          "TOP_SHOW_SLIDER" => "Y",
          "TOP_SLIDER_INTERVAL" => "3000",
          "TOP_SLIDER_PROGRESS" => "N",
          "LIST_PROPERTY_CODE_MOBILE" => array(),
          "LIST_OFFERS_FIELD_CODE" => array(
            0 => "ID",
            1 => "CODE",
            2 => "",
          ),
          "LIST_OFFERS_PROPERTY_CODE" => array(
            0 => "CML2_ARTICLE",
            1 => "CML2_MEASURE_UNIT",
            2 => "CML2_MEASURE_UNIT_KOEF",
          ),
          "LIST_OFFERS_LIMIT" => "",
          "LIST_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
          "LIST_PRODUCT_ROW_VARIANTS" => "[]",
          "LIST_ENLARGE_PRODUCT" => "STRICT",
          "LIST_SHOW_SLIDER" => "Y",
          "LIST_SLIDER_INTERVAL" => "3000",
          "LIST_SLIDER_PROGRESS" => "N",
          "DETAIL_OFFERS_FIELD_CODE" => array(
            0 => "",
            1 => "",
          ),
          "DETAIL_OFFERS_PROPERTY_CODE" => array(
            0 => "",
            1 => "",
          ),
          "DETAIL_MAIN_BLOCK_PROPERTY_CODE" => array(),
          "DETAIL_MAIN_BLOCK_OFFERS_PROPERTY_CODE" => array(),
          "OFFERS_SORT_FIELD" => "sort",
          "OFFERS_SORT_ORDER" => "asc",
          "OFFERS_SORT_FIELD2" => "id",
          "OFFERS_SORT_ORDER2" => "desc",
          "IBLOCK_TYPE" => "1c_catalog",
          "IBLOCK_ID" => "15",
          "BASKET_URL" => SITE_DIR . "b2bcabinet/personal/order/",
          "VARIABLE_ALIASES" => array(
            "ELEMENT_ID" => "ELEMENT_ID",
            "SECTION_ID" => "SECTION_ID",
          )
        ),
        false
      );

      ?>


    </section>


  <?
  endif;
}


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>