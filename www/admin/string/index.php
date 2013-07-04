<?php
/***********************************************
-=Ms Site=-

Модуль: String
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Администрирование 4-уровневой структуры
          Добавление сектора в 4-уровневую структуру администратором
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
  $site = new Site;
	$site->PAGE = 'admin_string';
	$parent_page = $site->PAGES[$site->PAGE]['url'];

	require_once('../../cgi-bin/string.class');
  $string = new String;

	require_once('../../cgi-bin/vars/alert.class');
  $alert = new Alert;

	require_once('../../cgi-bin/utils/validate.class');
  $validate = new Validate;

	//обнуление
	$alert_title = '';
	$result = $string_title = '';

    //инициализация
	$smi_parts = $string->SqlGetTable('smi_parts');

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//проверка на честность
		if ( !isset($_POST['title']) ) $site->SiteGoTo($parent_page);

		//инициализация
		$string_title = $_POST['title'];

		//title
		if ( !$validate->IsRightLength($string_title, 1, 255) ) { $alert_title = $alert->ALERT['1-255']; $alert->NOVALID = TRUE; }
		/*if ( $validate->IsDamn($string_title) ) { $alert_title = $alert->ALERT['damn']; $alert->NOVALID = 'ALERT'; }*/

		//обработка
		if ($alert->NOVALID == FALSE)
		{
			$add_array = array('title' => $string_title);
			$result = $string->SqlAdd($add_array, 'smi_parts');
			if ($result) $site->SiteGoTo($parent_page);
			else $result = $alert->ALERT['system_error'];
		}
	}

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>