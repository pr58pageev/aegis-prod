<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<form method="POST">
  <label for="">
    <p>Комментарий к заказу</p>
    
  <textarea name="USER_DESCRIPTION"  cols="30" rows="10"><?=$arResult['ORDER']['DESCRIPTION']?></textarea>
  </label>

  <input type="hidden" name="SAVE" value="Y">
  <button type="submit">Сохранить изменения</button>

</form>