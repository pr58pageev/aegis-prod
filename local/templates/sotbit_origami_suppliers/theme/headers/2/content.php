<?php
global $APPLICATION;
global $USER;

use Bitrix\Main\Localization\Loc;
use Sotbit\Origami\Helper\Config;
use Sotbit\Origami\Config\Option;
use Bitrix\Main\Page\Asset;

$useRegion = (Config::get('USE_REGIONS') == 'Y') ? true : false;
$page = $APPLICATION->GetCurPage(false);
Loc::loadMessages(__FILE__);
?>




<? if (!$USER->IsAuthorized() && $_GET['AUTH_SHOW'] == 'Y'): // && $page != '/personal/cart/' && $page != '/personal/order/make/'?>

    <!-- Modal Auth -->
    <div data-open-on-load class="modal-wrapper j_modal modal-auth redirect" id="modal-auth">
        <div class="modal modal--medium">


            <!-- btn-close -->
            <a href="#" class="modal-close button-close" onclick="Modal.close('modal-auth');">
                <span class="button-close__item"></span>
                <span class="button-close__item"></span>
            </a>
            <!-- ./ End of btn-close -->

            <!-- wrap -->
            <div class="modal-wrap">
                <h3 class="modal__title">
                    Авторизация
                </h3>

                <p class="modal__text">
                    Войдите или
                    <a class="modal__link" href="javascript:void(0);" onclick="Modal.open('modal-reg');">
                        зарегистрируйтесь
                    </a>
                </p>

                <? $APPLICATION->IncludeComponent(
                    "bitrix:system.auth.form",
                    "auth_modal",
                    array(
                        "FORGOT_PASSWORD_URL" => "/b2bcabinet/?forgot_password=yes",
                        "PROFILE_URL" => "/personal/oder/make",
                        "REGISTER_URL" => "#register",
                        "SHOW_ERRORS" => "Y",
                        'REDIRECT_URL_CUSTOM' => '/b2bcabinet/'
                    )
                ); ?>


            </div>
            <!-- ./ End of wrap -->
        </div>
    </div>
    <!-- ./ End of Modal Auth -->

    <!-- Modal Reg -->
    <div <? $APPLICATION->ShowProperty('REGISTER_ERROR') ?> class="modal-wrapper j_modal modal-reg" id="modal-reg">
        <div class="modal modal--medium">
            <!-- wrap -->

            <!-- btn-close -->
            <a href="javascript:void(0);" class="modal-close button-close" onclick="Modal.close('modal-reg');">
                <span class="button-close__item"></span>
                <span class="button-close__item"></span>
            </a>

            <div class="modal-wrap">
                <h3 class="modal__title">
                    Регистрация
                </h3>

                <p class="modal__text">
                    Есть аккаунт?
                    <a class="modal__link" href="javascript:void(0);" onclick="Modal.open('modal-auth');">
                        Войдите в систему
                    </a>
                </p>

                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.register",
                    "modal_register_v2",
                    array(
                        "AUTH" => "Y",
                        "REQUIRED_FIELDS" => array(),
                        "SET_TITLE" => "N",
                        "SHOW_FIELDS" => array("NAME", "PERSONAL_PHONE"),
                        "SUCCESS_PAGE" => "/b2bcabinet/",
                        "USER_PROPERTY" => array(),
                        "USER_PROPERTY_NAME" => "",
                        "USE_BACKURL" => "N"
                    )
                ); ?>


            </div>
            <!-- ./ End of wrap -->
        </div>
    </div>
    <!-- ./ End of Modal Reg -->

    <!-- Modal ForgetPass -->
    <div <? if ($_GET['forgot_password'] == 'yes'): ?>data-open-on-load <? endif; ?>
         class="modal-wrapper j_modal modal-forget" id="modal-forget">
        <div class="modal modal--medium">
            <!-- wrap -->

            <!-- btn-close -->
            <a href="javascript:void(0);" class="modal-close button-close" onclick="Modal.close('modal-forget');">
                <span class="button-close__item"></span>
                <span class="button-close__item"></span>
            </a>

            <div class="modal-wrap">
                <h3 class="modal__title">
                    Восстановление пароля
                </h3>
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.auth.forgotpasswd",
                    "",
                    array(
                        "AUTH_AUTH_URL" => "/?AUTH_SHOW=Y",
                        "AUTH_REGISTER_URL" => "/?AUTH_SHOW=Y",
                        "COMPOSITE_FRAME_MODE" => "A",
                        "COMPOSITE_FRAME_TYPE" => "AUTO"
                    )
                ); ?>

            </div>
            <!-- ./ End of wrap -->
        </div>
    </div>
    <!-- ./ End of ForgetPass -->


