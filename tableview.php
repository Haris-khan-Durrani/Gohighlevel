<?php
function tabview($id) {
    ob_start();
  
   // price_quote_display();
   tabir($id) ;
    return ob_get_clean();
  }
    //creates shortcode
    add_shortcode('gotable','tabview');


    function tabir($id)
    {
?>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css" rel="stylesheet" id="bootstrap-css">


<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>


<?php



        error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); 
        include_once 'ajx.php';
               include "db.php";
           // include "keyhold.php";
               $testmain=$_GET['email'];
         extract(shortcode_atts(array(
                'id' => $id
            ), $id));
            
            $current_user = wp_get_current_user();
$cidemail=$current_user->user_email;
            
           if($testmain!="" && $cidemail==""){
//echo "Test Code Calls<br> '$akey'<br>'$afield'<br>'$cf'";
$mainurl='https://rest.gohighlevel.com/v1/contacts/lookup?email='.$testmain;
}
elseif($cidemail!=""){
    $mainurl='https://rest.gohighlevel.com/v1/contacts/lookup?email='.$cidemail;
}
else{
    $mainurl='https://rest.gohighlevel.com/v1/contacts';
}
                

$myf1="Select * from gohighview where holder='$id'";
$runq=mysqli_query($con,$myf1);
$m=mysqli_fetch_array($runq);
$reky=$m['akey'];
$hd=$m['holder'];
$param=$m['param'];

echo "<input type='hidden' value='".$reky."' id='".$hd."_hold'>";

?>
<script>
$(document).ready(function() {
    $('#table<?php echo $id; ?>').DataTable();
} );

</script>


<table id="table<?php echo $id; ?>" class="table table-striped table-bordered" style="width:100%"> 
<thead>
    <tr>
<?php
foreach($runq as $go)
{
    $krey=$go['akey'];
    //$holder=['contactName'];
   // $keyhold="id";
    //$url="";
    //$print=gettabledt($krey,$holder,$url);




echo "<th>".$go['ftitle']."</th>";


//gettabledt
}
?>




    </tr>

</thead>
<tbody>
<?php

//get data here
//use curl operation here
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
    'Authorization: Bearer '.$reky
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response['submissions'][0];
//echo $response;
$json=json_decode($response,true);
//echo $response;
//$json2=json_encode(json_decode($response), JSON_PRETTY_PRINT);;
$i=0;
foreach($json['contacts'] as $right){
$i +=1;
?>
<tr>
<?php

foreach($runq as $go)
{$nono +=1;
    $title=$go['field'];
    $customfield=$go['fieldidcus'];
    $act=$go['action'];
    $bct=$go['buttoncall'];
    $pidd=$go['page'];
    $bfun=$go['bfun'];
if($bfun!=0||$bfun!=""){

$bbfun=$bfun;
}
else{

    $bbfun="";
}
    if($pidd==0)
{
$pageurl="#";
    
}else{

    $pageurl=get_permalink($pidd)."?email=".$emailparam;

}
$keyid=tablecustomid($reky,$customfield);
    //$holder=['contactName'];
   // $keyhold="id";
    //$url="";
    //$print=gettabledt($krey,$holder,$url);
//single array holder
$valueprint=$right[$title];

$dataid=$right['id'];
$emailparam=$right['email'];


if($act=="Button")
{

    echo "<td><a href='".$pageurl."' class='btn btn-info btn-".$dataid."' id='".$dataid."' onclick='".$bbfun."'>".$bct."</a></td>";
}
else{
if($title=="customField")
{
//keyid
//echo "<td>".$keyid."</td>";
foreach($right['customField'] as $rock)
{
    
//$customfieldid
$mid=$rock['id'];
$dval=$rock['value'];
if($mid==$keyid){
    

    echo "<td class='".$dval."'>".$dval."<input type='hidden' value='".$mid."' class='f".$nono.'_'.$dataid."'></td>";

  }




}














}
else{
echo "<td>".$right[$title]."</td>";
}


}



//gettabledt
}
$nono=0;
?>
</tr>
<?php

//echo $right['customField'][$i]['id'];

}



?>
</tbody>

</table>

<?php







    }


?>