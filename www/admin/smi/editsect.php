<?php
/***********************************************
-=Ms Site=-

Модуль: Smi
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Редактирование раздела в 4-уровневой структуре
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
  $site = new Site;
	$site->PAGE = 'admin_smi_editsect';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/smi.class');
  $smi = new Smi;

	require_once('../../cgi-bin/vars/alert.class');
  $alert = new Alert;

	require_once('../../cgi-bin/utils/validate.class');
  $validate = new Validate;

	//обнуление
	$alert_title = '';
	$result = $smi_title = $smi_sect = '';
	
  //инициализация
  $smi_parts = $smi->SqlGetTable('smi_parts');

	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		//проверка на честность
		if ( !isset($_GET['sect']) || !$smi->SqlIsExist($_GET['sect'], 'smi_sects') ) $site->SiteGoTo($parent_page);

		//инициализация
		$smi_sect = $_GET['sect'];
		$sect_info = $smi->SqlGetObj($smi_sect, 'smi_sects');
		$smi_title = $sect_info['title'];
		$smi_part = $sect_info['part'];
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//проверка на честность
		if (
			!isset($_POST['title']) ||
			!isset($_POST['sect']) ||
			!isset($_POST['part']) ||
			!$smi->SqlIsExist($_POST['sect'], 'smi_sects') ||
			!$smi->SqlIsExist($_POST['part'], 'smi_parts')
		   ) $site->SiteGoTo($parent_page);

		//инициализация
		$smi_sect = $_POST['sect'];
		$smi_title = $_POST['title'];
		$smi_part = $_POST['part'];
		$sect_info = $smi->SqlGetObj($smi_sect, 'smi_sects');
		$smi_oldpart = $sect_info['part'];

		//title
		if ( !$validate->IsRightLength($smi_title, 1, 255) ) { $alert_title = $alert->ALERT['1-255']; $alert->NOVALID = TRUE; }
		/*if ( $validate->IsDamn($smi_title) ) { $alert_title = $alert->ALERT['damn']; $alert->NOVALID = 'ALERT'; }*/

		//обработка
		if ($alert->NOVALID == FALSE)
		{
			$add_array = array(
								          'title' => $smi_title,
								          'part' => $smi_part
								        );

			$result = $smi->SqlUpdate($smi_sect, $add_array, 'smi_sects');
			if ($result) $result = $smi->SqlUpdatePartObjects($smi_oldpart, $smi_part, 'smi_cats');
			if ($result) $result = $smi->SqlUpdatePartObjects($smi_oldpart, $smi_part, 'smi_items');
			if ($result) $site->SiteGoTo($parent_page . '?part=' . $smi_part);
			else $result = $alert->ALERT['system_error'];
		}
	}

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>
