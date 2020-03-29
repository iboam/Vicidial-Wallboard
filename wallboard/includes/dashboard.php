<?php require_once('../Connections/wallboard.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

### Calls ###
include('call_queries.php');

### Agents ###
include('agent_queries.php');

### INBOUND CALLS ###
include('inbound_queries.php');

### OUTBOUND CALLS ###
include('outbound_queries.php');
?>
<style>
  html, body{
	  overflow:hidden;  
  }
  .col-xs-15 {
    width: 20%;
    float: left;
	}
	@media (min-width: 768px) {
	.col-sm-15 {
			width: 20%;
			float: left;
		}
	}
	@media (min-width: 992px) {
		.col-md-15 {
			width: 20%;
			float: left;
		}
	}
	@media (min-width: 1200px) {
		.col-lg-15 {
			width: 20%;
			float: left;
		}
	}
  
  .row div{
	  height:25%;
	  min-height: 193px;
	  border: solid 2px;
	  color: #FFF;
	  font-weight:bold;
	  text-align:center;
	  padding-top: 45px;
	  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.80);
  }
  
  .counter{
	  font-size:80px;
	  display:block;
	  margin-bottom: -15px;
  }
  
  .label, button.label{
	  font-size:28px;
	  font-weight:lighter;
	  background: none !important;
	  border: none;
	  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.80);
  }
  
  .info{
	  background: #0499d1; /*00c2ed*/
	  /*background: linear-gradient(141deg, #0fb8ad 0%, #1fc8db 51%, #2cb5e8 75%);*/
  }
  
  .hold{
	  background: #ff6501;
	  /*background: linear-gradient(141deg, #B8800F 0%, #DB951F 51%, #E8A02C 75%);*/
	  
  }
  
  .drop{
	  background: #b50005;
	  /*background: linear-gradient(141deg, #B80F49 0%, #DB3F1F 51%, #D22525 75%);*/
	  
  }
  
  .dead{
	  background: #000000;
	  /*background: linear-gradient(141deg, #B80F49 0%, #DB3F1F 51%, #D22525 75%);*/
	  
  }
  
  .answer{
	  background: #0bb634;
	  /*background: linear-gradient(141deg, #0FB876 0%, #1FDB81 51%, #2CE87B 75%);*/
	  
  }
  
  .glyphicon, a .glyphicon{
	  font-size:40px;
	  position: absolute;
	  right: 25px;
	  top: 15px;
	  opacity: 0.3;
  }
  
  .logo{
	  position: absolute;
	  left: 9%;
	  top: 5px;
	  opacity: 0.4;
	  text-shadow: none !important;
  }
  
  
  
  </style>
 	
	<div class="row">
      <div class="col-lg-3 hold">
      	<span class="logo" aria-hidden="true"><img src="files/header-logo.png" height="63" width="350"/></span>
        <span class="counter"><?php echo date("h:i"); ?></span>
        <span class="label" style="margin-left:15% !important"><?php echo date("m/d/Y"); ?></span>
        <span class="label"><button type="button" class="label" data-toggle="modal" data-target="#settings"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></button></span>
        
      </div>
      <div class="col-lg-3 answer">
        <span class="counter"><?php echo $row_active['Count(vicidial_auto_calls.`status`)']; ?></span>
        <span class="label"><button type="button" class="label" data-toggle="modal" data-target="#live_calls">Live Calls</button></span>
        <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
      </div>
      <div class="col-lg-3 info">
        <span class="counter"><?php echo $row_waiting_call['Count(vicidial_auto_calls.`status`)']; ?></span>
        <span class="label"><button type="button" class="label" data-toggle="modal" data-target="#ivr_calls">Calls in IVR</button></span>              
        <span class="glyphicon glyphicon-th" aria-hidden="true"></span>
      </div>
      <div class="col-lg-3 hold">
      	<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
      	<span class="counter"><?php echo $row_ivr_calls['Count(vicidial_auto_calls.`status`)']; ?></span>
        <span class="label"><button type="button" class="label" data-toggle="modal" data-target="#waiting_calls">Calls Waiting</button></span>
      </div>
      
    </div>
    
    <div class="row">
      <div class="col-lg-3 answer">
      	<span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
        <span class="counter"><?php echo $row_calling['Count(vicidial_auto_calls.call_type)']; ?></span>
        <span class="label"><button type="button" class="label" data-toggle="modal" data-target="#calls_ringing">Calls Ringing</button></span>
      </div>
      <div class="col-lg-3 answer">
      	<span class="glyphicon glyphicon-headphones" aria-hidden="true"></span>
      	<span class="counter"><?php echo $row_agent_in_call['Count(vicidial_live_agents.`user`)']; ?></span>
        <span class="label"><button type="button" class="label" data-toggle="modal" data-target="#agents_oncall">Agents on Call</button></span>
      </div>
      <div class="col-lg-3 answer">
      	<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
      	<span class="counter"><?php echo $row_agent_waiting['Count(vicidial_live_agents.`user`)']; ?></span>
        <span class="label"><button type="button" class="label" data-toggle="modal" data-target="#agents_available">Agents Available</button></span>
      </div>
      <div class="col-lg-3 hold">
      	<span class="glyphicon glyphicon-pause" aria-hidden="true"></span>
      	<span class="counter"><?php echo $row_paused_agents['Count(vicidial_live_agents.`user`)']; ?></span>
        <span class="label"><button type="button" class="label" data-toggle="modal" data-target="#agents_onpause">Agents on Pause</button></span>
      </div>
    </div>
    
    <div class="row">
      <div class="col-lg-3 answer">
      	<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
      	<span class="counter"><?php echo $row_total_inbound['Total Inbound Calls']; ?></span>
        <span class="label"><button type="button" class="label" data-toggle="modal" data-target="#total_inbound">Inbound Calls</button></span>
      </div>
      <div class="col-lg-3 answer">
      	<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
      	<span class="counter"><?php echo $row_answered_inbound['Total Inbound Answered']; ?></span>
        <span class="label"><button type="button" class="label" data-toggle="modal" data-target="#inbound_answered">Inbound Answered Calls</button></span>
      </div>
      <div class="col-lg-3 drop">
      	<span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>
      	<span class="counter"><?php echo $row_drop_inbound['Total Inbound Drop']; ?></span>
        <span class="label"><button type="button" class="label" data-toggle="modal" data-target="#inbound_drops">Inbound Drop Calls</button></span>
      </div>
      <div class="col-lg-3 drop">
      	<span class="glyphicon glyphicon-stats" aria-hidden="true"></span>
      	<span class="counter"><?php echo round(( $row_drop_inbound['Total Inbound Drop']* 100)/$row_total_inbound['Total Inbound Calls'], 2); ?>%</span>
        <span class="label">Drop Percent</span>
      </div>
    </div>
    
    <div class="row">
      <div class="col-lg-3 answer">
      	<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
        <span class="counter"><?php echo $row_calls_today['total_calls']; ?></span>
        <span class="label"><button type="button" class="label" data-toggle="modal" data-target="#total_outbound">Outbound Calls</button></span>
      </div>
      <div class="col-lg-3 answer">
      	<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
        <span class="counter"><?php echo $row_answered_calls['Count(vicidial_log.uniqueid)']; ?></span>
        <span class="label"><button type="button" class="label" data-toggle="modal" data-target="#outbound_answered">Outbound Answered Calls</button></span>
      </div>
      <div class="col-lg-3 drop">
      	<span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>
      	<span class="counter"><?php echo $row_drop_calls_today['total_calls']; ?></span>
        <span class="label"><button type="button" class="label" data-toggle="modal" data-target="#outbound_drops">Outbound Drop Calls</button></span>
      </div>
      <div class="col-lg-3 drop">
      	<span class="glyphicon glyphicon-stats" aria-hidden="true"></span>
      	<span class="counter"><?php echo round(($row_drop_calls_today['total_calls'] * 100)/$row_answered_calls['Count(vicidial_log.uniqueid)'], 2); ?>%</span>
        <span class="label">Drop Percent</span>
      </div>
    </div>
   
<?php
mysql_free_result($agent_waiting);

mysql_free_result($paused_agents);

mysql_free_result($agent_in_call);

mysql_free_result($ivr_calls);

mysql_free_result($waiting_call);

mysql_free_result($active);

mysql_free_result($calls_today);

mysql_free_result($drop_calls_today);

mysql_free_result($dead_agent);

mysql_free_result($total_calls_detail);

mysql_free_result($answered_calls);

mysql_free_result($calling);

mysql_free_result($drop_inbound);

mysql_free_result($total_inbound);

mysql_free_result($answered_inbound);
?>
