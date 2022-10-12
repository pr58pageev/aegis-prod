<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавление категории");
?><?$APPLICATION->IncludeComponent(
	"mediagroup:iblock.section.add.form", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"USER_MESSAGE_EDIT" => "",
		"USER_MESSAGE_ADD" => "",
		"DEFAULT_INPUT_SIZE" => "30",
		"IBLOCK_TYPE" => "sotbit_origami_content",
		"IBLOCK_ID" => "1",
		"GROUPS" => array(
			0 => "15",
		),
		"ELEMENT_ASSOC" => "CREATED_BY",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>