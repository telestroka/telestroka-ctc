<?php
/***********************************************
-=Ms Site=-

Модуль: Smi
Автор:    Миропольский Михаил <ms@ensk.ru>
Описание: Удаление картинки из объекта 4-уровневой структуры
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'admin_smi_delimage';
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
	
  	unlink($site->PATH_IMAGES . 'smi/' . $smi_id . '.jpg');

	$site->SiteGoTo($parent_page . '?id=' . $smi_id);
?>