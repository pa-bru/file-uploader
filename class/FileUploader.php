<?php
/*
 * FileUploader
 * @author  pa-bru
 * @version 1.0
 * @url http://pa-bru.fr
 */

class FileUploader {

    /*
     * USER PARAMS :
     */
    protected $contentDir;
    protected $tmpFile;
    protected $fileName;
    protected $fileExtension;
    protected $width;
    protected $height;
    protected $maxSize;
    protected $allowedExts = array();
    protected $path;

    /*
     * Defaults params :
     */
    protected $defaultAllowedExts = array('jpg', 'jpeg', 'gif', 'png', 'pdf', 'xlsx', 'xls', 'doc', 'docx', 'ppt', 'pptx');
    const DEFAULT_HEIGHT = 300;
    const DEFAULT_WIDTH = 300;
    const DEFAULT_MAX_SIZE = 1000000000;
    const DEFAULT_CONTENT_DIR = "fu_uploads/";

    public function __construct($file, $args = array()){
    	/*
	     * delete empty strings, and all false values when converted in boolean from the array:
	     */
    	$args = array_filter($args);
        $defaultParams =  array(
        	"fileName" => null, 
        	"contentDir" => self::DEFAULT_CONTENT_DIR, 
        	"width" => self::DEFAULT_WIDTH , 
        	"height" => self::DEFAULT_HEIGHT,
        	"maxSize" => self::DEFAULT_MAX_SIZE,
        	"allowedExts" => $this->defaultAllowedExts,
        	);



        /*
         * merge missing params with default params to init the FileUploader object :
         */
        $args = array_merge($defaultParams, $args);
        $this->setProperties($file, $args);
    }
    


    /*
     * SETTERS :
     */

    protected function setProperties($file, $args = null){
        $this
            ->setTmpFile($file)
            ->setFileName($args["fileName"])
            ->setContentDir($args["contentDir"])
            ->setAllowedExts($args["allowedExts"])
            ->setMaxSize($args["maxSize"])
            ->setWidth($args["width"])
            ->setHeight($args["height"])
            ->setPath();
        return $this;
    }

    public function setTmpFile($file){
        $this->tmpFile = $file;
        return $this;
    }


    public function setFileName($filename = null){
        if($filename == null){
            $this->fileName = md5(uniqid(time(), true));
        } else{
            $this->fileName = $this->renameFile($filename);
        }
        return $this;
    }

    protected function renameFile($filename){
    	$filename = strtolower($filename);
    	$filename = str_replace(' ', '_', $filename);
    	$filename = mb_ereg_replace("([^\w\s\d\~,;\[\]\(\)])", '', $filename);
    	return $filename;
    }

    public function setContentDir($contentDir){
        $contentDir =  rtrim($contentDir, "/") . "/";
        $this->contentDir = $contentDir;
        return $this;
    }

    protected function addContentDir($contentDir){
    	if(!file_exists($contentDir)){
            mkdir($contentDir);
        }
    }

    public function setAllowedExts(array $exts){
        $this->allowedExts = $exts;
        return $this;
    }

    public function setMaxSize($size){
        $this->maxSize = $size;
        return $this;
    }

    public function setWidth($width){
        if(is_int((int)$width)){
            $this->width = $width;
            return $this;
        }
        return false;
    }

    public function setHeight($height){
        if(is_int((int)$height)){
            $this->height = $height;
            return $this;
        }
        return false;
    }

    protected function setPath(){
        $this->path = $this->contentDir . $this->fileName . '.'. $this->getFileExtension();
        return $this;
    }

    /*
     * GETTERS :
     */
    public function getFileExtension(){
        $infoFile = pathinfo($this->tmpFile['name']);
        $this->fileExtension = strtolower($infoFile['extension']);
        return $this->fileExtension;
    }

    public function getPath(){
        return $this->path;
    }

    public function getHeight(){
    	return $this->height;
    }

    public function getWidth(){
    	return $this->width;
    }
    public function getMaxSize(){
    	return $this->maxSize;
    }

    public function getContentDir(){
    	return $this->contentDir;
    }

    public function getFileName(){
    	return $this->fileName;
    }

    public function getTmpFile(){
    	return $this->tmpFile;
    }

    public function getAllowedExts(){
    	return $this->allowedExts;
    }


    /*
     * EXEC UPLOAD :
     */

