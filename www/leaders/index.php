<?php
/***********************************************
-=Ms Site=-

������: Leaders
�����: ������������ ������ <ms@ensk.ru>
��������: ������� ����������������
***********************************************/

	//����������� �������� ������
	require_once('../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'leaders';	

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>