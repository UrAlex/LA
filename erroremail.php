<?php
include_once("../library/config.php");
include_once("../zc8_dyna/sqltools.php");
include_once("../zc8_dyna/opendb.php");
include_once("../functions/simpledate.php");
include_once("../functions/simpletime.php");
include_once("../zc8_functions/sendmail.php");

$numerror = $_GET['error'];
$date = $_GET['date'];
$errormsg = $_GET['errormsg'];
$pmail = $_GET['pemail'];
$system = $_GET['system'];

$clientid=7010;

$clientdatas=getnames("select varid as id, data as name
    from ETTdatas where ettid='$clientid' and status='7'");
  
$username=$clientdatas[334];
$fromemail=$clientdatas[329];
$fromname=$clientdatas[330];
$smtphost=$clientdatas[332];
$smtpport=$clientdatas[333];
$password=$clientdatas[331];


// Doing Lounge
$subject="Error Notifaction on $system Newsletter Generator";

$message="
$system Newsletter Generator\n\n
# Error : $numerror\n
Date : $date\n
Message : $errormsg\n
Username : $pmail\n
System : $system\n
";

$dyna_emailtype="Error Notification";
     
$fromname="UrVenue Admin";
     
       
$toemail="ajs@urvenue.com";
     
smtpmail($fromemail, $fromname, $subject, $message, $toemail, 
       $password, $username, $smtphost, $smtpport, $fromemail);  
       

if($system=="LA"){
	header("Location: lanewsletter/lanewsletter.successfully.php?error=$numerror");
	exit();	
}
if($system=="Create (Test Version)"){
	header("Location: create.version2/createnewsletter.sucessfully.php?error=$numerror");
	exit();
}
if($system=="Create"){
	header("Location: createnewsletter.successfully.php?error=$numerror");
	exit();	
}
