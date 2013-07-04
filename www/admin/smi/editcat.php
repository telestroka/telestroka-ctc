<?php
/***********************************************
-=Ms Site=-

������: Smi
�����: ������������ ������ <ms@ensk.ru>
��������: �������������� ������� � 4-��������� ���������
***********************************************/

	//����������� �������
	require_once('../../cgi-bin/site.class');
  $site = new Site;
	$site->PAGE = 'admin_smi_editcat';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/smi.class');
  $smi = new Smi;

	require_once('../../cgi-bin/vars/alert.class');
  $alert = new Alert;

	require_once('../../cgi-bin/utils/validate.class');
  $validate = new Validate;

	//���������
	$alert_title = '';
	$result = $smi_title = $smi_cat = $smi_sect = '';

  //�������������
  $smi_parts = $smi->SqlGetTable('smi_parts');

	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		//�������� �� ���������
		if ( !isset($_GET['cat']) || !$smi->SqlIsExist($_GET['cat'], 'smi_cats') ) $site->SiteGoTo($parent_page);

		//�������������
		$smi_cat = $_GET['cat'];
		$cat_info = $smi->SqlGetObj($smi_cat, 'smi_cats');
		$smi_title = $cat_info['title'];
    $smi_sect = $cat_info['sect'];
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//�������� �� ���������
		if (
			!isset($_POST['title']) ||
			!isset($_POST['cat']) ||
			!isset($_POST['sect']) ||
			!$smi->SqlIsExist($_GET['cat'], 'smi_cats')
		   ) $site->SiteGoTo($parent_page);

		//�������������
		$smi_cat = $_POST['cat'];
    $smi_sect = $_POST['sect'];
		$smi_title = $_POST['title'];
		$sect_info = $smi->SqlGetObj($smi_sect, 'smi_sects');
		$smi_part = $sect_info['part'];
		
		$oldcat_info = $smi->SqlGetObj($smi_cat, 'smi_cats');
		$smi_oldsect = $oldcat_info['sect'];
		$smi_oldpart = $oldcat_info['part'];
		

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

			$result = $smi->SqlUpdate($smi_cat, $add_array, 'smi_cats');
			if ($result) $result = $smi->SqlUpdatePartObjects($smi_oldpart, $smi_part, 'smi_cats');
			if ($result) $result = $smi->SqlUpdatePartObjects($smi_oldpart, $smi_part, 'smi_items');
			if ($result) $result = $smi->SqlUpdateSectObjects($smi_oldsect, $smi_sect, 'smi_items');
			if ($result) $site->SiteGoTo($parent_page . '?sect=' . $smi_sect);
			else $result = $alert->ALERT['system_error'];
		}
	}

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>
