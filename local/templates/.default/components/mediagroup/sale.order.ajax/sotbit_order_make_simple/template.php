<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if (\SotbitOrigami::isDemoEnd())
    return false;

//pre($arResult);die;
$this->addExternalJs($templateFolder . "/logic.js");

if ($arResult["GRID"]["ROWS"]) {
    // counting the quantity of products
    foreach ($arResult["GRID"]["ROWS"] as $product) {
        $quantity += $product["data"]["QUANTITY"];
    }

    $mod10 = $quantity % 10;
    $mod100 = $quantity % 100;
    $quantityLabel = Loc::getMessage("SOTBIT_SOA_QUANTITY_LABEL_DEFAULT");
    if (($mod10 > 1 && $mod10 < 5) && ($mod100 < 12 || $mod100 > 14))
        $quantityLabel .= Loc::getMessage("SOTBIT_SOA_QUANTITY_LABEL_V1");
    elseif ($mod10 == 0 || ($mod10 > 4 && $mod10 < 10) || ($mod100 > 10 && $mod100 < 15))
        $quantityLabel .= Loc::getMessage("SOTBIT_SOA_QUANTITY_LABEL_V2");
}

if ($USER->IsAuthorized() || $arParams["ALLOW_AUTO_REGISTER"] == "Y") {
    if ($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y") {
        if (strlen($arResult["REDIRECT_URL"]) > 0) {
            $APPLICATION->RestartBuffer();
            ?>
            <script>
                window.top.location.href = '<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';
            </script>
            <?
            die();
        }
    }
}

$signer = new \Bitrix\Main\Security\Sign\Signer;
$signedParams = $signer->sign(base64_encode(serialize($arParams)), 'sale.order.ajax');
$messages = Loc::loadLanguageFile(__FILE__);

$arParams['MESS_USE_COUPON'] = Loc::getMessage("USE_COUPON_DEFAULT");
$arParams['MESS_COUPON'] = Loc::getMessage("COUPON_DEFAULT");
$arParams['MESS_ECONOMY'] = Loc::getMessage("SOA_SUM_DISCOUNT");
$arParams['MESS_PRICE_FREE'] = Loc::getMessage("PRICE_FREE_DEFAULT");

/*
<?$APPLICATION->IncludeComponent("bitrix:sale.personal.profile","",Array(
        "PATH_TO_DETAIL" => "profile_detail.php",
        "PER_PAGE" => 20,
        "SET_TITLE" => "Y"
    )
);?>?>
*/ ?>

