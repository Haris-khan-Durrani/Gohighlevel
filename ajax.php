<?php
//here we are going to imply our new code for ajax
//$con=mysqli_connect('localhost','ebmsbusi_wp855','-p5Sr2t(a0','ebmsbusi_wp855') ; 
 $path = preg_replace( '/wp-content.*$/', '', __DIR__ );
 require_once( $path . 'wp-load.php' );
 //include_once 'ajx.php';
     include "db.php";
if($_POST['shortid']){
    
    $id = $_POST['shortid'];
    
         
        error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); 

       $testmain=$_POST['email'];
//$current_user = wp_get_current_user();
$cidemail=$_POST['cidemail'];
$coidd=$_POST['contid'];

$dbfieldsetiign="Select * from `fieldshortcode` where `fid`='$id'";
$run=mysqli_query($con,$dbfieldsetiign);
$hold=mysqli_fetch_array($run);
$akey=$hold['akey'];


$getname="select * from gohighsetting where did='$akey'";
$kli=mysqli_query($con,$getname);
$hol=mysqli_fetch_array($kli);
$locationid=$hol['location_id'];
$atkon=$hol['access_token'];


$afield=$hold['afield'];
$cf=$hold['customfield'];
$tp=$hold['type'];
$customfieldid=$hold['cfname'];
$ctt=$hold['cont'];
$condi=$hold['condio'];
$folv=$hold['folv'];
$current_user = wp_get_current_user();
$cidemail=$current_user->user_email;
$coidd=$_GET['contid'];

if($testmain!="" && $cidemail==""){
//echo "Test Code Calls<br> '$akey'<br>'$afield'<br>'$cf'";
$quq="?locationId=$locationid&query=$testmain";
//?locationId=ve9EPM428h8vShlRW1KT&query=a
$mainurl='https://services.leadconnectorhq.com/contacts/'.$quq;
}



elseif($cidemail!=""){
    $quq="?locationId=$locationid&query=$cidemail";
    $mainurl='https://services.leadconnectorhq.com/contacts/'.$quq;
}
else{
    $mainurl='https://services.leadconnectorhq.com/contacts/?locationId='.$locationid;
}
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $mainurl,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
      "Accept: application/json",
    'Authorization: Bearer '.$atkon,
    "Version: 2021-07-28"
  ),
));

$response = curl_exec($curl);



$json=json_decode($response,true);
//echo $response;
curl_close($curl);
$j=0;

//main loop is started so better handle you contact id here----------------------------------------------------------------

