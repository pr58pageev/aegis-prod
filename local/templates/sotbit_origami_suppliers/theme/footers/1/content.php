<?
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Sotbit\Origami\Helper\Config;
global $APPLICATION;

$useRegion = (Config::get('USE_REGIONS') == 'Y') ? true : false;






?>


<div class="pre-footer-block" style="<?if($page = $APPLICATION->GetCurPage()!='/'){echo 'display:none;';}?>">
    <?/* $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/sotbit_origami/contact_page_block/contacts_info_new/contacts_info_new_main_page.php"));
     

*/?>
<?
if (Config::get('LEAD_CAPTURE_FORM') == 'Y')
{
    if($APPLICATION->GetCurPage(false) == '/')
    {

?>



<div class="puzzle_block">
     <?   $APPLICATION->IncludeComponent(
	"bitrix:form.result.new", 
	"origami_webform_2", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"EDIT_URL" => "",
		"AJAX_MODE" => "Y",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"LIST_URL" => "",
		"SEF_MODE" => "N",
		"SUCCESS_URL" => "",
		"USE_EXTENDED_ERRORS" => "N",
		"WEB_FORM_ID" => "2",
		"COMPONENT_TEMPLATE" => "origami_webform_2",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);
?>
</div>
<?
    }
}


?>



       
<?/* <div class="slam-absolute">
<?$APPLICATION->IncludeComponent("slam:easyform", "header_zayavka_not_map", Array(
	"CATEGORY_ACCEPT_TITLE" => "Согласие на обработку данных",	// Название
		"CATEGORY_ACCEPT_TYPE" => "accept",	// Тип поля
		"CATEGORY_ACCEPT_VALIDATION_ADDITIONALLY_MESSAGE" => "",	// Дополнительные параметры валидации
		"CATEGORY_ACCEPT_VALUE" => "Согласен на обработку <a href=\"#\" target=\"_blank\">персональныx данных</a>",	// Значение
		"CATEGORY_DOCS_DROPZONE_INCLUDE" => "Y",	// Подключить загрузчик DragnDrop
		"CATEGORY_DOCS_FILE_EXTENSION" => "doc, docx, xls, xlsx, txt, rtf, pdf, png, jpeg, jpg, gif",	// Допустимые расширения файла (через запятую)
		"CATEGORY_DOCS_FILE_MAX_SIZE" => "20971520",	// Максимальный размер файла (в Kb)
		"CATEGORY_DOCS_TITLE" => "Прикрепить заявку",	// Название
		"CATEGORY_DOCS_TYPE" => "file",	// Тип поля
		"CATEGORY_EMAIL_PLACEHOLDER" => "Ваш E-mail",	// Placeholder
		"CATEGORY_EMAIL_TITLE" => "Ваш E-mail",	// Название
		"CATEGORY_EMAIL_TYPE" => "email",	// Тип поля
		"CATEGORY_EMAIL_VALIDATION_ADDITIONALLY_MESSAGE" => "data-bv-emailaddress-message=\"E-mail введен некорректно\"",	// Дополнительные параметры валидации
		"CATEGORY_EMAIL_VALIDATION_MESSAGE" => "Обязательное поле",	// Текст при ошибке
		"CATEGORY_EMAIL_VALUE" => "",	// Значение
		"CATEGORY_MESSAGE_PLACEHOLDER" => "Сообщение для менеджера",	// Placeholder
		"CATEGORY_MESSAGE_TITLE" => "Сообщение для менеджера",	// Название
		"CATEGORY_MESSAGE_TYPE" => "textarea",	// Тип поля
		"CATEGORY_MESSAGE_VALIDATION_ADDITIONALLY_MESSAGE" => "",	// Дополнительные параметры валидации
		"CATEGORY_MESSAGE_VALUE" => "",	// Значение
		"CATEGORY_PHONE_INPUTMASK" => "N",	// Включить маску
		"CATEGORY_PHONE_INPUTMASK_TEMP" => "+7 (999) 999-9999",	// Шаблон маски
		"CATEGORY_PHONE_PLACEHOLDER" => "Мобильный телефон",	// Placeholder
		"CATEGORY_PHONE_TITLE" => "Мобильный телефон",	// Название
		"CATEGORY_PHONE_TYPE" => "tel",	// Тип поля
		"CATEGORY_PHONE_VALIDATION_ADDITIONALLY_MESSAGE" => "",	// Дополнительные параметры валидации
		"CATEGORY_PHONE_VALUE" => "",	// Значение
		"CATEGORY_TITLE_PLACEHOLDER" => "Ваше имя",	// Placeholder
		"CATEGORY_TITLE_TITLE" => "Ваше имя",	// Название
		"CATEGORY_TITLE_TYPE" => "text",	// Тип поля
		"CATEGORY_TITLE_VALIDATION_ADDITIONALLY_MESSAGE" => "",	// Дополнительные параметры валидации
		"CATEGORY_TITLE_VALIDATION_MESSAGE" => "Обязательное поле",	// Текст при ошибке
		"CATEGORY_TITLE_VALUE" => "",	// Значение
		"CREATE_SEND_MAIL" => "",	// Создание нового почтового шаблона
		"DISPLAY_FIELDS" => array(	// Поля (символьный код)
			0 => "TITLE",
			1 => "EMAIL",
			2 => "PHONE",
			3 => "MESSAGE",
			4 => "DOCS",
			5 => "ACCEPT",
			6 => "",
		),
		"EMAIL_BCC" => "",	// Скрытая копия
		"EMAIL_FILE" => "N",	// Прикладывать файлы к письму
		"EMAIL_SEND_FROM" => "N",	// Отправлять письмо отправителю
		"EMAIL_TO" => "",	// E-mail, на который будет отправлено письмо (по умолчанию используется из настроек модуля)
		"ENABLE_SEND_MAIL" => "Y",	// Включить отправку писем
		"ERROR_TEXT" => "Произошла ошибка. Сообщение не отправлено.",	// Сообщение об ошибке
		"EVENT_MESSAGE_ID" => array(	// Шаблон письма
			0 => "90",
		),
		"FIELDS_ORDER" => "TITLE,EMAIL,PHONE,MESSAGE",	// Расположение полей формы
		"FORM_AUTOCOMPLETE" => "N",	// Автокомплит значений полей формы
		"FORM_ID" => "FORM_02",	// ID формы
		"FORM_NAME" => "Отправьте заявку",	// Название формы
		"FORM_SUBMIT_VALUE" => "Отправить заявку",	// Название кнопки
		"FORM_SUBMIT_VARNING" => "Нажимая на кнопку \"#BUTTON#\", вы даете согласие на обработку <a target=\"_blank\" href=\"#\">персональных данных</a>",
		"HIDE_ASTERISK" => "N",	// Убрать двоеточие и звездочки
		"HIDE_FIELD_NAME" => "Y",	// Скрывать названия полей  формы
		"HIDE_FORMVALIDATION_TEXT" => "N",	// Скрыть сообщения об ошибках (красная обводка полей останется)
		"INCLUDE_BOOTSRAP_JS" => "N",	// Подключить библиотеку JS Bootstrap Validators
		"MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы Отправить заявку",	// Тема сообщения для администратора
		"NAME_MODAL_BUTTON" => "Отправить заявку",
		"OK_TEXT" => "Ваше сообщение отправлено. ",	// Сообщение об успешной отправке
		"REQUIRED_FIELDS" => array(	// Обязательные поля
			0 => "TITLE",
			1 => "EMAIL",
			2 => "ACCEPT",
		),
		"SEND_AJAX" => "Y",	// Отправлять форму при помощи AJAX?
		"SHOW_MODAL" => "N",	// Показывать результат в модальном окне
		"TITLE_SHOW_MODAL" => "Спасибо!",
		"USE_BOOTSRAP_CSS" => "Y",	// Подключить стандартные стили Bootstrap 3
		"USE_BOOTSRAP_JS" => "N",	// Подключить стандартный JS Bootstrap 3
		"USE_CAPTCHA" => "N",	// Использовать капчу reCAPTCHA
		"USE_FORMVALIDATION_JS" => "Y",	// Проверять поля через JS Bootstrap Validators
		"USE_IBLOCK_WRITE" => "N",	// Записывать результаты в ИБ
		"USE_JQUERY" => "N",	// Подключить jQuery-1.12.4
		"USE_MODULE_VARNING" => "Y",	// Использовать сообщение из настроек модуля
		"WIDTH_FORM" => "600px",	// Ширина формы
		"_CALLBACKS" => "",	// Название функции при успешной отправки ( "_callbacks" )
		"COMPONENT_TEMPLATE" => "main_page_zayavka"
	),
	false
);?>
        </div>

*/?>

