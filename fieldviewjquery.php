<?php
function modij1($id,$mode) {
	ob_start();
	//ob_start('ob_gzhandler');  
	// price_quote_display();
	rockjso($id,$mode) ;
	return ob_get_clean();
}
//creates shortcode
// add_shortcode('gojqfv','modij1');
//gofield
add_shortcode('gofield','modij1');
function rockjso($id,$mode)
{



	//include_once 'ajx.php';
	//include "db.php";

	extract(shortcode_atts(array(
		'id' => $id,
		'mode'=>$mode
	), $id));


	$testmain=$_GET['email'];    
	$coidd=$_GET['contid'];
	if($coidd==""){
		$coidd="0";
	}
	$current_user = wp_get_current_user();
	$cidemail=$current_user->user_email; 
	$testmain=$_GET['email'];

	if($testmain=="")
	{
		$testmain=0;

	}



	//https://stapp.ebmsportal.com/wp-content/plugins/gohighapp/ajax.php

?>
<style>
	.linkIconbox .elementor-widget-container{
		cursor:pointer;
	}

</style>
<script>

	jQuery(document).ready(function(){
		//console.log("<?php //echo $id; ?>");

		//this code can print in the element in proper way
		//define( 'high_app_outside',  );

		//here define ajax code

		//console.log(employee_nae+employee_name);
		jQuery.ajax({
			url: "<?php echo plugin_dir_url( __DIR__ ).'gohighapp/ajax.php'; ?>",
			type: 'POST',

			// dataType: "json",
			data: {
				shortid: <?php echo $id; ?>,
				contid: "<?php echo $coidd; ?>",
				testmain: "<?php echo $testmain; ?>",
				cidemail: "<?php echo $cidemail; ?>",

			},
			success: function( data ) {
				// console.log(data);  





				if(data!=""){
					jQuery("#js<?php echo $id; ?>").html(data);
					// console.log(data);




					jQuery(".linkIconbox .elementor-widget-icon-box").each(function(index){
						var did = jQuery(this).attr('data-id');
						var link = jQuery("div [data-id='"+did+"'] .elementor-icon-box-title span span a").attr('href');
						// jQuery("div [data-id='"+did+"']  .elementor-icon-box-title").wrap('<a href="'+link+'"></a>');
						//console.log(link);
						if(link!=""){
							jQuery("div [data-id='"+did+"'] .elementor-widget-container").attr("id",link);
							jQuery("div [data-id='"+did+"'] .elementor-widget-container").attr("onclick","myfunc(this)");
						}   

					});


					<?php if($mode=="counter") {?>
					//const newDate = new Date('sep 12 22 23:59:59').getTime()
					const newDate = new Date(data).getTime()
					const countdown = setInterval(() =>{

						const date = new Date().getTime()
						const diff = newDate - date

						const month =  Math.floor((diff % (1000 * 60 * 60 * 24 * (365.25 / 12) * 365)) / (1000 * 60 * 60 * 24 * (365.25 / 12)))
						const days = Math.floor(diff % (1000 * 60 * 60 * 24 * (365.25 / 12)) / (1000 * 60 * 60 * 24))
						const hours =  Math.floor(diff % (1000 * 60 * 60 * 24) / (1000 * 60 * 60))
						const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60))
						const seconds = Math.floor((diff % (1000 * 60)) / 1000)

						document.querySelector(".seconds").innerHTML = seconds < 10 ? '0' + seconds : seconds
						document.querySelector(".minutes").innerHTML = minutes < 10 ? '0' + minutes :minutes
						document.querySelector(".hours").innerHTML = hours < 10 ? '0' + hours : hours
						document.querySelector(".days").innerHTML = days < 10 ? '0' + days : days
						document.querySelector(".months").innerHTML = month < 10 ? '0' + month : month

						if(diff === 0){
							clearInterval(countdown)
							document.querySelector(".countdown<?php echo $id; ?>").innerHTML = 'Counter Expired'
						}

					}, 1000)

					<?php
											   }else{
					?>
					jQuery(".countdown<?php echo $id; ?>").remove();

					<?php
	}
					?>



				}   
				else{
					jQuery(".js<?php echo $id; ?>").remove();
					jQuery(".countdown<?php echo $id; ?>").remove();
				}








				//shuja Query
				/*		const quota = jQuery("div#Visa_quota p.elementor-icon-box-description span[id^='js']").text();
			const applvisa = jQuery(".visa_foldersWrap a.foldercontainer").length;
			jQuery("div#applied_visa p.elementor-icon-box-description").text(applvisa);
			const calc = quota - applvisa;
			const aftercalccalc =  jQuery("div#remaining_visas p.elementor-icon-box-description").text(calc);



			var visaremai = jQuery("div#remaining_visas p.elementor-icon-box-description").text()
				if(visaremai > 0){
					console.log("555555")
					jQuery("#applyVisa__Quota").remove()
				}else if(visaremai < 1){
					console.log(visaremai)
					console.log("22222")
					jQuery("#applyVisa__").remove()
				}*/
				//ends here





			},
			error : function(request,error)
			{
				console.log("Request error : "+JSON.stringify(request)+error+request);
			}
		});


	})    

	// jQuery(document).load(function($){

	//}); 
	function myfunc(e){
		var g=jQuery(e).attr("id");
		//console.log(g);

		if(g!=""){
			window.location=g;
		}
	}

