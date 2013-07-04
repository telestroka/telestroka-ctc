<?php
/***********************************************
-=Ms Site=-

Модуль: Main
Автор: Миропольский Михаил <ms@ensk.ru>
Имя файла: part.php
Дата создания: 6.09.2005
Описание: SMI
***********************************************/

	//подключение главного модуля
	require_once('../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'string_part';

	require_once('../cgi-bin/string.class');
    $string = new String;

	require_once('../cgi-bin/notes.class');
    $notes = new Notes;
		
    //проверка на честность
    if ( !isset($_GET['part']) || !$string->SqlIsExist($_GET['part'], 'smi_parts') ) $smi_part = 1;
	else $smi_part = $_GET['part'];
	
	//инициализация	
	$smi_part_info = $string->SqlGetObj($smi_part, 'smi_parts');	
	$string_sects = $string->SqlGetPartObjects($smi_part, 'string_sects');
	
	$notes_items = $notes->SqlGetTableLastObjects(13, 'notes_cats');
	$string_items = $string->SqlGetPartObjects($smi_part, 'string_items');
	$screen_items_num = $string->SqlGetPartObjectsNum($smi_part, 'screen_items');
	$smi_items_num = $string->SqlGetPartObjectsNum($smi_part, 'smi_items');
	

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>