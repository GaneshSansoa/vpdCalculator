
<?php
$server = "localhost";
$user = "agrometa_vpd";
$password = "vpd@vpd.com";
$conn = new mysqli($server,$user,$password,"agrometa_vpd");
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
// $createtime = str_replace("/","-","12/10/2018");
// echo $createtime;
// die;
?>
