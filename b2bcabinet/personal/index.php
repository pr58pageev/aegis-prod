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
		"ELEMENT_CODE" => "nastroyki",
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
			1 => "EMAIL",
			2=>"PERSONAL_PHONE",
				3=>"PERSONAL_MOBILE"
		),
		"USER_PROPERTY_PERSONAL_DATA" => array(
			0 => "HIDE",
		),
		"USER_PROPERTY_WORK_INFORMATION_DATA" => array(
			0 => "HIDE",
		),
		"USER_PROPERTY_FORUM_PROFILE_DATA" => array(
			0 => "HIDE",
		),
		"USER_PROPERTY_BLOG_PROFILE_DATA" => array(
			0 => "HIDE",
		),
		"USER_PROPERTY_STUDENT_PROFILE_DATA" => array(
			0 => "HIDE",
		),
		"USER_PROPERTY_ADMIN_NOTE_DATA" => array(
			0 => "HIDE",
		)
	),
	false
);?>
</div>
</section><?
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>