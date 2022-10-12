<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Категории и публикации");
?>
<?$APPLICATION->IncludeComponent(
    "mediagroup:personal.blog",
    ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "IBLOCK_TYPE" => "sotbit_origami_content",
        "IBLOCK_ID" => "1",
        "COMPOSITE_FRAME_MODE" => "A",
        "COMPOSITE_FRAME_TYPE" => "AUTO"
    ),
    false
);?>
<?$APPLICATION->IncludeComponent(
	"bitrix:iblock.element.add.list", 
	"temp", 
	array(
		"SEF_MODE" => "N",
		"IBLOCK_TYPE" => "sotbit_origami_content",
		"IBLOCK_ID" => "1",
		"GROUPS" => array(
			0 => "15",
		),
		"STATUS" => "ANY",
		"EDIT_URL" => "/suppliers_cabinet/post/",
		"ELEMENT_ASSOC" => "CREATED_BY",
		"ELEMENT_ASSOC_PROPERTY" => "2",
		"ALLOW_EDIT" => "Y",
		"ALLOW_DELETE" => "Y",
		"NAV_ON_PAGE" => "10",
		"MAX_USER_ENTRIES" => "100000",
		"SEF_FOLDER" => "/suppliers_cabinet/manage/",
		"COMPONENT_TEMPLATE" => "temp",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>