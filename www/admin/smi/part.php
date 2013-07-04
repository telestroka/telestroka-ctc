<?php
/***********************************************
-=Ms Site=-

Модуль: Smi
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Администрирование разделов 4-уровневой структуры
          Добавление раздела в 4-уровневую структуру администратором
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin_smi_part';
	$parent_page = $site->PAGES[$site->PAGE]['url'];

	require_once('../../cgi-bin/smi.class');
  $smi = new Smi;

	require_once('../../cgi-bin/vars/alert.class');
  $alert = new Alert;

	require_once('../../cgi-bin/utils/validate.class');
  $validate = new Validate;

	//обнуление
	$alert_title = '';
	$result = $smi_title = '';

    //инициализация
	$smi_parts = $smi->SqlGetTable('smi_parts');
	$smi_sects = $smi->SqlGetTable('smi_sects');

	if ($_SERVER['REQUEST_METHOD'] == 'GET')
  {
    //проверка на честность
    if ( !isset($_GET['part']) || !$smi->SqlIsExist($_GET['part'], 'smi_parts') ) $site->SiteGoTo($parent_page);

  	//инициализация
  	$smi_part = $_GET['part'];
  	$smi_sects = $smi->SqlGetPartObjects($smi_part, 'smi_sects');
  }

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
    //проверка на честность
    if ( !isset($_POST['title']) || !isset($_POST['part']) || !$smi->SqlIsExist($_POST['part'], 'smi_parts') ) $site->SiteGoTo($parent_page);

  	//инициализация
  	$smi_part = $_POST['part'];
  	$smi_sects = $smi->SqlGetPartObjects($smi_part, 'smi_sects');
		$smi_title = $_POST['title'];

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
			$result = $smi->SqlAdd($add_array, 'smi_sects');
			if ($result) $site->SiteGoTo($parent_page . '?part=' . $smi_part);
			else $result = $alert->ALERT['system_error'];
		}
	}

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>
