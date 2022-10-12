<?php
//echo 'success';die;// ВРЕМЕННО!!!


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Context,
    Bitrix\Currency\CurrencyManager,
    Bitrix\Sale\Order,
    Bitrix\Sale\Basket,
    Bitrix\Sale\Delivery,
    Bitrix\Sale\PaySystem,
    Bitrix\Sale\Location\LocationTable;


$USER_ID = intval($_GET['account_id']);
$INN = intval($_GET['inn']);
global $USER;

function log_some_info($info)
{
    ob_start();


    echo PHP_EOL . '---------' . date('d.m.Y H:i:s') . '-------' . PHP_EOL;
    pre($info);
    echo PHP_EOL . '----------------' . PHP_EOL;
    $res = ob_get_clean();

    file_put_contents(__DIR__ . '/order_log.txt', $res, FILE_APPEND);
}

ob_start();

echo PHP_EOL . '---------' . date('d.m.Y H:i:s') . '-------' . PHP_EOL;
pre($_SERVER['REQUEST_URI']);
pre($_GET);
echo PHP_EOL . '----------------' . PHP_EOL;
$res = ob_get_clean();

file_put_contents(__DIR__ . '/order_log.txt', $res, FILE_APPEND);

$GET = Bitrix\Main\Context::getCurrent()->getRequest()->getQueryList();

function Escape_win ($path) {
    $path = strtoupper ($path);
    return strtr($path, array("\U0430"=>"а", "\U0431"=>"б", "\U0432"=>"в",
        "\U0433"=>"г", "\U0434"=>"д", "\U0435"=>"е", "\U0451"=>"ё", "\U0436"=>"ж", "\U0437"=>"з", "\U0438"=>"и",
        "\U0439"=>"й", "\U043A"=>"к", "\U043B"=>"л", "\U043C"=>"м", "\U043D"=>"н", "\U043E"=>"о", "\U043F"=>"п",
        "\U0440"=>"р", "\U0441"=>"с", "\U0442"=>"т", "\U0443"=>"у", "\U0444"=>"ф", "\U0445"=>"х", "\U0446"=>"ц",
        "\U0447"=>"ч", "\U0448"=>"ш", "\U0449"=>"щ", "\U044A"=>"ъ", "\U044B"=>"ы", "\U044C"=>"ь", "\U044D"=>"э",
        "\U044E"=>"ю", "\U044F"=>"я", "\U0410"=>"А", "\U0411"=>"Б", "\U0412"=>"В", "\U0413"=>"Г", "\U0414"=>"Д",
        "\U0415"=>"Е", "\U0401"=>"Ё", "\U0416"=>"Ж", "\U0417"=>"З", "\U0418"=>"И", "\U0419"=>"Й", "\U041A"=>"К",
        "\U041B"=>"Л", "\U041C"=>"М", "\U041D"=>"Н", "\U041E"=>"О", "\U041F"=>"П", "\U0420"=>"Р", "\U0421"=>"С",
        "\U0422"=>"Т", "\U0423"=>"У", "\U0424"=>"Ф", "\U0425"=>"Х", "\U0426"=>"Ц", "\U0427"=>"Ч", "\U0428"=>"Ш",
        "\U0429"=>"Щ", "\U042A"=>"Ъ", "\U042B"=>"Ы", "\U042C"=>"Ь", "\U042D"=>"Э", "\U042E"=>"Ю", "\U042F"=>"Я"));
}

