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

<script src="//code-eu1.jivosite.com/widget/yfqH76gsDp" async></script>
    <?php
    global $APPLICATION;
    
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
    //pre($_SERVER['DOCUMENT_ROOT'].'/'.\SotbitOrigami::headersDir.'/'.Config::get('HEADER').'/content.php');
    include $_SERVER['DOCUMENT_ROOT'].'/'.\SotbitOrigami::headersDir.'/'.Config::get('HEADER').'/content.php';    //<======== hard

    if (file_exists($_SERVER['DOCUMENT_ROOT'].'/'.\SotbitOrigami::headersDir.'/'.Config::get('HEADER').'/style.css')) {
        Asset::getInstance()->addCss(\SotbitOrigami::headersDir.'/'.Config::get('HEADER').'/style.css');
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
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR."include/sotbit_origami/left_block.php"
                        ),
                        false,
                        Array('HIDE_ICONS' => 'Y')
                    );

                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "sect",
                            "AREA_FILE_SUFFIX" => "sidebar"
                        ),
                        false,
                        Array('HIDE_ICONS' => 'Y')
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
