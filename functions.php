<?php
function get_price($find){
     
     //get a record from the db
     //use CRUD class to query the db
     // $db = new CRUDCLASS;
     //$sql = "";
     //$books = $db->DBread($sql);
     $books=array(
          "java"=>299,
          "c"=>345, 
          "php"=>789
     );
     
     //if success return array
     
     //class Endpoint_one{
     foreach($books as $book=>$endpoint1){
          if($book == $find){
               //echo 3.1
               return $endpoint1;
               break;
          
          } 
     }
}
?>