$action = $GET['action'];
if ($USER->IsAuthorized()) {
    if ($action == 'setOrderInfo' && !empty($GET['data'])) {

        $orders = json_decode(urldecode($GET['data']), 1);//[['code' => 'A48RGвывывы', 'data' => ['1C_ORGANIZATION' => '00027', '1C_MANAGER_CODE' => 'АникеевН']], ['code' => '7SF02', 'data' => ['1C_ORGANIZATION' => '00028', '1C_MANAGER_CODE' => 'АлексейАлексеевич']]];



        $arErrors = [];

        if (!empty($orders)) {
            foreach ($orders as $rk_order) {
                // https://ct53611.tmweb.ru/api/order.php?action=setOrderInfo&data=[{%22code%22:%20%22N7Y30%22,%20%22data%22:%20{%22DELIVERY_PRICE%22:700,%22ORGANIZATION%22:%20%2200027\u0020\u0020\u0020\u0020%22,%20%22MANAGER_CODE%22:%20%22%22,%20%22BILL_NUMBER%22:%20%22\u042d\u042d000000029%22,%20%22UPOLNOMOCHENNUY%22:%20%2200286%22,%20%22DOVERENNOST%22:%20%22\u0434\u043e\u0432.\u0020\u042d\u041e/19-27\u0020\u043e\u0442\u002027.12.2019%22}}]

                if (!empty($rk_order['code'])) {

                    $order = Order::loadByAccountNumber($rk_order['code']);

                    if ($order) {

                        $collection = $order->getPropertyCollection();

                        foreach ($collection as $item) {

                            foreach ($rk_order['data'] as $field_code => $value) {
//pre($value);
                                if ($item->getField('CODE') == $field_code) {

                                    $newVal = str_replace('/', '\\', trim($value));
                                    $newVal = Escape_win(urldecode(str_replace('\u0020','%20',$newVal)));
                                    $item->setField('VALUE', $newVal);
                                    break;
                                }
                            }

                        }
                        if (isset($rk_order['data']['DELIVERY_PRICE'])) {
                            $shipmentCollection = $order->getShipmentCollection();

                            $dbRes = \Bitrix\Sale\ShipmentCollection::getList([
                                'select' => ['*'],
                                'filter' => [
                                    '=ORDER_ID' => $order->getId(),
                                ]
                            ]);

//                            while ($item = $dbRes->fetch())
//                            {
//                                log_some_info($item);
//                            }
                            $shipmentReal = false;
                            foreach ($shipmentCollection as $shipment) {

//                                if (!$deliveryId)
//                                    $deliveryId = $shipment->getField('DELIVERY_ID');

                                if(!$shipment->isSystem()) {
                                    log_some_info('Doing fieldset for '.$shipment->getField('ID'));
                                    $r = $shipment->setField('CUSTOM_PRICE_DELIVERY', "Y");
                                    if (!$r->isSuccess())
                                    {
                                        log_some_info('ОШИБКА ОБНОВЛЕНИЯ ПОЛЯ "CUSTOM_PRICE_DELIVERY" '.$r->getErrorMessages());
                                    }
                                    $r = $shipment->setField('PRICE_DELIVERY', $rk_order['data']['DELIVERY_PRICE']);
                                    if (!$r->isSuccess())
                                    {
                                        log_some_info('ОШИБКА ОБНОВЛЕНИЯ ПОЛЯ "PRICE_DELIVERY" '.$r->getErrorMessages());
                                    }
//                                    $shipmentReal = $shipment;
                                }
                            }
                            // Попробуем чекнем туда доставку еще разок!
//                            if($shipmentReal) {
//                                $shipmentReal->setField('CUSTOM_PRICE_DELIVERY', "Y");
//                                $shipmentReal->setField('PRICE_DELIVERY', $rk_order['data']['DELIVERY_PRICE']);
//                            }
                        }
        
// Пересчитываем заказ, чтоб суммы стали адекватными снова
                        $discount = $order->getDiscount();
                        \Bitrix\Sale\DiscountCouponsManager::clearApply(true);
                        \Bitrix\Sale\DiscountCouponsManager::useSavedCouponsForApply(true);
                        $discount->setOrderRefresh(true);
                        $discount->setApplyResult(array());

                        if (!($basket = $order->getBasket())) {
                            throw new \Bitrix\Main\ObjectNotFoundException('Entity "Basket" not found');
                        }

                        $basket->refreshData(array('PRICE', 'COUPONS'));
                        $discount->calculate();
                        //----------------------------------------------------------
                        
                        //$order->setField('UPDATED_1C', 'Y');

                        $order->save();

                        $arFields = array(
                            "UPDATED_1C" => "Y"
                        );
                        CSaleOrder::Update($order->getId(), $arFields);

                        unset($order);
                    } else
                        $arErrors[] = 'Заказ ' . $rk_order['code'] . ': неверный код заказа';
                } else {

                    $arErrors[] = 'Не указан код заказа';

                }

            }
        } else {
            $json_last_err = json_last_error_msg();
            if (!empty($json_last_err)) {
                $arErrors[] = 'Ошибка при обработке строки заказов : ' . $json_last_err;

            }
        }
        if (count($arErrors) > 0)
            echo implode('<br>', $arErrors);
        else
            echo 'success';
    }
}

