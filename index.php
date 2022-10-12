<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Компания \"Эгида-Отель\" - бытовая химия со склада в Москве");
$APPLICATION->SetPageProperty("title", "Компания \"Эгида-Отель\" - бытовая химия со склада в Москве");
$APPLICATION->SetTitle("ЭГИДА-ОТЕЛЬ - оптовый поставщик бытовой химии, товаров для гостиниц и клининга");

$APPLICATION->IncludeComponent('sotbit:block.include', '', ['PART' => 'main_'
  . SITE_ID], null, ['HIDE_ICONS' => 'Y']); ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>

