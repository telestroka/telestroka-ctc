<? 
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y")); 	
	$dateMonthesOf = array(
						  		'',
								'€нвар€',
								'феврал€',
								'марта',
								'апрел€',
								'ма€',
								'июн€',
								'июл€',
								'августа',
								'сент€бр€',
								'окт€бр€',
								'но€бр€',
								'декабр€'
								);
?>
<div class="header">
	<table cellpadding="0" cellspacing="0">
		<tr>
			<td width="400"><img src="/images/design/header-logo.png" alt="" class="header-logo"></td>
			<td class="header-content">
				<h1>Ѕегуща€ строка на —“— Ч реклама по-быстрому</h1>
				<h2>”же завтра, <?=date("j ", $tomorrow) . ' ' . $dateMonthesOf[date("n", $tomorrow)];?>, ваше объ€вление может быть в эфире!</h2>
				<p>
					Ќужна помощь?&nbsp;Ч <a href="<?=$site->PAGES['feedback']['url'];?>#form" style="font-size: 16px;">обратитесь к&nbsp;јнастасии&nbsp;≈вгеньевне</a>,  
					главному специалисту, или&nbsp;позвоните
					<strong>(383) 249-52-39</strong>
				</p>
				<? include_once($site->PATH_INC . '/menu.inc'); ?>
			</td>
		</tr>
	</table>
</div>