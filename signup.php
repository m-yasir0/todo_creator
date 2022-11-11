<?php
require_once('./conn.php');
function createNewUser($name, $email, $password, $conn)
{
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (email, password, uname) VALUES ('$email', '$password', '$name')";
    if ($conn->query($sql)) {
        header('Location:' . './confirmation.html');
    } else if ($conn->error) {
        if (!strpos($conn->error, "Duplicate")) {
            return "User already exists.";
        } else {
            return "Unexpected error while creating user.";
        }
    }
}

if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST['uname']) && !empty($_POST['password']) && !empty($_POST['email'])) {
        if ($_POST['password'] != $_POST['re_password']) {
            $msg = 'Password donot match';
        } else {
            $msg = createNewUser($_POST['uname'], $_POST['email'], $_POST['password'], $conn);
        }
    } else {
        $msg = 'Some fields are missing !';
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
                    if (isset($msg)) {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $msg ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="form-group text-center">
                        <label for="" class="form-label">username</label>
                        <input type="text" name="uname" class="form-control form--control">
                    </div>
                    <div class="form-group text-center">
                        <label for="" class="form-label">password</label>
                        <input type="password" name="password" class="form-control form--control">
                    </div>
                    <div class="form-group text-center">
                        <label for="" class="form-label">re-entered password</label>
                        <input type="password" name="re_password" class="form-control form--control">
                    </div>
                    <div class="form-group text-center">
                        <label for="" class="form-label">E-mail</label>
                        <input type="email" name="email" class="form-control form--control">
                    </div>
                    <div class="button-wrapper">
                        <button type="submit" class="btn cmn--btn">sign-up</button>
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