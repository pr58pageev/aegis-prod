<?php

use Sotbit\Origami\Helper\Config;
use \Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

Asset::getInstance()->addCss(SITE_DIR . "local/templates/.default/components/bitrix/news/sotbit_origami_promotions/style.css");

\Bitrix\Main\Loader::includeModule('currency');
CJSCore::Init(array('currency'));
$this->setFrameMode(true);
?>

<div class="promotion_detail">
    <?
    $ElementID = $APPLICATION->IncludeComponent(
        "bitrix:news.detail",
        "",
        [
            "DISPLAY_DATE"              => $arParams["DISPLAY_DATE"],
            "DISPLAY_NAME"              => $arParams["DISPLAY_NAME"],
            "DISPLAY_PICTURE"           => $arParams["DISPLAY_PICTURE"],
            "DISPLAY_PREVIEW_TEXT"      => $arParams["DISPLAY_PREVIEW_TEXT"],
            "IBLOCK_TYPE"               => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID"                 => $arParams["IBLOCK_ID"],
            "FIELD_CODE"                => $arParams["DETAIL_FIELD_CODE"],
            "PROPERTY_CODE"             => $arParams["DETAIL_PROPERTY_CODE"],
            "DETAIL_URL"                => $arResult["FOLDER"]
                .$arResult["URL_TEMPLATES"]["detail"],
            "SECTION_URL"               => $arResult["FOLDER"]
                .$arResult["URL_TEMPLATES"]["section"],
            "META_KEYWORDS"             => $arParams["META_KEYWORDS"],
            "META_DESCRIPTION"          => $arParams["META_DESCRIPTION"],
            "BROWSER_TITLE"             => $arParams["BROWSER_TITLE"],
            "SET_CANONICAL_URL"         => $arParams["DETAIL_SET_CANONICAL_URL"],
            "DISPLAY_PANEL"             => $arParams["DISPLAY_PANEL"],
            "SET_LAST_MODIFIED"         => $arParams["SET_LAST_MODIFIED"],
            "SET_TITLE"                 => $arParams["SET_TITLE"],
            "MESSAGE_404"               => $arParams["MESSAGE_404"],
            "SET_STATUS_404"            => $arParams["SET_STATUS_404"],
            "SHOW_404"                  => $arParams["SHOW_404"],
            "FILE_404"                  => $arParams["FILE_404"],
            "INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
            "ADD_SECTIONS_CHAIN"        => $arParams["ADD_SECTIONS_CHAIN"],
            "ACTIVE_DATE_FORMAT"        => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
            "CACHE_TYPE"                => $arParams["CACHE_TYPE"],
            "CACHE_TIME"                => $arParams["CACHE_TIME"],
            "CACHE_GROUPS"              => $arParams["CACHE_GROUPS"],
            "USE_PERMISSIONS"           => $arParams["USE_PERMISSIONS"],
            "GROUP_PERMISSIONS"         => $arParams["GROUP_PERMISSIONS"],
            "DISPLAY_TOP_PAGER"         => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
            "DISPLAY_BOTTOM_PAGER"      => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
            "PAGER_TITLE"               => $arParams["DETAIL_PAGER_TITLE"],
            "PAGER_SHOW_ALWAYS"         => "N",
            "PAGER_TEMPLATE"            => $arParams["DETAIL_PAGER_TEMPLATE"],
            "PAGER_SHOW_ALL"            => $arParams["DETAIL_PAGER_SHOW_ALL"],
            "CHECK_DATES"               => $arParams["CHECK_DATES"],
            "ELEMENT_ID"                => $arResult["VARIABLES"]["ELEMENT_ID"],
            "ELEMENT_CODE"              => $arResult["VARIABLES"]["ELEMENT_CODE"],
            "SECTION_ID"                => $arResult["VARIABLES"]["SECTION_ID"],
            "SECTION_CODE"              => $arResult["VARIABLES"]["SECTION_CODE"],
            "IBLOCK_URL"                => $arResult["FOLDER"]
                .$arResult["URL_TEMPLATES"]["news"],
            "USE_SHARE"                 => $arParams["USE_SHARE"],
            "SHARE_HIDE"                => $arParams["SHARE_HIDE"],
            "SHARE_TEMPLATE"            => $arParams["SHARE_TEMPLATE"],
            "SHARE_HANDLERS"            => $arParams["SHARE_HANDLERS"],
            "SHARE_SHORTEN_URL_LOGIN"   => $arParams["SHARE_SHORTEN_URL_LOGIN"],
            "SHARE_SHORTEN_URL_KEY"     => $arParams["SHARE_SHORTEN_URL_KEY"],
            "ADD_ELEMENT_CHAIN"         => (isset($arParams["ADD_ELEMENT_CHAIN"])
                ? $arParams["ADD_ELEMENT_CHAIN"] : ''),
            'STRICT_SECTION_CHECK'      => (isset($arParams['STRICT_SECTION_CHECK'])
                ? $arParams['STRICT_SECTION_CHECK'] : ''),
        ],
        $component
    );
    global $detailPromotion;


    if($detailPromotion) {


    ?>
    <div class="block_main_left_menu">
        <div class="block_main_left_menu__container mo-main">

            <div class="d-xs-none"></div>
            <?
            if (\SotbitOrigami::isUseRegions()) {
                if ($_SESSION["SOTBIT_REGIONS"]["PRICE_CODE"]) {
                    $arParams['~PRICE_CODE']
                        = $_SESSION["SOTBIT_REGIONS"]["PRICE_CODE"];
                }
                if ($_SESSION["SOTBIT_REGIONS"]["STORE"]) {
                    $arParams['STORES'] = $_SESSION["SOTBIT_REGIONS"]["STORE"];
                }
            }

            global $mySmartFilter;




            global $brandFilter;
            $useRegion = (Config::get('USE_REGIONS') == 'Y') ? true : false;

            global $brandFilter;
            $brandFilter = array(
                "=ID" => false
            );

            $iblockProd = \Sotbit\Origami\Helper\Config::get('IBLOCK_ID');
            $arSections = $arElements = $arSectionsInfo = array();

            $t = Config::get('FILTER_TEMPLATE');
            if($t)
            {
                $arParams['FILTER_VIEW_MODE'] = $t;
            }










            $arFilter = array("IBLOCK_ID" => $iblockProd, "ACTIVE" => "Y",  'PROPERTY_'.VIDIMOST_OFFER_PROP_CODE => 1);
            $arSelect = array("ID", "IBLOCK_SECTION_ID",'PROPERTY_MARKA');



            if ($useRegion && $_SESSION['SOTBIT_REGIONS']['ID'])
            {
                $arFilter[] = array(
                    "LOGIC" => "OR",
                    array("PROPERTY_REGIONS" => $_SESSION['SOTBIT_REGIONS']['ID']),
                    array("PROPERTY_REGIONS" => false)
                );
            }


            $arFilter['ID'] = $detailPromotion['ID'];




            $cacheId = md5(serialize($arFilter));

            $cache = \Bitrix\Main\Data\Cache::createInstance();

            if ($cache->initCache(0, $cacheId, '/sotbit.origami')) {
                $arData = $cache->getVars();
            } elseif ($cache->startDataCache()) {



                $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);



                while($arRes = $res->Fetch())
                {




                    $arSections[$arRes["IBLOCK_SECTION_ID"]] = $arRes["IBLOCK_SECTION_ID"];
                    $arElements[] = $arRes["ID"];
                }

                if($arElements)
                {
                    $arData["arElements"] = $arElements;
                    $arData["arSections"] = $arSections;
                }


                $cache->endDataCache($arData);
            }



            $arElements = $arData["arElements"];
            $arSections = $arData["arSections"];

            if($arElements)
                $brandFilter = array(
                    "ID" => $arElements,
                );




            $brandFilter['PROPERTY_'.VIDIMOST_OFFER_PROP_CODE] = 1;



            foreach ($brandFilter['ID'] as $key => $value) {
                $res = CIBlockElement::GetByID($value);
                if($arRes = $res->Fetch())
                {
                    //print_r($arRes);
                    $res = CIBlockSection::GetByID($arRes["IBLOCK_SECTION_ID"]);
                    if($arRes = $res->Fetch())
                    {
                        $arSectionsCustom[$arRes['ID']] = $arRes;
                        $arsectionIds[] = $arRes['ID'];
                    }
                }

            }

            $mySmartFilter = array(
                'ID' => $arElements,

            ); // Ваш фильтр для отбора элементов, используемых в умном фильтре



            if(!empty($arElements)){
                ?>
                <div class="bx_filter_section">
                    <div class="block_main_left_menu__title fonts__main_text active">
                        Категория товаров
                    </div>



                    <div id="man5"
                         class="decoration-dropdown j_dropdown j_naming"
                         data-dropdown-select
                    >

                        <select  data-dropdown-select-node
                                 class="decoration-dropdown__select category_custom_filter"
                                 name="category" id="category_custom" >
                            <?foreach ($arSectionsCustom as $key => $value) :?>
                                <option value="<?=$value['ID']?>" <?if($_GET['section']==$value['ID']){echo 'selected';$naid = $value;}?>><?=$value['NAME']?></option>
                            <?endforeach;?>

                            <option value="" <? if($naid==false):echo 'selected';endif;?> >Все категории</option>
                        </select>

                        <button
                                data-dropdown-target="#man5"
                                class="decoration-dropdown__button j_toggleDropdown"
                                type="button"
                        >
                            <? if($naid==false):?>
                                <span
                                        data-naming="Все категории"
                                        class="decoration-dropdown_title"
                                >
                           Все категории
                          </span>
                            <?else:?>
                                <span
                                        data-naming="<?=$naid['ID']?>"
                                        class="decoration-dropdown_title"
                                >
                           <?=$naid['NAME']?>
                          </span>

                            <?endif;?>



                            <svg class="decoration-dropdown__arrow">
                                <use xlink:href="#arrow"></use>
                            </svg>
                        </button>

                        <div
                                data-naming-triggers=""
                                class="decoration-dropdown-content" style="    z-index: 99;"
                        >
                            <div class="decoration-dropdown-content-scroller">

                                <label class="radio click_change_section">
                                    <input
                                            class="radio__input"
                                            type="radio"
                                            name="man5"
                                            value=""
                                    />
                                    <span class="radio__text">
                          Все категории
                              </span>
                                </label>
                                <?foreach ($arSectionsCustom as $key => $value) :?>


                                    <label class="radio click_change_section">
                                        <input
                                                class="radio__input"
                                                type="radio"
                                                name="man5"
                                                value="<?=$value['ID']?>"
                                        />
                                        <span class="radio__text">
                            <?=$value['NAME']?>
                              </span>
                                    </label>

                                <?endforeach?>

                            </div>
                        </div>
                    </div>

                </div>
                <?


                if($_GET['section']){
                    $arSections = $_GET['section'];
                    $mySmartFilter['SECTION_ID'] = $_GET['section'];
                }

                global $detailPromotion;
                $detailPromotion['PROPERTY_'.VIDIMOST_OFFER_PROP_CODE] = 1;
            


                if($arParams['FILTER_VIEW_MODE'] == "VERTICAL")
                    $APPLICATION->IncludeComponent(
                        "mediagroup:catalog.smart.filter",
                        "origami_vertical_new",
                        [
                            "IBLOCK_TYPE"         => Config::get("IBLOCK_TYPE"),
                            "IBLOCK_ID"           => Config::get("IBLOCK_ID"),
                            "SECTION_ID"          => '',
                            "SECTIONS_ID" => $arSections,
                            "ELEMENTS_ID" => $arElements,
                            "PREFILTER_NAME"=> 'mySmartFilter',
                            "FILTER_NAME"         => "detailPromotion",
                            "PRICE_CODE"          => $arParams["~PRICE_CODE"],
                            "CACHE_TYPE"          => $arParams["CACHE_TYPE"],
                            "CACHE_TIME"          => $arParams["CACHE_TIME"],
                            "CACHE_GROUPS"        => $arParams["CACHE_GROUPS"],
                            "SAVE_IN_SESSION"     => "N",
                            "FILTER_VIEW_MODE"    => "",
                            "XML_EXPORT"          => "Y",
                            "SECTION_TITLE"       => "NAME",
                            "SECTION_DESCRIPTION" => "DESCRIPTION",
                            'HIDE_NOT_AVAILABLE'  => 'L',
                            'CONVERT_CURRENCY'    => "N",
                            'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                            "SEF_MODE"            => "Y",
                            "INSTANT_RELOAD"      => "N",
                            "SHOW_ALL_WO_SECTION" => 'N',
                            "SEF_RULE" => $arResult["FOLDER"].$arResult['VARIABLES']['ELEMENT_CODE'].'/'.$arResult["URL_TEMPLATES"]["smart_filter"],
                            "SMART_FILTER_PATH"   => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
                            "SHOW_SECTIONS" => "Y",
                            'DISPLAY_ELEMENT_COUNT' => 'Y',
                            'FILTER_MODE' => Config::get('FILTER_MODE')
                        ],
                        $component,
                        ['HIDE_ICONS' => 'Y']
                    );


            }
            else{



                ?>
                <style>
                    .mobile_filter_btn{
                        display: none !important;
                    }
                </style><?

            }


            if (\Bitrix\Main\Loader::includeModule('sotbit.seometa')) {
                $APPLICATION->IncludeComponent(
                    'sotbit:seo.meta',
                    'origami_default',
                    [
                        'FILTER_NAME' => "brandFilter",
                        'SECTION_ID'  => '',
                        'CACHE_TYPE'  => $arParams['CACHE_TYPE'],
                        'CACHE_TIME'  => $arParams['CACHE_TIME'],
                    ]);
            }
            ?>
        </div>

        <div class="block_main_left_menu__content active no-padding">
            <h2>Товары по акции</h2>
            <?
            $intSectionID = $APPLICATION->IncludeComponent(
                "bitrix:catalog.section",
                "origami_default",
                [
                    "IBLOCK_ID"                 => Config::get("IBLOCK_ID"),
                    "IBLOCK_TYPE"               => Config::get("IBLOCK_TYPE"),
                    "ELEMENT_SORT_FIELD"        => "rand",
                    "ELEMENT_SORT_ORDER"        => "id",
                    "ELEMENT_SORT_FIELD2"       => "desc",
                    "ELEMENT_SORT_ORDER2"       => "desc",
                    "PROPERTY_CODE"             => [
                        1 => "TIP_SIM_KARTY",
                        2 => "RAZMER_OPERATIVNOY_PAMYATI",
                        3 => "OBEM_MOROZILNOY_KAMERY",
                        4 => "VYSOTA_PODDONA",
                        5 => "KONSTRUKTSIYA",
                        6 => "TIP_PAMYATI",
                        7 => "VAROCHNAYA_PANEL",
                        8 => "MATERIAL_PEREDNIKH_STENOK",
                        9 => "VERSIYA_OS",
                        10 => "VIDEOKARTA",
                        11 => "DUKHOVKA",
                        12 => "PANEL_UPRAVLENIYA",
                        13 => "KOLICHESTVO_SIM_KART",
                        14 => "OBEM_ZHESTKOGO_DISKA",
                        15 => "NOMINALNAYA_POTREBLYAEMAYA_MOSHCHNOST",
                        16 => "PROTIVOSKOLZYASHCHEE_POKRYTIE_DNA",
                        17 => "CML2_BAR_CODE",
                        18 => "CML2_ARTICLE",
                        19 => "CML2_ATTRIBUTES",
                        20 => "CML2_TRAITS",
                        21 => "CML2_BASE_UNIT",
                        22 => "CML2_TAXES",
                        23 => "MORE_PHOTO",
                        24 => "FILES",
                        25 => "CML2_MANUFACTURER",
                        26 => "RAZMERY_SHXVXT",
                        27 => "KOLICHESTVO_YADER",
                        28 => "RABOCHAYA_POVERKHNOST",
                        29 => "GABARITY_SHKHVKHD",
                        30 => "BLOG_POST_ID",
                        31 => "BLOG_COMMENTS_CNT",
                        32 => "DIAGONAL_EKRANA",
                        33 => "BLOK_PITANIYA",
                        34 => "KOLICHESTVO_KONFOROK",
                        35 => "TIP_PEREDNEGO_STEKLA",
                        36 => "TIP_EKRANA",
                        37 => "KORPUS",
                        38 => "TIP_DUKHOVKI",
                        39 => "RAMA_ROST_VELOSIPEDISTA_SM",
                        40 => "RAZMER_IZOBRAZHENIYA",
                        41 => "RAZRABOTCHIK_VIDEOKARTY",
                        42 => "DIAGONAL_EKRANA_1",
                        43 => "MATERIAL_RAMY",
                        44 => "TYLOVAYA_FOTOKAMERA",
                        45 => "LINEYKA_PROTSESSOROV",
                        46 => "RAZRESHENIE_EKRANA",
                        47 => "RAZMERY_RAMY",
                        48 => "FRONTALNAYA_KAMERA",
                        49 => "SOCKET",
                        50 => "TIP_ZHESTKOGO_DISKA",
                        51 => "DIAMETR_KOLES",
                        52 => "RAZEM_DLYA_NAUSHNIKOV",
                        53 => "KOLICHESTVO_YADER_1",
                        54 => "TIP_PAMYATI_2",
                        55 => "MATERIAL_OBODA",
                        56 => "SPUTNIKOVAYA_NAVIGATSIYA",
                        57 => "CHASTOTA_PROTSESSORA",
                        58 => "WI_FI",
                        59 => "PEREDNIY_TORMOZ",
                        60 => "PROTSESSOR",
                        61 => "YADRO",
                        62 => "BLUETOOTH",
                        63 => "ZADNIY_TORMOZ",
                        64 => "KOLICHESTVO_YADER_PROTSESSORA",
                        65 => "INTEGRIROVANNOE_GRAFICHESKOE_YADRO",
                        66 => "VYKHOD_HDMI",
                        67 => "KOLICHESTVO_SKOROSTEY",
                        68 => "VIDEOPROTSESSOR",
                        69 => "SOCKET_1",
                        70 => "VYKHOD_AUDIO_NAUSHNIKI",
                        71 => "MOSHCHNOST",
                        72 => "OBEM_VSTROENNOY_PAMYATI",
                        73 => "FORM_FAKTOR",
                        74 => "RAZRESHENIE_VEB_KAMERY",
                        75 => "SHAG_TSEPI",
                        76 => "OBEM_OPERATIVNOY_PAMYATI",
                        77 => "TIP_PAMYATI_1",
                        78 => "PROIZVODITEL_TELEFONA",
                        79 => "DLINA_SHINY",
                        80 => "SLOT_DLYA_KART_PAMYATI",
                        81 => "KOLICHESTVO_SLOTOV_PAMYATI",
                        82 => "MODELI_TELEFONA",
                        83 => "OBEM_DVIGATELYA",
                        84 => "EMKOST_AKKUMULYATORA",
                        85 => "BIOS",
                        86 => "MATERIAL_1",
                        87 => "EMKOST_TOPLIVNOGO_BAKA",
                        88 => "TIP_RAZEMA_DLYA_ZARYADKI",
                        89 => "SATA",
                        90 => "PROZRACHNYY",
                        91 => "EMKOST_MASLYANOGO_BAKA",
                        92 => "GROMKAYA_SVYAZ",
                        93 => "ETHERNET",
                        94 => "TIP_KAMERY",
                        95 => "FUNKTSII_I_VOZMOZHNOSTI",
                        96 => "KONSTRUKTSIYA_AKKUMULYATOR",
                        97 => "RAZEMY_NA_ZADNEY_PANELI",
                        98 => "DIAFRAGMA_1",
                        99 => "KOMPLEKT_POSTAVKI",
                        100 => "TIP_AKKUMULYATORA",
                        101 => "INTERFEYS_PODKLYUCHENIYA",
                        102 => "OBSHCHEE_CHISLO_PIKSELOV",
                        103 => "TIP",
                        104 => "BYSTRAYA_ZARYADKA",
                        105 => "PREDNAZNACHENIE",
                        106 => "MAKSIMALNOE_RAZRESHENIE",
                        107 => "KONSTRUKTSIYA_1",
                        108 => "MAKS_VYKHODNOY_TOK",
                        109 => "TIP_BESPROVODNOY_SVYAZI",
                        110 => "CHUVSTVITELNOST",
                        111 => "MODEL",
                        112 => "RAZEM_PODKLYUCHENIYA",
                        113 => "KOLICHESTVO_KLAVISH",
                        114 => "BALANS_BELOGO_1",
                        115 => "VID_ZASTEZHKI",
                        116 => "KOLICHESTVO_RAZEMOV",
                        117 => "KOLICHESTVO_PROGRAMMIRUEMYKH_KLAVISH",
                        118 => "VSPYSHKA",
                        119 => "DLINA_IZDELIYA_PO_SPINKE",
                        120 => "KABEL_V_KOMPLEKTE",
                        121 => "DLINA_PROVODA",
                        122 => "ZAPIS_VIDEO",
                        123 => "POKROY",
                        124 => "TIP_NOSITELYA",
                        125 => "INTERFEYS_PODKLYUCHENIYA_1",
                        126 => "USTANOVKA",
                        127 => "POL",
                        128 => "MAKSIMALNOE_RAZRESHENIE_VIDEOSEMKI",
                        129 => "PODSVETKA_KLAVISH",
                        130 => "TIP_ZAGRUZKI",
                        131 => "POLNOTA_OBUVI_EUR",
                        132 => "ZOOM",
                        133 => "TSIFROVOY_BLOK",
                        134 => "MAKSIMALNAYA_ZAGRUZKA_BELYA",
                        135 => "SEZON",
                        136 => "DIAFRAGMA",
                        137 => "KOLICHESTVO_DOPOLNITELNYKH_KLAVISH",
                        138 => "DISPLEY",
                        139 => "STRANA_PROIZVODITEL",
                        140 => "DIAMETR_FILTRA",
                        141 => "MAKSIMALNYY_RAZMER_EKRANA",
                        142 => "GABARITY_SHXGXV",
                        143 => "TIP_POSADKI",
                        144 => "ZHK_EKRAN",
                        145 => "MATERIAL",
                        146 => "KLASS_ENERGOPOTREBLENIYA",
                        147 => "UKHOD_ZA_VESHCHAMI",
                        148 => "VIDOISKATEL",
                        149 => "TIP_SOEDINENIYA",
                        150 => "RASKHOD_VODY_ZA_STIRKU",
                        151 => "FAKTURA_MATERIALA",
                        152 => "BALANS_BELOGO",
                        153 => "MIKROFON",
                        154 => "KOLICHESTVO_PROGRAMM",
                        155 => "KHIT",
                        156 => "ZHESTKIY_DISK",
                        157 => "SISTEMA_AKTIVNOGO_SHUMOPODAVLENIYA",
                        158 => "TERMOSTAT",
                        159 => "AKCIYA",
                        160 => "OPERATIVNAYA_PAMYAT",
                        161 => "MINIMALNAYA_VOSPROIZVODIMAYA_CHASTOTA",
                        162 => "NAZNACHENIE",
                        163 => "RASPRODAZHA",
                        164 => "RAZEMY",
                        165 => "MAKSIMALNAYA_VOSPROIZVODIMAYA_CHASTOTA",
                        166 => "POKRYTIE",
                        167 => "SHIRINA_SKASHIVANIYA",
                        168 => "PODDERZHIVAEMYE_NOSITELI",
                        169 => "TIP_KREPLENIYA",
                        170 => "SPOSOB_MONTAZHA",
                        171 => "VYSOTA_SKASHIVANIYA",
                        172 => "PODDERZHIVAEMYE_FORMATY",
                        173 => "MOROZILNAYA_KAMERA",
                        174 => "MATERIAL_2",
                        175 => "MOSHCHNOST_DVIGATELYA",
                        176 => "OBEM_VSTROENNOY_FLESH_PAMYATI",
                        177 => "MATERIAL_POKRYTIYA",
                        178 => "FORMA",
                        179 => "USTROYSTVO_DLYA_CHTENIYA_KART_PAMYATI",
                        180 => "ENERGOPOTREBLENIE",
                        181 => "OBEM",
                        182 => "ISTOCHNIK_PITANIYA",
                        183 => "KOLICHESTVO_KAMER",
                        184 => "UGLOVAYA_KONSTRUKTSIYA",
                        185 => "VOZRASTNYE_OGRANICHENIYA",
                        186 => "KOLICHESTVO_DVEREY",
                        187 => "MODIFIKATSIYA",
                        188 => "IZ_CHEGO_SDELANO_SOSTAV",
                        189 => "OBSHCHIY_OBEM",
                        190 => "GIDROMASSAZH",
                        191 => "SOVMESTIMOST",
                        192 => "OBEM_KHOLODILNOY_KAMERY",
                        193 => "FORMA_1",
                        194 => "INTERFEYS",
                        195 => "MATERIAL_PODDONA",
                        196 => "KREPLENIE_MIKROFONA",
                        197 => "LINEYKA_PROTSESSORA",
                    ],
                    "PROPERTY_CODE_MOBILE"      => [],
                    "META_KEYWORDS"             => "-",
                    "META_DESCRIPTION"          => "-",
                    "BROWSER_TITLE"             => "-",
                    "SET_LAST_MODIFIED"         => "N",
                    "INCLUDE_SUBSECTIONS"       => "Y",
                    "BASKET_URL"                => Config::get('BASKET_PAGE'),
                    "ACTION_VARIABLE"           => "action",
                    "PRODUCT_ID_VARIABLE"       => "id",
                    "SECTION_ID_VARIABLE"       => "SECTION_ID",
                    "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                    "PRODUCT_PROPS_VARIABLE"    => "prop",
                    "FILTER_NAME"               => "detailPromotion",
                    "CACHE_FILTER"              => "Y",
                    "CACHE_GROUPS"              => "Y",
                    "CACHE_TIME"                => "36000000",
                    "CACHE_TYPE"                => "A",
                    "SET_TITLE"                 => "N",
                    "MESSAGE_404"               => "",
                    "SET_STATUS_404"            => "Y",
                    'SHOW_ALL_WO_SECTION'       => 'Y',
                    "SHOW_404"                  => "N",
                    "DISPLAY_COMPARE"           => "Y",
                    "PAGE_ELEMENT_COUNT"        => 100,
                    "LINE_ELEMENT_COUNT"        => 4,
                    "PRICE_CODE"                => \SotbitOrigami::GetComponentPrices(["BASE","OPT","SMALL_OPT"]),
                    "USE_PRICE_COUNT"           => "N",
                    "SHOW_PRICE_COUNT"          => "1",

                    "PRICE_VAT_INCLUDE"          => "Y",
                    "USE_PRODUCT_QUANTITY"       => "Y",
                    "ADD_PROPERTIES_TO_BASKET"   => "Y",
                    "PARTIAL_PRODUCT_PROPERTIES" => "N",
                    "PRODUCT_PROPERTIES"         => [
                    ],

                    "DISPLAY_TOP_PAGER"               => "N",
                    "DISPLAY_BOTTOM_PAGER"            => "N",
                    "PAGER_TITLE"                     => Loc::getMessage('PAGER_TITLE'),
                    "PAGER_SHOW_ALWAYS"               => "",
                    "PAGER_TEMPLATE"                  => "",
                    "PAGER_DESC_NUMBERING"            => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
                    "PAGER_SHOW_ALL"                  => "N",
                    "PAGER_BASE_LINK_ENABLE"          => "N",
                    "PAGER_BASE_LINK"                 => "N",
                    "PAGER_PARAMS_NAME"               => "N",
                    "LAZY_LOAD"                       => "N",
                    "MESS_BTN_LAZY_LOAD"              => "N",
                    "LOAD_ON_SCROLL"                  => "N",

                    "OFFERS_CART_PROPERTIES" => [
                        0 => "SIZES_SHOES",
                        1 => "SIZES_CLOTHES",
                        2 => "COLOR_REF",
                    ],
                    "OFFERS_FIELD_CODE"      => [
                        0 => "NAME",
                        1 => "PREVIEW_PICTURE",
                        2 => "DETAIL_PICTURE",
                        3 => "DETAIL_PAGE_URL",
                    ],
                    "OFFERS_PROPERTY_CODE"   => [
                        1  => "CML2_BAR_CODE",
                        2  => "CML2_ARTICLE",
                        5  => "CML2_BASE_UNIT",
                        7  => "MORE_PHOTO",
                        8  => "FILES",
                        9  => "CML2_MANUFACTURER",
                        10 => "PROTSESSOR",
                        11 => "CHASTOTA_PROTSESSORA",
                        12 => "KOLICHESTVO_YADER_PROTSESORA",
                        13 => "OBEM_OPERATICHNOY_PAMYATI",
                        14 => "TIP_VIDEOKARTY",
                        15 => "OBEM_VIDEOPAMYATI",
                        16 => "USTANOVLENNAYA_OS",
                        17 => "OBEM_PAMYATI",
                        18 => "RAZMER",
                        19 => "TSVET",
                        20 => "TSVET_1",
                        21 => "VIDEOKARTA",
                    ],
                    "OFFERS_SORT_FIELD"      => "sort",
                    "OFFERS_SORT_ORDER"      => "id",
                    "OFFERS_SORT_FIELD2"     => "desc",
                    "OFFERS_SORT_ORDER2"     => "desc",
                    "OFFERS_LIMIT"           => 0,

                    "SECTION_URL"               => SITE_DIR
                        .'catalog/#SECTION_CODE_PATH#/',
                    "DETAIL_URL"                => SITE_DIR
                        .'catalog/#SECTION_CODE_PATH#/#ELEMENT_CODE#/',
                    "USE_MAIN_ELEMENT_SECTION"  => "N",
                    'CONVERT_CURRENCY'          => "N",
                    'HIDE_NOT_AVAILABLE'        => "N",
                    'HIDE_NOT_AVAILABLE_OFFERS' => "N",

                    'LABEL_PROP'                  => [
                        0 => "RASPRODAZHA",
                    ],
                    'LABEL_PROP_MOBILE'           => [],
                    'ADD_PICT_PROP'               => "MORE_PHOTO",
                    'PRODUCT_DISPLAY_MODE'        => "Y",
                    'OFFER_ADD_PICT_PROP'         => "MORE_PHOTO",
                    'OFFER_TREE_PROPS'            => [
                        "PROTSESSOR",
                        "OBEM_OPERATICHNOY_PAMYATI",
                        "OBEM_PAMYATI",
                        "RAZMER",
                        "CHASTOTA_PROTSESSORA",
                        "TIP_VIDEOKARTY",
                        "TSVET",
                        "KOLICHESTVO_YADER_PROTSESORA",
                        "OBEM_VIDEOPAMYATI",
                        "TSVET_1",
                        "USTANOVLENNAYA_OS",
                        "CML2_MANUFACTURER",
                    ],
                    'PRODUCT_SUBSCRIPTION'        => "Y",
                    'SHOW_DISCOUNT_PERCENT'       => "Y",
                    'SHOW_OLD_PRICE'              => "Y",
                    'SHOW_MAX_QUANTITY'           => "Y",
                    "MESS_BTN_ADD_TO_BASKET"      => Loc::getMessage('MESS_BTN_ADD_TO_BASKET'),
                    "MESS_BTN_BUY"                => Loc::getMessage('MESS_BTN_BUY'),
                    "MESS_BTN_COMPARE"            => Loc::getMessage('MESS_BTN_COMPARE'),
                    "MESS_BTN_DETAIL"             => Loc::getMessage('MESS_BTN_DETAIL'),
                    "MESS_BTN_SUBSCRIBE"          => Loc::getMessage('MESS_BTN_SUBSCRIBE'),
                    "MESS_NOT_AVAILABLE"          => Loc::getMessage('MESS_NOT_AVAILABLE'),
                    "MESS_RELATIVE_QUANTITY_MANY" => Loc::getMessage('MESS_RELATIVE_QUANTITY_MANY'),
                    "MESS_RELATIVE_QUANTITY_FEW"  => Loc::getMessage('MESS_RELATIVE_QUANTITY_FEW'),
                    "MESS_RELATIVE_QUANTITY_NO"   => Loc::getMessage('MESS_RELATIVE_QUANTITY_NO'),
                    'USE_VOTE_RATING'             => "Y",
                    'TEMPLATE_THEME'              => "",
                    "ADD_SECTIONS_CHAIN"          => "N",
                    'ADD_TO_BASKET_ACTION'        => "ADD",
                    'COMPARE_PATH'                => Config::get('COMPARE_PAGE'),
                    'COMPARE_NAME'                => "CATALOG_COMPARE_LIST",
                    'USE_COMPARE_LIST'            => 'Y',
                    'ACTION_PRODUCTS' => array("ADMIN"),
                    "ACTION_PRODUCTS" => array(
                        0 => "ADMIN",
                    ),
                    "VARIANT_LIST_VIEW" => "ADMIN",
                    "SHOW_SLIDER" => "N",
                    'SECTION_NAME' => Loc::getMessage('SECT_PROMO_BLOCK_NAME')
                ],
                false
            );
            }
            ?></div>

    </div>
    <div class="puzzle_block puzzle_block-form-promotion-wrapper">
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:form.result.new",
            "origami_webform_2",
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
                "WEB_FORM_ID" => 2
            )
        );
        ?>
    </div>
    <?/*
<div class="questions__form-wrapper">
    <div class="questions__form">

<?
$APPLICATION->IncludeComponent(
	"slam:easyform",
	"main_page_zayavka_template",
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
		"CATEGORY_PHONE_PLACEHOLDER" => "Мобильный телефон *",
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
		"EMAIL_FILE" => "Y",
		"EMAIL_SEND_FROM" => "N",
		"EMAIL_TO" => "",
		"ENABLE_SEND_MAIL" => "Y",
		"ERROR_TEXT" => "Произошла ошибка. Сообщение не отправлено.",
		"EVENT_MESSAGE_ID" => array(
			0 => "90",
		),
		"FIELDS_ORDER" => "TITLE,PHONE,EMAIL,MESSAGE,DOCS,ACCEPT",
		"FORM_AUTOCOMPLETE" => "N",
		"FORM_ID" => "FORM_015412347",
		"FORM_NAME" => "Обратная связь",
		"FORM_SUBMIT_VALUE" => "Отправить заявку",
		"FORM_SUBMIT_VARNING" => "Нажимая на кнопку \"#BUTTON#\", вы даете согласие на обработку <a target=\"_blank\" href=\"#\">персональных данных</a>",
		"HIDE_ASTERISK" => "N",
		"HIDE_FIELD_NAME" => "Y",
		"HIDE_FORMVALIDATION_TEXT" => "N",
		"INCLUDE_BOOTSRAP_JS" => "Y",
		"MAIL_SUBJECT_ADMIN" => "#SITE_NAME#: Сообщение из формы Обратная связь",
		"NAME_MODAL_BUTTON" => "Отправить заявку",
		"OK_TEXT" => "Ваше сообщение отправлено. ",
		"REQUIRED_FIELDS" => array(
			0 => "PHONE",
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
		"WIDTH_FORM" => "",
		"_CALLBACKS" => "",
		"COMPONENT_TEMPLATE" => "main_page_zayavka_template",
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
    </div>
</div>

*/?>

    <div class="puzzle_block puzzle_block_promotion_return">
        <a class="return" href="<?=$arResult['FOLDER']?>">
			<span class="return_inner">
				<?=GetMessage('RETURN')?>
			</span>
        </a>
    </div>
</div>
