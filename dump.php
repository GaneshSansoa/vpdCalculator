<!doctype html>
<html lang="en">
  
<?php include_once("common-head.php");?>
  <body>

<?php include_once("nav.php");?>
    
    <main role="main" class="container-fluid" id="page-container">

      <div class="container">
		<div class="row justify-content-center">
        <h4 id="show_data"></h4>
            <div class="col-6">
            <form action="" id="upload_req" onsubmit="return false;">
            <div class="row justify-content-center">
            <div class="col-6 form-group">
            <label for="starts">Start Date:</label>
            <input type="text" name="starts" class="form-control" id="example1">
            </div>
            <div class="col-6 form-group">
            <label for="ends">End Date:</label>
            <input type="text" name="ends" class="form-control" id="example2">
            </div>
            
            <div class="col-6 form-group">
            <input type="submit" class="btn btn-dark col-12 form-control" value="Submit">
            </div>
            


            </div>
            
                <!-- <input type="text" name="ends">
                <input type="text" class="form-control" id="example"> -->
            </form>

		      </div>

	  
	    	</div>
        
   
          </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12" id="res">
                    <h4>Results:</h4>
                    <canvas id="myChart" width="" height=""></canvas>
                </div>
            </div>

        </div>

        </div>
        </div>


    </main><!-- /.container -->
        

    <?php
    include_once("footer.php");    
    include_once("common-js.php");
    ?>
    <script>
	$(document).ready(function(){
    $("#res").hide();
    var min_date,max_date;
        $.ajax({
            url:'get_res.php',
            type:'GET',
            dataType:'json',
            success:function(res){

                $("#show_data").html("Data is Available from: " + res.minDate + " to " + res.maxDate);
                min_date = res.minDate;
                max_date = res.maxDate;
                console.log(min_date);
                $('#example1').datetimepicker({
                    format:'YYYY/MM/DD HH:mm:ss',
                    sideBySide:true,
                    minDate:min_date,
                    maxDate:max_date            
                });
                $('#example2').datetimepicker({
                    format:'YYYY/MM/DD HH:mm:ss',
                    sideBySide:true,
                    minDate:min_date,
                    maxDate:max_date,
                });
            }
        });

 		$("#upload_req").submit(function(){
            $.ajax({
                url:"get_res.php",
                type:"POST",
                data:$(this).serialize(),
                success:function(res){
                    $("#res").show();
                    var time = [];
                    var inside_vpd = [];
                    var outside_vpd = [];
                    for(var i = 0; i < res.length; i++){
                        if(res[i].Date == "0"){
                            time[i] = res[i].Date1;
                            // console.log("Fired...");
                        }
                        else{
                            time[i] = res[i].Date + ":00";
                        }
                        var sat_vap_pressure = 0.7392 * Math.exp(0.06264 * res[i].Tapc * (Math.exp(-0.0019 * res[i].Date)));
                        var actual_vap_pressure = 0.8427 * (res[i].Eapc) / 100 * Math.exp(0.06264 * res[i].Tapc * Math.exp(-0.0019 * res[i].Date) - 0.00021 * res[i].Date);
                         inside_vpd[i] = sat_vap_pressure - actual_vap_pressure;
                        // inside_temp[i] = res[i].Tapc;
                        // inside_hum = res[i].Eapc;
                        // outside_temp = res[i].Taos;
                        outside_vpd[i] = 0.7392 * ( 1 - res[i].Eaos/100 ) * Math.exp(0.058 * res[i].Taos);
                    }
                    console.log(time);
                    console.log(outside_vpd);
                    var ctx = document.getElementById('myChart');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: time,
                    datasets: [
                        {
                        label: 'Inside Vapour Pressure Deficits',
                        data: inside_vpd,
                        fill:false,
                        borderColor:'rgb(255,0,0)' 
                    },
                    {
                        label:'Outside Vapour Pressure Deficts',
                        data: outside_vpd,
                        fill:false,
                        borderColor:'rgb(0,255,0)'
                    }],
                    
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: false
                            },

                        }]
                    },
                    responsive:true,
                    intersect:true,
                }
            });
                }
            })
        })
	
	
	
	})
	
	
	
	
	
	
    </script>
        <script>
            
            </script>
  </body>
</html>
