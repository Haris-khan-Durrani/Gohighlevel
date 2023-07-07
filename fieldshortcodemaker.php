<?php 
include('db.php');
include('ajx.php');
$fet="select * from gohighsetting";
$myq=mysqli_query($con,$fet);

$i=mysqli_fetch_array($myq);
$ak=$i['gkey'];

?>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
include('functions/sty.php');
?>
<style>
   /* .header {
                        background-color: #ddd;

                        position: sticky;
                        top: 0;

                        z-index: 9999;
                    }
                    */
</style>

<script>
$(document).ready(function(){

$(".fieldshow").hide();

})

function dopdow()
{
var getr=  $(".apkri option:selected").text();
$('.cidpicker').val(getr);
$('.cidpicker').attr("readonly","readonly");
}


//for custom field id getting
function getcid()
{
  console.log("Custom Field Loading");
  //var i=$('#formselect').val();
   var selectedOption = $("#formselect option:selected");
  //  var optionValue = selectedOption.val();
var i=selectedOption.val();;
//data_val
var j=selectedOption.attr("data_val");
  
  //var holdi=$('.appkr').val();
  //console.log(holdi);
  //https://services.leadconnectorhq.com/locations/".j."/customFields
  var settings = {
  "url": "https://services.leadconnectorhq.com/locations/"+j+"/customFields",
  "method": "GET",
  "timeout": 0,
  "headers": {
    "Authorization": "Bearer "+i,
    "Version": '2021-07-28',
    "Accept": 'application/json'
  },
};

$.ajax(settings).done(function (response) {
  var dtaa=response;

  
  var  adtaa=dtaa['customFields'];
  for (var j = 0; j < adtaa.length; j++) {
    
    var getkey=adtaa[j]['fieldKey'];
var fid=adtaa[j]['id'];
    $(".apkri").append("<option class='removema' value='"+fid+"'>"+getkey+"</option>");





   }
});

}










function vrtu(){
 var selectedOption = $("#formselect option:selected");
//  var optionValue = selectedOption.val();
var i=selectedOption.val();;
//data_val
var j=selectedOption.attr("data_val");
var asid=selectedOption.attr("data_hol");
jQuery("#yoaj").val(asid);
 //jQuery("#myInput").val(newValue);

console.log(i+": location ID :"+j+": Agency ID :"+asid);


jQuery.ajax({
        url: "https://services.leadconnectorhq.com/contacts/?locationId="+j,
        type: 'GET',
        dataType: "json",
        
    
    headers: {
    "Authorization": "Bearer "+i,
    "Version": '2021-07-28',
    "Accept": 'application/json'
  },
        success: function( data ) {

                //  jQuery('.crear').html(data);
                // console.log(data['submissions'][0]);
var jso=data['contacts'][0];
//console.log(jso);
$('.removema').remove();


$(".fieldshow").show();
$.each(jso, function(keyi, value){
            $(".result").append("<option class='removema' value='"+keyi+"'>"+keyi+"</option>");
      // console.log(keyi);
          });
          getcid();

                // alert("Updated");
              // swal("Success!", "You Data has been Updated", "success");

        },
        error : function(request,error)
                {
                    console.log("Request error : "+JSON.stringify(request));
                }
      });





}
function fieldget(){


var i=$('#cfields').val();
if(i=="customFields" || i=="tags")
{
$('.fieldshow2').show();
$('.appkr').attr('required','required');
$('.openne').removeAttr('disabled');
}
else{
  $('.fieldshow2').hide();
  $('.openne').removeAttr('disabled');

  $('.appkr').removeAttr('required');
}
//console.log(i);

}
</script>
<div class="container">
<div class="col-md-12 text-center" style="margin-bottom:3px;padding-top:20px">
<img src="<?php echo plugins_url('assets/image/icon.png' , __FILE__);?>" class="dbimage"></div>



<div  style="background-color: ;">
<div class="col-md-12 text-center">
<h3>Fields Creations For Application With Define Type</h3>
<p>Always remember that your Customfield & tags is holding custom fields In Order to get You have to define Your Custom Field<br>
For Custom field You have to input field id you can find in you filed inpection defined as for better follow our docs
</p>
</div>





<div class="col-md-12">

<form method="post">
<div class="form-row">
          <div class="col-sm-12 col-md-12 form-group">
<label>
Select Your Agency To Get Contact Fields</label>
<input type="hidden" id="yoaj" name="yoag">
<select class="form-control fieldadder" id="formselect" onchange="vrtu()" name="akey">
<option>Select Your Agency To Get Your Fields</option>
<?php

foreach($myq as $f)
{
$name=$f['agenname'];
$key=$f['access_token'];
$lid=$f['location_id'];
$did=$f['did'];
echo "<option value=".$key." data_val=".$lid." data_hol=".$did.">".$name."</option>";
  
}

    //here fetch data from globalfunction check db have ip or not then use curl to send data
//param?loaddamnit=1
/*
$param="?loaddamnit=".$ak;
   
    //for data fetching plugins_url('function/globalfunction.php', __FILE__)
    $url=$purl.$param;
    //echo $url;
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
    ));


    $response = curl_exec($curl);

    curl_close($curl);
    $jded=json_decode($response);
    echo $response;
    */

?>
</select>
</div></div>
<div class="form-row fieldshow" style="display: none;" >
          <div class="col-sm-12 col-md-12 form-group">
          <label>
Select Your Fields</label>
<select class="result form-control fieldadder" id="cfields" onchange="fieldget()" name="fie"></select>
          
          </div></div>
          <div class="form-row fieldshow" style="display: none;" >
          <div class="col-sm-12 col-md-12 form-group">
          <label style="dsiplay:block;padding:10px;margin:10px;background-color:#EAEAEA">
