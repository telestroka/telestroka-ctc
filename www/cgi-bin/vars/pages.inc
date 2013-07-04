<?
/*
	Информация о страницах
	Пример:
	$this->PAGES['page']['name']='Главная'; //необходимое поле
	$this->PAGES['page']['url']=$this->PATH.'/page/index.php'; //необходимое поле
	$this->PAGES['page']['menu']=TRUE; //только если страница должна отображаться в меню
	$this->PAGES['page']['parent']='mainpage'; //только для страниц второго уровня
	$this->PAGES['page']['unindexed']=TRUE; //только если не надо индексировать в поиске
*/

//main
		$this->PAGES['']['name'] = 'Главная';
		$this->PAGES['']['url'] = $this->PATH . '/index.php';
		$this->PAGES['']['menu'] = TRUE;
//feedback
		$this->PAGES['feedback']['name'] = 'Вы спрашивали';
		$this->PAGES['feedback']['url'] = $this->PATH . '/feedback/index.php';
		$this->PAGES['feedback']['menu'] = TRUE;
//feedback_ok
		$this->PAGES['feedback_ok']['name'] = 'Вы спрашивали';
		$this->PAGES['feedback_ok']['url'] = $this->PATH . '/feedback/ok.php';
//leaders
		$this->PAGES['leaders']['name'] = 'Уровень востребованности';
		$this->PAGES['leaders']['url'] = $this->PATH . '/leaders/index.php';
		$this->PAGES['leaders']['menu'] = TRUE;
//smi
		$this->PAGES['smi']['name'] = 'Газеты';
		$this->PAGES['smi']['url'] = $this->PATH . '/smi/index.php';
		$this->PAGES['smi']['menu'] = TRUE;
//smi_cat
		$this->PAGES['smi_cat']['name'] = 'Газеты';
		$this->PAGES['smi_cat']['url'] = $this->PATH . '/smi/cat.php';
		$this->PAGES['smi_cat']['parent'] = 'smi';
//smi_item
		$this->PAGES['smi_item']['name'] = 'Информация о газете';
		$this->PAGES['smi_item']['url'] = $this->PATH . '/smi/item.php';
		$this->PAGES['smi_item']['parent'] = '';
//string
		$this->PAGES['string']['name'] = 'Бегущая строка на ТВ';
		$this->PAGES['string']['url'] = $this->PATH . '/string/index.php';
		$this->PAGES['string']['menu'] = TRUE;
//string_part
		$this->PAGES['string_part']['name'] = 'Бегущая строка на ТВ';
		$this->PAGES['string_part']['url'] = $this->PATH . '/string/part.php';
		$this->PAGES['string_part']['parent'] = 'string';
//string_cat
		$this->PAGES['string_cat']['name'] = 'Бегущая строка на ТВ';
		$this->PAGES['string_cat']['url'] = $this->PATH . '/string/cat.php';
		$this->PAGES['string_cat']['parent'] = 'string';
//string_item
		$this->PAGES['string_item']['name'] = 'Бегущая строка на ТВ';
		$this->PAGES['string_item']['url'] = $this->PATH . '/string/item.php';
		$this->PAGES['string_item']['parent'] = '';		
//string_ok
		$this->PAGES['string_ok']['name'] = 'Бегущая строка на ТВ';
		$this->PAGES['string_ok']['url'] = $this->PATH . '/string/ok.php';
		$this->PAGES['string_ok']['parent'] = 'string_ok';		
//string_bill
		$this->PAGES['string_bill']['name'] = 'Счет';
		$this->PAGES['string_bill']['url'] = $this->PATH . '/string/bill.php';
		$this->PAGES['string_bill']['parent'] = 'string_bill';
		$this->PAGES['string_bill']['unindexed']=TRUE;
//string_form
		$this->PAGES['string_form']['name'] = 'Счет';
		$this->PAGES['string_form']['url'] = $this->PATH . '/string/form.php';
		$this->PAGES['string_form']['parent'] = 'string_bill';
		$this->PAGES['string_form']['unindexed']=TRUE;
//screen
		$this->PAGES['screen']['name'] = 'Экранная заставка на ТВ';
		$this->PAGES['screen']['url'] = $this->PATH . '/screen/index.php';
		$this->PAGES['screen']['menu'] = TRUE;
//screen_cat
		$this->PAGES['screen_cat']['name'] = 'Экранная заставка на ТВ';
		$this->PAGES['screen_cat']['url'] = $this->PATH . '/screen/cat.php';
		$this->PAGES['screen_cat']['parent'] = 'screen';
