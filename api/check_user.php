<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$USER_ID = intval($_GET['USER_ID']);
$userProfileId = intval($_GET['BUYER_ID']);
$user_check = $_GET['SET_USER_CHECK'] == 'Y' ? 'Y' : 'N';


if ($USER->IsAuthorized()) {
    $arGroups = CUser::GetUserGroup($USER->GetId());
    if (in_array(12, $arGroups) || $USER->IsAdmin()) {
        if (!empty($_GET['SET_USER_CHECK'])) {
            if (!empty($USER_ID)) {
                $arUser = CUser::GetList(($by = "ID"), ($order = "desc"), array("ID" => $USER_ID), array("SELECT" => array("UF_*")))->fetch();

                if ($arUser) {
                    $user = new CUser;
                    $fields = Array(
                        "UF_RELIABLE" => "Y",
                    );
                    $user->Update($USER_ID, $fields);
                    echo 'Success';
                }else
                    echo "User doesn't exist";

            } elseif (!empty($userProfileId)) {
                $element = CIblockElement::GetList([], ['IBLOCK_ID' => IBLOCK_PROFILE, 'ID' => $userProfileId], false, false, ['IBLOCK_ID', 'ID', 'NAME', 'PROPERTY_RELIABLE'])->GetNext();
                if (empty($element['PROPERTY_RELIABLE_VALUE'])) {
                    CIBlockElement::SetPropertyValueCode(
                        $element['ID'],
                        'RELIABLE',
                        $user_check
                    );
                    echo 'Success';
                } else {
                    echo 'Error';
                }
            }else{
                echo 'Empty parameters!';
            }
        }
    }
}else{
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