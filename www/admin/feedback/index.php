<?php
/***********************************************
-=Ms Site=-

������: Feedback
�����: ������������ ������ <ms@ensk.ru>
��������: ����������������� �������� �����
***********************************************/

	//����������� �������� ������
	require_once('../../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin_feedback';

	require_once('../../cgi-bin/feedback.class');
    $feedback = new Feedback;
	
	$items_info = $feedback->SqlGetReverseTable('feedback_items');

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>
