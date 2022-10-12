<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Sale;
$POST = Bitrix\Main\Context::getCurrent()->getRequest()->getPostList();



$el = new CIBlockElement;


$arLoadProductArray = Array(
 "IBLOCK_ID"      => 32,
    "NAME"           => $POST['VOTE'],
   );

if(empty($_SESSION['VOTES'])){
    $el->Add($arLoadProductArray);
    
}
$_SESSION['VOTES'] = 'Y';