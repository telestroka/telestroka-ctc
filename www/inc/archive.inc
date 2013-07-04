<div id="archive">
	<? if ($site->PAGE == 'notes' && isset($notes_last_cats)): ?>
		<b>јрхив</b>
	<? else: ?>
		<a href="<?=$site->PAGES['notes']['url'];?>">јрхив</a>
	<? endif; ?>
	<div style="width: 0; height: 5px;"><span></span></div>
	объ€влений<br/>
	бегущей<br/>
	строки
</div>