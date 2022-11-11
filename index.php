<?php
session_start();
if (isset($_SESSION) && isset($_SESSION['email']) && isset($_SESSION['uname'])) {
} else {
    header('Location:' . './login.php?error=User%20not%20logged-in');
    die();
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


    <header>
        <div class="custom-container">
            <div class="d-flex flex-wrap justify-content-between">
                <div class="left-header">
                    <a href="" class="custom-logo"><img src="assets/images/logo.svg" alt=""></a>
                </div>
                <div class="right-header">
                    <div class="ico-list d-flex">
                        <div class="icon-item d-flex align-items-center">
                            <img src="assets/images/coin1.svg" alt="icon">
                            <h2 class="coin-number">69</h2>
                        </div>
                        <div class="icon-item">
                            <img src="assets/images/settings.svg" alt="icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="banner">
        <img src="assets/images/banner.png" alt="thumb" class="mw-100">
    </div>

    <div class="bottom-menu-wrapper">
        <div class="custom-container">
            <ul class="menu-list d-flex justify-content-between">
                <li>
                    <img src="assets/images/shop.svg" alt="icon">
                </li>
                <li>
                    <img src="assets/images/profile.svg" alt="icon">
                </li>
                <li>
                    <a href="./create.php"><img src="assets/images/task.svg" alt="icon" class="middle-icon"></a>
                </li>
                <li>
                    <img src="assets/images/todo.svg" alt="icon">
                </li>
                <li>
                    <img src="assets/images/completed.svg" alt="icon">
                </li>
                <li>
                    <a class="btn btn-success ml-2" href="./logout.php">Log Out</a>
                </li>
            </ul>
        </div>
    </div>



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