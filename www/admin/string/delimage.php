<?php
/***********************************************
-=Ms Site=-

Модуль: String
Автор:    Миропольский Михаил <ms@ensk.ru>
Описание: Удаление картинки из объекта 4-уровневой структуры
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin_string_delimage';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/string.class');
    $string = new String;

	//проверка на честность
	if (
		!isset($_GET['id']) ||
		!$string->SqlIsExist($_GET['id'], 'string_items')
	   ) $site->SiteGoTo($parent_page);

    //инициализация
    $string_id = $_GET['id'];
	
  	unlink($site->PATH_IMAGES . 'string/' . $string_id . '.jpg');

	$site->SiteGoTo($parent_page . '?id=' . $string_id);
?>