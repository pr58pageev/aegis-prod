<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;
use Bitrix\Main\Loader;
use Sotbit\Origami\Helper\Config;
use Bitrix\Main\Localization\Loc;

$moduleLoaded = false;

try
{
	$moduleLoaded = Loader::includeModule('sotbit.origami');
}
catch (\Bitrix\Main\LoaderException $e)
{
	echo $e->getMessage();
}

if (!$moduleLoaded || \SotbitOrigami::isDemoEnd()) {
    echo Loc::getMessage('sotbit.origami_DEMO_END',['#MODULE#' => 'sotbit.origami']);
    die;
}

$theme = new \Sotbit\Origami\Front\Theme();
?>
<!DOCTYPE html>

<html lang="<?=LANGUAGE_ID?>">
<head>
    <?php
    $APPLICATION->ShowHead();
    Asset::getInstance()->addString("<meta name='viewport' content='width=device-width, initial-scale=1.0'>");
    Asset::getInstance()->addString("<meta name='author' content='sotbit.ru'>");

	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/vendor/jquery.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/script.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/vendor/jquery-ui.min.js");
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/plugin/OwlCarousel2-2.3.4/owl.carousel.min.js");

    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/plugin/tether/script.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/plugin/bootstrap/bootstrap.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/plugin/mmenu/jquery.mmenu.all.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/plugin/ZoomIt/zoomit.jquery.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/plugin/PhotoSwipe/photoswipe.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/plugin/PhotoSwipe/photoswipe-ui-default.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/plugin/weel/script.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/plugin/fix-block/script.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/script-found-error.js");
//    scrollbar
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/perfect-scrollbar.js");
//    end scrollbar
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/plugin/slick-1.8.1/slick.js");
//  for svg
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/plugin/svg4everybody/svg4everybody.js");
//  for phone validation
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/jquery.inputmask.js");


    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/custom/bundle.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/custom/temp_script.js");
    ?>

	<link rel="shortcut icon" href="<?=Config::getFavicon(SITE_ID)?>" />

    <?php
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/style-found-error.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/plugin/bootstrap/bootstrap.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/plugin/fontawesome/css/all.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/plugin/OwlCarousel2-2.3.4/owl.carousel.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/plugin/OwlCarousel2-2.3.4/owl.theme.default.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/plugin/slick-1.8.1/slick.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/plugin/ZoomIt/zoomIt.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/plugin/PhotoSwipe/photoswipe.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/plugin/PhotoSwipe/default-skin/default-skin.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/perfect-scrolbar.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/plugin/weel/style.css");
    //icons
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/style-icons.css");
    //Include jQuery.mmenu .css files
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/plugin/mmenu/jquery.mmenu.all.css");
    // CSS
    Asset::getInstance()->addCss($theme->getTheme() . "/style.css");
    Asset::getInstance()->addCss($theme->getTheme() . "/style-media.css");
    // style-menu
    Asset::getInstance()->addCss($theme->getTheme() . "/style-menu.css");
    Asset::getInstance()->addCss($theme->getTheme() . "/style-menu-media.css");
    // style-loader
    Asset::getInstance()->addCss($theme->getTheme() . "/style-loader.css");
    // style-footer
    Asset::getInstance()->addCss($theme->getTheme() . "/style-feedback_block.css");
    Asset::getInstance()->addCss($theme->getTheme() . "/style-feedback_block-media.css");
    Asset::getInstance()->addCss($theme->getTheme() . "/style-order_block.css");
    Asset::getInstance()->addCss($theme->getTheme() . "/style-order_block-media.css");
    // filter
    Asset::getInstance()->addCss($theme->getTheme() . "/style-filter.css");
    //color
    Asset::getInstance()->addCss($theme->getTheme() . "/color.css");
    Asset::getInstance()->addCss($theme->getTheme() . "/size.css");
    Asset::getInstance()->addCss($theme->getTheme() . "/custom.css");

    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/custom/bundle.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/custom/temp_styles.css");


    Asset::getInstance()->addCss(SITE_DIR . "include/sotbit_origami/files/custom_style.css");
    $page = $APPLICATION->GetCurPage();
     Asset::getInstance()->addJs(SITE_DIR . "local/temp/bundle.js");

       Asset::getInstance()->addCss(SITE_DIR . "local/temp/main.css");
        
          Asset::getInstance()->addJs(SITE_DIR . "local/temp/jquery.maskedinput.min.js");

    if($page=='/personal/order/make/'):
          
    endif;

    $Files = new \Sotbit\Origami\Helper\Files();
    $Files->showCustomCss();
    $Files->showCustomJs();
    ?>
    <title><?$APPLICATION->ShowTitle()?></title>