<div id="sotbit_soa">

    <div id="order_form_div">

        <NOSCRIPT>
            <div class="errortext"><?= Loc::getMessage("SOA_NO_JS") ?></div>
        </NOSCRIPT>

        <?
        if (!function_exists("getColumnName")) {
            function getColumnName($arHeader)
            {
                return (strlen($arHeader["name"]) > 0) ? $arHeader["name"] : Loc::getMessage("SALE_" . $arHeader["id"]);
            }
        }
        if (!function_exists("cmpBySort")) {
            function cmpBySort($array1, $array2)
            {
                if (!isset($array1["SORT"]) || !isset($array2["SORT"]))
                    return -1;

                if ($array1["SORT"] > $array2["SORT"])
                    return 1;

                if ($array1["SORT"] < $array2["SORT"])
                    return -1;

                if ($array1["SORT"] == $array2["SORT"])
                    return 0;
            }
        }
        ?>

        <div>
            <?
            if (!$USER->IsAuthorized() && $arParams["ALLOW_AUTO_REGISTER"] == "N") {
                if (!empty($arResult["ERROR"])) {
                    foreach ($arResult["ERROR"] as $v)
                        echo ShowError($v);
                } elseif (!empty($arResult["OK_MESSAGE"])) {
                    foreach ($arResult["OK_MESSAGE"] as $v)
                        echo ShowNote($v);
                }

                include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/auth.php");
            } else {
                if ($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y") {
                    if (strlen($arResult["REDIRECT_URL"]) == 0) {
                        include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/confirm.php");
                    }
                } else {
                    ?>
                    <script>
                        <?if(CSaleLocation::isLocationProEnabled()):?>
                        <?
                        // spike: for children of cities we place this prompt
                        $city = \Bitrix\Sale\Location\TypeTable::getList(array('filter' => array('=CODE' => 'CITY'), 'select' => array('ID')))->fetch();
                        ?>
                        BX.saleOrderAjax.init(<?=CUtil::PhpToJSObject(array(
                            'source' => $this->__component->getPath() . '/get.php',
                            'cityTypeId' => intval($city['ID']),
                            'messages' => array(
                                'otherLocation' => '--- ' . Loc::getMessage('SOA_OTHER_LOCATION'),
                                'moreInfoLocation' => '--- ' . Loc::getMessage('SOA_NOT_SELECTED_ALT'), // spike: for children of cities we place this prompt
                                'notFoundPrompt' => '<div class="-bx-popup-special-prompt">' . Loc::getMessage('SOA_LOCATION_NOT_FOUND') . '.<br />' . Loc::getMessage('SOA_LOCATION_NOT_FOUND_PROMPT', array(
                                        '#ANCHOR#' => '<a href="javascript:void(0)" class="-bx-popup-set-mode-add-loc">',
                                        '#ANCHOR_END#' => '</a>'
                                    )) . '</div>'
                            )
                        ))?>);
                        <?endif?>

                        var BXFormPosting = false;

                        function submitForm(val) {

                            console.log('SUBMIT_FORM');
                            BX.addCustomEvent("reject", function () { // bad solution
                                if (BXFormPosting)
                                    document.location.reload();
                            });

                            if (BXFormPosting === true) {
                                return true;
                            }

                            BXFormPosting = true;
                            if (val != 'Y') {
                                BX('confirmorder').value = 'N';
                                //console.log('not Y');
                                //BX.UserConsent.current.inputNode.checked = true;
                            }

                            var orderForm = BX('ORDER_FORM');
                            //BX.showWait();

                            <?if(CSaleLocation::isLocationProEnabled()):?>
                            BX.saleOrderAjax.cleanUp();
                            <?endif?>
                            console.log('Ждем запрос на оформление');
                            BX.ajax.submit(orderForm, ajaxResult);

                            return true;
                        }

                        function ajaxResult(res) {
                            var orderForm = BX('ORDER_FORM');
                            try {
                                //console.log('try');

                                // if json came, it obviously a successfull order submit
                                var json = JSON.parse(res);

                                //BX.closeWait();

                                if (json.error) {
                                    BXFormPosting = false;
                                    return;
                                } else if (json.redirect) {
                                    window.top.location.href = json.redirect;
                                }
                            } catch (e) {
                                //console.log('catch');
                                //console.log(BX.OrderAjaxLogic.result);

                                // json parse failed, so it is a simple chunk of html
                                BXFormPosting = false;
                                BX('order_form_content').innerHTML = res;

                                BX.OrderAjaxLogic.sendRequest('refreshOrderAjax');

                                validation();

                                /* new coupon block initialization when submit form */
                                BX.OrderAjaxLogic.init({
                                    result: <?=CUtil::PhpToJSObject($arResult['JS_DATA'])?>,
                                    params: <?=CUtil::PhpToJSObject($arParams)?>,
                                    signedParamsString: '<?=CUtil::JSEscape($signedParams)?>',
                                    siteID: '<?=$component->getSiteId()?>',
                                    ajaxUrl: '<?=CUtil::JSEscape($component->getPath() . '/ajax.php')?>',
                                    templateFolder: '<?=CUtil::JSEscape($templateFolder)?>',

                                    orderBlockId: 'coupon_block',
                                    basketBlockId: 'coupon_block',
                                    basketRowsId: 'basket_rows',
                                    sotbitSoaBlockId: 'sotbit_soa',
                                    totalBlockId: 'sotbit_soa_total'
                                });

                                <?if(CSaleLocation::isLocationProEnabled()):?>
                                BX.saleOrderAjax.initDeferredControl();
                                <?endif?>
                            }

                            //BX.closeWait();

                            BX.onCustomEvent(orderForm, 'onAjaxSuccess');
                        }

                        function SetContact(profileId) {
                            BX("profile_change").value = "Y";
                            submitForm();
                        }
                    </script>
                <?
                if ($_POST["is_ajax_post"] != "Y")
                {
                ?>
                    <form action="<?= POST_FORM_ACTION_URI ?>" method="POST" name="ORDER_FORM" id="ORDER_FORM"
                          enctype="multipart/form-data">
                        <?= bitrix_sessid_post() ?>

                        <input type="hidden" id="id_order" value="<?=$_GET['ID_ORDER']?>">
                        <div id="order_form_content">

                            <?
                            }
                            else {
                                $APPLICATION->RestartBuffer();
                            }
                            ?>

                            <!-- decoration -->
                            <section class="decoration-section">
                                <div class="container">
                                    <?
                                    //Asset::getInstance()->addJs(SITE_DIR . "local/temp/bundle.js");
                                    ?>

                                    <?
                                    if ($_REQUEST['PERMANENT_MODE_STEPS'] == 1) {
                                        ?>
                                        <input type="hidden" name="PERMANENT_MODE_STEPS" value="1">
                                        <?
                                    }

                                    if (!empty($arResult["ERROR"]) && $arResult["USER_VALS"]["FINAL_STEP"] == "Y") {
                                        ?>
                                        <div class="errors_list">
                                            <?
                                            foreach ($arResult["ERROR"] as $v)
                                                echo '<span class="errortext">' . $v . '</span>';
                                            ?>
                                        </div>
                                        <script>
                                            top.BX.scrollToNode(top.BX('ORDER_FORM'));
                                        </script>
                                        <?
                                    }
                                    ?>

                                    <!-- wrap -->
                                    <div class="decoration-wrap">
                                        <?
                                        include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/decoration_left.php");
                                        include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/aside.php");
                                        ?>


                                    </div>
                                    <!-- ./End of wrap -->
                                </div>
                                <!-- ./ End of container -->
                            </section>
                            <!-- ./ End of decoration -->

                            <?

                            //include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/summary.php");
                            // include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/summary2.php"); //include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/related_props.php");

                            if (strlen($arResult["PREPAY_ADIT_FIELDS"]) > 0)
                                echo $arResult["PREPAY_ADIT_FIELDS"];
                            ?>

                            <?
                            /*
                          <div class="price_order_block__item fonts__small_text">
                              <b><?=$quantity?></b> <?=$quantityLabel?> <?=Loc::getMessage("SOA_TEMPL_SUM_SUMMARY")?> <b class="sotbit_soa_order_price"><?=$arResult["ORDER_PRICE_FORMATED"]?></b>
                          </div>
                          <?
                          if(floatval($arResult['ORDER_WEIGHT']) > 0)
                          {
                              ?>
                              <div class="price_order_block__item fonts__small_text">
                                  <?=Loc::getMessage("SOA_TEMPL_SUM_WEIGHT_SUM")?> <b><?=$arResult["ORDER_WEIGHT_FORMATED"]?></b>
                              </div>
                              <?
                          }
                        if(doubleval($arResult["DISCOUNT_PRICE"]) > 0)
                          {
                              ?>
                              <div class="sotbit_soa_discount_total_block price_order_block__item fonts__small_text">
                                  <?=Loc::getMessage("SOA_TEMPL_SUM_DISCOUNT")?><?if(strLen($arResult["DISCOUNT_PERCENT_FORMATED"])>0):?> (<?echo $arResult["DISCOUNT_PERCENT_FORMATED"];?>)<?endif;?>
                                  <b class="sotbit_soa_discount_value"><?=$arResult["DISCOUNT_PRICE_FORMATED"]?></b>
                              </div>
                              <?
                          }*/

                            ?>


                            <?
                            if ($_POST["is_ajax_post"] != "Y")
                            {
                            ?>
                        </div>
                        <input type="hidden" name="confirmorder" id="confirmorder" value="Y">
                        <input type="hidden" name="profile_change" id="profile_change" value="N">
                        <input type="hidden" name="is_ajax_post" id="is_ajax_post" value="Y">
                        <input type="hidden" name="json" value="Y">


                    </form>
                    <?
                if ($arParams["DELIVERY_NO_AJAX"] == "N")
                {
                    ?>
                        <div style="display:none;"><? $APPLICATION->IncludeComponent("bitrix:sale.ajax.delivery.calculator", "", array(), null, array('HIDE_ICONS' => 'Y')); ?></div>
                    <?
                }
                }
                else
                {
                ?>
                    <script>
                        top.BX('confirmorder').value = 'Y';
                        top.BX('profile_change').value = 'N';
                    </script>
                    <?
                    die();
                }
                }
            }
            ?>
        </div>

    </div>

    <? if (CSaleLocation::isLocationProEnabled()): ?>

        <div style="display: none">
            <?
            // we need to have all styles for sale.location.selector.steps, but RestartBuffer() cuts off document head with styles in it
            $APPLICATION->IncludeComponent(
                "bitrix:sale.location.selector.steps",
                ".default",
                array(),
                false
            );
            $APPLICATION->IncludeComponent(
                "bitrix:sale.location.selector.search",
                ".default",
                array(),
                false
            );
            ?>
        </div>

    <? endif ?>

