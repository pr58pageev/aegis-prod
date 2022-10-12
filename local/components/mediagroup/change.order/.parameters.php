<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
use Bitrix\Main\Loader;
if (!Loader::includeModule('iblock'))
    return;


$iblockExists = (!empty($arCurrentValues['IBLOCK_ID']) && (int)$arCurrentValues['IBLOCK_ID'] > 0);

$compatibleMode = !(isset($arCurrentValues['COMPATIBLE_MODE']) && $arCurrentValues['COMPATIBLE_MODE'] === 'N');

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock = array();
$iblockFilter = (
!empty($arCurrentValues['IBLOCK_TYPE'])
    ? array('TYPE' => $arCurrentValues['IBLOCK_TYPE'], 'ACTIVE' => 'Y')
    : array('ACTIVE' => 'Y')
);
$rsIBlock = CIBlock::GetList(array('SORT' => 'ASC'), $iblockFilter);
while ($arr = $rsIBlock->Fetch()) {
    $id = (int)$arr['ID'];
    if (isset($offersIblock[$id]))
        continue;
    $arIBlock[$id] = '[' . $id . '] ' . $arr['NAME'];
}
unset($id, $arr, $rsIBlock, $iblockFilter);
unset($offersIblock);

$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(
        
        "IBLOCK_ID" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("IBLOCK_IBLOCK"),
            "TYPE" => "LIST",
            "ADDITIONAL_VALUES" => "Y",
            "VALUES" => $arIBlock,
            "REFRESH" => "Y",
        ),
        "AJAX" => Array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("AJAX"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "N",
        ),
    ),
);
?>