function bshow(){
  var statustest = $("#statust").val();	
	if(statustest=="true"){				
		var control2 = $("#controlheader").val();
		if(control2=="show"){
			hidehide("email");
			$("#emailsection").animate({
				"margin-top": "0",
				"border-bottom": "1px solid rgb(204, 204, 204)",
				"border-right": "1ps solid rgb(204, 204, 204)"						
			}, 300);
			$("#btnshow").animate({
				"margin-top": "90px"
			}, 300);
			$("#controlheader").val("hide")
			$("#btnshow").html("HIDE");	
			$("#btnshow").css("height","20px");		
		}else{
			$("#emailsection").animate({
				"margin-top": "-90px",
				"border-bottom": "none",
				"border-right": "none"
			}, 300);					
			$("#btnshow").animate({
				"margin-top": "0"
			}, 300);
			$("#controlheader").val("show");
			$("#btnshow").html("SEND EMAIL<br>STEP 3");
			$("#btnshow").css("height","35px");
		}			
	}
	else{
		alert("You need to send a test email before you can send out your email campaign");
	}
}

function btest(){								
	var control2 = $("#controltest").val();
	if(control2=="show"){
		hidehide("test");
		$("#testsection").animate({
			"margin-top": "0",
			"border-bottom": "1px solid rgb(204, 204, 204)",
			"border-right": "1ps solid rgb(204, 204, 204)"						
		}, 300);
		$("#btntest").animate({
			"margin-top": "90px"
		}, 300);
		$("#controltest").val("hide")
		$("#btntest").html("HIDE");
		$("#btntest").css("height","20px");
	}else{
		$("#testsection").animate({
			"margin-top": "-90px",
			"border-bottom": "none",
			"border-right": "none"
		}, 300);					
		$("#btntest").animate({
			"margin-top": "0"
		}, 300);
		$("#controltest").val("show");
		$("#btntest").html("SEND TEST<br>STEP 2");
		$("#btntest").css("height","35px");
	}			
}

function bcustomize(){					
	var control2 = $("#controlcustom").val();
	if(control2=="show"){
		hidehide("customize");							
		$("#customizesection").animate({
			"margin-top": "0",
			"border-bottom": "1px solid rgb(204, 204, 204)",
			"border-right": "1ps solid rgb(204, 204, 204)"						
		}, 300);
		$("#btncustomize").animate({
			"margin-top": "130px"
		}, 300);
		$("#controlcustom").val("hide")
		$("#btncustomize").html("HIDE");
		$("#btncustomize").css("height","20px");
	}else{					
		$("#customizesection").animate({
			"margin-top": "-130px",
			"border-bottom": "none",
			"border-right": "none"
		}, 300);					
		$("#btncustomize").animate({
			"margin-top": "0"
		}, 300);					
		$("#controlcustom").val("show");
		$("#btncustomize").html("CUSTOMIZE<br>STEP 1");
		$("#btncustomize").css("height","35px");
	}			
}

function sendblast(){
	var subject = $("#emailsubject").val();
	if(subject!=""){
		$("#emailsection").animate({
			"margin-top": "-90px",
			"border-bottom": "none",
			"border-right": "none"
		}, 300);					
		$("#btnshow").animate({
			"margin-top": "0"
		}, 300);
		$("#controlheader").val("show");
		$("#btnshow").css("height","35px");
		$("#btnshow").html("SEND EMAIL<br>STEP 3");
		
		$(".loader").css("display","inline-block");
		$("#confirm").css("display","inline-block");
	}else{
		alert("Please type a subject.");
	}			
}

function testblast(){
	var subject = $("#testsubject").val();
	if(subject!=""){
		$("#testsection").animate({
			"margin-top": "-90px",
			"border-bottom": "none",
			"border-right": "none"
		}, 300);					
		$("#btntest").animate({
			"margin-top": "0"
		}, 300);
		$("#btntest").css("height","35px");
		$("#controltest").val("show");
		$("#btntest").html("SEND TEST<br>STEP 2");
		
		$(".loader").css("display","inline-block");
		$("#test").css("display","inline-block");
	}else{
		alert("Please type a subject.");
	}
}

function bsave(){
	var title = $("#titlearea").val();			
	$("#customtitle").html(nl2br(title));
	$("#titletest").val(nl2br(title));
	$("#titleemail").val(nl2br(title));
	$("#customizesection").animate({
		"margin-top": "-130px",
		"border-bottom": "none",
		"border-right": "none"
	}, 300);					
	$("#btncustomize").animate({
		"margin-top": "0"
	}, 300);
	$("#btncustomize").css("height","35px");
	$("#controlcustom").val("show");
	$("#btncustomize").html("CUSTOMIZE<br>STEP 1");
}

