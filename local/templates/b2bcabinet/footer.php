<?php

use Bitrix\Main\Config\Option;

global $USER;

if (!$USER->IsAuthorized()) {
    include_once "auth_footer.php";
    return;
}
?>
<!--  -->
</main>
<!-- footer -->
<footer class="footer">
    <div class="container-container">
        <div class="footer__wrapper">
            <? $manager = Mediagroup::getUserManager(); ?>
            <? if ($manager) { ?>
                <div class="footer__manager">
                    <span>Ваш менеджер:</span>
                    <div>
                        <span class="footer__manager-name"><?= $manager['NAME'] ?></span>
                        <a class="footer__manager-phone"
                           href="tel:<?= $manager['PROPERTIES']['PHONE']['VALUE'] ?>"><?= $manager['PROPERTIES']['PHONE']['VALUE'] ?></a>
                        <a class="footer__manager-email"
                           href="mailto:<?= $manager['PROPERTIES']['EMAIL']['VALUE'] ?>"><?= $manager['PROPERTIES']['EMAIL']['VALUE'] ?></a>
                    </div>
                </div>
            <? } ?>
            <div class="footer__phone">
                <div class="footer__phone-top">    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/sotbit_origami/footer_text.php")
                    );
                    ?></div>

            </div>
            <div class="flex-modal">
            <div class="footer__button">
                <a class="button button--footer" onclick="callbackVs('/', 's1', this)">Назначить встречу</a>
            </div>

            <div class="footer__button">
                <a class="button button--footer" onclick="callbackMail('/', 's1', this)">Задать вопрос</a>
            </div>
            </div>
        </div>
    </div>
</footer>
<!-- ./ End of footer -->
<script type="text/javascript">
        function sendFormEmail(sid, color) {
        $('.error_custom').remove();
        if ($("form[name='" + sid + "'] input[name='personal']").is(':checked')) {
            $("form[name='" + sid + "'] input[type='submit']").trigger('click');
            console.log('123');
       
        } else {
            
            $("<p class='error_custom'>"+$('#text_error_form').text()+ "</p>").appendTo($('form[name="' + sid + '"] .feedback_block__compliance'));
            $('.feedback_block__compliance svg path').css({'stroke': color, 'stroke-dashoffset': 0});
            console.log('1234');
           
        }
    }
</script>

</div>
</div>
<!--  -->
<!-- Modal message -->
<div class="modal-wrapper j_modal modal-message" id="modal-message">
    <div class="modal modal--small">
        <!-- btn-close -->
        <button class="modal-close button-close j_closeModal">
            <span class="button-close__item"></span>
            <span class="button-close__item"></span>
        </button>
        <!-- ./ End of btn-close -->

        <!-- wrap -->
        <div class="modal-wrap">
            <h3 class="modal__title">
                Напишите нам
            </h3>

            <form action="" class="modal-form">
                <input type="text" class="input" placeholder="Имя"/>
                <input type="email" class="input" placeholder="Email"/>
                <input type="tel" class="input j_mask" placeholder="+7 (___) ___-__-__"/>
                <textarea class="textarea" placeholder="Ваше сообщение"></textarea>

                <p class="modal-form__text">
                    Нажимая кнопку, Вы соглашаетесь <br/>
                    <a href="#" class="modal-form__link">
                        с политикой конфиденциальности
                    </a>
                </p>

                <button class="button" type="button">
                    Отправить сообщение
                </button>
            </form>
        </div>
        <!-- ./ End of wrap -->
    </div>
</div>
<!-- ./ End of Modal message -->


