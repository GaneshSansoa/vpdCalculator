<?php
session_start();
if(!isset($_SESSION["loggedin"]) && !isset($_SERVER["REQUEST_METHOD" == "POST"])    ){
    header("Location: index.php");
    exit();    
}
?>
<?php

include('config.php');
//var_dump($_FILES);
$sucess_counter = 0;
$error_counter = 0;
$error_reason = array();
$counter = 0;
function validateDate($date, $format = 'Y-n-j G:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}
$file = $_FILES["csv_data"]["tmp_name"];
    /* Map Rows and Loop Through Them */
    $rows   = array_map('str_getcsv', file($file));
    $header = array_shift($rows);
    $csv    = array();
    foreach($rows as $row) {
        $csv[] = array_combine($header, $row);
    }
    if($header[0] == "Date" && $header[1] == "Tapc" && $header[2] == "Eapc" && $header[3] == "Taos" && $header[4] == "Eaos"){
        for($i = 0; $i < count($csv); $i++){
            // echo $csv[$i]["Date"];
            // var_dump(validateDate("2016-6-12 12:00:00"));
            // var_dump(is_a($csv[$i]["Date"],'DateTime'));
 
            // var_dump(validateDate($csv[$i]["Date"]));
           if(validateDate($csv[$i]["Date"]) === false){
                $error_counter +=1;
                $counter = $i + 1;
                $error_reason[$i] = "Wrong Date Format at row: $counter";                
           }
           else{
            // echo $csv[$i]["Date"];
            $query = "insert into dataset(Date,Tapc,Eapc,Taos,Eaos) 
            values('".$csv[$i]["Date"]."',
            '".$csv[$i]["Tapc"]."',
            '".$csv[$i]["Eapc"]."',
            '".$csv[$i]["Taos"]."',
            '".$csv[$i]["Eaos"]."'        
            )";
            if($conn->query($query) === TRUE){
                $sucess_counter += 1;          
            }
            else{
                $error_counter += 1;
                $error_reason[$i] = "At row $counter $conn->error";
            }
            $counter = $i+1;
           }

        }
        header('Content-type: application/json');
        echo json_encode(array("msg"=>"success","success"=>$sucess_counter,"error" => $error_counter,"error_reason"=>$error_reason,"enteries"=>$counter)); 

    }
    else{
        header('Content-type: application/json');
        echo json_encode(array("msg"=>"fail","reason"=>"Wrong CSV Format..."));
    }


?>