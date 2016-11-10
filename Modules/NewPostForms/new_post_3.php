<?php

$keys = array();
$values = array();
$format = array();

foreach($_POST as $key=>$value){
	if($key != "post_submit"){
		//str_replace("Post", "", $key);
		$key = preg_replace("/Post/i","",$key);

		array_push($keys,$key);
		array_push($values,$value);

		if(is_numeric($values)){
			array_push($format,'%d');
		}else{
			array_push($format,'%s');
		}

	}else{
		break;
	}
}

array_push($keys, "OwnerId");	
array_push($values, $user->getId());
array_push($format, '%d');// push one %d because of owner id
$Post = array_combine($keys, $values); 


if(!$db->select("SELECT * FROM Post WHERE Name=? AND Description=? AND Category=? AND State=? AND Region=? AND Province=? AND PhoneNr=? AND Pic1=? AND Pic2=? AND Pic3=? AND Pic4=? AND Pic5=? AND MainPic=? AND VideoLink=? AND Date=? AND OwnerId=?",$values,$format)[0]){

	if($db->insert('Post',$Post,$format)){
		echo "<h3>Thank you! <br/>Post Inserted Successfully!!!</h3><a href='dashboard' > <-- GO BACK </a>";
	}else{
		echo "<h3>Sorry error occurred, please try again later.</h3><a href='dashboard' > <-- GO BACK </a>";
	}
}
else{
	echo "<h3>Sorry this post exists!!! Please enter a new post</h3><a href='dashboard' > <-- GO BACK </a>";
}
	
?>