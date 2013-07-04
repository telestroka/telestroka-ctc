<?php
/***********************************************
-=Ms Site=-

Модуль: Screen
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Администрирование каналов
          Добавление канала администратором
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin_screen_cat';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/screen.class');
    $screen = new Screen;

	require_once('../../cgi-bin/utils/image.class');
    $image = new Image;

	require_once('../../cgi-bin/vars/alert.class');
    $alert = new Alert;

	require_once('../../cgi-bin/utils/validate.class');
    $validate = new Validate;

	//обнуление
	$alert_name = $alert_title = $alert_slogan = $alert_info = $alert_price_list = $alert_image = $alert_rate = '';
    $result = $screen_cat = $screen_name = $screen_title = $screen_slogan = $screen_info = $screen_price_list = $screen_image = $screen_date = $screen_rate = '';
    $screen_date = date('Y-m-d');

	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
	    //проверка на честность
	    if ( !isset($_GET['cat']) || !$screen->SqlIsExist($_GET['cat'], 'screen_cats') ) $site->SiteGoTo($parent_page);

        //инициализация
        $screen_cat = $_GET['cat'];
  	    $screen_cat_info = $screen->SqlGetCatObjects($screen_cat, 'screen_items');
    }

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//проверка на честность
		if (
			!isset($_POST['name']) ||
            !$screen->SqlIsExist($_POST['cat'], 'screen_cats')
		   ) $site->SiteGoTo($parent_page);

		//инициализация
		$screen_name = $_POST['name'];
		$screen_title = $_POST['title'];
		$screen_slogan = $_POST['slogan'];
		$screen_info = $_POST['info'];
		$screen_price_list = $_POST['price_list'];
		$screen_rate = $_POST['rate'];

        $screen_cat = $_POST['cat'];
  	    $screen_cat_info = $screen->SqlGetCatObjects($screen_cat, 'screen_items');
        $screen_all_info = $screen->SqlGetTable('screen_items');
        $screen_all_last = end($screen_all_info);
        $screen_id = $screen_all_last['id']+1;

		//image
		if ($_FILES['image']['name'] != '')
		{
			$screen_image = $_FILES['image']['name'];
			if ( $_FILES['image']['error'] > 0 || $_FILES['image']['size'] > $site->MAX_UPLOAD ) { $alert_image = $alert->ALERT['upload_error']; $alert->NOVALID = TRUE; }
			$image_type = $image->FsGetType($_FILES['image']['tmp_name']);
            if ($image_type != 'jpg') { $alert_image = 'Формат изображения должен быть jpg'; $alert->NOVALID = TRUE; }
			if ( !$validate->IsUploadFile($_FILES['image']['tmp_name'], $_FILES['image']['size']) ) { $alert_image = $alert->ALERT['upload_file']; $alert->NOVALID = TRUE; }
			if ( file_exists($site->PATH_IMAGES . 'screen/' . $screen_id . '.jpg') ) { $alert_image = $alert->ALERT['exist_file']; $alert->NOVALID = TRUE; };
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
								'slogan' => $screen_slogan,
								'info' => $screen_info,
								'price_list' => $screen_price_list,
								'date' => $screen_date,							
								'rate' => $screen_rate
								);

			$result = $screen->SqlAddHtml($add_array, 'screen_items');
			if ($result) 
			{	
				/*если удаляли последние элементы, то присваиваем картинке реальный id, а не последний+1 до добавления*/
				if ($_FILES['image']['name'] != '')
	            {
			        $screen_all_info_updated = $screen->SqlGetTable('screen_items');
			        $screen_all_last_updated = end($screen_all_info_updated);
			        $screen_id_updated = $screen_all_last_updated['id'];
	                if ($screen_id != $screen_id_updated) $image->FsMove($site->PATH_IMAGES . 'screen/' . $screen_id . '.jpg', $site->PATH_IMAGES . 'screen/' . $screen_id_updated . '.jpg');
	            }
				$site->SiteGoTo($site->PAGES[$site->PAGE]['url'] . '?cat=' . $screen_cat);				
			}
			else $result = $alert->ALERT['system_error'];
		}
	}

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>