<?php
/***********************************************
-=Ms Site=-

Модуль: Screen
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Администрирование рубрик 4-уровневой структуры
          Добавление рубрики в 4-уровневую структуру администратором
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
  $site = new Site;
	$site->PAGE = 'admin_screen_sect';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/screen.class');
  $screen = new Screen;

	require_once('../../cgi-bin/vars/alert.class');
  $alert = new Alert;

	require_once('../../cgi-bin/utils/validate.class');
  $validate = new Validate;

	//обнуление
	$alert_title = '';
	$result = $screen_title = '';

	if ($_SERVER['REQUEST_METHOD'] == 'GET')
  {
    //проверка на честность
    if ( !isset($_GET['sect']) || !$screen->SqlIsExist($_GET['sect'], 'screen_sects') ) $site->SiteGoTo($parent_page);

  	//инициализация
  	$screen_sect = $_GET['sect'];
  	$screen_cats = $screen->SqlGetSectObjects($screen_sect, 'screen_cats');
  }

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//проверка на честность
		if ( !isset($_POST['title']) || !isset($_POST['sect']) || !$screen->SqlIsExist($_POST['sect'], 'screen_sects') ) $site->SiteGoTo($parent_page);

		//инициализация
		$screen_sect = $_POST['sect'];
		$screen_title = $_POST['title'];
		$screen_cats = $screen->SqlGetSectObjects($screen_sect, 'screen_cats');
		$sect_info = $screen->SqlGetObj($screen_sect, 'screen_sects');
		$smi_part = $sect_info['part'];

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
			$result = $screen->SqlAdd($add_array, 'screen_cats');
			if ($result) $site->SiteGoTo($site->PAGES[$site->PAGE]['url'] . '?sect=' . $screen_sect );
			else $result = $alert->ALERT['system_error'];
		}
	}

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>
