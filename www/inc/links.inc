<div class="links">
	<?		
		if ( $site->PAGE != '' )
		{
			echo '<h2><a href="/">Все города</a></h2><br/>';
			if ( $site->PAGE == 'string_item' ) echo '<h2 style="color: #0093DD; white-space: nowrap;"><a href="' . $site->PAGES['string_part']['url'] . '?part=' . $smi_part . '">ТВ-каналы</a></h2>';			
		}
	?>
</div>