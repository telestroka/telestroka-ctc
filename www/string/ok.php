<?php
/***********************************************
-=Ms Site=-

������: String
�����: ������������ ������ <ms@ensk.ru>
��� �����: ok.php
***********************************************/

	//����������� �������� ������
	require_once('../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'string_ok';	

	require_once('../cgi-bin/string.class');
    $string = new String;
		
    //�������� �� ���������
    if ( !isset($_GET['part']) || !$string->SqlIsExist($_GET['part'], 'smi_parts') ) $smi_part = 1;
	else $smi_part = $_GET['part'];

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>