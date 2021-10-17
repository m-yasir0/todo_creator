<?php
    session_start();
    if(isset($_SESSION) && isset($_SESSION['email']) && isset($_SESSION['type']) && isset($_SESSION['name'])){

    }else{
        header('Location:'.'./login.php?error=User%20not%20logged-in');
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Flow</title>
    <script src="./assets/Jquery.js"></script>
    <script src="./assets/loadash.js"></script>
    <script src="./assets/backbone.js"></script>
    <script src="./assets/joint.js"></script>
    <script src="./js/update.workspace.js"></script>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="./assets/bootstrap.style/styles.css">
    <link rel="stylesheet" href="style/style-edit.css">
</head>

<body style="overflow:hidden">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark d-flex flex-row-reverse">
        <a class="btn btn-success ml-2" href="./logout.php">Log Out</a>
        <?php
            if($_SESSION['type'] == "admin"){
                echo '<a class="btn btn-success" href="./user-management.php">Manage Users</a>';
            }
        ?>
        <a style= "color:white">Wellcome <?php echo $_SESSION['name'].' !';?></a>
        <button id= "create-group" class="btn btn-success" style="position: fixed; left: 40px">Create New Group</button>
    </nav>
    
    <div class="row">
        <div class="col-2">
            <ul class="list-group" id= "list-groups" style="overflow:auto; max-height: calc(100vh - 80px); top: 0">
                <?php require_once("./getAllGroups.php");?>
            </ul>
        </div>
        <div class="main col-9">
            <button id = "create-elem" type="button" disabled = 'true' class="btn btn-success m-2" onclick="createElem(`<div><img src ='./icon.png'/></div>`,'Label', 'up')">Create Element</button>

            <!-- Graph div
            Paper html element -->

            <div id="paper-html-elements"></div>
            <button id="update-group" disabled = 'true' class="btn btn-success" style="position: fixed; bottom:10px; right: 10px">Update Group</button>
            <button id="delete-group" disabled = 'true' class="btn btn-danger">Delete Group</button>
            <input id='color-picker' type='color' value='#0099ff' class="btn btn-warning" style= 'padding:0px'><span class='badge badge-warning'>Pick Element Colour</span></input>
            <!-- Edit popup
            element edit page popup -->

            <div id="id01" class="modal">

                <form name="edit-element" class="modal-content animate">
                    <div class="imgcontainer">
                        <span onclick="document.getElementById('id01').style.display='none'" class="close"
                            title="Close Modal">&times;</span>
                    </div>

                    <div class="container">
                        <label class="email-lab"><b>Name</b></label>
                        <input type="text" name="name" class="fields" required>

                        <span><b>Status</b></span>
                        <br>
                        <label class="pass-lab">Down</label>
                        <input type="radio" name="status" value="down">

                        <label class="pass-lab" style="margin-left: 20px;">Up</label>
                        <input type="radio" name="status" value="up" checked>

                        <br>
                        <br>

                        <label class="email-lab"><b>Last Changed</b></label>
                        <div class="" id="last-changed">dd-mm-yyyy,hh:mm</div>

                        <br>

                        <label class="email-lab"><b>URL</b></label>
                        <input type="text" name="url" class="fields">

                        <label class="email-lab"><b>Description</b></label>
                        <input type="text" name="description" class="fields">

                        <br>

                        <label class="email-lab"><b>Notes</b></label>
                        <textarea class="fields" name="notes"></textarea>

                        <button type="submit" id="save-edited-element">Save</button>
                    </div>

                    <div class="container" style="background-color:#f1f1f1">
                        <button type="button" onclick="document.getElementById('id01').style.display='none'"
                            class="cancelbtn">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

    <script src="./js/graph.js"></script>
    <script src="./js/manage-group.js"></script>
    <script src="./js/popup.js"></script>
</body>

</html>