<?php
/***********************************************
-=Ms Site=-

Модуль: Leaders
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Уровень востребованности
***********************************************/

	//подключение главного модуля
	require_once('../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'leaders';	

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>