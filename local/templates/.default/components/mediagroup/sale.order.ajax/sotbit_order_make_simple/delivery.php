<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<script>
	function fShowStore(id, showImages, formWidth, siteId)
	{
		var strUrl = '<?=$templateFolder?>' + '/map.php';
		var strUrlPost = 'delivery=' + id + '&showImages=' + showImages + '&siteId=' + siteId;

		var storeForm = new BX.CDialog({
					'title': '<?=GetMessage('SOA_ORDER_GIVE')?>',
					head: '',
					'content_url': strUrl,
					'content_post': strUrlPost,
					'width': formWidth,
					'height':450,
					'resizable':false,
					'draggable':false
				});

		var button = [
				{
					title: '<?=GetMessage('SOA_POPUP_SAVE')?>',
					id: 'crmOk',
					'action': function ()
					{
						GetBuyerStore();
						BX.WindowManager.Get().Close();
					}
				},
				BX.CDialog.btnCancel
			];
		storeForm.ClearButtons();
		storeForm.SetButtons(button);
		storeForm.Show();
	}

	function GetBuyerStore()
	{
		BX('BUYER_STORE').value = BX('POPUP_STORE_ID').value;
		//BX('ORDER_DESCRIPTION').value = '<?=GetMessage("SOA_ORDER_GIVE_TITLE")?>: '+BX('POPUP_STORE_NAME').value;
		BX('store_desc').innerHTML = BX('POPUP_STORE_NAME').value;
		BX.show(BX('select_store'));
	}

	function showExtraParamsDialog(deliveryId)
	{
		var strUrl = '<?=$templateFolder?>' + '/delivery_extra_params.php';
		var formName = 'extra_params_form';
		var strUrlPost = 'deliveryId=' + deliveryId + '&formName=' + formName;

		if(window.BX.SaleDeliveryExtraParams)
		{
			for(var i in window.BX.SaleDeliveryExtraParams)
			{
				strUrlPost += '&'+encodeURI(i)+'='+encodeURI(window.BX.SaleDeliveryExtraParams[i]);
			}
		}

		var paramsDialog = new BX.CDialog({
			'title': '<?=GetMessage('SOA_ORDER_DELIVERY_EXTRA_PARAMS')?>',
			head: '',
			'content_url': strUrl,
			'content_post': strUrlPost,
			'width': 500,
			'height':200,
			'resizable':true,
			'draggable':false
		});

		var button = [
			{
				title: '<?=GetMessage('SOA_POPUP_SAVE')?>',
				id: 'saleDeliveryExtraParamsOk',
				'action': function ()
				{
					insertParamsToForm(deliveryId, formName);
					BX.WindowManager.Get().Close();
				}
			},
			BX.CDialog.btnCancel
		];

		paramsDialog.ClearButtons();
		paramsDialog.SetButtons(button);
		//paramsDialog.adjustSizeEx();
		paramsDialog.Show();
	}

	function insertParamsToForm(deliveryId, paramsFormName)
	{
		var orderForm = BX("ORDER_FORM"),
			paramsForm = BX(paramsFormName);
			wrapDivId = deliveryId + "_extra_params";

		var wrapDiv = BX(wrapDivId);
		window.BX.SaleDeliveryExtraParams = {};

		if(wrapDiv)
			wrapDiv.parentNode.removeChild(wrapDiv);

		wrapDiv = BX.create('div', {props: { id: wrapDivId}});

		for(var i = paramsForm.elements.length-1; i >= 0; i--)
		{
			var input = BX.create('input', {
				props: {
					type: 'hidden',
					name: 'DELIVERY_EXTRA['+deliveryId+']['+paramsForm.elements[i].name+']',
					value: paramsForm.elements[i].value
					}
				}
			);

			window.BX.SaleDeliveryExtraParams[paramsForm.elements[i].name] = paramsForm.elements[i].value;

			wrapDiv.appendChild(input);
		}

		orderForm.appendChild(wrapDiv);

		BX.onCustomEvent('onSaleDeliveryGetExtraParams',[window.BX.SaleDeliveryExtraParams]);
	}

	if(typeof submitForm === 'function')
		BX.addCustomEvent('onDeliveryExtraServiceValueChange', function(){ submitForm(); });
</script>

