<?php

use Bitrix\Main\Loader;

define('STOP_STATISTICS', true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

if ($_POST['GET_INFO']) {

    $_SESSION['BLANK_IDS']['TOTAL_COUNT'] = count($_SESSION['BLANK_IDS']['ELEMENTS']);


    echo \Bitrix\Main\Web\Json::encode($_SESSION['BLANK_IDS']);
    return;
}

Loader::includeModule('currency');
$id = htmlspecialchars($_POST['id']);
$qnt = htmlspecialchars($_POST['qnt']);
//$iblock = htmlspecialchars($_POST['iblock']);
$properties = $_POST['props'];
$prices = $_POST['prices'];

$is_individual = $_POST['is_individual'];
$clear_basket = $_POST['clear_basket'];

$current_profile_id = false;

$basketRes = Bitrix\Sale\Internals\BasketTable::getList(array(
    'filter' => array(
        'FUSER_ID' => Bitrix\Sale\Fuser::getId(),
        'ORDER_ID' => null,
        'LID' => SITE_ID,
        'CAN_BUY' => 'Y',
    )
));

$basket_individual_items = [];

while ($item = $basketRes->fetch()) {
    $basketPropRes = Bitrix\Sale\Internals\BasketPropertyTable::getList(array(
        'filter' => array(
            "BASKET_ID" => $item['ID'],
        ),
    ));

    while ($property = $basketPropRes->fetch()) {

        if ($property['CODE'] == 'PROFILE_ID') {
            $basket_individual_items[] = $item['ID'];
            $current_profile_id = $property['VALUE'];
            break;
        }
    }
}

if(!$current_profile_id){
    if(count($_SESSION['BLANK_IDS']['ELEMENTS'])>0)
        foreach ($_SESSION['BLANK_IDS']['ELEMENTS'] as $key => $product) {
            foreach ($product['PROPS'] as $prop)
                if($prop['CODE'] == 'PROFILE_ID')
                    $current_profile_id = $prop['VALUE'];
        }
}

global $USER;
$USER_ID = $USER->GetId();

if ($is_individual && !$clear_basket) {
    $personal_products = Mediagroup::getUserProduct($USER_ID, $_SESSION['PROFILE_COMPANY'], false, true);

    if ($current_profile_id)
        if ($personal_products[$id]) {
            $prod_profile_id = $personal_products[$id]['UF_PROFILE_ID'];
            if ($current_profile_id != $prod_profile_id ||
                !Mediagroup::checkIndividualProduct($prod_profile_id)) {
                $wrong_profile = true;
            }

            if ($wrong_profile) {
                $allProfiles = Mediagroup::getUserProfiles($USER_ID);
                $profile_name = htmlspecialchars_decode($allProfiles[$current_profile_id]['NAME']);

                echo \Bitrix\Main\Web\Json::encode(['error' => 'error_profile', 'profile_name' => $profile_name]);
                exit;
            }
        }

} elseif ($clear_basket) {
    foreach ($_SESSION['BLANK_IDS']['ELEMENTS'] as $key => $product)
        foreach ($product['PROPS'] as $prop)
            if($prop['CODE'] == 'PROFILE_ID')
                unset($_SESSION['BLANK_IDS']['ELEMENTS'][$key]);

    foreach ($_SESSION['BLANK_IDS']['ELEMENTS'] as $key => $product) {


        if ($key !== 'TOTAL_PRICE' && $key !== 'TOTAL_COUNT') {
            $total += $product['QNT'] * $product['MIN_PRICE'];
            $totalCount++;
            $totalWeight += $product['WEIGHT'] * $product['QNT'];
        }
    }

    if ($total > 0) {
        $_SESSION['BLANK_IDS']['TOTAL_PRICE'] = CurrencyFormat($total, '');
        $_SESSION['BLANK_IDS']['TOTAL_COUNT'] = $totalCount;
        $_SESSION['BLANK_IDS']['TOTAL_WEIGHT'] = $totalWeight / 1000;
    }


    // еще и очищать вю корзину от нечисти
    foreach ($basket_individual_items as $row_id)
        CSaleBasket::Delete($row_id);

    if (!$is_individual) {
        echo 'success';
        die;
    }
}

if ($is_individual) {
    $properties[] = [
        'CODE' => 'PROFILE_ID',
        'NAME' => 'PROFILE_ID',
        'VALUE' => $_SESSION['PROFILE_COMPANY']
    ];
}



$weight = $_POST['weight'];


$minPrice = array_shift($prices);
$currency = (!empty($_POST['baseCurrency']) ? $_POST['baseCurrency'] : '');
$minPrice = $minPrice['VALUE'];

foreach ($prices as $price) {
    if ($minPrice > $price['VALUE'])
        $minPrice = $price['VALUE'];
}

if($_POST['props']['NULL_PRICE']=='Y'){
    $minPrice = '0';
}


if ($id > 0) {
    if ($qnt == 0) {

        unset($_SESSION['BLANK_IDS']['ELEMENTS'][$id]);
        unset($_SESSION['BLANK_IDS']['TOTAL_PRICE']);
        unset($_SESSION['BLANK_IDS']['TOTAL_COUNT']);
        unset($_SESSION['BLANK_IDS']['TOTAL_WEIGHT']);
        if (empty($_SESSION['BLANK_IDS']['ELEMENTS'])) {
            $_SESSION['BLANK_IDS']['TOTAL_PRICE'] = CurrencyFormat(0, $currency);
            $_SESSION['BLANK_IDS']['TOTAL_COUNT'] = 0;
            $_SESSION['BLANK_IDS']['TOTAL_WEIGHT'] = 0;
            echo \Bitrix\Main\Web\Json::encode($_SESSION['BLANK_IDS']);
            return;
        }
    }
    if ($id == 0 || $qnt <= 0) {
        unset($_SESSION['BLANK_IDS']['ELEMENTS'][$id]);
        if (count($_SESSION['BLANK_IDS']['ELEMENTS']) == 2 && isset($_SESSION['BLANK_IDS']['TOTAL_PRICE']) && isset($_SESSION['BLANK_IDS']['TOTAL_COUNT'])) {
            unset($_SESSION['BLANK_IDS']['TOTAL_PRICE']);
            unset($_SESSION['BLANK_IDS']['TOTAL_COUNT']);
            unset($_SESSION['BLANK_IDS']['TOTAL_WEIGHT']);
        }
    } else {
        $_SESSION['BLANK_IDS']['ELEMENTS'][$id] = [
            'QNT' => $qnt,
            'PROPS' => $properties,
            'MIN_PRICE' => $minPrice,
            'CURRENCY' => $currency,
            'WEIGHT' => $weight
        ];
    }

    $total = 0;
    $totalCount = 0;
    $totalWeight = 0;


    foreach ($_SESSION['BLANK_IDS']['ELEMENTS'] as $key => $product) {
        if ($key !== 'TOTAL_PRICE' && $key !== 'TOTAL_COUNT') {
            $total += $product['QNT'] * $product['MIN_PRICE'];
            $totalCount++;
            $totalWeight += $product['WEIGHT'] * $product['QNT'];
        }
    }


   // if ($total > 0) {
    if(true){
        $_SESSION['BLANK_IDS']['TOTAL_PRICE'] = CurrencyFormat($total, $currency);
        $_SESSION['BLANK_IDS']['TOTAL_COUNT'] = $totalCount;
        $_SESSION['BLANK_IDS']['TOTAL_WEIGHT'] = $totalWeight / 1000;
    }


    echo \Bitrix\Main\Web\Json::encode($_SESSION['BLANK_IDS']);
    return;
}
?>