Select Condition (You want to show multiple view means want to print all data or you want to print only one field)</label><br>
<label><input type="radio" value="Yes" name="condi">Yes I Want to</label>
<label><input type="radio" value="No" name="condi">No I don't want to</label>
            <label style="dsiplay:block;padding:10px;margin:10px;background-color:#EAEAEA">
Do you Want your data to show on Contact Id base means you can handle multiple oppprtunities & show sigular Opprotunity by activating this for info please check our documentation & our guide video for that
    <input type="checkbox" value="Yes" name="condio">Yes I Want to            
                
            </label> 
            
               <label style="dsiplay:block;padding:10px;margin:10px;background-color:#EAEAEA">
Show Folder View
    <input type="checkbox" value="Yes" name="fol">Yes I Want to            
                
            </label> 
            
            
      <label  style="dsiplay:block;padding:10px;margin:10px;background-color:#EAEAEA">
Show as counter this will apply on your date field so make sure to select your date field otherwise it will show error
    <input type="checkbox" value="Yes" name="sac">Yes I Want to            
                
            </label>             
            
            
          </div></div>
<div class="form-row fieldshow2" style="display: none;">
          <div class="col-sm-12 col-md-12 form-group" >
          <label>
Add Your Custom Field id (It will Populate Automatically Don;t change anything if its not showing anything please select your Customfield for that)</label>
<input type="text" class="form-control appkr cidpicker" name="cfi">
          
          </div></div>


          <div class="form-row fieldshow2" style="display: none;" >
          <div class="col-sm-12 col-md-12 form-group">
          <label>
Add Your Custom Field Key Name</label>
<select class="apkri form-control fieldadder" name="cfn" onchange="dopdow()">

</select>          
          </div></div>



          <div class="form-row fieldshow2" style="display: none;">
          <div class="col-sm-12 col-md-12 form-group">
          <label>
Custom Field Type</label>
<select class="form-control fieldadder appkr" name="fty">
  <option value="">Select Your Custom Field Type</option>
<option value="Text">Text</option>
<option value="File">File</option>

</select>
          
          </div></div>

<div class="col-sm-12 col-md-12 form-group text-center">
<input type="submit" class="btn btn-info openne" disabled name="allsub">
</div>
</form>
          




</div>


</div>



<?php
if(isset($_POST['allsub']))
{
$ak=$_POST['yoag'];
$af=$_POST['fie'];
$acf=$_POST['cfi'];
$acfn=$_POST['cfn'];
$folder=$_POST['fol'];
$act=$_POST['fty'];
$condi=$_POST['condi'];
$condio=$_POST['condio'];
$sac=$_POST['sac'];

$quer="INSERT INTO `fieldshortcode`( `akey`, `afield`, `customfield`, `cfname`, `type`, `cont`, `condio`, `folv`, `counter`) VALUES ('$ak','$af','$acf','$acfn','$act','$condi','$condio','$folder','$sac')";
mysqli_Query($con,$quer);
echo "<meta http-equiv='refresh' content='0'>";
}
if(isset($_POST['del']))
{
$id=$_POST['id'];
$newp="delete from fieldshortcode where fid='$id'";
$rup=mysqli_query($con,$newp);
echo "<meta http-equiv='refresh' content='0'>";
}

?>


<div clss="row" style="padding-top:50px">

<div class="col-md-12 ibox">
<h3 class="text-center hilg">All Fields Shortcode</h3>
<form method="post">
<table class="table table-responsive">
<thead>
<tr>
<th class="header">
ID
</th>
<th class="header">Field name</th>
<th class="header">Agency Name</th>
<th class="header">
Shortcode With Jquery
</th>
<th class="header">
Normal Shortcode
</th>
<th class="header">
Action
</th>
</tr>
</thead>

<tbody>
<?php
$newp="Select * from fieldshortcode";
$rup=mysqli_query($con,$newp);

foreach($rup as $k)
{
$id=$k['fid'];
$nm=$k['akey'];
$af=$k['afield'];
$counter=$k['counter'];
//	customfield	
$cufield=$k['customfield'];
$ctyp=$k['type'];
if($ctyp==""){
   $ctyp="Text"; 
    
}
else if($counter=="Yes" ){
     $ctyp="Text-> Date Counter";
}

if($counter=="Yes"){
    $ke="[gofield id=".$id."  mode=counter]";
$ken="[gofieldf id=".$id." mode=counter]";

    
}
else{
$ke="[gofield id=".$id."]";
$ken="[gofieldf id=".$id."]";
}

//gofieldf

$getname="select * from gohighsetting where did='$nm'";
$kli=mysqli_query($con,$getname);
$hold=mysqli_fetch_array($kli);
$agencyname=$hold['agenname'];


echo '<tr>
<td style="width:50px"><input type="text" name="id" value="'.$id.'" class="bomfom form-control" readonly ></td>
<td><input type="text" name="nm" value="'.$af." (".$cufield.')" class="bomfom form-control" readonly></td>
<td style="font-size:12px">'.$agencyname.' <b style="padding:5px;border-radius:20px;color:white;background:black;display:inline-block">Type: '.$ctyp.'</b></td>
<td><input type="text" name="ke" value="'.$ke.'" class="bomfom form-control" readonly></td>
<td><input type="text" name="ke" value="'.$ken.'" class="bomfom form-control" readonly></td>
<td><input type="submit" name="del" value="Delete" class="btn btn-sm btn-danger"></td>


</tr>';
  
}

?>
</tbody>






</table>
</form>
</div>

</div>
</div>