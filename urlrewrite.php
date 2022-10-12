<?php
$arUrlRewrite=array (
  38 => 
  array (
    'CONDITION' => '#^={$arResult["FOLDER"].$arResult["VARIABLES"]["ELEMENT_CODE"]."/".$arResult["URL_TEMPLATES"]["smart_filter"]}\\??(.*)#',
    'RULE' => '&$1',
    'ID' => 'mediagroup:catalog.smart.filter',
    'PATH' => '/local/templates/.default/components/sotbit/news/sotbit_origami_brands/detail.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/online/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
    'RULE' => 'alias=$1',
    'ID' => NULL,
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  29 => 
  array (
    'CONDITION' => '#^/suppliers_cabinet/add_post.php#',
    'RULE' => '',
    'ID' => 'bitrix:iblock.element.add',
    'PATH' => '/suppliers_cabinet/add_post.php',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#^\\/?\\/mobileapp/jn\\/(.*)\\/.*#',
    'RULE' => 'componentName=$1',
    'ID' => NULL,
    'PATH' => '/bitrix/services/mobileapp/jn.php',
    'SORT' => 100,
  ),
  5 => 
  array (
    'CONDITION' => '#^/bitrix/services/ymarket/#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/bitrix/services/ymarket/index.php',
    'SORT' => 100,
  ),
  35 => 
  array (
    'CONDITION' => '#^/suppliers_cabinet/post/#',
    'RULE' => '',
    'ID' => 'bitrix:iblock.element.add.form',
    'PATH' => '/suppliers_cabinet/post/index.php',
    'SORT' => 100,
  ),
  14 => 
  array (
    'CONDITION' => '#^/b2bcabinet/documents/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/b2bcabinet/documents/index.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/online/(/?)([^/]*)#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  26 => 
  array (
    'CONDITION' => '#^/b2bcabinet/order/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.order',
    'PATH' => '/b2bcabinet/orders/index.php',
    'SORT' => 100,
  ),
  0 => 
  array (
    'CONDITION' => '#^/stssync/calendar/#',
    'RULE' => '',
    'ID' => 'bitrix:stssync.server',
    'PATH' => '/bitrix/services/stssync/calendar/index.php',
    'SORT' => 100,
  ),
  11 => 
  array (
    'CONDITION' => '#^/personal/order/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.order',
    'PATH' => '/personal/order/index.php',
    'SORT' => 100,
  ),
  373 => 
  array (
    'CONDITION' => '#^/news-partners/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/news-partners/index.php',
    'SORT' => 100,
  ),
  33 => 
  array (
    'CONDITION' => '#^/promotions/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/promotions/index.php',
    'SORT' => 100,
  ),
  12 => 
  array (
    'CONDITION' => '#^/personal/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.section',
    'PATH' => '/personal/index.php',
    'SORT' => 100,
  ),
  32 => 
  array (
    'CONDITION' => '#^/catalog/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/catalog/index.php',
    'SORT' => 100,
  ),
  37 => 
  array (
    'CONDITION' => '#^/brands/#',
    'RULE' => '',
    'ID' => 'sotbit:news',
    'PATH' => '/brands/index.php',
    'SORT' => 100,
  ),
  372 => 
  array (
    'CONDITION' => '#^/marks/#',
    'RULE' => '',
    'ID' => 'sotbit:news',
    'PATH' => '/marks/index.php',
    'SORT' => 100,
  ),
  13 => 
  array (
    'CONDITION' => '#^/store/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog.store',
    'PATH' => '/store/index.php',
    'SORT' => 100,
  ),
  4 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
  34 => 
  array (
    'CONDITION' => '#^/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/news/index.php',
    'SORT' => 100,
  ),
  36 => 
  array (
    'CONDITION' => '#^/blog/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/blog/index.php',
    'SORT' => 100,
  ),
);