</div>

<div class="footer-block">


    <div class="puzzle_block main-container">
        <div class="row footer-block__menu">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
                <p class="footer-block__menu_title fonts__middle_text">
                    <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/sotbit_origami/catalog_title.php"));?>
                </p>
                <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"sotbit_bottom_menu", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "36000000",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "left2",
		"USE_EXT" => "Y",
		"COMPONENT_TEMPLATE" => "sotbit_bottom_menu",
		"CHILD_MENU_TYPE" => "sotbit_left",
		"MAX_ITEMS" => "7"
	),
	false
);?>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
                <p class="footer-block__menu_title fonts__middle_text">
                    <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/sotbit_origami/help_title.php"));?>
                </p>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "sotbit_bottom_menu",
                    array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "COMPOSITE_FRAME_MODE" => "A",
                        "COMPOSITE_FRAME_TYPE" => "AUTO",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_GET_VARS" => array(
                        ),
                        "MENU_CACHE_TIME" => "36000000",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "sotbit_bottom1",
                        "USE_EXT" => "N",
                        "COMPONENT_TEMPLATE" => "sotbit_bottom_menu",
                        "CHILD_MENU_TYPE" => "sotbit_left",
                        "MAX_ITEMS" => ""
                    ),
                    false
                );?>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
                <p class="footer-block__menu_title fonts__middle_text">
                    <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/sotbit_origami/about_title.php"));?>
                </p>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "sotbit_bottom_menu",
                    array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "COMPOSITE_FRAME_MODE" => "A",
                        "COMPOSITE_FRAME_TYPE" => "AUTO",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_GET_VARS" => array(
                        ),
                        "MENU_CACHE_TIME" => "36000000",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "sotbit_bottom2",
                        "USE_EXT" => "N",
                        "COMPONENT_TEMPLATE" => "sotbit_bottom_menu",
                        "CHILD_MENU_TYPE" => "sotbit_left",
                        "MAX_ITEMS" => ""
                    ),
                    false
                );?>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
                <div class="footer-block__contact_block">
                    <p class="footer-block__contact_block_title">
                        <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/sotbit_origami/contacts_title.php"));?>
                    </p>
                    <div class="footer-block__contact_block_content">
                        <div class="footer-block__contact_block_content_item content_item--point ">

                            <div class="footer-block__contact_block_content_item content_item--phone">
                            <svg class="footer-block__contact_block_phone-icon" width="14" height="14">
                                <use xlink:href="/local/templates/sotbit_origami/assets/img/sprite.svg#icon_phone_filled"></use>
                            </svg>
                            <div class="">
                                    <div class="main_element_wrapper">
                                        <?$APPLICATION->IncludeComponent("bitrix:main.include", "", [
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH"           => SITE_DIR
                                                ."include/sotbit_origami/contacts_phone.php",
                                        ]);?>
                                    </div>
                                </div>
                            <?/*
                            if(
                                \Bitrix\Main\Loader::includeModule('sotbit.regions') &&
                                \SotbitOrigami::isUseRegions() &&
                                !\SotbitOrigami::isDemoEnd() &&
                                is_dir($_SERVER['DOCUMENT_ROOT'].'/bitrix/components/sotbit/regions.data')
                            ):
                                $APPLICATION->IncludeComponent(
                                    "sotbit:regions.data",
                                    "origami_footer_phone",
                                    [
                                        "CACHE_TIME"    => "36000000",
                                        "CACHE_TYPE"    => "A",
                                        "REGION_FIELDS" => ['UF_PHONE'],
                                        "REGION_ID"     => $_SESSION['SOTBIT_REGIONS']['ID']
                                    ]
                                );
                            else:
                                ?>
                                <div class="footer-link__phone fonts__middle_comment">
                                    <div class="main_element_wrapper">
                                        <?$APPLICATION->IncludeComponent("bitrix:main.include", "", [
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH"           => SITE_DIR
                                                ."include/sotbit_origami/contacts_phone.php",
                                        ]);?>
                                    </div>
                                </div>
                            <?endif;*/?>
                        </div>









    <div class="footer-block__contact_block_content_item content_item--phone">
                            <svg class="footer-block__contact_block_phone-icon" width="14" height="14">
                                <use xlink:href="/local/templates/sotbit_origami/assets/img/sprite.svg#icon_phone_filled"></use>
                            </svg>
                          
                                <div class="footer-link__phone fonts__middle_comment">
                                    <div class="main_element_wrapper">
                                        <?$APPLICATION->IncludeComponent("bitrix:main.include", "", [
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH"           => SITE_DIR
                                                ."include/sotbit_origami/contacts_phone_2.php",
                                        ]);?>
                                    </div>
                                </div>
                         
                        </div>









                        <div class="footer-block__contact_block_content_item content_item--mail">
                            <svg class="footer-block__contact_block_mail-icon" width="14" height="14">
                                <use xlink:href="/local/templates/sotbit_origami/assets/img/sprite.svg#icon_mail_filled"></use>
                            </svg>
                            <?
                            if(
                                \Bitrix\Main\Loader::includeModule('sotbit.regions') &&
                                \SotbitOrigami::isUseRegions() &&
                                !\SotbitOrigami::isDemoEnd() &&
                                is_dir($_SERVER['DOCUMENT_ROOT'].'/bitrix/components/sotbit/regions.data')
                            ):
                                $APPLICATION->IncludeComponent(
                                    "sotbit:regions.data",
                                    "origami_footer_email",
                                    [
                                        "CACHE_TIME"    => "36000000",
                                        "CACHE_TYPE"    => "A",
                                        "REGION_FIELDS" => ['UF_EMAIL'],
                                        "REGION_ID"     => $_SESSION['SOTBIT_REGIONS']['ID']
                                    ]
                                );
                            else:
                                ?>
                                <div class="footer-link__email fonts__middle_comment">
                                    <div class="main_element_wrapper">
                                        <?$APPLICATION->IncludeComponent("bitrix:main.include", "", [
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH"           => SITE_DIR
                                                ."include/sotbit_origami/contacts_email.php",
                                        ]);?>
                                    </div>
                                </div>
                            <?endif;?>
                        </div>

                            <div class="footer-block__contact_block_content_item-wrapper">
                                <i class="point-item_icon" aria-hidden="true" style="display: none;"></i>
                                <div class="footer-block__contacts_icon">
                                    <svg class="footer-block__icon_send_filled" width="13" height="13">
                                        <use xlink:href="/local/templates/sotbit_origami/assets/img/sprite.svg#icon_send_filled"></use>
                                    </svg>
                                </div>
                                <?/*
                                if(
                                    \Bitrix\Main\Loader::includeModule('sotbit.regions') &&
                                    \SotbitOrigami::isUseRegions() &&
                                    !\SotbitOrigami::isDemoEnd() &&
                                    is_dir($_SERVER['DOCUMENT_ROOT'].'/bitrix/components/sotbit/regions.data')
                                ):
                                    $APPLICATION->IncludeComponent(
                                        "sotbit:regions.data",
                                        "origami_address",
                                        [
                                            "CACHE_TIME"    => "36000000",
                                            "CACHE_TYPE"    => "A",
                                            "REGION_FIELDS" => ['UF_ADDRESS'],
                                            "REGION_ID"     => $_SESSION['SOTBIT_REGIONS']['ID']
                                        ]
                                    );
                                else:?>
                                    <div class='container_menu__contact_item_wrapper'>
                                        <?
                                        $APPLICATION->IncludeComponent("bitrix:main.include", "", [
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH"           =>
                                                SITE_DIR."include/sotbit_origami/contacts_address.php",
                                        ]);
                                        ?>
                                    </div>
                                <?endif;*/?>
                                 <div class='container_menu__contact_item_wrapper'>
                                        <?
                                        $APPLICATION->IncludeComponent("bitrix:main.include", "", [
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH"           =>
                                                SITE_DIR."include/sotbit_origami/contacts_address.php",
                                        ]);
                                        ?>
                                </div>
                               
                            </div>



                            <div class="footer-block__contact_block_content_item-wrapper">
                               
                                <div class="footer-block__contacts_icon right_14px">
                                   <svg width="18" height="20" class="footer-icon">
                                <use xlink:href="/local/templates/sotbit_origami/assets/img/sprite.svg#icon_time"></use>
                            </svg>
                                </div>
                                
                                 <div class='container_menu__contact_item_wrapper'>
                                      <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR."include/time_work.php")
                                );
                                ?>
                                </div>
                          
                            </div>
                       

                        



                    </div>
                </div>
                <?if(Config::get('FOOTER_CALL') == 'Y'):?>
                    <span class="main_btn button_call sweep-to-right" onclick="callbackMail('<?=SITE_DIR?>', '<?=SITE_ID?>',this)">Отправить заявку</span>
                <?endif;?>
            </div>
        </div>
         <div class="row">
                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1">
                </div>
            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10" style="color: white;">

            </div>
              <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1">
                </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12">
               <?/*
                <div class="footer-block__follow">
                    <div class="footer-block__follow_title fonts__middle_text">
                        <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/sotbit_origami/subscribe_title.php"));?>
                    </div>
                    <?$APPLICATION->IncludeComponent(
    "bitrix:sender.subscribe",
    "sotbit_sender_subscribe",
    array(
        "AJAX_MODE" => "Y",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "A",
        "COMPOSITE_FRAME_MODE" => "A",
        "COMPOSITE_FRAME_TYPE" => "AUTO",
        "CONFIRMATION" => "N",
        "HIDE_MAILINGS" => "N",
        "SET_TITLE" => "N",
        "SHOW_HIDDEN" => "N",
        "USER_CONSENT" => "N",
        "USER_CONSENT_ID" => "0",
        "USER_CONSENT_IS_CHECKED" => "Y",
        "USER_CONSENT_IS_LOADED" => "N",
        "USE_PERSONALIZATION" => "Y",
        "COMPONENT_TEMPLATE" => "sotbit_sender_subscribe"
    ),
    false
);?>
                </div>
                */?>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12">
                <?/*<div class="footer-block__social">
                    <div class="footer-block__social_title fonts__middle_text">
                        <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/sotbit_origami/socnet_title.php"));?>
                    </div>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:eshop.socnet.links",
                        "sotbit_socnet_links",
                        Array(
                            "COMPOSITE_FRAME_MODE" => "A",
                            "COMPOSITE_FRAME_TYPE" => "AUTO",
                            "FACEBOOK" => \Sotbit\Origami\Helper\Config::get('FB'),
                            "VKONTAKTE" => \Sotbit\Origami\Helper\Config::get('VK'),
                            "TWITTER" => \Sotbit\Origami\Helper\Config::get('TW'),
                            "GOOGLE" => \Sotbit\Origami\Helper\Config::get('GOOGLE'),
                            "INSTAGRAM" => \Sotbit\Origami\Helper\Config::get('INST'),
                            "YOUTUBE" => \Sotbit\Origami\Helper\Config::get('YOUTUBE'),
                            "ODNOKLASSNIKI" => \Sotbit\Origami\Helper\Config::get('OK'),
                            "TELEGRAM" => \Sotbit\Origami\Helper\Config::get('TELEGA'),
                        )
                    );?>
                </div>*/?>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-12 col-12">
                <?/*
                <div class="footer-block__payment">
                    <div class="footer-block__payment_title fonts__middle_text">
                        <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/sotbit_origami/payment_title.php"));?>
                    </div>
                    <div class="footer-block__payment_img">
                        <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/sotbit_origami/payment_images.php"));?>
                    </div>
                </div>
                */?>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-12 col-12">
                <div id="bx-composite-banner">

                </div>
            </div>
        </div>
    </div>
    <div class="copy_text_block">
        <div class="puzzle_block no-padding">
            <div class="copy_text_block__content">
                <div class="copy_text_block__item fonts__middle_comment copy_text_block-dev">
                    <a class="copy_text_block__item_img" target="_blank" href="/">
                        <img src="/include/sotbit_origami/images/logo.svg" alt="" class="logo_footer">
                    </a>
                    <?$APPLICATION->IncludeComponent("bitrix:main.include", "", [
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH"           => SITE_DIR
                                                ."include/footer_text.php",
                                        ]);?>
                </div>
                <?/*
                <div class="copy_text_block__item fonts__middle_comment copy_text_block-company">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR."include/sotbit_origami/copyright.php"
                        )
                    );?>
                </div>
                */?>
            </div>
        </div>
    </div>
</div>


  <div class="wrap-popup-window mail_feedback" style="display: none;"> 
     <?php if($_REQUEST['ajax_form_zayavka']=='Y')
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
            Array(
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
                "VARIABLE_ALIASES" => Array(
                    "RESULT_ID" => "RESULT_ID",
                    "WEB_FORM_ID" => "WEB_FORM_ID"
                ),
                "WEB_FORM_ID" => 3
            )
        );
        ?>
                </div> 
            </div> 
<? if($_REQUEST['ajax_form_zayavka']=='Y')
die();
?>
        </div>


        <div class="wrap-popup-window mail_phone" style="display: none;"> 
              <?php if($_REQUEST['ajax_form_callback']=='Y')
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
              <? if($_REQUEST['ajax_form_callback']=='Y')
die();
?>
        </div>




