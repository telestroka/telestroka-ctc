<?php
/***********************************************
-=Ms Site=-

Модуль: Notes
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Редактирование статьи администратором
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin_notes_editcat';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/notes.class');
    $notes = new notes;

	require_once('../../cgi-bin/utils/image.class');
    $image = new Image;

	require_once('../../cgi-bin/utils/fs.class');
    $fs = new Fs;

	require_once('../../cgi-bin/vars/alert.class');
    $alert = new Alert;

	require_once('../../cgi-bin/utils/validate.class');
    $validate = new Validate;

	//обнуление
	$alert_title = $alert_text = $alert_image = $alert_name = $alert_url = $alert_email = $alert_date = $alert_tags = '';
	$result = $notes_title = $notes_text = $notes_image = $notes_name = $notes_url = $notes_email = $notes_date = $notes_tags = '';

	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		//проверка на честность
		if (
			!isset($_GET['cat']) ||
			!$notes->SqlIsExist($_GET['cat'], 'notes_cats')
		   ) $site->SiteGoTo($parent_page);

		//инициализация
		$notes_cat = $_GET['cat'];
		$notes_info = $notes->SqlGetObj($notes_cat, 'notes_cats');
		$notes_title = $notes_info['title'];
		$notes_text = $notes_info['text'];
		$notes_name = $notes_info['name'];
		$notes_url = $notes_info['url'];
		$notes_email = $notes_info['email'];
		$notes_date = $notes_info['date'];
		$notes_tags = $notes_info['tags'];
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//проверка на честность
		if (
  			!isset($_POST['title']) ||
  			!isset($_POST['text']) ||
  			!isset($_POST['name']) ||
  			!isset($_POST['url']) ||
  			!isset($_POST['email']) ||
  			!isset($_POST['date']) ||
  			!isset($_POST['cat']) ||
  			!isset($_POST['tags']) ||
  			!$notes->SqlIsExist($_POST['cat'], 'notes_cats')
		   ) $site->SiteGoTo($parent_page);

		//инициализация
		$notes_cat= $_POST['cat'];
		$notes_title = $_POST['title'];
		$notes_text = $_POST['text'];
		$notes_name = $_POST['name'];
		$notes_url = $_POST['url'];
		$notes_email = $_POST['email'];
		$notes_date = $_POST['date'];
		$notes_tags = $_POST['tags'];

		$notes_info = $notes->SqlGetObj($notes_cat, 'notes_cats');
	    $notes_image = $notes_info['image'];

		//title
		if ( !$validate->IsRightLength($notes_title, 0, 255) ) { $alert_title = $alert->ALERT['0-255']; $alert->NOVALID = TRUE; }

		//name
		if ( !$validate->IsRightLength($notes_name, 0, 255) ) { $alert_name = $alert->ALERT['0-255']; $alert->NOVALID = TRUE; }

		//url
		if ( !$validate->IsUrl($notes_url) && !$validate->IsEmpty($notes_url) ) { $alert_url = $alert->ALERT['url']; $alert->NOVALID = 'ALERT'; }

		//email
		if ( !$validate->IsEmail($notes_email) && !$validate->IsEmpty($notes_email) ) { $alert_email = $alert->ALERT['email']; $alert->NOVALID = TRUE; }

		//image
		if ($_FILES['image']['name'] != '')
		{
			$notes_image = $_FILES['image']['name'];
			if ( $_FILES['image']['error'] > 0 || $_FILES['image']['size'] > $site->MAX_UPLOAD ) { $alert_image = $alert->ALERT['upload_error']; $alert->NOVALID = TRUE; }
			$image_type = $image->FsGetType($_FILES['image']['tmp_name']);
            if ($image_type != 'gif' && $image_type != 'jpg' && $image_type != 'png') { $alert_image = $alert->ALERT['upload_image']; $alert->NOVALID = TRUE; }
			if ( !$validate->IsUploadFile($_FILES['image']['tmp_name'], $_FILES['image']['size']) ) { $alert_image = $alert->ALERT['upload_file']; $alert->NOVALID = TRUE; }
			if ( file_exists($site->PATH_IMAGES . '/notes/' . $notes_image) ) { $alert_image = $alert->ALERT['exist_file']; $alert->NOVALID = TRUE; };
		}

		//обработка
		if ($alert->NOVALID == FALSE)
		{
			$notes_url = str_replace('http://', '', $notes_url);
			if ($notes_url != '') $notes_url = 'http://' . $notes_url;

			if ($_FILES['image']['name'] != '')
            {
                $image->FsMove($_FILES['image']['tmp_name'], $site->PATH_IMAGES . '/notes/' . $_FILES['image']['name']);
                $image->ImageCreatePreview($site->PATH_IMAGES . '/notes/' . $_FILES['image']['name'], $site->PATH_IMAGES . '/notes/s_' . $_FILES['image']['name'], 100);
            }

			//удаляем ненужные картинки
			if ($_FILES['image']['name'] != '' && $notes_info['image'] != '' && $notes->SqlCountImages($notes_info['image'], 'notes_cats') < 2)
			{
				unlink($site->PATH_IMAGES . '/notes/' . $notes_info['image']);
				unlink($site->PATH_IMAGES . '/notes/s_' . $notes_info['image']);
			}

			$add_array = array(
								'title' => $notes_title,
								'text' => $notes_text,             
								'image' => $notes_image,
								'name' => $notes_name,
								'url' => $notes_url,
								'email' => $notes_email,
								'date' => $notes_date,
								'tags' => $notes_tags
								);				

			$result = $notes->SqlUpdateHtml($notes_cat, $add_array, 'notes_cats');
		}
	}
	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>