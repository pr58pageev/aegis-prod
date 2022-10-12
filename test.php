<!-- <?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");


use Bitrix\Sale;

$basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
$basketItems = $basket->getBasketItems();


foreach ($basket as $item) {
   

   $basketPropertyCollection = $item->getPropertyCollection(); 
$basketPropertyCollection->getPropertyValues();

foreach ($basketPropertyCollection as $propertyItem) {
 
	$arpOrp[$item->getField('NAME')][] = array(
		'CODE'=>$propertyItem->getField('CODE'),
		'VALUE'=>$propertyItem->getField('VALUE')
	);
 
}


}


pre($arpOrp);






/*global $USER;
$USER->Authorize(1);*/
                ?> -->