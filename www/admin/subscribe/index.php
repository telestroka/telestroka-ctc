<?php
/***********************************************
-=Ms Site=-

������: Subscribe
�����: ������������ ������ <ms@ensk.ru>
��������: �������� �����������
***********************************************/

	//���������� ������
	require_once('../../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin_subscribe';

	require_once('../../cgi-bin/subscribe.class');
    $subscribe = new Subscribe;
	
	//���������
	$result = '';


	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$subject = 'Raportal.ru Issue 6/25.03.2008';
		$subscribe->SubscribeMail($site->PATH_DATA . '/subscribe.dat', $site->PATH_DATA . '/subscribe/', $subject, $site->NAME_SITE, $site->EMAIL_ROBOT);
		$result = '�������� ���������.';
		
	}

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>