</script>
<?php
	if($mode=="counter"){
		//echo "I am Counter";
?>
<style>
	.countdown<?php echo $id; ?> > div  > .number{
		background: url(<?php echo site_url(); ?>/wp-content/uploads/2022/08/countdown-icon.png);
		background-size: contain;
		width: 80px;
		height: 80px;
		background-repeat: no-repeat;
		display:flex;
		flex-flow:wrap;
		align-items:center;
		justify-content:center;
	}
	.countdown<?php echo $id; ?>{
		display: flex;
		justify-content: center;
		/* 		gap: 5px;
		margin-top:10px; */
		width: max-content;
		margin: 10px auto 0;
	}
	.countdown<?php echo $id; ?> > div{
		display: flex;
		flex-wrap: wrap;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		/*padding: 10px 8px;
		border-radius: 5px;
		background: white;
		border: 1px solid; */
	}
	.number {
		font-weight: 500;
		font-size: 22px;
		color: #fff;
		margin-top:-6px;
	}
	/*
	div span:last-of-type{
	font-size: 12px;
	}*/
	.subtext{
		font-size:16px;
		font-weight:600;
		color:#0E529E;
	}
	@media screen and (max-width:600px){
		.countdown<?php echo $id; ?> > div  > .number{
			background: url(<?php echo site_url(); ?>/wp-content/uploads/2022/08/countdown-icon.png);
			background-size: contain;
			width: 60px;
			height: 60px;
		}
		.subtext{
			font-size:10px;
		}
		.countdown<?php echo $id; ?>{
			gap: 2px;
		}
		.countdown > div{
			width: 60px;
			height: 80px;
		}

		.number {
			font-size: 20px;
		}
	}

</style>
<div class="countdown<?php echo $id; ?>">
	<div>
		<span class="number months"></span>
		<span class="subtext">Months</span>
	</div>

	<div>
		<span class="number days"></span>
		<span class="subtext">Days</span>
	</div> 
	<div>
		<span class="number hours"></span>
		<span class="subtext">Hours</span>
	</div>   
	<div>
		<span class="number minutes"></span>
		<span class="subtext">Minutes</span>
	</div>    
	<div>
		<span class="number seconds"></span>
		<span class="subtext">Seconds</span>
	</div>
</div>

<?php  
	}else{
?>


<span id="js<?php echo $id; ?>" class="js<?php echo $id; ?>"></span>

<?php
		 }






	//here loop is closed---------------------------------------------------------------------------------------------------------   
}
//here loop is closed---------------------------------------------------------------------------------------------------------




?>