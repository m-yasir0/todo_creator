<?php
require './conn.php';

if(isset ($_POST['save'])){
    $ser= json_encode($_POST['graph']);
    $sql= "INSERT INTO graph values ($ser)";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    //echo json_encode($_POST['graph']);
}
//$query= 'INSERT INTO graph values ({'ho: "ho"'}})'
?>