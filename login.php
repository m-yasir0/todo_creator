<?php
require_once('./conn.php');
$GLOBALS['err'] = $_GET && $_GET['error'] ? $_GET['error'] : null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['uname']) && !empty($_POST['password'])) {
        $this_pass = $_POST['password'];
        $uname = $_POST['uname'];
        $sql =  "SELECT * FROM users WHERE uname= '" . $uname . "'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (!empty($row) && password_verify($this_pass, $row['password'])) {
                session_start();
                $_SESSION['email'] = $row['email'];
                $_SESSION['uname'] = $row['uname'];
                header('Location:' . './index.php');
                die();
            } else {
                $err = "Username or password don't match";
            }
        } else {
            $err = "Username or password don't match";
        }
    } else {
        $err = 'Username and password required.';
    }
}
?>

<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Site Titlte Here</title>
    <link rel="icon" type="image/png" href="assets/images/favicon.png" sizes="16x16">
    <!-- bootstrap 5  -->
    <link rel="stylesheet" href="assets/css/lib/bootstrap.min.css">
    <!-- Icon Link  -->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/line-awesome.min.css">
    <link rel="stylesheet" href="assets/css/lib/animate.css">

    <!-- Plugin Link -->
    <link rel="stylesheet" href="assets/css/lib/slick.css">
    <link rel="stylesheet" href="assets/css/lib/magnific-popup.css">

    <!-- Main css -->
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>
    <!-- Overlay -->
    <div class="overlay"></div>
    <a href="javascript::void(0)" class="scrollToTop"><i class="las la-chevron-up"></i></a>


    <!-- Login-Section Starts Here -->
    <section class="login-section position-relative">
        <div class="container">
            <div class="form-wrapper">
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                    <?php
                    if (isset($err)) {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $err ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="form-group text-center">
                        <label for="" class="form-label">username</label>
                        <input name="uname" type="text" class="form-control form--control">
                    </div>
                    <div class="form-group text-center">
                        <label for="" class="form-label">password</label>
                        <input name="password" type="password" class="form-control form--control">
                    </div>
                    <div class="button-wrapper">
                        <a href="./signup.php" class="btn cmn--btn">sign-up</a>
                    </div>
                    <div class="button-wrapper mt-4">
                        <button type="submit" class="btn cmn--btn">login</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="border-shapes d-none d-lg-block">
            <div class="left-border">
                <img src="assets/images/left-border.svg" alt="images">
            </div>
            <div class="right-border">
                <img src="assets/images/right-border.svg" alt="images">
            </div>
        </div>
    </section>
    <!-- Login-Section Ends Here -->



    <!-- jQuery library -->
    <script src="assets/js/lib/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap 5 js -->
    <script src="assets/js/lib/bootstrap.min.js"></script>

    <!-- Pluglin Link -->
    <script src="assets/js/lib/slick.min.js"></script>
    <script src="assets/js/lib/magnific-popup.min.js"></script>
    <script src="assets/js/lib/wow.min.js"></script>

    <!-- Main js -->
    <script src="assets/js/main.js"></script>
</body>

</html>