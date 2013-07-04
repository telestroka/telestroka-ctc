<?php
/***********************************************
-=Ms Site=-

Модуль: Notes
Автор:    Миропольский Михаил <ms@ensk.ru>
Описание: Удаление комментария
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin_notes_del';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/notes.class');
    $notes = new Notes;

	//проверка на честность
	if (
		!isset($_GET['id']) ||
		!$notes->SqlIsExist($_GET['id'], 'notes_items')
	   ) $site->SiteGoTo($parent_page);

    //инициализация
    $notes_id = $_GET['id'];
    $item_info = $notes->SqlGetObj($notes_id, 'notes_items');

	$notes->SqlDel($notes_id, 'notes_items');

	$site->SiteGoTo($parent_page . '?cat=' . $item_info['cat']);
?>