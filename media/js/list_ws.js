/*jslint browser: true, node : false*/
/*jslint devel : true*/
/*global $, document, this, Materialize, window*/
$(document).ready(function () {
    "use strict";
    var path_to_ajax = "public_api/index.php";
    var list_ws;
    var button;
    var date;
    var year;
    var month;
    var month_names = ["January", "February", "March","April", "May", "June", "July","August", "September", "October","November", "December"];
    var day;
    var hours;
    var minutes;
    var seconds;
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
    $.post(path_to_ajax, {action: "list_workspace"}, function(data, textStatus) {
        if (textStatus === "success") {
            data = JSON.parse(data);
            if (data.error === null) {
                list_ws = "";
                $.each(data.data, function(index, object) {
                    if (object["@repositorySlug"] === "dashboard" || object["@repositorySlug"] === "welcome" || object["@repositorySlug"] === "inbox" || object["@repositorySlug"] === "settings") {
                        button = "";
                    } else {
                        button = "<p>Select this Workspace : <button class='waves-effect btn-flat worskapce_button' id='" + object["@id"] + "'><i class='material-icons right'>send</i></button></p>";
                    }
                    if (object["@meta_syncable_REPO_SYNCABLE"] == true) {
                        object["@meta_syncable_REPO_SYNCABLE"] = "Yes";
                    } else {
                        object["@meta_syncable_REPO_SYNCABLE"] = "No";
                    }
                    if (object["@last_connection"] === undefined) {
                        object["@last_connection"] = "Not connected";
                    } else {
                        date = new Date(object["@last_connection"] * 1000);
                        year = date.getFullYear();
                        month = date.getMonth();
                        day = date.getDate();
                        hours = date.getHours();
                        minutes = "0" + date.getMinutes();
                        seconds = "0" + date.getSeconds();
                        object["@last_connection"] = "The " + day + " " + month_names[month] + " " + year + " at " + hours + ":" + minutes.substr(-2) + ":" + seconds.substr(-2);
                    }
                    if (object["@acl"] === "rw") {
                        object["@acl"] = "Read & Write";
                    } else if (object["@acl"] === "r") {
                        object["@acl"] = "Only Read";
                    } else if (object["@acl"] === "w") {
                        object["@acl"] = "Only Write";
                    } else {
                        object["@acl"] = object["@acl"];
                    }
                    list_ws = list_ws + "<ul class='collapsible' data-collapsible='accordion'><li><div class='collapsible-header'>" + object["label"] + "</div><div class='collapsible-body'><p>Access Type : " + object["@access_type"] + "</p><p>ACL : " + object["@acl"] + "</p><p>id : " + object["@id"] + "</p><p>Date last Connexion : " + object["@last_connection"] + "</p><p>Syncable : " + object["@meta_syncable_REPO_SYNCABLE"] + "</p><p>Slug : " + object["@repositorySlug"] + "</p><p>Type : " + object["@repository_type"] + "</p><p>Description : " + object["description"] + "</p>" + button + "</div></li></ul>";
                });
                $("#list_ws").html(list_ws);
                $('.collapsible').collapsible({
                  accordion : true
              });
            } else {
                Materialize.toast("<p class='alert-failed'>" + data.error + "<p>", 3000, "rounded alert-failed");
            }
        } else {
            Materialize.toast("<p class='alert-failed'>Something is wrong while we try to send your Pydio login and password !!<p>", 3000, "rounded alert-failed");
        }
    });
    $(document).on('click', '.worskapce_button', function(event) {
        event.preventDefault();
        $.post(path_to_ajax, {action: 'select_ws', id_ws : $(this).attr('id')}, function(data, textStatus) {
            if (textStatus === "success") {
                data = JSON.parse(data);
                if (data.error === null) {
                    Materialize.toast("<p class='alert-success'>Workspace selected successfullly !!<p>", 1000, "rounded alert-success");
                    setTimeout(function () {
                        window.location = "?page=test";
                    }, 1000);
                } else {
                    Materialize.toast("<p class='alert-failed'>" + data.error + "<p>", 3000, "rounded alert-failed");
                }
            } else {
                Materialize.toast("<p class='alert-failed'>Something is wrong while we try to select the Workspace !!<p>", 3000, "rounded alert-failed");
            }
        });
    });
});