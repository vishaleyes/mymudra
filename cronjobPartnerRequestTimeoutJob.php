<?php 
require_once('protected/config/mainheader.php');
error_reporting(E_ALL);
set_time_limit(0);
 
echo rest();


function rest()
	{
		//$url = "http://byptserver.com/diveflag/index.php/diveflag/getScubaShootersDataFromServer";
		
		if(IS_PRODUCTION == 0){
			$url = "http://".WEB_HOST_NAME.'/'._SITENAME_."/index.php?r=store/timeoutOrder";
		}
		else
		{
			$url = "http://".WEB_HOST_NAME."/index.php?r=store/timeoutOrder";
		}
		
		//open connection
		$ch = curl_init();
		$fields_string = "";
		
		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_POST,count($fields_string));
		curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		//execute post
		$result = curl_exec($ch);
		return  json_decode($result);
		//close connection
		curl_close($ch);
		

	}
	
?>