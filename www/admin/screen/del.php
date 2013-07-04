<?php
/***********************************************
-=Ms Site=-

Модуль: Screen
Автор:    Миропольский Михаил <ms@ensk.ru>
Описание: Удаление объекта 3-уровневой структуры
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin_screen_del';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/screen.class');
    $screen = new Screen;

	//проверка на честность
	if (
		!isset($_GET['id']) ||
		!$screen->SqlIsExist($_GET['id'], 'screen_items')
	   ) $site->SiteGoTo($parent_page);

    //инициализация
    $screen_id = $_GET['id'];
    $item_info = $screen->SqlGetObj($screen_id, 'screen_items');
    $screen_info = $screen->SqlGetTable('screen_items');

	unlink($site->PATH_IMAGES . '/screen/' . $screen_id . '.jpg');

	$screen->SqlDel($screen_id, 'screen_items');

	$site->SiteGoTo($parent_page . '?cat=' . $item_info['cat']);
?>