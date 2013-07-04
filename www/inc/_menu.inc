<div class="menu">
	<ul>
		<li>
			<? if ($site->PAGE == 'feedback'): ?>
				Отвечаем на вопросы
			<? else: ?>
				<a href="<?=$site->PAGES['feedback']['url'];?>">Отвечаем на вопросы</a>
			<? endif; ?>
		</li>

		
		<li>
			<?php
				$menu_item_text = 'Омске и других';
				echo ($site->PAGE == 'notes' && $notes_cat == '1839') ? $menu_item_text : '<a href="/notes/index.php?cat=1839">' . $menu_item_text . '</a>';
			?>
		</li>
		
		
		<li>
			<?php
				$menu_item_text = 'Барнауле';
				echo ($site->PAGE == 'string_part' && $smi_part == '14') ? $menu_item_text : '<a href="/string/part.php?part=14">' . $menu_item_text . '</a>';
			?>
		</li>
		<li>
			<?php				
				$menu_item_text = 'Заказать в Новосибирске';
				echo ($site->PAGE == 'string' && $smi_part != '14') ? $menu_item_text : '<a href="/">' . $menu_item_text . '</a>';
			?>
		</li>
	</ul>
</div>