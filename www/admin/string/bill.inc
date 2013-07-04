<form class="mainform" name="string_bill" action="<?=$site->PAGES[$site->PAGE]['url'];?>" method="post" class="mainform">
  Назначение платежа:<br/>
  <input name="pay" type="Text" maxlength="255" value="<?=htmlspecialchars($pay, ENT_QUOTES);?>">
  <br/>
  Сумма:<br/>
  <input name="rub" type="Text" maxlength="255" value="<?=htmlspecialchars($rub, ENT_QUOTES);?>" class="autowidth"> руб.
  <input name="kop" type="Text" maxlength="255" value="<?=htmlspecialchars($kop, ENT_QUOTES);?>" class="autowidth"> коп.
  <br/><br/>
  <button type="submit">Далее</button>
 </form>
