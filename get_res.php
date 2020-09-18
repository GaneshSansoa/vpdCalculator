<?php
session_start();
include("config.php");
// var_dump($_POST);
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $max_q = "SELECT MAX(Date) as Date from dataset where user_id =".$_SESSION["id"]."";
    $min_q = "SELECT MIN(Date) as Date from dataset where user_id = ".$_SESSION["id"]."";
    $min_date;
    $max_date;
    $res1 = $conn->query($max_q);
    $res2 = $conn->query($min_q);
    // var_dump($res1);
    if($res1->num_rows > 0){
        while($row = mysqli_fetch_assoc($res1)){
            $max_date = $row["Date"];
        }
    }
    if($res2->num_rows > 0){
        while($row = mysqli_fetch_assoc($res2)){
            $min_date = $row["Date"];
        }
    }
    header("Content-type: application/json");
    echo json_encode(array("minDate" => $min_date,"maxDate" => $max_date));
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $start = $_POST["starts"];
    $end = $_POST["ends"];
    $a = "2019/10/06";
    $start = date('Y-m-d H:00:00', strtotime($start));
    $end = date('Y-m-d H:00:00', strtotime($end));
    // echo $myd;
    $query = "select HOUR(Date) as Date,Date(Date) as Date1,Date as Date2,Tapc,Eapc,Taos,Eaos from dataset where Date >= '".$start."' and Date <= '".$end."' and user_id='".$_SESSION["id"]."'";
    $res = $conn->query($query);
    $data = array();
    if($res->num_rows > 0){
        $i = 0;
        while($row = mysqli_fetch_assoc($res)){
            $data[$i] = array();
            $data[$i]["Date1"] = $row["Date1"];
            $data[$i]["Date2"] = $row["Date2"];
            $data[$i]["Date"] = $row["Date"];
            $data[$i]["Tapc"] = $row["Tapc"];
            $data[$i]["Eapc"] = $row["Eapc"];
            $data[$i]["Taos"] = $row["Taos"];
            $data[$i]["Eaos"] = $row["Eaos"];
            $i++;
        }
    }
    else{
    
    }
    header('Content-type: application/json');
    echo json_encode($data);
}


?>