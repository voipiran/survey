#!/usr/bin/php -q
<?php
  /* 
  +----------------------------------------------------------------------+
  | VOIPIRAN Survey Version 1.4                                        |
  | http://www.voipiran.io                                               |
  +----------------------------------------------------------------------+
  | Copyright (c) 2020 VOIPIRAN Solutions                                |
  +----------------------------------------------------------------------+
  | This is a Commercia Product, Please contact voipiran.io to purchase  |                                    |
  +----------------------------------------------------------------------+
*/
/*Sound-Sufix*/
//$sound=operator;
//$sound=karshenas;

require('phpagi.php');

$agi = new AGI();
$agi->answer();
  
  //Get Database Settings
$config = parse_ini_file('visurvey.ini' , true);
$dbuser = $config['dbuser'] ;
$dbpass = $config['dbpass'] ;
$dbaddress = $config['dbaddress'] ;
$dbname = $config['dbname'] ;
$sound = $config['agentRole'] ;

/*Set Defaut Paths*/
$voicePath="/var/www/html/survey/uploads/";
//Not Used
$recordPath="/var/www/html/survey/core/survey/voices/";

/*Set Time Zone*/
date_default_timezone_set('Asia/Tehran');
$customerVoicePath="";
	
/*Get QUEUE NAME*/
  	$temp = $agi->get_variable("QUEUENUM");
	$surveyLocation = $temp['data'];
	$agi->Verbose('****VOIPIRAN****QUEUENUM:'.$surveyLocation);

	
/*Connect Database*/
	$con = mysql_connect($dbaddress,$dbuser,$dbpass);
	mysql_query("SET character_set_results=utf8", $con);
	
		if (!$con)
		{
		$agi->Verbose('**VOIPIRAN**DB Not Connected');
		die('Could not connect: ' . mysql_error());

		}
		$agi->Verbose('****VOIPIRAN****DB Connected');
		mysql_select_db($dbname, $con);
		
		/*Get Survey Setting and find Queue properties*/
		$result = mysql_query("SELECT * FROM settings WHERE survey_queue='$surveyLocation'");
		if (!$result || mysql_num_rows($result) === 0) {
			$agi->Verbose('**VOIPIRAN**DB Invalid Query'.mysql_error());
			$agi-> Hangup();
			die('Invalid query: ' . mysql_error());
		}else{
		$agi->Verbose('****VOIPIRAN****Query survey_queue OK');
			while ($row = mysql_fetch_assoc($result)) {
				if($row['survey_queue']==$surveyLocation){
					$surveyVoiceTemp = $row['survey_voice'];
					$surveyVoice = strstr($surveyVoiceTemp, '.', true);
					$surveyString = $row['survey_string'];
					$surveyStatus = $row['survey_status'];
					$customerVoiceStatus = $row['customer_voice_status'];
					$customerVoiceLimit = $row['customer_voice_limit'];
					$surveypPlayagent = $row['survey_playagent'];
					
				}
			}
			mysql_free_result($result);
		}
$agi->Verbose('****VOIPIRAN DATABASE VARIABLES****');
$agi->Verbose('****VOIPIRAN****surveyString:'.$surveyString);
$agi->Verbose('****VOIPIRAN****surveyLocation:'.$surveyLocation);
$agi->Verbose('****VOIPIRAN****surveyStatus:'.$surveyStatus);
$agi->Verbose('****VOIPIRAN****surveypPlayagent:'.$surveypPlayagent);

