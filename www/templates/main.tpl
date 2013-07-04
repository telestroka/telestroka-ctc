<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="ru">

<? include_once($site->PATH_INC . '/head.inc'); ?>

<body id="body" class="inside">
	<? include_once($site->PATH_INC . '/header.inc'); ?>
	<div class="content">
		<? if ( strstr($site->PAGE, 'admin') ) include_once($site->PATH_INC . '/path.inc');	?>
		<? include_once($site->GetPageFileName() . '.inc'); ?>		
	</div>
	<? include_once($site->PATH_INC . '/footer.inc'); ?>
</body>

</html>