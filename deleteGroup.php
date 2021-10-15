<?php
    require_once('./conn.php'); 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if(isset($_SESSION) && isset($_SESSION['email']) && isset($_SESSION['type']) && isset($_SESSION['name'])){
       if(isset($_POST) && isset($_POST['group']) && !empty($_POST['group'])){
           $sql =  "DELETE FROM groups WHERE group_id= '".$_POST['group']."' AND email= '".$_SESSION['email']."'";
           $result= $conn -> query($sql);
           if($result){
               echo '{statusCode: 200,body: "Group deleted successfully"}';
           }else{
               echo '{statusCode: 400,body:"Cannot delete group"}';
               die();
           }
       }else{
           echo '{statusCode: 400,body:"Group is not entered"}';
               die();
       }
    }else{
        header('Location:'.'./login.php?error=User%20not%20logged-in');
        die();
    }

?>