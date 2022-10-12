<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props_format.php");




function checkDateNext($id_city,$date,$time_h = '00', $time_m= '00',$custom_today = 'N')
{
  if (CModule::IncludeModule("iblock")):


      $date_now = date('d.m.Y');

  if(strtotime($date_now)> strtotime($date)){
      $date = $date_now;
   
  }
      $date = $date_now; // TODO






   global $delivery_type;



   if($arResult['DELIVERY_CUSTOM'][$delivery_type]['XML_ID']=='samovivoz'){
      $id_city = 92; //стандартно Москва. ( если самовывоз )
    }




    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
    $arFilter = Array("IBLOCK_ID"=>24, "CODE"=>$id_city, "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
    while($ob = $res->GetNextElement()){
      $arFields = $ob->GetFields();
      $arProps = $ob->GetProperties();
      $arFields['PROPERTIES'] = $arProps;
      $el = $arFields;

    }








    //Проверяем тип ближайшей доставки
    switch ($el['PROPERTIES']['TYPE']['VALUE_XML_ID']) {
      case 'EVERYDAY':
      //Каждый день


      $time = new DateTime();

      $test2 = strtotime($date);
      $vibral_date = date("w", $test2);

      $test = strtotime($date); // тут может преобразование отличаться
      $today_date = date("w", $test);


      $string_date = date('d.m.Y');
    //  $today_date ++;



      $raznica = date_diff_cs($date, $custom_today);


      if($raznica>=1){
        $time_h  = '00';
      }





      if($time_h<$el['PROPERTIES']['TIME']['VALUE'])
      {


              //1 Рабочий день, если успели до указанного времени
              //Если пн,вт,ср,чт
        $day_delivery =  date('d.m.Y', strtotime($date."+".$el['PROPERTIES']['DAYS']['VALUE']." days"));



        if($today_date==5)
        {
                //если сегодня утро пятница, то след день будет пн
          $day_delivery =  date('d.m.Y', strtotime($date.' Mon next week'));

        }
        if($today_date==6)
        {
                //если сегодня суббота , заказ во вторник
          $day_delivery =  date('d.m.Y', strtotime($date.' Tue next week'));
        }
        if($today_date==0)
        {
                //если сегодня вскр , заказ во вторник
          $day_delivery =  date('d.m.Y', strtotime($date.' Tue next week'));
        }

        if($raznica>2){
              	//pre('Заказал позднее 2ух дней');
         $day_delivery = $date;
       }

       if((int)$raznica==2){
              //	pre('Заказал ровно спустя 2 дня');
        if($time_h<$el['PROPERTIES']['TIME']['VALUE'])
        {
	            	//время до обеда
	            	//pre('before');
          $day_delivery = $date;
        }


      }



    }
    else
    {


              //2 рабочих дня, т.к не успели по времени
              //Если пн,вт,ср

      $el['PROPERTIES']['DAYS']['VALUE'] += 1;
      $day_delivery =  date('d.m.Y', strtotime($date."+".$el['PROPERTIES']['DAYS']['VALUE']." days"));




      if($today_date==4)
      {
                //если сегодня вечер четверг, то след заказ будет в пн
        $day_delivery =  date('d.m.Y', strtotime($date.' Mon next week'));
      }
      if($today_date==5)
      {
                //если сегодня вечер пятница, то след заказ во вт
        $day_delivery =  date('d.m.Y', strtotime($date.' Tue next week'));
      }
      if($today_date==6)
      {
                //если сегодня суббота , то заказ в вт
        $day_delivery =  date('d.m.Y', strtotime($date.' Tue next week'));
      }
      if($today_date==0)
      {
                //если сегодня вскр , то заказ в вт
        $day_delivery =  date('d.m.Y', strtotime($date.' Tue next week'));
      }


      if($raznica>2){
              	//pre('Заказал позднее 2ух дней');
       $day_delivery = $date;
     }


     if((int)$raznica==2){

      if($time_h<$el['PROPERTIES']['TIME']['VALUE'])
      {

      }
      else
      {
	            	//время после обеда

        $day_delivery =  $day_delivery =  date('d.m.Y', strtotime($date));
      }

    }



  }


  break;

  default:
      //с ПН по ВСКР




  $week_day = array(
    1=>'Mon',
    2=>'Tue',
    3=>'Wed',
    4=>'thursday',
    5=>'Fri',
    6=>'Sat',
    7=>'Sun',


  );

         $test = strtotime($date); // тут может преобразование отличаться
         $today_date = date("w", $test);
     // $today_date ++;







         $raznica = date_diff_cs($date, $custom_today);
         if($today_date==0 && $raznica == false){
            $today_date = 1;
            $date_zero = true;
          }





         $day_delivery = $el['PROPERTIES']['TYPE']['VALUE_XML_ID'];





         if($today_date>=$day_delivery)
         {
          $day_delivery =  date('d.m.Y', strtotime($date.' '.$week_day[$day_delivery].' next week'));


          if($date_zero==true){
          //Если сегодня вскр,  то след неделя будет не пн, а через неделю пн
            $date =  date('d.m.Y', strtotime($date."+1 days"));
              $day_delivery =  date('d.m.Y', strtotime($date.' '.$week_day[$day_delivery].' next week'));
          }
        }
        else
        {


          if($time_h>$el['PROPERTIES']['TIME']['VALUE'])
          {

            $day_delivery =  date('d.m.Y', strtotime($date.' '.$week_day[$day_delivery].' next week'));
          }
          else
          {
            $day_delivery = date('d.m.Y', strtotime($date.' '.$week_day[$day_delivery].' this week'));
          }

        }


        if($raznica>2){

        	$day_delivery = $el['PROPERTIES']['TYPE']['VALUE_XML_ID'];

          if($today_date>$day_delivery)
          {

            $day_delivery = date('d.m.Y', strtotime($date.' '.$week_day[$day_delivery].' next week'));
          }
          else
          {


            $day_delivery = date('d.m.Y', strtotime($date.' '.$week_day[$day_delivery].' this week'));

          }


        }





        break;
      }



    endif;


    return $day_delivery;
  }



  ?>
  <div class="decoration-left">
    <div class="decoration-container">
      <h6 class="decoration__subtitle">
       <?=GetMessage("SOA_TEMPL_BUYER_INFO")?>
     </h6>
     <?
     if(array_key_exists('ERROR', $arResult) && is_array($arResult['ERROR']) && !empty($arResult['ERROR']))
     {
      $bHideProps = false;
    }
    ?>
    <input type="hidden" name="showProps" id="showProps" value="Y">

    <?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/person_type.php");?>

    <div class="decoration-container-wrap">
      <div class="decoration-container-col">
        <div class="decoration-dropdown-wrapper">
          <span class="decoration-dropdown__title">
            Существующее юридическое лицо
          </span>

          <div
          id="man"
          class="decoration-dropdown j_dropdown j_naming"
          data-dropdown-select
          >
          <?

    	if(!empty($_SESSION['BASKET_PROFILE_ID'])){
    		$stop_checked = true;
    	}

    	if($stop_checked==true):
    	foreach ($arResult["ORDER_PROP"]["USER_PROFILES"] as $key => $value) {
    			unset($arResult["ORDER_PROP"]["USER_PROFILES"][$key]['CHECKED']);
    			if($value['ID']==$_SESSION['BASKET_PROFILE_ID']){
    				$arResult["ORDER_PROP"]["USER_PROFILES"][$key]['CHECKED'] = 'Y';
    			}
    	}
	    endif;


          if(!empty($arResult['USER_VALS']['ORDER_PROP'][34])):

          endif;


          if($arParams["ALLOW_NEW_PROFILE"] == "Y"):
            $nashev1 = false;

            ?>

            <select  data-dropdown-select-node
            class="decoration-dropdown__select" name="PROFILE_ID" id="ID_PROFILE_ID" onChange="SetContact(this.value)" style="width: 100%;">

            <?
            foreach($arResult["ORDER_PROP"]["USER_PROFILES"] as $key => $arUserProfiles)
            {
                if($_SESSION['BASKET_PROFILE_ID'] && $_SESSION['BASKET_PROFILE_ID']!=$arUserProfiles["ID"])
                    continue;
              ?>
              <option value="<?= $arUserProfiles["ID"] ?>"<?if ($arUserProfiles["CHECKED"]=="Y"){
                $nashev1 = true;
                $temp_prodile= $arResult["ORDER_PROP"]["USER_PROFILES"][$key]; echo 'selected="selected" '; }?>><?=$arUserProfiles["NAME"]?></option>
                <?
              }
              ?>
              <option value="0" <?if($nashev1==false){echo 'selected';}?> ><?=GetMessage("SOA_TEMPL_PROP_NEW_PROFILE")?></option>
            </select>
            <?if($_SESSION['BASKET_PROFILE_ID']){?>
              <div class="individual_products">
                  <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                      "AREA_FILE_SHOW" => "file",
                      "PATH" => SITE_DIR."include/order_individual_alert.php"
                    )
                  );?>

                  <a class="indiv_order_reset_basket" href="#">Сбросить корзину</a>

              </div>
              <script>
                  $(document).ready(function (){
                      $('.indiv_order_reset_basket').on('click',function(){
                          $.ajax({
                              type: 'POST',
                              url: '/include/ajax/blank_ids.php',
                              data: {
                                  'clear_basket': 'Y'
                              },
                              success: function (data) {
                                  if(data==='success')
                                      location.reload();
                              }
                          })
                      })
                  })
              </script>
          <? }?>

          <? endif; ?>

          <button
          data-dropdown-target="#man"
          class="decoration-dropdown__button j_toggleDropdown"
          type="button"
          >
          <?  foreach($arResult["ORDER_PROP"]["USER_PROFILES"] as $key => $arUserProfiles)
          {
            if ($arUserProfiles["CHECKED"]=="Y"):
              $nashe = true;
              ?>



              <span
              data-naming="<?=$arUserProfiles["ID"]?>"
              class="decoration-dropdown_title"
              >
              <?=$arUserProfiles["NAME"]?>
            </span>


            <?endif;
          }

          if($nashe ==false):
            ?>
            <span
            data-naming="0"
            class="decoration-dropdown_title"
            >
            <?=GetMessage("SOA_TEMPL_PROP_NEW_PROFILE")?>
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


       <label class="radio select_profile_custom">
        <input
        class="radio__input"
        type="radio"
        name="man"
        value="0"
        />
        <span class="radio__text">
          <?=GetMessage("SOA_TEMPL_PROP_NEW_PROFILE")?>
        </span>
      </label>
      <?  foreach($arResult["ORDER_PROP"]["USER_PROFILES"] as $key => $arUserProfiles)
                        { //if ($arUserProfiles["CHECKED"]!="Y"):
                        ?>
                        <label class="radio select_profile_custom">
                          <input
                          class="radio__input"
                          type="radio"
                          name="man"
                          value="<?= $arUserProfiles["ID"] ?>"
                          />
                          <span class="radio__text">
                           <?=$arUserProfiles["NAME"]?>
                         </span>
                       </label>


                            <?//endif;
                          }
                          ?>

                        </div>
                      </div>
                    </div>
                  </div>



                  <div class="decoration-desc">
                    <?




                    PrintPropsFormPersonOnlyText($arResult["ORDER_PROP"]["USER_PROPS_N"], $arParams["TEMPLATE_LOCATION"]);
                    PrintPropsFormPersonOnlyText($arResult["ORDER_PROP"]["USER_PROPS_Y"], $arParams["TEMPLATE_LOCATION"]);
                    ?>


                  </div>
                </div>

                <div class="decoration-container-col">

                  <? if(count($arResult["ORDER_PROP"]["USER_PROFILES"])!=0 && $temp_prodile['ID']!=0):?>
                    <button class="button-add add_new_person_btn" type="button" >
                      <svg class="decoration-dropdown__icon">
                        <use xlink:href="#sub"></use>
                      </svg>

                      <span class="button-add__text" >
                        Создать новое юридическое лицо / ИП
                      </span>
                    </button>
                    <?php else: ?>

                     <span class="decoration-dropdown__title">
                      Новое юридическое лицо / ИП
                    </span>
                  <?php endif; ?>

                  <div class="decoration-container-add">

                    <?



                    if($arResult['USER_VALS']['ORDER_PROP'][34]=='ИП'){
                      $arResult["ORDER_PROP"]["USER_PROPS_Y"][8]['NAME'] = 'ФИО ИП';
                    }elseif($arResult['USER_VALS']['ORDER_PROP'][34]=='Юридическое лицо'){

                      $arResult["ORDER_PROP"]["USER_PROPS_Y"][8]['NAME'] = 'Название организации';

                    }

                    global $USER;
                    $arResult["ORDER_PROP"]["USER_PROPS_Y"][13]['VALUE'] = $USER->GetEmail();


                    if($temp_prodile['ID']==0):
                      $arResult['USER_VALS']['ORDER_PROP'][41]='YES';
                      $arResult["ORDER_PROP"]["USER_PROPS_N"][41]['VALUE'] = 'YES';
                      PrintPropsFormPerson($arResult["ORDER_PROP"]["USER_PROPS_N"], $arParams["TEMPLATE_LOCATION"],$arResult['USER_VALS']['ORDER_PROP']);
                      PrintPropsFormPerson($arResult["ORDER_PROP"]["USER_PROPS_Y"], $arParams["TEMPLATE_LOCATION"],$arResult['USER_VALS']['ORDER_PROP']);
                    else:
                      $arResult['USER_VALS']['ORDER_PROP'][41]=$temp_prodile['ID'];
                       $arResult["ORDER_PROP"]["USER_PROPS_N"][41]['VALUE'] = $temp_prodile['ID'];
                      ?>
                      <div class="hidden_block" style="display: none;"><?
                      PrintPropsFormPerson($arResult["ORDER_PROP"]["USER_PROPS_N"], $arParams["TEMPLATE_LOCATION"],$arResult['USER_VALS']['ORDER_PROP']);
                      PrintPropsFormPerson($arResult["ORDER_PROP"]["USER_PROPS_Y"], $arParams["TEMPLATE_LOCATION"],$arResult['USER_VALS']['ORDER_PROP']);?>

                    </div>

                    <input
                    type="text"
                    disabled
                    class="input decoration__input"
                    placeholder="Название компании"
                    />
                    <input
                    disabled
                    type="text"
                    class="input decoration__input"
                    placeholder="Юридическое лицо / ИП"
                    />
                    <input
                    disabled
                    type="text"
                    class="input decoration__input"
                    placeholder="ИНН"
                    />
                    <?

                  endif;
                  ?>

                </div>
              </div>
            </div>
          </div>

          <div class="decoration-container">
            <div class="decoration-container-wrap">
              <div class="decoration-container-col">
                <h6 class="decoration__subtitle">
                  Данные для доставки
                </h6>




                <div class="decoration-container-radios">

                  <?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");?>


                </div>

                  <?


