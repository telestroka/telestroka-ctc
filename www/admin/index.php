<?php
/***********************************************
-=Ms Site=-

������: Admin
�����: ������������ ������ <ms@ensk.ru>
��������: �����������������
***********************************************/

    //����������� �������
	require_once('../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin';

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>
