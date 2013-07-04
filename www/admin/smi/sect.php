<?php
/***********************************************
-=Ms Site=-

������: Smi
�����: ������������ ������ <ms@ensk.ru>
��������: ����������������� ������ 4-��������� ���������
          ���������� ������� � 4-��������� ��������� ���������������
***********************************************/

	//����������� �������
	require_once('../../cgi-bin/site.class');
  $site = new Site;
	$site->PAGE = 'admin_smi_sect';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/smi.class');
  $smi = new Smi;

	require_once('../../cgi-bin/vars/alert.class');
  $alert = new Alert;

	require_once('../../cgi-bin/utils/validate.class');
  $validate = new Validate;

	//���������
	$alert_title = '';
	$result = $smi_title = '';

	if ($_SERVER['REQUEST_METHOD'] == 'GET')
  {
    //�������� �� ���������
    if ( !isset($_GET['sect']) || !$smi->SqlIsExist($_GET['sect'], 'smi_sects') ) $site->SiteGoTo($parent_page);

  	//�������������
  	$smi_sect = $_GET['sect'];
  	$smi_cats = $smi->SqlGetSectObjects($smi_sect, 'smi_cats');
  }

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//�������� �� ���������
		if ( !isset($_POST['title']) || !isset($_POST['sect']) || !$smi->SqlIsExist($_POST['sect'], 'smi_sects') ) $site->SiteGoTo($parent_page);

		//�������������
		$smi_sect = $_POST['sect'];
		$smi_title = $_POST['title'];
		$smi_cats = $smi->SqlGetSectObjects($smi_sect, 'smi_cats');
		$sect_info = $smi->SqlGetObj($smi_sect, 'smi_sects');
		$smi_part = $sect_info['part'];

		//title
		if ( !$validate->IsRightLength($smi_title, 1, 255) ) { $alert_title = $alert->ALERT['1-255']; $alert->NOVALID = TRUE; }
		/*if ( $validate->IsDamn($smi_title) ) { $alert_title = $alert->ALERT['damn']; $alert->NOVALID = 'ALERT'; }*/

		//���������
		if ($alert->NOVALID == FALSE)
		{
			$add_array = array(
                                'title' => $smi_title,
                                'sect' => $smi_sect,
                                'part' => $smi_part
                              );
			$result = $smi->SqlAdd($add_array, 'smi_cats');
			if ($result) $site->SiteGoTo($site->PAGES[$site->PAGE]['url'] . '?sect=' . $smi_sect );
			else $result = $alert->ALERT['system_error'];
		}
	}

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>
