<?php
/***********************************************
-=Ms Site=-

������: Smi
�����:    ������������ ������ <ms@ensk.ru>
��������: �������� ������� 4-��������� ���������
***********************************************/

	//����������� �������
	require_once('../../cgi-bin/site.class');
  $site = new Site;
	$site->PAGE = 'admin_smi_delsect';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/smi.class');
  $smi = new Smi;

	//�������� �� ���������
	if (
			!isset($_GET['sect']) ||
			!$smi->SqlIsExist($_GET['sect'], 'smi_sects')
	   ) $site->SiteGoTo($parent_page);

	//�������������
    $smi_sect = $_GET['sect'];
    $smi_cats = $smi->SqlGetSectObjects($smi_sect, 'smi_cats');
    $smi_items = $smi->SqlGetSectObjects($smi_sect, 'smi_items');
		$sect_info = $smi->SqlGetObj($smi_sect, 'smi_sects');

    foreach ($smi_items as $item_id => $item_params)
    {
		unlink($site->PATH_IMAGES . '/smi/' . $item_id . '.jpg');
    }

    foreach ($smi_items as $item_id => $item_params)
    {
        $smi->SqlDel($item_id, 'smi_items');
    }
    foreach ($smi_cats as $cat_id => $cat_params)
    {
        $smi->SqlDel($cat_id, 'smi_cats');
    }
	  $smi->SqlDel($smi_sect, 'smi_sects');

	$site->SiteGoTo($parent_page . '?part=' . $sect_info['part']);
?>
