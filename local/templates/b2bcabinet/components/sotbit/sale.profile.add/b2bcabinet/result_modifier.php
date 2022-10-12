<?php
//$arResult['PATH_TO_LIST'] = SITE_DIR.'personal/b2b/profile/buyer/';

foreach ($arResult["ORDER_PROPS"] as $keyB => $blcok) {
	foreach ($blcok['PROPS'] as $key => $value) {
		
		if($value['CODE']=='OOO_IP' || $value['CODE']=='COMPANY' ||   $value['CODE']=='INN' ||  $value['CODE']=='CONTACT_PERSON' || $value['CODE']=='EMAIL' || $value['CODE']=='PHONE' || $value['CODE']=='ZIP' || $value['CODE']=='CITY' || $value['CODE']=='LOCATION' ){

			if($value['CODE']=='OOO_IP'){
				$arResult['ORDER_PROPS'][$keyB]['PROPS'][$key]['TYPE'] = 'SELECT'; 
				$arResult['ORDER_PROPS'][$keyB]['PROPS'][$key]['VALUES'] = array(
					0=> array(
						'VALUE'=>'Юридическое лицо',
						'NAME'=>'Юридическое лицо',

					),
					1=> array(
						'VALUE'=>'ИП',
						'NAME'=>'ИП',
						
					),
				);
			}

		}else{
			unset($arResult['ORDER_PROPS'][$keyB]['PROPS'][$key]);
		}
	}
}