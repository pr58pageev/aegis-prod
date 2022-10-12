<?php
use Bitrix\Sale;
use Bitrix\Main\Loader;


define('STOP_STATISTICS', true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");


$id = htmlspecialchars($_POST['id']);
$qnt = htmlspecialchars($_POST['qnt']);

$naiden = false;

$count_item = 0;
$basket = Sale\Order::load($_POST['ID_ORDER'])->getBasket();
$basketItems = $basket->getBasketItems(); 
foreach ($basket as $basketItem) {
   
   
    $id_prod = $basketItem->getField('PRODUCT_ID');
    
   $count_item++;
    if($id_prod==$id){

         if($qnt==0){
        $basketItem->delete(); 
        $basketItem->save(); 
        $count_item--;
        }

        $naiden = true;
        $basketItem->setField('QUANTITY', $qnt);
        $res['ELEMENTS'][$id_prod]['QNT'] = $qnt;
    }else{
        $res['ELEMENTS'][$id_prod]['QNT'] = $basketItem->getQuantity(); 
    }
    
      

    
    $basketPropertyCollection = $basketItem->getPropertyCollection(); 
    foreach ($basketPropertyCollection as $propertyItem) {
        $code = $propertyItem->getField('CODE');
        $res['ELEMENTS'][$id_prod]['PROPS'][] = array(
            'CODE'=>$code,
            'VALUE'=>$propertyItem->getField('VALUE'),
             'NAME'=>$propertyItem->getField('NAME')
        );
    }
   

}

if(!$naiden){
    //Если в корзине заказа не было такого товар
    $item = $basket->createItem('catalog', $id);
    $item->setFields(array(
        'QUANTITY' => $qnt,
        'CURRENCY' => Bitrix\Currency\CurrencyManager::getBaseCurrency(),
        'LID' => Bitrix\Main\Context::getCurrent()->getSite(),
        'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
    ));
    $count_item++;
    $basket->save();
    $res['ELEMENTS'][$id]['QNT'] = $qnt;
     $res['ELEMENTS'][$id_prod]['PROPS'][] = array(
            'CODE'=>$_POST['props'][0]['CODE'],
            'VALUE'=>$_POST['props'][0]['VALUE'],
             'NAME'=>$_POST['props'][0]['NAME']
        );
}
$price = $basket->getPrice();
$weight = $basket->getWeight()/1000; 
$basket->save();

$res['TOTAL_PRICE'] = round($price, 2);
$res['TOTAL_COUNT'] = $count_item;
$res['TOTAL_WEIGHT'] = $weight;


  echo \Bitrix\Main\Web\Json::encode($res);
    return;


?>