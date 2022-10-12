<?
use Sotbit\Origami\Config\Option;
use Bitrix\Sale;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$basket = Sale\Order::load($_GET['ID_ORDER'])->getBasket();

$APPLICATION->SetTitle("Изменение товаров в корзине");
$price = $basket->getPrice(); // Цена с учетом скидок
$fullPrice = $basket->getBasePrice(); // Цена без учета скидок
$weight = $basket->getWeight();
$basketItems = $basket->getBasketItems(); 
pre($_POST);
?>

<form method="POST" >
	<table>
		<tr>
			<td>Наименование</td>
			<td>Количество</td>
			<td>Удалить</td>
		</tr>

<?
foreach ($basket as $basketItem) {
	?>
	<tr>
		<td>
			<input type="hidden"  value="<?=$basketItem->getField('PRODUCT_ID')?>">
			<input type="text" disabled="disabled" value="<?=$basketItem->getField('NAME')?>"></td>
		<td><input type="text" name="QUANTITY[<?=$basketItem->getField('PRODUCT_ID')?>]" value="<?=$basketItem->getQuantity()?>"></td>
		<td><input type="checkbox" name="DELETE[<?=$basketItem->getField('PRODUCT_ID')?>]" value="Y"></td>
	</tr>

    <?
}
?>
<input type="hidden" value="Y" name="SAVE">
	</table>

	<button type="submit">Сохранить изменения</button>
</form>
<?
/*$APPLICATION->IncludeComponent(
	"mediagroup:sale.basket.basket", 
	"origami_base", 
	array(
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"COLUMNS_LIST" => array(
			0 => "NAME",
			1 => "DISCOUNT",
			2 => "PRICE",
			3 => "QUANTITY",
			4 => "SUM",
			5 => "PROPS",
			6 => "DELETE",
			7 => "DELAY",
		),
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
		"HIDE_COUPON" => "Y",
		"QUANTITY_FLOAT" => "N",
		"PRICE_VAT_SHOW_VALUE" => "Y",
		"TEMPLATE_THEME" => "site",
		"SET_TITLE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"OFFERS_PROPS" => array(
			0 => "TSVET",
			1 => "PROTSESSOR",
			2 => "RAZMER",
			3 => "VIDEOKARTA",
			4 => "CHASTOTA_PROTSESSORA",
			5 => "CML2_ARTICLE",
		),
		"COMPONENT_TEMPLATE" => "origami_base",
		"DEFERRED_REFRESH" => "Y",
		"USE_DYNAMIC_SCROLL" => "Y",
		"SHOW_FILTER" => "Y",
		"SHOW_RESTORE" => "Y",
		"COLUMNS_LIST_EXT" => array(
			0 => "PREVIEW_PICTURE",
			1 => "DISCOUNT",
			2 => "DELETE",
			3 => "DELAY",
			4 => "SUM",
			5 => "PROPERTY_CML2_ARTICLE",
		),
		"COLUMNS_LIST_MOBILE" => array(
			0 => "DELETE",
			1 => "DELAY",
			2 => "SUM",
		),
		"TOTAL_BLOCK_DISPLAY" => array(
			0 => "bottom",
		),
		"DISPLAY_MODE" => "extended",
		"PRICE_DISPLAY_MODE" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"DISCOUNT_PERCENT_POSITION" => "bottom-right",
		"PRODUCT_BLOCKS_ORDER" => "props,sku,columns",
		"USE_PRICE_ANIMATION" => "Y",
		"LABEL_PROP" => array(
			0 => "KHIT",
			1 => "NOVINKA",
		),
		"USE_PREPAYMENT" => "N",
		"CORRECT_RATIO" => "Y",
		"AUTO_CALCULATION" => "Y",
		"ACTION_VARIABLE" => "basketAction",
		"COMPATIBLE_MODE" => "Y",
		"EMPTY_BASKET_HINT_PATH" => "/catalog/",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"ADDITIONAL_PICT_PROP_5" => "-",
		"ADDITIONAL_PICT_PROP_23" => "-",
		"ADDITIONAL_PICT_PROP_24" => "-",
		"BASKET_IMAGES_SCALING" => "adaptive",
		"USE_GIFTS" => "Y",
		"GIFTS_PLACE" => "BOTTOM",
		"GIFTS_BLOCK_TITLE" => "Выберите один из подарков",
		"GIFTS_HIDE_BLOCK_TITLE" => "Y",
		"GIFTS_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
		"GIFTS_SHOW_OLD_PRICE" => "N",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_MESS_BTN_DETAIL" => "Подробнее",
		"GIFTS_PAGE_ELEMENT_COUNT" => "4",
		"GIFTS_CONVERT_CURRENCY" => "N",
		"GIFTS_HIDE_NOT_AVAILABLE" => "N",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"LABEL_PROP_MOBILE" => array(
		),
		"LABEL_PROP_POSITION" => "top-left",
		"EXCLUDE_DELAY" => "Y",
		"IMAGE_FOR_OFFER" => Option::get("IMAGE_FOR_OFFER"),
		"ADDITIONAL_PICT_PROP_3" => "-",
		"ADDITIONAL_PICT_PROP_8" => "-",
		"ADDITIONAL_PICT_PROP_9" => "-",
		"SHOW_OC" => "N",
		"ADDITIONAL_PICT_PROP_12" => "-",
		"ADDITIONAL_PICT_PROP_15" => "-",
		"ADDITIONAL_PICT_PROP_17" => "-",
		"ADDITIONAL_PICT_PROP_21" => "-",
		"ADDITIONAL_PICT_PROP_22" => "-",
		"MIN_SUMM" => COption::GetOptionString("mediagroup.registration", "MIN_SUMM")
	),
	false
);*/?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>