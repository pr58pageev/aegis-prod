<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Компания \"Эгида-Отель\" : адрес, телефон, время работы, схема проезда");
use Sotbit\Origami\Helper\Config;
$APPLICATION->SetTitle("Контакты");
?>


<?
include $_SERVER['DOCUMENT_ROOT'].'/'.\SotbitOrigami::contactsDir.'/'
    .Config::get('CONTACTS').'/content.php';
?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>