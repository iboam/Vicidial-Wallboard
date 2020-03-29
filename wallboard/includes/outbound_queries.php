<?php
### OUTBOUND CALLS ###

// Total Calls - OK
mysql_select_db($database_wallboard, $wallboard);
$query_calls_today = "SELECT Count(vicidial_log.uniqueid) AS total_calls FROM `vicidial_log` WHERE vicidial_log.call_date > CURDATE()";
$calls_today = mysql_query($query_calls_today, $wallboard) or die(mysql_error());
$row_calls_today = mysql_fetch_assoc($calls_today);
$totalRows_calls_today = mysql_num_rows($calls_today);

// Outbound Answered Calls - OK
mysql_select_db($database_wallboard, $wallboard);
$query_answered_calls = "SELECT Count(vicidial_log.uniqueid) FROM `vicidial_log` WHERE vicidial_log.call_date > CURDATE() AND `user` <> 'VDAD'";
$answered_calls = mysql_query($query_answered_calls, $wallboard) or die(mysql_error());
$row_answered_calls = mysql_fetch_assoc($answered_calls);
$totalRows_answered_calls = mysql_num_rows($answered_calls);

// Outbound Drop Calls Today - OK
mysql_select_db($database_wallboard, $wallboard);
$query_drop_calls_today = "SELECT Count(vicidial_log.uniqueid) AS total_calls FROM `vicidial_log` WHERE `call_date` > CURDATE() AND `status` = 'DROP'";
$drop_calls_today = mysql_query($query_drop_calls_today, $wallboard) or die(mysql_error());
$row_drop_calls_today = mysql_fetch_assoc($drop_calls_today);
$totalRows_drop_calls_today = mysql_num_rows($drop_calls_today);

### OUTBOUND CALLS DETAIL ###

// Total Calls Detail - OK
mysql_select_db($database_wallboard, $wallboard);
$query_total_calls_detail = "SELECT vicidial_log.phone_number, vicidial_log.`status`, vicidial_log.call_date, vicidial_log.campaign_id, vicidial_log.start_epoch, vicidial_log.end_epoch FROM `vicidial_log` WHERE vicidial_log.call_date > CURDATE()";
$total_calls_detail = mysql_query($query_total_calls_detail, $wallboard) or die(mysql_error());
$row_total_calls_detail = mysql_fetch_assoc($total_calls_detail);
$totalRows_total_calls_detail = mysql_num_rows($total_calls_detail);



?>