<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="A tool to test your Pydio or a new one" />
    <title>Welcome to Pydio-test !!</title>
    <?php include "media.html" ?>
    <script src="media/js/list_ws.js"></script>
</head>
<body>
    <div class="container" id="the_body">
        <div class="row mui-panel">
            <h1 class="title">Welcome to Pydio-test !!</h1>
            <h2 class="title">Select a Workspace to begin the test !!</h2>
        </div>
        <div class="row end_button">
                <button class="waves-effect btn-flat" id="logout">Logout</button>
            </div>
        <div class="row" id="div_error"></div>
        <div class="row col s12" id="list_ws"></div>
    </div>
</body>
</html>