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
    <script src="./js/save.workspace.js"></script>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/style-edit.css">
</head>

<body>
    <div class="main">
        <!-- <div class="grouping">
            <ul id="myUL">
                <li><span class="caret">Beverages</span>
                    <ul class="nested">
                        <li>Water</li>
                        <li>Coffee</li>
                        <li><span class="caret">Tea</span>
                            <ul class="nested">
                                <li>Black Tea</li>
                                <li>White Tea</li>
                                <li><span class="caret">Green Tea</span>
                                    <ul class="nested">
                                        <li>Sencha</li>
                                        <li>Gyokuro</li>
                                        <li>Matcha</li>
                                        <li>Pi Lo Chun</li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>

        </div> -->

        <!-- Create menu dropdown
        Select Different Elem -->

        <?php
            if($_SESSION['type'] == "admin"){
                echo '<a href="./user-management.php">Manage Users</a>';
            }
        ?>
        <a href="./logout.php">Log Out</a>
        <div class="dropdown">
            <button class="dropbtn">Create<i class="arrow down"></i></button>
            <div class="dropdown-content">

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'Generator', 'up')">Generator</a>
                <hr>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'Encoder', 'up')">Encoder</a>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'Decoder', 'up')">Decoder</a>
                <hr>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'Switch', 'up')">Switch</a>
                <hr>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'UDP/RTP source', 'up')">UDP/RTP
                    source</a>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'UDP/RTP sink', 'up')">UDP/RTP sink</a>
                <hr>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'push source', 'up')">Push Source</a>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'push sink', 'up')">Push Sink</a>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'pull source', 'up')">Pull Source</a>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'pull source multi', 'up')">Pull Source
                    multi</a>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'pull sink', 'up')">Pull Sink</a>
                <hr>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'RIST source', 'up')">RIST source</a>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'RIST sink', 'up')">RIST sink</a>
                <hr>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'SRT source', 'up')">SRT source</a>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'SRT sink', 'up')">SRT sink</a>
            </div>
        </div>
        <button onclick="createLink()">create Link</button>
        <button onclick="serializeGraph()">Serialize Graph</button>
        <button id="save">Save</button>
        <button onclick="createGraphFromJson()">Create Graph</button>
        <button onclick="document.getElementById('id01').style.display='block'">Open modal</button>

        <!-- Graph div
        Paper html element -->

        <div id="paper-html-elements"></div>

        <!-- Edit popup
        element edit page popup -->

        <div id="id01" class="modal">

            <form class="modal-content animate" action="/action_page.php" method="post">
                <div class="imgcontainer">
                    <span onclick="document.getElementById('id01').style.display='none'" class="close"
                        title="Close Modal">&times;</span>
                </div>

                <div class="container">
                    <label class="email-lab"><b>Name</b></label>
                    <input type="text" name="name" class="fields">

                    <span><b>Status</b></span>
                    <br>
                    <label class="pass-lab">Down</label>
                    <input type="radio" name="down" value="down">

                    <label class="pass-lab" style="margin-left: 20px;">Up</label>
                    <input type="radio" name="down" value="up" checked>

                    <br>
                    <br>

                    <label class="email-lab"><b>Last Changed</b></label>
                    <div class="">dd-mm-yyyy,hh:mm</div>

                    <br>

                    <label class="email-lab"><b>URL</b></label>
                    <input type="text" name="url" class="fields">

                    <label class="email-lab"><b>Description</b></label>
                    <input type="text" name="description" class="fields">

                    <br>

                    <label class="email-lab"><b>Notes</b></label>
                    <textarea class="fields" name="notes"></textarea>

                    <button type="submit">Submit</button>
                </div>

                <div class="container" style="background-color:#f1f1f1">
                    <button type="button" onclick="document.getElementById('id01').style.display='none'"
                        class="cancelbtn">Cancel</button>
                </div>
            </form>
        </div>

        <script src="./js/graph.js"></script>
</body>

</html>