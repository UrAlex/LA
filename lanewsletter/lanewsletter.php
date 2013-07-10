<?php
  include_once("lanewsletter.checksession.php");
	$dyna_host = "urmaster.com";	
	$deletedevents = $_POST['removedevents'];
	$newevents = $_POST['events'];
	$numshows = 0;
	$filepath = "../../promoters/sbe-lists-2013-06.csv";

	// FUNCTION TO PASS ALL MOBILE STORM'S LISTS OF THE CSV FILE TO AN ARRAY.
	$fp = fopen ( $filepath , "r" ); 
	$i=0;		
	while (( $data = fgetcsv ( $fp , 1000 , "," )) !== FALSE ) {
		$y=0;
		if($i!=0){
			foreach($data as $row) {
				if($y==0){
					$alllistids[$i-1][0]=$row;
				}
				if($y==1){
					$alllistids[$i-1][1]=$row;
				}
				if($y==4){
					$alllistids[$i-1][2]=$row;
				}			
				$y++;		
			}					
		}	
		$i++;	
	}
	// END FUNCTION.	

	// FUNCTION TO MAKE PULL DOWN WITH THE MOBILE STORM'S LISTS.
	$statuslist = false;
	$totlists = 0;
	$lists = "
		<select id='mylist' class='listsclass' style='width:201px;' onchange='selectlist(this.value)'>
			<option value='0'>- Select List -</option>
	";	
	for($i=0;$i<count($alllistids);$i++){
		if($alllistids[$i][2]==$pemail){
			$totlists ++;
			$statuslist = true;	
			$lists.="<option id='".$alllistids[$i][0]."' value='".$alllistids[$i][0]."' listname='".$alllistids[$i][1]."'>".$alllistids[$i][1]."</option>";
		}
	}
	$lists .= "</select>";		
	
	$statuslisttest = false;
	$liststest = "
		<select id='mylist2' class='listsclass' style='width:201px;' onchange='selectlist2(this.value)'>
			<option value='0'>- Select List -</option>
	";	
	for($i=0;$i<count($alllistids);$i++){
		if($alllistids[$i][2]==$pemail){
			$statuslisttest = true;
			if($totlists==1){
				$listsvalue = $alllistids[$i][0];
			}
			$liststest.="<option id='".$alllistids[$i][0]."' value='".$alllistids[$i][0]."' listname='".$alllistids[$i][1]."'>".$alllistids[$i][1]."</option>";
		}
	}
	$liststest .= "</select>";
	// END FUNCTION
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
	<head>	
		<title>Los Angeles Newsletter</title>	
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" type="text/css" href="lanewsletter.css" />
		<link rel='stylesheet' type='text/css' href='http://urmaster.com/zc8_jquery/chosen/chosen.css' />
		<link href="../datepicker/jquery-ui-1.9.2.custom.css" rel="stylesheet">
		<script type='text/javascript' src='lanewsletter.js'></script>
		<script type='text/javascript' src='http://urmaster.com/zc8_jquery/jquery.js'></script>
		<script src='http://urmaster.com/zc8_jquery/chosen/chosen.jquery.js' type='text/javascript'></script>		
		<script src="../datepicker/jquery-ui-1.9.2.custom.js"></script>	
		<style type='text/css'>
			.evtdates a {color:#ffffff; text-decoration: none;}			
			.evtdat {color:#ffffff; text-decoration: none;}			
		</style>
		<script type="text/javascript">
			$(function() {
				var date = new Date();
				var day = date.getDay();
				var month = date.getMonth();
				var year = date.getYear();
				$( "#datepicker" ).datepicker({
					minDate: new Date()
				});
			});					
			
			 window.onload = function() {
			 	position();			 
			 				 	
			 	$('form').keypress(function(e){   
					if(e == 13){
				    	return false;
				    }
				});
				
				$('input').keypress(function(e){
				    if(e.which == 13){
				    	return false;
				    }
				});	
	    	 }    	 
	    	 
			  function position()
	         {
	         
	          var css = document.createElement("style");
				css.type = "text/css";
				
				document.body.appendChild(css);
	         
		         if(window.innerWidth<700){
		         	css.innerHTML = "table { width: 704px } .uv_line2{width:34%;} .uv_maintable{width:100% } ";
		         }
		         else
		         {
			     	css.innerHTML = ".uv_maintable { width: 704px } table { width: 100% }  .uv_line2{width:34%;}";   
		         }
		         document.body.appendChild(css);
	         }
			window.onresize=position;	

			$(document).ready(function (){		
				var tmpdate2 = new Date();
				var year2 = tmpdate2.getFullYear();
				var month2 = tmpdate2.getMonth()+1;
				var strmon = new String(month2);
				if(strmon.length==1){
					strmon = "0"+strmon;
				}
				var day2 = tmpdate2.getDate();
				var strday = new String(day2);
				if(strday.length==1){
					strday = "0"+strday;
				}
				var date2 = year2+"-"+strmon+"-"+strday;
				
				var trs = document.getElementsByTagName("tr");	
				var tr = "";
				var cont = 0;
				for(var i=0;i<trs.length;i++){		
					var type = trs[i].getAttribute("type");
					var evtid = trs[i].getAttribute("id");
					var evtdate = trs[i].getAttribute("date"); 
					if(type=="evt"){
						//alert(evtdate);
						if( (new Date(evtdate).getTime() < new Date(date2).getTime())){
							$("#"+evtid).attr("class","toremove");						
						}
					}
				}
				$(".toremove").remove();
				

				var events = document.getElementsByTagName("a");	
				var event = "";
				var cont = 0;
				for(var i=0;i<events.length;i++){		
					var type = events[i].getAttribute("type");
					var id = events[i].getAttribute("id");
					var target = events[i].getAttribute("href");
					if(type=="targetevt"){
						var key = $("#accesskey").val();
						var fname = $("#fname").val();
						var lname = $("#lname").val();
						target +="&key="+key+"&utm_source=newsletter-"+fname+"-"+lname;
						events[i].href = target;
					}
				}
				
				var content = $("#maincontent").html();	
				content = escape(content);
				$("#htmlcode").val(content);
				$("#htmlcode2").val(content);
			});				
			</script>
		
	</head>
	<body bgcolor="#000" style="background:#000;font-family:Oswald,sans-serif;color:white;font-weight:300">
		<input type='hidden' id='accesskey' value='<?php echo $paffiliatekey; ?>'/>
		<input type='hidden' id='fname' value='<?php echo $pfname; ?>'/>
		<input type='hidden' id='lname' value='<?php echo $plname; ?>'/>

		<input type='hidden' id='statust' value='<?php echo $statustest; ?>' />
		<!-- POPUP TO ADD EVENTS -->
		<form action='lanewsletter.html' id='formevents' method='post'>		
			<input type='hidden' name='newevents' id='newevents' value='<?php echo $newevents; ?>' />
			<input type='hidden' name='removedevents' id='removedevents' value='<?php echo $deletedevents; ?>' />
		</form>
		<div class='popup' style='height:300px;margin-top:-150px;' id='addevents'>
			<div class='inner-popup' style='height:250px;'>
				ADD EVENTS TO THE NEWSLETTER<br>
				<div style='text-align:left;width: 300px;margin: auto;font-size:14px;margin-top:10px;height:165px;margin-bottom:5px;overflow-y:auto;'>
					<?php
						for($i=0;$i<count($allevents);$i++){
							$datainfo = explode("-nextvalue-", $allevents[$i]);
						
							$showid=$datainfo[1];
							$showname=$datainfo[2];
							$showdate=$datainfo[3];
							$showposter=$datainfo[4];						
							$showdescription=$datainfo[5];
							
							echo "<input type='checkbox' id='$showid' name='addevt[]' value='$showid' onclick='addnewevent(this.value)'/>&nbsp;&nbsp;$showname<br>";
						}
					?>					
				</div>
				<div class='btnsend' onclick="addnewsevents()" style="float:right;margin-right:10px;">ADD</div>
				<div class='btnsend' onclick="closeaddevents()" style="float:left;margin-left:10px;">CANCEL</div>
			</div>
		</div>
		<!-- END POPUP TO ADD EVENTS -->
		
		
		<!-- POPUP SEND BLAST -->
		<?php 
			if($totlists==1){
				$styles1 = "style='height:155px;margin-top:-77px;'";
				$styles2 = "style='height:105px'";	
			}else{
				$styles1 = "style='height:230px;margin-top:-115px'";
				$styles2 = "style='height:180px'";
			}			
		?>
		<div class='popup' <?php echo $styles1; ?> id='confirm'>
			<div class='inner-popup' <?php echo $styles2; ?> >
				SEND EMAIL BLAST<br>
				<?php
					if($statuslist==true){																		
						if($totlists>1){
							echo "<div style='margin-top:15px;margin-bottom:10px;'>Please choose a list to send the blast.</div>";
							echo "<div >$lists</div>";							
						}						
				        echo "
				        <div style='margin-top:10px;'>
						<input type='radio' id='optshce1' name='optshce' value='now' onclick=schedule('now','$totlists'); checked='checked'>Send Now &nbsp;&nbsp;
						<input type='radio' id='optshce2' name='optshce' value='sch' onclick=schedule('schedule','$totlists');>Schedule
						</div>
						<div id='schedule' style='display:none;'>
							<table style='margin:auto;width:230px;'>
								<tr>
									<td style='padding-top:10px;width:70px;text-align:left;'>Date :</td>
									<td style='padding-top:10px;'>
										<input type='text' name='datepicker' id='datepicker' style='width:143px;height:18px;' onchange='checktime()' />
									</td>
								</tr>
								<tr>
									<td style='padding-top:10px;width:70px;text-align:left;'>Time :</td>
									<td style='padding-top:10px;' id='timesection'>
										<select id='datetime' class='listsclass' style='width:150px' onchange='checktime()'>
											<option id='' value='0'>- Select Time -</option>";
												$date = date("H",time());
												for($i=0;$i<24;$i++){													
													if($i==0){
														$hour = 12;
														$valhour = "00";
														$typehour = "AM";
													}else{			
														if($i<=11){														
															$typehour = "AM";													
															$hour = $i;
														}else{
															$typehour = "PM";
															if($i!=12){
																$hour = $i-12;
															}else{
																$hour = $i;
															}											
														}														
														if(strlen($i)==1){
															$valhour = "0".$i;
														}else{
															$valhour = $i;
														}
													}
													for($y=0;$y<4;$y++){
														if($y==0){
															$minutes = "00";
														}else{
															$minutes = $y*15;
														}
														echo "<option value='$valhour:$minutes'>$hour:$minutes $typehour</option>";														
													}
												}
										echo "
										</select>
									</td>
								</tr>
								<tr>
									<td style='padding-top:10px;width:70px;text-align:left;'>Timezone :</td>
									<td style='padding-top:10px;'>
										<select id='timezone' class='listsclass' style='width:150px'>
											<option value='-'>- Select Timezone -</option>
											<option value='EASTERN'>Eastern</option>
											<option value='CENTRAL'>Central</option>
											<option value='MOUNTAIN'>Mountain</option>
											<option value='PACIFIC'>Pacific</option>
											<option value='ALASKA'>Alaska</option>
											<option value='HAWAII'>Hawaii</option>
										</select>
									</td>
								</tr>
							</table>
						</div>
						<div style='clear:both'></div>
				        ";
				        echo "<div class='btnsend' onclick='sendemailblast()' style='float:right;margin-right:50px;'>SEND</div>";
				        echo "<div class='btnsend' onclick=closeconfirmation('list'); style='float:left;margin-left:50px;'>CANCEL</div>";
					}else{
						echo "<div style='margin-top:35px;margin-bottom:20px;'>You don't have any list to send the blast.</div>";
						echo "<div class='btnsend' onclick=closeconfirmation('exit'); style='float:right;margin-right:15px;'>EXIT</div>";
					}					
				?>					
			</div>
		</div>
		<!-- END POPUP SEND BLAST -->
		
		<!-- POPUP MULTIPLE EMAILS -->
		<?php
			if($statuslisttest==true){
				if($totlists==1){
					$style1 = "style='height:390px !important';margin-top:-195px !important;";
					$style2 = "style='height:340px !important'";	
				}else{
					$style1 = "style='height:430px !important';margin-top:-215px !important;";
					$style2 = "style='height:380px !important'";	
				}				
			}else{
				$style1 = "style='height:200px !important; margin-top:-100px !important;'";
				$style2 = "style='height:150px !important'";
			}
		?>
		<div class='popup' <?php echo $style1; ?> id='test'>
			<div class='inner-popup' <?php echo $style2; ?>>
				<span>ADD EMAILS</span>
				
				<?php
					if($statuslisttest==true){
						if($totlists>1){
							echo "<div style='margin-bottom:15px;margin-top:15px'>$liststest</div>";
						}						
						echo "
							<div style='margin-top:15px'><span style='font-size:15px;margin-left:-100px;'>New email:</span></div>
							<input type='text' name='newemail' id='newemail' value='' style='margin-top:5px;width:150px;height:20px;'/><br/>
							<div class='btnsend' onclick='addemail()'>ADD</div>	
							
							<div style='height: 160px;width: 250px;margin: auto;overflow-y:auto;'>
							<table class='temail' id='emails' cellspacing='0'>
								<tr id='titles'>
									<th width='220'>Email</th>
									<th></th>
								</tr>
							</table>
							</div>								
							<div class='btnsend' onclick='sendtestblast()' style='float:right;margin-right:10px;'>SEND</div>
							<div class='btnsend' onclick='canceltest()' style='float:right;margin-right:10px;'>CANCEL</div>
						";
					}else{
						echo "<div style='margin-top:35px;margin-bottom:20px;'>You don't have any list to send the blast.</div>";
						echo "<div class='btnsend' onclick=closeconfirmation('exit'); style='float:right;margin-right:15px;'>EXIT</div>";
					}					
				?>
			</div>
		</div>
		<input type="hidden" name="cont" id="cont" value="1" />
		<table class='loader'><tr><td></td></tr></table>
		<!-- END POPUP MULTIPLE EMAILS -->
		
		<!-- SEND TAB -->		
		<form action='lanewsletter.pro.php' id='formemail' method="post">
		<div class="emailsection" id="emailsection">
			<div style="color:rgb(126, 125, 125);">Subject:</div>
			<input type='text' name='emailsubject' id='emailsubject' value='' style='width:150px;height:20px;' /><br>
			<input type="hidden" name="titleemail" id="titleemail" value="" />
			<input type="hidden" name="type" id="type" value="email" />
			<input type="hidden" name="list" id="list" value="<?php echo $listsvalue; ?>" />
			<input type="hidden" name="listna" id="listna" value="" />
			<input type='hidden' name='removedevents2' id='removedevents2' value='<?php echo $deletedevents; ?>' />
			<input type="hidden" name="schedate" id="schedate" value="" />
			<input type="hidden" name="schetime" id="schetime" value="" />
			<input type="hidden" name="schezone" id="schezone" value="" />
			<input type='hidden' name='htmlcode2' id='htmlcode2' value='' />
			<div class='btnsend' onclick="sendblast()">SEND</div>			
		</div>
		</form>
		<div class="btnshow" id='btnshow' onclick='bshow()' style='margin-left:202px'>SEND EMAIL<br>STEP 3</div>		
		<!-- END SEND TAB -->
				
		<!-- TEST TAB -->
		<form action='lanewsletter.pro.php' id='formtest' method="post">
		<div class="emailsection" id="testsection" style='margin-left: 100px;'>
			<div style="color:rgb(126, 125, 125);">Subject:</div>
			<input type='text' name='emailsubject' id='testsubject' value='' style='width:150px;height:20px;' /><br>
			<input type="hidden" name="arremails" id="arremails" value="" />
			<input type="hidden" name="titletest" id="titletest" value="" />
			<input type="hidden" name="list" id="list2" value="<?php echo $listsvalue; ?>" />
			<input type="hidden" name="listna" id="listna2" value="" />		
			<input type="hidden" name="type" id="type" value="test" />
			<input type='hidden' name='htmlcode' id='htmlcode' value='' />		
			<input type='hidden' name='removedevents1' id='removedevents1' value='<?php echo $deletedevents; ?>' />
			<div class='btnsend' onclick="testblast()">ADD EMAIL</div>
		</div>
		</form>
		<div class="btnshow" id='btntest' onclick='btest()' style='margin-left: 110px;'>SEND TEST<br>STEP 2</div>
		<!-- END TEST TAB -->
		
		<!-- CUSTOMIZE TAB -->
		<div class="customizesection" id='customizesection'>
			<div style='color:rgb(126, 125, 125);text-align:center;padding-top:5px;'>Title:</div>
			<textarea id='titlearea' style="width: 230px;height: 50px;resize: none;"></textarea>				
			<div class="btnsend" id='btnsend' onclick='bsave()'>SAVE</div>
		</div>
		<div class="btncustomize" id='btncustomize' onclick='bcustomize()' style='margin-left: 18px;'>CUSTOMIZE<br>STEP 1</div>
		<!-- END CUSTOMIZE TAB -->			
		
		<!-- LOGOUT TAB -->
		<form action='lanewsletter.logout.php' method="post">
			<div class="btnshow" id='btnloglout' onclick='submit()' style="margin-left:294px;padding-top:10px;height:25px;">LOGOUT</div>
		</form>
		<!-- END LOGOUT TAB -->
		
		<!-- VARIABLES TO CONTROL TAB -->
		<input type='hidden' id='controltest' value='show' />
		<input type='hidden' id='controlheader' value='show' />
		<input type='hidden' id='controlcustom' value='show' />
		<!-- END VARIABLES TO CONTROL TAB -->
		
		<div id='maincontent'>
		<?php
			include_once("../laevents.inc.php");
		?>	
		</div>		
			<script type="text/javascript">			
				jQuery('.listsclass').chosen({allow_single_deselect:true});
			</script>
			</body>
</html>
