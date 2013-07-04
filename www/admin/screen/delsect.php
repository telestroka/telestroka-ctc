<?php
/***********************************************
-=Ms Site=-

Модуль: Screen
Автор:    Миропольский Михаил <ms@ensk.ru>
Описание: Удаление раздела 4-уровневой структуры
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
  $site = new Site;
	$site->PAGE = 'admin_screen_delsect';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/screen.class');
  $screen = new Screen;

	//проверка на честность
	if (
			!isset($_GET['sect']) ||
			!$screen->SqlIsExist($_GET['sect'], 'screen_sects')
	   ) $site->SiteGoTo($parent_page);

	//инициализация
    $screen_sect = $_GET['sect'];
    $screen_cats = $screen->SqlGetSectObjects($screen_sect, 'screen_cats');
    $screen_items = $screen->SqlGetSectObjects($screen_sect, 'screen_items');
		$sect_info = $screen->SqlGetObj($screen_sect, 'screen_sects');

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
	  $screen->SqlDel($screen_sect, 'screen_sects');

	$site->SiteGoTo($parent_page . '?part=' . $sect_info['part']);
?>
