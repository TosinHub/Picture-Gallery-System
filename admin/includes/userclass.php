<?php  


class UserClass extends Db_object

{
    protected static $db_table = "users";
    protected static $db_table_fields  = array('username','password','first_name','last_name','user_image'); 
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name; 
    public $user_image;
    public $upload_directory = "images";
    public $image_placeholder = "http://placehold.it/400x400&text=Image"; 

   


    public function picture_path(){
        return empty($this->user_image)  ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image; 



    }



    public static function verify_user($a,$b){
        global $database;
        $username = $database->escape_string($a);
        $password = $database->escape_string($b);
        $sql = "SELECT * FROM ". static::$db_table . " WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";
        $the_result_array = self::find_query($sql);

        return !empty($the_result_array) ? array_shift($the_result_array) : false;
       
  


    }


    public function ajax_save_user_image($user_image, $user_id){
        global $database;


        $this->user_image = $database->escape_string($user_image);
        $this->id = $database->escape_string($user_id);
        
        $sql = "UPDATE " . self::$db_table. " SET user_image = '{$this->user_image}' ";
        $sql .= " WHERE id = {$this->id} ";
        $update_image = $database->query($sql);


        echo $this->picture_path();
    }




}//End of User Class
