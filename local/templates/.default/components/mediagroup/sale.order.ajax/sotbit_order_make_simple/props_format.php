<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
if(!function_exists("showFilePropertyField"))
{
	function showFilePropertyField($name, $property_fields, $values, $max_file_size_show = 50000)
	{
		$res = "";

		if(!is_array($values) || empty($values))
			$values = array(
				"n0" => 0,
			);

		if($property_fields["MULTIPLE"] == "N")
		{
			$res = "<label for=\"\"><input type=\"file\" size=\"".$max_file_size_show."\" value=\"".$property_fields["VALUE"]."\" name=\"".$name."[0]\" id=\"".$name."[0]\"></label>";
		}
		else
		{
			$res = '
			<script type="text/javascript">
				function addControl(item)
				{
					var current_name = item.id.split("[")[0],
						current_id = item.id.split("[")[1].replace("[", "").replace("]", ""),
						next_id = parseInt(current_id) + 1;

					var newInput = document.createElement("input");
					newInput.type = "file";
					newInput.name = current_name + "[" + next_id + "]";
					newInput.id = current_name + "[" + next_id + "]";
					newInput.onchange = function() { addControl(this); };

					var br = document.createElement("br");
					var br2 = document.createElement("br");

					BX(item.id).parentNode.appendChild(br);
					BX(item.id).parentNode.appendChild(br2);
					BX(item.id).parentNode.appendChild(newInput);
				}
			</script>
			';

			$res .= "<label for=\"\"><input type=\"file\" size=\"".$max_file_size_show."\" value=\"".$property_fields["VALUE"]."\" name=\"".$name."[0]\" id=\"".$name."[0]\"></label>";
			$res .= "<br/><br/>";
			$res .= "<label for=\"\"><input type=\"file\" size=\"".$max_file_size_show."\" value=\"".$property_fields["VALUE"]."\" name=\"".$name."[1]\" id=\"".$name."[1]\" onChange=\"javascript:addControl(this);\"></label>";
		}

		return $res;
	}
}

