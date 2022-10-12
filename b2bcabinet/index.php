<?
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Config\Option;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Рабочий стол");
$APPLICATION->SetTitle("Рабочий стол");

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

	?>
 <div class="wrap-popup-window mail_feedback" > 
   
            <div class="modal-popup-bg" onclick="closeModal2();">&nbsp;</div> 
            <div class="popup-window"> 
                <div class="popup-close" onclick="closeModal2();"></div>
                <div class="popup-content"> 
                	<div class="sotbit_order_phone_wrapper">
                		<div class="sotbit_order_phone__title">Восстановление пароля</div>
      <?
$APPLICATION->IncludeComponent(
	"bitrix:main.auth.forgotpasswd",
	"",
	Array(
		"AUTH_AUTH_URL" => "/?AUTH_SHOW=Y",
		"AUTH_REGISTER_URL" => "/?AUTH_SHOW=Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	)
);?>

</div>

  </div> 
            </div> 

        </div>

<?

}
if(!$USER->IsAuthorized() && empty($_GET['forgot_password']))
{
   // $APPLICATION->AuthForm('', false, false, 'N', false);
     LocalRedirect('/?AUTH_SHOW=Y');
}
else
{	
	if(empty($_GET['forgot_password'])):
    $APPLICATION->IncludeComponent(
	"bitrix:desktop", 
	"b2bcabinet_desktop_new", 
	array(
		"CAN_EDIT" => "Y",
		"COLUMNS" => "3",
		"COLUMN_WIDTH_0" => "33%",
		"COLUMN_WIDTH_1" => "33%",
		"COLUMN_WIDTH_2" => "33%",
		"GADGETS" => array(
			1 => "FAVORITES",
			2 => "BASKET",
			3 => "BUYERS",
			4 => "DELAYBASKET",
			5 => "PROFILE",
			6 => "ORDERS",
		),
		"GU_ACCOUNTPAY_TITLE_STD" => "",
		"GU_BASKET_TITLE_STD" => "",
		"GU_BLANK_TITLE_STD" => "",
		"GU_DELAYBASKET_TITLE_STD" => "",
		"GU_FAVORITES_TITLE_STD" => "",
		"GU_HTML_AREA_TITLE_STD" => "",
		"GU_ORDERS_LIMIT" => "2",
		"GU_ORDERS_STATUS" => "ALL",
		"GU_ORDERS_TITLE_STD" => "",
		"GU_PROBKI_CITY" => "c213",
		"GU_PROBKI_TITLE_STD" => "",
		"GU_PROFILE_TITLE_STD" => "",
		"GU_REVIEWS_TITLE_STD" => "",
		"GU_RSSREADER_CNT" => "10",
		"GU_RSSREADER_IS_HTML" => "N",
		"GU_RSSREADER_RSS_URL" => "",
		"GU_RSSREADER_TITLE_STD" => "",
		"GU_SUBSCRIBE_TITLE_STD" => "",
		"GU_WEATHER_CITY" => "c21015",
		"GU_WEATHER_COUNTRY" => Loc::getMessage("B2B_CABINET_COUNTRY_RUSSIA"),
		"GU_WEATHER_TITLE_STD" => "",
		"G_ACCOUNTPAY_PATH_TO_BASKET" => SITE_DIR."b2bcabinet/orders/make/",
		"G_ACCOUNTPAY_PATH_TO_PAYMENT" => SITE_DIR."b2bcabinet/orders/payment/",
		"G_ACCOUNTPAY_PERSON_TYPE_ID" => "1",
		"G_BASKET_PATH_TO_BASKET" => SITE_DIR."b2bcabinet/orders/make/",
		"G_BLANK_INIT_JQUERY" => "N",
		"G_BLANK_PATH_TO_BLANK" => SITE_DIR."b2bcabinet/orders/blank_zakaza/",
		"G_BUYERS_PATH_TO_BUYER_DETAIL" => SITE_DIR."b2bcabinet/personal/buyer/index.php?ID=#ID#", 
		"G_BUYORDER_ORG_PROP" => "",
		"G_BUYORDER_PATH_TO_ORDER_DETAIL" => SITE_DIR."b2bcabinet/order/detail/#ID#/",
		"G_BUYORDER_PATH_TO_PAY" => SITE_DIR."b2bcabinet/orders/payment/",
		"G_DISCOUNT_ID_DISCOUNT" => "3",
		"G_DISCOUNT_PATH_TO_PAGE" => "",
		"G_ORDERS_PATH_TO_ORDERS" => SITE_DIR."b2bcabinet/orders/",
		"G_ORDERS_PATH_TO_ORDER_DETAIL" => SITE_DIR."b2bcabinet/order/detail/#ID#/",
		"G_PROBKI_CACHE_TIME" => "3600",
		"G_PROBKI_SHOW_URL" => "N",
		"G_PROFILE_PATH_TO_PROFILE" => SITE_DIR."b2bcabinet/personal/",
		"G_REVIEWS_MAX_RATING" => "5",
		"G_REVIEWS_PATH_TO_REVIEWS" => SITE_DIR."b2bcabinet/personal/reviews/",
		"G_RSSREADER_CACHE_TIME" => "3600",
		"G_RSSREADER_PREDEFINED_RSS" => "",
		"G_RSSREADER_SHOW_URL" => "N",
		"G_SUBSCRIBE_PATH_TO_SUBSCRIBES" => SITE_DIR."b2bcabinet/personal/subscribe/",
		"G_WEATHER_CACHE_TIME" => "3600",
		"G_WEATHER_SHOW_URL" => "N",
		"ID" => "holder2",
		"COMPONENT_TEMPLATE" => "b2bcabinet_desktop_new",
		"GU_REVIEWS_CNT" => "1",
		"GU_REVIEWS_TYPE" => "ALL",
		"GU_BUYERS_TITLE_STD" => "",
		"GU_DISCOUNT_TITLE_STD" => "",
		"GU_BUYORDER_TITLE_STD" => "",
		"G_DELAYBASKET_PATH_TO_BASKET" => "/personal/cart/?delay=1"
	),
	false
);
endif;
}


require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>