<input type="hidden" name="BUYER_STORE" id="BUYER_STORE" value="<?=$arResult["BUYER_STORE"]?>">


	<?
	if(!empty($arResult["DELIVERY"]))
	{
		$width = ($arParams["SHOW_STORES_IMAGES"] == "Y") ? 850 : 700;
        ?>
       
         <?
        
         global $find_delivery;
          $find_delivery = false;


            foreach($arResult["DELIVERY"] as $delivery_id => $arDelivery)
            {

                if($arDelivery["CHECKED"]=="Y"){
                    global $delivery_type;
                    $delivery_type = $arDelivery['ID'];
                }

               
                
               

                  if($arResult['DELIVERY_CUSTOM'][$arDelivery['ID']]['XML_ID']!='samovivoz'){
                      $find_delivery = true;
                 }

               

                if($arDelivery["ISNEEDEXTRAINFO"] == "Y")
                    $extraParams = "showExtraParamsDialog('".$delivery_id."');";
                else
                    $extraParams = "";

                if (count($arDelivery["STORE"]) > 0)
                    // $clickHandler = "onClick = \"fShowStore('".$arDelivery["ID"]."','".$arParams["SHOW_STORES_IMAGES"]."','".$width."','".SITE_ID."')\";";
                    $clickHandler = "";
                else
                    $clickHandler = "onClick = \"BX('ID_DELIVERY_ID_".$arDelivery["ID"]."').checked=true;".$extraParams."submitForm();\"";
                ?>




            

                
                        
                      
                  

                    <label for="ID_DELIVERY_ID_<?=$arDelivery["ID"]?>" class="radio">
                     
                           <input type="radio"
                        id="ID_DELIVERY_ID_<?= $arDelivery["ID"] ?>"
                        name="<?=htmlspecialcharsbx($arDelivery["FIELD_NAME"])?>"
                        value="<?= $arDelivery["ID"] ?>"<?if ($arDelivery["CHECKED"]=="Y") echo " checked";?>
                                onclick="submitForm();" class="radio__input"
                    >
                    <div class="radio__custom">
                          <svg class="radio__icon">
                            <use xlink:href="#checked"></use>
                          </svg>
                        </div>

                          <span class="radio__text">
                         <?=htmlspecialcharsbx($arDelivery["NAME"])?>
                        </span>


                 
                           

                            <span style="display: none;" class="radio_container_comment fonts__main_comment">
                                <?
                                if(isset($arDelivery["PRICE"]))
                                {
                                    echo GetMessage("SALE_DELIV_PRICE").": ";
                                    if(isset($arDelivery['DELIVERY_DISCOUNT_PRICE'])
                                        && round($arDelivery['DELIVERY_DISCOUNT_PRICE'], 4) != round($arDelivery["PRICE"], 4))
                                    {
                                        echo(strlen($arDelivery["DELIVERY_DISCOUNT_PRICE_FORMATED"]) > 0 ? $arDelivery["DELIVERY_DISCOUNT_PRICE_FORMATED"] : number_format($arDelivery["DELIVERY_DISCOUNT_PRICE"], 2, ',', ' '));
                                        echo "<br/><span style='text-decoration:line-through;color:#828282;'>".(strlen($arDelivery["PRICE_FORMATED"]) > 0 ? $arDelivery["PRICE_FORMATED"] : number_format($arDelivery["PRICE"], 2, ',', ' '))."</span>";
                                    }
                                    else
                                    {
                                        echo(strlen($arDelivery["PRICE_FORMATED"]) > 0 ? $arDelivery["PRICE_FORMATED"] : number_format($arDelivery["PRICE"], 2, ',', ' '));
                                    }
                                    echo "<br />";

                                    if(strlen($arDelivery["PERIOD_TEXT"]) > 0)
                                    {
                                        echo GetMessage('SALE_SADC_TRANSIT').": ".$arDelivery["PERIOD_TEXT"];
                                        echo '<br />';
                                    }
                                    if($arDelivery["PACKS_COUNT"] > 1)
                                    {
                                        echo '<br />';
                                        echo GetMessage('SALE_SADC_PACKS').': '.$arDelivery["PACKS_COUNT"];
                                    }
                                }
                                elseif(isset($arDelivery["CALCULATE_ERRORS"]))
                                {
                                    ShowError($arDelivery["CALCULATE_ERRORS"]);
                                }
                                else
                                {
                                    $APPLICATION->IncludeComponent('bitrix:sale.ajax.delivery.calculator', '', array(
                                        "NO_AJAX" => $arParams["DELIVERY_NO_AJAX"],
                                        "DELIVERY_ID" => $delivery_id,
                                        "ORDER_WEIGHT" => $arResult["ORDER_WEIGHT"],
                                        "ORDER_PRICE" => $arResult["ORDER_PRICE"],
                                        "LOCATION_TO" => $arResult["USER_VALS"]["DELIVERY_LOCATION"],
                                        "LOCATION_ZIP" => $arResult["USER_VALS"]["DELIVERY_LOCATION_ZIP"],
                                        "CURRENCY" => $arResult["BASE_LANG_CURRENCY"],
                                        "ITEMS" => $arResult["BASKET_ITEMS"],
                                        "EXTRA_PARAMS_CALLBACK" => $extraParams,
                                        "ORDER_DATA" => $arResult['ORDER_DATA']
                                    ), null, array('HIDE_ICONS' => 'Y'));
                                }

                                /*if(strlen($arDelivery["DESCRIPTION"])>0)
                                    echo $arDelivery["DESCRIPTION"]."<br />";*/

                                if(count($arDelivery["STORE"]) > 0 && $arDelivery['CHECKED'] == 'Y')
                                {
                                    ?>
                                    <span id="select_store"<?if(strlen($arResult["STORE_LIST"][$arResult["BUYER_STORE"]]["TITLE"]) <= 0) echo " style=\"display:none;\"";?>>
                                        <span class="select_store"><?=GetMessage('SOA_ORDER_GIVE_TITLE');?>: </span>
                                        <span class="ora-store" id="store_desc"><?=htmlspecialcharsbx($arResult["STORE_LIST"][$arResult["BUYER_STORE"]]["TITLE"])?></span>
                                    </span>
                                    <?
                                }
                                ?>
                            </span>
                       
                    </label>

                    <?if($arDelivery['CHECKED'] == 'Y'):?>
                        <table class="delivery_extra_services">
                            <?foreach ($arDelivery['EXTRA_SERVICES'] as $extraServiceId => $extraService):?>
                                <?if(!$extraService->canUserEditValue()) continue;?>
                                <tr>
                                    <td class="name">
                                        <?=$extraService->getName()?>
                                    </td>
                                    <td class="control">
                                        <?=$extraService->getEditControl('DELIVERY_EXTRA_SERVICES['.$arDelivery['ID'].']['.$extraServiceId.']')?>
                                    </td>
                                    <td rowspan="2" class="price">
                                        <?
                                        if($price = $extraService->getPrice())
                                        {
                                            echo GetMessage('SOA_TEMPL_SUM_PRICE').': ';
                                            echo '<strong>'.SaleFormatCurrency($price, $arResult['BASE_LANG_CURRENCY']).'</strong>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="description">
                                        <?=$extraService->getDescription()?>
                                    </td>
                                </tr>
                            <?endforeach?>
                        </table>
                    <?endif?>
              

                <?
            }
            ?>
      
        <?
	}


 
   if(!$find_delivery):
    ?>

    <label for="ID_DELIVERY_ID_000" class="radio">
                     
                           <input type="radio" disabled id="ID_DELIVERY_ID_000" name="DELIVERY_ID" value="1" class="radio__input">
                    <div class="radio__custom">
                          <svg class="radio__icon">
                            <use xlink:href="#checked"></use>
                          </svg>
                        </div>

                          <span class="radio__text dis">
                         Доставка курьером                        </span>

                 </label>


                 <?
                  //по ID города, проверяем, подходит ли в доставку
                 ?>

                  <? 
                     $GLOBALS['hide_next_error'] = true;
                  //Проверяем регион или Москва 
                
                  if($arResult["ORDER_PROP"]["USER_PROPS_Y"][18] == 92)
                  {
                    //Москва
                    $min = 5000;

                  }
                  else
                  {
                    //Регион
                    $min = 15000;
                  }
                  ?>
                <? if($min>$arResult["ORDER_TOTAL_PRICE"]):?>
                <p class="error_text_delivery">Доставка осуществляется при заказе от <span>5 000 рублей</span> по Москве и <span>15 000 рублей</span> по регионам.
                <br>Сумма Ваших покупок - <span><?=$arResult["ORDER_TOTAL_PRICE"]?> рублей.</span></p>
                <?php endif; ?>
                <? 

                
                if($min>$arResult["ORDER_TOTAL_PRICE"] || !$find_delivery){
                   $GLOBALS['hide_next_error'] = false;
                }



                ?>
<?endif;?>


<?

$city = $arResult["ORDER_PROP"]["USER_PROPS_Y"][18];


if(!$find_delivery){
    $city = 92;
}
                  if($city == 92)
                  {
                    //Москва
                    $min = 5000;

                  }
                  else
                  {
                    //Регион
                    $min = 15000;
                  }
                  


                if($min>$arResult["ORDER_TOTAL_PRICE"] ){
                   $GLOBALS['hide_next_error'] = true;
                }

                ?>

