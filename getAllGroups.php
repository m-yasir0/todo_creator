<?php
require_once('./conn.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION) && isset($_SESSION['email']) && isset($_SESSION['type']) && isset($_SESSION['name'])) {
    $sql =  "SELECT group_id FROM groups WHERE email= '" . $_SESSION['email'] . "'";
    $result = $conn->query($sql);
    $data = '';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data .= '<li class="list-group-item"><button class="btn btn-block"  onclick= "openGroup(this)">' . $row['group_id'] . '</button></li>';
        }
        echo $data;
    } else {
        echo '<div class="alert alert-warning"><strong>No saved group!</strong> Start by creating a new Group.</div>';
    }
} else {
    die();
}
