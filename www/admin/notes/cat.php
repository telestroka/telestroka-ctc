<?php
/***********************************************
-=Ms Site=-

Модуль: Notes
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Администрирование статей
          Добавление комментируемой статьи администратором
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin_notes_cat';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/notes.class');
    $notes = new Notes;

	require_once('../../cgi-bin/vars/alert.class');
    $alert = new Alert;

	require_once('../../cgi-bin/utils/validate.class');
    $validate = new Validate;

	//обнуление
	$alert_text = $alert_cat = $alert_name = $alert_email = $alert_ip = $alert_date = '';
	$result = $notes_text = $notes_cat = $notes_name = $notes_email = $notes_user = $notes_ip = $notes_date = '';
	$notes_ip = $_SERVER['REMOTE_ADDR'] ;
    $notes_date = date('Y-m-d');
    if ( isset($_SESSION['current_user']) ) $notes_user = $_SESSION['current_user'];

	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
	    //проверка на честность
	    if ( !isset($_GET['cat']) || !$notes->SqlIsExist($_GET['cat'], 'notes_cats') ) $site->SiteGoTo($parent_page);

        //инициализация
        $notes_cat = $_GET['cat'];
        $cat_info = $notes->SqlGetObj($notes_cat, 'notes_cats');
        $notes_info = $notes->SqlGetCatObjects($notes_cat, 'notes_items');
    }

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//проверка на честность
		if (
			!isset($_POST['text']) ||
			!isset($_POST['cat']) ||
			!isset($_POST['name']) ||
			!isset($_POST['email']) ||
            !$notes->SqlIsExist($_POST['cat'], 'notes_cats')
		   ) $site->SiteGoTo($parent_page);

		//инициализация
		$notes_text = $_POST['text'];
		$notes_name = $_POST['name'];
		$notes_email = $_POST['email'];

	    $notes_cat = $_POST['cat'];
	    $cat_info = $notes->SqlGetObj($notes_cat, 'notes_cats');
	    $notes_info = $notes->SqlGetCatObjects($notes_cat, 'notes_items');

		//name
		if ( !$validate->IsRightLength($notes_name, 1, 255) ) { $alert_name = $alert->ALERT['1-255']; $alert->NOVALID = TRUE; }

		//email
		if ( !$validate->IsEmail($notes_email) && !$validate->IsEmpty($notes_email) ) { $alert_email = $alert->ALERT['email']; $alert->NOVALID = TRUE; }

		//обработка
		if ($alert->NOVALID == FALSE)
		{
			$add_array = array(
								'text' => $notes_text,
								'cat' => $notes_cat,
								'name' => $notes_name,
								'email' => $notes_email,
								'user' => $notes_user,
								'ip' => $notes_ip,
								'date' => $notes_date
								);

			$result = $notes->SqlAddHtml($add_array, 'notes_items');
			if ($result) $site->SiteGoTo($site->PAGES[$site->PAGE]['url'] . '?cat=' . $notes_cat);
			else $result = $alert->ALERT['system_error'];
		}
	}

    $path_current = $cat_info['title'];

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>