<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

define("NEED_AUTH", true);

global $APPLICATION;
global $USER;
use Bitrix\Main\Localization\Loc;
use Sotbit\Origami\Helper\Config;
use Sotbit\Origami\Config\Option;
use Bitrix\Main\Page\Asset;

if (!$USER->IsAuthorized()) {
    include_once "auth_header.php";
    return;
}
$stateLeftPanel = CUserOptions::GetOption("intranet", "StateLeftPanel", "Y");

if (\Bitrix\Main\Loader::includeModule('sale')) {
    $cntBasketItems = CSaleBasket::GetList(
        array(),
        array(
            "FUSER_ID" => CSaleBasket::GetBasketUserID(),
            "LID" => SITE_ID,
            "ORDER_ID" => "NULL",
            "!DELAY" => "Y",
            "CAN_BUY" => 'Y'
        ),
        array()
    );
}

$methodIstall = Option::get('sotbit.b2bcabinet', 'method_install', '', SITE_ID) == 'AS_TEMPLATE' ? SITE_DIR . 'b2bcabinet/' : SITE_DIR;

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?$APPLICATION->ShowTitle()?></title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">

    <?
    CJSCore::Init();
    $APPLICATION->ShowHead();
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/icons/icomoon/styles.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/bootstrap.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/bootstrap_limitless.min.css");
  //  Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/layout.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/components.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/colors.min.css");



    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/main/jquery.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/main/bootstrap.bundle.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/plugins/loaders/blockui.min.js");

        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/jquery.inputmask.js");



    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/plugins/visualization/d3/d3.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/plugins/visualization/d3/d3_tooltip.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/plugins/forms/styling/switchery.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/plugins/forms/selects/bootstrap_multiselect.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/plugins/ui/moment/moment.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/plugins/pickers/daterangepicker.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/main/app.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/plugins/pickers/anytime.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/plugins/pickers/pickadate/picker.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/plugins/pickers/pickadate/picker.date.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/plugins/pickers/pickadate/picker.time.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/plugins/pickers/pickadate/legacy.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/plugins/pickers/pickadate/picker_date.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/plugins/forms/styling/switch.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/pages/form_checkboxes_radios.js");

  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/plugins/forms/selects/select2.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/plugins/forms/styling/uniform.min.js");
   Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/plugins/forms/styling/form_layouts.js");

    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/plugins/loaders/progressbar.min.js");

    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/pages/form_select2.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/pages/uniform_init.js");

 $page = $APPLICATION->GetCurPage();

Asset::getInstance()->addCss("/include/b2b_style.css");

   if( $page!='/b2bcabinet/change_order/'):
       
  endif;
 Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets_new/js/bundle.js");

