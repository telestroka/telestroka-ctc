<?php
/***********************************************
-=Ms Site=-

Модуль: Screen
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Редактирование сектора в 4-уровневой структуре
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
  $site = new Site;
	$site->PAGE = 'admin_screen_editpart';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/screen.class');
  $screen = new Screen;

	require_once('../../cgi-bin/vars/alert.class');
  $alert = new Alert;

	require_once('../../cgi-bin/utils/validate.class');
  $validate = new Validate;

	//обнуление
	$alert_title = '';
	$result = $screen_title = $smi_part = '';


	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		//проверка на честность
		if ( !isset($_GET['part']) || !$screen->SqlIsExist($_GET['part'], 'smi_parts') ) $site->SiteGoTo($parent_page);

		//инициализация
		$smi_part = $_GET['part'];
		$part_info = $screen->SqlGetObj($smi_part, 'smi_parts');
		$screen_title = $part_info['title'];
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//проверка на честность
		if (
			!isset($_POST['title']) ||
			!isset($_POST['part']) ||
			!$screen->SqlIsExist($_POST['part'], 'smi_parts')
		   ) $site->SiteGoTo($parent_page);

		//инициализация
		$smi_part = $_POST['part'];
		$screen_title = $_POST['title'];

		//title
		if ( !$validate->IsRightLength($screen_title, 1, 255) ) { $alert_title = $alert->ALERT['1-255']; $alert->NOVALID = TRUE; }
		/*if ( $validate->IsDamn($screen_title) ) { $alert_title = $alert->ALERT['damn']; $alert->NOVALID = 'ALERT'; }*/

		//обработка
		if ($alert->NOVALID == FALSE)
		{
			$add_array = array(
								'title' => $screen_title
								);

			$result = $screen->SqlUpdate($smi_part, $add_array, 'smi_parts');
			if ($result) $site->SiteGoTo($parent_page);
			else $result = $alert->ALERT['system_error'];
		}
	}

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>
