<?
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Application;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Изменение заказа");
$APPLICATION->SetTitle("Изменение заказа");

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
if(!empty($_GET['forgot_password'])){
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
if(!$USER->IsAuthorized() && empty($_GET['forgot_password']))
{
   // $APPLICATION->AuthForm('', false, false, 'N', false);
     LocalRedirect('/?AUTH_SHOW=Y');
}
else
{	


$request = Application::getInstance()->getContext()->getRequest();

$APPLICATION->IncludeComponent(
	"mediagroup:sale.order.ajax",
	"sotbit_order_make_simple",
	array(
		"PAY_FROM_ACCOUNT" => "Y",
		"COUNT_DELIVERY_TAX" => "N",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
		"ALLOW_AUTO_REGISTER" => "Y",
		"SEND_NEW_USER_NOTIFY" => "Y",
		"DELIVERY_NO_AJAX" => "Y",
		"TEMPLATE_LOCATION" => "popup",
		"PROP_1" => "",
		"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
		"PATH_TO_PERSONAL" => "/b2bcabinet/",
		"PATH_TO_PAYMENT" => SITE_DIR."personal/order/payment/",
		"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
		"SET_TITLE" => "Y",
		"SHOW_ACCOUNT_NUMBER" => "Y",
		"DELIVERY_NO_SESSION" => "N",
		"COMPATIBLE_MODE" => "Y",
		"BASKET_POSITION" => "before",
		"BASKET_IMAGES_SCALING" => "adaptive",
		"SERVICES_IMAGES_SCALING" => "adaptive",
		"USER_CONSENT" => "Y",
		"USER_CONSENT_ID" => "1",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "Y",
		"ALLOW_APPEND_ORDER" => "Y",
		"SHOW_NOT_CALCULATED_DELIVERIES" => "L",
		"SPOT_LOCATION_BY_GEOIP" => "Y",
		"DELIVERY_TO_PAYSYSTEM" => "d2p",
		"SHOW_VAT_PRICE" => "Y",
		"USE_PREPAYMENT" => "N",
		"USE_PRELOAD" => "Y",
		"ALLOW_USER_PROFILES" => "Y",
		"ALLOW_NEW_PROFILE" => "Y",
		"SHOW_PAYMENT_SERVICES_NAMES" => "Y",
		"SHOW_STORES_IMAGES" => "Y",
		"TEMPLATE_THEME" => "site",
		"SHOW_ORDER_BUTTON" => "final_step",
		"SHOW_TOTAL_ORDER_BUTTON" => "N",
		"SHOW_PAY_SYSTEM_LIST_NAMES" => "Y",
		"SHOW_PAY_SYSTEM_INFO_NAME" => "Y",
		"SHOW_DELIVERY_LIST_NAMES" => "Y",
		"SHOW_DELIVERY_INFO_NAME" => "Y",
		"SHOW_DELIVERY_PARENT_NAMES" => "Y",
		"SKIP_USELESS_BLOCK" => "Y",
		"SHOW_BASKET_HEADERS" => "N",
		"DELIVERY_FADE_EXTRA_SERVICES" => "N",
		"SHOW_COUPONS_BASKET" => "Y",
		"SHOW_COUPONS_DELIVERY" => "Y",
		"SHOW_COUPONS_PAY_SYSTEM" => "Y",
		"SHOW_NEAREST_PICKUP" => "N",
		"DELIVERIES_PER_PAGE" => "9",
		"PAY_SYSTEMS_PER_PAGE" => "9",
		"PICKUPS_PER_PAGE" => "5",
		"SHOW_PICKUP_MAP" => "Y",
		"SHOW_MAP_IN_PROPS" => "N",
		"PICKUP_MAP_TYPE" => "yandex",
		"PROPS_FADE_LIST_1" => "",
		"PROPS_FADE_LIST_2" => "",
		"ACTION_VARIABLE" => "soa-action",
		"PATH_TO_AUTH" => SITE_DIR."auth/",
		"DISABLE_BASKET_REDIRECT" => "N",
		"USE_PHONE_NORMALIZATION" => "Y",
		"PRODUCT_COLUMNS_VISIBLE" => array(
			0 => "PREVIEW_PICTURE",
			1 => "PROPS",
			2 => "DISCOUNT_PRICE_PERCENT_FORMATED",
			3 => "PRICE_FORMATED",
		),
		"ADDITIONAL_PICT_PROP_2" => "-",
		"ADDITIONAL_PICT_PROP_3" => "-",
		"ADDITIONAL_PICT_PROP_8" => "-",
		"ADDITIONAL_PICT_PROP_9" => "-",
		"ADDITIONAL_PICT_PROP_19" => "-",
		"ADDITIONAL_PICT_PROP_20" => "-",
		"PRODUCT_COLUMNS_HIDDEN" => "",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"USE_YM_GOALS" => "N",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_CUSTOM_MAIN_MESSAGES" => "N",
		"USE_CUSTOM_ADDITIONAL_MESSAGES" => "N",
		"USE_CUSTOM_ERROR_MESSAGES" => "N",
		"EMPTY_BASKET_HINT_PATH" => SITE_DIR,
		"HIDE_ORDER_DESCRIPTION" => "N",
		"ADDITIONAL_PICT_PROP_5" => "-",
		"ADDITIONAL_PICT_PROP_23" => "-",
		"ADDITIONAL_PICT_PROP_24" => "-",
		"COMPONENT_TEMPLATE" => "sotbit_order_make_simple",
		"ADDITIONAL_PICT_PROP_12" => "-",
		"ADDITIONAL_PICT_PROP_15" => "-",
		"ADDITIONAL_PICT_PROP_17" => "-",
		"ADDITIONAL_PICT_PROP_21" => "-",
		"ADDITIONAL_PICT_PROP_22" => "-"
	),
	false
);

}


require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>