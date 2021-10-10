<?php
    require_once('./conn.php'); 
    session_start();
    if(isset($_SESSION) && isset($_SESSION['email']) && isset($_SESSION['type']) && $_SESSION['type'] == 'admin' && isset($_SESSION['name'])){
       if(isset($_POST) && isset($_POST['delete']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
           if($_POST['email'] == $_SESSION['email']){
               echo 'Admin cannot be deleted.';
           }else{
               if(!empty($_POST['email'])){
                    $sql = "DELETE FROM user_table WHERE email='".$_POST['email']."'";
                    $res = $conn -> query($sql);
                    if($res === TRUE){
                       echo 'User Deleted Successfully';
                    }
               }else{
                   echo 'Email required to delete User.';
               }
           }
       }
    }else{
        die();
    }
?>