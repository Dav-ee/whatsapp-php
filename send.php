<?php

// $from = "254745682815";
// $templateYY = "engagenow";

function sendText($from,$templateYY){
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://graph.facebook.com/v15.0/110521228566128/messages',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "messaging_product": "whatsapp",
    "to": '.$from.',
    "type": "template",
    "template": {
        "name": "'.$templateYY.'",
        "language": {
            "code": "en"
        }
    }
}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer here...',
    'Content-Type: application/json'
  ),
));
$response = curl_exec($curl);
curl_close($curl);
echo $response;
}
?>