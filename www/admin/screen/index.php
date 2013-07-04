<?php
/***********************************************
-=Ms Site=-

������: Screen
�����: ������������ ������ <ms@ensk.ru>
��������: ����������������� 4-��������� ���������
          ���������� ������� � 4-��������� ��������� ���������������
***********************************************/

	//����������� �������
	require_once('../../cgi-bin/site.class');
  $site = new Site;
	$site->PAGE = 'admin_screen';
	$parent_page = $site->PAGES[$site->PAGE]['url'];

	require_once('../../cgi-bin/screen.class');
  $screen = new Screen;

	require_once('../../cgi-bin/vars/alert.class');
  $alert = new Alert;

	require_once('../../cgi-bin/utils/validate.class');
  $validate = new Validate;

	//���������
	$alert_title = '';
	$result = $screen_title = '';

    //�������������
	$smi_parts = $screen->SqlGetTable('smi_parts');

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//�������� �� ���������
		if ( !isset($_POST['title']) ) $site->SiteGoTo($parent_page);

		//�������������
		$screen_title = $_POST['title'];

		//title
		if ( !$validate->IsRightLength($screen_title, 1, 255) ) { $alert_title = $alert->ALERT['1-255']; $alert->NOVALID = TRUE; }
		/*if ( $validate->IsDamn($screen_title) ) { $alert_title = $alert->ALERT['damn']; $alert->NOVALID = 'ALERT'; }*/

		//���������
		if ($alert->NOVALID == FALSE)
		{
			$add_array = array('title' => $screen_title);
			$result = $screen->SqlAdd($add_array, 'smi_parts');
			if ($result) $site->SiteGoTo($parent_page);
			else $result = $alert->ALERT['system_error'];
		}
	}

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>