<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Sale;
global $USER;
$order = Sale\Order::load($_GET['ID_ORDER']);

$arChangePropCode = array(
'TIME_DELIV',

);



if($order->getUserId() == $USER->GetId() && $order->getField('STATUS_ID') == 'CH'):


	if($_POST['SAVE']=='Y'):

	$arField = $_POST;
	unset($arField['SAVE']);
	foreach ($arField as $key => $value) {
		
		$order->setField($key, $value);

	}
	$order->save();
	endif;//SAVE


	$arResult['ORDER']['ID'] = $order->getId(); 
	$arResult['ORDER']['DESCRIPTION'] = $order->getField('USER_DESCRIPTION'); 
	$propertyCollection = $order->getPropertyCollection();
	$ar = $propertyCollection->getArray();
	
	foreach ($ar['properties'] as $key => $value) {
		$arResult['ORDER']['PROPERTIES'][$value['CODE']] = $value['VALUE'][0];
	}


else:

	die('Ошибка! Обратитесь к администратору');

endif;



$this->IncludeComponentTemplate();