//screen_item
		$this->PAGES['screen_item']['name'] = 'Экранная заставка на ТВ';
		$this->PAGES['screen_item']['url'] = $this->PATH . '/screen/item.php';
		$this->PAGES['screen_item']['parent'] = '';
//screen_bill
		$this->PAGES['screen_bill']['name'] = 'Счет';
		$this->PAGES['screen_bill']['url'] = $this->PATH . '/screen/bill.php';
		$this->PAGES['screen_bill']['parent'] = 'screen_item';
//screen_ok
		$this->PAGES['screen_ok']['name'] = 'Ваш заказ принят';
		$this->PAGES['screen_ok']['url'] = $this->PATH . '/screen/ok.php';
		$this->PAGES['screen_ok']['parent'] = 'screen_ok';
//smi_price
		$this->PAGES['smi_price']['name'] = 'Прайс-лист';
		$this->PAGES['smi_price']['url'] = $this->PATH . '/smi/price.php';
		$this->PAGES['smi_price']['parent'] = 'smi_item';
//smi_maket
		$this->PAGES['smi_maket']['name'] = 'Схематичное отображение макета';
		$this->PAGES['smi_maket']['url'] = $this->PATH . '/smi/maket.php';
		$this->PAGES['smi_maket']['parent'] = 'smi_item';
//smi_region
		$this->PAGES['smi_region']['name'] = 'Регионы распространения';
		$this->PAGES['smi_region']['url'] = $this->PATH . '/smi/region.php';
		$this->PAGES['smi_region']['parent'] = 'smi_item';
//smi_bill
		$this->PAGES['smi_bill']['name'] = 'Счет';
		$this->PAGES['smi_bill']['url'] = $this->PATH . '/smi/bill.php';
		$this->PAGES['smi_bill']['parent'] = 'smi_item';
//smi_ok
		$this->PAGES['smi_ok']['name'] = 'Ваш заказ принят';
		$this->PAGES['smi_ok']['url'] = $this->PATH . '/smi/ok.php';
		$this->PAGES['smi_ok']['parent'] = 'smi_ok';
//notes
		$this->PAGES['notes']['name'] = 'Наша интернет-газета';
		$this->PAGES['notes']['url'] = $this->PATH . '/notes/index.php';
		$this->PAGES['notes']['menu'] = TRUE;
//notes_tags
		$this->PAGES['notes_tags']['name'] = 'Наша интернет-газета';
		$this->PAGES['notes_tags']['url'] = $this->PATH . '/notes/tags.php';
		$this->PAGES['notes_tags']['menu'] = TRUE;
		$this->PAGES['notes_tags']['parent'] = 'notes';
//subscribe
		$this->PAGES['subscribe']['name'] = 'Подписка';
		$this->PAGES['subscribe']['url'] = $this->PATH . '/subscribe/index.php';
		$this->PAGES['subscribe']['menu'] = TRUE;
//office
		$this->PAGES['office']['name'] = 'Как доехать и пройти';
		$this->PAGES['office']['url'] = $this->PATH . '/office/index.php';
		$this->PAGES['office']['menu'] = TRUE;
//comments
		$this->PAGES['comments']['name'] = 'Рекламу заказали — об эффекте рассказали';
		$this->PAGES['comments']['url'] = $this->PATH . '/office/index.php';
		$this->PAGES['comments']['menu'] = TRUE;
//admin
		$this->PAGES['admin']['name'] = 'Администрирование';
		$this->PAGES['admin']['url'] = $this->PATH . '/admin/index.php';
		$this->PAGES['admin']['unindexed'] = TRUE;
//admin_feedback
		$this->PAGES['admin_feedback']['name'] = 'Администрирование обратной связи';
		$this->PAGES['admin_feedback']['url'] = $this->PATH . '/admin/feedback/index.php';
		$this->PAGES['admin_feedback']['unindexed'] = TRUE;
		$this->PAGES['admin_feedback']['parent'] = 'admin';
//admin_feedback_edit
		$this->PAGES['admin_feedback_edit']['name'] = 'Редактирование вопроса';
		$this->PAGES['admin_feedback_edit']['url'] = $this->PATH . '/admin/feedback/edit.php';
		$this->PAGES['admin_feedback_edit']['unindexed'] = TRUE;
		$this->PAGES['admin_feedback_edit']['parent'] = 'admin_feedback';