</div>

<? if (!$USER->IsAuthorized()): // Если пользователь неавторизован, то даем информацию?>

    <!-- Modal Auth -->
    <div data-open-on-load class="modal-wrapper j_modal modal-auth" id="modal-auth">
        <div class="modal modal--medium">


            <!-- btn-close -->
            <a href="/personal/cart/" class="modal-close button-close">
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
                        "SHOW_ERRORS" => "Y"
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
            <a href="/personal/cart/" class="modal-close button-close">
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
                        "SUCCESS_PAGE" => "/personal/order/make/",
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

<? endif; ?>

<script>

    $(document).ready(function () {

        setInterval(function () {
            checkValue();
        }, 800);

        function checkValue() {

            var $this = $('#ORDER_PROP_10');
            var string_val = $this.val();
            string_val = string_val.replace('_', '');
            var maxLenC = parseInt($('.field_OOO_IP').attr('data-max'), 10);
            if ($this.val().length > maxLenC)
                $this.val($this.val().substr(0, maxLenC));

            if (string_val.length < maxLenC && string_val.length != 0) {
                $($this).addClass('red_border');
            } else {
                $($this).removeClass('red_border');
            }

            let addClassC = false;



            if($('#blij_delivery').html() != undefined){
                addClassC = true;

            }


            $('.datepicker').removeClass('error_max_time_cont');
            let block = false;

            if ($(".field_TIME_DELIV").val() != '') {


                var value_time = $('.field_TIME_DELIV').val();

                value_time = explode('-', value_time);

                var h1 = explode(':', value_time[0]);
                h1 = h1[0];
                var m1 = explode(':', value_time[0]);
                m1 = m1[1];

                var h2 = explode(':', value_time[1]);
                h2 = h2[0];
                var m2 = explode(':', value_time[1]);
                m2 = m2[1];
                //console.log('Час 1:'+h1+', минуты 1:'+ m1);
                //console.log('Час 2:'+h2+', минуты 2:'+ m2);
                var sumsec1 = h1 * 3600 + m1 * 60 + 0; //Первое время в секунды
                var sumsec2 = h2 * 3600 + m2 * 60 + 0; //Второе
                var max_time = $('#max_hourse').val();
                max_time = parseInt(max_time);
                var res = sumsec2 - sumsec1;

                if (res < max_time * 3600) {
                    block = true;
                    $('.max_time').remove();
                    $(".datepicker").append('<p class="error_text_delivery max_time">Минимальная разница во времени ' + max_time + ' часа</p>');
                    $('.field_TIME_DELIV').addClass('red_border');
                    addClassC = true;

                } else {
                    $('.max_time').remove();
                    $('.field_TIME_DELIV').removeClass('red_border');

                }

                if(addClassC==true){
                    $('.datepicker').addClass('error_max_time_cont');
                }
            }


           


            var str_blihj = $('.blij_dilvery_value').html().replace(/\s/g, '');
            var str_blihj2 = $('.field_DATE').val().replace(/\s/g, '');
            var str_blihj_time = explode('.',str_blihj);
            var str_blihj_total = (parseInt(str_blihj_time[0],10) * 1) + (parseInt(str_blihj_time[1],10) * 30) + (parseInt(str_blihj_time[2],10) * 365);



            var str_blihj2_time = explode('.',str_blihj2);
            var str_blihj2_total = (parseInt(str_blihj2_time[0],10) * 1) + (parseInt(str_blihj2_time[1],10) * 30) + (parseInt(str_blihj2_time[2],10) * 365);



            if(str_blihj2_total<str_blihj_total && str_blihj2 != ''){
                block = true;
                $('.decoration-inputs .field_DATE ').addClass('red_border');
            }else{
                $('.decoration-inputs .field_DATE').removeClass('red_border');
            }


           

            if(block==true){
                $('#ORDER_CONFIRM_BUTTON').attr('disabled', 'disabled');
            }else{
                $('#ORDER_CONFIRM_BUTTON').removeAttr('disabled');
            }

            function explode(delimiter, string) { // Split a string by string
                //
                // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
                // +   improved by: kenneth
                // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)

                var emptyArray = {0: ''};

                if (arguments.length != 2
                    || typeof arguments[0] == 'undefined'
                    || typeof arguments[1] == 'undefined') {
                    return null;
                }

                if (delimiter === ''
                    || delimiter === false
                    || delimiter === null) {
                    return false;
                }

                if (typeof delimiter == 'function'
                    || typeof delimiter == 'object'
                    || typeof string == 'function'
                    || typeof string == 'object') {
                    return emptyArray;
                }

                if (delimiter === true) {
                    delimiter = '1';
                }

                return string.toString().split(delimiter.toString());
            }


        }
    });


    BX.message(<?=CUtil::PhpToJSObject($messages)?>);
    BX.OrderAjaxLogic.init({
        result: <?=CUtil::PhpToJSObject($arResult['JS_DATA'])?>,
        params: <?=CUtil::PhpToJSObject($arParams)?>,
        signedParamsString: '<?=CUtil::JSEscape($signedParams)?>',
        siteID: '<?=$component->getSiteId()?>',
        ajaxUrl: '<?=CUtil::JSEscape($component->getPath() . '/ajax.php')?>',
        templateFolder: '<?=CUtil::JSEscape($templateFolder)?>',

        orderBlockId: 'coupon_block',
        basketBlockId: 'coupon_block',
        basketRowsId: 'basket_rows',
        sotbitSoaBlockId: 'sotbit_soa',
        totalBlockId: 'sotbit_soa_total'
    });

    function validation() {
        var fieldsBlock = $("#sale_order_props div[data-property-id-row] > div");
        var elems = fieldsBlock.find("> input, > textarea");

        elems.each(function (i, elem) {
            if ($(elem).hasClass("required") && !elem.value) {
                $(elem).addClass("has-error");
            } else {
                $(elem).removeClass("has-error");
            }
        });
    }

    function onChangeValidation(el) {
        if (el.value != "")
            $(el).removeClass("has-error");
    }
</script>