    public function upload(){
        if($this->isFileClean($this->tmpFile) &&  is_uploaded_file($this->tmpFile['tmp_name'])){
            if($this->isGoodSize()){
                if($this->isAllowedExtension($this->getFileExtension())){
                    //create the folder if it not exists 
                    $this->addContentDir($this->getContentDir());
                    if($this->isNotImg($this->getFileExtension())){
                        if($this->upFile($this->tmpFile['tmp_name'], $this->path)){
                            return $this->path;
                        }
                        throw new \Exception('File upload failed');

                    } else{
                        if($this->upImg($this->tmpFile['tmp_name'], $this->width, $this->height, $this->getFileExtension(), $this->path)){
                            return $this->path;
                        }
                        throw new \Exception('Image upload failed');
                    }
                }
                throw new \Exception('File extension is not allowed');
            }
            throw new \Exception('Size of file exceeds the maximum size allowed');

        }
        throw new \Exception('File upload failed');
    }

    protected function upFile($tmpFile, $path){
        if (move_uploaded_file($tmpFile,$path)) {
            return $path;
        }
        return false;
    }

    protected function upImg($tmpFile, $width, $height, $fileExtension, $path){
        $origin_size = getimagesize($tmpFile);

        $wRatio = $width / $origin_size[0];
        $hRatio = $height / $origin_size[1];
        
        $ratio = min($wRatio, $hRatio);

        $new_width = $origin_size[0] * $ratio;    
        $new_height = $origin_size[1] * $ratio; 

        switch ($fileExtension) {
            case 'jpeg':
            case 'jpg':
                $origin_file = imagecreatefromjpeg($tmpFile);//retourne un identifiant d'image repr�sentant une image obtenue � partir du fichier filename.
                $new_img = imagecreatetruecolor($new_width , $new_height);// creer une nouvelle image avec les dimensions qu'on veut (elle est vide CAD noire)
                imagecopyresized($new_img , $origin_file, 0, 0, 0, 0, $new_width, $new_height, $origin_size[0],$origin_size[1]);//fout les bonnes dimensions dans la nouvelle image

                if(imagejpeg($new_img, $path, 100)){//enregistre, d�place vers le dossier voulu et renomme l'img.
                    imagedestroy($origin_file);
                    return true;
                }
                return false;
               
                break;
            case 'png':
                $origin_file = imagecreatefrompng($tmpFile);//retourne un identifiant d'image repr�sentant une image obtenue � partir du fichier filename.
                $new_img = imagecreatetruecolor($new_width , $new_height);// cr�er une nouvelle image avec les dimensions qu'on veut (elle est vide CAD noire)
                imagecopyresized($new_img , $origin_file, 0, 0, 0, 0, $new_width, $new_height, $origin_size[0],$origin_size[1]);//fout les bonnes dimensions dans la nouvelle image

                if(imagepng($new_img, $path, 100)){//enregistre, d�place vers le dossier voule et renomme l'img.
                    imagedestroy($origin_file);
                    return true;
                }
                return false;
                break;
            case 'gif':
                $origin_file = imagecreatefromgif($tmpFile);//retourne un identifiant d'image repr�sentant une image obtenue � partir du fichier filename.
                $new_img = imagecreatetruecolor($new_width , $new_height);// cr�er une nouvelle image avec les dimensions qu'on veut (elle est vide CAD noire)
                imagecopyresized($new_img , $origin_file, 0, 0, 0, 0, $new_width, $new_height, $origin_size[0],$origin_size[1]);//fout les bonnes dimensions dans la nouvelle image

                if(imagegif($new_img, $path)){//enregistre, d�place vers le dossier voule et renomme l'img.
                    imagedestroy($origin_file);
                    return true;
                }
				return false;
                break;
            default:
                return false;
                break;
        }
    }
    

    /*
     * TESTS :
     */
    protected function isFileClean($file){
        return isset($file) && $file['error'] == 0;
    }

    protected function isGoodSize(){
    	if($this->tmpFile["size"] <= $this->maxSize ){
    		return true;
    	} else{
    		return false;
    	}
    }

    protected function isAllowedExtension($fileExtension){
        return in_array($fileExtension, $this->allowedExts );
    }

    protected function isNotImg($ext){
        $notImgs = ['pdf', 'xlsx', 'xls', 'ppt', 'pptx', 'doc', 'docx', 'gif', 'svg'];
        return in_array($ext, $notImgs);
    }
}