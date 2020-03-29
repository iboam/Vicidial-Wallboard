<?php
if(isset($_SESSION['campaign'])){
	$campaign_query = " WHERE vicidial_auto_calls.campaign_id = 'PENDDOC'";
}

if(isset($_SESSION['user_group'])){
	$user_group = "";
}

### Calls ###
// Live Calls
mysql_select_db($database_wallboard, $wallboard);
$query_active = "SELECT Count(vicidial_auto_calls.`status`) FROM vicidial_auto_calls $campaign_query";
$active = mysql_query($query_active, $wallboard) or die(mysql_error());
$row_active = mysql_fetch_assoc($active);
$totalRows_active = mysql_num_rows($active);

// Calls Waiting OK
mysql_select_db($database_wallboard, $wallboard);
$query_ivr_calls = "SELECT Count(vicidial_auto_calls.`status`) FROM vicidial_auto_calls WHERE vicidial_auto_calls.`status` = 'LIVE'";
$ivr_calls = mysql_query($query_ivr_calls, $wallboard) or die(mysql_error());
$row_ivr_calls = mysql_fetch_assoc($ivr_calls);
$totalRows_ivr_calls = mysql_num_rows($ivr_calls);

// Calls in IVR OK
mysql_select_db($database_wallboard, $wallboard);
$query_waiting_call = "SELECT Count(vicidial_auto_calls.`status`) FROM vicidial_auto_calls WHERE vicidial_auto_calls.`status` = 'IVR'";
$waiting_call = mysql_query($query_waiting_call, $wallboard) or die(mysql_error());
$row_waiting_call = mysql_fetch_assoc($waiting_call);
$totalRows_waiting_call = mysql_num_rows($waiting_call);

// Calls Ringing
mysql_select_db($database_wallboard, $wallboard);
$query_calling = "SELECT Count(vicidial_auto_calls.call_type) FROM vicidial_auto_calls WHERE vicidial_auto_calls.stage = 'START'";
$calling = mysql_query($query_calling, $wallboard) or die(mysql_error());
$row_calling = mysql_fetch_assoc($calling);
$totalRows_calling = mysql_num_rows($calling);
?>