<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="./assets/Jquery.js"></script>
    <script src="./assets/loadash.js"></script>
    <script src="./assets/backbone.js"></script>
    <script src="./assets/joint.js"></script>
    <script src="./save.workspace.js"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        .html-element button.delete {
    color: white;
    border: none;
    background-color: #C0392B;
    border-radius: 20px;
    width: 15px;
    height: 15px;
    line-height: 15px;
    text-align: middle;
    position: absolute;
    top: -15px;
    left: -15px;
    padding: 0;
    margin: 0;
    font-weight: bold;
    cursor: pointer;
}
.html-element button.delete:hover {
    width: 20px;
    height: 20px;
    line-height: 20px;
}
    </style>
</head>

<body>
    <div class="main">
        <div class="dropdown">
            <button class="dropbtn">Create<i class="arrow down"></i></button>
            <div class="dropdown-content">

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'label', 'box')">Generator</a>
                <hr>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'label', 'box')">Encoder</a>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'label', 'box')">Decoder</a>
                <hr>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'label', 'box')">Switch</a>
                <hr>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'label', 'box')">UDP/RTP source</a>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'label', 'box')">UDP/RTP sink</a>
                <hr>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'label', 'box')">Push Source</a>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'label', 'box')">Push Sink</a>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'label', 'box')">Pull Source</a>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'label', 'box')">Pull Source multi</a>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'label', 'box')">Pull Sink</a>
                <hr>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'label', 'box')">RIST source</a>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'label', 'box')">RIST sink</a>
                <hr>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'label', 'box')">SRT source</a>

                <a onclick="createElem(`<div><img src ='./icon.png'/></div>`,'label', 'box')">SRT sink</a>
            </div>
        </div>
        <button onclick="createLink()">create Link</button>
        <button onclick="serializeGraph()">Serialize Graph</button>
        <button id="save">Save</button>
        <button onclick="createGraphFromJson()">Create Graph</button>
        <div id="paper-html-elements"></div>
        <script src="./form.js"></script>
</body>

</html>