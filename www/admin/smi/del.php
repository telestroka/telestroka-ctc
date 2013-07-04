<?php
/***********************************************
-=Ms Site=-

Модуль: Smi
Автор:    Миропольский Михаил <ms@ensk.ru>
Описание: Удаление объекта 3-уровневой структуры
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin_smi_del';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/smi.class');
    $smi = new Smi;

	//проверка на честность
	if (
		!isset($_GET['id']) ||
		!$smi->SqlIsExist($_GET['id'], 'smi_items')
	   ) $site->SiteGoTo($parent_page);

    //инициализация
    $smi_id = $_GET['id'];
    $item_info = $smi->SqlGetObj($smi_id, 'smi_items');
    $smi_info = $smi->SqlGetTable('smi_items');

	unlink($site->PATH_IMAGES . '/smi/' . $smi_id . '.jpg');

	$smi->SqlDel($smi_id, 'smi_items');

	$site->SiteGoTo($parent_page . '?cat=' . $item_info['cat']);
?>