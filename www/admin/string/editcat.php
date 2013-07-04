<?php
/***********************************************
-=Ms Site=-

Модуль: String
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Редактирование рубрики в 4-уровневой структуре
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
  $site = new Site;
	$site->PAGE = 'admin_string_editcat';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/string.class');
  $string = new String;

	require_once('../../cgi-bin/vars/alert.class');
  $alert = new Alert;

	require_once('../../cgi-bin/utils/validate.class');
  $validate = new Validate;

	//обнуление
	$alert_title = '';
	$result = $string_title = $string_cat = $string_sect = '';

  //инициализация
  $smi_parts = $string->SqlGetTable('smi_parts');

	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		//проверка на честность
		if ( !isset($_GET['cat']) || !$string->SqlIsExist($_GET['cat'], 'string_cats') ) $site->SiteGoTo($parent_page);

		//инициализация
		$string_cat = $_GET['cat'];
		$cat_info = $string->SqlGetObj($string_cat, 'string_cats');
		$string_title = $cat_info['title'];
    $string_sect = $cat_info['sect'];
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//проверка на честность
		if (
			!isset($_POST['title']) ||
			!isset($_POST['cat']) ||
			!isset($_POST['sect']) ||
			!$string->SqlIsExist($_GET['cat'], 'string_cats')
		   ) $site->SiteGoTo($parent_page);

		//инициализация
		$string_cat = $_POST['cat'];
    $string_sect = $_POST['sect'];
		$string_title = $_POST['title'];
		$sect_info = $string->SqlGetObj($string_sect, 'string_sects');
		$smi_part = $sect_info['part'];
		
		$oldcat_info = $string->SqlGetObj($string_cat, 'string_cats');
		$string_oldsect = $oldcat_info['sect'];
		$string_oldpart = $oldcat_info['part'];
		

		//title
		if ( !$validate->IsRightLength($string_title, 1, 255) ) { $alert_title = $alert->ALERT['1-255']; $alert->NOVALID = TRUE; }
		/*if ( $validate->IsDamn($string_title) ) { $alert_title = $alert->ALERT['damn']; $alert->NOVALID = 'ALERT'; }*/

		//обработка
		if ($alert->NOVALID == FALSE)
		{
			$add_array = array(
								'title' => $string_title,
                'sect' => $string_sect,
                'part' => $smi_part
								);

			$result = $string->SqlUpdate($string_cat, $add_array, 'string_cats');
			if ($result) $result = $string->SqlUpdatePartObjects($string_oldpart, $smi_part, 'string_cats');
			if ($result) $result = $string->SqlUpdatePartObjects($string_oldpart, $smi_part, 'string_items');
			if ($result) $result = $string->SqlUpdateSectObjects($string_oldsect, $string_sect, 'string_items');
			if ($result) $site->SiteGoTo($parent_page . '?sect=' . $string_sect);
			else $result = $alert->ALERT['system_error'];
		}
	}

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>
