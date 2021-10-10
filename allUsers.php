<?php
    require_once('./conn.php'); 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if(isset($_SESSION) && isset($_SESSION['email']) && isset($_SESSION['type']) && $_SESSION['type'] == 'admin' && isset($_SESSION['name'])){
       $sql = "SELECT name, email, type FROM user_table";
       $res = $conn -> query($sql);
        if($res -> num_rows > 0){
            $table = '';
            while($row = $res->fetch_assoc()) {
                $table.= "<tr><td>".$row['email']."</td><td>".$row['name']."</td><td>".$row['type']."</td><td><div onClick= 'deleteUser(\"".$row['email']."\")' class='btn btn-sm btn-danger deleteRate' title='Delete'><i class='fa fa-trash'></i> Delete</div>";
            }
            echo $table;
        }
    }else{
        header('Location:'.'./index.php');
        die();
    }

?>