<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Добавить раздел");
use Sotbit\Origami\Helper\Config;
?>
<?
if($_POST['name']){
    $arParams = array("replace_space"=>"-","replace_other"=>"-");
    $bs = new CIBlockSection;
    $arFields = Array(
        "ACTIVE" => "N",
        "IBLOCK_ID" => Config::get("IBLOCK_ID_BLOG"),	// Инфоблок
        "NAME" => $_POST['name'],
        "SORT" => "500",
        "CODE" => Cutil::translit($_POST['name'],"ru",$arParams)
    );

    $ID = $bs->Add($arFields);
    $res = ($ID>0);

    if(!$res)
        $error_msg =  $bs->LAST_ERROR;
}
?>
<?if($error_msg):?>
<?echo($error_msg)?>
<?endif;?>
<form action="" method="post">
    <input name="name" type="text" value="" required>
    <input type="submit" value="Создать раздел">
</form>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>