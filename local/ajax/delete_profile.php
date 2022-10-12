<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");


CModule::IncludeModule('sale');


   if(CSaleOrderUserProps::Delete($_POST['ID'])){
    echo 'Y';
   }



?>