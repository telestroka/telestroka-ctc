<?php
/***********************************************
-=Ms Site=-

Модуль: String
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Счет администратора
***********************************************/

	//подключение модулей
	require_once('../../cgi-bin/site.class');
	$site = new Site;
	$site->PAGE = 'admin_string_bill';
	$parent_page = $site->PAGES[$site->PAGE]['url'];
	
	require_once('../../cgi-bin/bills.class');
	$bills = new Bills;
	
	//обнуление
	$pay = 'Размещение объявления на ТВ по счету № от ';
	$rub = $kop = 0;

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//инициализация	
		$sid = time();
		$pay = $_POST['pay'];
		$rub = $_POST['rub'];
		$kop = $_POST['kop'];
		
		//обработка
		$add_array = array(
							'sid' => $sid,
							'pay' => $pay,
							'rub' => $rub,
							'kop' => $kop
							);
						
		$result = $bills->SqlAdd($add_array, 'string_bills');
		if ($result) $site->SiteGoTo($site->PAGES['string_bill']['url'] . '?sid=' . $sid);
	}

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>