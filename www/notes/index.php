<?php
/***********************************************
-=Ms Site=-

Модуль: Notes
Автор: Миропольский Михаил <ms@ensk.ru>
Описание:  Архив объявлений
***********************************************/

	//подключение модулей
	require_once('../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'notes';
	$parent_page = $site->GetParentPage();

	require_once('../cgi-bin/notes.class');
    $notes = new Notes;
	
	//инициализация
	$notes_cats = $notes->NotesGetCats('notes_cats');
	$notes_tag = 'Последние 50';

	
	if ( !isset($_GET['cat']) || !$notes->SqlIsExist($_GET['cat'], 'notes_cats') ) { //index page of archive
		$notes_last_cats = array_slice($notes_cats, 0, 50);
	} else { //page with announcement
		require_once('../cgi-bin/utils/date.class');
		$date = new Date; 
	
		$notes_cat = $_GET['cat'];
		
		//инициализация	    
		$cat_info = $notes->SqlGetObj($notes_cat, 'notes_cats');

		$prev = $notes->SqlGetPrev($notes_cat, $notes_cats);
		$next = $notes->SqlGetNext($notes_cat, $notes_cats);
		
		$notes_info = $notes->SqlGetCatObjects($notes_cat, 'notes_items');
	}
	
	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>