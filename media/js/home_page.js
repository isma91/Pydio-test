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
    function take_pydio_path() {
        if ($.trim($("#pydio_path").val()) === "") {
            Materialize.toast("<p class='alert-failed'>Empty Pydio Path !!<p>", 1000, "rounded alert-failed");
            return false;
        }
        $.post(path_to_ajax, {action: "add_pydio_path", pydio_path: $.trim($("#pydio_path").val())}, function (data, textStatus) {
            if (textStatus === "success") {
                data = JSON.parse(data);
                if (data.error === null) {
                    Materialize.toast("<p class='alert-success'>Pydio path added successfully !!<p>", 750, "rounded alert-success");
                    setTimeout(function () {
                        window.location = "?page=test";
                    }, 1000);
                } else {
                    Materialize.toast("<p class='alert-failed'>" + data.error + "<p>", 3000, "rounded alert-failed");
                }
            } else {
                Materialize.toast("<p class='alert-failed'>Something is wrong while we try to add your Pydio path !!<p>", 3000, "rounded alert-failed");
            }
        });
    }
    $(document).on("click", "#validate_pydio_path", function (event) {
        event.preventDefault();
        take_pydio_path();
    });
    press_enter("#pydio_path", take_pydio_path);
});