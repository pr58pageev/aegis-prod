<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);



/* after refresh order




CModule::IncludeModule("iblock");   
$value['VALUE'][0] = trim($arResult['USER_VALS']['ORDER_PROP'][ID_ORDER_PROP_ADDRES]);
$rsItems = CIBlockElement::GetList(array(),array(
'IBLOCK_ID' =>IBLOCK_PROFILE_ADDRESS,
'PREVIEW_TEXT' => $value['VALUE'][0]
),false,false,array('ID'));
if ($arItem = $rsItems->GetNext())
{
}
else
{
$el = new CIBlockElement;
$PROP = array();
$PROP[634] = $arResult['USER_VALS']['PROFILE_ID'];   

  $arLoadProductArray = Array(
   "IBLOCK_SECTION_ID" => false,        
    "IBLOCK_ID"      => IBLOCK_PROFILE_ADDRESS,
    "PROPERTY_VALUES"=> $PROP,
    "NAME"           => $value['VALUE'][0],
    "ACTIVE"         => "Y",           
    "PREVIEW_TEXT"   => $value['VALUE'][0],
     );

 $PRODUCT_ID = $el->Add($arLoadProductArray);

}

/*end refresh*/
$min = COption::GetOptionString("mediagroup.registration", "MIN_SUMM");
if($min>$arResult['ORDER_TOTAL_PRICE']){
LocalRedirect('/personal/cart/');
    exit;
}

foreach($arResult["GRID"]["HEADERS"] as $headerId)
    $arHeaders[] = $headerId["id"];
?>
 <? include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props.php"); ?>
