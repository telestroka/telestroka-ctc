<?php
/***********************************************
-=Ms Site=-

Модуль: String
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Редактирование канала администратором
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin_string_edit';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/string.class');
    $string = new string;

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
    $result = $string_cat = $string_name = $string_title = $string_slogan = $string_info = $string_price_list = $string_image = $string_date = $string_rate = '';

	//инициализация
   $smi_parts = $string->SqlGetTable('smi_parts');

	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		//проверка на честность
		if (
				!isset($_GET['id']) ||
				!$string->SqlIsExist($_GET['id'], 'string_items')
		   ) $site->SiteGoTo($parent_page);

		//инициализация
		$string_id = $_GET['id'];
		$string_item_info = $string->SqlGetObj($string_id, 'string_items');
		$string_name = $string_item_info['name'];
		$string_title = $string_item_info['title'];
		$string_cat = $string_item_info['cat'];
		$string_slogan = $string_item_info['slogan'];
		$string_info = $string_item_info['info'];
		$string_price_list = $string_item_info['price_list'];
		$string_date = $string_item_info['date'];
		$string_rate = $string_item_info['rate'];
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//проверка на честность
		if (
			!isset($_POST['name']) ||
			!isset($_POST['cat']) ||
  			!isset($_POST['date']) ||
			!isset($_POST['id']) ||
  			!$string->SqlIsExist($_POST['id'], 'string_items') ||
			!$string->SqlIsExist($_POST['cat'], 'string_cats')
		   ) $site->SiteGoTo($parent_page);

		//инициализация
		$string_id= $_POST['id'];
		$string_name = $_POST['name'];
		$string_title = $_POST['title'];
		$string_cat = $_POST['cat'];
		$string_slogan = $_POST['slogan'];
		$string_info = $_POST['info'];
		$string_price_list = $_POST['price_list'];
		$string_date = $_POST['date'];
		$string_rate = $_POST['rate'];

		$string_item_info = $string->SqlGetObj($string_id, 'string_items');
	    $cat_info = $string->SqlGetObj($string_cat,'string_cats');
	    $string_sect = $cat_info['sect'];
	    $smi_part = $cat_info['part'];

		//image
		if ($_FILES['image']['name'] != '')
		{
			$string_image = $_FILES['image']['name'];
			if ( $_FILES['image']['error'] > 0 || $_FILES['image']['size'] > $site->MAX_UPLOAD ) { $alert_image = $alert->ALERT['upload_error']; $alert->NOVALID = TRUE; }
			$image_type = $image->FsGetType($_FILES['image']['tmp_name']);
            if ($image_type != 'jpg') { $alert_image = 'Формат изображения должен быть jpg'; $alert->NOVALID = TRUE; }
            if ( !$validate->IsUploadFile($_FILES['image']['tmp_name'], $_FILES['image']['size']) ) { $alert_image = $alert->ALERT['upload_file']; $alert->NOVALID = TRUE; }
			/*if ( file_exists($site->PATH_IMAGES . 'string/' . $string_id . '.jpg') ) { $alert_image = $alert->ALERT['exist_file']; $alert->NOVALID = TRUE; };*/
		}

		//обработка
		if ($alert->NOVALID == FALSE)
		{
			if ($_FILES['image']['name'] != '')
            {
                $image->FsMove($_FILES['image']['tmp_name'], $site->PATH_IMAGES . 'string/' . $string_id . '.jpg');
            }

			$add_array = array(
								'name' => $string_name,
								'title' => $string_title,
								'cat' => $string_cat,
								'sect' => $string_sect,
								'part' => $smi_part,
								'info' => $string_info,
								'price_list' => $string_price_list,
								'date' => $string_date,	
								'rate' => $string_rate
								);			

			$result = $string->SqlUpdateHtml($string_id, $add_array, 'string_items');
			if ($result) $site->SiteGoTo($parent_page . '?cat=' . $string_cat);
			else $result = $alert->ALERT['system_error'];
		}
	}

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>