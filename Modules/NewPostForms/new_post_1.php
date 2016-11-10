<script src="js/AuthFormScripts.js"></script>
<script type="text/javascript" >
function ContinuePost(form){
	var formid = form.id;
	var FeedBack = "";
	var cnt = 0;
	var formArr = $("#" + formid).serializeArray();
    $.each(formArr, function(i, field){
       if(field.name == 'PostPhoneNr'){
       	if((field.value != '')&&(parseInt(field.value))){
       		cnt++;
       	}else{
       		FeedBack = "Please enter a valid number";
       	}
       }
       else if(field.value != ''){
       	cnt++;
       }else{
       		FeedBack = "Please fill out all fields in the form";
       }
       //field.name + ":" + field.value + " ");
    });

    if(cnt == 7){
    	// good to go
    	form.submit();
    }
    else{
    	document.getElementById("PostFeedBack").innerHTML = FeedBack;
    }
	//Check all data if entered
	//submit form
	//form.submit();
}

function ChangeLocations(val,location, nxt_ref){
	AjaxCall("location="+location+"&value="+val, "php/ChangeLocations.php","POST",true,function(data){
			if(data.success){
				document.getElementById(nxt_ref).innerHTML = data.message;
			}
			else{
//				document.getElementById(nxt_ref+"").innerHTML = data.message;	
			}
		});
}
</script>
        <form id="new_post" action="new_post?stp=2" method="POST" onsubmit="ContinuePost(this);return false;" name="new_post" align="left">
        	<input type="text" name="PostName" id="PostName" placeholder="Name" autofocus="autofocus" style="margin-bottom: 3px;height: 25px;width: 352px;margin-bottom: 9px;"><span style="color:#AFAEAE;    margin-left: 10px;">     16 caratteri consentiti ! </span>
        	<br>
	    	<textarea name="PostDescription" id="PostDescription" placeholder="Description" style="  height: 185px;
  margin: 0px 0px 3px;
  width: 350px;
  resize:none;"></textarea>
	    	<br>
	    	<select name="PostCategory" id="PostCategory" style="width: 356px;height: 31px;margin-bottom: 9px;">
	    		<option value="">Category</option>
	    		<option value="gay">Gay</option>
	    		<option value="trans">Trans-Trav</option>
	    	</select>
	        <br>
	        <select name="PostState" onchange="ChangeLocations(this.value, 'States', 'PostRegion')" id="PostState" style="width: 356px;height: 31px;margin-bottom: 9px;">
	    		<option value="">State</option>
	    		<option value="it">Italy</option>
	    	</select>
	        <br>
	        <select name="PostRegion" onchange="ChangeLocations(this.value, 'Regions', 'PostProvince')" id="PostRegion"  style="width: 356px;height: 31px;margin-bottom: 9px;">
	        	<option value="">Region</option>
	        </select>
	        <br>
	        <select name="PostProvince" id="PostProvince" style="width: 356px;height: 31px;margin-bottom: 9px;">
	        	<option value=''>Province</option>
	        </select>
	        <br/>
	        <input type="text" name="PostPhoneNr" id="PostPhoneNr" placeholder="Phone number" autofocus="autofocus" style="margin-bottom: 3px;height: 25px;width: 352px;margin-bottom: 9px;">
	        <br/>
	        <input type="submit" name="post_submit" id="post_submit" value="Next" style="height: 30px;width: 173px;margin-bottom: 3px;background-color: #2869A1;border: none;color: white;font-size: large;"><br>
	        <span id="PostFeedBack" style="color:red;"></span>
	   	</form>