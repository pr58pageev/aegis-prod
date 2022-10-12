<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
if(count($arResult["PERSON_TYPE"]) > 1)
{
    ?>
   <div class="bx_filter_block" style="display: none;">
        <div class="bx_filter_parameters_box_container">

            <?foreach($arResult["PERSON_TYPE"] as $v):?>
            <div class="radio_container" style="margin-bottom: 0;">
                <input type="radio" id="PERSON_TYPE_<?=$v["ID"]?>" name="PERSON_TYPE" value="<?=$v["ID"]?>"<?if ($v["CODE"]=="UR") echo " checked=\"checked\"";?> onClick="submitForm()">
                <label for="PERSON_TYPE_<?=$v["ID"]?>" class="radio-label fonts__main_comment">
                    <span class="radio-label_title fonts__main_comment"><?=$v["NAME"]?></span>
                </label>
            </div>
            <?endforeach;?>

        </div>
    </div>
    <input type="hidden" name="PERSON_TYPE_OLD" value="<?=$arResult["USER_VALS"]["PERSON_TYPE_ID"]?>">
	<?
}
else
{
	if(IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"]) > 0)
	{
		//for IE 8, problems with input hidden after ajax
		?>
		<span style="display:none;">
		<input type="text" name="PERSON_TYPE" value="<?=IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"])?>">
		<input type="text" name="PERSON_TYPE_OLD" value="<?=IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"])?>">
		</span>
		<?
	}
	else
	{
		foreach($arResult["PERSON_TYPE"] as $v)
		{
			?>
			<input type="hidden" id="PERSON_TYPE" name="PERSON_TYPE" value="<?=$v["ID"]?>">
			<input type="hidden" name="PERSON_TYPE_OLD" value="<?=$v["ID"]?>">
			<?
		}
	}
}
?>
