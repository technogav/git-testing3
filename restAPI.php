<?php

class CRUDClass {
     //create constant variables that will hold the database credentials
    const DB_HOST = 'localhost';
    const DB_NAME = 'browns';      //'browns'  'responsi_browns'
    const DB_USER = 'root';        //'root'    'responsi_gavin'    
    const DB_PASSWORD = '';        //''        'T^Wyc_g7LsXX'
    
    // use a constructor to open a database conection    
    public function __construct() {
        // create a neat formatted string to pass to the PDO object using the credentials above
        $conStr = sprintf("mysql:host=%s;dbname=%s;charset=utf8", self::DB_HOST, self::DB_NAME);
 
        try {
            $this->pdo = new PDO($conStr, self::DB_USER, self::DB_PASSWORD);
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    //use destruct magic method to kill the database object
    public function __destruct() {
        $this->pdo = null;
    }
 

    
function dbRead($sql) {
        //use '$_GET' to take paramaters from the query string
        if(isset($_GET['sql'])){
             //make a variable using the sql=... in the query string
               $sql = $_GET['sql'];     
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
       
 
        return $resultSet;
    }
    
function dbDelete($sql){
       $stmt = $this->pdo->prepare($sql);
       try{
            $stmt->execute();
       }catch(Exception $e){
            $error_message = 'item was not deleted';
       }
       if(isset($error_message)){
          return $error_message;     
       }
       
}

function dbUpdate($image ){
     //REPLACE INTO my_table (pk_id, col1) VALUES (5, '123');
     $sql="Replace INTO splash (id, image) VALUES(1, '" . $image . "')"; 
     
     $stmt = $this->pdo->prepare($sql);
     /*$image = "'" . $image . "'";
     $stmt->bindParam(':image', $image , PDO::PARAM_LOB);//param large object*/
     return $stmt->execute();
      //try{
//            
//       }catch(Exception $e){
//            $error_message = 'item was not upddated';
//       }
//       if(isset($error_message)){
//          return $error_message;     
//       }
     }
function dbCreate($product_id, $product_name, $product_description, $binImgFile, $image_type, $price, $tag1, $tag2, $tag3) {
        
        //if contains blob type data
        
        $sql = "INSERT INTO products(product_id, product_name, product_description, image, image_type,price, tag1, tag2, tag3)"; 
        $sql .= "VALUES(:product_id, :product_name, :product_description, :image, :image_type, :price, :tag1, :tag2, :tag3)";
        
        $stmt = $this->pdo->prepare($sql);
 
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':product_description', $product_description);       
        $stmt->bindParam(':image', $binImgFile, PDO::PARAM_LOB);//param large object
        
        $stmt->bindParam(':image_type', $image_type );//param large object);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':tag1', $tag1);
        $stmt->bindParam(':tag2', $tag2);
        $stmt->bindParam(':tag3', $tag3);
 
        return $stmt->execute();
}
   
function dbCreateTool($image, $tool_make, $tool_name, $tool_desc, $day_price, $week_price){
        $sql = "INSERT INTO toolhire(image, tool_make, tool_name, tool_desc, day_price, week_price)"; 
        $sql .= "VALUES(:image, :tool_make, :tool_name, :tool_desc, :day_price, :week_price)";
        
        $stmt = $this->pdo->prepare($sql);
 
        $stmt->bindParam(':image', $image, PDO::PARAM_LOB);//param large object
        $stmt->bindParam(':tool_make', $tool_make);
        $stmt->bindParam(':tool_name', $tool_name);       
        $stmt->bindParam(':tool_desc', $tool_desc);
        $stmt->bindParam(':day_price', $day_price );//param large object);
        $stmt->bindParam(':week_price', $week_price);
        
        return $stmt->execute();
}
/*function updateBlob($id, $filePath, $mime) {
 
        $blob = fopen($filePath, 'rb');
 
        $sql = "UPDATE products 
                SET mime = :mime,
                    data = :data
                WHERE id = :id;";
 
        $stmt = $this->pdo->prepare($sql);
 
        $stmt->bindParam(':mime', $mime);
        $stmt->bindParam(':data', $blob, PDO::PARAM_LOB);
        $stmt->bindParam(':id', $id);
 
        return $stmt->execute();
    }*/
    
    
 }  