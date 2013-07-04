<?php
/***********************************************
-=Ms Site=-

Модуль: Smi
Автор:    Миропольский Михаил <ms@ensk.ru>
Описание: Удаление сектора 4-уровневой структуры
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
  $site = new Site;
	$site->PAGE = 'admin_smi_delpart';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/smi.class');
  $smi = new Smi;

	//проверка на честность
	if (
			!isset($_GET['part']) ||
			!$smi->SqlIsExist($_GET['part'], 'smi_parts')
	   ) $site->SiteGoTo($parent_page);

	//инициализация
    $smi_part = $_GET['part'];
    $smi_sects = $smi->SqlGetPartObjects($smi_part, 'smi_sects');
    $smi_cats = $smi->SqlGetPartObjects($smi_part, 'smi_cats');
    $smi_items = $smi->SqlGetPartObjects($smi_part, 'smi_items');

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
    foreach ($smi_sects as $sect_id => $sect_params)
    {
        $smi->SqlDel($sect_id, 'smi_sects');
    }
	  $smi->SqlDel($smi_part, 'smi_parts');

	$site->SiteGoTo($parent_page);
?>