<!-- /page content -->
<div class="feed-back-form">
    <? $APPLICATION->IncludeComponent(
        "bitrix:form",
        "b2b_cabinet_feed_back",
        array(
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "CACHE_TIME" => "3600",
            "CACHE_TYPE" => "A",
            "CHAIN_ITEM_LINK" => "",
            "CHAIN_ITEM_TEXT" => "",
            "EDIT_ADDITIONAL" => "N",
            "EDIT_STATUS" => "N",
            "IGNORE_CUSTOM_TEMPLATE" => "N",
            "NOT_SHOW_FILTER" => "",
            "NOT_SHOW_TABLE" => "",
            "RESULT_ID" => $_REQUEST[RESULT_ID],
            "SEF_MODE" => "N",
            "SHOW_ADDITIONAL" => "N",
            "SHOW_ANSWER_VALUE" => "N",
            "SHOW_EDIT_PAGE" => "N",
            "SHOW_LIST_PAGE" => "N",
            "SHOW_STATUS" => "Y",
            "SHOW_VIEW_PAGE" => "N",
            "START_PAGE" => "new",
            "SUCCESS_URL" => "",
            "USE_EXTENDED_ERRORS" => "N",
            "VARIABLE_ALIASES" => array(
                "action" => "action"
            ),
            "WEB_FORM_ID" => Option::get('sotbit.b2bcabinet', 'B2BCABINET_FEED_BACK_FORM_ID'),
        )
    ); ?>
</div>


<div class="wrap-popup-window vs_feedback" style="display: none;">
    <?php if ($_REQUEST['ajax_form_zayavka'] == 'Y')
        $APPLICATION->RestartBuffer();
    ?>
    <div class="modal-popup-bg" onclick="closeModal2();">&nbsp;</div>
    <div class="popup-window">
        <div class="popup-close" onclick="closeModal2();"></div>
        <div class="popup-content">
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:form.result.new",
                "origami_contacts_callback_manager",
                array(
                    "CACHE_TIME" => "3600",
                    "CACHE_TYPE" => "A",
                    "CHAIN_ITEM_LINK" => "",
                    "CHAIN_ITEM_TEXT" => "",
                    "COMPOSITE_FRAME_MODE" => "A",
                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                    "EDIT_URL" => "",
                    "AJAX_MODE" => 'Y',
                    "IGNORE_CUSTOM_TEMPLATE" => "N",
                    "LIST_URL" => "",
                    "SEF_MODE" => "N",
                    "SUCCESS_URL" => "",
                    "USE_EXTENDED_ERRORS" => "N",
                    "VARIABLE_ALIASES" => array(
                        "RESULT_ID" => "RESULT_ID",
                        "WEB_FORM_ID" => "WEB_FORM_ID"
                    ),
                    "WEB_FORM_ID" => 12,
                    'FORM_TITLE' =>'Назначить встречу',
                )
            );
            ?>
        </div>
    </div>
    <? if ($_REQUEST['ajax_form_zayavka'] == 'Y')
        die();
    ?>
</div>










<div class="wrap-popup-window mail_feedback" style="display: none;">
    <?php if ($_REQUEST['ajax_form_zayavka'] == 'Y')
        $APPLICATION->RestartBuffer();
    ?>
    <div class="modal-popup-bg" onclick="closeModal2();">&nbsp;</div>
    <div class="popup-window">
        <div class="popup-close" onclick="closeModal2();"></div>
        <div class="popup-content">
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:form.result.new",
                "origami_contacts_callback_manager",
                array(
                    "CACHE_TIME" => "3600",
                    "CACHE_TYPE" => "A",
                    "CHAIN_ITEM_LINK" => "",
                    "CHAIN_ITEM_TEXT" => "",
                    "COMPOSITE_FRAME_MODE" => "A",
                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                    "EDIT_URL" => "",
                    "AJAX_MODE" => 'Y',
                    "IGNORE_CUSTOM_TEMPLATE" => "N",
                    "LIST_URL" => "",
                    "SEF_MODE" => "N",
                    "SUCCESS_URL" => "",
                    "USE_EXTENDED_ERRORS" => "N",
                    "VARIABLE_ALIASES" => array(
                        "RESULT_ID" => "RESULT_ID",
                        "WEB_FORM_ID" => "WEB_FORM_ID"
                    ),
                    "WEB_FORM_ID" => 3
                )
            );
            ?>
        </div>
    </div>
    <? if ($_REQUEST['ajax_form_zayavka'] == 'Y')
        die();
    ?>
</div>


<div class="wrap-popup-window individ_modal" style="display: none;">

    <div class="modal-popup-bg" onclick="closeModalInd();">&nbsp;</div>
    <div class="popup-window">
        <div class="popup-close" onclick="closeModalInd();"></div>
        <div class="popup-content sotbit_order_phone">

            <p class="modal_text_new">
                В вашей корзине есть товары другого юридического лица: <span class="ur_lico_modal"></span> <br>
                Чтобы добавить этот товар в корзину, необходимо подтвердить очистку корзины. <br>
                Вы подтверждаете очистку?
            </p>


            <div class="popup-window-submit_button">
                <input type="button" id="confirm_clear" value="Очистить корзину">
            </div>
        </div>
    </div>

