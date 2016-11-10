<?php 
define ('site_root',realpath(dirname(__DIR__)).'/');

class CreateThumbnail{

   public function __construct($pathToImage, $pathToThumb, $thumbWidth){
    $this->PathImg = $pathToImage;
    $this->FileName = substr(strrchr($pathToImage, "/"),0);
    $this->PathThumb = $pathToThumb;
    $this->ThumbWidth = $thumbWidth;
  }

  private function OpenDirectory(){
    // open the directory
    $this->dir = opendir( $this->PathImg.$this->FileName );
    $this->ImgName = readdir( $this->dir.$this->FileName );
    
  } 

  private function CloseDirectory(){
    // close the directory 
    closedir( $this->dir );
  }

   public function createThumb(){

    $ext = pathinfo($this->FileName, PATHINFO_EXTENSION);
        
    switch($ext){    // load image and get image size 
        case 'jpg':
        case 'jpeg':
           $this->img = imagecreatefromjpeg( "{$this->PathImg}{$this->ImgName}" );
           break;
        case 'gif':
           $this->img = imagecreatefromgif( "{$this->PathImg}{$this->ImgName}" );
           break;
        case 'png':
           $this->img = imagecreatefrompng( "{$this->PathImg}{$this->ImgName}" );
           break; 
    }

    $width = imagesx( $this->img );
    $height = imagesy( $this->img );

    // calculate thumbnail size
    $new_width = $this->ThumbWidth;
    $new_height = floor( $height * ( $this->ThumbWidth / $width ) );

    // create a new temporary image
    $tmp_img = imagecreatetruecolor( $new_width, $new_height );

    // copy and resize old image into new image 
    imagecopyresized( $tmp_img, $this->img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

    // save thumbnail into a file
    if(imagepng( $tmp_img, "{$this->PathThumb}{$this->ImgName}" )){
      return true;
    }
    else{
      return false;
    }

  }

}

/*$filename = substr(strrchr($path, "/"), 1);
$thumb = new CreateThumbnail('../Uploader/uploads/images/himym_connect_banner.png',site_root.'Uploader/uploads/images/thumbnails/now.png',180);
$thumb->createThumb();*/
?>