function hidehide(active){				
	if(active=="email"){
		$("#testsection").animate({
			"margin-top": "-90px",
			"border-bottom": "none",
			"border-right": "none"
		}, 300);					
		$("#btntest").animate({
			"margin-top": "0",
			"height": "35px"
		}, 300);
		$("#controltest").val("show");
		$("#btntest").html("SEND TEST<br>STEP 2");
		
		$("#customizesection").animate({
			"margin-top": "-130px",
			"border-bottom": "none",
			"border-right": "none"
		}, 300);					
		$("#btncustomize").animate({
			"margin-top": "0",
			"height": "35px"
		}, 300);
		$("#controlcustom").val("show");
		$("#btncustomize").html("CUSTOMIZE<br>STEP 1");
	}
	if(active=="test"){
		$("#emailsection").animate({
			"margin-top": "-90px",
			"border-bottom": "none",
			"border-right": "none"
		}, 300);					
		$("#btnshow").animate({
			"margin-top": "0",
			"height": "35px"
		}, 300);
		$("#controlheader").val("show");
		$("#btnshow").html("SEND EMAIL<br>STEP 3");
		
		$("#customizesection").animate({
			"margin-top": "-130px",
			"border-bottom": "none",
			"border-right": "none"
		}, 300);					
		$("#btncustomize").animate({
			"margin-top": "0",
			"height": "35px"
		}, 300);
		$("#controlcustom").val("show");
		$("#btncustomize").html("CUSTOMIZE<br>STEP 1");
	}
	if(active=="customize"){
		$("#emailsection").animate({
			"margin-top": "-90px",
			"border-bottom": "none",
			"border-right": "none"
		}, 300);					
		$("#btnshow").animate({
			"margin-top": "0",
			"height": "35px"
		}, 300);
		$("#controlheader").val("show");
		$("#btnshow").html("SEND EMAIL<br>STEP 3");
		
		$("#testsection").animate({
			"margin-top": "-90px",
			"border-bottom": "none",
			"border-right": "none"
		}, 300);					
		$("#btntest").animate({
			"margin-top": "0",
			"height": "35px"
		}, 300);
		$("#controltest").val("show");
		$("#btntest").html("SEND TEST<br>STEP 2");
	}				
}

