<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мой профиль");
?>
<?$APPLICATION->IncludeComponent(
    "bitrix:main.profile",
    ".default",
    Array(
        "CHECK_RIGHTS" => "N",	// Проверять права доступа
        "COMPOSITE_FRAME_MODE" => "A",	// Голосование шаблона компонента по умолчанию
        "COMPOSITE_FRAME_TYPE" => "AUTO",	// Содержимое компонента
        "SEND_INFO" => "N",	// Генерировать почтовое событие
        "SET_TITLE" => "Y",	// Устанавливать заголовок страницы
        "USER_PROPERTY" => "",	// Показывать доп. свойства
        "USER_PROPERTY_NAME" => "",	// Название закладки с доп. свойствами
    ),
    false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>