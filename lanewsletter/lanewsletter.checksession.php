<?php
  session_start();
	$sid = $_SESSION['lanewssid'];
	$pid = $_SESSION['lanewsid'];
	$pemail = $_SESSION['lanewsemail'];
	$pfname = $_SESSION['lanewsfname'];
	$plname = $_SESSION['lanewslname'];
	$paffiliatekey = $_SESSION['lanewsaffiliateKey'];
	$statustest = $_SESSION['lanewstest'];
	    
	if(!(isset($sid))){	
		header("Location: ../lanightclub.html");
		exit();					
	}
