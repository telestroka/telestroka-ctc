<?php
/***********************************************
-=Ms Site=-

������: Screen
�����:    ������������ ������ <ms@ensk.ru>
��������: �������� �������� �� ������� 4-��������� ���������
***********************************************/

	//����������� �������
	require_once('../../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin_screen_delimage';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/screen.class');
    $screen = new Screen;

	//�������� �� ���������
	if (
		!isset($_GET['id']) ||
		!$screen->SqlIsExist($_GET['id'], 'screen_items')
	   ) $site->SiteGoTo($parent_page);

    //�������������
    $screen_id = $_GET['id'];
	
  	unlink($site->PATH_IMAGES . 'screen/' . $screen_id . '.jpg');

	$site->SiteGoTo($parent_page . '?id=' . $screen_id);
?>