<?php
/***********************************************
-=Ms Site=-

Модуль: Screen
Автор:    Миропольский Михаил <ms@ensk.ru>
Описание: Удаление сектора 4-уровневой структуры
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
  $site = new Site;
	$site->PAGE = 'admin_screen_delpart';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/screen.class');
  $screen = new Screen;

	//проверка на честность
	if (
			!isset($_GET['part']) ||
			!$screen->SqlIsExist($_GET['part'], 'smi_parts')
	   ) $site->SiteGoTo($parent_page);

	//инициализация
    $smi_part = $_GET['part'];
    $screen_sects = $screen->SqlGetPartObjects($smi_part, 'screen_sects');
    $screen_cats = $screen->SqlGetPartObjects($smi_part, 'screen_cats');
    $screen_items = $screen->SqlGetPartObjects($smi_part, 'screen_items');

    foreach ($screen_items as $item_id => $item_params)
    {
		unlink($site->PATH_IMAGES . '/screen/' . $item_id . '.jpg');
    }

    foreach ($screen_items as $item_id => $item_params)
    {
        $screen->SqlDel($item_id, 'screen_items');
    }
    foreach ($screen_cats as $cat_id => $cat_params)
    {
        $screen->SqlDel($cat_id, 'screen_cats');
    }
    foreach ($screen_sects as $sect_id => $sect_params)
    {
        $screen->SqlDel($sect_id, 'screen_sects');
    }
	  $screen->SqlDel($smi_part, 'smi_parts');

	$site->SiteGoTo($parent_page);
?>
