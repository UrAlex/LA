<?php  			
	include_once("lanewsletter.checksession.php");
	$dyna_host = "http://urmaster.com";
	$subject = $_POST['emailsubject'];
	$emails = $_POST['arremails'];
	$listid = $_POST['list'];
	$datepicker = $_POST['schedate'];
	$datatime = $_POST['schetime'];
	$timezone = $_POST['schezone'];
	
	//SOME VALUES THAT DEPENDS OF THE EMAIL TYPE (TEST OR BLAST)
	$fromname = "$pfname $plname";
	if($type=="email"){
		$_SESSION['lanewstest'] = "false";
		$removedevts = $_POST['removedevents2'];
		$campaigname = "LA Newsletter";
		$title = $_POST['titleemail'];
		$htmlcode = $_POST['htmlcode2'];
	}else{	
		$_SESSION['lanewstest'] = "true";			
		$removedevts = $_POST['removedevents1'];
		$campaigname = "TEST - LA Newsletter";
		$subject.=' - TEST';
		$title = $_POST['titletest'];
		$htmlcode = $_POST['htmlcode'];
	}
	//END FUNCTION
		
	//FUNCTION -> IF IS A TEST, ADD THE EMAILS
	if($emails){
		$emails = substr($emails, 0, strlen($emails)-1);
		$emails = explode(",", $emails);
		for($i=0;$i<count($emails);$i++){
			$subcribers .= "
				<SUBSCRIBER>
	           		<EMAIL>".$emails[$i]."</EMAIL>
				</SUBSCRIBER>
			";		
		}
	}			
	//END FUNCTION
	
	//FUNCTION TO BUILT THE PAGE TO SEND.
	$file = fopen("../lanewsletters/lanewsletter.blast.$pid.php", "w");
	$header = "
		<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
		<html xmlns='http://www.w3.org/1999/xhtml'>
			<head>	
				<title>Los Angeles</title>	
				<meta name='viewport' content='width=device-width' />
				<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
				<script type='text/javascript' src='http://urmaster.com/zc8_jquery/jquery.js'></script>
				<script type='text/javascript'>
					 window.onload = function() {
					 	position();
			    	 }
		    	 
			    	 
					  function position()
			         {
			         
			          var css = document.createElement('style');
						css.type = 'text/css';
						
						document.body.appendChild(css);
			         
				         if(window.innerWidth<700){
				         	css.innerHTML = 'table { width: 650px } .uv_line2{width:34%;} .uv_maintable{width:650px } img {width: 100% } ';
				         }
				         else
				         {
					     	css.innerHTML = '.uv_maintable { width: 650px } table { width: 650px } img {width: 100% }  .uv_line2{width:34%;}';   
				         }
				         document.body.appendChild(css);
			         }
					window.onresize=position;
										
				</script>
				<style type='text/css'>
					@import url(https://fonts.googleapis.com/css?family=Oswald:400,700,300);
				</style>
			</head>
			<body style='background:#000;'>
			<table style='width:100%;background-color:black'><tr><td>
			<div style='padding-top:5px;width: 650px;margin: auto;color: white;font-family:Oswald,Sans Serif, Arial;background-color:black;margin:auto'>$title</div>
	";
	
	//WRITING METAS/SCRIPTS	
	fwrite($file, $header);
	
	$secondpart = $htmlcode;
	$lsecondpart =  urldecode($secondpart);
	
	//WRITING EVENTS
	fwrite($file, $lsecondpart);
		
	$lastpart = "</td></table>
			</body>			
			
		</html>		
";
//WRITING FOOTER
fwrite($file, $lastpart);


//FUNCTION TO BUILD THE XML/WEB SERVICE
$wsdl = 'http://services.stun1.com/messagingAPI/?wsdl';
$file="http://urmaster.com/promoters/lanewsletters/lanewsletter.blast.$pid.php";
$xml = '<?xml version="1.0"?>
<MessagingApiRequest>
	<CREATECAMPAIGN>
        <CLIENTID>9047</CLIENTID>
        <ACCESSKEY>538tse5GoSQaNFQ</ACCESSKEY>
        <MESSAGETYPE>1</MESSAGETYPE>        
 <CAMPAIGNNAME>'.$campaigname.'</CAMPAIGNNAME>		
        <LISTID>'.$listid.'</LISTID>
 ';
 if($type == "test"){ 	 
	 $xml.= '
	 	<INDEPENDENT>1</INDEPENDENT>
        <SUBSCRIBERINFO>'.$subcribers.'</SUBSCRIBERINFO>
	 ';
 }	 
 if($datepicker){
	$xml .= "
		<SCHEDULE>YES</SCHEDULE>
        <SCHEDULETIME>$datatime</SCHEDULETIME> 
        <SCHEDULEDATE>$datepicker</SCHEDULEDATE>
        <TIMEZONE>$timezone</TIMEZONE>
	";
}else{
	$xml .= "
		<SCHEDULE>NO</SCHEDULE>
        <SCHEDULETIME></SCHEDULETIME> 
        <SCHEDULEDATE></SCHEDULEDATE>
        <TIMEZONE></TIMEZONE>
	";
}
 $xml .= '
        <FROMNAME>sbe Nightlife</FROMNAME>
        <SUBJECT>'.$subject.'</SUBJECT>
        <FORWARDFRIEND>OFF</FORWARDFRIEND>
        <CLICKTHROUGHS>ON</CLICKTHROUGHS>
        <WHITELISTREMINDER>ON</WHITELISTREMINDER>
        <CLICKSTREAMTRACKING>OFF</CLICKSTREAMTRACKING>
        <EDITPROFILELINK>OFF</EDITPROFILELINK>
        <EMAILONLINELINK>OFF</EMAILONLINELINK>
        <HTMLMESSAGE></HTMLMESSAGE>
        <PLAINTEXTMESSAGE></PLAINTEXTMESSAGE>
        <HTMLMESSAGEURL>'.$file.'</HTMLMESSAGEURL>
    </CREATECAMPAIGN>
</MessagingApiRequest>';
//END BUILD XML

//CALL SOAP TO SEND THE XML

//print_r("Submit:" . $xml . "\n");
$soap = new SoapClient($wsdl);
var_dump($soap->__getFunctions());
$result = $soap->CreateMessage($xml);
//print_r("result:" . $result . "\n");
$xml = simplexml_load_string($result);
$listid=$xml->RESPONSE->NEWLISTID;
$code = $xml->RESPONSE->RESPONSECODE;
$status = $xml->RESPONSE->RESPONSERESULTS;
$errormsg = $xml->RESPONSE->RESPONSEERRORMESSAGE;
//print_r("newlistid:" . $listid . "\n");
$acampaignid=$xml->RESPONSE->MESSAGEID;
//print_r("messageid:" . $acampaignid . "\n");

//END SOAP

//REDIRECT TO SUCCESSULLY PAGE.
$listemails = "";
if($code=="True"){
	if($type=="email"){
		header("Location: lanewsletter.successfully.php?code=1&msgid=$acampaignid");
		exit();
	}else{
		for($i=0;$i<count($emails);$i++){
			$listemails .= $emails[$i].",";
		}
		header("Location: lanewsletter.successfully.php?code=2&msgid=$acampaignid&emails=$listemails");
		exit();
	}
}else{
	//WHEN AN ERROR OCCURED WRITE IT ON FILE ERROR LOG
	$numerror = 0; 
	$fpread = fopen("error.log","r");	
	while(!feof($fpread))
	{
		$numerror++;
		fgets($fpread). "<br />";
	}
	fclose($fpread);
	$fperror = fopen("error.log","a");	
	$date = date("Y/m/d H:m:s", time());
	$system = "LA";
	if($code==""){
		$errormsg = "Error with the session";
		$error = "Error: $numerror - Date:".time()." - Message: $errormsg - Username: $pemail\n";	
	}else{
		$error = "Error: $numerror - Date:".time()." - Message: $errormsg - Username: $pemail\n";
	}
	
	fwrite($fperror, $error);
	fclose($fperror);
	
	header("Location: ../erroremail.php?error=$numerror&date=$date&errormsg=$errormsg&pemail=$pemail&system=$system");
	exit();
	
	
}