//admin_feedback_del
		$this->PAGES['admin_feedback_del']['name'] = 'Удаление вопроса';
		$this->PAGES['admin_feedback_del']['url'] = $this->PATH . '/admin/feedback/del.php';
		$this->PAGES['admin_feedback_del']['unindexed'] = TRUE;
		$this->PAGES['admin_feedback_del']['parent'] = 'admin_feedback';		
//admin_smi
		$this->PAGES['admin_smi']['name'] = 'Администрирование сми';
		$this->PAGES['admin_smi']['url'] = $this->PATH . '/admin/smi/index.php';
		$this->PAGES['admin_smi']['unindexed'] = TRUE;
		$this->PAGES['admin_smi']['parent'] = 'admin';

		$this->PAGES['admin_smi_part']['name'] = 'Администрирование разделов сми';
		$this->PAGES['admin_smi_part']['url'] = $this->PATH . '/admin/smi/part.php';
		$this->PAGES['admin_smi_part']['unindexed'] = TRUE;
		$this->PAGES['admin_smi_part']['parent'] = 'admin_smi';

		$this->PAGES['admin_smi_editpart']['name'] = 'Редактирование города';
		$this->PAGES['admin_smi_editpart']['url'] = $this->PATH . '/admin/smi/editpart.php';
		$this->PAGES['admin_smi_editpart']['unindexed'] = TRUE;
		$this->PAGES['admin_smi_editpart']['parent'] = 'admin_smi';

		$this->PAGES['admin_smi_delpart']['name'] = 'Удаление города';
		$this->PAGES['admin_smi_delpart']['url'] = $this->PATH . '/admin/smi/delpart.php';
		$this->PAGES['admin_smi_delpart']['unindexed'] = TRUE;
		$this->PAGES['admin_smi_delpart']['parent'] = 'admin_smi';

		$this->PAGES['admin_smi_sect']['name'] = 'Администрирование рубрик сми';
		$this->PAGES['admin_smi_sect']['url'] = $this->PATH . '/admin/smi/sect.php';
		$this->PAGES['admin_smi_sect']['unindexed'] = TRUE;
		$this->PAGES['admin_smi_sect']['parent'] = 'admin_smi';

		$this->PAGES['admin_smi_editsect']['name'] = 'Редактирование раздела';
		$this->PAGES['admin_smi_editsect']['url'] = $this->PATH . '/admin/smi/editsect.php';
		$this->PAGES['admin_smi_editsect']['unindexed'] = TRUE;
		$this->PAGES['admin_smi_editsect']['parent'] = 'admin_smi_part';

		$this->PAGES['admin_smi_delsect']['name'] = 'Удаление раздела';
		$this->PAGES['admin_smi_delsect']['url'] = $this->PATH . '/admin/smi/delsect.php';
		$this->PAGES['admin_smi_delsect']['unindexed'] = TRUE;
		$this->PAGES['admin_smi_delsect']['parent'] = 'admin_smi_part';

		$this->PAGES['admin_smi_cat']['name'] = 'Администрирование объектов сми';
		$this->PAGES['admin_smi_cat']['url'] = $this->PATH . '/admin/smi/cat.php';
		$this->PAGES['admin_smi_cat']['unindexed'] = TRUE;
		$this->PAGES['admin_smi_cat']['parent'] = 'admin_smi_sect';

		$this->PAGES['admin_smi_editcat']['name'] = 'Редактирование рубрики';
		$this->PAGES['admin_smi_editcat']['url'] = $this->PATH . '/admin/smi/editcat.php';
		$this->PAGES['admin_smi_editcat']['unindexed'] = TRUE;
		$this->PAGES['admin_smi_editcat']['parent'] = 'admin_smi_sect';

		$this->PAGES['admin_smi_delcat']['name'] = 'Удаление рубрики';
		$this->PAGES['admin_smi_delcat']['url'] = $this->PATH . '/admin/smi/delcat.php';
		$this->PAGES['admin_smi_delcat']['unindexed'] = TRUE;
		$this->PAGES['admin_smi_delcat']['parent'] = 'admin_smi_sect';

		$this->PAGES['admin_smi_edit']['name'] = 'Редактирование объекта';
		$this->PAGES['admin_smi_edit']['url'] = $this->PATH . '/admin/smi/edit.php';
		$this->PAGES['admin_smi_edit']['unindexed'] = TRUE;
		$this->PAGES['admin_smi_edit']['parent'] = 'admin_smi_cat';

		$this->PAGES['admin_smi_delimage']['name'] = 'Удаление картинки';
		$this->PAGES['admin_smi_delimage']['url'] = $this->PATH . '/admin/smi/delimage.php';
		$this->PAGES['admin_smi_delimage']['unindexed'] = TRUE;
		$this->PAGES['admin_smi_delimage']['parent'] = 'admin_smi_edit';

		$this->PAGES['admin_smi_del']['name'] = 'Удаление объекта';
		$this->PAGES['admin_smi_del']['url'] = $this->PATH . '/admin/smi/del.php';
		$this->PAGES['admin_smi_del']['unindexed'] = TRUE;
		$this->PAGES['admin_smi_del']['parent'] = 'admin_smi_cat';
