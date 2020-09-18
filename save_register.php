<?php
include('config.php');
if(!isset($_GET["username"]) && !isset($_GET["password"])){
    header("Location: index.php");
    exit();
}
else{
    $username = $_GET["username"];
    $password = $_GET["password"];
    $hash = password_hash($password,PASSWORD_DEFAULT);
    // echo $password;
    $query = "insert into accounts(username,password,type) values('".$username."','".$hash."','U')";
    if($conn->query($query) === TRUE){
        echo "User Registered...";
$from = 'noreply@hex.com';
$to_email = $username;
$subject = 'Your account for VPD Module';
$message = '<html><body>';
$message .= '<p>username: '. $username . '</p>';
$message .= '<p>password: '. $password . '</p>';
$message .='<a href ="http://vpd.agromet-advisories.online">Click to login</a>';
$message .='</body></html>';
// $message = wordwrap($message,1000);
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
mail($to_email,$subject,$message,$headers);
    }
    else{
        echo $conn->error;
    }
}


?>