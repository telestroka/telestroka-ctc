<?php
/***********************************************
-=Ms Site=-

Модуль: Office
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Как доехать и пройти
***********************************************/

	//подключение главного модуля
	require_once('../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'office';	

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>