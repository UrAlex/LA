<?php
  session_start();
	session_destroy();

	header("Location: ../lanightclub.php");
	exit();
