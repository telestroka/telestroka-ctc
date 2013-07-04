<head>
	<? include_once($site->PATH_INC . '/meta.inc'); ?>
	<title><? echo $site->NAME_SITE . " :: " . $site->PAGES[$site->PAGE]['name'] ?></title>
	<base href="<?=$site->PATH;?>/" />
	<link rel="stylesheet" href="css/global.css" type="text/css" />
	<link rel="stylesheet" href="css/design.css" type="text/css" />
	<?
		if ( strstr($site->PAGE, 'admin') ) echo '<link rel="stylesheet" href="css/admin.css" type="text/css" />';
	?>
	<script language="JavaScript" type="text/javascript" src="js/functions.js"></script>	
	<script language="JavaScript" type="text/javascript" src="js/jquery.js"></script>
	<!--script type="text/javascript" src="http://smart-ip.net/_res/js/webservice/api.js?key=6951ee520%3CdGVsZXN0cm9rYS5ydQ%3D%3D8261867cd9ed90dc82ff36d17"></script-->
	<!--script>
		var MyIP = new SmartIP();
		MyIP.load();
		MyIP.onload = function() {
		   if (MyIP.getRegion() == 'Barnaul') document.location.href = 'http://telestroka-barnaul.ru';
		}
	</script-->
</head>
