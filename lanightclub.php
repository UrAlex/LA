<?php
  session_start();
	session_destroy();
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="lanewsletter/lanewsletter.css" />
	<script type="text/javascript" src="lanewsletter/lanewsletter.js" ></script>
	<script type='text/javascript' src='../zc8_jquery/jquery.js'></script>
	<script>
		function loadlog(){
			$(".loader").css("display","inline-block");
			$("#login").submit();
		}
	</script>
</head>
<body style="background-color:black;color:white;font-family:Oswald,sans-serif;color:white;font-weight:300">
	<table class='loader'>
		<tr><td>
			<img src='images/ajax-loader.gif' width='40' height='40' />
		</td></tr>
	</table>		
	<div class='login'>
		<div style='text-align:center'><img src='http://urmaster.com/promoters/images/logo-sbe-retina.png' width='150'/></div>
		<form action='lanewsletter/lanewsletter.login.php' id='login' method='post' />
		<table class='table-login'>
			<tr>
				<td colspan='2' align="center" style='padding-bottom:5px;'>
					<?php
						if($e==1){
							echo "<span style='font-size:12px;color:red;font-style:italic'>Invalid username or password.</span>";
						}
					?>
				</td>
			</tr>
			<tr>
				<td style="padding-bottom:10px;">Username :</td>
				<td style="padding-bottom:10px;"><input type='text' name='username' id='username' value='' /></td>
			</tr>
			<tr>
				<td>Password :</td>
				<td><input type='password' name='password' id='password' value='' /></td>
			</tr>
			<tr>
				<td colspan="2" align="right"><div class='btnsend' style='background-color: #e8e6df;color: rgb(116, 115, 115);
font-size: 12px;text-align:center;padding-top:4px;float:right;margin-right:15px;' onclick='loadlog()'>LOGIN</div></td>
			</tr>
		</table>
		</form>
	</div>
</body>
</html>	
	
