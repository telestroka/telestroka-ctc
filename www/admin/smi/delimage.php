<?php
/***********************************************
-=Ms Site=-

������: Smi
�����:    ������������ ������ <ms@ensk.ru>
��������: �������� �������� �� ������� 4-��������� ���������
***********************************************/

	//����������� �������
	require_once('../../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin_smi_delimage';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/smi.class');
    $smi = new Smi;

	//�������� �� ���������
	if (
		!isset($_GET['id']) ||
		!$smi->SqlIsExist($_GET['id'], 'smi_items')
	   ) $site->SiteGoTo($parent_page);

    //�������������
    $smi_id = $_GET['id'];
	
  	unlink($site->PATH_IMAGES . 'smi/' . $smi_id . '.jpg');

	$site->SiteGoTo($parent_page . '?id=' . $smi_id);
?>