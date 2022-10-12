<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Sotbit\Origami\Helper\Config;

global $filterSideFilter;
$useRegion = (Config::get('USE_REGIONS') == 'Y') ? true : false;
if ($useRegion && $_SESSION['SOTBIT_REGIONS']['ID']) {
    $filterSideFilter['PROPERTY_REGIONS'] = [
        false,
        $_SESSION['SOTBIT_REGIONS']['ID']
    ];
}
$APPLICATION->ShowViewContent('blog_filter');
$APPLICATION->ShowViewContent('blog_tags');
//$APPLICATION->IncludeComponent(
//    "bitrix:news.list",
//    "popular_blog",
//    [
//        "IBLOCK_ID" => Config::get("IBLOCK_ID_BLOG"),
//        "IBLOCK_TYPE" => Config::get("IBLOCK_TYPE_BLOG"),
//        "NEWS_COUNT"                      => 5,
//        "SORT_BY1"                        => 'show_counter',
//        "SORT_ORDER1"                     => 'asc',
//        "DISPLAY_PANEL"                   => 'N',
//        "SET_TITLE"                       => 'N',
//        "SET_LAST_MODIFIED"               => 'N',
//        "MESSAGE_404"                     => '',
//        "SET_STATUS_404"                  => 'N',
//        "SHOW_404"                        => 'N',
//        "FILE_404"                        => 'N',
//        "INCLUDE_IBLOCK_INTO_CHAIN"       => 'N',
//        "CACHE_TIME"                      => 36000000,
//        "DISPLAY_TOP_PAGER"               => 'N',
//        "DISPLAY_BOTTOM_PAGER"            => 'N',
//        "DISPLAY_NAME"                    => "Y",
//        "ACTIVE_DATE_FORMAT"              => 'd.m.Y',
//        "FILTER_NAME"                     => '',
//    ],
//    $component
//);
$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"blog_sections", 
	array(
		"VIEW_MODE" => "TEXT",
		"SHOW_PARENT_NAME" => "Y",
		"IBLOCK_TYPE" => Config::get("IBLOCK_TYPE_BLOG"),
		"IBLOCK_ID" => Config::get("IBLOCK_ID_BLOG"),
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => "",
		"SECTION_URL" => "/blog/#SECTION_CODE#/",
		"COUNT_ELEMENTS" => "Y",
		"TOP_DEPTH" => "3",
		"SECTION_FIELDS" => array(
			0 => "SORT",
			1 => "",
		),
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"ADD_SECTIONS_CHAIN" => "Y",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_GROUPS" => "Y",
		"COMPONENT_TEMPLATE" => "blog_sections",
		"FILTER_NAME" => "sectionsFilter",
		"CACHE_FILTER" => "N"
	),
	false
);
//$APPLICATION->ShowViewContent('blog_detail');
?>