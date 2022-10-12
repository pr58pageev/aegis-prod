<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
use Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);
Loc::loadMessages(__FILE__);
$stringdeliv = '';


$arSelect = Array("ID", "NAME", "PROPERTY_TIME");
$arFilter = Array("IBLOCK_ID"=>IntVal(24), "NAME"=>"Москва");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->fetch())
{

 $time = (int)$ob['PROPERTY_TIME_VALUE'];
}



$months_name = array(
"01"=>'января',
"02"=>'февраля',
"03"=>'марта',
"04"=>'апреля',
"05"=>'мая',
"06"=>'июня',
"07"=>'июля',
"08"=>'августа',
"09"=>'сентября',
"10"=>'октября',
"11"=>'ноября',
"12"=>'декабря',
);
        

if (date('H') < $time) {

    $datWeek = date('w');
 
   if($datWeek==5){
                $d = strtotime("next tuesday");
                $day = date("d", $d);
                $month = date("m", $d);
                $stringdeliv = 'Вторник , '.$day.' '.$months_name[$month].' - ';
    }
    elseif($datWeek==6)
    {
                  $d = strtotime("next tuesday");
                $day = date("d", $d);
                $month = date("m", $d);
                $stringdeliv = 'Вторник , '.$day.' '.$months_name[$month].' - ';

    }elseif($datWeek==0){

                  $d = strtotime("next tuesday");
                $day = date("d", $d);
                $month = date("m", $d);
                $stringdeliv = 'Вторник , '.$day.' '.$months_name[$month].' - ';

    }else{



    $d = strtotime("+1 day"); 
    $day = date("d", $d);
    $month = date("m", $d);
  
   $stringdeliv = ' Завтра, '.$day.' '.$months_name[$month].' - '; 

    }
    
}else{

    $datWeek = date('w');
      
        if($datWeek==5){
                $d = strtotime("next monday");
                $day = date("d", $d);
                $month = date("m", $d);
                $stringdeliv = 'Понедельник , '.$day.' '.$months_name[$month].' - ';
    }
    elseif($datWeek==6)
    {
                  $d = strtotime("next monday");
                $day = date("d", $d);
                $month = date("m", $d);
                $stringdeliv = 'Понедельник , '.$day.' '.$months_name[$month].' - ';

    }elseif($datWeek==0){

                  $d = strtotime("next monday");
                $day = date("d", $d);
                $month = date("m", $d);
                $stringdeliv = 'Понедельник , '.$day.' '.$months_name[$month].' - ';

    }else{

    $d = strtotime("+2 day");
    $day = date("d", $d);
    $month = date("m", $d);
    $stringdeliv = ' Через 1 день, '.$day.' '.$months_name[$month].' - ';
   }
}




?>

   <div class="product_detail_info__delivery-item">
        <p class="product_detail_info__delivery-way">Доставка собственным транспортом в пределах МКАД:</p>
        <p class="product_detail_info__delivery-time">
           <?=$stringdeliv?>
    <span class="product_detail_info__delivery-price">бесплатно (при заказе от 30000р.)</span>
           
            </p>
    </div>


     <div class="product_detail_info__delivery-item">
        <p class="product_detail_info__delivery-way">Самовывоз:</p>
        <p class="product_detail_info__delivery-time">
            В рабочее время - 
            <span class="product_detail_info__delivery-price">бесплатно</span></p>
    </div>

<?
unset($arResult["DELIVERY"]); //365mg
if($arResult["DELIVERY"]):?>
    <?foreach($arResult["DELIVERY"] as $arDelivery):?>
    <div class="product_detail_info__delivery-item">
        <p class="product_detail_info__delivery-way"><?=$arDelivery["NAME"]?></p>
        <p class="product_detail_info__delivery-time"><?if($arDelivery["TIME"]):?><?=$arDelivery["TIME"]?> &mdash; <?endif;?><span class="product_detail_info__delivery-price"><?=$arDelivery["PRINT_PRICE"]?></span></p>
    </div>
    <?endforeach;?>
    <div class="product_detail_info__delivery-more">
        <?if($arParams["SHOW_DELIVERY_TAB"] == 'Y'):?>
        <a class="product_detail_info__delivery-link product_detail_info__delivery-link--btn" href="#TAB_DELIVERY"><?=Loc::getMessage('sotbit.regions_SHOW_DELIVERY_TAB')?>
            <svg class="product_detail_info__delivery-link-icon" width="10" height="6">
                <use xlink:href="/local/templates/sotbit_origami/assets/img/sprite.svg#icon_dropdown_small"></use>
            </svg>
        </a>
        <?endif;?>
        <?if($arParams["SHOW_DELIVERY_PAGE"] == 'Y'):?>
        <a class="product_detail_info__delivery-link" title="<?=Loc::getMessage('sotbit.regions_DETAIL_DELIVERY_PAGE')?>" target="_blank" href="<?=SITE_DIR?>help/delivery/"><?=Loc::getMessage('sotbit.regions_DETAIL_DELIVERY_PAGE')?></a>
        <?endif;?>
    </div>
<?endif;?>
<script>
    if(!RegionsDeliveryMini) {
        var RegionsDeliveryMini = new SotbitRegionsDeliveryMini({
            'componentPath': '<?=CUtil::JSEscape($this->__component->__path)?>',
            'parameters': '<?=CUtil::JSEscape(base64_encode(serialize($arParams)))?>',
            'siteId': '<?=CUtil::JSEscape(SITE_ID)?>',
            'template': '<?=CUtil::JSEscape($this->__name)?>',
            'ajax': '<?=($arParams["AJAX"] == 'Y')?>',
        });
    }
</script>
