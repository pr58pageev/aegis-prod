<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
include_once $_SERVER["DOCUMENT_ROOT"] . '/bitrix/php_interface/include/dompdf/autoload.inc.php';

use Dompdf\Dompdf;




$orderId = intval($_GET['ORDER_ID']);


if ($USER->IsAuthorized() && !empty($orderId)) {

    // Получаем все поля!
    $payment = $event->getParameter("ENTITY");

    $order = \Bitrix\Sale\Order::load($orderId);

        if ($payment->getField('PAY_SYSTEM_ID') == 6) { // ID оплаты картой
            if ($oldValues["PAID"] == 'N' && $payment->getField('PAID') == 'Y') { // оплачено
                $order->getId();
                global $USER;
                $order_user_id = $order->getUserId();
                $propertyCollection = $order->getPropertyCollection();
                $prolongationProp = $propertyCollection->getItemByOrderPropertyId(1);
                if ($prolongationProp->getValue() != "Y") {
                    $basket = $order->getBasket();
                    $basketItems = $basket->getBasketItems();
                    $item = $basketItems[0];
                    $iblockItem = CIBlockElement::GetByID($item->getProductId())->GetNextElement();
                    if ($iblockItem->GetFields()['IBLOCK_ID'] == 12) {
                        $unisender_settings = Mediagroup::getUnisenderSettings("s1");
                        $UnisenderApi = new \Unisender\ApiWrapper\UnisenderApi($unisender_settings['API_KEY'], 'UTF-8', 4, null, false, $unisender_settings['PLATFORM']);
                        $rsUser = CUser::GetByID($order_user_id);
                        $arUser = $rsUser->Fetch();
                        $fields['NAME'] = $arUser['NAME'];
                        $fields['email'] = $arUser['EMAIL'];
                        $UnisenderApi->subscribe(array('list_ids' => $unisender_settings['LIST_IDS'], 'double_optin' => $unisender_settings['DOUBLE_OPTIN'], 'overwrite' => $unisender_settings['OVERWRITE'], 'tags' => $unisender_settings['TAGS'], 'fields' => $fields));

                        $month = $iblockItem->GetProperties()["ACTIVE_PERIOD"]["VALUE"];
                        $targetGroup = 6;
                        $res = \Bitrix\Main\UserGroupTable::getList(array('filter' => array('USER_ID' => $order_user_id, 'GROUP_ID' => $targetGroup)));
                        if ($row = $res->fetch()) {
                            if ($row['DATE_ACTIVE_TO'] == '') {
                                $row['DATE_ACTIVE_TO'] = new \Bitrix\Main\Type\DateTime;
                            }
                            \Bitrix\Main\UserGroupTable::update(array('GROUP_ID' => $targetGroup, 'USER_ID' => $order_user_id),
                                array('DATE_ACTIVE_TO' => $row['DATE_ACTIVE_TO']->add('+' . $month . ' month')));
                        } else {
                            $date = new \Bitrix\Main\Type\DateTime;
                            \Bitrix\Main\UserGroupTable::add(array(
                                'USER_ID' => $order_user_id,
                                'GROUP_ID' => $targetGroup,
                                'DATE_ACTIVE_TO' => $date->add('+' . $month . ' month')
                            ));
                        }

                        $basketPropertyCollection = $item->getPropertyCollection();
                        $basketPropertyCollection->getPropertyValues();
                        $prolongationProp->setValue("Y");
                        $order->save();
                        $res = CUser::GetUserGroupList($order_user_id);
                        while ($arGroup = $res->Fetch()) {
                            if ($arGroup['GROUP_ID'] == 6) {
                                $string_date = $arGroup['DATE_ACTIVE_TO'];
                            }
                        }
                        $string_only_date = explode(" ", $string_date)[0];
                        $current_user = CUser::GetByID($order_user_id);
                        $arUser = $current_user->Fetch();
                        $string_name = $arUser['NAME'];

                        // Тут будем печатать пдфник!

                        include_once($_SERVER["DOCUMENT_ROOT"] . '/local/php_interface/include/tcpdf/generate.php');
                        $arFile = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"] . $name_file);


                    }
                }
            }
        }

    $html = '
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <style type="text/css">
        * {
            font-family: arial;
            font-size: 14px;
            line-height: 14px;
        }
        table {
            margin: 0 0 15px 0;
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }
        table td {
            padding: 5px;
        }
        table th {
            padding: 5px;
            font-weight: bold;
        }

        .header {
            margin: 0 0 0 0;
            padding: 0 0 15px 0;
            font-size: 12px;
            line-height: 12px;
            text-align: center;
        }

        /* Реквизиты банка */
        .details td {
            padding: 3px 2px;
            border: 1px solid #000000;
            font-size: 12px;
            line-height: 12px;
            vertical-align: top;
        }

        h1 {
            margin: 0 0 10px 0;
            padding: 10px 0 10px 0;
            border-bottom: 2px solid #000;
            font-weight: bold;
            font-size: 20px;
        }

        /* Поставщик/Покупатель */
        .contract th {
            padding: 3px 0;
            vertical-align: top;
            text-align: left;
            font-size: 13px;
            line-height: 15px;
        }
        .contract td {
            padding: 3px 0;
        }

        /* Наименование товара, работ, услуг */
        .list thead, .list tbody  {
            border: 2px solid #000;
        }
        .list thead th {
            padding: 4px 0;
            border: 1px solid #000;
            vertical-align: middle;
            text-align: center;
        }
        .list tbody td {
            padding: 0 2px;
            border: 1px solid #000;
            vertical-align: middle;
            font-size: 11px;
            line-height: 13px;
        }
        .list tfoot th {
            padding: 3px 2px;
            border: none;
            text-align: right;
        }

        /* Сумма */
        .total {
            margin: 0 0 20px 0;
            padding: 0 0 10px 0;
            border-bottom: 2px solid #000;
        }
        .total p {
            margin: 0;
            padding: 0;
        }

        /* Руководитель, бухгалтер */
        .sign {
            position: relative;
        }
        .sign table {
            width: 60%;
        }
        .sign th {
            padding: 40px 0 0 0;
            text-align: left;
        }
        .sign td {
            padding: 40px 0 0 0;
            border-bottom: 1px solid #000;
            text-align: right;
            font-size: 12px;
        }

        .sign-1 {
            position: absolute;
            left: 149px;
            top: -44px;
        }
        .sign-2 {
            position: absolute;
            left: 149px;
            top: 0;
        }
        .printing {
            position: absolute;
            left: 271px;
            top: -15px;
        }
    </style>
</head>
<body>
<p class="header">
    Внимание! Оплата данного счета означает согласие с условиями поставки товара.
    Уведомление об оплате обязательно, в противном случае не гарантируется наличие
    товара на складе. Товар отпускается по факту прихода денег на р/с Поставщика,
    самовывозом, при наличии доверенности и паспорта.
</p>

<table class="details">
    <tbody>
    <tr>
        <td colspan="2" style="border-bottom: none;">ЗАО "БАНК", г.Москва</td>
        <td>БИК</td>
        <td style="border-bottom: none;">000000000</td>
    </tr>
    <tr>
        <td colspan="2" style="border-top: none; font-size: 10px;">Банк получателя</td>
        <td>Сч. №</td>
        <td style="border-top: none;">00000000000000000000</td>
    </tr>
    <tr>
        <td width="25%">ИНН 0000000000</td>
        <td width="30%">КПП 000000000</td>
        <td width="10%" rowspan="3">Сч. №</td>
        <td width="35%" rowspan="3">00000000000000000000</td>
    </tr>
    <tr>
        <td colspan="2" style="border-bottom: none;">ООО "Компания"</td>
    </tr>
    <tr>
        <td colspan="2" style="border-top: none; font-size: 10px;">Получатель</td>
    </tr>
    </tbody>
</table>

<h1>Счет на оплату № 10 от 01 февраля 2018 г.</h1>

<table class="contract">
    <tbody>
    <tr>
        <td width="15%">Поставщик:</td>
        <th width="85%">
            ООО "Компания", ИНН 0000000000, КПП 000000000, 125009, Москва г,
            Тверская ул, дом № 9
        </th>
    </tr>
    <tr>
        <td>Покупатель:</td>
        <th>
            ООО "Покупатель", ИНН 0000000000, КПП 000000000, 119019, Москва г,
            Новый Арбат ул, дом № 10
        </th>
    </tr>
    </tbody>
</table>

<table class="list">
    <thead>
    <tr>
        <th width="5%">№</th>
        <th width="54%">Наименование товара, работ, услуг</th>
        <th width="8%">Коли-<br>чество</th>
        <th width="5%">Ед.<br>изм.</th>
        <th width="14%">Цена</th>
        <th width="14%">Сумма</th>
    </tr>
    </thead>
    <tbody>';

    $total = $nds = 0;
    foreach ($prods as $i => $row) {
        $total += $row['price'] * $row['count'];
        $nds += ($row['price'] * $row['nds'] / 100) * $row['count'];

        $html .= '
    <tr>
        <td align="center">' . (++$i) . '</td>
        <td align="left">' . $row['name'] . '</td>
        <td align="right">' . $row['count'] . '</td>
        <td align="left">' . $row['unit'] . '</td>
        <td align="right">' . format_price($row['price']) . '</td>
        <td align="right">' . format_price($row['price'] * $row['count']) . '</td>
    </tr>';
    }

    $html .= '
    </tbody>
    <tfoot>
    <tr>
        <th colspan="5">Итого:</th>
        <th>' . format_price($total) . '</th>
    </tr>
    <tr>
        <th colspan="5">В том числе НДС:</th>
        <th>' . ((empty($nds)) ? '-' : format_price($nds)) . '</th>
    </tr>
    <tr>
        <th colspan="5">Всего к оплате:</th>
        <th>' . format_price($total) . '</th>
    </tr>

    </tfoot>
</table>

<div class="total">
    <p>Всего наименований ' . count($prods) . ', на сумму ' . format_price($total) . ' руб.</p>
    <p><strong>' . str_price($total) . '</strong></p>
</div>

<div class="sign">
    <img class="sign-1" src="' . __DIR__ . '/demo/sign-1.png">
    <img class="sign-2" src="' . __DIR__ . '/demo/sign-2.png">
    <img class="printing" src="' . __DIR__ . '/demo/printing.png">

    <table>
        <tbody>
        <tr>
            <th width="30%">Руководитель</th>
            <td width="70%">Иванов А.А.</td>
        </tr>
        <tr>
            <th>Бухгалтер</th>
            <td>Сидоров Б.Б.</td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>';

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html, 'UTF-8');
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

// Вывод файла в браузер:
    $dompdf->stream('schet-10');

// Или сохранение на сервере:
//    $pdf = $dompdf->output();
//    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/schet-10.pdf', $pdf);
}