</head>
<body>
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
     style="position: absolute; width: 0; height: 0">
  <symbol viewBox="0 0 24 24" id="edit">
    <path d="M12 20H21" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path
        d="M16.5 3.5C16.8978 3.10217 17.4374 2.87868 18 2.87868C18.2786 2.87868 18.5544 2.93355 18.8118 3.04015C19.0692 3.14676 19.303 3.30301 19.5 3.5C19.697 3.69698 19.8532 3.93083 19.9598 4.1882C20.0665 4.44557 20.1213 4.72142 20.1213 5C20.1213 5.27857 20.0665 5.55442 19.9598 5.81179C19.8532 6.06916 19.697 6.30301 19.5 6.5L7 19L3 20L4 16L16.5 3.5Z"
        fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
  </symbol>

  <symbol viewBox="0 0 24 24" fill="none" id="trash">
    <path d="M3 6H5H21" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path
        d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z"
        fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M10 11V17" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M14 11V17" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
  </symbol>

  <symbol viewBox="0 0 30 30" id="plus-circle">
    <path
        d="M15 29.1667C22.8241 29.1667 29.1667 22.824 29.1667 15C29.1667 7.17598 22.8241 0.833344 15 0.833344C7.17601 0.833344 0.833374 7.17598 0.833374 15C0.833374 22.824 7.17601 29.1667 15 29.1667Z"
        fill="none" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M15 9.33334V20.6667" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M9.33337 15H20.6667" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
  </symbol>

  <symbol viewBox="0 0 12 12" id="delete">
    <path d="M10.9091 1.09088L1.09094 10.9091" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M1.09094 1.09088L10.9091 10.9091" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
  </symbol>
</svg>
    <?

    if (Config::get('LAZY_LOAD') == "Y") {
    ?>
        <script>
            window.lazyLoadOn();
        </script>
    <?
    }
    ?>
    <?
    //$Files->showMetrics();
    $APPLICATION->ShowPanel();

    if(Config::get('FRONT_CHANGE') == 'Y') {
        $APPLICATION->IncludeComponent('sotbit:origami.theme','',[]);
    }


    include $_SERVER['DOCUMENT_ROOT'].'/local/templates/sotbit_origami_suppliers/theme/headers/2/content.php';    //<======== hard

    if (file_exists($_SERVER['DOCUMENT_ROOT'].'/local/templates/sotbit_origami_suppliers/theme/headers/2/style.css')) {
        Asset::getInstance()->addCss('/local/templates/sotbit_origami_suppliers/theme/headers/2/style.css');
    }

    $page = \SotbitOrigami::getCurrentPage();
    $page2 = explode('/',$page);
     

       $needF = \SotbitOrigami::needShowFullWidth($page);
       $needShP = \SotbitOrigami::needShowSide($page);


//       if($page2[1]=='news' && !empty($page2[2])){
//        $needF = true;
//        $needShP = false;
//       }

if($APPLICATION->GetCurPage()=='/news/')
    $needShP = false;



if($APPLICATION->GetCurPage()=='/o-kompanii/')
    $needShP = false;

if(!$needF) {
    if($needShP) {
    ?>
        <div class="puzzle_block block_main_left_menu main-container <?=\SotbitOrigami::getSide($page)?>">
            <div class="block_main_left_menu__container mo-main asd">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR."include/sotbit_origami/left_block.php"
                    ),
                    false,
                    array('HIDE_ICONS' => 'Y')
                );

                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "sect",
                        "AREA_FILE_SUFFIX" => "sidebar"
                    ),
                    false,
                    array('HIDE_ICONS' => 'Y')
                );
                ?>
            </div>
            <div class="block_main_left_menu__content active ">
    <?} else {
        ?>
        <div class="puzzle_block no-padding main-container">
            <div class="block_main_left_menu__content ">
        <?
    }

    if(\SotbitOrigami::showBreadCrumbs($page)) {
        $APPLICATION->IncludeComponent('bitrix:breadcrumb', 'origami_default',
            [
                "START_FROM" => "0",
                "PATH"       => "",
                "SITE_ID"    => "-",
            ], false, [
                'HIDE_ICONS' => 'N',
            ]);
        ?>
        <h1>
        <?$APPLICATION->ShowTitle(false);?>
        </h1>
    <?php
    }
}
?>
<?
$APPLICATION->IncludeComponent(
    "bitrix:menu",
    "suppliers",
    Array(
        "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
        "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
        "COMPOSITE_FRAME_MODE" => "A",	// Голосование шаблона компонента по умолчанию
        "COMPOSITE_FRAME_TYPE" => "AUTO",	// Содержимое компонента
        "DELAY" => "N",	// Откладывать выполнение шаблона меню
        "MAX_LEVEL" => "1",	// Уровень вложенности меню
        "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
            0 => "",
        ),
        "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
        "MENU_CACHE_TYPE" => "N",	// Тип кеширования
        "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
        "ROOT_MENU_TYPE" => "supplier_menu",	// Тип меню для первого уровня
        "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
    ),
    false
);
?>