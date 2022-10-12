<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(false);

?>
<?if (strlen($arResult["MESSAGE"]) > 0):?>
	<?ShowNote($arResult["MESSAGE"])?>
<?endif?>
    <div class="publications">
        <div class="main-wrapper">
            <div class="main-wrapper__col">
                <?if($arResult["NO_USER"] == "N"):?>
                <table class="super-table">
                    <thead class="super-table__head">
                        <tr class="super-table__row">
                            <td class="super-table__col"><?=GetMessage('IBLOCK_LIST_TITLE_NAME')?></td>
                            <td class="super-table__col"><?=GetMessage('IBLOCK_LIST_TITLE_RESULT')?></td>
                            <td class="super-table__col"><?=GetMessage('IBLOCK_LIST_TITLE_ADDITION')?></td>
                            <td class="super-table__col"></td>
                        </tr>
                    </thead>
                    <tbody class="super-table__body">
                        <?if (count($arResult["ELEMENTS"]) > 0):?>
                            <?foreach ($arResult["ELEMENTS"] as $arElement):?>
                                <tr class="super-table__row">
                                    <td class="super-table__col"><?=$arElement["NAME"]?></td>
                                    <td class="super-table__col <?if ($arElement['ACTIVE'] !="Y"):?>super-table__col--red<?endif;?>">
                                        <?if ($arElement['ACTIVE'] !="Y"):?>
                                            Не одобрено
                                        <?else:?>
                                            Одобрено
                                        <?endif;?>
                                    </td>
                                    <td class="super-table__col">
                                        <?if ($arElement['ACTIVE'] == "Y"):?>
                                            <?=$arElement['DATE_ACTIVE_FROM']?>
                                        <?else:?>
                                            <?if(isset($arResult['COMMENTS'][$arElement['ID']]) && !empty($arResult['COMMENTS'][$arElement['ID']]['~VALUE']['TEXT'])):?>
                                                <?=$arResult['COMMENTS'][$arElement['ID']]['~VALUE']['TEXT']?>
                                            <?else:?>
                                                На проверке
                                            <?endif;?>
                                        <?endif;?>
                                    </td>
                                    <td class="super-table__col">
                                        <div class="super-table__actions">
            <?if ($arElement['ACTIVE'] != "Y"):?>
                                            <a href="<?=$arParams["EDIT_URL"]?>?edit=Y&amp;CODE=<?=$arElement["ID"]?>" class="super-table__action">
                                                <svg class="super-table__icon">
                                                    <use xlink:href="#edit"></use>
                                                </svg>
                                            </a>
                                            <a href="?delete=Y&amp;CODE=<?=$arElement["ID"]?>&amp;<?=bitrix_sessid_get()?>" onClick="return confirm('<?echo CUtil::JSEscape(str_replace("#ELEMENT_NAME#", $arElement["NAME"], GetMessage("IBLOCK_ADD_LIST_DELETE_CONFIRM")))?>')" class="super-table__action">
                                                <svg class="super-table__icon">
                                                    <use xlink:href="#trash"></use>
                                                </svg>
                                            </a>
            <?endif;?>
                                        </div>
                                    </td>
                                </tr>
                            <?endforeach;?>
                        <?endif;?>
                    </tbody>
                </table>
                <?endif;?>
            </div>
            <div class="main-wrapper__col">
                <div class="categories__actions">
                    <?if ($arParams["MAX_USER_ENTRIES"] > 0 && $arResult["ELEMENTS_COUNT"] < $arParams["MAX_USER_ENTRIES"]):?>
                        <a href="<?=$arParams["EDIT_URL"]?>?edit=Y" class="main_btn">
                            <svg class="main_btn__svg">
                                <use xlink:href="#sub"></use>
                            </svg>
                            <?=GetMessage("IBLOCK_ADD_LINK_TITLE")?>
                        </a>
                    <?else:?>
                        <?=GetMessage("IBLOCK_LIST_CANT_ADD_MORE")?>
                    <?endif?>
                </div>
            </div>
        </div>
    </div>
<?if (strlen($arResult["NAV_STRING"]) > 0):?><?=$arResult["NAV_STRING"]?><?endif?>