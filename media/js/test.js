/*jslint browser: true, node : false*/
/*jslint devel : true*/
/*global $, document, this, Materialize, window*/
$(document).ready(function () {
    "use strict";
    var path_to_ajax = "public_api/index.php";
    $(document).on('click', '#logout', function(event) {
        event.preventDefault();
        $.post(path_to_ajax, {action: 'logout'}, function(data, textStatus) {
            if (textStatus === "success") {
                data = JSON.parse(data);
                if (data.error === null) {
                    Materialize.toast("<p class='alert-success'>Logout successfulll !!<p>", 1000, "rounded alert-success");
                    setTimeout(function () {
                        window.location = "?page=login";
                    }, 1000);
                } else {
                    Materialize.toast("<p class='alert-failed'>" + data.error + "<p>", 3000, "rounded alert-failed");
                }
            } else {
                Materialize.toast("<p class='alert-failed'>Something is wrong while we try to logout !!<p>", 3000, "rounded alert-failed");
            }
        });
    });
});