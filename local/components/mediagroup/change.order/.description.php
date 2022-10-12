<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("NAME"),
	"DESCRIPTION" => GetMessage("DESCRIPTION"),
	"ICON" => "/images/icon.gif",
	"SORT" => 40,
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "SMSC",
		"CHILD" => array(
			"ID" => "smsc",
			"NAME" => GetMessage("CHILD_NAME"),
			"SORT" => 40,
		),
	),
);

?>
