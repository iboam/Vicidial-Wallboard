<?php

### INBOUND CALLS ###
// Inbound Total Calls
mysql_select_db($database_wallboard, $wallboard);
$query_total_inbound = "SELECT Count(call_log.uniqueid) AS `Total Inbound Calls` FROM `call_log` WHERE `channel_group` = 'DID_INBOUND' AND `start_time` > CURDATE()";
$total_inbound = mysql_query($query_total_inbound, $wallboard) or die(mysql_error());
$row_total_inbound = mysql_fetch_assoc($total_inbound);
$totalRows_total_inbound = mysql_num_rows($total_inbound);

// Inbound Answered Calls
mysql_select_db($database_wallboard, $wallboard);
$query_answered_inbound = "SELECT Count(vicidial_closer_log.closecallid) AS `Total Inbound Answered` FROM `vicidial_closer_log` WHERE `call_date` > CURDATE() AND `user` <> 'VDCL'";
$answered_inbound = mysql_query($query_answered_inbound, $wallboard) or die(mysql_error());
$row_answered_inbound = mysql_fetch_assoc($answered_inbound);
$totalRows_answered_inbound = mysql_num_rows($answered_inbound);

// Inbound Drop Calls
mysql_select_db($database_wallboard, $wallboard);
$query_drop_inbound = "SELECT Count(vicidial_closer_log.closecallid) AS `Total Inbound Drop` FROM `vicidial_closer_log` WHERE `call_date` > CURDATE() AND `STATUS` = 'DROP'";
$drop_inbound = mysql_query($query_drop_inbound, $wallboard) or die(mysql_error());
$row_drop_inbound = mysql_fetch_assoc($drop_inbound);
$totalRows_drop_inbound = mysql_num_rows($drop_inbound);
?>
