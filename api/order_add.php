<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Context,
    Bitrix\Currency\CurrencyManager,
    Bitrix\Sale\Order,
    Bitrix\Sale\Basket,
    Bitrix\Sale\Delivery,
    Bitrix\Sale\PaySystem,
    Bitrix\Sale\Location\LocationTable;;

$USER_ID = intval($_GET['account_id']);
$INN = intval($_GET['inn']);

// $_GET['order_id']


if (!empty($USER_ID) && !empty($INN)) {

    global $USER;
    $profile_id = false;

    $arUser = CUser::GetList(($by = "id"), ($order = "desc"), ($filter = ['ID' => $USER_ID]), $userParams = ['SELECT' => ['*', 'UF_*']])->fetch();
    if ($arUser) {
        //$USER->Authorize($USER_ID);
        $db_sales = CSaleOrderUserProps::GetList( array("DATE_UPDATE" => "DESC"), array("USER_ID" =>$USER_ID) );
        while($profile = $db_sales->Fetch()){
            $db_propVals = CSaleOrderUserPropsValue::GetList(array("ID" => "ASC"), Array("USER_PROPS_ID"=>$profile['ID'],"PROP_CODE"=>"INN"));
            if ($arPropVals = $db_propVals->Fetch())
            {
                if($arPropVals['VALUE']==$INN){
                    $profile_id = $profile['ID'];
                    break;
                }
            }
        }

        $props_values = [];
        if($profile_id){
            $db_propVals = CSaleOrderUserPropsValue::GetList(array("ID" => "ASC"), Array("USER_PROPS_ID"=>$profile_id));
            while ($arPropVals = $db_propVals->Fetch())
                $props_values[$arPropVals['PROP_CODE']] = $arPropVals['VALUE'];
        }else{
            $props_values['CONTACT_PERSON'] = $arUser['NAME'];
            $props_values['EMAIL'] = $arUser['EMAIL'];
            $props_values['INN'] = $INN;
        }


        $psa_action_file = "";

        $response = array();

        Bitrix\Main\Loader::includeModule("sale");
        Bitrix\Main\Loader::includeModule("catalog");

        //if ($USER->isAuthorized()) {
            // Допустим некоторые поля приходит в запросе
            $request = Context::getCurrent()->getRequest();

            $siteId = Context::getCurrent()->getSite();
            $currencyCode = CurrencyManager::getBaseCurrency();

// Создаёт новый заказ
            $order = Order::create($siteId, $USER_ID);
            $order->setPersonTypeId(2);
            $order->setField('CURRENCY', $currencyCode);
            $order->setField("STATUS_ID", "CR");

// Создаём корзину с одним товаром
            $basket = Basket::create($siteId);
            $order->setBasket($basket);

// Создаём одну отгрузку и устанавливаем способ доставки - "Без доставки" (он служебный)
            $shipmentCollection = $order->getShipmentCollection();
            $shipment = $shipmentCollection->createItem();
            $service = Delivery\Services\Manager::getById(Delivery\Services\EmptyDeliveryService::getEmptyDeliveryServiceId());
            $shipment->setFields(array(
                'DELIVERY_ID' => $service['ID'],
                'DELIVERY_NAME' => $service['NAME'],
            ));
            $shipmentItemCollection = $shipment->getShipmentItemCollection();
//            $shipmentItem = $shipmentItemCollection->createItem($item);
//            $shipmentItem->setQuantity($item->getQuantity());

// Создаём оплату со способом #1
            $paymentCollection = $order->getPaymentCollection();
            $payment = $paymentCollection->createItem();
            $paySystemService = PaySystem\Manager::getObjectById(6);
            $payment->setFields(array(
                'PAY_SYSTEM_ID' => $paySystemService->getField("PAY_SYSTEM_ID"),
                'PAY_SYSTEM_NAME' => $paySystemService->getField("NAME"),
            ));

// Устанавливаем свойства
            $propertyCollection = $order->getPropertyCollection();

            /* @var Sale\PropertyValue $property */
            foreach ($propertyCollection as $property) {
                $arProp = $property->getProperty();
                if ($props_values[$arProp['CODE']]) {
                    if($arProp['IS_LOCATION']=='Y'){
                        if($item = \Bitrix\Sale\Location\LocationTable::getById($props_values[$arProp['CODE']])->fetch())
                            $property->setValue($item['CODE']);

                    }else
                        $property->setValue($props_values[$arProp['CODE']]);
                }
            }

            $order->doFinalAction(true);
            $result = $order->save();
            $orderId = $order->getId();

            if ($orderId) {
                die($order->getField('ACCOUNT_NUMBER'));
            }
        //}
    }
}
die;

if ($USER->IsAuthorized()) {
    $arGroups = CUser::GetUserGroup($USER->GetId());
    echo 'Success';
//    if (in_array(12, $arGroups) || $USER->IsAdmin()) {
//        if (!empty($_GET['SET_USER_CHECK'])) {
//            if (!empty($USER_ID)) {
//                $arUser = CUser::GetList(($by = "ID"), ($order = "desc"), array("ID" => $USER_ID), array("SELECT" => array("UF_*")))->fetch();
//
//                if ($arUser) {
//                    $user = new CUser;
//                    $fields = Array(
//                        "UF_RELIABLE" => "Y",
//                    );
//                    $user->Update($USER_ID, $fields);
//                    echo 'Success';
//                }else
//                    echo "User doesn't exist";
//
//            } elseif (!empty($userProfileId)) {
//                $element = CIblockElement::GetList([], ['IBLOCK_ID' => IBLOCK_PROFILE, 'ID' => $userProfileId], false, false, ['IBLOCK_ID', 'ID', 'NAME', 'PROPERTY_RELIABLE'])->GetNext();
//                if (empty($element['PROPERTY_RELIABLE_VALUE'])) {
//                    CIBlockElement::SetPropertyValueCode(
//                        $element['ID'],
//                        'RELIABLE',
//                        $user_check
//                    );
//                    echo 'Success';
//                } else {
//                    echo 'Error';
//                }
//            }else{
//                echo 'Empty parameters!';
//            }
//        }
//    }
} else {
    echo 'User is not authorized!';
}/* else {
    ?>
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:system.auth.form",
        "",
        Array()
    );
    ?>
<? }*/ ?>