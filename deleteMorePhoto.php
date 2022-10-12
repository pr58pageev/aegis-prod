<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

define('NEED_AUTH', true);
global $USER;
define('IBLOCK_ID', 15);
if(!$USER->IsAdmin()) exit('Вы не админ');



$arSelect = Array("ID", "IBLOCK_ID");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
$arFilter = Array("IBLOCK_ID"=>IBLOCK_ID, "!PROPERTY_MORE_PHOTO"=>false);
$res = CIBlockElement::GetList(Array(), $arFilter, false,  Array("nPageSize"=>250), $arSelect);
$haveElements = false;
while($arFields = $res->fetch()){
    $haveElements = true;

    $arFile["MODULE_ID"] = "iblock";
    $arFile["del"] = "Y";



       $bx_photo = CIBlockElement::GetProperty(
           IBLOCK_ID,
           $arFields['ID'],
           'sort',
           'asc',
           array('CODE' => 'MORE_PHOTO')
       );
       $ar_photo = $bx_photo->Fetch();
       CIBlockElement::SetPropertyValueCode($arFields['ID'], 'MORE_PHOTO', array(
           $ar_photo['PROPERTY_VALUE_ID'] => array('del' => 'Y', 'tmp_name' => '')
       ));
       CFile::Delete($ar_photo['VALUE']);

    pre('Удалена картинка у файла:'.$arFields['ID']);





}
if($haveElements):



    ?>
    <script>
        setTimeout(function () {
            window.location.reload(1);
        }, 2000);

    </script>


<? endif;

