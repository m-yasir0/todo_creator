<?php
    require_once('./conn.php');
    $GLOBALS['err']= $_GET && $_GET['error'] ? $_GET['error'] : null;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(!empty($_POST['email']) && !empty($_POST['password'])){
            $this_pass= $_POST['password'];
            $email = $_POST['email'];
            $sql =  "SELECT * FROM user_table WHERE email= '".$email."'";
            $result= $conn -> query($sql);
            if($result -> num_rows > 0){
                $row= $result -> fetch_assoc();
                if(!empty($row) && password_verify($this_pass, $row['password'])){
                    session_start();
                    $_SESSION['type']= $row['type'];
                    $_SESSION['email']= $row['email'];
                    $_SESSION['name']= $row['name'];
                    header('Location:'.'./index.php');
                    die();
                }else{
                    $err = "Username or password don't match";
                }
            }else{
                $err = "Username or password don't match";
            }
        }else{
            $err= 'Email and password required.';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./style/style-login.css">
</head>
<body>
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
        <h1 class="text">Login</h1>
        <hr>
        <div class="center-login">
            <div class="error">* 
                <?php if(isset($err)){
                        echo $err;
                    }else
                        echo 'Enter email and password';
                ?></div>
            <div>
                <label class="email-lab">Email</label>
                <input type="email" name="email" class="fields" requred>
            </div>

            <br>
            <br>

            <div>
                <label class="pass-lab">Password</label>
                <input type="password" name="password" class="fields" required>
            </div>

            <br>

            <input type="submit" name='login' value='Login'>

        </div>
    </form>
</body>
</html>