//admin_string
		$this->PAGES['admin_string']['name'] = 'Администрирование бегущей строки';
		$this->PAGES['admin_string']['url'] = $this->PATH . '/admin/string/index.php';
		$this->PAGES['admin_string']['unindexed'] = TRUE;
		$this->PAGES['admin_string']['parent'] = 'admin';

		$this->PAGES['admin_string_part']['name'] = 'Администрирование разделов бегущей строки';
		$this->PAGES['admin_string_part']['url'] = $this->PATH . '/admin/string/part.php';
		$this->PAGES['admin_string_part']['unindexed'] = TRUE;
		$this->PAGES['admin_string_part']['parent'] = 'admin_string';

		$this->PAGES['admin_string_editpart']['name'] = 'Редактирование города';
		$this->PAGES['admin_string_editpart']['url'] = $this->PATH . '/admin/string/editpart.php';
		$this->PAGES['admin_string_editpart']['unindexed'] = TRUE;
		$this->PAGES['admin_string_editpart']['parent'] = 'admin_string';

		$this->PAGES['admin_string_delpart']['name'] = 'Удаление города';
		$this->PAGES['admin_string_delpart']['url'] = $this->PATH . '/admin/string/delpart.php';
		$this->PAGES['admin_string_delpart']['unindexed'] = TRUE;
		$this->PAGES['admin_string_delpart']['parent'] = 'admin_string';

		$this->PAGES['admin_string_sect']['name'] = 'Администрирование рубрик бегущей строки';
		$this->PAGES['admin_string_sect']['url'] = $this->PATH . '/admin/string/sect.php';
		$this->PAGES['admin_string_sect']['unindexed'] = TRUE;
		$this->PAGES['admin_string_sect']['parent'] = 'admin_string_part';

		$this->PAGES['admin_string_editsect']['name'] = 'Редактирование раздела';
		$this->PAGES['admin_string_editsect']['url'] = $this->PATH . '/admin/string/editsect.php';
		$this->PAGES['admin_string_editsect']['unindexed'] = TRUE;
		$this->PAGES['admin_string_editsect']['parent'] = 'admin_string_part';

		$this->PAGES['admin_string_delsect']['name'] = 'Удаление раздела';
		$this->PAGES['admin_string_delsect']['url'] = $this->PATH . '/admin/string/delsect.php';
		$this->PAGES['admin_string_delsect']['unindexed'] = TRUE;
		$this->PAGES['admin_string_delsect']['parent'] = 'admin_string_part';

		$this->PAGES['admin_string_cat']['name'] = 'Администрирование каналов';
		$this->PAGES['admin_string_cat']['url'] = $this->PATH . '/admin/string/cat.php';
		$this->PAGES['admin_string_cat']['unindexed'] = TRUE;
		$this->PAGES['admin_string_cat']['parent'] = 'admin_string_sect';

		$this->PAGES['admin_string_editcat']['name'] = 'Редактирование рубрики';
		$this->PAGES['admin_string_editcat']['url'] = $this->PATH . '/admin/string/editcat.php';
		$this->PAGES['admin_string_editcat']['unindexed'] = TRUE;
		$this->PAGES['admin_string_editcat']['parent'] = 'admin_string_sect';

		$this->PAGES['admin_string_delcat']['name'] = 'Удаление рубрики';
		$this->PAGES['admin_string_delcat']['url'] = $this->PATH . '/admin/string/delcat.php';
		$this->PAGES['admin_string_delcat']['unindexed'] = TRUE;
		$this->PAGES['admin_string_delcat']['parent'] = 'admin_string_sect';

		$this->PAGES['admin_string_edit']['name'] = 'Редактирование канала';
		$this->PAGES['admin_string_edit']['url'] = $this->PATH . '/admin/string/edit.php';
		$this->PAGES['admin_string_edit']['unindexed'] = TRUE;
		$this->PAGES['admin_string_edit']['parent'] = 'admin_string_cat';

		$this->PAGES['admin_string_delimage']['name'] = 'Удаление картинки';
		$this->PAGES['admin_string_delimage']['url'] = $this->PATH . '/admin/string/delimage.php';
		$this->PAGES['admin_string_delimage']['unindexed'] = TRUE;
		$this->PAGES['admin_string_delimage']['parent'] = 'admin_string_edit';

		$this->PAGES['admin_string_del']['name'] = 'Удаление канала';
		$this->PAGES['admin_string_del']['url'] = $this->PATH . '/admin/string/del.php';
		$this->PAGES['admin_string_del']['unindexed'] = TRUE;
		$this->PAGES['admin_string_del']['parent'] = 'admin_string_cat';