if(!function_exists("PrintPropsFormPerson"))
{
	function PrintPropsFormPerson($arSource = array(), $locationTemplate = ".default", $valuesss = array())
	{
		if(!empty($arSource))
		{

			?>
		
				<?
				foreach($arSource as $arProperties)
				{
					
					if($arProperties['CODE']=='COMPANY' || $arProperties['CODE']=='INN' || $arProperties['CODE']=='OOO_IP'){
						
					
						

					

					


                    $reqSymbol = '';
                    if($arProperties["REQUIED_FORMATED"] == "Y")
                        $reqSymbol = '*';
					?>
                  <?/*=$arProperties["NAME"] 
                    <div data-property-id-row="<?=intval(intval($arProperties["ID"]))?>">
                        
                        */?>
						<?
						if($arProperties["TYPE"] == "CHECKBOX")
						{
							?>
							<div class="bx_block r1x3 pt8">
								<input type="hidden" name="<?=$arProperties["FIELD_NAME"]?>" value="">
								<input type="checkbox" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" value="Y"<?if ($arProperties["CHECKED"]=="Y") echo " checked";?>>
								<?if (strlen(trim($arProperties["DESCRIPTION"])) > 0):?>
									<div class="bx_description"><?=$arProperties["DESCRIPTION"]?></div>
								<?endif?>
							</div>
							<?
						}
						elseif($arProperties["TYPE"] == "TEXT")
						{

							?>
						
                                <input type="text" maxlength="250"
                                         class="input decoration__input <?=$reqSymbol ? "required" : ""?>"
                                        placeholder="<?=$arProperties["NAME"]?><?=$reqSymbol?>"
                                        size="<?=$arProperties["SIZE"]?>"
                                        value="<?=$arProperties["VALUE"]?>"
                                        name="<?=$arProperties["FIELD_NAME"]?>"
                                        id="<?=$arProperties["FIELD_NAME"]?>" onchange="onChangeValidation(this)">
								<?/*
								<?if(strlen(trim($arProperties["DESCRIPTION"])) > 0):?>
									<div class="bx_description"><?=$arProperties["DESCRIPTION"]?></div>
								<?endif?>
								*/?>


							
						
							<?
						}
						elseif($arProperties["TYPE"] == "SELECT")
						{

							?>
							<div
                        id="man3"
                        class="decoration-dropdown j_dropdown j_naming"
                        data-dropdown-select
                      >
							
								<select  data-dropdown-select-node
                          class="decoration-dropdown__select field_<?=$arProperties["CODE"]?>"
                          name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
									<?
									$selected_tr = false;
									unset($arSelected);

										foreach($arProperties["VARIANTS"] as $arVariants):
												

									if($arVariants["VALUE"] == $valuesss[34]):
										$selected_tr = true;
										$arSelected = $arVariants;
									endif;?>
										<option value="<?=$arVariants["VALUE"]?>"<?=$valuesss[34] == $arVariants['VALUE'] ? " selected" : ''?>><?=$arVariants["NAME"]?></option>


									<?endforeach?>
									<option <?if($selected_tr==false){echo 'selected';}?> value="Выберите тип: Юр. лицо или ИП">Выберите тип: Юр. лицо или ИП</option>
								</select>

								 <button
                          data-dropdown-target="#man3"
                          class="decoration-dropdown__button j_toggleDropdown"
                          type="button"
                        >
                        <?php if($selected_tr):?>
							 <span
                            data-naming="<?=$arSelected['VALUE']?>"
                            class="decoration-dropdown_title"
                          >
                         <?=$arSelected['NAME']?>
                          </span>
                        	<?php else: ?>
						 <span
                            data-naming="Выберите тип: Юр. лицо или ИП"
                            class="decoration-dropdown_title"
                          >
                            Выберите тип: Юр. лицо или ИП
                          </span>
                        	<?php endif; ?>
                         

                          <svg class="decoration-dropdown__arrow">
                            <use xlink:href="#arrow"></use>
                          </svg>
                        </button>

                        <div
                          data-naming-triggers=""
                          class="decoration-dropdown-content"
                        >
                          <div class="decoration-dropdown-content-scroller">
                          	<?foreach($arProperties["VARIANTS"] as $arVariants):?>
										
							
									  <label class="radio">
                              <input
                                class="radio__input"
                                type="radio"
                                name="man3"
                                value="<?=$arVariants["VALUE"]?>"
                              />
                              <span class="radio__text">
                               <?=$arVariants["NAME"]?>
                              </span>
                            </label>

                            		<?endforeach?>
                          
                          </div>
                        </div>
                    </div>

								
						
							<?
						}
						elseif($arProperties["TYPE"] == "MULTISELECT")
						{
							?>
							<div class="bx_block r3x1">
								<select multiple name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
									<?foreach($arProperties["VARIANTS"] as $arVariants):?>
										<option value="<?=$arVariants["VALUE"]?>"<?=$arVariants["SELECTED"] == "Y" ? " selected" : ''?>><?=$arVariants["NAME"]?></option>
									<?endforeach?>
								</select>
								<?if (strlen(trim($arProperties["DESCRIPTION"])) > 0):?>
									<div class="bx_description"><?=$arProperties["DESCRIPTION"]?></div>
								<?endif?>
							</div>
							<?
						}
						elseif($arProperties["TYPE"] == "TEXTAREA")
						{
							?>
							<div>
                                <textarea rows="<?=$arProperties["ROWS"]?>" cols="<?=$arProperties["COLS"]?>"
                                          class="fonts__middle_comment <?=$reqSymbol ? "required" : ""?>"
                                          placeholder="<?=$arProperties["NAME"]?><?=$reqSymbol?>"
                                          name="<?=$arProperties["FIELD_NAME"]?>"
                                          id="<?=$arProperties["FIELD_NAME"]?>" onchange="onChangeValidation(this)"><?=$arProperties["VALUE"]?></textarea>
								<?if(strlen(trim($arProperties["DESCRIPTION"])) > 0):?>
									<div class="bx_description"><?=$arProperties["DESCRIPTION"]?></div>
								<?endif?>
							</div>
							<?
						}
						elseif($arProperties["TYPE"] == "LOCATION")
						{
							?>
							<div>
								<?
								$value = 0;
								if(is_array($arProperties["VARIANTS"]) && count($arProperties["VARIANTS"]) > 0)
								{
									foreach($arProperties["VARIANTS"] as $arVariant)
									{
										if($arVariant["SELECTED"] == "Y")
										{
											$value = $arVariant["ID"];
											break;
										}
									}
								}

								// here we can get '' or 'popup'
								// map them, if needed
								if(CSaleLocation::isLocationProMigrated())
								{
									$locationTemplateP = $locationTemplate == 'popup' ? 'search' : 'steps';
									$locationTemplateP = $_REQUEST['PERMANENT_MODE_STEPS'] == 1 ? 'steps' : $locationTemplateP; // force to "steps"
								}
								?>

								<?if($locationTemplateP == 'steps'):?>
									<input type="hidden" id="LOCATION_ALT_PROP_DISPLAY_MANUAL[<?=intval($arProperties["ID"])?>]" name="LOCATION_ALT_PROP_DISPLAY_MANUAL[<?=intval($arProperties["ID"])?>]" value="<?=($_REQUEST['LOCATION_ALT_PROP_DISPLAY_MANUAL'][intval($arProperties["ID"])] ? '1' : '0')?>">
								<?endif?>

								<?CSaleLocation::proxySaleAjaxLocationsComponent(
                                    array(
                                        "AJAX_CALL" => "N",
                                        "COUNTRY_INPUT_NAME" => "COUNTRY",
                                        "REGION_INPUT_NAME" => "REGION",
                                        "CITY_INPUT_NAME" => $arProperties["FIELD_NAME"],
                                        "CITY_OUT_LOCATION" => "Y",
                                        "LOCATION_VALUE" => $value,
                                        "ORDER_PROPS_ID" => $arProperties["ID"],
                                        "ONCITYCHANGE" => ($arProperties["IS_LOCATION"] == "Y" || $arProperties["IS_LOCATION4TAX"] == "Y") ? "submitForm()" : "",
                                        "SIZE1" => $arProperties["SIZE1"],
                                    ),
									array(
										"ID" => $value,
										"CODE" => "",
										"SHOW_DEFAULT_LOCATIONS" => "Y",

										// function called on each location change caused by user or by program
										// it may be replaced with global component dispatch mechanism coming soon
										"JS_CALLBACK" => "submitFormProxy",

										// function window.BX.locationsDeferred['X'] will be created and lately called on each form re-draw.
										// it may be removed when sale.order.ajax will use real ajax form posting with BX.ProcessHTML() and other stuff instead of just simple iframe transfer
										"JS_CONTROL_DEFERRED_INIT" => intval($arProperties["ID"]),

										// an instance of this control will be placed to window.BX.locationSelectors['X'] and lately will be available from everywhere
										// it may be replaced with global component dispatch mechanism coming soon
										"JS_CONTROL_GLOBAL_ID" => intval($arProperties["ID"]),

										"DISABLE_KEYBOARD_INPUT" => "Y",
										"PRECACHE_LAST_LEVEL" => "Y",
										"PRESELECT_TREE_TRUNK" => "Y",
										"SUPPRESS_ERRORS" => "Y"
									),
									$locationTemplateP,
									true
								)?>

								<?if(strlen(trim($arProperties["DESCRIPTION"])) > 0):?>
									<div class="bx_description"><?=$arProperties["DESCRIPTION"]?></div>
								<?endif?>
							</div>
							<?
						}
						elseif($arProperties["TYPE"] == "RADIO")
						{
							?>
							<div class="bx_block r3x1">
								<?
								if (is_array($arProperties["VARIANTS"]))
								{
									foreach($arProperties["VARIANTS"] as $arVariants):
									?>
										<input
											type="radio"
											name="<?=$arProperties["FIELD_NAME"]?>"
											id="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["VALUE"]?>"
											value="<?=$arVariants["VALUE"]?>" <?if($arVariants["CHECKED"] == "Y") echo " checked";?> />

										<label for="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["VALUE"]?>"><?=$arVariants["NAME"]?></label></br>
									<?
									endforeach;
								}
								?>
								<?if (strlen(trim($arProperties["DESCRIPTION"])) > 0):?>
									<div class="bx_description"><?=$arProperties["DESCRIPTION"]?></div>
								<?endif?>
							</div>
							<?
						}
						elseif($arProperties["TYPE"] == "FILE")
						{
							?>
							<div class="bx_block r3x1">
								<?=showFilePropertyField("ORDER_PROP_".$arProperties["ID"], $arProperties, $arProperties["VALUE"], $arProperties["SIZE1"])?>
								<?if (strlen(trim($arProperties["DESCRIPTION"])) > 0):?>
									<div class="bx_description"><?=$arProperties["DESCRIPTION"]?></div>
								<?endif?>
							</div>
							<?
						}
						elseif($arProperties["TYPE"] == "DATE")
						{
							?>
							<div>
								<?
								global $APPLICATION;

								$APPLICATION->IncludeComponent('bitrix:main.calendar', '', array(
									'SHOW_INPUT' => 'Y',
									'INPUT_NAME' => "ORDER_PROP_".$arProperties["ID"],
									'INPUT_VALUE' => $arProperties["VALUE"],
									'SHOW_TIME' => 'N'
								), null, array('HIDE_ICONS' => 'N'));
								?>
								<?if (strlen(trim($arProperties["DESCRIPTION"])) > 0):?>
									<div class="bx_description"><?=$arProperties["DESCRIPTION"]?></div>
								<?endif?>
							</div>
							<?
						}
						?>
					

					<?if(CSaleLocation::isLocationProEnabled()):?>

					<?
					$propertyAttributes = array(
						'type' => $arProperties["TYPE"],
						'valueSource' => $arProperties['SOURCE'] == 'DEFAULT' ? 'default' : 'form' // value taken from property DEFAULT_VALUE or it`s a user-typed value?
					);

					if(intval($arProperties['IS_ALTERNATE_LOCATION_FOR']))
						$propertyAttributes['isAltLocationFor'] = intval($arProperties['IS_ALTERNATE_LOCATION_FOR']);

					if(intval($arProperties['CAN_HAVE_ALTERNATE_LOCATION']))
						$propertyAttributes['altLocationPropId'] = intval($arProperties['CAN_HAVE_ALTERNATE_LOCATION']);

					if($arProperties['IS_ZIP'] == 'Y')
						$propertyAttributes['isZip'] = true;
					?>

						<script>

							<?// add property info to have client-side control on it?>
							(window.top.BX || BX).saleOrderAjax.addPropertyDesc(<?=CUtil::PhpToJSObject(array(
									'id' => intval($arProperties["ID"]),
									'attributes' => $propertyAttributes
								))?>);

						</script>
					<?endif?>

					
					<?
					}
				}
				?>
			
			<?
		}
	}
}


