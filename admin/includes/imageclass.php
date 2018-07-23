<?php

class ImageClass extends Db_object
{
   
    public $filename;
    public $type;
    public $size; 


    public $tmp_path;
    public $upload_directory = "images";
    public $errors = array();
    public $upload_errors_array = array(
        UPLOAD_ERR_OK  => "There is no error",
        UPLOAD_ERR_INI_SIZE  => "Upload Max size exceeded",
        UPLOAD_ERR_FORM_SIZE  => "Max file size exceeded",
        UPLOAD_ERR_PARTIAL  => "The uploaded file was partially uploaded",
        UPLOAD_ERR_NO_FILE  => "NO file was uploaded",
        UPLOAD_ERR_NO_TMP_DIR  => "Missing a temporary folder",
        UPLOAD_ERR_CANT_WRITE  => "Filed to write file to disk",
        UPLOAD_ERR_EXTENSION  => "A PHP extension stopped upload",


    );


 

    public function  upload_image($file){
            $this->filename = basename($file['name']);
              $this->tmp_path = $file['tmp_name'];
     
            if(empty($this->filename) || empty($this->tmp_path)){
                $this->errors[] = "the file was not available";
                return false;
            }

            $target_path = SITE_ROOT.DS.'admin'.DS.$this->upload_directory.DS.$this->filename;

            if(file_exists($target_path)){
             $this->errors[] = "The file {$this->filename} already exists";
             return false;
            
            }

            if(move_uploaded_file($this->tmp_path,$target_path)){
              
                    unset($this->tmp_path);
                  
                    return $this->filename;
                
            }else{
                $this->errors[] = "the file directory does not have permission";
                return false;
            }
    
        

    }
     

    
}

