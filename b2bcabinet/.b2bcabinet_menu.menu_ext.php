<?php

$aMenuLinks = [
    [
        "Личный кабинет",
        SITE_DIR . "b2bcabinet/",
        [],
        ['ICON_CLASS' => 'icon-home4'],
        ""
    ],


    [
        "Создание заказа",
        SITE_DIR . "b2bcabinet/orders/blank_zakaza/index.php",
        [],
        [
            'ICON_CLASS' => 'icon-pencil3'
        ],
        ""
    ],


    [
        "Оформление заказа",
        SITE_DIR . "b2bcabinet/orders/make/index.php",
        [
            SITE_DIR . "b2bcabinet/orders/make/make.php"
        ],
        [
            'ICON_CLASS' => 'icon-clipboard5'
        ],
        ""
    ],


    [
        "Состояние заказов",
        SITE_DIR . "b2bcabinet/orders/index.php",
        [
            SITE_DIR . "b2bcabinet/order/detail/"
        ],
        [
            'ICON_CLASS' => 'icon-history'
        ],
        ""
    ],


    [
        "Статистика заказов",
        SITE_DIR . "b2bcabinet/stats/",
        [],
        [],
        ""
    ],

    [
        "Индивидуальные товары",
        SITE_DIR . "b2bcabinet/orders/products/index.php",
        [],
        [
            'ICON_CLASS' => 'icon-clipboard5'
        ],
        ""
    ],


    [
        "Организации",
        SITE_DIR . "b2bcabinet/personal/buyer/index.php",
        [
            SITE_DIR . "b2bcabinet/personal/buyer/add.php",
            SITE_DIR . "b2bcabinet/personal/buyer/profile_detail.php",
            SITE_DIR . "b2bcabinet/personal/buyer/profile_list.php"
        ],
        [
            'ICON_CLASS' => 'icon-users2'
        ],
        ""
    ],

    [
        "Настройки Имя / Пароль",
        SITE_DIR . "b2bcabinet/personal/index.php",
        [],
        [
            'ICON_CLASS' => 'icon-user'
        ],
        ""
    ],

    [
        "Инструкция к Личному Кабинету",
        SITE_DIR . "b2bcabinet/instruction/index.php",
        [],
        [
            'ICON_CLASS' => 'icon-user'
        ],
        ""
    ],
    
    [
        "Блог",
        SITE_DIR . "suppliers_cabinet/personal/",
        array(),
        array(),
        "CSite::InGroup(array(15))"
    ]


];



/*



if(\Bitrix\Main\Loader::includeModule('support')) {
    $aMenuLinks[] = [
        "Техническая поддержка",
        SITE_DIR."b2bcabinet/support/",
        [],
        [],
        ""
    ];
}

 [
        "Документы",
        SITE_DIR."b2bcabinet/documents/",
        [],
        [],
        ""
    ]

    
[
        "Личный счет",
        SITE_DIR."b2bcabinet/personal/account/index.php",
        [],
        [
            'ICON_CLASS' => 'icon-credit-card'
        ],
        ""
    ],
    
[
        "Персональные данные",
        SITE_DIR."b2bcabinet/personal/",
        [],
        [],
        ""
    ],


    */