if(!function_exists("PrintPropsFormPersonOnlyText"))
{
	function PrintPropsFormPersonOnlyText($arSource = array(), $locationTemplate = ".default")
	{
		if(!empty($arSource))
		{
			?>

				<?
				foreach($arSource as $arProperties)
				{


					if($arProperties['CODE']=='COMPANY' || $arProperties['CODE']=='INN' || $arProperties['CODE']=='OOO_IP'){










                    $reqSymbol = '';
                    if($arProperties["REQUIED_FORMATED"] == "Y")
                        $reqSymbol = '*';
					?>

						<?
						if($arProperties["TYPE"] == "TEXT")
						{
							?>

							<span class="decoration__subtext">
                    				 <?=$arProperties["VALUE"]?>
                    		</span>
							<?
						}else{
							?>
								<span class="decoration__subtext">
                    				 <?//=$arProperties["VALUE"][0]?>
                    				 <?=$arProperties["VALUE_FORMATED"]?>
                    		</span>
                    		<?

						}

						?>


					<?if(CSaleLocation::isLocationProEnabled()):?>

					<?
					$propertyAttributes = array(
						'type' => $arProperties["TYPE"],
						'valueSource' => $arProperties['SOURCE'] == 'DEFAULT' ? 'default' : 'form' // value taken from property DEFAULT_VALUE or it`s a user-typed value?
					);

					if(intval($arProperties['IS_ALTERNATE_LOCATION_FOR']))
						$propertyAttributes['isAltLocationFor'] = intval($arProperties['IS_ALTERNATE_LOCATION_FOR']);

					if(intval($arProperties['CAN_HAVE_ALTERNATE_LOCATION']))
						$propertyAttributes['altLocationPropId'] = intval($arProperties['CAN_HAVE_ALTERNATE_LOCATION']);

					if($arProperties['IS_ZIP'] == 'Y')
						$propertyAttributes['isZip'] = true;
					?>

						<script>

							<?// add property info to have client-side control on it?>
							(window.top.BX || BX).saleOrderAjax.addPropertyDesc(<?=CUtil::PhpToJSObject(array(
									'id' => intval($arProperties["ID"]),
									'attributes' => $propertyAttributes
								))?>);

						</script>
					<?endif?>


					<?
					}
				}
				?>

			<?
		}
	}
}

