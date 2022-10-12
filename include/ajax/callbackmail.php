<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
/*
$APPLICATION->IncludeComponent(
    "slam:easyform", 
    "header_zayavka", 
    array(
        "CATEGORY_ACCEPT_TITLE" => "Согласие на обработку данных",
        "CATEGORY_ACCEPT_TYPE" => "accept",
        "CATEGORY_ACCEPT_VALIDATION_ADDITIONALLY_MESSAGE" => "",
        "CATEGORY_ACCEPT_VALUE" => "Согласен на обработку <a href=\"#\" target=\"_blank\">персональныx данных</a>",
        "CATEGORY_DOCS_DROPZONE_INCLUDE" => "Y",
        "CATEGORY_DOCS_FILE_EXTENSION" => "doc, docx, xls, xlsx, txt, rtf, pdf, png, jpeg, jpg, gif",
        "CATEGORY_DOCS_FILE_MAX_SIZE" => "20971520",
        "CATEGORY_DOCS_TITLE" => "Прикрепить заявку",
        "CATEGORY_DOCS_TYPE" => "file",
        "CATEGORY_EMAIL_PLACEHOLDER" => "Ваш E-mail",
        "CATEGORY_EMAIL_TITLE" => "Ваш E-mail",
        "CATEGORY_EMAIL_TYPE" => "email",
        "CATEGORY_EMAIL_VALIDATION_ADDITIONALLY_MESSAGE" => "data-bv-emailaddress-message=\"E-mail введен некорректно\"",
        "CATEGORY_EMAIL_VALIDATION_MESSAGE" => "Обязательное поле",
        "CATEGORY_EMAIL_VALUE" => "",
        "CATEGORY_MESSAGE_PLACEHOLDER" => "Сообщение для менеджера",
        "CATEGORY_MESSAGE_TITLE" => "Сообщение для менеджера",
        "CATEGORY_MESSAGE_TYPE" => "textarea",
        "CATEGORY_MESSAGE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
        "CATEGORY_MESSAGE_VALUE" => "",
        "CATEGORY_PHONE_INPUTMASK" => "N",
        "CATEGORY_PHONE_INPUTMASK_TEMP" => "+7 (999) 999-9999",
        "CATEGORY_PHONE_PLACEHOLDER" => "Мобильный телефон",
        "CATEGORY_PHONE_TITLE" => "Мобильный телефон",
        "CATEGORY_PHONE_TYPE" => "tel",
        "CATEGORY_PHONE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
        "CATEGORY_PHONE_VALUE" => "",
        "CATEGORY_TITLE_PLACEHOLDER" => "Ваше имя",
        "CATEGORY_TITLE_TITLE" => "Ваше имя",
        "CATEGORY_TITLE_TYPE" => "text",
        "CATEGORY_TITLE_VALIDATION_ADDITIONALLY_MESSAGE" => "",
        "CATEGORY_TITLE_VALIDATION_MESSAGE" => "Обязательное поле",
        "CATEGORY_TITLE_VALUE" => "",
        "CREATE_SEND_MAIL" => "",
        "DISPLAY_FIELDS" => array(
            0 => "TITLE",
            1 => "EMAIL",
            2 => "PHONE",
            3 => "MESSAGE",
            4 => "DOCS",
            5 => "ACCEPT",
            6 => "",
        ),
        "EMAIL_BCC" => "",
        "EMAIL_FILE" => "N",
        "EMAIL_SEND_FROM" => "N",
        "EMAIL_TO" => "",
        "ENABLE_SEND_MAIL" => "Y",
        "ERROR_TEXT" => "Произошла ошибка. Сообщение не отправлено.",
        "EVENT_MESSAGE_ID" => array(
            0 => "90",
        ),
        "FIELDS_ORDER" => "TITLE,EMAIL,PHONE,MESSAGE,DOCS,ACCEPT",
        "FORM_AUTOCOMPLETE" => "N",
        "FORM_ID" => "FORM_01567",
        "FORM_NAME" => "Отправить заявку",
        "FORM_SUBMIT_VALUE" => "Отправить заявку",
        "FORM_SUBMIT_VARNING" => "Нажимая на кнопку \"#BUTTON#\", вы даете согласие на обработку <a target=\"_blank\" href=\"#\">персональных данных</a>",
        "HIDE_ASTERISK" => "N",
        "HIDE_FIELD_NAME" => "Y",
        "HIDE_FORMVALIDATION_TEXT" => "N",
        "INCLUDE_BOOTSRAP_JS" => "Y",
        "MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы Отправить заявку",
        "NAME_MODAL_BUTTON" => "Отправить заявку",
        "OK_TEXT" => "Ваше сообщение отправлено. ",
        "REQUIRED_FIELDS" => array(
            0 => "EMAIL",
            1 => "PHONE",
            2 => "ACCEPT",
        ),
        "SEND_AJAX" => "Y",
        "SHOW_MODAL" => "N",
        "TITLE_SHOW_MODAL" => "Спасибо!",
        "USE_BOOTSRAP_CSS" => "Y",
        "USE_BOOTSRAP_JS" => "Y",
        "USE_CAPTCHA" => "N",
        "USE_FORMVALIDATION_JS" => "Y",
        "USE_IBLOCK_WRITE" => "Y",
        "USE_JQUERY" => "N",
        "USE_MODULE_VARNING" => "Y",
        "WIDTH_FORM" => "570px",
        "_CALLBACKS" => "",
        "COMPONENT_TEMPLATE" => "header_zayavka",
        "CREATE_IBLOCK" => "",
        "IBLOCK_TYPE" => "formresult",
        "IBLOCK_ID" => "14",
        "ACTIVE_ELEMENT" => "N",
        "CATEGORY_TITLE_IBLOCK_FIELD" => "NAME",
        "CATEGORY_EMAIL_IBLOCK_FIELD" => "FORM_EMAIL",
        "CATEGORY_PHONE_VALIDATION_MESSAGE" => "Обязательное поле",
        "CATEGORY_PHONE_IBLOCK_FIELD" => "FORM_PHONE",
        "CATEGORY_MESSAGE_IBLOCK_FIELD" => "PREVIEW_TEXT",
        "CATEGORY_DOCS_IBLOCK_FIELD" => "FORM_DOCS",
        "CATEGORY_ACCEPT_VALIDATION_MESSAGE" => "Обязательное поле",
        "CATEGORY_ACCEPT_IBLOCK_FIELD" => "FORM_ACCEPT"
    ),
    false
);?> 

 <?*/
        $APPLICATION->IncludeComponent(
            "bitrix:form.result.new",
            "origami_contacts_callback_manager",
            Array(
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "A",
                "CHAIN_ITEM_LINK" => "",
                "CHAIN_ITEM_TEXT" => "",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO",
                "EDIT_URL" => "",
                "IGNORE_CUSTOM_TEMPLATE" => "N",
                "LIST_URL" => "",
                "SEF_MODE" => "N",
                "SUCCESS_URL" => "",
                "USE_EXTENDED_ERRORS" => "N",
                "VARIABLE_ALIASES" => Array(
                    "RESULT_ID" => "RESULT_ID",
                    "WEB_FORM_ID" => "WEB_FORM_ID"
                ),
                "WEB_FORM_ID" => 3
            )
        );
     
     ?>
     <script>
         $( document ).ready(function() {




var inputs = document.querySelectorAll('.inputfile');
Array.prototype.forEach.call(inputs, function(input){
  var label  = $(input).next(),
      labelVal = label.innerHTML;
  input.addEventListener('change', function(e){
      console.log('changeFile')
    var fileName = '';
    if( this.files && this.files.length > 1 )
      fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
    else
      fileName = e.target.value.split( '\\' ).pop();
    if( fileName ){
      console.log(fileName)

      $( label ).html(fileName);
    }
    else
      {
         $( label ).html(labelVal);
      }
  });
});

});



     </script>