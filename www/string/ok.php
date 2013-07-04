<?php
/***********************************************
-=Ms Site=-

Модуль: String
Автор: Миропольский Михаил <ms@ensk.ru>
Имя файла: ok.php
***********************************************/

	//подключение главного модуля
	require_once('../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'string_ok';	

	require_once('../cgi-bin/string.class');
    $string = new String;
		
    //проверка на честность
    if ( !isset($_GET['part']) || !$string->SqlIsExist($_GET['part'], 'smi_parts') ) $smi_part = 1;
	else $smi_part = $_GET['part'];

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>