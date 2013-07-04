<?php
/***********************************************
-=Ms Site=-

Модуль: Notes
Автор:    Миропольский Михаил <ms@ensk.ru>
Описание: Удаление картинки из комментируемой статьи
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin_notes_delimage';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/notes.class');
    $notes = new Notes;

	//проверка на честность
	if (
		!isset($_GET['cat']) ||
		!$notes->SqlIsExist($_GET['cat'], 'notes_cats')
	   ) $site->SiteGoTo($parent_page);

    //инициализация
    $notes_cat = $_GET['cat'];
    $notes_info = $notes->SqlGetObj($notes_cat, 'notes_cats');

  	$add_array = array('image' => '');
    $result = $notes->SqlUpdate($notes_cat, $add_array, 'notes_cats');

  	if ($notes_info['image'] != '' && $notes->SqlCountImages($notes_info['image'], 'notes_cats') < 2) // если поменяли картинку и таких картинок больше нет в базе
  	{
  		unlink($site->PATH_IMAGES . '/notes/' . $notes_info['image']);
  		unlink($site->PATH_IMAGES . '/notes/s_' . $notes_info['image']);
  	}

	$site->SiteGoTo($parent_page . '?cat=' . $notes_cat);
?>