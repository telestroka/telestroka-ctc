<?php
/***********************************************
-=Ms Site=-

������: String
�����:    ������������ ������ <ms@ensk.ru>
��������: �������� ������� 4-��������� ���������
***********************************************/

	//����������� �������
	require_once('../../cgi-bin/site.class');
  $site = new Site;
	$site->PAGE = 'admin_string_delpart';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/string.class');
  $string = new String;

	//�������� �� ���������
	if (
			!isset($_GET['part']) ||
			!$string->SqlIsExist($_GET['part'], 'smi_parts')
	   ) $site->SiteGoTo($parent_page);

	//�������������
    $smi_part = $_GET['part'];
    $string_sects = $string->SqlGetPartObjects($smi_part, 'string_sects');
    $string_cats = $string->SqlGetPartObjects($smi_part, 'string_cats');
    $string_items = $string->SqlGetPartObjects($smi_part, 'string_items');

    foreach ($string_items as $item_id => $item_params)
    {
		unlink($site->PATH_IMAGES . '/string/' . $item_id . '.jpg');
    }

    foreach ($string_items as $item_id => $item_params)
    {
        $string->SqlDel($item_id, 'string_items');
    }
    foreach ($string_cats as $cat_id => $cat_params)
    {
        $string->SqlDel($cat_id, 'string_cats');
    }
    foreach ($string_sects as $sect_id => $sect_params)
    {
        $string->SqlDel($sect_id, 'string_sects');
    }
	  $string->SqlDel($smi_part, 'smi_parts');

	$site->SiteGoTo($parent_page);
?>