function nl2br (str, is_xhtml) {
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

function addemail(){
	var cont = $("#cont").val();
	var email = $("#newemail").val();	
	if(email!=""){
		if(validatemail(email) ==true){
			var newemail = "<tr id='"+cont+"' email='"+email+"'><td>"+email+"</td><td style='width:50px;text-align:left;'><img id='img"+cont+"' src='http://urmaster.com/imateq/map/cancel-btn2.png' width='20' height='20' onclick='removemail(this.id)' style='cursor:pointer'/></td></tr>";			$("#emails").append(newemail);
			var arremail = $("#arremails").val();
			arremail+=email+",";
			$("#arremails").val(arremail);
			$("#newemail").val("");
			cont++;
			$("#cont").val(cont);
		}else{
			alert("Type a correct email.");
		}
	}else{
		alert("Type an email.");
	}	
}

function removemail(email){	
	var rmemail = email.substr(3);
	var arremails = $("#arremails").val();
	arremails = arremails.substr(0, arremails.length-1);
	arremails = arremails.split(",");
	var newarr = "";
	for(i=0; i<arremails.length;i++){
		var atemail = $("#"+rmemail).attr("email");			
		if(arremails[i]!=atemail){
			newarr+=arremails[i]+",";
		}
	}	
	$("#arremails").val(newarr);
	$("#"+rmemail).remove();
	var cont = $("#cont").val();
	$("#cont").val(cont-1);
}

function canceltest(){
	$("#testsubject").val("");
	$("#arremails").val("");
	$('#mylist2').val(0);
    $('#mylist2').trigger("liszt:updated");
    $("#list2").val("");
	tot = $("#cont").val();
	for(i=1;i<tot;i++){
		$("#"+i).remove();
	}
	$("#cont").val("1");
	$(".loader").css("display","none");
	$(".popup").css("display","none");
}

function closeconfirmation(type){
	if(type=='list'){
		$('#mylist').val(0);
        $('#mylist').trigger("liszt:updated");
		$("#list").val("");
		$('#datetime').val(0);
		$('#datetime').find('option:first-child').prop('selected', true).end().trigger('liszt:updated');
        $('#timezone').val(0);
        $('#timezone').trigger("liszt:updated");
		$("#datepicker").val("");
		
		var radio = $("input[name=optshce]:checked").val();
		if(radio=="sch"){
			$("#optshce2").attr("checked", false);	
			$("#optshce1").attr("checked", true);	
			schedule("now");
		}
	}
	$("#emailsubject").val("");
	$("#testsubject").val("");
	$(".loader").css("display","none");
	$(".popup").css("display","none");
}

function sendtestblast(){
	var emails = $("#arremails").val();
	var list = $("#mylist2").val();
	if(list!=0){
		if(emails!=""){
			var deleted = $("#removedevents").val();
			$("#removedevents1").val(deleted);
			$("#formtest").submit();
		}else{
			alert("Please type at least 1 email.");
		}	
	}else{
		alert("Please select a list.");
	}
}

function sendemailblast(){	
	var type = $("input[name=optshce]:checked").val();
	var list = $("#mylist").val();
	var picker = $("#datepicker").val();
	var time = $("#datetime").val();
	var zone = $("#timezone").val();
	var submit=true;
	if(type=='now'){
		if(list==0){
			submit = false;
		}
	}else{
		if(list==0||picker==""||time==0||zone=="-"){
			submit = false;
			alert("Please fill all the info");
		}		
	}
	if(submit == true){		
		//alert("Sorry, this option is disabled by the moment.");	
		var deleted = $("#removedevents").val();
		$("#removedevents2").val(deleted);
		$("#schedate").val(picker);
		$("#schetime").val(time);
		$("#schezone").val(zone);
		$("#formemail").submit();		
	}	
}

function selectlist(listid){
	$("#list").val(listid);	
	var listname = $("#"+listid).attr("listname");
	$("#listna").val(listname);	
}

function selectlist2(listid){
	$("#list2").val(listid);	
	var listname = $("#"+listid).attr("listname");
	$("#listna2").val(listname);	
}

function validatemail(email){
	var pattEmail = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	if(pattEmail.test(email)== false) {		
		return false;	
	}else{
		return true;
	}
}

function addevents(){
	var removed = $("#removedevents").val();
	if(removed==""){
		alert("There aren't events to add.");
	}else{
		removed = removed.split(",");
		$("input[type=checkbox]").attr('checked', true);
		$("input[type=checkbox]").attr('disabled', true);
		for(var i=0;i<removed.length;i++){			
			$("#"+removed[i]).attr('checked', false);
			$("#"+removed[i]).attr('disabled', false);			
		}
		$(".loader").css("display","inline-block");
		$("#addevents").css("display","inline-block");
	}
}

function removeevent(event){
	var removed = $("#removedevents").val();
	$("#btn-"+event).remove();
	$("#date-"+event).remove();
	$("#info-"+event).remove();
	if(removed!=""){
		$("#removedevents").val(removed+","+event);	
	}else{
		$("#removedevents").val(event);	
	}
}

function addnewevent(id){
	var events = $("#newevents").val();
	var deletedevents = $("#removedevents").val();

	if($("#"+id).is(":checked")){			
		if(events==""){
			$("#newevents").val(id);
		}else{
			$("#newevents").val(events+","+id);
		}
		
		var tmpevents = "";
		deletedevents = deletedevents.split(",");
		for(var i=0;i<deletedevents.length;i++){
			if(deletedevents[i]!=id){
				if(tmpevents==""){
					tmpevents += deletedevents[i];
				}else{
					tmpevents += ","+deletedevents[i];
				}				
			}
		}
		$("#removedevents").val(tmpevents);
	}else{
		var tmpevents = "";
		events = events.split(",");
		for(var i=0;i<events.length;i++){			
			if(events[i]!=id){
				if(tmpevents==""){
					tmpevents += events[i];
				}else{
					tmpevents += ","+events[i];
				}				
			}
		}
		$("#newevents").val(tmpevents);
		
		
		if(deletedevents==""){
			$("#removedevents").val(id);
		}else{
			$("#removedevents").val(deletedevents+","+id);
		}
	}	
}

function closeaddevents(){
	$(".loader").css("display","none");
	$(".popup").css("display","none");
}

function addnewsevents(){
	var events = $("#newevents").val();
	if(events==""){
		alert("Select at least 1 event to add.");
	}else{
		$("#formevents").submit();
	}
}

function schedule(type,total){
	if(total>1){
		if(type=="now"){
			$("#schedule").css("display","none");
			$(".inner-popup").css("height","175px");
			$(".popup").css("height","225px");
			$(".popup").css("margin-top","-112px");
		}else{
			$("#schedule").css("display","inline-block");
			$(".inner-popup").css("height","290px");
			$(".popup").css("height","340px");
			$(".popup").css("margin-top","-170px");
		}	
	}else{
		if(type=="now"){
			$("#schedule").css("display","none");
			$(".inner-popup").css("height","105px");
			$(".popup").css("height","155px");
			$(".popup").css("margin-top","-77px");
		}else{
			$("#schedule").css("display","inline-block");
			$(".inner-popup").css("height","220px");
			$(".popup").css("height","270px");
			$(".popup").css("margin-top","-135px");
		}	
	}	
}

function checktime(){
	var time = $('#datetime').val();
	if(time!=0){
		var date = $("#datepicker").val();
		var tmptoday = new Date();
		var month = tmptoday.getMonth()+1+"";if(month.length==1)  month="0" +month;
		var day = tmptoday.getDate()+"";if(day.length==1) day="0" +day;
		var today = month+"/"+day+"/"+tmptoday.getFullYear();	
		if(date==today){
			var newtime = tmptoday.getHours()+":"+tmptoday.getMinutes();		
			if(time<newtime){
				alert("Please select a correct time.");
				$('#datetime').val(0);
				$('#datetime').find('option:first-child').prop('selected', true).end().trigger('liszt:updated');
			}
		}	
	}	
}
