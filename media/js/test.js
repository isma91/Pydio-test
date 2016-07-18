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
    $.post(path_to_ajax, {action: 'get_workspace_name'}, function(data, textStatus) {
        if (textStatus === "success") {
            data = JSON.parse(data);
            if (data.error === null) {
                $("#workspace_name").html(data.data);
            } else {
                Materialize.toast("<p class='alert-failed'>" + data.error + "<p>", 3000, "rounded alert-failed");
            }
        } else {
            Materialize.toast("<p class='alert-failed'>Something is wrong while we try to get the workspace name !!<p>", 3000, "rounded alert-failed");
        }
    });
    function press_enter(selector, go_function) {
        $(document).on("keyup", selector, function (event) {
            if (event.keyCode === 13) {
                go_function();
            }
        });
    }
    function api_create_file () {
        $("#create_file_div").html("");
        if ($.trim($("#api_create_file_input").val()) !== "") {
            $.post(path_to_ajax, {action: 'api_create_file', file_name : $.trim($("#api_create_file_input").val())}, function(data, textStatus) {
                if (textStatus === "success") {
                    data = JSON.parse(data);
                    if (data.error === null) {
                        Materialize.toast("<p class='alert-success'>File created successfully !!<p>", 3000, "rounded alert-success");
                    } else {
                        Materialize.toast("<p class='alert-failed'>" + data.error + "<p>", 3000, "rounded alert-failed");
                    }
                } else {
                    Materialize.toast("<p class='alert-failed'>Something is wrong while we try to test the API !!<p>", 3000, "rounded alert-failed");
                }
            });
        } else {
            $("#create_file_div").html("<div class='row' id='div_error'>Name of the file EMPTY !!</div>");
        }
    }
    $(document).on("click", "#create_file_button", function(event) {
        event.preventDefault();
        api_create_file();
    });
    press_enter("#api_create_file_input", api_create_file);
    $(document).on("click", "#create_folder_button", function(event) {
        event.preventDefault();
        $.post(path_to_ajax, {action: 'api_create_folder'}, function(data, textStatus) {
            if (textStatus === "success") {
                data = JSON.parse(data);
                if (data.error === null) {
                } else {
                    Materialize.toast("<p class='alert-failed'>" + data.error + "<p>", 3000, "rounded alert-failed");
                }
            } else {
                Materialize.toast("<p class='alert-failed'>Something is wrong while we try to test the API !!<p>", 3000, "rounded alert-failed");
            }
        });
    });
    $(document).on("click", "#rename_file_button", function(event) {
        event.preventDefault();
        $.post(path_to_ajax, {action: 'api_rename_file'}, function(data, textStatus) {
            if (textStatus === "success") {
                data = JSON.parse(data);
                if (data.error === null) {
                } else {
                    Materialize.toast("<p class='alert-failed'>" + data.error + "<p>", 3000, "rounded alert-failed");
                }
            } else {
                Materialize.toast("<p class='alert-failed'>Something is wrong while we try to test the API !!<p>", 3000, "rounded alert-failed");
            }
        });
    });
    $(document).on("click", "#copy_file_button", function(event) {
        event.preventDefault();
        $.post(path_to_ajax, {action: 'api_copy_file'}, function(data, textStatus) {
            if (textStatus === "success") {
                data = JSON.parse(data);
                if (data.error === null) {
                } else {
                    Materialize.toast("<p class='alert-failed'>" + data.error + "<p>", 3000, "rounded alert-failed");
                }
            } else {
                Materialize.toast("<p class='alert-failed'>Something is wrong while we try to test the API !!<p>", 3000, "rounded alert-failed");
            }
        });
    });
    $(document).on("click", "#delete_file_button", function(event) {
        event.preventDefault();
        $.post(path_to_ajax, {action: 'api_delete_file'}, function(data, textStatus) {
            if (textStatus === "success") {
                data = JSON.parse(data);
                if (data.error === null) {
                } else {
                    Materialize.toast("<p class='alert-failed'>" + data.error + "<p>", 3000, "rounded alert-failed");
                }
            } else {
                Materialize.toast("<p class='alert-failed'>Something is wrong while we try to test the API !!<p>", 3000, "rounded alert-failed");
            }
        });
    });
    $(document).on("click", "#move_file_button", function(event) {
        event.preventDefault();
        $.post(path_to_ajax, {action: 'api_move_file'}, function(data, textStatus) {
            if (textStatus === "success") {
                data = JSON.parse(data);
                if (data.error === null) {
                } else {
                    Materialize.toast("<p class='alert-failed'>" + data.error + "<p>", 3000, "rounded alert-failed");
                }
            } else {
                Materialize.toast("<p class='alert-failed'>Something is wrong while we try to test the API !!<p>", 3000, "rounded alert-failed");
            }
        });
    });
});