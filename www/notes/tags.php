<?php
/***********************************************
-=Ms Site=-

Ìîäóëü: Notes
Àâòîğ: Ìèğîïîëüñêèé Ìèõàèë <ms@ensk.ru>
Îïèñàíèå:  Òıãè çàìåòîê
***********************************************/
	//ïîäêëş÷åíèå ìîäóëåé
	require_once('../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'notes_tags';
	$parent_page = $site->GetParentPage();

	require_once('../cgi-bin/notes.class');
    $notes = new Notes;
	$notes_cats = $notes->NotesGetCats('notes_cats');
	
	$channels = array('Íîâîñèáèğñê','Âñå îáúÿâëåíèÿ','Ñğî÷íî!','Âàêàíñèè','Êîììåğ÷åñêîå','Âûãîäíî','Ïğîèñøåñòâèÿ è ñîîáùåíèÿ','Ñêèäêà 50%','49 êàíàë','Äîìàøíèé','ÌÈĞ — ÑÒÑ','Ğåãèîí ÒÂ','Ğåí ÒÂ','ÒÂÖ','MTV','Âåãà ÒÂ — ÑÒÑ','ÄÒÂ','Ìóç ÒÂ','ÎÒÑ (Ãîğîä+îáëàñòü!)','ÒÂ-3','ÒÍÒ');
					
	/*notes_tags*/
	$notes_tags_rows = $notes_tags = $notes_all_tags = array();
	foreach ($notes_cats as $notes_cat)
	{
		$notes_tags_rows[] = $notes_cat['tags'];
	}		
	foreach ($notes_tags_rows as $notes_tags_row)
	{	
		$notes_tags_row_items = explode("\n",$notes_tags_row);
		$notes_all_tags = array_merge($notes_all_tags, $notes_tags_row_items);
	}
	foreach ($notes_all_tags as $notes_tag_id => $notes_tag)
	{
		$notes_all_tags[$notes_tag_id] = trim($notes_tag);
		if ($notes_tag == '') unset($notes_all_tags[$notes_tag_id]);
	}
	$notes_all_tags = array_unique($notes_all_tags);
	asort($notes_all_tags);
	
	$channel_tags = array_intersect($notes_all_tags, $channels);
	$notes_tags = array_diff($notes_all_tags, $channels);
	
	//ïğîâåğêà íà ÷åñòíîñòü	
	if ( isset($_GET['tag']) ) {
		if (!in_array($_GET['tag'], $notes_all_tags) ) $site->SiteGoTo($parent_page);		
		$notes_tag = $_GET['tag'];	
		$notes_tag_cats = $notes->NotesGetTagCats($notes_tag);
		if (in_array($notes_tag, $channels)) $notes_tag_cats = array_slice($notes_tag_cats, 0, 50);
	} elseif ( isset($_GET['year']) ) {
		$year = (int)$_GET['year'];
		if ( $year > date('Y') || $year < 2008 ) {
			$site->SiteGoTo($parent_page);		
		}
		$notes_tag = $year;	
		$notes_tag_cats = $notes->NotesGetYearCats($notes_tag);
	} else {
		$site->SiteGoTo($parent_page);
	}
	
	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>