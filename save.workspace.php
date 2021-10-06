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
<!-- {
   "cells": [
       {
           "type": "html.Element",
           "position": {
               "x": 135,
               "y": 138
           },
           "size": {
               "width": 100,
               "height": 50
           },
           "angle": 0,
           "id": "97ee53a3-659d-438c-854d-638e24401826",
           "label": "label",
           "select": "box",
           "image_src": "<div><img src ='./icon.png'/></div>",
           "z": 1,
           "attrs": {}
       },
       {
           "type": "standard.Link",
           "source": {
               "id": "97ee53a3-659d-438c-854d-638e24401826"
           },
           "target": {},
           "id": "4120e70a-b2a3-4a3e-beb0-e0918525d132",
           "connector": {
               "name": "smooth"
           },
           "z": 2,
           "attrs": {
               "line": {
                   "stroke": "#222222",
                   "strokeWidth": 3
               }
           }
       }
   ]
} -->