<?php
### Agents ###
// Agents on Call OK
mysql_select_db($database_wallboard, $wallboard);
$query_agent_in_call = "SELECT Count(vicidial_live_agents.`user`) FROM vicidial_live_agents WHERE vicidial_live_agents.`status` = 'INCALL'";
$agent_in_call = mysql_query($query_agent_in_call, $wallboard) or die(mysql_error());
$row_agent_in_call = mysql_fetch_assoc($agent_in_call);
$totalRows_agent_in_call = mysql_num_rows($agent_in_call);

// Agents Available OK
mysql_select_db($database_wallboard, $wallboard);
$query_agent_waiting = "SELECT Count(vicidial_live_agents.`user`) FROM vicidial_live_agents WHERE vicidial_live_agents.`status` = 'READY'";
$agent_waiting = mysql_query($query_agent_waiting, $wallboard) or die(mysql_error());
$row_agent_waiting = mysql_fetch_assoc($agent_waiting);
$totalRows_agent_waiting = mysql_num_rows($agent_waiting);

// Agents on Pause OK
mysql_select_db($database_wallboard, $wallboard);
$query_paused_agents = "SELECT Count(vicidial_live_agents.`user`) FROM vicidial_live_agents WHERE vicidial_live_agents.`status` = 'PAUSED'";
$paused_agents = mysql_query($query_paused_agents, $wallboard) or die(mysql_error());
$row_paused_agents = mysql_fetch_assoc($paused_agents);
$totalRows_paused_agents = mysql_num_rows($paused_agents);

// Dead Agents
mysql_select_db($database_wallboard, $wallboard);
$query_dead_agent = "SELECT Count(vicidial_live_agents.`user`) as `dead agent` FROM vicidial_live_agents WHERE vicidial_live_agents.callerid IS NOT NULL AND vicidial_live_agents.last_update_time > vicidial_live_agents.last_call_finish";
$dead_agent = mysql_query($query_dead_agent, $wallboard) or die(mysql_error());
$row_dead_agent = mysql_fetch_assoc($dead_agent);
$totalRows_dead_agent = mysql_num_rows($dead_agent);
?>