<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Loader,
    Bitrix\Main,
    Bitrix\Iblock;

global $USER;

$arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);
$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);

$arSort = array(
    "left_margin"=>"asc",
);

$arFilter = array(
    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    "CREATED_BY" => $USER->GetID()
);

$arSelect = array(
    "ID",
    "NAME",
    "TIMESTAMP_X",
    "ACTIVE",
    "IBLOCK_ID",
    "IBLOCK_SECTION_ID",
    "SECTION_PAGE_URL",
    "DEPTH_LEVEL",
    "UF_*"
);

$arResult['SECTIONS'] = array();

$rsSections = CIBlockSection::GetList($arSort, $arFilter, array(), $arSelect);
$rsSections->SetUrlTemplates("", $arParams["SECTION_URL"]);
while($arSection = $rsSections->GetNext())
{
    //\Bitrix\Iblock\InheritedProperty\SectionValues::queue($arSection["IBLOCK_ID"], $arSection["ID"]);

    $arButtons = CIBlock::GetPanelButtons(
        $arSection["IBLOCK_ID"],
        0,
        $arSection["ID"],
        array("SESSID"=>false, "CATALOG"=>true)
    );
    $arSection["EDIT_LINK"] = $arButtons["edit"]["edit_section"]["ACTION_URL"];
    $arSection["DELETE_LINK"] = $arButtons["edit"]["delete_section"]["ACTION_URL"];
    $sPoints = '';

    for($i=1;$i<=$arSection['DEPTH_LEVEL'];$i++)
        if($i>1)
            $sPoints .= '-';

    $arSection['PRINT_NAME'] = $sPoints.$arSection['NAME'];

    $arResult["SECTIONS"][] = $arSection;
}

$this->IncludeComponentTemplate();