foreach($json['contacts'] as $r)
{
    
//main loop is started so better handle you contact id here----------------------------------------------------------------

   $holdi=$r[$afield];
   //getting  contact
   $contactid = $r['id'];
    
    
if($condi=="Yes"){
       if($afield=="customField" && $contactid==$coidd)
   {
  //  echo "This is Custom Field";
foreach($r['customField'] as $rock)
{
//$customfieldid
$mid=$rock['id'];
$dval=$rock['value'];
if($mid==$customfieldid){


  if($tp=="File"){
         
    foreach($rock['value'] as $urlc)
    {
        $del=$urlc['meta']['deleted']; 

        
 // echo $urlc['url']."<br>";
    $holdurl=$urlc['url'];

    
    $info = new SplFileInfo($holdurl);
$filext=$info->getExtension();
if($holdurl!="" && $del!=1){
if($filext=="PNG"||$filext=="png"||$filext=="jpg"||$filext=="jpeg"||$filext=="JPG"||$filext=="JPEG"||$filext=="gif"||$filext=="GIF" && $del!=1)
{
echo "<a href='".$holdurl."' download='filedownload'  rel='noopener noreferrer' target='_blank'><img src='https://stapp.ebmsportal.com/wp-content/plugins/gohighapp/assets/icon/file.png' class='imagefrontsetting'> $del</a> ";
//echo $holdurl;
}
else if($filext=="pdf"||$filext=="PDF")
{
  echo "<a href='".$holdurl."' download='filedownload'  rel='noopener noreferrer' target='_blank'><img src='https://stapp.ebmsportal.com/wp-content/plugins/gohighapp/assets/icon/pdf.png' class='imagefrontsetting'> $del</a> ";
//echo $holdurl;
}
else
{
  echo "<a href='".$holdurl."' download='filedownload'  rel='noopener noreferrer' target='_blank'><img src='https://stapp.ebmsportal.com/wp-content/plugins/gohighapp/assets/icon/empty.png' class='imagefrontsetting'></a>";

//echo $holdurl;
}
}
else{
    echo "";
}
    }
  }
  else{
    $j+=1;
    if($ctt=="No"){
  if($j==1){
//echo $dval."test";
  if(is_array($dval)) {
   // echo "Array hy";
   $r=0;
foreach($dval as $t){
    echo $t;
    $r +=1;
}
  } 
  else {
    //echo "Not an Array";
echo $dval;
      
  }
    } 
}
else if($ctt=="Yes"){
   if(is_array($dval)) {
   // echo "Array hy";
   $r=0;
foreach($dval as $t){
    echo $t;
    $r +=1;
}
  } 
  else {
    //echo "Not an Array";
echo $dval;
      
  }
  //echo $dval."test";
}
else{
  if(is_array($dval)) {
   // echo "Array hy";
   $r=0;
foreach($dval as $t){
    echo $t;
    $r +=1;
}
  } 
  else {
    //echo "Not an Array";
echo $dval;
      
  }
}
  }

}

}   }
   else{
   if($holdi!=""  && $contactid==$coidd)
    {
      $j+=1;
if($ctt=="No"){
  if($j==1){
    echo $holdi;
}
}

else if($ctt=="Yes"){
    echo $holdi;

}
else{
  echo $holdi;

}        //echo $holdi."<br>";

    }
    else{
       // echo "Not Found";
    }
   }
}    
    else{
   if($afield=="customField" )
   {
  //  echo "This is Custom Field";
foreach($r['customField'] as $rock)
{
//$customfieldid
$mid=$rock['id'];
$dval=$rock['value'];
if($mid==$customfieldid){


  if($tp=="File"){
         
    foreach($rock['value'] as $urlc)
    {
        $del=$urlc['meta']['deleted']; 

        
 // echo $urlc['url']."<br>";
    $holdurl=$urlc['url'];

    
    $info = new SplFileInfo($holdurl);
$filext=$info->getExtension();
if($holdurl!="" && $del!=1){
if($filext=="PNG"||$filext=="png"||$filext=="jpg"||$filext=="jpeg"||$filext=="JPG"||$filext=="JPEG"||$filext=="gif"||$filext=="GIF" && $del!=1)
{
echo "<a href='".$holdurl."' download='filedownload'  rel='noopener noreferrer' target='_blank'><img src='https://stapp.ebmsportal.com/wp-content/plugins/gohighapp/assets/icon/file.png' class='imagefrontsetting'> $del</a> ";
//echo "<h2>".$holdurl."</h2>";
}
else if($filext=="pdf"||$filext=="PDF")
{
  echo "<a href='".$holdurl."' download='filedownload'  rel='noopener noreferrer' target='_blank'><img src='https://stapp.ebmsportal.com/wp-content/plugins/gohighapp/assets/icon/pdf.png' class='imagefrontsetting'> $del</a> ";
//echo "<h2>".$holdurl."</h2>";
}
else
{
  echo "<a href='".$holdurl."' download='filedownload'  rel='noopener noreferrer' target='_blank'><img src='https://stapp.ebmsportal.com/wp-content/plugins/gohighapp/assets/icon/empty.png' class='imagefrontsetting'></a>";
//echo $holdurl;

}
}
else{
    echo "";
}
    }
  }
  else{
    $j+=1;
    if($ctt=="No"){
  if($j==1){
//echo $dval."test";
  if(is_array($dval)) {
   // echo "Array hy";
   $r=0;
foreach($dval as $t){
    echo $t;
    $r +=1;
}
  } 
  else {
    //echo "Not an Array";
echo $dval;
      
  }
  } 
}else if($ctt=="Yes"){
   if(is_array($dval)) {
   // echo "Array hy";
   $r=0;
foreach($dval as $t){
    echo $t;
    $r +=1;
}
        } 
    else {
    //echo "Not an Array";
echo $dval;
  }
  //echo $dval."test";
}
else{
  if(is_array($dval)) {
   // echo "Array hy";
   $r=0;
foreach($dval as $t){
    echo $t;
    $r +=1;
}
  } 
  else {
    //echo "Not an Array";
echo $dval;
      
  }
}
  }
}
}
   }
   
   else{
   if($holdi!="")
    {
      $j+=1;
if($ctt=="No"){

  if($j==1){
            
    echo $holdi;
}
}

else if($ctt=="Yes"){
    
//folder view    
  if($folv=="Yes"){
      echo "<a href='https://stapp.ebmsportal.com/file/?contid=".$contactid."' class='foldercontainer'><div ><img src='https://stapp.ebmsportal.com/wp-content/uploads/2022/08/folder-icon.svg' class='folderimage'><h6>".$holdi."</h6></div></a>";  
  }  
  else{
        echo $holdi;
  }
    }
else{
  echo $holdi;

}
    }
    else{
       // echo "Not Found";
    }
   }
    }
   
//here loop is closed---------------------------------------------------------------------------------------------------------   
}
//here loop is closed---------------------------------------------------------------------------------------------------------

}









if(isset($_POST['updateapi']))
{
$api=$_POST['ke'];
$an=$_POST['nm'];
$id=$_POST['id'];
$at=$_POST['at'];
$rt=$_POST['rt'];
$compid=$_POST['cid'];
$locid=$_POST['lid'];
$ceid=$_POST['ceid'];
$cesec=$_POST['cesec'];

$save="UPDATE `gohighsetting` SET `agenname`='$an', `gkey`='$api', `access_token`='$at', `refresh_token`='$rt', `company_id`='$compid',`location_id`='$locid', `client_id`='$ceid',`client_sec`='$cesec' WHERE `did`='$id'";
mysqli_Query($con,$save);
//echo "<meta http-equiv='refresh' content='0'>";
echo $save;
}


if(isset($_POST['deleapi']))
{
$id=$_POST['deleapi'];


$save="DELETE FROM `gohighsetting` WHERE `did`='$id'";
mysqli_Query($con,$save);
//echo "<meta http-equiv='refresh' content='0'>";
echo $save;
}



?>