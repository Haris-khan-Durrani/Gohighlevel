<?php
//here make a proper template for barear token add
include('db.php');


// Check for connection errors
if ($db_connection->connect_error) {
    die('Database connection failed: ' . $db_connection->connect_error);
}


include('ajx.php');
?>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
include('functions/sty.php');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<script>
jQuery(function () {
  jQuery('[data-toggle="tooltip"]').tooltip()
})



function yorefresh(){
    //plugin_dir_url( __DIR__ ).'gohighapp/cron.php';
var refreshu="<?php echo plugin_dir_url( __DIR__ ).'gohighapp/cron.php'; ?>";
  $.ajax({
      url: refreshu,
      method: "GET",
      success: function(response) {
        // Handle the successful response here
        console.log(response);
        alert("Refresh Token & Access Token Has Been Updated");
      },
      error: function(xhr, status, error) {
        // Handle any errors that occurred during the AJAX request
        console.log("AJAX Request Error:", error);
      }
    });
    
}

function updateset(j){
    var j=jQuery(j).attr("id");
      //  var j=this.id;
   // console.log(j);
    var a=jQuery("#at"+j).val();
        var rt=jQuery("#rt"+j).val();
            var lid=jQuery("#lid"+j).val();
                var cid=jQuery("#cid"+j).val();
                    var ke=jQuery("#ke"+j).val();
                        var nm=jQuery("#nm"+j).val();
  
                      var ceid=jQuery("#clid"+j).val();
                        var cesec=jQuery("#csec"+j).val();
  
    $.ajax({
        type: "POST",
        url: "<?php echo plugin_dir_url( __DIR__ ).'gohighapp/ajax.php'; ?>",
        data: { 
            ke:ke , // < note use of 'this' here
            updateapi:j,
            nm:nm,
            id:j,
            at:a,
            rt:rt,
            cid:cid,
            lid:lid,
            ceid:ceid,
            cesec:cesec
          
        },
        success: function(result) {
            alert('Updated');
        },
        error: function(result) {
            alert('error'+result);
        }
    
});
    
    
    
}



function deleteapi(i)
{
        var i=jQuery(i).attr("id");
       // var j=this.id;
  console.log("Deleted ID: "+i);
  
   $.ajax({
        type: "POST",
        url: "<?php echo plugin_dir_url( __DIR__ ).'gohighapp/ajax.php'; ?>",
        data: { 
          
            deleapi:i
          
          
        },
        success: function(result) {
            alert('Location Has Been Deleted Please refresh Your Page!');
        },
        error: function(result) {
            alert('error'+result);
        }
   });
  
  
    
}

</script>





<div class="container">
<div class="col-md-12 text-center" style="margin-bottom:30px;padding-top:20px">
<img src="<?php echo plugins_url('assets/image/icon.png' , __FILE__);?>" class="dbimage"><h2> GOHIGH APP MAIN SETTING AREA <b style="color:red">API V2</b></h2>
<p>Add Multiple Agencies You Can Handle It with Your Login user email</p>
<b><p style="color:red">Remember You Have to set that url as your Cron job like <pre>0 */12 * * * curl -s your setting URL  >/dev/null 2>&1</pre></p></b>

</div>

<div class="col-md-12 greencon">
<h4 >Configure Your Go HIGHLEVEL<sup data-toggle="tooltip"  title="Add Your Go High level API KEY"><span class="fa fa-info-circle"></span></sup></h4>


<form method="post">
<?php
$fet="select * from gohighsetting";
$myq=mysqli_query($con,$fet);
$num=mysqli_num_rows($myq);
//echo $num;
$i=mysqli_fetch_array($myq);
$k=$i['gkey'];
$id=$i['did'];


