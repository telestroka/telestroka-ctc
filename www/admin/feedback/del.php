<?php
/***********************************************
-=Ms Site=-

������: Feedback
�����:    ������������ ������ <ms@ensk.ru>
��������: �������� ������� 4-��������� ���������
***********************************************/

	//����������� �������
	require_once('../../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin_feedback_del';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/feedback.class');
    $feedback = new Feedback;

	//�������� �� ���������
	if (
		!isset($_GET['id']) ||
		!$feedback->SqlIsExist($_GET['id'], 'feedback_items')
	   ) $site->SiteGoTo($parent_page);

    //�������������
    $feedback_id = $_GET['id'];

	$feedback->SqlDel($feedback_id, 'feedback_items');

	$site->SiteGoTo($parent_page);
?>