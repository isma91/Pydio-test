<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="A tool to test your Pydio or a new one" />
    <title>Welcome to Pydio-test !!</title>
    <?php include "media.html" ?>
    <script src="media/js/test.js"></script>
</head>
<body>
    <div class="container" id="the_body">
        <div class="row mui-panel">
            <h1 class="title">Welcome to Pydio-test !!</h1>
            <h2 class="title">You can test your Pydio here !!</h2>
        </div>
        <div class="row col s12">
            <div class="input-field col s6">
                <i class="material-icons prefix">face</i>
                <input id="login" type="text">
                <label for="login">Login</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">vpn_key</i>
                <i class="material-icons right" id="display_pass">visibility</i>
                <input id="password" type="password">
                <label for="password">Password</label>
            </div>
            <div class="row end_button">
                <button class="waves-effect btn-flat" id="connexion">Connexion</button>
            </div>
        </div>
    </div>
</body>
</html>