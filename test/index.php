<?

use Bitrix\Sale;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("test");




$path = '/upload/1c_exchange/';
$filepath = $_SERVER['DOCUMENT_ROOT'].$path.$_GET['filename'];




$newArProducts = array();
$orders = new SimpleXMLElement(file_get_contents($filepath));

foreach ($orders->Документ as $keyOrder => $order1C){

	$order1CAr = xml2array($order1C);
	$accNumber = $order1CAr['Номер'];

	foreach ($order1C->Товары->Товар as $keyProd => $product){

		$prodAr = xml2array($product);
		$xmlCodeProd = $prodAr['Ид'];
        $quantity = (int)$newArProducts[$xmlCodeProd]['Количество'];
		$newArProducts[$accNumber][$xmlCodeProd]['Количество'] = $quantity+$prodAr['Количество'];

	}


}

CModule::IncludeModule("sale");
foreach ($newArProducts as $keyOrderAccNumber => $order){
	$arFilter = Array(
		"ACCOUNT_NUMBER" => $keyOrderAccNumber,
	);
	$rsSales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
	if ($orderBitrix = $rsSales->Fetch())
	{
		$basket = Sale\Order::load($orderBitrix['ID'])->getBasket();
		$basketItems = $basket->getBasketItems();
		foreach ($basketItems as $basketItem)
		{
			$xmlProduct = $basketItem->getField('PRODUCT_XML_ID');
			$newQuant = $newArProducts[$keyOrderAccNumber][$xmlProduct]['Количество'];
            $basketItem->setField('QUANTITY', $newQuant);
		}
	}
}