?>
<div class="form-row">
<div class="col-sm-12 col-md-5 form-group">
    <label>Define Your Agency Or Location Name<sup data-toggle="tooltip"  title="Try to use same Location Name So it would be easy for you to remember cause we are using V2"> <span class="fa fa-info-circle"></span></sup></label>
            <input type="text" name="an" class="form-control" placeholder="Agency Name" required>
          </div>            
          <div class="col-sm-12 col-md-5 form-group">
               <label>Agency Bearer Token<sup data-toggle="tooltip"  title="Agency Berear Token use new fromat it should be 250 in length as per highlevel"> <span class="fa fa-info-circle"></span></sup></label>
            <input type="text" name="api" class="form-control" placeholder="Agency Berear API KEY" required>
          </div>            
           <div class="col-sm-12 col-md-2 form-group">
            <input type="submit" name="saveapi" class="btn btn-gh" value="Add Location" style="    position: absolute;
    top: -60px;
    right: -15px;
    border-left: 1px black solid;
    border-bottom: 1px black solid;">
          </div>  
          
          
          
      <div class="col-sm-12 col-md-12 form-group">
            <h3>Before configuring i will guide you how this plugin works</h3>
          </div>       
          
          
    <div class="col-sm-12 col-md-3 form-group">
    <label>Define Your Access Token<sup data-toggle="tooltip"  title="That you recived from OAuth 2.0"> <span class="fa fa-info-circle"></span></sup></label>
            <input type="text" name="act" class="form-control" placeholder="Access Token" required>
          </div>  
          
          
    
        <div class="col-sm-12 col-md-3 form-group">
    <label>Define Your Refresh Token<sup data-toggle="tooltip"  title="That you recived from OAuth 2.0"> <span class="fa fa-info-circle"></span></sup></label>
            <input type="text" name="rft" class="form-control" placeholder="Refresh Token" required>
          </div>  
          
          
          
                <div class="col-sm-12 col-md-3 form-group">
    <label>Define Company ID<sup data-toggle="tooltip"  title="That you recived from OAuth 2.0"> <span class="fa fa-info-circle"></span></sup></label>
            <input type="text" name="compid" class="form-control" placeholder="Company ID" required>
          </div>  
          
          
          
                          <div class="col-sm-12 col-md-3 form-group">
    <label>Define Location ID<sup data-toggle="tooltip"  title="That you recived from OAuth 2.0"> <span class="fa fa-info-circle"></span></sup></label>
            <input type="text" name="locid" class="form-control" placeholder="Location ID" required>
          </div>  
    
    
    
    
    
    
        <div class="col-sm-12 col-md-6 form-group">
    <label>Client ID<sup data-toggle="tooltip"  title="That you recived from OAuth 2.0"> <span class="fa fa-info-circle"></span></sup></label>
            <input type="text" name="compid" class="form-control" placeholder="Company ID" required>
          </div>  
          
          
          
                          <div class="col-sm-12 col-md-6 form-group">
    <label>Client Secrete Code<sup data-toggle="tooltip"  title="That you recived from OAuth 2.0"> <span class="fa fa-info-circle"></span></sup></label>
            <input type="text" name="locid" class="form-control" placeholder="Location ID" required>
          </div> 
    
    
    
    
          
              <div class="col-sm-12 col-md-12 form-group">
                  <h5 style="padding:5px;background:#1C2833;border-radius:10px">
   Note: In Token Remember that You  have to provide access token and in Auth provide only Bearer Token so with that everything will be inlined</h5>
   
   
   <div style="padding:10px;background: #1C2833;border-radius:10px">
   <h6>Add This into Your Cpanel Cron Job: <input type="text" class="form-control" readonly value="<?php echo plugin_dir_url( __DIR__ ).'gohighapp/cron.php';  ?>"></h6>
   </div>
   
   <div style="overflow:auto; width:100%; height: 250px;padding:10px;background-color:white;border-radius:10px;color:black;margin-top:10px">
       <h3> Get the app's Authorization Page URL</h3>
To generate the Authorization Page URL for an app, replace the client_id, redirect_uri, and scope in the template below. Then, redirect the location/agency admin trying to install your app to the URL.

<pre>
https://marketplace.gohighlevel.com/oauth/chooselocation?
response_type=code&redirect_uri=https://api.ebmsportal.com/gh/code.php&client_id=646b3012f8a768a4b9788523-liimblgw&scope=conversations/message.readonly%20conversations/message.write%20locations/customFields.readonly%20locations/customFields.write%20contacts.readonly%20contacts.write</pre>
<p></p>
When a user grants access, their browser is redirected to the specified redirect URI, and the Authorization Code is passed inside the code query parameter.
</p>
<p>
    <pre>
https://api.ebmsportal.com/gh/code.php?code=7676cjcbdc6t76cdcbkjcd09821jknnkj</pre>
</p>
<h4>
OAuth FAQs
</h4>
<ol>
    <li>
How long are the access tokens valid?
The access tokens are valid for a day. After that, you can use the refresh token to get a new access token which will be valid for another day.
</li><li>
How long are the refresh tokens valid?
The refresh tokens are valid for a year unless they are used. If they are used, the new refresh token is valid for a year as well.
</li><li>
How should we handle token expiry?
You should:
</li>
Make a request to any of our APIs using the accessToken.
If you get a response saying that the token is expired, refresh the token using our API and save the new access token and refresh token in your database.
Make the request again with the new accessToken.
You can write a wrapper function on your end to achieve this. You can use it for all the API calls you make to our APIs.
       </ol>
   </div>
   
   
          </div>     
          
          
          