//admin_string_bill
		$this->PAGES['admin_string_bill']['name'] = 'Счет';
		$this->PAGES['admin_string_bill']['url'] = $this->PATH . '/admin/string/bill.php';
		$this->PAGES['admin_string_bill']['parent'] = 'admin_string';
//admin_screen
		$this->PAGES['admin_screen']['name'] = 'Администрирование экранной заставки';
		$this->PAGES['admin_screen']['url'] = $this->PATH . '/admin/screen/index.php';
		$this->PAGES['admin_screen']['unindexed'] = TRUE;
		$this->PAGES['admin_screen']['parent'] = 'admin';

		$this->PAGES['admin_screen_part']['name'] = 'Администрирование разделов экранной заставки';
		$this->PAGES['admin_screen_part']['url'] = $this->PATH . '/admin/screen/part.php';
		$this->PAGES['admin_screen_part']['unindexed'] = TRUE;
		$this->PAGES['admin_screen_part']['parent'] = 'admin_screen';

		$this->PAGES['admin_screen_editpart']['name'] = 'Редактирование города';
		$this->PAGES['admin_screen_editpart']['url'] = $this->PATH . '/admin/screen/editpart.php';
		$this->PAGES['admin_screen_editpart']['unindexed'] = TRUE;
		$this->PAGES['admin_screen_editpart']['parent'] = 'admin_screen';

		$this->PAGES['admin_screen_delpart']['name'] = 'Удаление города';
		$this->PAGES['admin_screen_delpart']['url'] = $this->PATH . '/admin/screen/delpart.php';
		$this->PAGES['admin_screen_delpart']['unindexed'] = TRUE;
		$this->PAGES['admin_screen_delpart']['parent'] = 'admin_screen';

		$this->PAGES['admin_screen_sect']['name'] = 'Администрирование рубрик экранной заставки';
		$this->PAGES['admin_screen_sect']['url'] = $this->PATH . '/admin/screen/sect.php';
		$this->PAGES['admin_screen_sect']['unindexed'] = TRUE;
		$this->PAGES['admin_screen_sect']['parent'] = 'admin_screen';

		$this->PAGES['admin_screen_editsect']['name'] = 'Редактирование раздела';
		$this->PAGES['admin_screen_editsect']['url'] = $this->PATH . '/admin/screen/editsect.php';
		$this->PAGES['admin_screen_editsect']['unindexed'] = TRUE;
		$this->PAGES['admin_screen_editsect']['parent'] = 'admin_screen_part';

		$this->PAGES['admin_screen_delsect']['name'] = 'Удаление раздела';
		$this->PAGES['admin_screen_delsect']['url'] = $this->PATH . '/admin/screen/delsect.php';
		$this->PAGES['admin_screen_delsect']['unindexed'] = TRUE;
		$this->PAGES['admin_screen_delsect']['parent'] = 'admin_screen_part';

		$this->PAGES['admin_screen_cat']['name'] = 'Администрирование каналов';
		$this->PAGES['admin_screen_cat']['url'] = $this->PATH . '/admin/screen/cat.php';
		$this->PAGES['admin_screen_cat']['unindexed'] = TRUE;
		$this->PAGES['admin_screen_cat']['parent'] = 'admin_screen_sect';

		$this->PAGES['admin_screen_editcat']['name'] = 'Редактирование рубрики';
		$this->PAGES['admin_screen_editcat']['url'] = $this->PATH . '/admin/screen/editcat.php';
		$this->PAGES['admin_screen_editcat']['unindexed'] = TRUE;
		$this->PAGES['admin_screen_editcat']['parent'] = 'admin_screen_sect';

		$this->PAGES['admin_screen_delcat']['name'] = 'Удаление рубрики';
		$this->PAGES['admin_screen_delcat']['url'] = $this->PATH . '/admin/screen/delcat.php';
		$this->PAGES['admin_screen_delcat']['unindexed'] = TRUE;
		$this->PAGES['admin_screen_delcat']['parent'] = 'admin_screen_sect';

		$this->PAGES['admin_screen_edit']['name'] = 'Редактирование канала';
		$this->PAGES['admin_screen_edit']['url'] = $this->PATH . '/admin/screen/edit.php';
		$this->PAGES['admin_screen_edit']['unindexed'] = TRUE;
		$this->PAGES['admin_screen_edit']['parent'] = 'admin_screen_cat';

		$this->PAGES['admin_screen_delimage']['name'] = 'Удаление картинки';
		$this->PAGES['admin_screen_delimage']['url'] = $this->PATH . '/admin/screen/delimage.php';
		$this->PAGES['admin_screen_delimage']['unindexed'] = TRUE;
		$this->PAGES['admin_screen_delimage']['parent'] = 'admin_screen_edit';

		$this->PAGES['admin_screen_del']['name'] = 'Удаление канала';
		$this->PAGES['admin_screen_del']['url'] = $this->PATH . '/admin/screen/del.php';
		$this->PAGES['admin_screen_del']['unindexed'] = TRUE;
		$this->PAGES['admin_screen_del']['parent'] = 'admin_screen_cat';
