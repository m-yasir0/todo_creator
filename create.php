<?php
require_once('./conn.php');
session_start();
if (isset($_SESSION) && isset($_SESSION['email']) && isset($_SESSION['uname'])) {
} else {
    header('Location:' . './login.php?error=User%20not%20logged-in');
    die();
}
function createNewTodo($days, $des, $name, $conn)
{
    $sql = "INSERT INTO todo (description, days, name) VALUES ('$des', '$days', '$name')";
    if ($conn->query($sql)) {
        header('Location:' . './successful.html');
    } else if ($conn->error) {
        return "Unexpected error while creating todo.";
    }
}

if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST['days']) && !empty($_POST['description']) && !empty($_POST['name'])) {
        $msg = createNewTodo($_POST['days'], $_POST['description'], $_POST['name'], $conn);
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


    <!-- Home-Page Starts Here -->
    <section class="home-page">
        <div class="home-shape1">
            <a href="./index.php"><img src="assets/images/home-button 1.svg" alt="images"></a>
        </div>
        <div class="container">
            <h2 class="create-title text-center">Create a Task</h2>
            <div class="row gy-4">
                <div class="col-lg-6">
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
                        <div class="contact-form">
                            <div class="form-group border-none form-group-2">
                                <label for="" class="form-label2">Task Name:</label>
                                <input name="name" type="text" class="form-control form--control2" placeholder="Ex) Take out trash">
                                <p class="mb-0 text-end">0/30</p>
                            </div>
                            <div class="form-group border-none form-group-2">
                                <label for="" class="form-label2">Days to Complete:</label>
                                <input name="days" type="number" class="form-control form--control2" placeholder="Ex) 5">
                                <p class="mb-0 text-end">Must be a number</p>
                            </div>
                            <div class="form-group border-none">
                                <label for="" class="form-label2">Task Details:</label>
                                <textarea name="description" class="form-control form--control2" placeholder="Ex)  Take out the trash in the living room and the kitchen"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 align-self-end">
                            <div class="text-center mb-5">
                                <button type="submit" class="submit-button">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Home-Page Ends Here -->




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