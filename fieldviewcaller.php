<?php
function modi1f($id) {
 //   ob_start();
  ob_start('ob_gzhandler');  
   // price_quote_display();
   rockfront1f($id) ;
    return ob_get_clean();
  }
    //creates shortcode
    add_shortcode('gofieldf','modi1f');


    function rockfront1f($id)
    {
      
        
        error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); 
include_once 'ajx.php';
       include "db.php";
       $testmain=$_GET['email'];
 extract(shortcode_atts(array(
        'id' => $id
    ), $id));

$dbfieldsetiign="Select * from fieldshortcode where fid='$id'";
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
echo "<a href='".$holdurl."' download='filedownload'  rel='noopener noreferrer' target='_blank'><img src='".plugins_url('assets/icon/file.png' , __FILE__)."' class='imagefrontsetting'> $del</a> ";

}
else if($filext=="pdf"||$filext=="PDF")
{
  echo "<a href='".$holdurl."' download='filedownload'  rel='noopener noreferrer' target='_blank'><img src='".plugins_url('assets/icon/pdf.png' , __FILE__)."' class='imagefrontsetting'> $del</a> ";

}
else
{
  echo "<a href='".$holdurl."' download='filedownload'  rel='noopener noreferrer' target='_blank'><img src='".plugins_url('assets/icon/empty.png' , __FILE__)."' class='imagefrontsetting'></a>";


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



}



    
   }
   
   
   
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

}

      
      

        //echo $holdi."<br>";




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
echo "<a href='".$holdurl."' download='filedownload'  rel='noopener noreferrer' target='_blank'><img src='".plugins_url('assets/icon/file.png' , __FILE__)."' class='imagefrontsetting'> $del</a> ";

}
else if($filext=="pdf"||$filext=="PDF")
{
  echo "<a href='".$holdurl."' download='filedownload'  rel='noopener noreferrer' target='_blank'><img src='".plugins_url('assets/icon/pdf.png' , __FILE__)."' class='imagefrontsetting'> $del</a> ";

}
else
{
  echo "<a href='".$holdurl."' download='filedownload'  rel='noopener noreferrer' target='_blank'><img src='".plugins_url('assets/icon/empty.png' , __FILE__)."' class='imagefrontsetting'></a>";


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
      echo "<a href='https://stapp.ebmsportal.com/file/?contid=".$contactid."' class='foldercontainer'><div ><img src='".plugins_url('assets/icon/folder.png' , __FILE__)."' class='folderimage'><h6>".$holdi."</h6></div></a>";  
  }  
  else{
        echo $holdi;
  }
    

}
else{
  echo $holdi;

}

      
      

        //echo $holdi."<br>";




    }
    else{
       // echo "Not Found";
    }
   }
    }
   
   
   
   
//here loop is closed---------------------------------------------------------------------------------------------------------   
}
//here loop is closed---------------------------------------------------------------------------------------------------------

//echo $mainurl;
//echo $akey;
//echo $dval;

}
    ?>