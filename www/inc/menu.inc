<div class="menu">
	<ul>
		<li>
			<? if ($site->PAGE == 'string'): ?>
				Главная
			<? else: ?>
				<a href="/">Главная</a>
			<? endif; ?>
		</li>
		<li>
			<? if ($site->PAGE == 'feedback'): ?>
				Как оплатить и другие вопросы
			<? else: ?>
				<a href="<?=$site->PAGES['feedback']['url'];?>">Как оплатить и другие вопросы</a>
			<? endif; ?>
		</li>
		<li>
			<? if ($site->PAGE == 'notes' && isset($notes_last_cats)): ?>
				Архив объявлений бегущей строки
			<? else: ?>
				<a href="<?=$site->PAGES['notes']['url'];?>">Архив объявлений бегущей строки</a>
			<? endif; ?>
		</li>
	</ul>
</div>

     