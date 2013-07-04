<?php
/***********************************************
-=Ms Site=-

Модуль: String
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Редактирование раздела в 4-уровневой структуре
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
  $site = new Site;
	$site->PAGE = 'admin_string_editsect';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/string.class');
  $string = new String;

	require_once('../../cgi-bin/vars/alert.class');
  $alert = new Alert;

	require_once('../../cgi-bin/utils/validate.class');
  $validate = new Validate;

	//обнуление
	$alert_title = '';
	$result = $string_title = $string_sect = '';
	
  //инициализация
  $smi_parts = $string->SqlGetTable('smi_parts');

	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		//проверка на честность
		if ( !isset($_GET['sect']) || !$string->SqlIsExist($_GET['sect'], 'string_sects') ) $site->SiteGoTo($parent_page);

		//инициализация
		$string_sect = $_GET['sect'];
		$sect_info = $string->SqlGetObj($string_sect, 'string_sects');
		$string_title = $sect_info['title'];
		$smi_part = $sect_info['part'];
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//проверка на честность
		if (
			!isset($_POST['title']) ||
			!isset($_POST['sect']) ||
			!isset($_POST['part']) ||
			!$string->SqlIsExist($_POST['sect'], 'string_sects') ||
			!$string->SqlIsExist($_POST['part'], 'smi_parts')
		   ) $site->SiteGoTo($parent_page);

		//инициализация
		$string_sect = $_POST['sect'];
		$string_title = $_POST['title'];
		$smi_part = $_POST['part'];
		$sect_info = $string->SqlGetObj($string_sect, 'string_sects');
		$string_oldpart = $sect_info['part'];

		//title
		if ( !$validate->IsRightLength($string_title, 1, 255) ) { $alert_title = $alert->ALERT['1-255']; $alert->NOVALID = TRUE; }
		/*if ( $validate->IsDamn($string_title) ) { $alert_title = $alert->ALERT['damn']; $alert->NOVALID = 'ALERT'; }*/

		//обработка
		if ($alert->NOVALID == FALSE)
		{
			$add_array = array(
								          'title' => $string_title,
								          'part' => $smi_part
								        );

			$result = $string->SqlUpdate($string_sect, $add_array, 'string_sects');
			if ($result) $result = $string->SqlUpdatePartObjects($string_oldpart, $smi_part, 'string_cats');
			if ($result) $result = $string->SqlUpdatePartObjects($string_oldpart, $smi_part, 'string_items');
			if ($result) $site->SiteGoTo($parent_page . '?part=' . $smi_part);
			else $result = $alert->ALERT['system_error'];
		}
	}

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>
