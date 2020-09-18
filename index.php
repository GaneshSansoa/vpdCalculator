<?php 
session_start();
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
          
            <div class="col-sm-6 border" id="">
            <center><h4>Login</h4></center>
              <form method="post" id="form_submit" onsubmit="return false;">                    
                <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" required class="form-control" name="username">
                </div>
                <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" required class="form-control" name="password">
                </div>
                <p>Dont have Account? <a href="register.php"> Register Here!</a></p>
                <div class="form-group">
                <input type="submit" class="form-control btn btn-dark" value="Login">
                </div>
              </form>

                </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-sm-6">
              <div id="upload_result">
              
              </div>
            </div>
          </div>


      </div>

    </main><!-- /.container -->


    <?php
    include_once("footer.php");    
    include_once("common-js.php");?>
    
    <script>
        $(document).ready(function(){
          $("#form_submit").submit(function(){
            $.ajax({
              url:"login_attempt.php",
              type:"POST",
              dataType:"json",
              data:$("#form_submit").serialize(),
              success:function(res){
                if(res.type == "success"){
                  $("#upload_result").html('<i class="fa fa-check" aria-hidden="true"></i>\
                  <center><h4>Successfully Logged In...</h4>\
                  <p>Redirecting.....</p></center>\
                  ');
                  window.location.replace("mod1.php");
                }
                else{
                  $("#upload_result").html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>\
                  <center><h4>Login Failed</h4>\
                  <p>Reason: '+res.reason+'</p></center>\
                  ');

                }
              }
            })
          })
        });
    </script>
    
</body>
</html>
