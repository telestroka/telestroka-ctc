<h1 class="title darkblue">Архив объявлений <span class="runner">бегущей строки</span>, размещенных на телеканалах</h1><br/>
<?php
	if ( isset($cat_info) ):
		
		echo '<h1 class="gray">' . $cat_info['title'] . '</h1>';

		
	if ($cat_info['tags'] != '')
		{
			echo '<br><i>В рубриках архива: ';
			$tags = explode("\n",$cat_info['tags']);
			foreach ($tags as $tag)
			{
				echo '<a href="' . $site->PAGES['notes_tags']['url'] . '?tag=' . urlencode( trim($tag) )  . '">' . trim($tag) . '</a> <span style="padding-left: 5px;"></span>';
			}
			echo '</i>';
		}
		
	
	
		echo '<div style="width: 0; height: 20px;"><span></span></div>';

		if ($cat_info['image'] != '')
			echo '<img src="images/notes/' . $cat_info['image'] . '" border="0" alt="' . $cat_info['title'] . '"/><br/><br/>';
			
		if ($cat_info['text'] != '') echo $cat_info['text'] . '<br/><br/>';
		
		
		
				
		echo '</div>';
	else:
?>
<div style="float: right; width: 222px;">
	<? include_once($site->PATH_INC . '/notes_sidebar.inc'); ?>
</div>
<div style="margin-right: 250px;">
	<h1 class="gray" style="margin-bottom: 20px;">Последние 50 объявлений:</h1>
	<ul>
		<?php
			foreach ($notes_last_cats as $notes_cat) {
				echo '<li><a href="' . $site->PAGES['notes']['url'] . '?cat=' . $notes_cat['id'] . '">' . $notes_cat['title'] . '</a></li>';
			}
		?>
	</ul>
</div>
<div class="clear"></div>
<?php
	endif;
?>