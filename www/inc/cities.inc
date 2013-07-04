<?
	if ( !isset($smi_part) ) $smi_part = 0;
	$cities = array (
	'2' => 'Барнаул',
	'5' => 'Кемерово',
	'3' => 'Красноярск',
	'6' => 'Новокузнецк',
	'1' => 'Новосибирск',
	'8' => 'Омск',
	'9' => 'Томск'
	);
?>
<div class="cities">
	<h1><? if ( $smi_part ) echo $cities[$smi_part];?></h1>
	Реклама в городах:
	<ul>
		<?
			foreach ($cities as $city_id => $city_params)
			{
				echo '<li><a href="' . $site->PAGES['']['url'] . '?part=' . $city_id . '">' . $city_params . '</a></li>';
			}
		?>
	</ul>
</div>