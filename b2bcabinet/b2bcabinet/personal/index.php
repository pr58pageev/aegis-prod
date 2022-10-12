<?
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if(!Loader::includeModule('sotbit.b2bcabinet'))
{
    header('Location: '.SITE_DIR.'b2bcabinet/');
}

if(!$USER->IsAuthorized())
{
    $APPLICATION->AuthForm('', false, false, 'N', false);
}
else
{
    $APPLICATION->SetTitle(Loc::getMessage('B2B_CABINET_PERSONAL_PERSONAL_INFO'));
    $APPLICATION->SetPageProperty('title_prefix', '<span class="font-weight-semibold">' . Loc::getMessage('B2B_CABINET_PERSONAL_PERSONAL_DATA') . '</span> - ');
    $APPLICATION->AddChainItem(Loc::getMessage('B2B_CABINET_PERSONAL_PERSONAL_INFO'));

    $APPLICATION->IncludeComponent(
	"bitrix:main.profile", 
	"b2b_personal_data", 
	array(
		"SET_TITLE" => "Y",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"USER_PROPERTY" => array(
		),
		"SEND_INFO" => "N",
		"CHECK_RIGHTS" => "N",
		"USER_PROPERTY_NAME" => "",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "b2b_personal_data",
		"BUYER_PERSONAL_TYPE" => unserialize(COption::GetOptionString("sotbit.b2bcabinet","BUYER_PERSONAL_TYPE","a:0:{}",SITE_ID)),
		"USER_PROPERTY_GENERAL_DATA" => array(
			0 => "NAME",
			1 => "LAST_NAME",
			2 => "SECOND_NAME",
			3 => "EMAIL",
		),
		"USER_PROPERTY_PERSONAL_DATA" => array(
		),
		"USER_PROPERTY_WORK_INFORMATION_DATA" => array(
		),
		"USER_PROPERTY_FORUM_PROFILE_DATA" => array(
		),
		"USER_PROPERTY_BLOG_PROFILE_DATA" => array(
		),
		"USER_PROPERTY_STUDENT_PROFILE_DATA" => array(
		),
		"USER_PROPERTY_ADMIN_NOTE_DATA" => array(
		)
	),
	false
);
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>