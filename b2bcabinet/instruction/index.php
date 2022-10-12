<?

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Sotbit\B2bCabinet\Helper\Config;


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("");

if (!Loader::includeModule('sotbit.b2bcabinet')) {
  header('Location: ' . SITE_DIR . 'b2bcabinet/');
}

if (!$USER->IsAuthorized())
{
  $APPLICATION->AuthForm('', false, false, 'N', false);
}
else
{
$APPLICATION->SetTitle('Иструкция к ЛК');
$APPLICATION->SetPageProperty('title_prefix', '<span class="font-weight-semibold">' . Loc::getMessage('B2B_CABINET_ORDERS_ORDERS') . '</span> - ');
$APPLICATION->AddChainItem(Loc::getMessage('B2B_CABINET_ORDERS_ORDER_STATUS'));
$_REQUEST['show_all'] = 'Y';
?><!-- person -->
<section class="order-section">
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
      "COMPONENT_TEMPLATE" => "main_promo",
      "COMPOSITE_FRAME_MODE" => "A",
      "COMPOSITE_FRAME_TYPE" => "AUTO",
      "DETAIL_URL" => "",
      "DISPLAY_BOTTOM_PAGER" => "Y",
      "DISPLAY_DATE" => "Y",
      "DISPLAY_NAME" => "Y",
      "DISPLAY_PICTURE" => "Y",
      "DISPLAY_PREVIEW_TEXT" => "Y",
      "DISPLAY_TOP_PAGER" => "N",
      "ELEMENT_CODE" => "instruktsiya-k-lk",
      "ELEMENT_ID" => "",
      "FIELD_CODE" => array(0 => "", 1 => "",),
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
      "PROPERTY_CODE" => array(0 => "", 1 => "FILE", 2 => "",),
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
  <div class="container-container">
    <div class="editable-content">
      <?
      $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        ".default",
        array(
          "COMPONENT_TEMPLATE" => ".default",
          "COMPOSITE_FRAME_MODE" => "A",
          "COMPOSITE_FRAME_TYPE" => "AUTO",
          "AREA_FILE_SHOW" => "file",
          "PATH" => "/include/instruction_inner.php",
          "EDIT_TEMPLATE" => ""
        ),
        false
      ); ?>
    </div>
  </div>
</section><?
}
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>