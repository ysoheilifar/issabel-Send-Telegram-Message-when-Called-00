#!/usr/bin/php -q
<?php
require 'phpagi.php';
error_reporting (E_ALL);
$agi = new AGI();

//set time zone to local
date_default_timezone_set('Asia/Tehran');
$datetime = date("Y-m-d H:i:s");
$time = date("H:i:s");

//set CDR User Field
$agi->set_variable("CDR(userfield)", "CALLED 00");

//get some of channel variables
$caller_id_number = $agi->request["agi_callerid"];
$caller_id_name   = $agi->request["agi_calleridname"];
$unique_id        = $agi->request["agi_uniqueid"];
$exten 			  = $agi->request['agi_dnid'];

function telegram($msg) {
        global $telegrambot,$telegramchatid;
        $url='https://api.telegram.org/bot'.$telegrambot.'/sendMessage';$data=array('chat_id'=>$telegramchatid,'text'=>$msg);
        $options=array('http'=>array('method'=>'POST','header'=>"Content-Type:application/x-www-form-urlencoded\r\n",'content'=>http_build_query($data),),);
        $context=stream_context_create($options);
        $result=file_get_contents($url,false,$context);
        return $result;
}

// Set your Bot ID and Chat ID.
$telegrambot='1415363275:AAFD0ZPLgQvtlMBgehw-QNWTTG09P8G42bU';
$telegramchatid=90320218;

// Function call with your own text or variable
telegram ("CallerIDNumber = ".$caller_id_number."\nDIDNumber = ".$exten."\nDateTime = ".$datetime."\nUniqueID = ".$unique_id);
?>