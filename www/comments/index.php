<?php
/***********************************************
-=Ms Site=-

������: Comments
�����: ������������ ������ <ms@ensk.ru>
��������: ������
***********************************************/

	//����������� �������� ������
	require_once('../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'comments';	

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>