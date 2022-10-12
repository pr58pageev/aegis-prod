<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<?if($arResult['SECTIONS']):?>
    <div class="categories">
        <div class="main-wrapper">
            <div class="main-wrapper__col">
                <table class="super-table">
                    <thead class="super-table__head">
                        <tr class="super-table__row">
                            <td class="super-table__col"><?=GetMessage('SECTION_TITLE_NAME')?></td>
                            <td class="super-table__col"><?=GetMessage('SECTION_TITLE_RESULT')?></td>
                            <td class="super-table__col"><?=GetMessage('SECTION_TITLE_ADDITION')?></td>
                            <td class="super-table__col"></td>
                        </tr>
                    </thead>

                    <tbody class="super-table__body">
                        <?foreach ($arResult['SECTIONS'] as $section):?>
                            <tr class="super-table__row">
                                <td class="super-table__col"><?=$section['PRINT_NAME']?></td>
                                <td class="super-table__col <?if ($section['ACTIVE'] !="Y"):?>super-table__col--red<?endif;?>">
                                <?if ($section['ACTIVE'] !="Y"):?>
                                    Не одобрено
                                <?else:?>
                                    Одобрено
                                <?endif;?></td>
                                <td class="super-table__col">
                                <?if ($section['ACTIVE'] == "Y"):?>
                                    <?= $section['TIMESTAMP_X'] ?>
                                <? else: ?>
                                    <? if ($section['COMMENTS']["UF_ADMIN_COMMENT"]): ?>
                                        <?= $section['COMMENTS']["~UF_ADMIN_COMMENT"] ?>
                                    <? else: ?>
                                        На проверке
                                    <? endif; ?>
                                <? endif;?>
                                </td>
                                <td class="super-table__col">
                                </td>
                            </tr>
                        <?endforeach;?>
                    </tbody>
                </table>
            </div>
            <div class="main-wrapper__col">
                <div class="categories__actions">
                    <a href="/suppliers_cabinet/section/" class="main_btn">
                        <svg class="main_btn__svg">
                            <use xlink:href="#sub"></use>
                        </svg>
                        Добавить категорию
                    </a>
                </div>
            </div>
        </div>
    </div>
<?endif;?>

