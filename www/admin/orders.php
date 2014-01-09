<?php
	$orders = file_get_contents('../data/orders.txt');
	$orders = explode('=====', trim($orders));
	$orders = array_reverse($orders);
	$orders = array_slice($orders, 0, 100);
	foreach($orders as $order) {
		echo nl2br($order) . '<hr>';		
	}