<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");


CUtil::JSPostUnescape();
//pre($_POST);

if(isset($_POST['loc']) && strlen($_POST['loc'])>2){
    CModule::IncludeModule('sale');
    //pre('%'.iconv('UTF8','CP1251',$_POST['loc']).'%');
    $db_vars = CSaleLocation::GetList(
        array(
            "SORT" => "ASC",
            "COUNTRY_NAME_LANG" => "ASC",
            "CITY_NAME_LANG" => "ASC"
        ),
        array("LID" => LANGUAGE_ID, "%CITY_NAME"=>'%'.$_POST['loc'].'%'),
        false,
        false,
        array()
    );
    $ar_locs = array();
    $find = false;
    while ($vars = $db_vars->Fetch()):
        $find = true;
        //pre($vars);
        $loc = CSaleLocation::GetByID( $vars['ID'], "ru"); // параметр ru необязательный. По умолчанию текущий язык.

        $vars['NAME'] = $vars['CITY_NAME'];
        if(!empty($vars['REGION_NAME'])) $vars['NAME'].=', '.$vars['REGION_NAME'];
        $vars['NAME'] .= ', '.$vars['COUNTRY_NAME'];
        $ar_locs[$vars['ID']] = array(
            "CITY_NAME" => $vars["CITY_NAME"],
            "NAME" => $vars["NAME"],
            "CODE" => $loc['CODE']
        );


    endwhile;

    if($find == false){


            $db_vars = CSaleLocation::GetList(
        array(
            "SORT" => "ASC",
            "COUNTRY_NAME_LANG" => "ASC",
            "CITY_NAME_LANG" => "ASC"
        ),
        array("LID" => LANGUAGE_ID, "%REGION_NAME"=>'%'.$_POST['loc'].'%' ),
        false,
        false,
        array()
    );
    $ar_locs = array();
    $find = false;
    while ($vars = $db_vars->Fetch()):
        $find = true;
        //pre($vars);
        $loc = CSaleLocation::GetByID( $vars['ID'], "ru"); // параметр ru необязательный. По умолчанию текущий язык.

        $vars['NAME'] = $vars['CITY_NAME'];
        if(!empty($vars['REGION_NAME'])) $vars['NAME'].=', '.$vars['REGION_NAME'];
        $vars['NAME'] .= ', '.$vars['COUNTRY_NAME'];
        $ar_locs[$vars['ID']] = array(
            "CITY_NAME" => $vars["CITY_NAME"],
            "NAME" => $vars["NAME"],
            "CODE" => $loc['CODE']
        );


    endwhile;

    }
    //pre($ar_locs);

    if(is_array($ar_locs) && count($ar_locs)>0){
        echo str_replace("'",'"',CUtil::PhpToJSObject($ar_locs));
        //pre(json_last_error());
    }else{
        


         echo json_encode(array('empty'=>true));

    }
}else echo json_encode(array('empty'=>true));

?>