if(!function_exists("PrintPropsForm"))
{
	function PrintPropsForm($arSource = array(), $locationTemplate = ".default",$arValue = array())
	{

        $arShowProps = Mediagroup::getOrderPropList();

		if(!empty($arSource))
		{
			?>
		
				<?
				foreach($arSource as $arProperties)
				{

                    if(in_array($arProperties['CODE'],$arShowProps)){


					

					if($arProperties['CODE']=='COMPANY' || $arProperties['CODE']=='INN' || $arProperties['CODE']=='OOO_IP' || $arProperties['CODE']=='DATE_DELIVERY_CONFIRM'){
						
					}else{

						if($arProperties['ID']==40){
								//pre($arProperties);
						}
						

					

					


                    $reqSymbol = '';
                    if($arProperties["REQUIED_FORMATED"] == "Y")
                        $reqSymbol = '*';
					?>
                   
                        <?/*=$arProperties["NAME"]  <div data-property-id-row="<?=intval(intval($arProperties["ID"]))?>">*/?>
						<?
						if($arProperties["TYPE"] == "CHECKBOX")
						{
							?>
							<label id="get_data_profile"  class="field_<?=$arProperties['CODE']?> label-cbx" style="margin: 10px 5px;">
	
	<input type="checkbox" class="invisible" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" value="Y"<?if ($arProperties["CHECKED"]=="Y") echo " checked";?>>

    <span class="checkbox">
        <svg width="20px" height="20px" viewBox="0 0 20 20">
            <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695
            18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305
            1.8954305,1 3,1 Z"></path>
            <polyline points="4 11 8 15 16 6"></polyline>
        </svg>
    </span>
	<span class="feedback_block__compliance_title fonts__middle_comment">
       <?=$arProperties["NAME"]?>
    </span>
</label>
								

							
							
							<?
						}
						elseif($arProperties["TYPE"] == "TEXT")
						{

								if($arProperties['CODE']=='TIME_DELIV'):
										$GLOBALS['FIELDS_CSTM']['TIME_DELIV'] = $arProperties['VALUE'];
								endif;




							if($arProperties['CODE']=='PHONE'): ?>
								<input type="text"
										class="input decoration__input j_mask"
										placeholder="+7 (___) ___-__-__"
										 name="<?=$arProperties["FIELD_NAME"]?>"
										 value="<?=$arProperties["VALUE"]?>"
										/>
                    		<?else:?>
							

                                <input type="text" maxlength="250" <?if($arProperties['CODE'] == 'COORDS' || $arProperties['IS_ZIP'] == 'Y' || $arProperties['CODE']=='TEMP_ADR' || $arProperties['CODE']=='EMAIL'){echo 'style="display:none;"';}?>
                                        class="field_<?=$arProperties['CODE']?> input decoration__input <?if($arProperties['CODE'] !='CONTACT_PERSON'):?>decoration__input--small <?endif;?> <?=$reqSymbol ? "required" : ""?>"
                                        placeholder="<?=$arProperties["NAME"]?><?=$reqSymbol?>"
                                        size="<?=$arProperties["SIZE"]?>"
                                        value="<?=$arProperties["VALUE"]?>"
                                        name="<?=$arProperties["FIELD_NAME"]?>"
                                        id="<?=$arProperties["FIELD_NAME"]?>" onchange="onChangeValidation(this)">
								
						
							<?endif;
						}
						elseif($arProperties["TYPE"] == "SELECT")
						{
							?>
							<div class="bx_block r3x1">
								<select name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
									<?foreach($arProperties["VARIANTS"] as $arVariants):?>
										<option value="<?=$arVariants["VALUE"]?>"<?=$arVariants["SELECTED"] == "Y" ? " selected" : ''?>><?=$arVariants["NAME"]?></option>
									<?endforeach?>
								</select>
								<?if (strlen(trim($arProperties["DESCRIPTION"])) > 0):?>
									<div class="bx_description"><?=$arProperties["DESCRIPTION"]?></div>
								<?endif?>
							</div>
							<?
						}
						elseif($arProperties["TYPE"] == "MULTISELECT")
						{
							?>
							<div class="bx_block r3x1">
								<select multiple name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
									<?foreach($arProperties["VARIANTS"] as $arVariants):?>
										<option value="<?=$arVariants["VALUE"]?>"<?=$arVariants["SELECTED"] == "Y" ? " selected" : ''?>><?=$arVariants["NAME"]?></option>
									<?endforeach?>
								</select>
								<?if (strlen(trim($arProperties["DESCRIPTION"])) > 0):?>
									<div class="bx_description"><?=$arProperties["DESCRIPTION"]?></div>
								<?endif?>
							</div>
							<?
						}
						elseif($arProperties["TYPE"] == "TEXTAREA")
						{
							?>
							
                                <textarea rows="<?=$arProperties["ROWS"]?>" cols="<?=$arProperties["COLS"]?>"
                                          class="fonts__middle_comment <?=$reqSymbol ? "required" : ""?>"
                                          <?if($arProperties['CODE']=='ADDRESS'):?>style="display:none;"<?endif;?>
                                          placeholder="<?=$arProperties["NAME"]?><?=$reqSymbol?>"
                                          name="<?=$arProperties["FIELD_NAME"]?>"
                                          id="<?=$arProperties["FIELD_NAME"]?>" onchange="onChangeValidation(this)"><?=$arProperties["VALUE"]?></textarea>
								
							<?
						}
						elseif($arProperties["TYPE"] == "LOCATION")
						{
							global $find_delivery;
						
							?><div class="location" style=" width: 100%;display: none;">
							
								<?
								$value = 0;
								if(is_array($arProperties["VARIANTS"]) && count($arProperties["VARIANTS"]) > 0)
								{
									foreach($arProperties["VARIANTS"] as $arVariant)
									{
										if($arVariant["SELECTED"] == "Y")
										{
											$value = $arVariant["ID"];
											break;
										}
									}
								}

								$GLOBALS['FIELDS_CSTM']['LOCATION'] = $value;
								
								

								// here we can get '' or 'popup'
								// map them, if needed
								if(CSaleLocation::isLocationProMigrated())
								{
									$locationTemplateP = $locationTemplate == 'popup' ? 'search' : 'steps';
									$locationTemplateP = $_REQUEST['PERMANENT_MODE_STEPS'] == 1 ? 'steps' : $locationTemplateP; // force to "steps"
								}
								?>

								<?if($locationTemplateP == 'steps'):?>
									<input type="hidden" id="LOCATION_ALT_PROP_DISPLAY_MANUAL[<?=intval($arProperties["ID"])?>]" name="LOCATION_ALT_PROP_DISPLAY_MANUAL[<?=intval($arProperties["ID"])?>]" value="<?=($_REQUEST['LOCATION_ALT_PROP_DISPLAY_MANUAL'][intval($arProperties["ID"])] ? '1' : '0')?>">
								<?endif?>

								<?CSaleLocation::proxySaleAjaxLocationsComponent(
                                    array(
                                        "AJAX_CALL" => "N",
                                        "COUNTRY_INPUT_NAME" => "COUNTRY",
                                        "REGION_INPUT_NAME" => "REGION",
                                        "CITY_INPUT_NAME" => $arProperties["FIELD_NAME"],
                                        "CITY_OUT_LOCATION" => "Y",
                                        "LOCATION_VALUE" => $value,
                                        "ORDER_PROPS_ID" => $arProperties["ID"],
                                        "ONCITYCHANGE" => ($arProperties["IS_LOCATION"] == "Y" || $arProperties["IS_LOCATION4TAX"] == "Y") ? "submitForm()" : "",
                                        "SIZE1" => $arProperties["SIZE1"],
                                    ),
									array(
										"ID" => $value,
										"CODE" => "",
										"SHOW_DEFAULT_LOCATIONS" => "Y",

										// function called on each location change caused by user or by program
										// it may be replaced with global component dispatch mechanism coming soon
										"JS_CALLBACK" => "submitFormProxy",

										// function window.BX.locationsDeferred['X'] will be created and lately called on each form re-draw.
										// it may be removed when sale.order.ajax will use real ajax form posting with BX.ProcessHTML() and other stuff instead of just simple iframe transfer
										"JS_CONTROL_DEFERRED_INIT" => intval($arProperties["ID"]),

										// an instance of this control will be placed to window.BX.locationSelectors['X'] and lately will be available from everywhere
										// it may be replaced with global component dispatch mechanism coming soon
										"JS_CONTROL_GLOBAL_ID" => intval($arProperties["ID"]),

										"DISABLE_KEYBOARD_INPUT" => "Y",
										"PRECACHE_LAST_LEVEL" => "Y",
										"PRESELECT_TREE_TRUNK" => "Y",
										"SUPPRESS_ERRORS" => "Y"
									),
									$locationTemplateP,
									true
								)?>

							</div>
						
							<?

						}
						elseif($arProperties["TYPE"] == "RADIO")
						{
							?>
							<div class="bx_block r3x1">
								<?
								if (is_array($arProperties["VARIANTS"]))
								{
									foreach($arProperties["VARIANTS"] as $arVariants):
									?>
										<input
											type="radio"
											name="<?=$arProperties["FIELD_NAME"]?>"
											id="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["VALUE"]?>"
											value="<?=$arVariants["VALUE"]?>" <?if($arVariants["CHECKED"] == "Y") echo " checked";?> />

										<label for="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["VALUE"]?>"><?=$arVariants["NAME"]?></label></br>
									<?
									endforeach;
								}
								?>
								<?if (strlen(trim($arProperties["DESCRIPTION"])) > 0):?>
									<div class="bx_description"><?=$arProperties["DESCRIPTION"]?></div>
								<?endif?>
							</div>
							<?
						}
						elseif($arProperties["TYPE"] == "FILE")
						{
							?>
							<div class="bx_block r3x1">
								<?=showFilePropertyField("ORDER_PROP_".$arProperties["ID"], $arProperties, $arProperties["VALUE"], $arProperties["SIZE1"])?>
								<?if (strlen(trim($arProperties["DESCRIPTION"])) > 0):?>
									<div class="bx_description"><?=$arProperties["DESCRIPTION"]?></div>
								<?endif?>
							</div>
							<?
						}
						elseif($arProperties["TYPE"] == "DATE")
						{

							$GLOBALS['FIELDS_CSTM']['DATE'] = $arProperties['VALUE'];
							?>
							
							<input
                        type="text"
                        class="field_DATE input decoration__input decoration__input--small j_datepicker"
                        
                       readonly="readonly"
                         data-value-n="<?=$arProperties["VALUE"]?>"
                        name="ORDER_PROP_<?=$arProperties["ID"]?>"
                      />

								<?
						
                          
                        

								if($arProperties["VALUE"]):
									echo '<p class="error_text_delivery error_blij">Ближайшая доставка - <span id="blij_delivery"></span></p>';
								endif;
								/*
								global $APPLICATION;

								$APPLICATION->IncludeComponent('bitrix:main.calendar', '', array(
									'SHOW_INPUT' => 'Y',
									'INPUT_NAME' => "ORDER_PROP_".$arProperties["ID"],
									'INPUT_VALUE' => $arProperties["VALUE"],
									'SHOW_TIME' => 'N'
								), null, array('HIDE_ICONS' => 'N'));
								?>
								<?if (strlen(trim($arProperties["DESCRIPTION"])) > 0):?>
									<div class="bx_description"><?=$arProperties["DESCRIPTION"]?></div>
								<?endif?>
							
							<?
							*/
						}
						?>
				

					<?if(CSaleLocation::isLocationProEnabled()):?>

					<?
					$propertyAttributes = array(
						'type' => $arProperties["TYPE"],
						'valueSource' => $arProperties['SOURCE'] == 'DEFAULT' ? 'default' : 'form' // value taken from property DEFAULT_VALUE or it`s a user-typed value?
					);

					if(intval($arProperties['IS_ALTERNATE_LOCATION_FOR']))
						$propertyAttributes['isAltLocationFor'] = intval($arProperties['IS_ALTERNATE_LOCATION_FOR']);

					if(intval($arProperties['CAN_HAVE_ALTERNATE_LOCATION']))
						$propertyAttributes['altLocationPropId'] = intval($arProperties['CAN_HAVE_ALTERNATE_LOCATION']);

					if($arProperties['IS_ZIP'] == 'Y')
						$propertyAttributes['isZip'] = true;
					?>

						<script>

							<?// add property info to have client-side control on it?>
							(window.top.BX || BX).saleOrderAjax.addPropertyDesc(<?=CUtil::PhpToJSObject(array(
									'id' => intval($arProperties["ID"]),
									'attributes' => $propertyAttributes
								))?>);

						</script>
					<?endif?>

					
					<?
                    }
					}
				}
				?>
		
			<?
		}
	}
}

?>
