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

    <?php 
    include_once("nav.php");
    ?>

    <main role="main" class="container">

      <div class="container">
          <div class="row justify-content-center">
            <div class="col-sm-6 border" id="upload_internal">
                    <h4>Vapour Pressure Deficit(Inside)</h4>
                    <div class="form-group">
                            <label for="air_temp">Air Temprature in plant community(<sup>o</sup>C)</label>
                            <input type="text" class="form-control" name="air_temp">
                    </div>
                    <div class="form-group">
                            <label for="rel_hum">Relative Humidity in plant community(%)</label>
                            <input type="text" class="form-control" name="rel_hum">
                    </div>

                    <button class="btn btn-primary" id="calc_vpd">Calculate</button>
                </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-sm-6 result border">

            </div>
          </div>

      </div>

    </main><!-- /.container -->


    <?php
    include_once("footer.php");    
    include_once("common-js.php");?>
    
    <script>
        $(document).ready(function(){
            $(".result").hide();
            $("#calc_vpd").click(function(){
                var temp = $("input[name=air_temp]").val();
                var hum = $("input[name=rel_hum]").val();
                var calc_result = 0.7392 * ( 1 - hum/100 ) * Math.exp(0.058 * temp);
                $(".result").show();
                $(".result").html("<h5>VPD is: "+calc_result + "</h5>");
            })
        });
    </script>
    
</body>
</html>
