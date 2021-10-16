<?php
    require_once('./conn.php'); 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if(isset($_SESSION) && isset($_SESSION['email']) && isset($_SESSION['type']) && isset($_SESSION['name'])){
        if(isset ($_POST['save']) && isset($_POST['group']) && !empty($_POST['group']) && isset($_POST['graph']) && !empty($_POST['graph'])){
            $ser= json_encode($_POST['graph']);
            $sql= "UPDATE groups SET graph = $ser WHERE email ='". $_SESSION['email']."' && group_id = '".$_POST['group']."'";
            if ($conn->query($sql) === TRUE) {
                echo "Group Updated successfully";
            } else {
                // " . $sql . "<br>" . $conn->error
                echo "Error: Could not Update Group!";
            }
        }else if(isset ($_POST['delete']) && isset($_POST['group']) && !empty($_POST['group'])){
            $sql= "DELETE FROM groups WHERE email ='". $_SESSION['email']."' && group_id = '".$_POST['group']."'";
            if ($conn->query($sql) === TRUE) {
                echo "Group deleted successfully";
            } else {
                // " . $sql . "<br>" . $conn->error
                echo "Error: Could not Delete Group!";
            }
        }
        else if(isset ($_POST['create']) && isset($_POST['group']) && !empty($_POST['group'])){
            $sql= "INSERT INTO groups values ('".$_POST['group']."', '".$_SESSION['email']."', '".'{"cells":[]}'."')";
            if ($conn->query($sql) === TRUE) {
                echo "Group created successfully";
            } else {
                // " . $sql . "<br>" . $conn->error
                echo "Group Already exists!";
            }
        }
        else{
            echo "Error: No group OR graph selected";
        }
    }
    else{
        die();
    }

?>