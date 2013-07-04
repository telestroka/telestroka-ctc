<?php
/***********************************************
-=Ms Site=-

Модуль: Feedback
Автор:    Миропольский Михаил <ms@ensk.ru>
Описание: Удаление объекта 4-уровневой структуры
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin_feedback_del';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/feedback.class');
    $feedback = new Feedback;

	//проверка на честность
	if (
		!isset($_GET['id']) ||
		!$feedback->SqlIsExist($_GET['id'], 'feedback_items')
	   ) $site->SiteGoTo($parent_page);

    //инициализация
    $feedback_id = $_GET['id'];

	$feedback->SqlDel($feedback_id, 'feedback_items');

	$site->SiteGoTo($parent_page);
?>