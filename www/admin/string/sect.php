<?php
/***********************************************
-=Ms Site=-

������: String
�����: ������������ ������ <ms@ensk.ru>
��������: ����������������� ������ 4-��������� ���������
          ���������� ������� � 4-��������� ��������� ���������������
***********************************************/

	//����������� �������
	require_once('../../cgi-bin/site.class');
  $site = new Site;
	$site->PAGE = 'admin_string_sect';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/string.class');
  $string = new String;

	require_once('../../cgi-bin/vars/alert.class');
  $alert = new Alert;

	require_once('../../cgi-bin/utils/validate.class');
  $validate = new Validate;

	//���������
	$alert_title = '';
	$result = $string_title = '';

	if ($_SERVER['REQUEST_METHOD'] == 'GET')
  {
    //�������� �� ���������
    if ( !isset($_GET['sect']) || !$string->SqlIsExist($_GET['sect'], 'string_sects') ) $site->SiteGoTo($parent_page);

  	//�������������
  	$string_sect = $_GET['sect'];
  	$string_cats = $string->SqlGetSectObjects($string_sect, 'string_cats');
  }

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//�������� �� ���������
		if ( !isset($_POST['title']) || !isset($_POST['sect']) || !$string->SqlIsExist($_POST['sect'], 'string_sects') ) $site->SiteGoTo($parent_page);

		//�������������
		$string_sect = $_POST['sect'];
		$string_title = $_POST['title'];
		$string_cats = $string->SqlGetSectObjects($string_sect, 'string_cats');
		$sect_info = $string->SqlGetObj($string_sect, 'string_sects');
		$smi_part = $sect_info['part'];

		//title
		if ( !$validate->IsRightLength($string_title, 1, 255) ) { $alert_title = $alert->ALERT['1-255']; $alert->NOVALID = TRUE; }
		/*if ( $validate->IsDamn($string_title) ) { $alert_title = $alert->ALERT['damn']; $alert->NOVALID = 'ALERT'; }*/

		//���������
		if ($alert->NOVALID == FALSE)
		{
			$add_array = array(
                                'title' => $string_title,
                                'sect' => $string_sect,
                                'part' => $smi_part
                              );
			$result = $string->SqlAdd($add_array, 'string_cats');
			if ($result) $site->SiteGoTo($site->PAGES[$site->PAGE]['url'] . '?sect=' . $string_sect );
			else $result = $alert->ALERT['system_error'];
		}
	}

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>
