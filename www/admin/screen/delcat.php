<?php
/***********************************************
-=Ms Site=-

������: Screen
�����:    ������������ ������ <ms@ensk.ru>
��������: �������� ������� �� 4-��������� ���������
***********************************************/

	//����������� �������
	require_once('../../cgi-bin/site.class');
  $site = new Site;
	$site->PAGE = 'admin_screen_delcat';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/screen.class');
  $screen = new Screen;

	//�������� �� ���������
	if (
			!isset($_GET['cat']) ||
			!$screen->SqlIsExist($_GET['cat'], 'screen_cats')
	   ) $site->SiteGoTo($parent_page);

	//�������������
    $screen_cat = $_GET['cat'];
    $screen_items = $screen->SqlGetCatObjects($screen_cat, 'screen_items');
	$cat_info = $screen->SqlGetObj($screen_cat, 'screen_cats');

    foreach ($screen_items as $item_id => $item_params)
    {
		unlink($site->PATH_IMAGES . '/screen/' . $item_id . '.jpg');
        $screen->SqlDel($item_id, 'screen_items');
    }
	
	$screen->SqlDel($screen_cat, 'screen_cats');

	$site->SiteGoTo($parent_page . '?sect=' . $cat_info['sect']);
?>
