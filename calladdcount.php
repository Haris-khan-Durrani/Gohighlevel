<?php
function princtaddcount($id) {
    ob_start();
  
   // price_quote_display();
   addcountw($id) ;
    return ob_get_clean();
  }
    //creates shortcode
    add_shortcode('gofieldcf','princtaddcount');


    function addcountw($id)
    {
        error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); 
include_once 'ajx.php';
       include "db.php";
       $testmain=$_GET['email'];
 extract(shortcode_atts(array(
        'id' => $id
    ), $id));

$dbfieldsetiign="Select * from addcountfield where fid='$id'";
$run=mysqli_query($con,$dbfieldsetiign);
$hold=mysqli_fetch_array($run);
$akey=$hold['akry'];
$afield=$hold['afield'];

$tp=$hold['contype'];
$ct=$hold['customtext'];
$upt=$hold['fieldcountadd'];


$lastkey=$hold['countadd'];
$keygen=printkeyid($akey,$lastkey);


$customfieldid=$hold['afield'];

if($testmain!=""){
//echo "Test Code Calls<br> '$akey'<br>'$afield'<br>'$cf'";
$mainurl='https://rest.gohighlevel.com/v1/contacts/lookup?email='.$testmain;
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
    'Authorization: Bearer '.$akey
  ),
));

$response = curl_exec($curl);
$json=json_decode($response,true);
//echo $response;
curl_close($curl);
foreach($json['contacts'] as $r)
{
//echo $r['id'];
$qw=0;
foreach($r['customField'] as $rock)
{

    $mid=$rock['id'];
    $dval=$rock['value'];

if($mid==$keygen)
{
$rtui=$dval;
}

   // echo $dval."<br>";

//if("'$ct'".$tp.$dval)
//if($mid.$tp.$afield)
if($tp=="isequal"){
$cont=$dval == $ct;
}
else if($tp=="lessthen"){
    $cont=$dval < $ct;
    }
    else if($tp=="greaterthen"){
        $cont=$dval > $ct;
        }
        else if($tp=="greaterequal"){
            $cont=$dval >= $ct;
            }
            else if($tp=="lessequal"){
                $cont=$dval <= $ct;
                }

            
                    
    
                    else if($tp=="nnotequalotin"){
                        $cont=$dval != $ct;
                        }
                        

if($cont)
{
$qw+=1;
$try+=$rtui;

    //echo $dval;

}



}


/*   $holdi=$r['customField'];
    
   if($holdi=="customField")
   {
  //  echo "This is Custom Field";
  $rk=0;
foreach($r['customField'] as $rock)
{
//$customfieldid
$mid=$rock['id'];
$dval=$rock['value'];
//if($dval.$tp.$ct){
    foreach($rock['value'] as $urlc)
    {$rk+=1;
var_dump($urlc['id']);

    }

  


 



//}



}



    
   }
   else{
   if($holdi!="")
    {

        echo $rk;




    }
    else{
        echo "Not Found".$dval.$tp.$ct;
    }
   }
}
*/




}

if($upt=="add")
{

$klp=$try;
}
 else{

    $klp=$qw;
 }



    echo $klp;

}
    ?>