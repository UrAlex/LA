<?php
include_once("lanewsletter.checksession.php");
$emails = $_GET['emails'];
$emails = explode(",", $emails);
$acampaignid = $_GET['msgid'];
$numerror = $_GET['error'];

// FUNCTION TO CHECK THE MESSAGE TO DISPLAY
// CODE 1 -> SEND IT TO A MOBILE STORM'S LIST
// CODE 2 -> SEND IT TO A SELECTED EMAILS.
// NOT CODE-> ERROR WHILE TRYING SEND THE BLAST.

if($code==1){
  $message = "Your email campaign has been send to your emailing list. <br> It may take a while for it to go out.<br/><br/>";
}
if($code==2){
	$message = "Your test message has been send to:<br>";
	$message .="<div style='max-height:150px;overflow-y:auto;margin-top:10px;'><table style='margin:auto;width:200px;color:white;font-weight:300;'>";
	for($i=0;$i<count($emails);$i++){
		$message .= "<tr><td align='center'>".$emails[$i]."<td></tr>";
	}
	$message .="</table></div><br>";
	$message .="It may take a few minutes for you to get the test email.<br/>To resend a test or the full blast, please click 'Home' and make a new selection.<br/><a style='color:white' href='http://urmaster.com/promoters/lanewsletters/lanewsletter.blast.$pid.php' target='_blank'>Email Blast Link</a><br/><br/>";
}
if(!$code){
	$message = "Sorry, an error had been ocurred.<br/>Error: $numerror. <br/>Please try later.";
}
//END FUNCTION

echo "
<html>
<head>
	<style>
		@import url(https://fonts.googleapis.com/css?family=Oswald:400,700,300);
		
	</style>
</head>
<body style='background-color:black;font-weight:300;font-family:Oswald,sans-serif;'>
	<div style='width:500px;height:400;position:fixed;top:40%;left:50%;margin-left:-250px;margin-top:-200px;'>
		<div style='text-align:center'><img src='http://urmaster.com/promoters/images/logo-sbe-retina.png' width='150'/></div>
		<div style='color:white;text-align:center;margin-top:15px;'>$message</div>
		<div style='text-align:center'>
			<a style='color:rgb(189, 189, 189)' href='lanewsletter.php'>Home</a>&nbsp;&nbsp; 
			<a style='color:rgb(189, 189, 189)' href='lanewsletter.logout.php'>Logout</a>
		</div>
	</div>	
</body>
</html>
";
