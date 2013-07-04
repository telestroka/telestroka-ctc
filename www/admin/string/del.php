<?php
/***********************************************
-=Ms Site=-

Модуль: String
Автор:    Миропольский Михаил <ms@ensk.ru>
Описание: Удаление объекта 3-уровневой структуры
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin_string_del';
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
    $item_info = $string->SqlGetObj($string_id, 'string_items');
    $string_info = $string->SqlGetTable('string_items');

	unlink($site->PATH_IMAGES . '/string/' . $string_id . '.jpg');

	$string->SqlDel($string_id, 'string_items');

	$site->SiteGoTo($parent_page . '?cat=' . $item_info['cat']);
?>