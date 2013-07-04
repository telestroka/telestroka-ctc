<?php
/***********************************************
-=Ms Site=-

Модуль: Smi
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Редактирование объекта в 4-уровневой структуре администратором
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin_smi_edit';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/smi.class');
    $smi = new smi;

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
	$alert_name = $alert_title = $alert_slogan = $alert_circulation = $alert_pages = $alert_format = $alert_publish_day = $alert_territory = $alert_regions = $alert_distribute_way = $alert_info = $alert_price_list = $alert_rubriks = $alert_discount_portal = $alert_discount_nums = $alert_discount_agency = $alert_discount_markup = $alert_markup_cities = $alert_image = $alert_date = $alert_rate = '';
    $result = $smi_cat = $smi_name = $smi_title = $smi_slogan = $smi_circulation = $smi_pages = $smi_format = $smi_publish_day = $smi_territory = $smi_regions = $smi_distribute_way = $smi_info = $smi_price_list = $smi_rubriks = $smi_discount_portal = $smi_discount_nums = $smi_discount_agency = $smi_discount_markup = $smi_markup_cities = $smi_image = $smi_date = $smi_rate = '';

	//инициализация
   $smi_parts = $smi->SqlGetTable('smi_parts');
	 $smi_gender = 1;

	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		//проверка на честность
		if (
				!isset($_GET['id']) ||
				!$smi->SqlIsExist($_GET['id'], 'smi_items')
		   ) $site->SiteGoTo($parent_page);

		//инициализация
		$smi_id = $_GET['id'];
		$smi_item_info = $smi->SqlGetObj($smi_id, 'smi_items');
		$smi_name = $smi_item_info['name'];
		$smi_title = $smi_item_info['title'];
		$smi_cat = $smi_item_info['cat'];
		$smi_slogan = $smi_item_info['slogan'];
		$smi_circulation = $smi_item_info['circulation'];
		$smi_pages = $smi_item_info['pages'];
		$smi_format = $smi_item_info['format'];
		$smi_publish_day = $smi_item_info['publish_day'];
		$smi_territory = $smi_item_info['territory'];
		$smi_regions = $smi_item_info['regions'];
		$smi_distribute_way = $smi_item_info['distribute_way'];
		$smi_info = $smi_item_info['info'];
		$smi_price_list = $smi_item_info['price_list'];
		$smi_rubriks = $smi_item_info['rubriks'];
		$smi_discount_portal = $smi_item_info['discount_portal'];
		$smi_discount_nums = $smi_item_info['discount_nums'];
		$smi_discount_agency = $smi_item_info['discount_agency'];
		$smi_discount_markup = $smi_item_info['discount_markup'];
		$smi_markup_cities = $smi_item_info['markup_cities'];
		$smi_date = $smi_item_info['date'];
		$smi_rate = $smi_item_info['rate'];
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//проверка на честность
		if (
			!isset($_POST['name']) ||
			!isset($_POST['cat']) ||
  			!isset($_POST['date']) ||
			!isset($_POST['id']) ||
  			!$smi->SqlIsExist($_POST['id'], 'smi_items') ||
			!$smi->SqlIsExist($_POST['cat'], 'smi_cats')
		   ) $site->SiteGoTo($parent_page);

		//инициализация
		$smi_id= $_POST['id'];
		$smi_name = $_POST['name'];
		$smi_title = $_POST['title'];
		$smi_cat = $_POST['cat'];
		$smi_slogan = $_POST['slogan'];
		$smi_circulation = $_POST['circulation'];
		$smi_pages = $_POST['pages'];
		$smi_format = $_POST['format'];
		$smi_publish_day = $_POST['publish_day'];
		$smi_territory = $_POST['territory'];
		$smi_regions = $_POST['regions'];
		$smi_distribute_way = $_POST['distribute_way'];
		$smi_info = $_POST['info'];
		$smi_price_list = $_POST['price_list'];
		$smi_rubriks = $_POST['rubriks'];
		$smi_discount_portal = $_POST['discount_portal'];
		$smi_discount_nums = $_POST['discount_nums'];
		$smi_discount_agency = $_POST['discount_agency'];
		$smi_discount_markup = $_POST['discount_markup'];
		$smi_markup_cities = $_POST['markup_cities'];
		$smi_date = $_POST['date'];
		$smi_rate = $_POST['rate'];

		$smi_item_info = $smi->SqlGetObj($smi_id, 'smi_items');
	    $cat_info = $smi->SqlGetObj($smi_cat,'smi_cats');
	    $smi_sect = $cat_info['sect'];
	    $smi_part = $cat_info['part'];

		//image
		if ($_FILES['image']['name'] != '')
		{
			$smi_image = $_FILES['image']['name'];
			if ( $_FILES['image']['error'] > 0 || $_FILES['image']['size'] > $site->MAX_UPLOAD ) { $alert_image = $alert->ALERT['upload_error']; $alert->NOVALID = TRUE; }
			$image_type = $image->FsGetType($_FILES['image']['tmp_name']);
            if ($image_type != 'jpg') { $alert_image = 'Формат изображения должен быть jpg'; $alert->NOVALID = TRUE; }
            if ( !$validate->IsUploadFile($_FILES['image']['tmp_name'], $_FILES['image']['size']) ) { $alert_image = $alert->ALERT['upload_file']; $alert->NOVALID = TRUE; }
			/*if ( file_exists($site->PATH_IMAGES . 'smi/' . $smi_id . '.jpg') ) { $alert_image = $alert->ALERT['exist_file']; $alert->NOVALID = TRUE; };*/
		}

		//обработка
		if ($alert->NOVALID == FALSE)
		{
			if ($_FILES['image']['name'] != '')
            {
                $image->FsMove($_FILES['image']['tmp_name'], $site->PATH_IMAGES . 'smi/' . $smi_id . '.jpg');
            }

			$add_array = array(
								'name' => $smi_name,
								'title' => $smi_title,
								'cat' => $smi_cat,
								'sect' => $smi_sect,
								'part' => $smi_part,
								'slogan' => $smi_slogan,
								'circulation' => $smi_circulation,
								'pages' => $smi_pages,
								'format' => $smi_format,
								'publish_day' => $smi_publish_day,
								'territory' => $smi_territory,
								'regions' => $smi_regions,
								'distribute_way' => $smi_distribute_way,
								'info' => $smi_info,
								'price_list' => $smi_price_list,
								'rubriks' => $smi_rubriks,
								'discount_portal' => $smi_discount_portal,
								'discount_nums' => $smi_discount_nums,
								'discount_agency' => $smi_discount_agency,
								'discount_markup' => $smi_discount_markup,
								'markup_cities' => $smi_markup_cities,	
								'date' => $smi_date,	
								'rate' => $smi_rate
								);			

			$result = $smi->SqlUpdateHtml($smi_id, $add_array, 'smi_items');
			if ($result) $site->SiteGoTo($parent_page . '?cat=' . $smi_cat);
			else $result = $alert->ALERT['system_error'];
		}
	}

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>