<?php
 $path = preg_replace( '/wp-content.*$/', '', __DIR__ );
 require_once( $path . 'wp-load.php' );

//     include "db.php";
global $wpdb;
$db_host = $wpdb->dbhost;
$db_user = $wpdb->dbuser;
$db_password = $wpdb->dbpassword;
$db_name = $wpdb->dbname;
$con = new mysqli($db_host, $db_user, $db_password, $db_name);




function updateSettings($did, $accessToken, $refreshToken,$con) {

$connection=$con;
  // Sanitize the input values before constructing the query
  $did = $did;
 
  $accessToken =$accessToken;
  $refreshToken =  $refreshToken;


  // Construct the update query
  $updateQuery = "UPDATE gohighsetting SET   access_token='$accessToken', refresh_token='$refreshToken' WHERE did='$did'";

  if (mysqli_query($con, $updateQuery)) {
    return "Settings updated successfully";
  } else {
    return "Error updating settings: " . mysqli_error($connection);
  }

  //mysqli_close($connection);
}
     
     
     
     
function getToken($clientId, $clientSecret, $refreshToken, $code, $redirectUri,$did,$con) {
  
  
  
  
}













$query="SELECT * FROM `gohighsetting`";
$run=mysqli_query($con,$query);
foreach($run as $i)
{
    //get Old Client ID Secret Code refresh token old one bearear token and redirect key
    
    $did= $i['did'];
    $refreshToken= $i['refresh_token'];
    $clientId=$i['client_id'];
    $clientSecret=$i['client_sec'];
    $code=$i['gkey'];
    $redirectUri = "https://api.ebmsportal.com/gh/code.php";
    
    
    if($clientSecret!=""){
  echo $did."<br>".$refreshToken."<br>".$clientId."<br>".$clientSecret."<br>".$code."<br>".$redirectUri;
  
 // /*
  $curl = curl_init();
  $postData = http_build_query([
    'client_id' => $clientId,
    'client_secret' => $clientSecret,
    'grant_type' => 'refresh_token',
    'code' => $code,
    'refresh_token' => $refreshToken,
    'user_type' => 'Location',
    'redirect_uri' => $redirectUri
  ]);
  curl_setopt_array($curl, [
    CURLOPT_URL => "https://services.leadconnectorhq.com/oauth/token",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $postData,
    CURLOPT_HTTPHEADER => [
      "Accept: application/json",
      "Content-Type: application/x-www-form-urlencoded"
    ],
  ]);
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  if ($err) {
    return "cURL Error #:" . $err;
  } else {
   $responseData = json_decode($response, true);
      $accessToken = $responseData['access_token'];
    $refreshToken = $responseData['refresh_token'];
        $did = $did;
  $accessToken =$accessToken;
  $refreshToken =  $refreshToken;
  $updateQuery = "UPDATE gohighsetting SET   access_token='$accessToken', refresh_token='$refreshToken' WHERE did='$did'";
  if (mysqli_query($con, $updateQuery)) {
    return "Settings updated successfully";
  } else {
    return "Error updating settings: " . mysqli_error($connection);
  }
  }
  //*/
   //curl stopped
   
   
   
   
    }
 
  
    
    
    

    
}








?>