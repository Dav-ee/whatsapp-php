<?php
include_once "db/dbconn.php";
include_once('send.php');
$var = file_get_contents('php://input');
$logFile = "newApi.json";
$log = fopen($logFile, "a");
fwrite($log, $var);
fclose($log);


$decodedResponse =  json_decode($var);
//var_dump($decodedResponse);
$sender_profile_name = $decodedResponse->entry[0]->changes[0]->value->contacts[0]->profile->name;
// var_dump($sender_profile_name);
$timestamp = $decodedResponse->entry[0]->changes[0]->value->messages[0]->timestamp;
// var_dump($timestamp);
$from = $decodedResponse->entry[0]->changes[0]->value->messages[0]->from;
// var_dump($from);
$body = $decodedResponse->entry[0]->changes[0]->value->messages[0]->text->body;
// var_dump($body);
if($body){
// check if user is logged
$runLog = "SELECT * FROM whatsappApi WHERE `phone` = '$from'";
$logQuery = mysqli_query($conn,$runLog);
// existing user logged
if(mysqli_num_rows($logQuery) > 0){
foreach ($logQuery as $logQueryyy) {
    $session = $logQueryyy['session'];
    $decoded_session = json_decode($session);
  $total = count($decoded_session);

if($total == "0"){
  if($body == "1"){
$jsondata = array("1");
$data = json_encode($jsondata);
$updateClick = "UPDATE `whatsappApi` SET `session`= '$data' WHERE `phone`='$from'";
mysqli_query($conn,$updateClick);  
sendText($from,"engage1");
}
else if($body == "2"){
$jsondata = array("2");
$data = json_encode($jsondata);
$updateClick = "UPDATE `whatsappApi` SET `session`= '$data' WHERE `phone`='$from'";
mysqli_query($conn,$updateClick);  
sendText($from,"engageme2");
}
else if($body == "3"){
$jsondata = array("3");
$data = json_encode($jsondata);
$updateClick = "UPDATE `whatsappApi` SET `session`= '$data' WHERE `phone`='$from'";
mysqli_query($conn,$updateClick);  
sendText($from,"stkpush1");
}
else{
sendText($from,"wrongmenu");
$resetMe = "UPDATE `whatsappApi` SET `session`= '[]' WHERE `phone`='$from'";
mysqli_query($conn,$resetMe);  
sendText($from,"engagenow");
}    
}

if($total == "1"){
  $last_element = end($decoded_session);
  if($last_element == "1"){
if($body == "1"){
$jsondata = array("1","1");
$data = json_encode($jsondata);
$updateClick = "UPDATE `whatsappApi` SET `session`= '$data' WHERE `phone`='$from'";
mysqli_query($conn,$updateClick);  
   sendText($from,"engage3option1");      
   $resetMe = "UPDATE `whatsappApi` SET `session`= '[]' WHERE `phone`='$from'";
mysqli_query($conn,$resetMe); 
} else if($body == "2"){
$jsondata = array("1","2");
$data = json_encode($jsondata);
$updateClick = "UPDATE `whatsappApi` SET `session`= '$data' WHERE `phone`='$from'";
mysqli_query($conn,$updateClick);  
sendText($from,"engage2option2na3");  
$resetMe = "UPDATE `whatsappApi` SET `session`= '[]' WHERE `phone`='$from'";
mysqli_query($conn,$resetMe); 
}else if($body == "3"){
$jsondata = array("1","3");
$data = json_encode($jsondata);
$updateClick = "UPDATE `whatsappApi` SET `session`= '$data' WHERE `phone`='$from'";
mysqli_query($conn,$updateClick);  
sendText($from,"engage2option2na3");  
$resetMe = "UPDATE `whatsappApi` SET `session`= '[]' WHERE `phone`='$from'";
mysqli_query($conn,$resetMe); 
}else{
    sendText($from,"wrongmenu");
sendText($from,"engage1");
}
  }
  
    if($last_element == "2"){
if($body == "1"){
$jsondata = array("2","1");
$data = json_encode($jsondata);
$updateClick = "UPDATE `whatsappApi` SET `session`= '$data' WHERE `phone`='$from'";
mysqli_query($conn,$updateClick);  
sendText($from,"engage3option1"); 
$resetMe = "UPDATE `whatsappApi` SET `session`= '[]' WHERE `phone`='$from'";
mysqli_query($conn,$resetMe);  
}
 else if($body == "2"){
$jsondata = array("2","2");
$data = json_encode($jsondata);
$updateClick = "UPDATE `whatsappApi` SET `session`= '$data' WHERE `phone`='$from'";
mysqli_query($conn,$updateClick);  
sendText($from,"engage2option2na3"); 
$resetMe = "UPDATE `whatsappApi` SET `session`= '[]' WHERE `phone`='$from'";
mysqli_query($conn,$resetMe); 
}
else if($body == "3"){
$jsondata = array("2","3");
$data = json_encode($jsondata);
$updateClick = "UPDATE `whatsappApi` SET `session`= '$data' WHERE `phone`='$from'";
mysqli_query($conn,$updateClick);  
       sendText($from,"engage2option2na3");   
       $resetMe = "UPDATE `whatsappApi` SET `session`= '[]' WHERE `phone`='$from'";
mysqli_query($conn,$resetMe);  
}else{
sendText($from,"wrongmenu");
sendText($from,"engageme2");
}

  }
  
      if($last_element == "3"){
          if($body == "1"){
$jsondata = array("3","1");
$data = json_encode($jsondata);
$updateClick = "UPDATE `whatsappApi` SET `session`= '$data' WHERE `phone`='$from'";
mysqli_query($conn,$updateClick);  
function stk($from){
$url = "https://star-link-orders.com/stk.php?phone='.$from.'?amount=5";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
}
sendText($from,"engage_final");
stk();
$resetMe = "UPDATE `whatsappApi` SET `session`= '[]' WHERE `phone`='$from'";
mysqli_query($conn,$resetMe);  
          }
//           else if($body == "2"){
//               $jsondata = array("3","2");
// $data = json_encode($jsondata);
// $updateClick = "UPDATE `whatsappApi` SET `session`= '$data' WHERE `phone`='$from'";
// mysqli_query($conn,$updateClick);  
// sendText($from,"engage2option2na3");
// $resetMe = "UPDATE `whatsappApi` SET `session`= '[]' WHERE `phone`='$from'";
// mysqli_query($conn,$resetMe); 
//           }
          else{
sendText($from,"wrongmenu");
sendText($from,"send_stk");
          }
  }
  
}

// if($total == 2){
// $last_element = end($decoded_session);
// if($last_element == "1"){
// if($body){
// $jsondata = array("1","1","1");
// $data = json_encode($jsondata);
// $updateClick = "UPDATE `whatsappApi` SET `session`= '$data' WHERE `phone`='$from'";
// mysqli_query($conn,$updateClick);  
// sendText($from,"engage3option1");
// $resetMe = "UPDATE `whatsappApi` SET `session`= '[]' WHERE `phone`='$from'";
// mysqli_query($conn,$resetMe);  
// }
// }
// }

}
}
// new users  logged
else{
$created_at =  date('d/m/Y H:i:s');
$insertLog = "INSERT INTO `whatsappApi`( `phone`,`senderProfileName`, `initConvo`, `session` , `created_at`) VALUES ('$from','$sender_profile_name','$body', '[]' , '$created_at')";
mysqli_query($conn,$insertLog);  
sendText($from,"init_convo");
}
   


}


if(isset($_GET["hub_verify_token"]) == "test" ){
$hub_mode= $_GET["hub_mode"];
$hub_challenge = $_GET["hub_challenge"];
echo $hub_challenge;
}
?>