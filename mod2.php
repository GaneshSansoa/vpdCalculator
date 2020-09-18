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
          <div class="row justify-content-center">
            <div class="col-6 border" id="upload_outer">
                    <h4>Vapour Pressure Deficit(Outside)</h4>
                    <div class="form-group">
                            <label for="air_temp">Air Temprature(<sup>o</sup>C)</label>
                            <input type="text" class="form-control" name="air_temp">
                    </div>
                    <div class="form-group">
                            <label for="rel_hum">Relative Humidity of outside air time t(%)</label>
                            <input type="text" class="form-control" name="rel_hum">
                    </div>
                    <div class="form-group">
                            <label for="outside_time">Time</label>
                            <select name="outside_time" id="" class="form-control">
                                <?php
                                for($i = 0 ; $i <= 24; $i++){
                                    ?>
                                    <option value="<?php echo $i?>"><?php echo $i?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <!-- <input type="text" name="outside_time" class="form-control" id=""> -->
                    </div>
                    <button class="btn btn-primary" id="calc_vpd">Calculate</button>
                </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-6 result border">

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
                console.log(Math.exp(Math.exp(-0.0019 * t)));
                var temp = $("input[name=air_temp]").val();
                var hum = $("input[name=rel_hum]").val();
                var t = $("select[name=outside_time]").val();
                console.log(Math.exp(-0.0019 * t));

                var sat_vap_pressure = 0.7392 * Math.exp(0.06264 * temp * (Math.exp(-0.0019 * t)));
                var actual_vap_pressure = 0.8427 * (hum) / 100 * Math.exp(0.06264 * temp * Math.exp(-0.0019 * t) - 0.00021 * t);
                var vapour_pressure = sat_vap_pressure - actual_vap_pressure;
                $(".result").show();
                $(".result").html("<h5>Saturated Vapour Pressure is: "+ sat_vap_pressure.toFixed(2) + "</h5>\
                    <h5>Actual Vapour Pressure is: "+ actual_vap_pressure.toFixed(2) +"</h5>\
                    <h5>Vapour Pressure Deficit is: "+ vapour_pressure.toFixed(2) +"</h5>");
            })
        });
    </script>
    
</body>
</html>
