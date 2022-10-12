<?php
define("STOP_STATISTICS", true);
define("NOT_CHECK_PERMISSIONS", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
\Bitrix\Main\Loader::includeModule('sotbit.origami');
$moduleIncluded = false;
try {
    $moduleIncluded = \Bitrix\Main\Loader::includeModule('sotbit.origami');
} catch (\Bitrix\Main\LoaderException $e) {
}
$params = json_decode($params, true);

\Bitrix\Main\Loader::includeModule('catalog');

$Buy = new \Sotbit\Origami\Sale\Basket\Buy();
if (!$params['props']) {
    $params['props'] = [];
}
$Buy->setId($params['id']);
if ($params['props']) {
    $props = unserialize(base64_decode($params['props']));
}

if (!is_array($props)) {
    $props = [];
}
$Buy->setProps($props);
if($params['nullPrice']=='Y'){

    $ar_res = CIBlockElement::GetByID($params['id'])->Fetch();
    $result = array(
        'PRODUCT_ID' => $ar_res['ID'],
        'PREVIEW_PICTURE' => $ar_res['PREVIEW_PICTURE'],
        'PRODUCT_XML_ID' => $ar_res['XML_ID'],
        //   'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
        'PRICE' => 0,
        'CUSTOM_PRICE' => 'Y',
        'CURRENCY' => 'RUB',
        'QUANTITY' => $params['qnt'],
        'LID' => SITE_ID,
        'DELAY' => 'N',
        'CAN_BUY' => 'Y',
        'NAME' => htmlspecialchars_decode($ar_res['NAME']),
        // 'CALLBACK_FUNC' => 'MyBasketCallbackW',
        'MODULE' => 'catalog',
        //    'ORDER_CALLBACK_FUNC' => 'MyBasketOrderCallback',
        'DETAIL_PAGE_URL' => $ar_res['DETAIL_PAGE_URL']
    );
    $arProps[] = array(
        "NAME" => "Стоимость",
        "VALUE" => 0
    );

    $result["PROPS"] = $arProps;
    CSaleBasket::Add($result);
    echo json_encode(['STATUS' => 'OK']);
    die;
}


if($params['qnt'] > 0)
    $Buy->setQnt($params['qnt']);
if ($params['action'] == 'add') {
    $result = $Buy->add();
} else {
    $result = $Buy->remove();
}
if (!$result) {
    echo json_encode(['STATUS' => 'ERROR','MESSAGE' => 'Error basket']);
}
else{
    echo json_encode(['STATUS' => 'OK']);
}