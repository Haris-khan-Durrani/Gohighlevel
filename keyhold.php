<?php
function printkeyid($key,$keyhold2)
{
    $curl2 = curl_init();

    curl_setopt_array($curl2, array(
      CURLOPT_URL => 'https://rest.gohighlevel.com/v1/custom-fields/',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.$key
      ),
    ));
    
    $response2 = curl_exec($curl2);
    
    curl_close($curl2);
   // echo $response;
   $jsonn=json_decode($response2,true);


   $rm=0;
   foreach($jsonn['customFields'] as $kry)
 { 
    $rm +=1;
    $fieldid=$kry['id'];
    $fieldkey=$kry['fieldKey'];
 if($fieldkey==$keyhold2)
 {

    return $fieldid;

 }

    
 }

}

function tablecustomid($key,$keyhold3)
{
    $curl2 = curl_init();

    curl_setopt_array($curl2, array(
      CURLOPT_URL => 'https://rest.gohighlevel.com/v1/custom-fields/',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.$key
      ),
    ));
    
    $response2 = curl_exec($curl2);
    
    curl_close($curl2);
   // echo $response;
   $jsonn=json_decode($response2,true);


   $rm=0;
   foreach($jsonn['customFields'] as $kry)
 { 
    $rm +=1;
    $fieldid=$kry['id'];
    $fieldkey=$kry['fieldKey'];
 if($fieldkey==$keyhold3)
 {

    return $fieldid;

 }

    
 }

}

//get data from contactsa

/*function gettabledt($key,$keyhold,$url,$typ)
{
  if($url!=""){
    //echo "Test Code Calls<br> '$akey'<br>'$afield'<br>'$cf'";
    $mainurl='https://rest.gohighlevel.com/v1/contacts/lookup?email='.$url;
    }
    else{
        $mainurl='https://rest.gohighlevel.com/v1/contacts';
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
        'Authorization: Bearer '.$key
      ),
    ));
    
    $response = curl_exec($curl);
    $json=json_decode($response,true);
    //echo $json;
    curl_close($curl);
    foreach($json['contacts'] as $r)
    {
    
       $holdi=$r[$keyhold];
        
       if($keyhold=="customField")
       {
      //  echo "This is Custom Field";
    foreach($r['customField'] as $rock)
    {
    //$customfieldid
    $mid=$rock['id'];
    $dval=$rock['value'];
    if($mid==$customfieldid){
    
    /*
      if($tp=="File"){
        foreach($rock['value'] as $urlc)
        {
       // echo $urlc['url']."<br>";
        $holdurl=$urlc['url'];
        $info = new SplFileInfo($holdurl);
    $filext=$info->getExtension();
    
    if($filext=="PNG"||$filext=="png"||$filext=="jpg"||$filext=="jpeg"||$filext=="JPG"||$filext=="JPEG"||$filext=="gif"||$filext=="GIF")
    {
    echo "<a href='".$holdurl."' download><img src='".$holdurl."' class='imagefrontsetting'></a>";
    
    }
    else if($filext=="pdf"||$filext=="PDF")
    {
      echo "<a href='".$holdurl."' download><img src='".plugins_url('assets/icon/pdf.png' , __FILE__)."' class='imagefrontsetting'></a>";
    
    }
    else
    {
      echo "<a href='".$holdurl."' download><img src='".plugins_url('assets/icon/empty.png' , __FILE__)."' class='imagefrontsetting'></a>";
    
    
    }
    
    
    
    
    
        }
    
      }






     // else{
    return $dval;
    
      //}
    
    
    
    }
    
    
    
    }
    
    
    
        
       }
       else{
       if($holdi!="")
        {
    
          return $holdi;
    
    
    
    
        }
        else{
          return "Not Found";
        }
       }
    }
    


}*/


?>