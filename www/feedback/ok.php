<?php
/***********************************************
-=Ms Site=-

Модуль: Feedback
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Обратная связь
***********************************************/

	//подключение главного модуля
	require_once('../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'feedback_ok';

	require_once('../cgi-bin/feedback.class');
    $feedback = new Feedback;
	
	$feedback_items = $feedback->SqlGetTableLastObjects(5, 'feedback_items');
	
	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>