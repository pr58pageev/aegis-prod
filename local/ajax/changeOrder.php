<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Sale;
$POST = Bitrix\Main\Context::getCurrent()->getRequest()->getPostList();

if($POST['ACTION']=='CHANGE_STATUS'){
	$order = Sale\Order::load($POST['ORDER_ID']);
	$user_order = $order->getUserId();
	//Проверим, что заказ меняет тот, кто его создавал
	if($user_order==$USER->GetId()){

		$order->setField("STATUS_ID", 'N');
		$order->save();
		global $APPLICATION;
		$APPLICATION->RestartBuffer();
		die('Y');


	}else{
		echo 'Вы пытаетесь поменять статус чужого заказа!';
	}
}

?>