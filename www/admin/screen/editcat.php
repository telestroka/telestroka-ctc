<?php
/***********************************************
-=Ms Site=-

Модуль: Screen
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Редактирование рубрики в 4-уровневой структуре
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
  $site = new Site;
	$site->PAGE = 'admin_screen_editcat';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/screen.class');
  $screen = new Screen;

	require_once('../../cgi-bin/vars/alert.class');
  $alert = new Alert;

	require_once('../../cgi-bin/utils/validate.class');
  $validate = new Validate;

	//обнуление
	$alert_title = '';
	$result = $screen_title = $screen_cat = $screen_sect = '';

  //инициализация
  $smi_parts = $screen->SqlGetTable('smi_parts');

	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		//проверка на честность
		if ( !isset($_GET['cat']) || !$screen->SqlIsExist($_GET['cat'], 'screen_cats') ) $site->SiteGoTo($parent_page);

		//инициализация
		$screen_cat = $_GET['cat'];
		$cat_info = $screen->SqlGetObj($screen_cat, 'screen_cats');
		$screen_title = $cat_info['title'];
    $screen_sect = $cat_info['sect'];
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//проверка на честность
		if (
			!isset($_POST['title']) ||
			!isset($_POST['cat']) ||
			!isset($_POST['sect']) ||
			!$screen->SqlIsExist($_GET['cat'], 'screen_cats')
		   ) $site->SiteGoTo($parent_page);

		//инициализация
		$screen_cat = $_POST['cat'];
    $screen_sect = $_POST['sect'];
		$screen_title = $_POST['title'];
		$sect_info = $screen->SqlGetObj($screen_sect, 'screen_sects');
		$smi_part = $sect_info['part'];
		
		$oldcat_info = $screen->SqlGetObj($screen_cat, 'screen_cats');
		$screen_oldsect = $oldcat_info['sect'];
		$screen_oldpart = $oldcat_info['part'];
		

		//title
		if ( !$validate->IsRightLength($screen_title, 1, 255) ) { $alert_title = $alert->ALERT['1-255']; $alert->NOVALID = TRUE; }
		/*if ( $validate->IsDamn($screen_title) ) { $alert_title = $alert->ALERT['damn']; $alert->NOVALID = 'ALERT'; }*/

		//обработка
		if ($alert->NOVALID == FALSE)
		{
			$add_array = array(
								'title' => $screen_title,
                'sect' => $screen_sect,
                'part' => $smi_part
								);

			$result = $screen->SqlUpdate($screen_cat, $add_array, 'screen_cats');
			if ($result) $result = $screen->SqlUpdatePartObjects($screen_oldpart, $smi_part, 'screen_cats');
			if ($result) $result = $screen->SqlUpdatePartObjects($screen_oldpart, $smi_part, 'screen_items');
			if ($result) $result = $screen->SqlUpdateSectObjects($screen_oldsect, $screen_sect, 'screen_items');
			if ($result) $site->SiteGoTo($parent_page . '?sect=' . $screen_sect);
			else $result = $alert->ALERT['system_error'];
		}
	}

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>
