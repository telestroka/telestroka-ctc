<?php
/***********************************************
-=Ms Site=-

������: Office
�����: ������������ ������ <ms@ensk.ru>
��������: ��� ������� � ������
***********************************************/

	//����������� �������� ������
	require_once('../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'office';	

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>