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

if (!empty($arResult["ERRORS"])):?>
	<?ShowError(implode("<br />", $arResult["ERRORS"]))?>
<?endif;
if (strlen($arResult["MESSAGE"]) > 0):?>
	<?ShowNote($arResult["MESSAGE"])?>
<?endif?>
<div class="publications-add">
    <h6 class="title"><?=GetMessage('IBLOCK_FORM_TITLE')?></h6>

    <div class="main-wrapper">
        <div class="main-wrapper__col">
            <form class="form" name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
                <?=bitrix_sessid_post()?>
                <div class="form__group">
                    <div class="form__col">
                        <label for="NAME" class="form__label">
                            <?=GetMessage("IBLOCK_FORM_NAME_LABLE")?>
                        </label>
                        <input id="NAME" class="input form__input" type="text" name="NAME" value="" placeholder="<?=GetMessage("IBLOCK_FORM_NAME_PLACEHOLDER")?>"/>
                        <div class="form__message"></div>
                        <div class="form__warning"></div>
                    </div>
                    <div class="form__col"></div>
                </div>
                
                <div class="form__group">
                    <div class="form__col">
                        <label for="DESCRIPTION" class="form__label">
                            <?=GetMessage("IBLOCK_FORM_DESCRIPTION_LABLE")?>
                        </label>
                        <?
                        $LHE = new CHTMLEditor;
                        $LHE_arr = array(
                            'name' => "DESCRIPTION",
                            'id' => "124123125",
                            'inputName' => "DESCRIPTION",
                            'content' => "",
                            'width' => '100%',
                            'minBodyWidth' => 350,
                            'normalBodyWidth' => 555,
                            'height' => '200',
                            'bAllowPhp' => false,
                            'limitPhpAccess' => false,
                            'autoResize' => true,
                            'autoResizeOffset' => 40,
                            'useFileDialogs' => false,
                            'saveOnBlur' => true,
                            'showTaskbars' => false,
                            'showNodeNavi' => false,
                            'askBeforeUnloadPage' => true,
                            'bbCode' => false,
                            'siteId' => SITE_ID,
                            'controlsMap' => array(
                                array('id' => 'Bold', 'compact' => true, 'sort' => 80),
                                array('id' => 'Italic', 'compact' => true, 'sort' => 90),
                                array('id' => 'Underline', 'compact' => true, 'sort' => 100),
                                array('id' => 'Strikeout', 'compact' => true, 'sort' => 110),
                                array('id' => 'RemoveFormat', 'compact' => true, 'sort' => 120),
                                array('id' => 'Color', 'compact' => true, 'sort' => 130),
                                array('id' => 'FontSelector', 'compact' => false, 'sort' => 135),
                                array('id' => 'FontSize', 'compact' => false, 'sort' => 140),
                                array('separator' => true, 'compact' => false, 'sort' => 145),
                                array('id' => 'OrderedList', 'compact' => true, 'sort' => 150),
                                array('id' => 'UnorderedList', 'compact' => true, 'sort' => 160),
                                array('id' => 'AlignList', 'compact' => false, 'sort' => 190),
                                array('separator' => true, 'compact' => false, 'sort' => 200),
                                array('id' => 'InsertLink', 'compact' => true, 'sort' => 210),
                                array('id' => 'InsertImage', 'compact' => false, 'sort' => 220),
                                array('id' => 'InsertVideo', 'compact' => true, 'sort' => 230),
                                array('id' => 'InsertTable', 'compact' => false, 'sort' => 250),
                                array('separator' => true, 'compact' => false, 'sort' => 290),
                                array('id' => 'Fullscreen', 'compact' => false, 'sort' => 310),
                                array('id' => 'More', 'compact' => true, 'sort' => 400)
                            ),
                        );
                        $LHE_array[] = $LHE_arr;
                        $LHE->Show(
                            $LHE_arr
                        );
                        ?>
                        <div class="form__message"></div>
                        <div class="form__warning"></div>
                    </div>
                    <div class="form__col"></div>
                </div>
                <div class="form__actions">
                    <input type="submit" class="main_btn"  name="iblock_submit" value="<?=GetMessage("IBLOCK_FORM_SUBMIT")?>" />
                </div>
            </form>
        </div>
        <div class="main-wrapper__col"></div>
    </div>
</div>
<script>
    var configs = <?=CUtil::PhpToJSObject($LHE_array, false, true)?>
</script>