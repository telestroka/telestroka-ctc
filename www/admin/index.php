<?php
/***********************************************
-=Ms Site=-

Модуль: Admin
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Администрирование
***********************************************/

    //подключение модулей
	require_once('../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin';

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>
