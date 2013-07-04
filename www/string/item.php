<?php
/***********************************************
-=Ms Site=-

Модуль: String
Автор: Миропольский Михаил <ms@ensk.ru>
Описание: Информация о СМИ
***********************************************/

	//подключение модулей
	require_once('../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'string_item';
	$parent_page = $site->GetParentPage();

	require_once('../cgi-bin/string.class');
    $string = new String;

	require_once('../cgi-bin/utils/date.class');
    $date = new Date;

	require_once('../cgi-bin/vars/alert.class');
    $alert = new Alert;

	require_once('../cgi-bin/utils/validate.class');
    $validate = new Validate;

	require_once("../cgi-bin/utils/mail.class");
    $mail = new Mail;
	
	//инициализация
	$string_adv = 0;
	$order_type = 1;
	
    if ($_SERVER["REQUEST_METHOD"]=="GET")
	{
    	//проверка на честность
    	if (
    		!isset($_GET['id']) ||
    		!$string->SqlIsExist($_GET['id'], 'string_items')
    	   ) $site->SiteGoTo($parent_page);

        //инициализация
        $string_id = $_GET['id'];
		$item_info = $string->SqlGetObj($string_id, 'string_items');
		$smi_part = $item_info['part'];
		$smi_part_info = $string->SqlGetObj($smi_part, 'smi_parts');
		$order_type = (isset($_GET['order_type']) && $_GET['order_type'] == 0) ? 0 : 1;
    }
    if ($_SERVER["REQUEST_METHOD"]=="POST")
	{
    	//проверка на честность
    	if (
    		!isset($_POST['id']) ||
    		!$string->SqlIsExist($_POST['id'], 'string_items')
    	   ) $site->SiteGoTo($parent_page);

        //инициализация
        $string_id = $_POST['id'];
    }
	
	//скидки
	$discounts = @file('discounts/' . $string_id .'.dat');
	if (!is_array($discounts)) $discounts = array(0,0,0,0,0,0,0,0,0,0);
	$discounts_js = implode(',', $discounts);

    $item_info = $string->SqlGetObj($string_id, 'string_items');
    $string_name = $item_info['name'];
    $string_title = $item_info['title'];
  	$string_info = $item_info['info'];
	$smi_part = $item_info['part'];
	$smi_part_info = $string->SqlGetObj($smi_part, 'smi_parts');	
	
    $string_price_list = explode("\n", $item_info['price_list']);
	if ( isset($string_price_list[1]) && trim($string_price_list[1]) != '' )  $string_adv = 1;
	
    $string_price_array = array();
    foreach ($string_price_list as $string_price_id => $string_price_params)
    {
		$string_price_array[$string_price_id]['morning'] = 0;
		$string_price_array[$string_price_id]['day'] = 0;
		$string_price_array[$string_price_id]['evening'] = 0;
		$string_price_array[$string_price_id]['all'] = 0;
		
        if ( strstr($string_price_params, ';') ) {
			list(
				$string_price_array[$string_price_id]['morning'],
				$string_price_array[$string_price_id]['day'],
				$string_price_array[$string_price_id]['evening'],
				$string_price_array[$string_price_id]['all']
			) = explode(';', $string_price_params);
		}
		elseif (trim($string_price_params) != '') $string_price_array[$string_price_id]['day'] = $string_price_params;
        $string_price_array[$string_price_id]['morning'] = trim($string_price_array[$string_price_id]['morning']);
        $string_price_array[$string_price_id]['day'] = trim($string_price_array[$string_price_id]['day']);
		$string_price_array[$string_price_id]['evening'] = trim($string_price_array[$string_price_id]['evening']);
		$string_price_array[$string_price_id]['all'] = trim($string_price_array[$string_price_id]['all']);
    }
    //обнуление
	$alert_name = $alert_phone = $alert_text = $alert_phones = $alert_num = $alert_type = $alert_time = $alert_kupon = '';
	$result = $order_name = $order_phone = $order_text = $order_time = $order_num = $order_phones = '';
    $order_string = $order_summa = $order_clear_summa = $order_kupon = '';
	
	//инициализация
	$order_num = 1;
	$order_time = 1;
	

    if ($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if (
			!isset($_POST["name"]) ||
			!isset($_POST["phone"]) ||
			!isset($_POST["num"]) ||
			!isset($_POST["type"]) ||
			!isset($_POST["time"]) ||
			!isset($_POST["phones"]) ||
			!isset($_POST["text"])
		   ) $site->SiteGoTo($parent_page);

        //инициализация
		$order_name = $_POST['name'];
		$order_phone = $_POST['phone'];
		$order_text = $_POST['text'];
		$order_type = $_POST['type'];
		$order_time = $_POST['time'];
		$order_phones = $_POST['phones'];
		$order_num = $_POST['num'];
		$order_kupon = $_POST['kupon'];
		$order_duplicate = (isset($_POST['duplicate'])) ? 'да' : 'нет';

		//name
		if ( !$validate->IsRightLength($order_name, 0, 255) ) { $alert_name = $alert->ALERT['0-255']; $alert->NOVALID = TRUE; }

		//phone
		if ( !$validate->IsRightLength($order_phone, 0, 255) ) { $alert_phone = $alert->ALERT['0-255']; $alert->NOVALID = TRUE; }

		//text
		if ( !$validate->IsRightLength($order_text, 0, 2000) ) { $alert_text = $alert->ALERT['0-2000']; $alert->NOVALID = TRUE; }
		if ( $validate->IsDamn($order_text) ) { $alert_text = $alert->ALERT['damn']; $alert->NOVALID = 'ALERT'; }

		//phones
		if ( !$validate->IsRightLength($order_phones, 0, 2000) ) { $alert_phones = $alert->ALERT['0-2000']; $alert->NOVALID = TRUE; }
		if ( $validate->IsDamn($order_phones) ) { $alert_phones = $alert->ALERT['damn']; $alert->NOVALID = 'ALERT'; }

        //validation
		if ($alert->NOVALID == FALSE)
		{		
			$order_text = trim($order_text);
			if ($order_text == '') {
				$order_text_words = 0;
			} else {
				$order_text_words = str_replace("/", ' ', $order_text);
				$order_text_words = str_replace("\\", ' ', $order_text_words);
				$order_text_words = str_replace('-', ' ', $order_text_words);
				$order_text_words = explode(" ", $order_text_words);
				$order_text_words = count($order_text_words);
			}
			
			$order_phones = trim($order_phones);
			$order_phones_words = explode("\n", $order_phones);
			$order_phones_words = count($order_phones_words);
			if ($order_phones == '') $order_phones_words = 0;
			
			//подсчет суммы
			if ($smi_part == 14) {
				list($max_price, $max_price_words, $word_price) = preg_split("/[\<\+]/", $string_price_array[$order_type]['day']);
	
				$max_price_words_count = ($order_text_words > $max_price_words) ? $max_price_words : $order_text_words;
				$extra_words_count = ($order_text_words > $max_price_words) ? ($order_text_words - $max_price_words) : 0;
				$order_price = ($max_price_words_count + $order_phones_words * 5) * $max_price + $extra_words_count * $word_price;
				$order_clear_summa = $order_price * $order_num;
				$order_summa = $order_clear_summa - $order_clear_summa * $discounts[$order_num-1] / 100;
			} else {
				if ($order_time == 0) $order_price = $string_price_array[$order_type]['morning'];
				if ($order_time == 1) $order_price = $string_price_array[$order_type]['day'];
				if ($order_time == 2) $order_price = $string_price_array[$order_type]['evening'];
				if ($order_time == 3) $order_price = $string_price_array[$order_type]['all'];
				
				$total_words = $order_text_words + $order_phones_words * 5;
				$order_clear_summa = $order_num * $order_price * $total_words;
				$order_summa = $order_clear_summa - $order_clear_summa * $discounts[$order_num-1] / 100;
			}
			
			if ($order_time == 0) $message_time = 'утро';
			if ($order_time == 1) $message_time = 'день';
			if ($order_time == 2) $message_time = 'вечер';
			if ($order_time == 3) $message_time = 'сквозная';
		
            //отправка заявки			
        	$message = '
Город: ' . $smi_part_info['title'] . '
Канал: ' . $string_title . '
Имя: ' . $order_name . '
Контакты: ' . $order_phone . '
Количество: ' . $order_num . '
Текст: ' . $order_text . '
Телефоны: ' . $order_phones . '
Время трансляции: ' . $message_time . '
Цена: ' . round($order_summa, 2) . '
' . round($order_clear_summa, 2) . '
Коммерческая: ' . (($order_type) ? 'да' : 'нет') . '
Дублировать в интернет-архиве: ' . $order_duplicate;

            $mail->MailMailer($site->EMAIL_OWNER, 'Zakaz strochnoy reklamy na CTC ', $message);

           $site->SiteGoTo($site->PAGES['string_ok']['url'] . '?part=' . $smi_part);
		}
	}

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>