<?php
/***********************************************
-=Ms Site=-

������: String
�����:    ������������ ������ <ms@ensk.ru>
��������: �������� ������� �� 4-��������� ���������
***********************************************/

	//����������� �������
	require_once('../../cgi-bin/site.class');
  $site = new Site;
	$site->PAGE = 'admin_string_delcat';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/string.class');
  $string = new String;

	//�������� �� ���������
	if (
			!isset($_GET['cat']) ||
			!$string->SqlIsExist($_GET['cat'], 'string_cats')
	   ) $site->SiteGoTo($parent_page);

	//�������������
    $string_cat = $_GET['cat'];
    $string_items = $string->SqlGetCatObjects($string_cat, 'string_items');
	$cat_info = $string->SqlGetObj($string_cat, 'string_cats');

    foreach ($string_items as $item_id => $item_params)
    {
		unlink($site->PATH_IMAGES . '/string/' . $item_id . '.jpg');
        $string->SqlDel($item_id, 'string_items');
    }
	
	$string->SqlDel($string_cat, 'string_cats');

	$site->SiteGoTo($parent_page . '?sect=' . $cat_info['sect']);
?>
