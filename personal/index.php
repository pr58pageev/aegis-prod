<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
global $USER;
use Sotbit\Origami\Helper\Config;
if(!$USER->IsAuthorized())
{
    $APPLICATION->AuthForm('', false, false, 'N', false);
    $APPLICATION->AddChainItem("Авторизация", "");
}
else{

            $APPLICATION->IncludeComponent(
                "bitrix:sale.personal.section",
                "origami_default",
                array(
                    "ACCOUNT_PAYMENT_ELIMINATED_PAY_SYSTEMS" => array(
                        0 => "0",
                    ),
                    "ACCOUNT_PAYMENT_SELL_SHOW_FIXED_VALUES" => "Y",
                    "ACCOUNT_PAYMENT_SELL_TOTAL" => array(
                        0 => "100",
                        1 => "200",
                        2 => "500",
                        3 => "1000",
                        4 => "5000",
                        5 => "",
                    ),
                    "ACCOUNT_PAYMENT_SELL_USER_INPUT" => "Y",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "3600",
                    "CACHE_TYPE" => "A",
                    "CHECK_RIGHTS_PRIVATE" => "N",
                    "COMPATIBLE_LOCATION_MODE_PROFILE" => "N",
                    "CUSTOM_PAGES" => "",
                    "CUSTOM_SELECT_PROPS" => array(
                    ),
                    "NAV_TEMPLATE" => "",
                    "ORDER_HISTORIC_STATUSES" => array(
                        0 => "F",
                    ),
                    "PATH_TO_BASKET" => Config::get('BASKET_PAGE'),
                    "PATH_TO_CATALOG" => "/catalog/",
                    "PATH_TO_CONTACT" => "/about/contacts",
                    "PATH_TO_PAYMENT" => Config::get('PAYMENT_PAGE'),
                    "PER_PAGE" => "20",
                    "PROP_1" => array(
                    ),
                    "PROP_2" => array(
                    ),
                    "SAVE_IN_SESSION" => "Y",
                    "SEF_FOLDER" => "/personal/",
                    "SEF_MODE" => "Y",
                    "SEND_INFO_PRIVATE" => "N",
                    "SET_TITLE" => "Y",
                    "SHOW_ACCOUNT_COMPONENT" => "Y",
                    "SHOW_ACCOUNT_PAGE" => "Y",
                    "SHOW_ACCOUNT_PAY_COMPONENT" => "Y",
                    "SHOW_BASKET_PAGE" => "Y",
                    "SHOW_CONTACT_PAGE" => "Y",
                    "SHOW_ORDER_PAGE" => "Y",
                    "SHOW_PRIVATE_PAGE" => "Y",
                    "SHOW_PROFILE_PAGE" => "Y",
                    "ALLOW_INNER" => "N",
                    "ONLY_INNER_FULL" => "N",
                    "SHOW_SUBSCRIBE_PAGE" => "Y",
                    "USER_PROPERTY_PRIVATE" => "",
                    "USE_AJAX_LOCATIONS_PROFILE" => "N",
                    "COMPONENT_TEMPLATE" => "origami_default",
                    "ACCOUNT_PAYMENT_SELL_CURRENCY" => "RUB",
                    "ORDER_HIDE_USER_INFO" => array(
                        0 => "0",
                    ),
                    "ORDER_RESTRICT_CHANGE_PAYSYSTEM" => array(
                        0 => "0",
                    ),
                    "ORDER_DEFAULT_SORT" => "STATUS",
                    "ORDER_REFRESH_PRICES" => "N",
                    "ORDERS_PER_PAGE" => "20",
                    "PROFILES_PER_PAGE" => "20",
                    "MAIN_CHAIN_NAME" => "Мой кабинет",
                    "COMPOSITE_FRAME_MODE" => "A",
                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                    "ACCOUNT_PAYMENT_PERSON_TYPE" => "1",
                    "SEF_URL_TEMPLATES" => array(
                        "index" => "index.php",
                        "orders" => "orders/",
                        "account" => "account/",
                        "subscribe" => "subscribe/",
                        "profile" => "profiles/",
                        "profile_detail" => "profiles/#ID#",
                        "private" => "private/",
                        "order_detail" => "orders/#ID#",
                        "order_cancel" => "cancel/#ID#",
                    )
                ),
                false
            );
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
