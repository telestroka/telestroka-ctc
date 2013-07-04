<?php
/***********************************************
-=Ms Site=-

Модуль: Screen
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Редактирование канала администратором
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin_screen_edit';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/screen.class');
    $screen = new screen;

	require_once('../../cgi-bin/utils/date.class'); 
    $date = new Date;
    $date->DateGetDayNumbers();

	require_once('../../cgi-bin/utils/image.class');
    $image = new Image;

	require_once('../../cgi-bin/vars/alert.class');
    $alert = new Alert;

	require_once('../../cgi-bin/utils/validate.class');
    $validate = new Validate;

	//обнуление
	$alert_name = $alert_title = $alert_slogan = $alert_info = $alert_price_list = $alert_image = $alert_date = $alert_rate = '';
    $result = $screen_cat = $screen_name = $screen_title = $screen_slogan = $screen_info = $screen_price_list = $screen_image = $screen_date = $screen_rate = '';

	//инициализация
   $smi_parts = $screen->SqlGetTable('smi_parts');

	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		//проверка на честность
		if (
				!isset($_GET['id']) ||
				!$screen->SqlIsExist($_GET['id'], 'screen_items')
		   ) $site->SiteGoTo($parent_page);

		//инициализация
		$screen_id = $_GET['id'];
		$screen_item_info = $screen->SqlGetObj($screen_id, 'screen_items');
		$screen_name = $screen_item_info['name'];
		$screen_title = $screen_item_info['title'];
		$screen_cat = $screen_item_info['cat'];
		$screen_slogan = $screen_item_info['slogan'];
		$screen_info = $screen_item_info['info'];
		$screen_price_list = $screen_item_info['price_list'];
		$screen_date = $screen_item_info['date'];
		$screen_rate = $screen_item_info['rate'];
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//проверка на честность
		if (
			!isset($_POST['name']) ||
			!isset($_POST['cat']) ||
  			!isset($_POST['date']) ||
			!isset($_POST['id']) ||
  			!$screen->SqlIsExist($_POST['id'], 'screen_items') ||
			!$screen->SqlIsExist($_POST['cat'], 'screen_cats')
		   ) $site->SiteGoTo($parent_page);

		//инициализация
		$screen_id= $_POST['id'];
		$screen_name = $_POST['name'];
		$screen_title = $_POST['title'];
		$screen_cat = $_POST['cat'];
		$screen_slogan = $_POST['slogan'];
		$screen_info = $_POST['info'];
		$screen_price_list = $_POST['price_list'];
		$screen_date = $_POST['date'];
		$screen_rate = $_POST['rate'];

		$screen_item_info = $screen->SqlGetObj($screen_id, 'screen_items');
	    $cat_info = $screen->SqlGetObj($screen_cat,'screen_cats');
	    $screen_sect = $cat_info['sect'];
	    $smi_part = $cat_info['part'];

		//image
		if ($_FILES['image']['name'] != '')
		{
			$screen_image = $_FILES['image']['name'];
			if ( $_FILES['image']['error'] > 0 || $_FILES['image']['size'] > $site->MAX_UPLOAD ) { $alert_image = $alert->ALERT['upload_error']; $alert->NOVALID = TRUE; }
			$image_type = $image->FsGetType($_FILES['image']['tmp_name']);
            if ($image_type != 'jpg') { $alert_image = 'Формат изображения должен быть jpg'; $alert->NOVALID = TRUE; }
            if ( !$validate->IsUploadFile($_FILES['image']['tmp_name'], $_FILES['image']['size']) ) { $alert_image = $alert->ALERT['upload_file']; $alert->NOVALID = TRUE; }
			/*if ( file_exists($site->PATH_IMAGES . 'screen/' . $screen_id . '.jpg') ) { $alert_image = $alert->ALERT['exist_file']; $alert->NOVALID = TRUE; };*/
		}

		//обработка
		if ($alert->NOVALID == FALSE)
		{
			if ($_FILES['image']['name'] != '')
            {
                $image->FsMove($_FILES['image']['tmp_name'], $site->PATH_IMAGES . 'screen/' . $screen_id . '.jpg');
            }

			$add_array = array(
								'name' => $screen_name,
								'title' => $screen_title,
								'cat' => $screen_cat,
								'sect' => $screen_sect,
								'part' => $smi_part,
								'info' => $screen_info,
								'price_list' => $screen_price_list,
								'date' => $screen_date,	
								'rate' => $screen_rate
								);			

			$result = $screen->SqlUpdateHtml($screen_id, $add_array, 'screen_items');
			if ($result) $site->SiteGoTo($parent_page . '?cat=' . $screen_cat);
			else $result = $alert->ALERT['system_error'];
		}
	}

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>