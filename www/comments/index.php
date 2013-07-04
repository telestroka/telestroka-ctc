<?php
/***********************************************
-=Ms Site=-

Модуль: Comments
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Отзывы
***********************************************/

	//подключение главного модуля
	require_once('../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'comments';	

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>