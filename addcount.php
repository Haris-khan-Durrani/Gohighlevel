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
<script>
function vrtu(){

var i=$('#formselect').val();
//var k=$("#key").val();
//console.log("value change"+i+k);
/*
var settings = {
  "url": "https://rest.gohighlevel.com/v1/forms/submissions?formId="+i,
  "method": "GET",
  "timeout": 0,
  "headers": {
    "Authorization": "Bearer "+k
  },
};

$.ajax(settings).done(function (response) {
  console.log(response);
});
*/
jQuery.ajax({
        url: "https://rest.gohighlevel.com/v1/contacts",
        type: 'GET',
        dataType: "json",
        
    
    headers: {
    "Authorization": "Bearer "+i
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
          $('.fieldshow2').show();
          $('.openne').removeAttr('disabled');
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
if(i=="customField" || i=="tags")
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
function dopdow()
{
var getr=  $(".apkri option:selected").text();
$('.cidpicker').val(getr);
}


//for custom field id getting
function getcid()
{
  console.log("Loading");
  var i=$('#formselect').val();
  //var holdi=$('.appkr').val();
  //console.log(holdi);
  var settings = {
  "url": "https://rest.gohighlevel.com/v1/custom-fields/",
  "method": "GET",
  "timeout": 0,
  "headers": {
    "Authorization": "Bearer "+i
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
</script>

<div class="container">
<div class="col-md-12 text-center" style="margin-bottom:3px;padding-top:20px">
<img src="<?php echo plugins_url('assets/image/icon.png' , __FILE__);?>" class="dbimage"></div>



<div  style="background-color: ;">
<div class="col-md-12 text-center">
<h3>Add count Field With Condition</h3>
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

<select class="form-control fieldadder" id="formselect" onchange="vrtu()" name="akey">
<option>Select Your Agency To Get Your Fields</option>
<?php

foreach($myq as $f)
{
$name=$f['agenname'];
$key=$f['gkey'];
echo "<option value=".$key.">".$name."</option>";
  
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
<div class="form-row fieldshowr" style="display: none;" >
          <div class="col-sm-12 col-md-12 form-group">
          <label>
Select Your Fields</label>
<select class="result form-control fieldadder" id="cfields" onchange="fieldget()" name="fie"></select>
  <input type="hidden" name="customf" value="customField">        
          </div></div>


          <div class="form-row fieldshow" style="display: none;" >
          <div class="col-sm-12 col-md-12 form-group">
          <label>
Your Field Name</label>

  <input type="text" name="fieldname" class=" form-control fieldadder" >        
          </div></div>







<div class="form-row fieldshow3" style="display: none;" >
          <div class="col-sm-12 col-md-12 form-group">
          <label>
Add Your Custom Field id</label>
<input type="text" class="form-control appkr cidpicker" name="cfi">
          
          </div></div>


          <div class="form-row fieldshow" style="display: none;" >
          <div class="col-sm-12 col-md-12 form-group">
          <label>
Add Your Custom Field Key Name</label>
<select class="apkri form-control fieldadder" name="cfn" onchange="dopdow()">

</select>          
          </div></div>



          <div class="form-row fieldshow2" style="display: none;">
          <div class="col-sm-6 col-md-6 form-group">
          <label>
Condition Type</label>
<select class="form-control fieldadder appkr" name="fty">
  <option value="">Select Your Condition Type</option>
<option value="isequal">is equal
</option>
<option value="lessthen">Lessthen
</option>
<option value="greaterthen">Greaterthen
</option>
<option value="greaterequal">Greaterthen & Equals
</option>
<option value="lessequal">Lessthen & Equals
</option>

<option value="notequal">Not Equal
</option>
</select>
          
          </div>
          <div class="col-sm-6 col-md-6 form-group">
<label>Your Text</label>
<input type="text"  class="form-control appkr " name="yt" placeholder="Your Text">

</div>
          
          
          
          </div>






          <div class="form-row fieldshow2" style="display: none;">
          <div class="col-sm-6 col-md-6 form-group">
          <label>
Apply Your Condistion as</label><br>
<label>
<input type="radio" value="add" name="valaah"> Add
       </label>   

       <label>
<input type="radio" value="count" name="valaah"> Count
       </label>   

          </div>
          <div class="col-sm-6 col-md-6 form-group">
<label>Your Custom Field key To be add or Count</label>
<input type="text"  class="form-control appkr " name="cyt" placeholder="Your Custom Field Key">

</div>
          
          
          
          </div>











<div class="col-sm-12 col-md-12 form-group text-center">
<input type="submit" class="btn btn-info openne" disabled name="allsub">
</div>
</form>
          




</div>







<div clss="row" style="padding-top:50px">

<div class="col-md-12 ibox">
<h3 class="text-center hilg">All Fields Shortcode</h3>
<form method="post">
<table class="table table-responsive">
<thead>
<tr>
<th>
ID
</th>
<th>Field name</th>
<th>Condition</th>
<th>
Shortcode
</th>
<th>
Action
</th>
</tr>
</thead>

<tbody>
<?php
$newp="Select * from addcountfield";
$rup=mysqli_query($con,$newp);

foreach($rup as $k)
{
$id=$k['fid'];
$nm=$k['akey'];
$af=$k['fieldname'];
$ke="[gofieldcf id=".$id."]";
$fdc=$k['fieldcountadd'];


echo '<tr>
<td><input type="text" name="id" value="'.$id.'" class="bomfom form-control" readonly ></td>
<td><input type="text" name="nm" value="'.$af.'" class="bomfom form-control" readonly></td>
<td style="font-size:12px">'.$fdc.'</td>
<td><input type="text" name="ke" value="'.$ke.'" class="bomfom form-control" readonly></td>

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



<?php
if(isset($_POST['allsub']))
{
$agen=$_POST['akey'];
$cf=$_POST['cfn'];
$cty=$_POST['fty'];
$yt=$_POST['yt'];
$addcou=$_POST['valaah'];
$cfky=$_POST['cyt'];
$fieldnam=$_POST['fieldname'];

$quey="INSERT INTO `addcountfield`(`fieldname`,`akry`, `afield`, `contype`, `customtext`, `fieldcountadd`, `countadd`) VALUES ('$fieldnam','$agen','$cf','$cty','$yt','$addcou','$cfky')";
mysqli_query($con,$quey);
echo "<meta http-equiv='refresh' content='0'>";

}
if(isset($_POST['del']))
{
$id=$_POST['id'];
$newp="delete from addcountfield where fid='$id'";
$rup=mysqli_query($con,$newp);
echo "<meta http-equiv='refresh' content='0'>";
}

?>