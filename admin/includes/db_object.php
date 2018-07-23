<?php 

class Db_object
{
    

   public static function find_all($id = null){
       /*  global $database;

        $result_set = $database->query("SELECT * FROM users");
        return $result_set; */
        if(!empty($id)){
            return static::find_query("SELECT * FROM ". static::$db_table. " WHERE id = $id LIMIT 1");
        }else {
         return static::find_query("SELECT * FROM ".static::$db_table."");
        }
       

    }
    public static function find_by_id($id){
    

        $the_result_array = static::find_query("SELECT * FROM ". static::$db_table. " WHERE id = '$id' LIMIT 1");


       return !empty($the_result_array) ? array_shift($the_result_array) : false;
       
    }


    public static function find_query($sql){
        global $database;
        $result_set = $database->query($sql);
        $the_object_array  = [];

        while($row=mysqli_fetch_array($result_set)){
            $the_object_array[] = static::intantiation($row);
        }
        return $the_object_array;

    }

    
    public static function intantiation($found_user){
        //Late static binding!!!
        $calling_class = get_called_class();
        $the_object = new  $calling_class;
        foreach ($found_user as $property => $value) {
            if($the_object->has_the_attribute($property)){
                $the_object->$property = $value;
            }
        }

       
        return $the_object;
    }


    private function has_the_attribute($property){
        $object_properties = get_object_vars($this);
      return  array_key_exists($property,$object_properties);
    }

    
    protected function properties(){
        $properties = array();
          foreach (static::$db_table_fields as $db_field) {
             if(property_exists($this,$db_field)){
                $properties[$db_field] = $this->$db_field;
             }
          }
          return $properties;
    }

    protected function clean_properties(){
        global $database;
        $clean_properties = array();
        foreach ($this->properties() as $key => $value) {
            $clean_properties[$key] = $database->escape_string($value);
        }

        return $clean_properties;

    }

    public function save(){
       return isset($this->id) ? $this->update() : $this->create(); 
    }

    public function create(){
        global $database;
        $properties = $this->clean_properties();

        $sql = "INSERT INTO ". static::$db_table. "(".implode(",",array_keys($properties)) .")
                       VALUES ('". implode("','",array_values($properties)) ."')";

        
        if($database->query($sql)){
            $this->id = $database->the_insert_id();
            return true;
        }else{
            return false;
        }
       
    }


    public function update(){
        global $database;

        $properties = $this->clean_properties();
        $properties_pairs = array();

        foreach ($properties as $key => $value) {
            $properties_pairs[] = "{$key}='{$value}'";
        }

        $id =           $database->escape_string($this->id);
       
        $sql = "UPDATE ". static::$db_table." SET ";
        $sql .= implode(", ", $properties_pairs); 
           $sql .= " WHERE id = '$id'";
        
        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;       

    }

    public function delete(){
        global $database;
        $id =  $database->escape_string($this->id);
        

        $sql = "DELETE FROM ". static::$db_table." WHERE id =  '$id' LIMIT 1";
        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
 
       
    }

    public static function count_all(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$db_table;
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);

        return array_shift($row); 
    }

  
}
