<?php
define ('site_root',    realpath(dirname(__DIR__)).'/');
include(site_root.'Modules/DB.php');

class Post extends DB{

	public function __construct($owner_id){
		$this->OwnerId = $owner_id;

		parent::__construct('delimeta_gaypage','gaypage','delimeta_gaypage','hostingmysql330.register.it');

		$this->SelectAllPosts();//Select all posts from $this->OwnerId;
	}

	private function SelectAllPosts(){
		$this->AllPosts = parent::select("SELECT * FROM Post WHERE OwnerId = ? ORDER BY Date DESC", array($this->OwnerId), array("%d"));

	}//get all posts from database
	
	public function getPostsCount(){ 
		return count($this->AllPosts); 
	}

	public function getPostsId(){
		return array_column($this->AllPosts, 'Id'); 
	} 
	//Get Post Id

	public function getPostsName(){  
		return array_column($this->AllPosts, 'Name'); 
	}
	//Get Post Name

	public function getPostsDescription(){
		return array_column($this->AllPosts, 'Description'); 
	}
	//Get Post Description

	public function getPostsCategory(){
		return array_column($this->AllPosts, 'Category'); 
	}
	//Get Post Category

	public function getPostsState(){
		return array_column($this->AllPosts, 'State'); 
	}
	//Get Post State

	public function getPostsRegion(){
		return array_column($this->AllPosts, 'Region'); 
	}
	//Get Post Region

	public function getPostsProvince(){
		return array_column($this->AllPosts, 'Province'); 
	}
	//Get Post Province

	public function getPostsPhoneNr(){
		return array_column($this->AllPosts, 'PhoneNr'); 
	}
	//Get Post PhoneNr

	public function getPostsPic1(){
		return array_column($this->AllPosts, 'Pic1'); 
	}
	//Get Post Pic1

	public function getPostsPic2(){
		return array_column($this->AllPosts, 'Pic2'); 
	}
	//Get Post Pic2

	public function getPostsPic3(){
		return array_column($this->AllPosts, 'Pic3'); 
	}
	//Get Post Pic3

	public function getPostsPic4(){
		return array_column($this->AllPosts, 'Pic4'); 
	}
	//Get Post Pic4

	public function getPostsPic5(){
		return array_column($this->AllPosts, 'Pic5'); 
	} 
	//Get Post Pic5

	public function getPostsMainPic(){
		return array_column($this->AllPosts, 'MainPic'); 
	}
	//Get Post MainPic 

	public function getPostsVideoLink(){
		return array_column($this->AllPosts, 'VideoLink'); 
	}
	//Get Post VideoLink

	public function getPostsOwnerId(){
		return array_column($this->AllPosts, 'OwnerId'); 
	}
	//Get Post OwnerId

	public function getAllPosts(){
		return $this->AllPosts;
	}
	//get all posts matrix mode
}

?>