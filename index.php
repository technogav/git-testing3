<?php

//process client request
header("Content-Type:application/json");

include('functions.php');

if(!empty($_GET['name'])){
 //
 
 $name=$_GET['name'];
 $price=get_price($name);
 
      if(empty($price)){
          deliver_response(404,"record not found",NULL);
              
      }else{
          //respond book price
           deliver_response(200,"record found",$price);
          echo $price ;
      }
      
 
}else{
 //throw
  deliver_response(400,"record not found2",NULL);    
}

function deliver_response($status,$status_message, $data){
     
     header("HTTP/1.1, $status,$status_message, $data");
     
     $response['status'] = $status;
     $response['status_message'] = $status_message;
     $response['data'] = $data;
     
     $json_response = json_encode($response);
     echo $json_response;
}
