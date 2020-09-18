<?php 
if($_SERVER["REQUEST_METHOD"] != "POST"){
    header("Location: index.php");
    exit();
}
include('config.php');
// var_dump($_POST);
$username = $_POST["username"];
$password = $_POST["password"];
$db_pass;
$id;
$query = 'SELECT id,username,password from accounts where username="'.$username.'"';
$result = $conn->query($query);
if($result->num_rows > 0){
    while($row = mysqli_fetch_assoc($result)){
        $db_pass = $row["password"];
        $id = $row["id"];
    }
    // echo $password;
    if(password_verify($password,$db_pass)){
        session_start();
        $_SESSION["loggedin"] = TRUE;
        $_SESSION["name"] = $username;
        $_SESSION["id"] = $id;
        header('Content-type: application/json');
        echo json_encode(array("type"=>"success"));
        // header("Location: mod1.php");
        // exit(); 
    }
    else{
        header('Content-type: application/json');
        echo json_encode(array("type"=>"error","reason"=>"Wrong Password..."));
    }
}
else{
    header('Content-type: application/json');
        echo json_encode(array("type"=>"error","reason"=>"Wrong Username..."));
}
?>