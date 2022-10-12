<?
/**
 * Copyright (c) 2017. Sergey Danilkin.
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;

Loc::loadMessages(__FILE__);

Asset::getInstance()->addCss($arGadget['PATH_SITEROOT'].'/styles.css');
$idUser = intval($USER->GetID());

if(\Bitrix\Main\Loader::includeModule("sale"))
{
	$price_all= 0;
   $dbBasketItems = CSaleBasket::GetList(
      array(
            "NAME" => "ASC",
            "ID" => "ASC"
         ),
      array(
            "FUSER_ID" => CSaleBasket::GetBasketUserID(),
            "LID" => SITE_ID,
            "ORDER_ID" => "NULL",
            /*"DELAY" => "Y"*/ //разкоментировать, и только отложенные товары будут получены
         ),
      false,
      false,
      array("ID", "DELAY", "*")
   );
   while ($arItems = $dbBasketItems->Fetch())
   {
      if($arItems['DELAY'] == 'Y')
      {
         $price_all += $arItems['PRICE'] * $arItems['QUANTITY'];
      }
   }
}


if(Loader::includeModule('sotbit.cabinet') && $idUser > 0)
{
	$Items = new \Sotbit\Cabinet\Shop\BasketItems(array(
		'CAN_BUY' => 'Y',
		'DELAY' => 'Y',
		'SUBSCRIBE' => 'N'
	), array(
		'width' => 70,
		'height' => 70,
		'resize' => BX_RESIZE_IMAGE_PROPORTIONAL,
		'noPhoto' => '/upload/no_photo_small.jpg'
	));


	?>
	<div class="gdsetcartinfo">
		<span>
			<?= $Items->getQnt() ?> <?= \Sotbit\Cabinet\Element::num2word(
				$Items->getQnt(),
				array(
						Loc::getMessage('GD_SOTBIT_CABINET_DELAYBASKET_PRODUCTS_1'),
						Loc::getMessage('GD_SOTBIT_CABINET_DELAYBASKET_PRODUCTS_2'),
						Loc::getMessage('GD_SOTBIT_CABINET_DELAYBASKET_PRODUCTS_3')
				));
			?>
		</span>
		на сумму  <?=$price_all?> руб.
	</div>
	<div class="gdsetcartinfo-img">
		<?php
		foreach ($Items->getItems() as $item)
		{
			$img = $item->getElement()->getImg();
			?>
			<a href="<?= $item->getElement()->getUrl() ?>" title="<?= $item->getElement()->getName() ?>">
			
			</a>
			<?
		}
		?>
	</div>
	<?php
	if($arParams['G_DELAYBASKET_PATH_TO_BASKET'])
	{
		?>
		<div class="gdhtmlareachlink">
			<a href="<?= $arParams['G_DELAYBASKET_PATH_TO_BASKET'] ?>">
				<?= Loc::getMessage('GD_SOTBIT_CABINET_DELAYBASKET_MORE') ?>
			</a>
		</div>
		<?
	}
}
?>