//admin_notes
		$this->PAGES['admin_notes']['name'] = 'Администрирование комментируемых статей';
		$this->PAGES['admin_notes']['url'] = $this->PATH . '/admin/notes/index.php';
		$this->PAGES['admin_notes']['unindexed'] = TRUE;
		$this->PAGES['admin_notes']['parent'] = 'admin';

		$this->PAGES['admin_notes_cat']['name'] = 'Администрирование статей';
		$this->PAGES['admin_notes_cat']['url'] = $this->PATH . '/admin/notes/cat.php';
		$this->PAGES['admin_notes_cat']['unindexed'] = TRUE;
		$this->PAGES['admin_notes_cat']['parent'] = 'admin_notes';

		$this->PAGES['admin_notes_editcat']['name'] = 'Редактирование статьи';
		$this->PAGES['admin_notes_editcat']['url'] = $this->PATH . '/admin/notes/editcat.php';
		$this->PAGES['admin_notes_editcat']['unindexed'] = TRUE;
		$this->PAGES['admin_notes_editcat']['parent'] = 'admin_notes';

		$this->PAGES['admin_notes_delcat']['name'] = 'Удаление статьи';
		$this->PAGES['admin_notes_delcat']['url'] = $this->PATH . '/admin/notes/delcat.php';
		$this->PAGES['admin_notes_delcat']['unindexed'] = TRUE;
		$this->PAGES['admin_notes_delcat']['parent'] = 'admin_notes';

		$this->PAGES['admin_notes_edit']['name'] = 'Редактирование комментария';
		$this->PAGES['admin_notes_edit']['url'] = $this->PATH . '/admin/notes/edit.php';
		$this->PAGES['admin_notes_edit']['unindexed'] = TRUE;
		$this->PAGES['admin_notes_edit']['parent'] = 'admin_notes_cat';

		$this->PAGES['admin_notes_delimage']['name'] = 'Удаление изображения';
		$this->PAGES['admin_notes_delimage']['url'] = $this->PATH . '/admin/notes/delimage.php';
		$this->PAGES['admin_notes_delimage']['unindexed'] = TRUE;
		$this->PAGES['admin_notes_delimage']['parent'] = 'admin_notes_editcat';

		$this->PAGES['admin_notes_del']['name'] = 'Удаление комментария';
		$this->PAGES['admin_notes_del']['url'] = $this->PATH . '/admin/notes/del.php';
		$this->PAGES['admin_notes_del']['unindexed'] = TRUE;
		$this->PAGES['admin_notes_del']['parent'] = 'admin_notes_cat';
//admin_subscribe
		$this->PAGES['admin_subscribe']['name'] = 'Администрирование подписки';
		$this->PAGES['admin_subscribe']['url'] = $this->PATH . '/admin/subscribe/index.php';
		$this->PAGES['admin_subscribe']['unindexed'] = TRUE;
		$this->PAGES['admin_subscribe']['parent'] = 'admin';		
?>