</div>



</form>
<?php
// if(isset($_POST['saveapi']))
// {
// $api=$_POST['api'];
// $an=$_POST['an'];

// $at=$_POST['act'];
// $rt=$_POST['rft'];
// $compid=$_POST['compid'];
// $locid=$_POST['locid'];

// $save="INSERT INTO `gohighsetting`(`agenname`,`gkey`,`access_token`,`refresh_token`,`company_id`,`location_id`) VALUES ('$an','$api','$at','$rt','$compid','$locid')";
// mysqli_Query($con,$save);
// echo "<meta http-equiv='refresh' content='0'>";

// }
// if(isset($_POST['updateapi']))
// {
// $api=$_POST['ke'];
// $an=$_POST['nm'];
// $id=$_POST['id'];
// $at=$_POST['at'];
// $rt=$_POST['rt'];
// $compid=$_POST['cid'];
// $locid=$_POST['lid'];

// $save="UPDATE `gohighsetting` SET `agenname`='$an', `gkey`='$api', `access_token`='$at', `refresh_token`='$rt', `company_id`='$compid',`location_id`='$locid' WHERE `did`='$id'";
// mysqli_Query($con,$save);
// //echo "<meta http-equiv='refresh' content='0'>";
// echo $save;
// }


?>




</div>




<div clss="row" style="padding-top:50px">

<div class="col-md-12 ibox">
<h3 class="text-center">All Agencies</h3>
<form method="post">
<table class="table table-responsive">
<thead>
<tr>
<th>
ID
</th>
<th>Agency Name</th>
<th>
API KEY
</th>
<th>
Action
</th>
</tr>
</thead>

<tbody>
<?php
foreach($myq as $k)
{
$id=$k['did'];
$nm=$k['agenname'];
$ke=$k['gkey'];
$at=$k['access_token'];
$rt=$k['refresh_token'];
$compid=$k['company_id'];
$locid=$k['location_id'];


$clid=$k['client_id'];
$csec=$k['client_sec'];
echo '<tr style="border-bottom: solid 10px white;">
<td>
<input type="text" name="id" value="'.$id.'" class="bomfom form-control" readonly >
<label class="tablab">Access Token</label>
<input type="text" name="at" id="at'.$id.'" value="'.$at.'" class="bomfom form-control" title="Access Token">
<label class="tablab">Refresh Token</label>
<input type="text" name="rt" id="rt'.$id.'" value="'.$rt.'" class="bomfom form-control" title="Refresh Token">
</td>
<td>
<input type="text" name="nm" id="nm'.$id.'" value="'.$nm.'" class="bomfom form-control">
<label class="tablab">Company ID</label>
<input type="text" name="cid" id="cid'.$id.'" value="'.$compid.'" class="bomfom form-control" title="Company ID">

<label class="tablab">Client ID</label>
<input type="text" name="cid" id="clid'.$id.'" value="'.$clid.'" class="bomfom form-control" title="Client ID">
</td>

<td>
<input type="text" name="ke" id="ke'.$id.'" value="'.$ke.'" class="bomfom form-control">
<label class="tablab">Location ID</label>
<input type="text" name="lid" id="lid'.$id.'" value="'.$locid.'" class="bomfom form-control" title="Location ID">



<label class="tablab">Client Secrete Code</label>
<input type="text" name="cid" id="csec'.$id.'" value="'.$csec.'" class="bomfom form-control" title="Client Secrete Code">
</td>

<td>

<a hre="#" onclick="updateset(this)" value="Update" id="'.$id.'" class="btn btn-sm btn-danger">Update</a>
<a hre="#" onclick="deleteapi(this)" name="deleteapi" id="'.$id.'" value="Delete" class="btn btn-sm btn-danger">Delete</a>
<h2>API V2</h2>
<a href="#" class="btn btn-sm btn-success" onclick="yorefresh()">Refresh All Token</a>

</td>


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
if(isset($_POST['saveapi']))
{
$api=$_POST['api'];
$an=$_POST['an'];

$at=$_POST['act'];
$rt=$_POST['rft'];
$compid=$_POST['compid'];
$locid=$_POST['locid'];

$save="INSERT INTO `gohighsetting`(`agenname`,`gkey`,`access_token`,`refresh_token`,`company_id`,`location_id`) VALUES ('$an','$api','$at','$rt','$compid','$locid')";
mysqli_Query($con,$save);
echo "<meta http-equiv='refresh' content='0'>";

}


?>