Asset::getInstance()->addCss("/include/b2b_style_new.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets_new/main.css");

   

    
    if($page=='/b2bcabinet/orders/make/' || $page=='/b2bcabinet/orders/make/make.php' || $page=='/b2bcabinet/change_order/'):

     

          
       Asset::getInstance()->addJs(SITE_DIR . "local/temp/bundle.js");

       Asset::getInstance()->addCss(SITE_DIR . "local/temp/main.css");
        Asset::getInstance()->addJs(SITE_DIR . "local/temp/jquery.maskedinput.min.js");
      endif;

    ?>

    <script type="text/javascript">
        window.dataLayer = window.dataLayer || [];
    </script>

    <!-- Yandex.Metrika counter -->
    <script >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(87661969, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true,
            ecommerce:"dataLayer"
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/87661969" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
    
</head>

<body>
<? $APPLICATION->ShowPanel() ?>



 <!--  -->
    <!-- header -->
<header class="header">
  <!-- wrapper -->
  <div class="header-wrapper">
    <!-- logo -->
    <div class="header-logo">
      <a href="/" class="header-logo__link">
        <img src="<?=SITE_TEMPLATE_PATH?>/assets_new/images/logo.svg" alt="Эгида-отель" class="header-logo__img" />
      </a>
      <a href="/" class="header-logo__link header-logo__link--mobile">
        <img src="<?=SITE_TEMPLATE_PATH?>/assets_new/images/logo-s.svg" alt="Эгида-отель" class="header-logo__img" />
      </a>
    </div>
    <!-- ./ End of logo -->
    <!-- nav -->
    <div class="header-nav">
      <div class="container-container">
        <div class="header-nav__wrapper">
          <ul class="header-nav__list">
            <li class="header-nav__item header-nav__email">
              <svg class="header-nav__item-icon"><use xlink:href="#mail"></use></svg>
               <?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR."include/sotbit_origami/contacts_email2.php")
                            );
                            ?>

              
             
                <a type="button" class="header-nav__item-link" onclick="callbackMail('/', 's1', this)">Отправить заявку</a>

            </li>
            <li class="header-nav__item header-nav__contact">
              <div class="header-nav__dropdown-button">
                <svg class="header-nav__item-icon"><use xlink:href="#phone"></use></svg>
                <svg class="header-nav__item-icon"><use xlink:href="#dropdown-big"></use></svg>
                  <?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR."include/sotbit_origami/contacts_phone2.php")
                            );
                            ?>

                
              </div>
              <span class="header-nav__item-link" onclick="callbackPhone('<?=SITE_DIR?>', '<?=SITE_ID?>', this)">Заказать звонок</span>

              <div class="header-nav__dropdown">
                <div class="header-nav__dropdown-item">
                  <svg><use xlink:href="#phone"></use></svg>
                     <?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR."include/sotbit_origami/contacts_phone3.php")
                            );
                            ?>
                  
                </div>
                <div class="header-nav__dropdown-item">
                  <svg><use xlink:href="#time"></use></svg>
                  <p>  <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR."include/sotbit_origami/contacts_worktime.php")
                                );
                                ?>
                                	
                                </p>
                </div>
                <div class="header-nav__dropdown-item">
                  <svg><use xlink:href="#mail"></use></svg>
                    <?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR."include/sotbit_origami/contacts_email3.php")
                            );
                            ?>
                  
                </div>
                <div class="header-nav__dropdown-item">
                  <svg><use xlink:href="#pin"></use></svg>
                  <p> <?
                                $APPLICATION->IncludeComponent("bitrix:main.include", "", [
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH"           =>
                                        SITE_DIR."include/sotbit_origami/contacts_address.php",
                                ]);
                                ?> </p>
                </div>
                <p class="button" onclick="callbackPhone('<?=SITE_DIR?>', '<?=SITE_ID?>', this)"> Заказать звонок </p>
              </div>
            </li>
            <li class="header-nav__item header-nav__city">
              <div class="address_header">
                <svg class="header-nav__item-icon"><use xlink:href="#pin"></use></svg>
                <p class="header-nav__item-title"><?
                                $APPLICATION->IncludeComponent("bitrix:main.include", "", [
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH"           =>
                                        SITE_DIR."include/sotbit_origami/contacts_address.php",
                                ]);
                                ?></p>
                
                     

                 <?
                                $APPLICATION->IncludeComponent("bitrix:main.include", "", [
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH"           =>
                                        SITE_DIR."include/shema_link.php",
                                ]);
                                ?>

              </div>
            </li>
            <li class="header-nav__item header-nav__personal">

            	<?if($USER->IsAuthorized()):?>
            	 	 <a href="/b2bcabinet/?logout=yes" class="header-nav__item-title">
              			  <svg class="header-nav__item-icon"><use xlink:href="#login"></use></svg>
             			  <?=Loc::getMessage('INNER')?>
             		 </a>
            	 	 <p class="header-nav__item-link">
              			 <?php 
						global $USER;
						$email = $USER->GetEmail();
						function internoetics_mb_strimwidth($string, $start = 0, $width = 120, $trimmarker = '...') {
						$len = strlen(trim($string));
						$newstring = ( ($len > $width) && ($len != 0) ) ? rtrim(mb_strimwidth($string, $start, $width - strlen($trimmarker))) . $trimmarker : $string;
						return $newstring;
						}

						$email =  internoetics_mb_strimwidth($email, 0, 20, $trimmarker = '...');
						?>  
						<?=$email?>

              			</p>

            	<?else:?>

		              <? $pageLogin = $APPLICATION->GetCurPageParam("AUTH_SHOW=Y", array("AUTH_SHOW"));  ?>
		                    <a href="<?=$pageLogin?>" class="header-nav__item-title">
		                <svg class="header-nav__item-icon"><use xlink:href="#login"></use></svg>
		                Авторизация
		              </a>
		              <p class="header-nav__item-link">Личный кабинет</p>

              	<?endif;?>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- ./ End of nav -->
  </div>
  <!-- ./ End of wrapper -->
</header>
<!-- ./ End of header -->


<?


 
  

  ?>
    <!--  -->
    <div class="wrapper">
      <!--  -->
      <!-- aside -->
<aside class="aside">
  <!-- aside-hamburger -->
  <div class="aside-hamburger j_toggleMenu">
    <div class="aside-hamburger__icon">
      <div class="aside-hamburger__item"></div>
      <div class="aside-hamburger__item"></div>
      <div class="aside-hamburger__item"></div>
    </div>
  </div>
  <!-- ./ End of aside-hamburger -->
  <!-- wrapper -->
  <div class="aside-wrapper">

<h4 class="aside-title">

    <?
     $string_date = date('d.m.Y');
  $today_date = date('d.m.Y');
  $time =  date("H");
 $date = checkDateNext2(92,$string_date,$time,'00',$today_date);
 $date = explode('.',$date);

 $new_deta = $date[1].'.'.$date[0].'.'.$date[2];

  ?>
  <?$APPLICATION->ShowTitle()?></h4>
  				 <?
                $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "b2bcabinet_new",
                    array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "b2bcabinet_menu_inner",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "3",
                        "MENU_CACHE_GET_VARS" => array(),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "b2bcabinet_menu",
                        "USE_EXT" => "Y",
                        "COMPONENT_TEMPLATE" => "b2bcabinet_new",
                        "MENU_THEME" => "blue",
                        "DISPLAY_USER_NANE" => "N",
                        "CACHE_SELECTED_ITEMS" => false,
                    ),
                    false
                );
                ?>

    
    <?
    if( $page!='/b2bcabinet/change_order/'):?>

    <!-- delivery -->
    <div class="aside-delivery">
      <h4 class="aside-title aside-title--orange">Ближайшая доставка</h4>
      <!-- datepicker -->
      <div class="datepicker-new">
        <input type="hidden" class="j_datepicker-new" data-highlight-days="<?=$new_deta?>" />
      </div>
      <!-- ./ End of datepicker -->
    </div>
    <!-- ./ End of delivery -->
    <?
       
  endif;?>
  </div>
  <!-- ./ End of wrapper -->
</aside>
<!-- ./ End of aside -->

      <!--  -->
      <div class="content">
        <main>