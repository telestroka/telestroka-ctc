<?php
/***********************************************
-=Ms Site=-

������: String
�����: ������������ ������ <ms@ensk.ru>
��������: ����� �����
***********************************************/

	//����������� �������
	require_once('../cgi-bin/site.class');
	$site = new Site;
	$site->PAGE = 'string_form';
	$parent_page = $site->PAGES[$site->PAGE]['url'];
	
	require_once('../cgi-bin/bills.class');
	$bills = new Bills;
	
	require_once('../cgi-bin/utils/date.class');
	$date = new Date;
	
	//�������������
	$sid = $_POST['sid'];
	$item_info = $bills->BillsGetBillInfo($sid);
	
	include_once($site->PATH_INC . '/meta.inc');
	include_once($site->GetPageFileName() . '.inc');
?>