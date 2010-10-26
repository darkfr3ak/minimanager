<?php

// page header, and any additional required libraries
require_once 'header.php';
// minimum permission to view page
valid_login($action_permission['read']);

//#############################################################################
// EVENTS
//#############################################################################
function events()
{
	global 	$output, $lang_events,
			$realm_id, $world_db,
			$itemperpage;
			
$sqlw = new SQL;
$sqlw->connect($world_db[$realm_id]['addr'], $world_db[$realm_id]['user'], $world_db[$realm_id]['pass'], $world_db[$realm_id]['name']);

//==========================$_GET and SECURE========================

// pagination and order by to prevent sql injection
require_once './include/security.php';

	$order_dir = ($dir) ? 'DESC' : 'ASC';
	$dir = ($dir) ? 1 : 0;

//==========================$_GET and SECURE end========================

	// for multipage support
	$all_record = $sqlw->result($sqlw->query('
		SELECT count(*) 
		FROM game_event 
		WHERE start_time <> end_time'),0);

	// main data that we need for this page, game events
	$result = $sqlw->query('
		SELECT entry, description, start_time, occurence, length
		FROM game_event 
		WHERE start_time <> end_time 
		ORDER BY '.$order_by.' '.$order_dir.' 
		LIMIT '.$start.', '.$itemperpage.'');

//---------------Page Specific Data Starts Here--------------------------
$output .= '
<center>
<table class="top_hidden">
	<tr>
		<td width="25%" align="right">';

// multi page links
$output .=
			$lang_events['total'].' : '.$all_record.'<br /><br />'.
			generate_pagination('events.php?order_by='.$order_by.'&amp;dir='.(($dir) ? 0 : 1), $all_record, $itemperpage, $start);

// column headers, with links for sorting
$output .= '
		</td>
	</tr>
</table>
<table class="lined">
	<tr>
		<th width="1%"><a href="events.php?order_by=entry&amp;start='.$start.'&amp;dir='.$dir.'"'.($order_by==='entry' ? ' class="'.$order_dir.'"' : '').'>ID</a></th>
		<th width="34%"><a href="events.php?order_by=description&amp;start='.$start.'&amp;dir='.$dir.'"'.($order_by==='description' ? ' class="'.$order_dir.'"' : '').'>'.$lang_events['descr'].'</a></th>
		<th width="25%"><a href="events.php?order_by=start_time&amp;start='.$start.'&amp;dir='.$dir.'"'.($order_by==='start_time' ? ' class="'.$order_dir.'"' : '').'>'.$lang_events['start'].'</a></th>
		<th width="20%"><a href="events.php?order_by=occurence&amp;start='.$start.'&amp;dir='.$dir.'"'.($order_by==='occurence' ? ' class="'.$order_dir.'"' : '').'>'.$lang_events['occur'].'</a></th>
		<th width="20%"><a href="events.php?order_by=length&amp;start='.$start.'&amp;dir='.$dir.'"'.($order_by==='length' ? ' class="'.$order_dir.'"' : '').'>'.$lang_events['length'].'</a></th>
	</tr>';

	while ($events = $sqlw->fetch_assoc($result))
	{
		$days  = floor(round($events['occurence'] / 60) / 24);
		$hours = round($events['occurence'] / 60) - ($days * 24);
		$event_occurance = '';
		if ($days)
			$event_occurance .= $days.' days ';
		if ($hours)
			$event_occurance .= $hours.' hours';
			$days  = floor(round($events['length'] / 60) / 24);
			$hours = round($events['length'] / 60) - ($days * 24);
			$event_duration = '';
		if ($days)
			$event_duration .= $days.' days ';
		if ($hours)
			$event_duration .= $hours.' hours';
$output .= '
	<tr valign="top">
			<td>'.$events['entry'].'</td>
			<td align="left">'.$events['description'].'</td>
			<td>'.$events['start_time'].'</td>
			<td>'.$event_occurance.'</td>
			<td>'.$event_duration.'</td>
		</tr>';
	}
unset($event_duration);
unset($event_occurance);
unset($hours);
unset($days);
unset($events);
unset($result);

$output .= '
	<tr>
		<td colspan="4" class="hidden" align="right" width="25%">';
// multi page links
$output .= 
			generate_pagination('events.php?order_by='.$order_by.'&amp;dir='.(($dir) ? 0 : 1), $all_record, $itemperpage, $start);
unset($start);
$output .= '
		</td>
	</tr>
	<tr>
		<td colspan="4" class="hidden" align="right">'.$lang_events['total'].' : '.$all_record.'</td>
	</tr>
</table>
</center>';
}

//#############################################################################
// MAIN
//#############################################################################
// error variable reserved for future use
//$err = (isset($_GET['error'])) ? $_GET['error'] : NULL;

//unset($err);

$lang_events = lang_events();

$output .= '
<div class="top">
	<h1>'.$lang_events['events'].'</h1>
</div>';

// action variable reserved for future use
//$action = (isset($_GET['action'])) ? $_GET['action'] : NULL;

events();

//unset($action);
unset($action_permission);
unset($lang_events);

require_once 'footer.php';

?>
