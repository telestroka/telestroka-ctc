<?php
/***********************************************
-=Ms Site=-

������: String
�����: ������������ ������ <ms@ensk.ru>
��������: ����������������� �������� 4-��������� ���������
          ���������� ������� � 4-��������� ��������� ���������������
***********************************************/

	//����������� �������
	require_once('../../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin_string_part';
	$parent_page = $site->PAGES[$site->PAGE]['url'];

	require_once('../../cgi-bin/string.class');
  $string = new String;

	require_once('../../cgi-bin/vars/alert.class');
  $alert = new Alert;

	require_once('../../cgi-bin/utils/validate.class');
  $validate = new Validate;

	//���������
	$alert_title = '';
	$result = $string_title = '';

    //�������������
	$smi_parts = $string->SqlGetTable('smi_parts');
	$string_sects = $string->SqlGetTable('string_sects');

	if ($_SERVER['REQUEST_METHOD'] == 'GET')
  {
    //�������� �� ���������
    if ( !isset($_GET['part']) || !$string->SqlIsExist($_GET['part'], 'smi_parts') ) $site->SiteGoTo($parent_page);

  	//�������������
  	$smi_part = $_GET['part'];
  	$string_sects = $string->SqlGetPartObjects($smi_part, 'string_sects');
  }

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
    //�������� �� ���������
    if ( !isset($_POST['title']) || !isset($_POST['part']) || !$string->SqlIsExist($_POST['part'], 'smi_parts') ) $site->SiteGoTo($parent_page);

  	//�������������
  	$smi_part = $_POST['part'];
  	$string_sects = $string->SqlGetPartObjects($smi_part, 'string_sects');
		$string_title = $_POST['title'];

		//title
		if ( !$validate->IsRightLength($string_title, 1, 255) ) { $alert_title = $alert->ALERT['1-255']; $alert->NOVALID = TRUE; }
		/*if ( $validate->IsDamn($string_title) ) { $alert_title = $alert->ALERT['damn']; $alert->NOVALID = 'ALERT'; }*/

		//���������
		if ($alert->NOVALID == FALSE)
		{
			$add_array = array(
                          'title' => $string_title,
                          'part' => $smi_part
                        );
			$result = $string->SqlAdd($add_array, 'string_sects');
			if ($result) $site->SiteGoTo($parent_page . '?part=' . $smi_part);
			else $result = $alert->ALERT['system_error'];
		}
	}

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>
