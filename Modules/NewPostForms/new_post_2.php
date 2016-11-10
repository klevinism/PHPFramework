
<script type="text/javascript" >
$(document).ready(function(){
   Dropzone.autoDiscover = false;
    $("#uploader").dropzone({
        addRemoveLinks: true,
        success: function (file, response) {
        	show_main_pic_options();
        	//var imgName = response;
            //console.log('Successfully uploaded :' + imgName);
        },	
        error: function (file, response) {
            //file.previewElement.classList.add("dz-error");
        }
    });
});

var x = 1;
function show_main_pic_options(){
	document.getElementById("main_pic").innerHTML += "<input type='radio' name='main_pic_choose' id='main_pic_choose_"+x+"' value="+x+"><label id='main_pic_choose'>"+x+"</label>";
	x++;
}
function doThis(){

	$("#PostMainPic").val($("input[name=main_pic_choose]:checked").val());
	$('#PostVideoLink').val($('#VideoLink').val());
	var alt_object = $(".dz-filename span");
	var img_cnt = 1;
	var vid_cnt = 1;
	if(alt_object.html() != null || alt_object.html() != ""){
		alt_object.each(function(){	
			if(isVideo($(this).html()) && $('#PostVideoLink').val()==""){
				if(vid_cnt > 1){

				}else{ 
					document.getElementById("PostVideoLink").value = $(this).html();
				}
				vid_cnt++;

			}
			else{
				if(img_cnt > 5){

				}else{ 
					document.getElementById("PostPic"+img_cnt).value = $(this).html();
				}
				img_cnt++;

			}
	});
	}else{
		//alert("no");
	}
	
	
	//alert(alt_name);
}

function isVideo(filename) {
    var ext = getExtension(filename);
    switch (ext.toLowerCase()) {
    case 'm4v':
    case 'avi':
    case 'mpg':
    case 'mp4':
    case 'flv':
    case 'wmv':
    case 'mpeg':
    case '3gp':

        // etc
        return true;
    }
    return false;
}

function getExtension(filename) {
    var parts = filename.split('.');
    return parts[parts.length - 1];
}

</script>

Please upload your photos and video here!<br/>

<!-- 1 -->
<link href="Uploader/css/dropzone.css" type="text/css" rel="stylesheet" />
 
<!-- 2 -->
<script src="Uploader/dropzone.min.js"></script>
<!-- 3 -->
<form action="Uploader/upload.php" class="dropzone" id="uploader" onclick="doThis()" >
</form>
<div id="main_pic">Choose main picture: </div>

<br/>
OR

<br/>
<input type="text" name="VideoLink" id="VideoLink" placeholder="Put link of video" style="width: 300px;" />

<form action="new_post?stp=3" method="POST">

<br/><br/>

<input type="hidden" name="PostName" id="PostName" value='<?=$_POST["PostName"]; ?>'>
<input type="hidden" name="PostDescription" id="PostDescription" value='<?=$_POST["PostDescription"]; ?>'>
<input type="hidden" name="PostCategory" id="PostCategory" value='<?=$_POST["PostCategory"]; ?>'>
<input type="hidden" name="PostState" id="PostState" value='<?=$_POST["PostState"]; ?>'>
<input type="hidden" name="PostRegion" id="PostRegion" value='<?=$_POST["PostRegion"]; ?>'>
<input type="hidden" name="PostProvince" id="PostProvince" value='<?=$_POST["PostProvince"]; ?>'>
<input type="hidden" name="PostPhoneNr" id="PostPhoneNr" value='<?=substr($_POST["PostPhoneNr"],0,10); ?>'>
<input type="hidden" name="PostPic1" id="PostPic1" >
<input type="hidden" name="PostPic2" id="PostPic2" >
<input type="hidden" name="PostPic3" id="PostPic3" >
<input type="hidden" name="PostPic4" id="PostPic4" >
<input type="hidden" name="PostPic5" id="PostPic5" >
<input type="hidden" name="PostMainPic" id="PostMainPic" value="1">
<input type="hidden" name="PostVideoLink" id="PostVideoLink" >
<input type="hidden" name="PostDate" id="PostDate" value="<?php echo time(); ?>";
<hr/>
<input type="submit" name="post_submit" id="post_submit" onclick="doThis();" value="Finish" style="height: 30px;width: 173px;margin-bottom: 3px;background-color: #2869A1;border: none;color: white;font-size: large;"><br>
<span id="PostFeedBack" style="color:red;"></span>
</form>

