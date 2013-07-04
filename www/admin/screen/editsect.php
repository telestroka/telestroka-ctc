<?php
/***********************************************
-=Ms Site=-

Модуль: Screen
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Редактирование раздела в 4-уровневой структуре
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
  $site = new Site;
	$site->PAGE = 'admin_screen_editsect';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/screen.class');
  $screen = new Screen;

	require_once('../../cgi-bin/vars/alert.class');
  $alert = new Alert;

	require_once('../../cgi-bin/utils/validate.class');
  $validate = new Validate;

	//обнуление
	$alert_title = '';
	$result = $screen_title = $screen_sect = '';
	
  //инициализация
  $smi_parts = $screen->SqlGetTable('smi_parts');

	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		//проверка на честность
		if ( !isset($_GET['sect']) || !$screen->SqlIsExist($_GET['sect'], 'screen_sects') ) $site->SiteGoTo($parent_page);

		//инициализация
		$screen_sect = $_GET['sect'];
		$sect_info = $screen->SqlGetObj($screen_sect, 'screen_sects');
		$screen_title = $sect_info['title'];
		$smi_part = $sect_info['part'];
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//проверка на честность
		if (
			!isset($_POST['title']) ||
			!isset($_POST['sect']) ||
			!isset($_POST['part']) ||
			!$screen->SqlIsExist($_POST['sect'], 'screen_sects') ||
			!$screen->SqlIsExist($_POST['part'], 'smi_parts')
		   ) $site->SiteGoTo($parent_page);

		//инициализация
		$screen_sect = $_POST['sect'];
		$screen_title = $_POST['title'];
		$smi_part = $_POST['part'];
		$sect_info = $screen->SqlGetObj($screen_sect, 'screen_sects');
		$screen_oldpart = $sect_info['part'];

		//title
		if ( !$validate->IsRightLength($screen_title, 1, 255) ) { $alert_title = $alert->ALERT['1-255']; $alert->NOVALID = TRUE; }
		/*if ( $validate->IsDamn($screen_title) ) { $alert_title = $alert->ALERT['damn']; $alert->NOVALID = 'ALERT'; }*/

		//обработка
		if ($alert->NOVALID == FALSE)
		{
			$add_array = array(
								          'title' => $screen_title,
								          'part' => $smi_part
								        );

			$result = $screen->SqlUpdate($screen_sect, $add_array, 'screen_sects');
			if ($result) $result = $screen->SqlUpdatePartObjects($screen_oldpart, $smi_part, 'screen_cats');
			if ($result) $result = $screen->SqlUpdatePartObjects($screen_oldpart, $smi_part, 'screen_items');
			if ($result) $site->SiteGoTo($parent_page . '?part=' . $smi_part);
			else $result = $alert->ALERT['system_error'];
		}
	}

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>
