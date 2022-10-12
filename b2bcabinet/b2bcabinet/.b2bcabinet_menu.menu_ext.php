<?
$aMenuLinks = [
    [
        "Главная",
        SITE_DIR."b2bcabinet/",
        [],
        ['ICON_CLASS' => 'icon-home4'],
        ""
    ],

     [
        "Настройки имя/пароль",
        SITE_DIR."b2bcabinet/personal/index.php",
        [],
        [
            'ICON_CLASS' => 'icon-user'
        ],
        ""
    ],
   
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
        "Заказы",
        SITE_DIR."b2bcabinet/orders/",
        [],
        [],
        ""
    ],
    [
        "Документы",
        SITE_DIR."b2bcabinet/documents/",
        [],
        [],
        ""
    ]
];

if(\Bitrix\Main\Loader::includeModule('support')) {
    $aMenuLinks[] = [
        "Техническая поддержка",
        SITE_DIR."b2bcabinet/support/",
        [],
        [],
        ""
    ];
}


/*
[
        "Персональные данные",
        SITE_DIR."b2bcabinet/personal/",
        [],
        [],
        ""
    ],


    */
?>