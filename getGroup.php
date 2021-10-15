<?php
    require_once('./conn.php'); 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if(isset($_SESSION) && isset($_SESSION['email']) && isset($_SESSION['type']) && isset($_SESSION['name'])){
       if(isset($_POST) && isset($_POST['group']) && !empty($_POST['group'])){
           $sql =  "SELECT graph FROM groups WHERE group_id= '".$_POST['group']."' AND email= '".$_SESSION['email']."'";
           $result= $conn -> query($sql);
           if($result -> num_rows > 0){
               $row= $result -> fetch_assoc();
               echo "{\"statusCode\":200,\"body\":{\"graph\":".$row['graph']."}}";
           }else{
               echo '{statusCode: 404,body:{graph : "Graph Not found"}}';
               die();
           }
       }else{
           echo '{statusCode: 400,body:{graph : "Group is not entered"}}';
               die();
       }
    }else{
        header('Location:'.'./login.php?error=User%20not%20logged-in');
        die();
    }

?>