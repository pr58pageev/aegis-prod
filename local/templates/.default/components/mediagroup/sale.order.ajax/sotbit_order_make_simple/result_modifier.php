<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Sale;
/**
 * @var array $arParams
 * @var array $arResult
 * @var SaleOrderAjax $component
 */

use Sotbit\Origami\Helper\Config;

if (Config::get("IMAGE_FOR_OFFER") == 'PRODUCT' && $arResult["BASKET_ITEMS"] && $arResult['GRID']['ROWS'])
{
    $Basket = new \Sotbit\Origami\Image\Basket();
    $Basket->setMediumHeight(190);
    $Basket->setMediumWidth(190);
    $arProductID = [];

    foreach($arResult["BASKET_ITEMS"] as $arItem)
    {
        $arProductID[] = $arItem['PRODUCT_ID'];
    }

    $images = $Basket->getImages($arProductID);

    foreach($arResult['GRID']['ROWS'] as &$arRow)
    {
        $arRow['data'] = $Basket->changeImages($arRow['data'], $images[$arRow['data']['PRODUCT_ID']]);
    }
}


$result = \Bitrix\Sale\Delivery\Services\Table::getList(array(

    'filter' => array('ACTIVE'=>'Y'),

));


$arResult['DELIVERY_CUSTOM']  = array();

while($delivery=$result->fetch())
{
    $arResult['DELIVERY_CUSTOM'][$delivery['ID']] = $delivery;
}



/* Получение старых данных заказа */

$order = Sale\Order::load($_GET['ID_ORDER']);
$arResult["USER_VALS"]["ORDER_DESCRIPTION"] = $order->getField('USER_DESCRIPTION'); 
$propertyCollection = $order->getPropertyCollection();
    $ar = $propertyCollection->getArray();
    
    foreach ($ar['properties'] as $key => $value) {
        $arCustomResult[$value['CODE']] = $value['VALUE'][0];
        $arCustomResultIDS[$value['ID']] = $value['VALUE'][0];
    }


if ($_POST["is_ajax_post"] != "Y"):
    //if(!$_SESSION['IS_FIRST_ORDER'][$_GET['ID_ORDER']]):

foreach ($arResult['ORDER_PROP']['USER_PROPS_N'] as $key => $value) {
    

    $arResult['ORDER_PROP']['USER_PROPS_N'][$key]['VALUE'] = $arCustomResult[$value['CODE']];
}


foreach ($arResult['ORDER_PROP']['USER_PROPS_Y'] as $key => $value) {
    

    $arResult['ORDER_PROP']['USER_PROPS_Y'][$key]['VALUE'] = $arCustomResult[$value['CODE']];
}



$arResult['OLD_VALUE_PROP'] = $arCustomResult;


foreach ($arResult['USER_VALS']['ORDER_PROP'] as $key => $value) {
    

   $arResult['USER_VALS']['ORDER_PROP'][$key] = $arCustomResultIDS[$key];
}
$_SESSION['IS_FIRST_ORDER'][$_GET['ID_ORDER']] = 'Y';
endif;