<!-- aside -->
            <aside class="decoration-aside">
              <div class="decoration-aside-header">
                <h6 class="decoration__subtitle">
                <?=Loc::getMessage("SALE_PRODUCTS")?>
                </h6>

                <span class="decoration-aside__count">
                  <em><?=$quantity?></em>
                 <?=$quantityLabel?>
                </span>
              </div>

              <div class="decoration-aside-body">
                <div class="decoration-aside-scroller" id="basket_rows">
                    <a href="/b2bcabinet/change_basket/?ID_ORDER=<?=$_GET['ID_ORDER']?>">Изменить товары в корзине</a>
                    <br>
                    <br>
                    <?
            $i = 0;
            foreach($arResult["GRID"]["ROWS"] as $arData)
            {
                $arItem = $arData["data"];
                $i++;
                if(strlen($arItem["DETAIL_PAGE_URL"]) > 0)
                $detailPageUrl = $arItem["DETAIL_PAGE_URL"];
                $intElementID = $arItem['PRODUCT_ID']; 
                
                $mxResult = CCatalogSku::GetProductInfo($intElementID);
                if (is_array($mxResult))
                {

                }

                $res = CIBlockElement::GetByID($mxResult["ID"]);
                if($ar_res = $res->GetNext()){
                  $ar_new_info = $ar_res;
                }
                if(empty($ar_new_info)):
                  $res = CIBlockElement::GetByID($arItem['PRODUCT_ID']);
                  if($ar_res = $res->GetNext()){
                    $ar_new_info = $ar_res;
                  }

                endif;
                
  

  //detailPageUrl
                    
                    ?>

                  <div class="decoration-aside-product">
                    <div class="decoration-aside-product-info">
                      <span class="decoration-aside-product__title">
                       <?=substr($ar_new_info["NAME"], 0, 30);?> 
                      </span>

                      <span
                        class="decoration-aside-product__title decoration-aside-product__title--full"
                      >
                       <?=$ar_new_info["NAME"]?> 
                      </span>
                      <?php// pre($arItem); ?>

                      <span class="decoration-aside-product__desc">
                      <?/*  1 уп. (Кол-во в упаковке: 6)*/?>
                          <?=$arItem["QUANTITY"]?> 

                          <?
                          $arResult['NAMES_PRODUCT_OFFERS'] = array();
$arSelect = Array("*");
$arFilter = Array("IBLOCK_CODE" => NEW_NAMES_IBLOCK_CODE);
$res = CIBlockElement::GetList(Array('SORT'=>'ASC'), $arFilter, false, Array(), $arSelect);
while ($ob = $res->fetch()) {
   


    if($ob['NAME']==$arItem["PROPS"][0]['VALUE']){

      $arItem["PROPS"][0]['VALUE'] = $ob['PREVIEW_TEXT'];
    }

}
echo $arItem["PROPS"][0]['VALUE'];
?>

                      </span>
                    </div>

                    <em class="decoration-aside-product__price">
                      <?=$arItem["SUM"]?>
                    </em>
                  </div>

                   

                 
            
                <?
            }
            ?>
              
             
                 
                  
                </div>
              </div>

              <div class="decoration-aside-footer">
                <div class="decoration-aside-result">
                  <div class="decoration-aside-result-row">
                    <span class="decoration-aside-result-row__text">
                      Доставка
                    </span>

                    <em class="decoration-aside-result-row__price">
                       <?=$arResult["DELIVERY_PRICE_FORMATED"]?>
                    </em>
                  </div>

                  <div
                    class="decoration-aside-result-row decoration-aside-result-row--big"
                  >
                    <span class="decoration-aside-result-row__text">
                      Итого:
                    </span>

                    <em class="decoration-aside-result-row__price">
                    <?=$arResult["ORDER_TOTAL_PRICE_FORMATED"]?>
                    </em>
                  </div>

                  <?
                   if(!empty($arResult["TAX_LIST"]))
                        {
                            foreach($arResult["TAX_LIST"] as $val)
                            {
                                ?>
                                <div class="price_order_block__item fonts__small_text">
                                    <?=$val["NAME"]?> <?=$val["VALUE_FORMATED"]?>:
                                    <b><?=$val["VALUE_MONEY_FORMATED"]?></b>
                                </div>
                                <?
                            }
                        }
                        ?>
                </div>

                <div class="decoration-aside-pay">
                  <span class="decoration-aside-pay__title">
                    Способ оплаты
                  </span>

                  <?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");?>
                  
                </div>

                <button type="submit" class="main_btn" onclick="submitForm('Y'); return false;" id="ORDER_CONFIRM_BUTTON">
                  Сохранить изменения
                </button>

                <?/*
                 <div id="sotbit-bx-soa-orderSave" class="order_block__ordering_btn">
                                    <input type="submit"  class="main_btn sweep-to-right" value="<?=Loc::getMessage("SOA_TEMPL_BUTTON")?>">
                                </div>
                                */?>

                                 <?
                                    if($arParams['USER_CONSENT'] === 'Y')
                                    {
                                        $APPLICATION->IncludeComponent(
                                            "bitrix:main.userconsent.request",
                                            "sotbit_userconsent_request",
                                            array(
                                                'ID' => $arParams['USER_CONSENT_ID'],
                                                'IS_CHECKED' => $arParams['USER_CONSENT_IS_CHECKED'],
                                                'IS_LOADED' => $arParams['USER_CONSENT_IS_LOADED'],
                                                'AUTO_SAVE' => 'N',
                                                'REPLACE' => array(
                                                    'button_caption' => Loc::getMessage("SOA_TEMPL_BUTTON"),
                                                    'fields' => $arResult['USER_CONSENT_PROPERTY_DATA']
                                                )
                                            )
                                        );
                                    }
                                    ?>
   
                <label for="cbx3" class="label-cbx">
                  <input
                    id="cbx3"
                    type="checkbox"
                    class=""
                    name="STATUS_CH"
                    checked="checked"
                  />

                  <span class="checkbox">
                    <svg width="20px" height="20px" viewBox="0 0 20 20">
                      <path
                        d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695
                      18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305
                      1.8954305,1 3,1 Z"
                      ></path>
                      <polyline points="4 11 8 15 16 6"></polyline>
                    </svg>
                  </span>
                  <span class="feedback_block__compliance_title fonts__middle_comment">
                     <? $APPLICATION->IncludeComponent(
                         "bitrix:main.include",
                         "",
                         Array(
                             "AREA_FILE_SHOW" => "file",
                             "PATH" => SITE_DIR."include/order_chernovik_text.php"
                         )
                     );?>
                  </span>
                  
                </label>
              </div>
            </aside>
            <!-- ./End of aside -->