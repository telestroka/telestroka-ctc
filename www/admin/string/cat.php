<?php
/***********************************************
-=Ms Site=-

Модуль: String
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Администрирование каналов
          Добавление канала администратором
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin_string_cat';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/string.class');
    $string = new String;

	require_once('../../cgi-bin/utils/image.class');
    $image = new Image;

	require_once('../../cgi-bin/vars/alert.class');
    $alert = new Alert;

	require_once('../../cgi-bin/utils/validate.class');
    $validate = new Validate;

	//обнуление
	$alert_name = $alert_title = $alert_slogan = $alert_info = $alert_price_list = $alert_image = $alert_rate = '';
    $result = $string_cat = $string_name = $string_title = $string_slogan = $string_info = $string_price_list = $string_image = $string_date = $string_rate = '';
    $string_date = date('Y-m-d');

	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
	    //проверка на честность
	    if ( !isset($_GET['cat']) || !$string->SqlIsExist($_GET['cat'], 'string_cats') ) $site->SiteGoTo($parent_page);

        //инициализация
        $string_cat = $_GET['cat'];
  	    $string_cat_info = $string->SqlGetCatObjects($string_cat, 'string_items');
    }

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//проверка на честность
		if (
			!isset($_POST['name']) ||
            !$string->SqlIsExist($_POST['cat'], 'string_cats')
		   ) $site->SiteGoTo($parent_page);

		//инициализация
		$string_name = $_POST['name'];
		$string_title = $_POST['title'];
		$string_slogan = $_POST['slogan'];
		$string_info = $_POST['info'];
		$string_price_list = $_POST['price_list'];
		$string_rate = $_POST['rate'];

        $string_cat = $_POST['cat'];
  	    $string_cat_info = $string->SqlGetCatObjects($string_cat, 'string_items');
        $string_all_info = $string->SqlGetTable('string_items');
        $string_all_last = end($string_all_info);
        $string_id = $string_all_last['id']+1;

		//image
		if ($_FILES['image']['name'] != '')
		{
			$string_image = $_FILES['image']['name'];
			if ( $_FILES['image']['error'] > 0 || $_FILES['image']['size'] > $site->MAX_UPLOAD ) { $alert_image = $alert->ALERT['upload_error']; $alert->NOVALID = TRUE; }
			$image_type = $image->FsGetType($_FILES['image']['tmp_name']);
            if ($image_type != 'jpg') { $alert_image = 'Формат изображения должен быть jpg'; $alert->NOVALID = TRUE; }
			if ( !$validate->IsUploadFile($_FILES['image']['tmp_name'], $_FILES['image']['size']) ) { $alert_image = $alert->ALERT['upload_file']; $alert->NOVALID = TRUE; }
			if ( file_exists($site->PATH_IMAGES . 'string/' . $string_id . '.jpg') ) { $alert_image = $alert->ALERT['exist_file']; $alert->NOVALID = TRUE; };
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
								'slogan' => $string_slogan,
								'info' => $string_info,
								'price_list' => $string_price_list,
								'date' => $string_date,							
								'rate' => $string_rate
								);

			$result = $string->SqlAddHtml($add_array, 'string_items');
			if ($result) 
			{	
				/*если удаляли последние элементы, то присваиваем картинке реальный id, а не последний+1 до добавления*/
				if ($_FILES['image']['name'] != '')
	            {
			        $string_all_info_updated = $string->SqlGetTable('string_items');
			        $string_all_last_updated = end($string_all_info_updated);
			        $string_id_updated = $string_all_last_updated['id'];
	                if ($string_id != $string_id_updated) $image->FsMove($site->PATH_IMAGES . 'string/' . $string_id . '.jpg', $site->PATH_IMAGES . 'string/' . $string_id_updated . '.jpg');
	            }
				$site->SiteGoTo($site->PAGES[$site->PAGE]['url'] . '?cat=' . $string_cat);				
			}
			else $result = $alert->ALERT['system_error'];
		}
	}

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>