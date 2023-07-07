<?php
include('db.php');
include('ajx.php');
//include('keyhold.php');
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
include('functions/sty.php');
$fet="select * from gohighsetting";
$myq=mysqli_query($con,$fet);

$i=mysqli_fetch_array($myq);
$ak=$i['gkey'];

//fro print key id you just need to call this function
//printkeyid($key,$keyhold);

?>
<script>

$(document).ready(function(){
    $('.rd').click(function(){
        console.log("clicked");
    if($("#rd1")[0].checked){
       //logic here
       $(".fieldshow").show();
       $('.adderbtn').show();
       //getcid();
    }
    if($("#rd2")[0].checked){
       //logic here
       $(".fieldshow").show();
       $('.adderbtn').show();
     //  getcid();
    }
});

})


function vrtu(){
$('.showi').html("");
$('.adderbtn').hide();
$(".fieldshow").hide();
$(".fieldshow2").hide();
$("#rd1").prop('checked', false);
$("#rd2").prop('checked', false);


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



//show radio button option
$('.radioshow').show();


//$('.adderbtn').show();
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


function addoption() {
    var ddl = $("#fielddefiner").clone();
    $(".showi").append(ddl);
}


</script>


<div class="container">
<div class="col-md-12 text-center" style="margin-bottom:3px;padding-top:20px">
<img src="<?php echo plugins_url('assets/image/icon.png' , __FILE__);?>" class="dbimage"></div>
<div class="col-md-12 text-center">
<h3>Table Shortcode Create</h3>
<p>Always remember that your Customfield & tags is holding custom fields In Order to get You have to define Your Custom Field<br>
For Custom field You have to input field id you can find in you filed inpection defined as for better follow our docs
</p>
</div>

















<?php
//$key="deeed1f1-d3d1-433b-885e-15aece16006a";
//$keyhold="contact.amount";
//echo "key call".printkeyid($key,$keyhold);

?>

<form method="post">
<div class="form-row" >
          <div class="col-sm-12 col-md-12 form-group">
          <label>Module Name</label>
<input type="text" class="form-control fieldadder" placeholder="My Global View" name="mn">
          
          </div></div>


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
?>
</select>
</div></div>
<div class="form-row radioshow" style="display: none;" >
          <div class="col-sm-12 col-md-12 form-group">
          <label>
Show Duplicate Entries with same email</label>
<br>
<label><input type="radio" class="form-control rd" name="aa" id="rd1" value="Yes"> Yes</label>
<label><input type="radio" class="form-control rd" name="aa" id="rd2" value="No"> No</label>
          
          </div></div>


<div class="col-md-12 fielddefiner" id="fielddefiner">
<div class="form-row fieldshow" style="display: none;" >
          <div class="col-sm-12 col-md-12 form-group">
          <label>
    Field Title For Table View</label>
    <input type="text" class="form-control fieldadder" placeholder="My Column 1" name="ftit[]">      
          </div></div>   
<div class="form-row fieldshow" style="display: none;" >
          <div class="col-sm-12 col-md-12 form-group">
          <label>
    Select Your Fields</label>
    <select class="result form-control fieldadder" id="cfields" onchange="fieldget()" name="fie[]"></select>
          
          </div></div>



          <div class="form-row fieldshow" style="display: none;" >
          <div class="col-sm-12 col-md-12 form-group">
          <label>
    Add Your Custom Field Key Name (Add this key while you select custom field otherwise leave it empty)</label>
   <input type="text" class="form-control fieldadder" name="cfkn[]" placeholder="contact.customkey">        
   
    
          </div></div>
          <a class="btn btn-info adderbtn" onclick="addoption()" style="display: none;">Add More Fields</a>
</div>

<div class="showi">


</div>




<div class="form-row fieldshow" style="display: none;" >
          <div class="col-sm-12 col-md-12 form-group" style="padding: 10px;background-color:#F4F6F6;margin:5px;box-shadow:2px 1px 2px 1px #E5E8E8">
          <label>
  <input type="checkbox" name="btn[]"> Add Button 1 as Actions or you want to add function so you can add it</label>
  <br><br>
  <label>Button Column Title</label>
   <input type="text" class="form-control fieldadder" name="btnt[]" placeholder="Show">        
   <br>
   <label>Button Hold Title</label>
   <input type="text" class="form-control fieldadder" name="btnti[]" placeholder="Details">        
   <br>

  <label>Select Your Page For Your Button Action it will work perfectly with your fields shortcode</label>
<select name="page[]" class="form-control fieldadder"> 
    <option value=""><?php echo esc_attr( __( 'Select page' ) ); ?></option> 
    <?php 
     $pages = get_pages(); 
     foreach ( $pages as $page ) {
       $option = '<option value="' . $page->ID . '">'.$page->post_title.'</option>';
       echo $option;
     }
    ?>
</select>     
<br>
  <label>Script Function Your Button Hold Your Entry Id</label>
   <input type="text" class="form-control fieldadder" name="func[]" placeholder="abctrigger()">  
    
          </div></div>





          <div class="form-row fieldshow" style="display: none;" >
          <div class="col-sm-12 col-md-12 form-group" style="padding: 10px;background-color:#EAFAF1;margin:5px;box-shadow:2px 1px 2px 1px #E5E8E8">
          <label>
  <input type="checkbox" name="btn[]"> Add Button 2 as Actions or you want to add function so you can add it</label>
  <br><br>
  <label>Button Column Title</label>
   <input type="text" class="form-control fieldadder" name="btnt[]" placeholder="Show">        
   <br>
   <label>Button Hold Title</label>
   <input type="text" class="form-control fieldadder" name="btnti[]" placeholder="Go to show">        
   <br>

  <label>Select Your Page For Your Button Action it will work perfectly with your fields shortcode</label>
<select name="page[]" class="form-control fieldadder"> 
    <option value=""><?php echo esc_attr( __( 'Select page' ) ); ?></option> 
    <?php 
     $pages = get_pages(); 
     foreach ( $pages as $page ) {
       $option = '<option value="' . $page->ID . '">'.$page->post_title.'</option>';
       echo $option;
     }
    ?>
</select>     
<br>
  <label>Script Function Your Button Hold Your Entry Id</label>
   <input type="text" class="form-control fieldadder" name="func[]" placeholder="abctrigger()">  
    
          </div></div>




  <div class="form-row fieldshow" style="display: none;" >
          <div class="col-sm-12 col-md-12 form-group" style="padding: 10px;background-color:#EAFAF1;margin:5px;box-shadow:2px 1px 2px 1px #E5E8E8">
          <label>
  <input type="checkbox" name="btn[]"> Add Button 3 as Actions or you want to add function so you can add it</label>
  <br><br>
  <label>Button Column Title</label>
   <input type="text" class="form-control fieldadder" name="btnt[]" placeholder="Show">        
   <br>
   <label>Button Hold Title</label>
   <input type="text" class="form-control fieldadder" name="btnti[]" placeholder="Go to show">        
   <br>

  <label>Select Your Page For Your Button Action it will work perfectly with your fields shortcode</label>
<select name="page[]" class="form-control fieldadder"> 
    <option value=""><?php echo esc_attr( __( 'Select page' ) ); ?></option> 
    <?php 
     $pages = get_pages(); 
     foreach ( $pages as $page ) {
       $option = '<option value="' . $page->ID . '">'.$page->post_title.'</option>';
       echo $option;
     }
    ?>
</select>     
<br>
  <label>Script Function Your Button Hold Your Entry Id</label>
   <input type="text" class="form-control fieldadder" name="func[]" placeholder="abctrigger()">  
    
          </div></div>
          
          
          
            <div class="form-row fieldshow" style="display: none;" >
          <div class="col-sm-12 col-md-12 form-group" style="padding: 10px;background-color:#EAFAF1;margin:5px;box-shadow:2px 1px 2px 1px #E5E8E8">
          <label>
  <input type="checkbox" name="btn[]"> Add Button 4 as Actions or you want to add function so you can add it</label>
  <br><br>
  <label>Button Column Title</label>
   <input type="text" class="form-control fieldadder" name="btnt[]" placeholder="Show">        
   <br>
   <label>Button Hold Title</label>
   <input type="text" class="form-control fieldadder" name="btnti[]" placeholder="Go to show">        
   <br>

  <label>Select Your Page For Your Button Action it will work perfectly with your fields shortcode</label>
<select name="page[]" class="form-control fieldadder"> 
    <option value=""><?php echo esc_attr( __( 'Select page' ) ); ?></option> 
    <?php 
     $pages = get_pages(); 
     foreach ( $pages as $page ) {
       $option = '<option value="' . $page->ID . '">'.$page->post_title.'</option>';
       echo $option;
     }
    ?>
</select>     
<br>
  <label>Script Function Your Button Hold Your Entry Id</label>
   <input type="text" class="form-control fieldadder" name="func[]" placeholder="abctrigger()">  
    
          </div></div>




<div class="fieldshow" style="display: none;">
<input type="submit" class="btn btn-md btn-success" value="Create My View" name="createview">

</div>






</form>



<?php
//create view button click
if(isset($_POST['createview']))
{
//module name
$modname=$_POST['mn'];
$akey=$_POST['akey'];
$viewcon=$_POST['aa'];
$random=generateRandomString();
//here loop variables come
$fieldtit=$_POST['ftit'];
//field
$fie=$_POST['fie'];
//custom field if value is custom    
$custfi=$_POST['cfkn'];
//insert multiple rows at a time
for($o=0;$o<count($fieldtit);$o++)
{
$ft=$fieldtit[$o];
$fi=$fie[$o];
$cf=$custfi[$o];
if($cf=="")
{
$cfn="none";
$cf="none";
}
else{

    $cfn=printkeyid($akey,$cf);
}
$myq="INSERT INTO `gohighview`(`akey`, `modulname`, `viewcondition`, `holder`, `ftitle`, `field`, `fieldidcus`,`fieldkeyg`, `action`, `buttoncall`, `page`, `param`) VALUES ('$akey','$modname','$viewcon','$random','$ft','$fi','$cf','$cfn','0','0','0','$viewcon')";
$runmyqu=mysqli_query($con,$myq);

}




//check button is avilable
$btn=$_POST['btn'];
$bttitle=$_POST['btnt'];
$bpage=$_POST['page'];
$bunf=$_POST['func'];

$bval=$_POST['btnti'];
for($j=0;$j<count($btn);$j++)
{
$colti=$bttitle[$j];
$act="Button";
$p=$bpage[$j];
$bacll=$bval[$j];
$fbf=$bunf[$j];


    $myq="INSERT INTO `gohighview`(`akey`, `modulname`, `viewcondition`, `holder`, `ftitle`, `field`, `fieldidcus`,`fieldkeyg`, `action`, `buttoncall`, `page`, `param`, `bfun`) VALUES ('$akey','$modname','$viewcon','$random','$colti','0','0','0','$act','$bacll','$p','$viewcon','$fbf')";
    $runmyqu=mysqli_query($con,$myq);



}




}




?>






<div clss="row" style="padding-top:50px">

<div class="col-md-12 ibox">
<h3 class="text-center hilg">Table View Shortcode</h3>
<form method="post">
<table class="table table-responsive">
<thead>
<tr>
<th>
ID
</th>
<th>Module name</th>

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
$newp="Select * from gohighview GROUP BY holder";
$rup=mysqli_query($con,$newp);

foreach($rup as $k)
{
$id=$k['ghvid'];
$nm=$k['akey'];
$af=$k['modulname'];
$hd=$k['holder'];
$ke="[gotable id=".$hd."]";

$getname="select * from gohighsetting where gkey='$nm'";
$kli=mysqli_query($con,$getname);
$hold=mysqli_fetch_array($kli);
$agencyname=$hold['modulname'];

echo '<tr>
<td><input type="hidden" name="id" value="'.$hd.'" class="bomfom form-control" readonly >'.$id.'</td>
<td><input type="text" name="nm" value="'.$af.'" class="bomfom form-control" readonly></td>

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

<?php
if(isset($_POST['del']))
{
$id=$_POST['id'];
$newp="delete from gohighview where holder='$id'";
$rup=mysqli_query($con,$newp);
echo "<meta http-equiv='refresh' content='0'>";
}

?>
</div>