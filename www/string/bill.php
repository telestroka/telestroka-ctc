<?php
/***********************************************
-=Ms Site=-

������: String
�����: ������������ ������ <ms@ensk.ru>
��������: ���� ������������
***********************************************/

	//����������� �������
	require_once('../cgi-bin/site.class');
	$site = new Site;
	$site->PAGE = 'string_bill';
	$parent_page = $site->PAGES[$site->PAGE]['url'];
	
	require_once('../cgi-bin/bills.class');
	$bills = new Bills;
	
	require_once('../cgi-bin/utils/date.class');
	$date = new Date;
	$date->DateGetDayNumbers();
	
	//�������������
	$sid = ( isset($_GET['sid']) ) ? $_GET['sid'] : '';
	$item_info = $bills->BillsGetBillInfo($sid);

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>