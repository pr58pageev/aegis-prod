<?
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Sotbit\B2bCabinet\Helper\Config;


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

if(!Loader::includeModule('sotbit.b2bcabinet')){
    header('Location: '.SITE_DIR.'b2bcabinet/');
}

if(!$USER->IsAuthorized())
{
    $APPLICATION->AuthForm('', false, false, 'N', false);
}
else
{
    $APPLICATION->SetTitle(Loc::getMessage('B2B_CABINET_ORDERS_ORDER_STATUS'));
    $APPLICATION->SetPageProperty('title_prefix', '<span class="font-weight-semibold">' . Loc::getMessage('B2B_CABINET_ORDERS_ORDERS') . '</span> - ');
    $APPLICATION->AddChainItem(Loc::getMessage('B2B_CABINET_ORDERS_ORDER_STATUS'));
    $_REQUEST['show_all']='Y';
    ?>

    <!-- person -->
  <section class="order-section">


    <?
    $APPLICATION->IncludeComponent(
	"bitrix:news.detail", 
	"main_promo", 
	array(
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
		"ELEMENT_CODE" => "sostoyanie-zakazov",
		"ELEMENT_ID" => "",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
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
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "FILE",
			2 => "",
		),
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
		"USE_SHARE" => "N",
		"COMPONENT_TEMPLATE" => "main_promo"
	),
	false
); ?>
    <div class="container-container">
    	<?

    $APPLICATION->IncludeComponent(
	"bitrix:sale.personal.order", 
	"b2bcabinet", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ALLOW_INNER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CUSTOM_SELECT_PROPS" => array(
			0 => "PROPERTY_CML2_ARTICLE",
			1 => "PROPERTY_RAZMER",
			2 => "PROPERTY_KOD",
			3 => "KOD",
			4 => "",
		),
		"DETAIL_HIDE_USER_INFO" => array(
			0 => "0",
		),
		"DISALLOW_CANCEL" => "N",
		"HISTORIC_STATUSES" => array(
			0 => "F",
		),
		"NAV_TEMPLATE" => "",
		"ONLY_INNER_FULL" => "N",
		"ORDERS_PER_PAGE" => "20",
		"ORDER_DEFAULT_SORT" => "STATUS",
		"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
		"PATH_TO_CATALOG" => SITE_DIR."catalog/",
		"PATH_TO_PAYMENT" => SITE_DIR."b2bcabinet/orders/payment/",
		"PROP_1" => array(
		),
		"PROP_2" => array(
		),
		"PROP_3" => array(
			0 => "22",
		),
		"REFRESH_PRICES" => "N",
		"RESTRICT_CHANGE_PAYSYSTEM" => array(
			0 => "0",
		),
		"SAVE_IN_SESSION" => "Y",
		"SEF_MODE" => "Y",
		"SET_TITLE" => "Y",
		"STATUS_COLOR_F" => "gray",
		"STATUS_COLOR_N" => "green",
		"STATUS_COLOR_P" => "yellow",
		"STATUS_COLOR_PSEUDO_CANCELLED" => "red",
		"COMPONENT_TEMPLATE" => "b2bcabinet",
		"IBLOCK_TYPE" => "1c_catalog",
		"IBLOCK_ID" => "15",
		"OFFER_TREE_PROPS" => array(
		),
		"OFFER_COLOR_PROP" => "-",
		"MANUFACTURER_ELEMENT_PROPS" => "-",
		"MANUFACTURER_LIST_PROPS" => "-",
		"PICTURE_FROM_OFFER" => "N",
		"MORE_PHOTO_PRODUCT_PROPS" => "-",
		"IMG_WIDTH" => "80",
		"IMG_HEIGHT" => "120",
		"SEF_FOLDER" => "/b2bcabinet/order/",
		"STATUS_COLOR_AC" => "gray",
		"STATUS_COLOR_OZ" => "gray",
		"STATUS_COLOR_GO" => "gray",
		"STATUS_COLOR_DZ" => "gray",
		"STATUS_COLOR_CA" => "gray",
		"STATUS_COLOR_VP" => "gray",
		"STATUS_COLOR_CR" => "gray",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"STATUS_COLOR_CH" => "gray",
		"SEF_URL_TEMPLATES" => array(
			"list" => "index.php",
			"detail" => "detail/#ID#/",
			"cancel" => "cancel/#ID#/",
		)
	),
	false
); ?>
    </div>
    </section><?
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>