<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); 
//COUNT TOTAL FORMS IN GO HIGHLEVEL
;




//dashboard form count
/*
if($_GET['apikey'])
{
    $api=$_GET['apikey'];
    $curl = curl_init();

    curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://rest.gohighlevel.com/v1/forms/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$api
  ),        
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    //echo $response;
    $json=json_decode($response,true);
    $msghandle= $json['msg'];
    //echo $msghandle;
    if($msghandle === "Api key is invalid.")
    {
    echo "Your API is Invalid";
    }
    else{
    //$array = get_object_vars($json->forms[0]);
    $i=0;
    foreach($json['forms'] as $r)   
    {
    $i+=1;
    //echo $r['id']."<br>";
    //echo $json->forms[$i]->id;
    }
    echo $i;
}}
*/

/*
//dashboard total contact count
if($_GET['apikey2'])
{
$ap=$_GET['apikey2'];
$curl = curl_init();

    curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://rest.gohighlevel.com/v1/contacts/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$ap
  ),        
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    //echo $response;
    $json=json_decode($response,true);
    $msghandle= $json['msg'];
    //echo $msghandle;
    if($msghandle === "Api key is invalid.")
    {
    echo "Your API is Invalid";
    }
    else{
    //$array = get_object_vars($json->forms[0]);
    $i=0;
    foreach($json['contacts'] as $r)   
    {
    $i+=1;
    //echo $r['id']."<br>";
    //echo $json->forms[$i]->id;
    }
    echo $i;
}}
*/







//load form dropdown
if($_GET['loaddamnit'])
{
$k=$_GET['loaddamnit'];

//echo "<option>Select Your Form</option>";
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://rest.gohighlevel.com/v1/forms',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
   'Authorization: Bearer '.$k
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
$json=json_decode($response,true);
$msghandle= $json['msg'];
//echo $msghandle;
if($msghandle === "Api key is invalid.")
{
echo "Your API is Invalid";
}
else{
//$array = get_object_vars($json->forms[0]);
$i=0;
echo "<option>Select Your Form</option>";
foreach($json['forms'] as $r)
{
$i+=1;
//echo $r['id']."<br>";
echo "<option value='".$r['id']."'>".$r['name']."</option>";
}
//echo $i;

}

}


//get custom value with just one function
//variables meanings $customfieldid represent custom field id $key represent agency key and last fieldcheck is custom or not

/*function printcustom($customfieldid,$key,$fieldcheck)
{


}*/




?>