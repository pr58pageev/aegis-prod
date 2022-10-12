<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */
$this->setFrameMode(false);

if(!CModule::IncludeModule("iblock"))
{
	ShowError(GetMessage("CC_BIEAF_IBLOCK_MODULE_NOT_INSTALLED"));
	return;
}

$arElement = false;

if($arParams["IBLOCK_ID"] > 0)
{
	$arIBlock = CIBlock::GetArrayByID($arParams["IBLOCK_ID"]);
	$bWorkflowIncluded = ($arIBlock["WORKFLOW"] == "Y") && CModule::IncludeModule("workflow");
	$bBizproc = ($arIBlock["BIZPROC"] == "Y") && CModule::IncludeModule("bizproc");
}
else
{
	$arIBlock = false;
	$bWorkflowIncluded = CModule::IncludeModule("workflow");
	$bBizproc = false;
}

$arParams["ID"] = intval($_REQUEST["CODE"]);
$arParams["MAX_FILE_SIZE"] = 0;
$arParams["PREVIEW_TEXT_USE_HTML_EDITOR"] = $arParams["PREVIEW_TEXT_USE_HTML_EDITOR"] === "Y" && CModule::IncludeModule("fileman");
$arParams["DETAIL_TEXT_USE_HTML_EDITOR"] = $arParams["DETAIL_TEXT_USE_HTML_EDITOR"] === "Y" && CModule::IncludeModule("fileman");
$arParams["RESIZE_IMAGES"] = "N";

$arParams["USER_MESSAGE_ADD"] = trim($arParams["USER_MESSAGE_ADD"]);
if(strlen($arParams["USER_MESSAGE_ADD"]) <= 0)
	$arParams["USER_MESSAGE_ADD"] = GetMessage("IBLOCK_USER_MESSAGE_ADD_DEFAULT");

$arParams["USER_MESSAGE_EDIT"] = trim($arParams["USER_MESSAGE_EDIT"]);
if(strlen($arParams["USER_MESSAGE_EDIT"]) <= 0)
	$arParams["USER_MESSAGE_EDIT"] = GetMessage("IBLOCK_USER_MESSAGE_EDIT_DEFAULT");

if (!$bWorkflowIncluded)
{
	if ($arParams["STATUS_NEW"] != "N" && $arParams["STATUS_NEW"] != "NEW") $arParams["STATUS_NEW"] = "ANY";
}

if(!is_array($arParams["GROUPS"]))
	$arParams["GROUPS"] = array();

$arGroups = $USER->GetUserGroupArray();

// check whether current user can have access to add/edit elements
if ($arParams["ID"] == 0)
{
	$bAllowAccess = count(array_intersect($arGroups, $arParams["GROUPS"])) > 0 || $USER->IsAdmin();
}
else
{
	// rights for editing current element will be in element get filter
	$bAllowAccess = $USER->GetID() > 0;
}

$arResult["ERRORS"] = array();

if ($bAllowAccess)
{
	// get iblock sections list
	$rsIBlockSectionList = CIBlockSection::GetList(
		array("left_margin"=>"asc"),
		array(
			"ACTIVE"=>"Y",
			"IBLOCK_ID"=>$arParams["IBLOCK_ID"],
		),
		false,
		array("ID", "NAME", "DEPTH_LEVEL")
	);
	$arResult["SECTION_LIST"] = array();
	while ($arSection = $rsIBlockSectionList->GetNext())
	{
		$arSection["NAME"] = str_repeat(" . ", $arSection["DEPTH_LEVEL"]).$arSection["NAME"];
		$arResult["SECTION_LIST"][$arSection["ID"]] = array(
			"VALUE" => $arSection["NAME"]
		);
	}
}
if ($bAllowAccess)
{
	// process POST data
	if (check_bitrix_sessid() && (!empty($_REQUEST["iblock_submit"]) || !empty($_REQUEST["iblock_apply"])))
	{
        if(strlen($_REQUEST['NAME']) == 0){
            $arResult['ERRORS'][] = GetMessage("IBLOCK_ADD_ERROR_REQUIRED");
        } else {
            $arParamsReplace = array("replace_space"=>"-","replace_other"=>"-");
            $bs = new CIBlockSection;
            $arFields = Array(
                "ACTIVE" => "N",
                "CREATED_BY" => $USER->GetID(),
                "IBLOCK_ID" => $arParams['IBLOCK_ID'],
                "NAME" => $_REQUEST['NAME'],
                "DESCRIPTION" => $_REQUEST['DESCRIPTION'],
                "DESCRIPTION_TYPE" => "html",
                "CODE" => CUtil::translit($_REQUEST['NAME'],"ru",$arParamsReplace)
            );

            $ID = $bs->Add($arFields);
            $res = ($ID>0);

            if(!$res)
                echo $bs->LAST_ERROR;
            else
                $arResult["MESSAGE"] = GetMessage("IBLOCK_USER_MESSAGE_ADD_DEFAULT");
        }

		// redirect to element edit form or to elements list

	}

	//prepare data for form

    $this->includeComponentTemplate();
}
if (!$bAllowAccess && !$bHideAuth)
{
	//echo ShowError(GetMessage("IBLOCK_ADD_ACCESS_DENIED"));
	$APPLICATION->AuthForm("");
}
