<?php
/***********************************************
-=Ms Site=-

Модуль: Issue
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Рассылка
***********************************************/

	//подключение главного модуля
	require_once('../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'issue';

	require_once('../cgi-bin/smi.class');
    $smi = new Smi;

	require_once('../cgi-bin/feedback.class');
    $feedback = new Feedback;
	
	$smi_part = 1;
	
	$smi_sects = $smi->SqlGetPartObjects($smi_part, 'smi_sects');
	$smi_leaders = $smi->SmiGetPartLeaders($smi_part);
	$feedback_items = $feedback->SqlGetTableLastObjects(5, 'feedback_items');

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>