<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$elementIds = array_column($arResult['ELEMENTS'],"ID");
$arSelect = Array(
    "ID",
    "IBLOCK_ID",
    "NAME",
    "DATE_ACTIVE_FROM",
    "PROPERTY_*"
);
$arFilter = Array(
    "IBLOCK_ID" => $arParams['IBLOCK_ID'],
    "ID" => $elementIds
);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement()){
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();
    $arResult['COMMENTS'][$arFields['ID']] = $arProps['COMMENT_ADMIN'];
}