</div>


<div class="wrap-popup-window mail_phone" style="display: none;">
    <?php if ($_REQUEST['ajax_form_callback'] == 'Y')
        $APPLICATION->RestartBuffer();
    ?>

    <div class="modal-popup-bg" onclick="closeModal2();">&nbsp;</div>
    <div class="popup-window">
        <div class="popup-close" onclick="closeModal2();"></div>
        <div class="popup-content">
            <?

            $APPLICATION->IncludeComponent(
                "bitrix:form.result.new",
                "origami_callbackphone",
                array(
                    "CACHE_TIME" => "3600",
                    "CACHE_TYPE" => "A",
                    "CHAIN_ITEM_LINK" => "",
                    "CHAIN_ITEM_TEXT" => "",
                    "COMPOSITE_FRAME_MODE" => "A",
                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                    "EDIT_URL" => "",
                    "AJAX_MODE" => 'Y',
                    "IGNORE_CUSTOM_TEMPLATE" => "N",
                    "LIST_URL" => "",
                    "SEF_MODE" => "N",
                    "SUCCESS_URL" => "",
                    "USE_EXTENDED_ERRORS" => "N",
                    "VARIABLE_ALIASES" => array(
                        "RESULT_ID" => "RESULT_ID",
                        "WEB_FORM_ID" => "WEB_FORM_ID"
                    ),
                    "WEB_FORM_ID" => "4"
                )
            );
            ?>
        </div>
    </div>
    <? if ($_REQUEST['ajax_form_callback'] == 'Y')
        die();
    ?>
</div>

<script>

    $(document).ready(function () {

        $('.order_change_status').click(function () {

            $.ajax({
                url: '/local/ajax/changeOrder.php',
                type: 'POST',
                data: {
                    'ACTION': 'CHANGE_STATUS',
                    'ORDER_ID': $(this).attr('data-order'),
                },
                success: function (html) {
                    if (html == 'Y') {
                        location.reload();
                    }
                }
            });
        });

        $('.show_all_list').click(function () {
            $(this).parent().find('.hidden_item_order_b2b').removeClass('hidden_item_order_b2b')
        });


    });

    function closeModal2() {


        BX.onCustomEvent('OnBasketChange');
        $('.wrap-popup-window').hide();
    }


    function closeModalInd() {

        var arSpin = $('.form-control.touchspin-empty');

        $.each(arSpin, function (key, el) {
            $(el).val(0);
        });

        BX.onCustomEvent('OnBasketChange');
        $('.wrap-popup-window').hide();
    }

    function callbackPhone(siteDir, lid, item) {

        $('.mail_phone').show();
        /*createBtnLoader(item);
        $.ajax({
            url: siteDir+'include/ajax/callbackphone.php',
            type: 'POST',
            data:{'lid':lid},
            success: function(html)
            {
                removeBtnLoader(item);
                showModal(html);
            }
        });*/
    }

    function callbackMail(siteDir, lid, item) {
        /*createBtnLoader(item);
        $.ajax({
            url: siteDir+'include/ajax/callbackmail.php',
            type: 'POST',
            data:{'lid':lid},
            success: function(html)
            {
                removeBtnLoader(item);
                showModal(html);
            }
        });*/

        console.log('show')

        $('.mail_feedback').show();

    }

    function callbackVs(siteDir, lid, item) {
        /*createBtnLoader(item);
        $.ajax({
            url: siteDir+'include/ajax/callbackmail.php',
            type: 'POST',
            data:{'lid':lid},
            success: function(html)
            {
                removeBtnLoader(item);
                showModal(html);
            }
        });*/

        console.log('show')

        $('.vs_feedback').show();
        
    }


    function delete_profile(id_profile) {


        $.ajax({
            type: "POST",
            url: '/local/ajax/delete_profile.php',
            data: 'ID=' + id_profile,
            success: function (response) {


                if (response == "Y") {
                    location.reload();
                } else {
                    alert('Ошибка!');
                }
            }
        });


    }

</script>


<!--  --></body>
</html>

