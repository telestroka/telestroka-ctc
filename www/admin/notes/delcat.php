<?php
/***********************************************
-=Ms Site=-

Модуль: Notes
Автор:    Миропольский Михаил <ms@ensk.ru>
Описание: Удаление статьи
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
	$site = new Site;
	$site->PAGE = 'admin_notes_delcat';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/notes.class');
	$notes = new Notes;

	require_once('../../cgi-bin/utils/fs.class');
    $fs = new Fs;

	//проверка на честность
	if (
			!isset($_GET['cat']) ||
			!$notes->SqlIsExist($_GET['cat'], 'notes_cats')
	   ) $site->SiteGoTo($parent_page);

	//инициализация
    $notes_info = $notes->SqlGetTable('notes_cats');
    $notes_cat = $_GET['cat'];
    $notes_items = $notes->SqlGetCatObjects($notes_cat, 'notes_items');
    $cat_info = $notes->SqlGetObj($notes_cat, 'notes_cats');

	if ($cat_info['image'] != '' && $notes->SqlCountImages($cat_info['image'], 'notes_cats') < 2)
	{
		unlink($site->PATH_IMAGES . '/notes/' . $cat_info['image']);
		unlink($site->PATH_IMAGES . '/notes/s_' . $cat_info['image']);
	}

    foreach ($notes_items as $item_id => $item_params)
    {
        $notes->SqlDel($item_id, 'notes_items');
    }
	 
	$notes->SqlDel($notes_cat, 'notes_cats');
			
	$site->SiteGoTo($parent_page);
?>