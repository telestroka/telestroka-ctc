<?php
/***********************************************
-=Ms Site=-

Модуль: Notes
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Администрирование комментируемых статей
          Добавление комментируемой статьи администратором
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin_notes';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/notes.class');
    $notes = new Notes;

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
	$notes_date = date('Y-m-d');
    if ( isset($_SESSION['current_user']) ) $notes_user = $_SESSION['current_user'];

	//инициализация
    $notes_cats = $notes->NotesGetCats('notes_cats');


	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{	
		/*notes_all_tags*/
		$notes_all_tags = array();
		
		foreach ($notes_cats as $notes_cat)
		{
			$notes_tags_rows[] = $notes_cat['tags'];
		}	
		foreach ($notes_tags_rows as $notes_tags_row)
		{	
			$notes_tags_row_items = explode("\n",$notes_tags_row);
			$notes_all_tags = array_merge($notes_all_tags, $notes_tags_row_items);
		}
		foreach ($notes_all_tags as $notes_tag_id => $notes_tag)
		{
			$notes_all_tags[$notes_tag_id] = trim($notes_tag);
			if ($notes_tag == '') unset($notes_all_tags[$notes_tag_id]);
		}
		$notes_all_tags = array_unique($notes_all_tags);
		asort($notes_all_tags);
		
		foreach ($notes_all_tags as $notes_tag_id => $notes_tag)
		{
			$notes_tags .= $notes_tag . "\n";
		}
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
			!isset($_POST['tags'])
		   ) $site->SiteGoTo($parent_page);

		//инициализация
		$notes_title = $_POST['title'];
		$notes_text = $_POST['text'];
		$notes_name = $_POST['name'];
		$notes_url = $_POST['url'];
		$notes_email = $_POST['email'];
		$notes_tags = $_POST['tags'];

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

			$result = $notes->SqlAddHtml($add_array, 'notes_cats');
		}
	}
	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>