/*Check If Queue Survey is Enabled*/
  if($surveyStatus == '1'){
	$agi->Verbose('****VOIPIRAN****Queue Enabled ُStatus OK');	  
/*Get CallerID*/
  	$temp = $agi->get_variable("CALLERID(num)");
	$calleridNumber = $temp['data'];
	
	$temp = $agi->get_variable("CALLERID(name)");
	$calleridName = $temp['data'];
	
/*UniqueID*/
	$temp = $agi->get_variable("UNIQUEID");
	$uniqueid = $temp['data'];
	
/*Get AgentNumber*/
  	$temp = $agi->get_variable("CONNECTEDLINE(num)");
	$agentNumber = $temp['data'];
	$agi->Verbose('****VOIPIRAN****connectedline:'.$connectedline);
	if ($agentNumber == NULL){
		/*$extension[1] is a Agent Number*/
		$res = $agi->get_variable('MEMBERINTERFACE');
		preg_match('/\/(.*?)\@/', $res['data'], $extension);
		$agentNumber = $extension[1];
	
		if(strpos($res['data'], 'SIP/') !== false){
			$aNumber = explode('/', $res['data']);
			$agentNumber = $aNumber[1];
		}
	}

/*Get Agent Name*/
	$agi->Verbose('****VOIPIRAN****Get Agent Name');	  
		mysql_select_db("asterisk", $con);
		/*Get Survey Setting and find Queue properties*/
		$result = mysql_query("SELECT * FROM users WHERE extension='$agentNumber'");
		if (!$result) {
			die('Invalid query: ' . mysql_error());
		}else{
			while ($row = mysql_fetch_assoc($result)) {

				$agentName = $row['name'];
			}
			mysql_free_result($result);
		}
	
	mysql_select_db($dbname, $con);
	
/*Get Survey Number*/
	$x = 1;
	while (true) {
		$agi->Verbose('****VOIPIRAN****Get Survey Number');
		$agi->Verbose('VOICE***'.$voicePath.$surveyVoice);
		$temp = $agi->get_data($voicePath.$surveyVoice, 15000, 1);  
		$surveyValue = $temp['result'];

		if($surveyString = '12345'){
		
			if ($surveyValue < 6 && $surveyValue > 0) {
				break;
			}else{
			$agi-> stream_file($voicePath."survey-number-not-correct");	
			if ($x >= 4){$agi-> hangup();}
			$x++;
			}
		}
		/*
		if($surveyString = '123'){
		
			if ($surveyValue < 4 && $surveyValue > 0) {
				break;
			}else{
			$agi-> stream_file($voicePath."survey-number-not-correct");	
			}
		}*/
	}
	
//Add Resault to DB without VoicePath
		mysql_query("INSERT INTO survey (date_time, survey_value, agent_number, agent_name, caller_number, caller_name, uniqueid, survey_location, customer_voice_path)
		VALUES (now(), '$surveyValue', '$agentNumber', '$agentName', '$calleridNumber', '$calleridName' , '$uniqueid', '$surveyLocation', '$customerVoicePath')");

/*Get Customer Voice*/
	 if($customerVoiceStatus == '1'){

/*Check Voice Limit*/
		 if($customerVoiceLimit == '0' || $customerVoiceLimit >= $surveyValue){
			 
			$timestamp = date('Ymd-His');
			$agi -> stream_file($voicePath."survey-thankyou-".$sound."-vm");	
				/*Voice Lenght 5 mins*/
			$agi -> record_file($recordPath.$timestamp.'-'.$agentNumber.'-'.$calleridNumber.'-'.$uniqueid,wav,'1234567890*#',300000,null,true,null);
		
			$customerVoicePath = $timestamp.'-'.$agentNumber.'-'.$calleridNumber.'-'.$uniqueid.'.wav';
		 
			//Update DB by VoicePath
			mysql_query("UPDATE survey SET customer_voice_path='$customerVoicePath' WHERE uniqueid='$uniqueid'");
			mysql_close($con);
		 
		 }
	}else{
	//Close DB Connection if There is no CustmerVoicePage
	mysql_close($con);
	}
		//Nazare shoma Sabt Gardid
		$agi-> stream_file($voicePath."survey-thankyou-".$sound);
		$agi->exec('Wait','1');		
		$agi-> Hangup();
  }
  
?>