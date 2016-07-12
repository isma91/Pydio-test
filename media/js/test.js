/*jslint browser: true, node : false*/
/*jslint devel : true*/
/*global $, document, this, Materialize, window*/
$(document).ready(function () {
    "use strict";
    var path_to_ajax = "public_api/index.php";
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
});