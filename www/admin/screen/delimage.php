<?php
/***********************************************
-=Ms Site=-

Модуль: Screen
Автор:    Миропольский Михаил <ms@ensk.ru>
Описание: Удаление картинки из объекта 4-уровневой структуры
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin_screen_delimage';
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
	
  	unlink($site->PATH_IMAGES . 'screen/' . $screen_id . '.jpg');

	$site->SiteGoTo($parent_page . '?id=' . $screen_id);
?>