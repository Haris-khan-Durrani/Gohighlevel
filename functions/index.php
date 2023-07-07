<?php
error_reporting(E_ALL ^ E_NOTICE);  

//fetching data from gohighlevel database contact form
$emai=$_GET['email'];
//for data fetching
$url="https://rest.gohighlevel.com/v1/forms/submissions?formId=tzzMp0Dj7TM2PzCo5lAo&q=".$emai;
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer 39e288db-aa90-4bec-abfb-b8b0b0515946'
  ),
));


$response = curl_exec($curl);

curl_close($curl);
$jded=json_decode($response);
//echo $jded->submissions->email;
//var_dump($jded);

$array = get_object_vars($jded->submissions[0]);
foreach($array as $key => $value) {
  echo $key . "<br>";

}



/*foreach($jded as $i)
{

  
  foreach( $i as $obj ){


    if($obj['email']!=""){
    echo "Email: ".$obj['email']."<br>ID: ".$obj['id']."<br> contactid: ".$obj['contactId']."<br> organization: ".$obj['organization'];
echo "<br>Page Source: "."<img src=".$obj['gRiljEYTvImy3ejD9uvZ']['a9f4d611-d8ad-4800-92ee-b88dd75ad2b0']['url']."><br>";


    
    }
    //echo $obj['id'];

  }


  
}
*/


//getting fields here
/*
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://rest.gohighlevel.com/v1/forms/submissions',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer 39e288db-aa90-4bec-abfb-b8b0b0515946'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response['submissions'][0];
echo $response;
$json=json_decode($response);

//echo array_shift(array_keys($jded));
//var_dump($jded);
$array = get_object_vars($json->submissions[0]);
foreach($array as $key => $value) {
//arraykey with value  
 //  echo $key . $array[$key] ."<br>";
//getting only keys
  echo $array['pageDetails']->leadsource . "<br>";
  //echo $key . "<br>";
}

*/
?>






