<?php
/***********************************************
-=Ms Site=-

Модуль: Smi
Автор:    Миропольский Михаил <ms@ensk.ru>
Описание: Удаление рубрики из 4-уровневой структуры
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
  $site = new Site;
	$site->PAGE = 'admin_smi_delcat';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/smi.class');
  $smi = new Smi;

	//проверка на честность
	if (
			!isset($_GET['cat']) ||
			!$smi->SqlIsExist($_GET['cat'], 'smi_cats')
	   ) $site->SiteGoTo($parent_page);

	//инициализация
    $smi_cat = $_GET['cat'];
    $smi_items = $smi->SqlGetCatObjects($smi_cat, 'smi_items');
	$cat_info = $smi->SqlGetObj($smi_cat, 'smi_cats');

    foreach ($smi_items as $item_id => $item_params)
    {
		unlink($site->PATH_IMAGES . '/smi/' . $item_id . '.jpg');
        $smi->SqlDel($item_id, 'smi_items');
    }
	
	$smi->SqlDel($smi_cat, 'smi_cats');

	$site->SiteGoTo($parent_page . '?sect=' . $cat_info['sect']);
?>
