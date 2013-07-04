<h1 class="title darkblue">Объявления, размещенные на телеканалах</h1><br/>
<div style="float: right; width: 222px;">
	<? include_once($site->PATH_INC . '/notes_sidebar.inc'); ?>
</div>
<div style="margin-right: 250px;">
	<h1 class="gray" style="margin-bottom: 20px;"><?php echo ($notes_tag == 'Вакансии') ? 'Вакансии' : $notes_tag;?>:</h1>
	<ul>
		<?php
			foreach ($notes_tag_cats as $notes_tag_cat)
			{
				if ($notes_tag == 'Вакансии') {
					if ($notes_cats[$notes_tag_cat['id']]['date'] < date('Y-m-d', mktime(0, 0, 0, date("m")-1, date("d"), date("Y")))) continue;
				}
				echo '<li><a href="' . $site->PAGES['notes']['url'] . '?cat=' . $notes_tag_cat['id'] . '">' . $notes_cats[$notes_tag_cat['id']]['title'] . '</a></li>';
			}
		?>
	</ul>
</div>
<div class="clear"></div>