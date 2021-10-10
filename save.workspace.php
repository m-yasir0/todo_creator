<?php
require './conn.php';
$link= array();
if(isset ($_POST['save'])){
    //echo json_encode($_POST['graph']);
    $ser= json_encode($_POST['graph']);
    $sql= "INSERT INTO graph values ($ser)";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>