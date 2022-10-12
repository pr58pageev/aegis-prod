<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


$arFilter = Array(
   "USER_ID" => $USER->GetID(),
  
   );

if(!empty($_GET['FILTER'])){
	$date = new DateTime();
	$date->modify('-1 '.$_GET['FILTER']);
	$date =  $date->format('d.m.Y');
	$arFilter[ ">=DATE_INSERT" ] = $date ;
}


if(!empty($_GET['FROM'])){
	$objDateTime1 = new DateTime($_GET['FROM']);
	$objDateTime1 =  $objDateTime1->format('d.m.Y');
	$arFilter[ ">=DATE_INSERT" ] = $objDateTime1 . " 00:00:00" ;
}

if(!empty($_GET['TO'])){
	$objDateTime = new DateTime();
	$objDateTime = new DateTime($_GET['TO']);
	$objDateTime =  $objDateTime->format('d.m.Y');
	$arFilter[ "<=DATE_INSERT" ] = $objDateTime . " 23:59:59";
}

if(empty($_GET['ORDER'])){
                    $order_sort = 'ASC';
                  }else{
                  	$order_sort = $_GET['ORDER'];
                  }
$sort = array("DATE_INSERT" => $order_sort);

if(!empty($_GET['SORT'])){
	$sort = array(
			$_GET['SORT'] => $order_sort
	);
}

$arFilter['!STATUS_ID'] =  'CR';
$product_ids = array();
$db_sales = CSaleOrder::GetList($sort, $arFilter);
$arResult['COUNT_ITEMS_ALL'] = 0;
$arResult['ALL_SUMM'] = 0;
while ($ar_sales = $db_sales->Fetch())
{	
	$arBasketItems = array();

		$dbBasketItems = CSaleBasket::GetList(
		        array(
		                "NAME" => "ASC",
		                "ID" => "ASC"
		            ),
		        array(
		               "LID" => SITE_ID,
		                "ORDER_ID" => $ar_sales['ID']
		            ),
		        false,
		        false,
		        array("ID", "CALLBACK_FUNC", "MODULE", 
		              "PRODUCT_ID", "QUANTITY", "DELAY", 
		              "CAN_BUY", "PRICE", "WEIGHT")
		    );
		while ($arItems = $dbBasketItems->Fetch())
		{
		    $product_ids[] = $arItems['PRODUCT_ID'];
		    $arResult['COUNT_ITEMS_ALL']++;


		    $arBasketItems[] = $arItems;
		}
		$ar_sales['BASKET_ITEMS_COUNT'] = count($arBasketItems);
		$ar_sales['BASKET_ITEMS'] = $arBasketItems;

   $arResult['ALL_SUMM']+= $ar_sales['PRICE'];
   $arResult['ORDERS'][$ar_sales['ID']] = $ar_sales;
}


if(!empty($_GET['SORT']) && $_GET['SORT']=='BASKET_ITEMS'){


	function cmp_function($a, $b){
	return ($a['BASKET_ITEMS_COUNT'] > $b['BASKET_ITEMS_COUNT']);
	}
	function cmp_function_desc($a, $b){
	return ($a['BASKET_ITEMS_COUNT'] < $b['BASKET_ITEMS_COUNT']);
	}
	 

	 if($order_sort == 'ASC'){
	 		uasort($arResult['ORDERS'], 'cmp_function');
	}else{
				uasort($arResult['ORDERS'], 'cmp_function_desc');
	}
	
}



$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM",'PROPERTY_CML2_LINK','PROPERTY_POLNOE_NAIMENOVANIE');
$arFilter = Array("IBLOCK_ID"=>17, "ID"=>$product_ids);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->fetch())
{	
	$parent_product_ids[] = $ob['PROPERTY_CML2_LINK_VALUE'];
	$arResult['OFFERS_PRODUCTS'][$ob['ID']] = $ob;
}


$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM",'PROPERTY_CML2_LINK','PROPERTY_POLNOE_NAIMENOVANIE');
$arFilter = Array("IBLOCK_ID"=>15, "ID"=>$parent_product_ids);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->fetch())
{
	$arResult['PRODUCTS'][$ob['ID']] = $ob;
}

$count_all_order = count($arResult['ORDERS']);

$arResult['STATS']['SR_COUNT_PRODUCTS_IN_ORDER'] = $arResult['COUNT_ITEMS_ALL'] / $count_all_order;
$arResult['STATS']['SR_PRICE_PRODUCTS'] = (int)$arResult['ALL_SUMM'] / $arResult['COUNT_ITEMS_ALL'] ;
$arResult['STATS']['SR_PRICE_PRODUCTS'] = (int)$arResult['STATS']['SR_PRICE_PRODUCTS'];

$arResult['STATS']['SR_PRICE_ORDER'] = $arResult['ALL_SUMM'] / $count_all_order;
$arResult['STATS']['SR_PRICE_ORDER'] = (int)$arResult['STATS']['SR_PRICE_ORDER'];
$this->IncludeComponentTemplate();


