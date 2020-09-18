<?php
session_start();
if(!isset($_SESSION["loggedin"])){
    header("Location: index.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
<?php include_once("common-head.php");?>
  <body>
  <?php include_once("nav.php");?>


    <main role="main" class="container">

      <div class="container">
	  	<div class="row">
			<div class="col-sm-12">
				<div class="card" style="padding:20px;margin-bottom:20px;">
					<h5>Instructions to Upload CSV</h5>
					<ul>
						<li>Download this <a href="sample_format.csv">Sample.csv</a> file. Ensure that each field hold its particular values and with proper formats.</li>
						<li>Date Field must be in DateTime Format. E.g. yyyy-m-d h:mm (2016-12-6 0:00)</li>
						<li>Tapc and Eapc are inside temprature and humidity respectively.</li>
						<li>Taos and Eaos are outside temprature and humidity respectively.</li>
					</ul>
				</div>
			</div>  
		</div>
		<div class="row justify-content-center">
		  <div class="col-sm-6">
			   <form method="post" class="border" onsubmit="return false;" id="upload_data" enctype="multipart/form-data">
			   <div class="form-group">
               <label for="csv_data"><strong>Upload CSV:</strong></label>
               <input type="file" class="form-control-file border" required name="csv_data">
			   </div>
               <div class="form-group">
               <input type="submit" name="upload" class="form-control btn btn-dark" value="Upload">
                </div>
			   </form>			
		  </div>
	  
		</div>
		<div class="container">
		<div class="row justify-content-center">
			<div class="col-sm-6">
				<div id="upload_result">
				
				</div>
			</div>
		</div>
</div>
	<!-- <table id="show_data" class="table_data table table-border">
		
	</table> -->
      </div>

    </main><!-- /.container -->


    <?php 
    include_once("footer.php");    
    include_once("common-js.php");?>
    <script>
	$(document).ready(function(){
		$("#upload_data").on("submit",function(){
			// console.log($("input[type='file']").val());
			// var formData = new FormData($(this)[0]);
			// console.log(formData);
			var ext = $('input[type="file"]').val().split('.').pop().toLowerCase();
			if($.inArray(ext, ['csv']) == -1) {
				$("#upload_result").html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>\
					<center><h4>Wrong File Format...</h4>\
					<p>Reason: Uploaded Format .'+ ext +' allowed .csv</p></center>\
					');
			}
			else{
				$.ajax({
				url:"submit_data.php",
				type:"POST",
				contentType:false,
				processData:false,
				data:new FormData($("#upload_data")[0]),
				beforeSend:function(){
					$("#upload_result").html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>\
	 				<center><h4>Uploading Data Please Be Patient...</h4>\
					 <p>More Data requires more time to upload</p>\
					 </center>');
				},

				success:function(res){
				// $.each(res,function(key,value){
				// $("#show_data").append("<tr>")
				// 	$.each(value, function(key,value){
				// 		// console.log(key + ": " + value);
				// 		$("#show_data").append("<td>"+ value +"</td>")
				// 	})
				// $("#show_data").append("</tr>")
				console.log(res.msg);
					if(res.msg == "success"){
						var htm = '';

						if(res.error > 0){
							htm += "<select class='form-control'> <option>Reasons:</option>"
							$.each(res.error_reason,function(key,value){
								console.log(value);
								htm+= "<option>"+value+"</option>";
							})
							htm+="</select>";
						}
						$("#upload_result").html('<i class="fa fa-check"></i>\
					<center><h4>Data Uploaded(Look below for details..)</h4>\
					<p>Total Entries: '+res.enteries+', Successfully Stored Entries: '+res.success+', Total Errors: '+res.error+'</p>\
					'+htm+'\
					</center>');						
					}
					else{
						$("#upload_result").html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>\
					<center><h4>Could not Upload Data...</h4>\
					<p>Reason: '+res.reason+'</p></center>\
					');
					}
				}
				})
				
				}
			
			});
		
		})

	
	
	
	
	
	
    </script>

  </body>
</html>
