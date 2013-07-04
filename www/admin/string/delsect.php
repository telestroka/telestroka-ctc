<?php
/***********************************************
-=Ms Site=-

Модуль: String
Автор:    Миропольский Михаил <ms@ensk.ru>
Описание: Удаление раздела 4-уровневой структуры
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
  $site = new Site;
	$site->PAGE = 'admin_string_delsect';
	$parent_page = $site->GetParentPage();

	require_once('../../cgi-bin/string.class');
  $string = new String;

	//проверка на честность
	if (
			!isset($_GET['sect']) ||
			!$string->SqlIsExist($_GET['sect'], 'string_sects')
	   ) $site->SiteGoTo($parent_page);

	//инициализация
    $string_sect = $_GET['sect'];
    $string_cats = $string->SqlGetSectObjects($string_sect, 'string_cats');
    $string_items = $string->SqlGetSectObjects($string_sect, 'string_items');
		$sect_info = $string->SqlGetObj($string_sect, 'string_sects');

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
	  $string->SqlDel($string_sect, 'string_sects');

	$site->SiteGoTo($parent_page . '?part=' . $sect_info['part']);
?>
