<?
$aMenuLinks = [
	[
		"Бланк заказа",
        SITE_DIR."b2bcabinet/orders/blank_zakaza/index.php",
		[],
		[
            'ICON_CLASS' => 'icon-pencil3'
        ],
		""
	],

	[
		"Состояние заказов",
        SITE_DIR."b2bcabinet/orders/index.php",
		[
            SITE_DIR."b2bcabinet/order/detail/"
        ],
		[
            'ICON_CLASS' => 'icon-history'
        ],
		""
	],
	[
		"Оформление заказа",
        SITE_DIR."b2bcabinet/orders/make/index.php",
		[
		    SITE_DIR."b2bcabinet/orders/make/make.php"
        ],
		[
            'ICON_CLASS' => 'icon-clipboard5'
        ],
		""
	],
	 [
        "Организации",
        SITE_DIR."b2bcabinet/personal/buyer/index.php",
        [
            SITE_DIR."b2bcabinet/personal/buyer/add.php",
            SITE_DIR."b2bcabinet/personal/buyer/profile_detail.php",
            SITE_DIR."b2bcabinet/personal/buyer/profile_list.php"
        ],
        [
            'ICON_CLASS' => 'icon-users2'
        ],
        ""
    ],
    
];
?>