<? endif; ?>


<? $APPLICATION->IncludeComponent(
    "bitrix:menu",
    "origami_mobile_menu",
    array(
        "ALLOW_MULTI_SELECT" => "N",
        "CHILD_MENU_TYPE" => "sotbit_left",
        "COMPOSITE_FRAME_MODE" => "A",
        "COMPOSITE_FRAME_TYPE" => "AUTO",
        "DELAY" => "N",
        "MAX_LEVEL" => "4",
        "MENU_CACHE_GET_VARS" => array(),

        "MENU_CACHE_TIME" => "36000000",
        "MENU_CACHE_TYPE" => "A",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "ROOT_MENU_TYPE" => "sotbit_left",
        "USE_EXT" => "Y",
        'CACHE_SELECTED_ITEMS' => false,
        "COMPONENT_TEMPLATE" => ""
    ),
    false
);
?>


<div class="header-two" id="header-two">
    <div class="header-two__main-wrapper">
        <div class="header-two__main">
            <a class="header-two__main-mobile" id="menu_link" href="#menu">
                <svg width="24" height="16">
                    <use xlink:href="/local/templates/sotbit_origami/assets/img/sprite.svg#icon_menu"></use>
                </svg>
            </a>
            <? if ($page != '/'): ?>
                <a href="<?= SITE_DIR ?>" class="header-two__logo">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/sotbit_origami/logo.php"
                        )
                    ); ?>
                </a>
            <? else: ?>
                <span class="header-two__logo">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "include/sotbit_origami/logo.php"
                            )
                        ); ?>
                    </span>
            <? endif; ?>
            <div class="header-two__btn-fixed-menu">
                <svg class="header-two__btn-fixed-menu-icon" width="18" height="18">
                    <use xlink:href="/local/templates/sotbit_origami/assets/img/sprite.svg#icon_menu_1"></use>
                </svg>
                <p class="header-two__btn-fixed-menu-content"><?= Loc::getMessage('HEADER_2_MENU_FIXED') ?></p>
                <svg class="header-two__btn-fixed-menu-icon header-two__btn-fixed-menu-icon--arrow" width="12"
                     height="6">
                    <use xlink:href="/local/templates/sotbit_origami/assets/img/sprite.svg#icon_dropdown_big"></use>
                </svg>
            </div>

            <div class="header-two__city">
                <svg width="18" height="20">
                    <use xlink:href="/local/templates/sotbit_origami/assets/img/sprite.svg#icon_mail"></use>
                </svg>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/sotbit_origami/contacts_email.php")
                );
                ?>
                <div class="slam-easyform">
                    <a type="button" class="slam" onclick="callbackMail('/', 's1', this)">Отправить заявку</a>
                </div>
            </div>


            <div class=" cstm_search2">
                <?
                echo Option::get('IBLOCK');
                $APPLICATION->IncludeComponent(
                    "bitrix:search.title",
                    "origami_header_5",
                    array(
                        "NUM_CATEGORIES" => "1",
                        "TOP_COUNT" => "5",
                        "CHECK_DATES" => "N",
                        "SHOW_OTHERS" => "N",
                        "PAGE" => SITE_DIR . "catalog/",
                        "CATEGORY_0_TITLE" => "РўРѕРІР°СЂС‹",
                        "CATEGORY_0" => array(
                            0 => "iblock_sotbit_origami_catalog",
                        ),
                        "CATEGORY_0_iblock_catalog" => array(
                            0 => Option::get("IBLOCK_ID"),
                        ),
                        "CATEGORY_OTHERS_TITLE" => "РџСЂРѕС‡РµРµ",
                        "SHOW_INPUT" => "Y",
                        "INPUT_ID" => "title-search-input3",
                        "CONTAINER_ID" => "search3",
                        "PRICE_CODE" => \SotbitOrigami::GetComponentPrices(["BASE", "OPT", "SMALL_OPT"]),
                        "SHOW_PREVIEW" => "Y",
                        "PREVIEW_WIDTH" => "75",
                        "PREVIEW_HEIGHT" => "75",
                        "CONVERT_CURRENCY" => "Y",
                        "COMPONENT_TEMPLATE" => "origami_header_5",
                        "ORDER" => "date",
                        "USE_LANGUAGE_GUESS" => "N",
                        "PRICE_VAT_INCLUDE" => "Y",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "CURRENCY_ID" => "RUB",
                        "CATEGORY_0_iblock_sotbit_origami_catalog" => array(
                            0 => "all",
                        )
                    ),
                    false
                ); ?>
            </div>
            <div class="header-two__contact">
                <?
                if (
                    \Bitrix\Main\Loader::includeModule('sotbit.regions') &&
                    \SotbitOrigami::isUseRegions() &&
                    !\SotbitOrigami::isDemoEnd() &&
                    is_dir($_SERVER['DOCUMENT_ROOT'] . '/bitrix/components/sotbit/regions.data')
                ):
                    $APPLICATION->IncludeComponent(
                        "sotbit:regions.data",
                        "origami_header_2",
                        [
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "REGION_FIELDS" => ['UF_ADDRESS', 'UF_PHONE', 'UF_WORKTIME', 'UF_EMAIL'],
                            "REGION_ID" => $_SESSION['SOTBIT_REGIONS']['ID']
                        ]
                    );
                else:?>
                    <div class="header-two__contact-phone-link">
                        <svg class="header-two__contact-phone-link-icon" width="18" height="18">
                            <use xlink:href="/local/templates/sotbit_origami/assets/img/sprite.svg#icon_phone"></use>
                        </svg>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "include/sotbit_origami/contacts_phone.php")
                        );
                        ?>
                        <svg class="header-two__contact-arrow" width="18" height="18">
                            <use xlink:href="/local/templates/sotbit_origami/assets/img/sprite.svg#icon_dropdown_big"></use>
                        </svg>
                    </div>
                    <? if (Config::get("HEADER_CALL") == "Y" && \Bitrix\Main\Loader::includeModule('sotbit.orderphone')):?><!-- <a href="javascript:callbackPhone('<?= SITE_DIR ?>','<?= SITE_ID ?>')"> -->
                        <span rel="nofollow" class="header-two__contact-arrow-link"
                              onclick="callbackPhone('<?= SITE_DIR ?>', '<?= SITE_ID ?>', this)">
                                <?= Loc::getMessage('HEADER_2_CALL_PHONE') ?>
                            </span>
                    <? endif; ?>
                    <div class="header-two__drop-down">
                        <div class="header-two__drop-down-item header-two__drop-down-item--phone">
                            <svg width="18" height="18">
                                <use xlink:href="/local/templates/sotbit_origami/assets/img/sprite.svg#icon_phone"></use>
                            </svg>
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/sotbit_origami/contacts_phone.php")
                            );
                            ?>
                        </div>

                        <div class="header-two__drop-down-item">
                            <svg width="18" height="18">
                                <use xlink:href="/local/templates/sotbit_origami/assets/img/sprite.svg#icon_phone"></use>
                            </svg>
                            <p><? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . "include/sotbit_origami/contacts_phone_2.php")
                                );
                                ?></p>
                        </div>
                        <div class="header-two__drop-down-item">
                            <svg width="18" height="20">
                                <use xlink:href="/local/templates/sotbit_origami/assets/img/sprite.svg#icon_time"></use>
                            </svg>
                            <p>
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . "include/sotbit_origami/contacts_worktime.php")
                                );
                                ?>
                            </p>
                        </div>
                        <div class="header-two__drop-down-item">
                            <svg width="18" height="20">
                                <use xlink:href="/local/templates/sotbit_origami/assets/img/sprite.svg#icon_mail"></use>
                            </svg>
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/sotbit_origami/contacts_email.php")
                            );
                            ?>
                        </div>
                        <div class="header-two__drop-down-item">
                            <svg width="18" height="20">
                                <use xlink:href="/local/templates/sotbit_origami/assets/img/sprite.svg#icon_pin"></use>
                            </svg>
                            <p>
                                <?
                                $APPLICATION->IncludeComponent("bitrix:main.include", "", [
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" =>
                                        SITE_DIR . "include/sotbit_origami/contacts_address.php",
                                ]);
                                ?>
                            </p>
                        </div>
                        <? if (Config::get("HEADER_CALL") == "Y" && \Bitrix\Main\Loader::includeModule('sotbit.orderphone')):?>
                            <!-- <a class="header-two__drop-down-btn" href="javascript:callbackPhone('<?= SITE_DIR ?>','<?= SITE_ID ?>')"> -->
                            <p class="header-two__drop-down-btn"
                               onclick="callbackPhone('<?= SITE_DIR ?>', '<?= SITE_ID ?>' ,this)">
                                <?= Loc::getMessage('HEADER_2_CALL_PHONE') ?>
                            </p>
                        <? endif ?>
                    </div>
                <? endif; ?>
            </div>

            <div class="header-two__city">

                <div class="address_header">
                    <svg width="18" height="20">
                        <use xlink:href="/local/templates/sotbit_origami/assets/img/sprite.svg#icon_pin"></use>
                    </svg>
                    <p>
                        <?
                        $APPLICATION->IncludeComponent("bitrix:main.include", "", [
                            "AREA_FILE_SHOW" => "file",
                            "PATH" =>
                                SITE_DIR . "include/sotbit_origami/contacts_address.php",
                        ]);
                        ?>
                    </p>

                    <?
                    $APPLICATION->IncludeComponent("bitrix:main.include", "", [
                        "AREA_FILE_SHOW" => "file",
                        "PATH" =>
                            SITE_DIR . "include/shema_link.php",
                    ]);
                    ?>

                </div>

                <? /* <div class="work_time_header">
<svg width="18" height="20">
<use xlink:href="/local/templates/sotbit_origami/assets/img/sprite.svg#icon_time"></use>
</svg>
<?
$APPLICATION->IncludeComponent("bitrix:main.include", "", [
"AREA_FILE_SHOW" => "file",
"PATH"           =>
SITE_DIR."include/time_work.php",
]);
?>
</div>*/ ?>

            </div>


            <div class="header-two__personal">

                <? if ($USER->IsAuthorized()): ?>
                    <a href="<?= Config::get('PERSONAL_PAGE') ?>" class="auth_text">
                        <svg width="18" height="20">
                            <use xlink:href="/local/templates/sotbit_origami/assets/img/sprite.svg#icon_login"></use>
                        </svg>
                        <?= Loc::getMessage('INNER') ?>
                    </a>

                    <?php
                    global $USER;
                    $email = $USER->GetEmail();
                    function internoetics_mb_strimwidth($string, $start = 0, $width = 120, $trimmarker = '...')
                    {
                        $len = strlen(trim($string));
                        $newstring = (($len > $width) && ($len != 0)) ? rtrim(mb_strimwidth($string, $start, $width - strlen($trimmarker))) . $trimmarker : $string;
                        return $newstring;
                    }

                    /* Использование */
                    $email = internoetics_mb_strimwidth($email, 0, 20, $trimmarker = '...');

                    ?>  <p><?= $email ?></p>
                <? else: ?>
                    <? /*
                    <a href="<?=Config::get('PERSONAL_PAGE')?>">
                        <svg width="18" height="20">
                            <use xlink:href="/local/templates/sotbit_origami/assets/img/sprite.svg#icon_login"></use>
                        </svg>
                        <?=Loc::getMessage('HEADER_2_ENTER')?>
                    </a>*/ ?>
                    <? $pageLogin = $APPLICATION->GetCurPageParam("AUTH_SHOW=Y", array("AUTH_SHOW")); ?>
                    <a href="<?= $pageLogin ?>" class="auth_text">
                        <svg width="18" height="20">
                            <use xlink:href="/local/templates/sotbit_origami/assets/img/sprite.svg#icon_login"></use>
                        </svg>
                        <?= Loc::getMessage('HEADER_2_ENTER') ?>
                    </a>
                    <p><?= Loc::getMessage('HEADER_2_PERSONAL') ?></p>
                <? endif; ?>


            </div>
            <div class="header-two__basket">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:sale.basket.basket.line",
                    "origami_basket_top",
                    array(
                        "PATH_TO_BASKET" => Config::get("BASKET_PAGE"),
                        "PATH_TO_PERSONAL" => Config::get("PERSONAL_PAGE"),
                        "SHOW_PERSONAL_LINK" => "N",
                        "SHOW_NUM_PRODUCTS" => "Y",
                        "SHOW_TOTAL_PRICE" => "N",
                        "SHOW_PRODUCTS" => "Y",
                        "POSITION_FIXED" => "N",
                        "SHOW_AUTHOR" => "N",
                        "HIDE_ON_BASKET_PAGES" => "N",
                        "PATH_TO_REGISTER" => SITE_DIR . "login/",
                        "PATH_TO_PROFILE" => Config::get("PERSONAL_PAGE"),
                        "COMPONENT_TEMPLATE" => "origami_basket_top",
                        "PATH_TO_ORDER" => Config::get("ORDER_PAGE"),
                        "SHOW_EMPTY_VALUES" => "Y",
                        "PATH_TO_AUTHORIZE" => "",
                        "SHOW_REGISTRATION" => "N",
                        "SHOW_DELAY" => "Y",
                        "SHOW_NOTAVAIL" => "N",
                        "SHOW_IMAGE" => "Y",
                        "SHOW_PRICE" => "Y",
                        "SHOW_SUMMARY" => "Y",
                        "COMPOSITE_FRAME_MODE" => "A",
                        "COMPOSITE_FRAME_TYPE" => "AUTO",
                        "IMAGE_FOR_OFFER" => Option::get("IMAGE_FOR_OFFER"),
                        "MAX_IMAGE_SIZE" => "70"
                    ),
                    false
                ); ?>
            </div>
        </div>
    </div>

    <div class=" cstm_search">
        <?
        echo Option::get('IBLOCK');
        $APPLICATION->IncludeComponent(
            "bitrix:search.title",
            "origami_header_4",
            array(
                "NUM_CATEGORIES" => "1",
                "TOP_COUNT" => "5",
                "CHECK_DATES" => "N",
                "SHOW_OTHERS" => "N",
                "PAGE" => SITE_DIR . "catalog/",
                "CATEGORY_0_TITLE" => "РўРѕРІР°СЂС‹",
                "CATEGORY_0" => array(
                    0 => "iblock_sotbit_origami_catalog",
                ),
                "CATEGORY_0_iblock_catalog" => array(
                    0 => Option::get("IBLOCK_ID"),
                ),
                "CATEGORY_OTHERS_TITLE" => "РџСЂРѕС‡РµРµ",
                "SHOW_INPUT" => "Y",
                "INPUT_ID" => "title-search-input2",
                "CONTAINER_ID" => "title-search2",
                "PRICE_CODE" => \SotbitOrigami::GetComponentPrices(["BASE", "OPT", "SMALL_OPT"]),
                "SHOW_PREVIEW" => "Y",
                "PREVIEW_WIDTH" => "75",
                "PREVIEW_HEIGHT" => "75",
                "CONVERT_CURRENCY" => "Y",
                "COMPONENT_TEMPLATE" => "origami_header_2",
                "ORDER" => "date",
                "USE_LANGUAGE_GUESS" => "N",
                "PRICE_VAT_INCLUDE" => "Y",
                "PREVIEW_TRUNCATE_LEN" => "",
                "CURRENCY_ID" => "RUB",
                "CATEGORY_0_iblock_sotbit_origami_catalog" => array(
                    0 => "all",
                )
            ),
            false
        ); ?>
    </div>
    <div class="header-two__nav">

        <div class="header-two__main-nav">
            <!-- <div class="header-two__"> -->

            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "origami_main_header_2",
                array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "sotbit_left",
                    "COMPOSITE_FRAME_MODE" => "A",
                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "3",
                    "MENU_CACHE_GET_VARS" => array(),
                    "MENU_CACHE_TIME" => "36000000",
                    "MENU_CACHE_TYPE" => "A",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "sotbit_left",
                    "USE_EXT" => "Y",
                    'CACHE_SELECTED_ITEMS' => false,
                    "COMPONENT_TEMPLATE" => "origami_main_header_2"
                ),
                false
            ); ?>

            <!-- </div> -->
            <div class="header-two__main-navigation">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "origami_top_header_2",
                    array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "left",
                        "COMPOSITE_FRAME_MODE" => "A",
                        "COMPOSITE_FRAME_TYPE" => "AUTO",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "3",
                        "MENU_CACHE_GET_VARS" => array(),
                        "MENU_CACHE_TIME" => "36000000",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "sotbit_top",
                        "USE_EXT" => "Y",
                        'CACHE_SELECTED_ITEMS' => false,
                        "COMPONENT_TEMPLATE" => "origami_top_header_2",
                        "MENU_THEME" => "site"
                    ),
                    false
                ); ?>
            </div>

        </div>
    </div>
    <?
    $typeFix = "";
    if (Config::get("HEADER_FIX_DESKTOP") == "Y" && Config::get("HEADER_FIX_MOBILE") == "Y")
        $typeFix = "all";
    elseif (Config::get("HEADER_FIX_DESKTOP") == "Y")
        $typeFix = "desktop";
    elseif (Config::get("HEADER_FIX_MOBILE") == "Y")
        $typeFix = "mobile";
    if ($typeFix):
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/theme/headers/2/script.js");
        ?>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                window.fixedHeader('<?=$typeFix?>');
            });
        </script>
    <? endif; ?>
</div>


<div style="display: none;" id="text_error_form"><? $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_DIR . "include/error_text_form.php"
        )
    ); ?></div>