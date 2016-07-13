/*jslint browser: true, node : false*/
/*jslint devel : true*/
/*global $, document, this, Materialize, window*/
$(document).ready(function () {
    "use strict";
    var path_to_ajax = "public_api/index.php";
    var div_error;
    function press_enter(selector, go_function) {
        $(document).on("keyup", selector, function (event) {
            if (event.keyCode === 13) {
                go_function();
            }
        });
    }
    $(document).on('mousedown', "#display_pass", function() {
        $("#password").prop("type", "text");
    });
    $(document).on('mouseup', "#display_pass", function() {
        $("#password").prop("type", "password");
    });
    function list_workspace() {
        div_error = "";
        $("#div_error").html("");
        if ($.trim($("#login").val()) === "") {
            div_error = div_error + "<p>Empty login !!</p>";
        }
        if ($("#password").val() === "") {
            div_error = div_error + "<p>Empty password !!</p>";
        }
        if (div_error !== "") {
            $("#div_error").html(div_error);
        } else {
            $.post(path_to_ajax, {action: "list_workspace", login: $.trim($("#login").val()), password: $("#password").val()}, function(data, textStatus) {
                if (textStatus === "success") {
                    data = JSON.parse(data);
                    console.log(data);
                    if (data.error === null) {
                    } else {
                        Materialize.toast("<p class='alert-failed'>" + data.error + "<p>", 3000, "rounded alert-failed");
                    }
                } else {
                    Materialize.toast("<p class='alert-failed'>Something is wrong while we try to send your Pydio login and password !!<p>", 3000, "rounded alert-failed");
                }
            });
        }
    }
    $(document).on('click', '#connexion', function(event) {
        event.preventDefault();
        list_workspace();
    });
    press_enter("#login", list_workspace);
    press_enter("#password", list_workspace);
});