<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="A tool to test your Pydio or a new one" />
    <title>Welcome to Pydio-test !!</title>
    <?php include "media.html" ?>
    <script src="media/js/home_page.js"></script>
</head>
<body>
    <div class="container" id="the_body">
        <div class="row mui-panel">
            <h1 class="title">Welcome to Pydio-test !!</h1>
            <h2 class="title">Please write the full path of your Pydio in the input !!</h2>
            <h3 class="title">Don't works for Pydio get from github !!</h3>
        </div>
        <div class="row">
            <div class="input-field">
                <i class="material-icons prefix">location_searching</i>
                <input id="pydio_path" type="text" name="pydio_path">
                <label for="pydio_path">Path of your Pydio</label>
            </div>
            <div class="row end_button">
            <button class="waves-effect btn-flat" id="validate_pydio_path">Validate</button>
            </div>
        </div>
    </div>
</body>
</html>