if(!$GLOBALS['hide_next_error']):
                   global $find_delivery; if(!$find_delivery):?>
                   <p>Введите адрес доставки:</p>
<label id="code_ADDRESS" data-error="Адрес не найден" class="input-wrapper <?if(empty($arResult['USER_VALS']['ORDER_PROP'][19])):?><?php if($temp_prodile['ID']!=0): ?><?php endif; ?><?endif;?>">
          <input  placeholder="Адрес доставки" onkeyup="document.getElementById('ORDER_PROP_<?=ID_ORDER_PROP_ADDRES?>').value = this.value;"
          value="<?if(!empty($arResult['USER_VALS']['ORDER_PROP'][19])): echo $arResult['USER_VALS']['ORDER_PROP'][19]; endif; ?>"
          data-dropdown-target="#address" autocomplete="off" type="text" class="input decoration__input input j_openDropdown addres_disabled"  name="new_addr_field" id="new_addr_field">


        </label>
         <div class="dropdown-content new">
          <div data-search-list="address_input" class="dropdown-content-scroller container_input_value">



          </div>
        </div>

         <?

         if($arResult["ORDER_PROP"]["USER_PROPS_Y"][18] == 92)
                  {
                    //Москва
                    $deliv_id = 1;
                  }
                  else
                  {
                    //Регион
                    $deliv_id = $delivery_type;
                  }

         $location_delivery = Mediagroup::CheckDeliveryForIdCity($arResult["ORDER_PROP"]["USER_PROPS_Y"][18]['VALUE'],$deliv_id);



         if($arResult['DELIVERY_CUSTOM'][$delivery_type]['XML_ID']=='samovivoz' &&  !$location_delivery) :?>
          <p class="error_text_delivery" style="color:green;">На Ваш адрес доставка не осуществляется. Выберите другой город или оформите самовывоз</p>
        <?php endif; ?>

       <?endif; ?>

      <?endif; ?>


                <?php


                $arSelectStock = Array("ID", "IBLOCK_ID", "NAME","PROPERTY_COORDS",'PROPERTY_MAX_TIME');
                $arFilterStock = Array("IBLOCK_CODE"=>'STOCK', "CODE"=>'time');
                $resStock = CIBlockElement::GetList(Array(), $arFilterStock, false, Array(), $arSelectStock);
                if($obstock = $resStock->fetch()){
                  $time_stock = $obstock['PROPERTY_MAX_TIME_VALUE'];
                }
                ?>
                <input type="hidden" id="max_hourse" value="<?=$time_stock?>">
                <?



                if($arResult['DELIVERY_CUSTOM'][$delivery_type]['XML_ID']=='samovivoz') :?>
                  <?php

                  $arFilterStock = Array("IBLOCK_CODE"=>'STOCK', "CODE"=>'main');
                  $resStock = CIBlockElement::GetList(Array(), $arFilterStock, false, Array(), $arSelectStock);
                  if($obstock = $resStock->fetch()){
                    $coords_stock = $obstock['PROPERTY_COORDS_VALUE'];
                  }

                  ?>

                  <input type="hidden" id="samovivoz_coords" value="<?=$coords_stock?>">
                  <div class="only_samovivoz"> <?endif;?>
                  <div class="decoration-dropdown-wrapper">
                    <span class="decoration-dropdown__title">Параметры доставки</span>
                    <?php if(!empty($temp_prodile)): ?>

                      <select    data-dropdown-select-node
                      class="decoration-dropdown__select" name="ORDER_PROP_2020" id="change_list_address" style="width: 100%;" >
                      <option value="0">выберите адрес</option>
                      <?



                      CModule::IncludeModule("iblock");
                      $result = array();
                      $new_ar = array();

                      $arSelect = Array("NAME",'IBLOCK_ID','ID','PREVIEW_TEXT',"PROPERTY_COORDS", "PROPERTY_PROFILE_ID",'PROPERTY_CONTACT', "PROPERTY_PHONE",'PROPERTY_ID_CITY');
                      $arFilter = Array("IBLOCK_ID" => IBLOCK_PROFILE_ADDRESS, "PROPERTY_PROFILE_ID" => $temp_prodile['ID']);
                      $res = CIBlockElement::GetList(Array('ID'=>'DESC'), $arFilter, false, Array(), $arSelect);
                      while ($ob = $res->fetch()) {
                        if($ob['PREVIEW_TEXT']==$arResult['USER_VALS']['ORDER_PROP'][37]){

                          $temp_users = $ob;
                          $selected = 'selected';
                        }else{
                          $selected = '';
                        }

                        $new_ar[] = $ob;
                        ?>
                        <option value="<?=$ob['ID']?>"  <?=$selected?> class="select_address_cstm"><?=$ob['PREVIEW_TEXT']?></option>
                        <?

                      }  ?>

                    </select>

                    <?php



                    if(!empty($temp_users)):
                      foreach ($arResult["ORDER_PROP"] as $key => $value) {
                        foreach ($value as $keyw => $valuew) {
                          if($valuew['CODE']=='PHONE'){
                            $arResult["ORDER_PROP"][$key][$keyw]['VALUE'] = $temp_users['PROPERTY_PHONE_VALUE'];
                          }


                          if($valuew['CODE']=='COORDS'){
                            $arResult["ORDER_PROP"][$key][$keyw]['VALUE'] = $temp_users['PROPERTY_COORDS_VALUE'];
                          }

                          if($valuew['CODE']=='CONTACT_PERSON'){
                            $arResult["ORDER_PROP"][$key][$keyw]['VALUE'] = $temp_users['PROPERTY_CONTACT_VALUE'];
                          }
                        }
                      }
                    endif;
                    ?>
                    <div
                    id="man2"
                    class="decoration-dropdown j_dropdown j_naming"
                    data-dropdown-select
                    >
                    <button
                    data-dropdown-target="#man2"
                    class="decoration-dropdown__button j_toggleDropdown"
                    type="button"
                    >
                    <?php if(empty($temp_users)): ?>
                      <span
                      data-naming="0"
                      class="decoration-dropdown_title"
                      >Выберите адрес</span>
                      <?php else: ?>
                        <span
                        data-naming="<?=$temp_users['PREVIEW_TEXT']?>"
                        class="decoration-dropdown_title"
                        ><?=$temp_users['PREVIEW_TEXT']?></span>

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
                      <label class="radio select_address_cstm">
                        <input
                        class="radio__input"
                        type="radio"
                        name="man2"
                        value="0"
                        />
                        <span class="radio__text">Выберите адрес</span>
                      </label>

                      <?foreach ($new_ar as $key => $value):  ?>

                      <label class="radio select_address_cstm">
                        <input
                        class="radio__input"
                        type="radio"
                        name="man2"
                        value="<?=$value['ID']?>"
                        data-coords="<?=$value['PROPERTY_COORDS_VALUE']?>"
                        />
                        <span class="radio__text"><?=$value['PREVIEW_TEXT']?></span>
                      </label>

                      <?endforeach;?>

                    </div>
                  </div>
                </div>
              <?php endif; ?>
            </div>

            <?php if($temp_prodile['ID']!=0): ?>
              <button class="button-add cstm_show" type="button" href="javascript:void(0);" name="NEW_ADDRESS_CSTM"
              onclick=""> <? /* submitForm(); */ ?>
              <svg class="decoration-dropdown__icon">
                <use xlink:href="#sub"></use>
              </svg>

              <span class="button-add__text">
                Новый адрес доставки
              </span>
            </button>
            <button class="button-add cstm_hide" type="button" href="javascript:void(0);" name="NEW_ADDRESS_CSTM"
            onclick=""> <? /* submitForm(); */ ?>
            <svg class="decoration-dropdown__icon">
              <use xlink:href="#sub"></use>
            </svg>

            <span class="button-add__text">
              Выбрать адрес доставки
            </span>
          </button>
        <?php endif; ?>




        <div id="address" class="order-form-dropdown j_dropdown adr  active" style="    z-index: 999;">




        </div>
        <? global $find_delivery; if($find_delivery):?>

        <label id="code_ADDRESS" data-error="Адрес не найден" class="input-wrapper <?if(empty($arResult['USER_VALS']['ORDER_PROP'][19])):?><?php if($temp_prodile['ID']!=0): ?>hidden_addr_new<?php endif; ?><?endif;?>">
          <input  placeholder="Адрес доставки" onkeyup="document.getElementById('ORDER_PROP_<?=ID_ORDER_PROP_ADDRES?>').value = this.value;"
          value="<?if(!empty($arResult['USER_VALS']['ORDER_PROP'][19])): echo $arResult['USER_VALS']['ORDER_PROP'][19]; endif; ?>"
          data-dropdown-target="#address" autocomplete="off" type="text" class="input decoration__input input j_openDropdown addres_disabled"  name="new_addr_field" id="new_addr_field">


        </label>



        <div class="dropdown-content new">
          <div data-search-list="address_input" class="dropdown-content-scroller container_input_value">



          </div>
        </div>
        <?php endif; ?>


        <div id="user_location_guess">
          <div class="guess_block" style="display: none;"></div>
        </div>


        <?php  if($arResult['DELIVERY_CUSTOM'][$delivery_type]['XML_ID']=='samovivoz'):?>    </div><?endif;?>

        <div class="decoration-inputs">

          <?php if($arResult['DELIVERY_CUSTOM'][$delivery_type]['XML_ID']=='samovivoz') :?>    <div class="only_samovivoz"> <?endif;?>
          <?

          if($arResult['USER_VALS']['ORDER_PROP'][40]=='Y'):
          global $USER;
            $dbUser = \Bitrix\Main\UserTable::getList(array(
            'select' => array('*'),
            'filter' => array('ID' => $USER->GetID())
            ));
            if ($arUser = $dbUser->fetch()){
                $USERR = $arUser;
            }



            //Подставляем данные из профиля
           /*
            $arResult["ORDER_PROP"]["USER_PROPS_Y"][13]['VALUE'] = $USERR['EMAIL'];
            $arResult["ORDER_PROP"]["USER_PROPS_Y"][12]['VALUE'] = $USERR['NAME'].' '.$USERR['LAST_NAME'];
            $arResult["ORDER_PROP"]["USER_PROPS_Y"][14]['VALUE'] = $USERR['PERSONAL_PHONE'];
            $arResult["ORDER_PROP"]["USER_PROPS_Y"][14]['VALUE_FORMATED'] = $USERR['PERSONAL_PHONE'];
            */

          endif;

          PrintPropsForm($arResult["ORDER_PROP"]["USER_PROPS_N"], $arParams["TEMPLATE_LOCATION"],$arResult['USER_VALS']['ORDER_PROP']);
          PrintPropsForm($arResult["ORDER_PROP"]["USER_PROPS_Y"], $arParams["TEMPLATE_LOCATION"],$arResult['USER_VALS']['ORDER_PROP']);
          ?>
          <?php  if($arResult['DELIVERY_CUSTOM'][$delivery_type]['XML_ID']=='samovivoz') :?>    </div><?endif;?>

  <?php global $find_delivery;

        ?>




          <textarea  cols="1"
          name="ORDER_DESCRIPTION" id="ORDER_DESCRIPTION" class="textarea decoration__textarea" placeholder="<?=GetMessage("SOA_TEMPL_SUM_COMMENTS")?>"><?=$arResult["USER_VALS"]["ORDER_DESCRIPTION"]?></textarea>
          <input type="hidden">
        </div>

        <div class="decoration-info  <?php if(!$find_delivery || (empty($arResult['USER_VALS']['ORDER_PROP'][19]) && empty($arResult['USER_VALS']['ORDER_PROP'][37]))): ?> block_bottom_deliv <?php endif; ?>">




          <div
          class="decoration-info-block decoration-aside-result-row--big"
          >
          <span
          class="decoration-dropdown__title decoration-tooltip-wrapper"
          >
          Стоимость доставки

          <div class="decoration-tooltip">
            <svg class="decoration-tooltip__icon">
              <use xlink:href="#tooltip"></use>
            </svg>

            <p class="decoration-tooltip__text">
              Оплата производится только по безналичном расчету
            </p>
          </div>
        </span>

        <em class="decoration-aside-result-row__price">
          <?=$arResult["DELIVERY_PRICE_FORMATED"]?>
        </em>
      </div>
      <div
      class="decoration-info-block decoration-aside-result-row--big"
      >
      <span class="decoration-dropdown__title">
        Ближайшая доставка
      </span>

      <?
      if(!empty($GLOBALS['FIELDS_CSTM']['TIME_DELIV'])):
        $time = explode(':',$GLOBALS['FIELDS_CSTM']['TIME_DELIV']);
        $time = $time[0];

        $time =  date("H");
      else:
        $time =  date("H");
      endif;

      if(!empty($GLOBALS['FIELDS_CSTM']['DATE'])):
        $string_date = $GLOBALS['FIELDS_CSTM']['DATE'];
        $today_date = date('d.m.Y');
      else:
       $string_date = date('d.m.Y');
       $today_date = date('d.m.Y');
     endif;


      if(!empty($temp_users['PROPERTY_ID_CITY_VALUE'])){
          $GLOBALS['FIELDS_CSTM']['LOCATION'] = $temp_users['PROPERTY_ID_CITY_VALUE'];
        }


     ?>
      <em  style="display: none;" class=" blij_dilvery_value">
      <?=checkDateNext($GLOBALS['FIELDS_CSTM']['LOCATION'],$string_date,$time,'00',$today_date);?>
    </em>
     <em class="decoration-aside-result-row__price ">
      <?=checkDateNext($GLOBALS['FIELDS_CSTM']['LOCATION'],$today_date,$time,'00',$today_date);?>
    </em>
    <input type="hidden" maxlength="250" class="field_DATE_DELIVERY_CONFIRM input decoration__input decoration__input--small  " placeholder="Ближайшая доставка" size="" value="<?=checkDateNext($GLOBALS['FIELDS_CSTM']['LOCATION'],$string_date,$time,'00',$today_date);?>" name="ORDER_PROP_39" id="ORDER_PROP_39" >

  </div>
</div>
</div>

<div class="decoration-container-col">
  <!-- map -->
  <div class="decoration-container-map">

    <? include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/map_custom.php"); ?>
  </div>
  <!-- ./End of map -->
</div>
</div>
</div>
</div>