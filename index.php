 <?php
/**
* Index.php
*
* PHP 7.0.4-7ubuntu2.1 (cli) ( NTS )
*
* @category Controller
* @package  Controller
* @author   isma91 <ismaydogmus@gmail.com>
* @author   devraph0 <https://github.com/devraph0>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
*/
session_start();
require 'autoload.php';
use controller\PydioController;
function go_to_view ($page) {
    if ($page === "home_page") {
        if (PydioController::check_pydio_path() === true && PydioController::is_connected() === false) {
            include "./view/login.php";
        } elseif (PydioController::check_pydio_path() === false && PydioController::is_connected() === false) {
            include "./view/home_page.php";
        } elseif (PydioController::is_connected() === true) {
            include "./view/list_ws.php";
        } 
    } else {
        if (PydioController::check_pydio_path() === true && PydioController::is_connected() === false) {
            include "./view/login.php";
        } elseif (PydioController::check_pydio_path() === false && PydioController::is_connected() === false) {
            include "./view/home_page.php";
        } elseif (PydioController::is_connected() === true) {
            include "./view/" . $page . ".php";
        }
    }
}
if ($_GET) {
    switch ($_GET["page"]) {
        case 'home':
        go_to_view("home_page");
        break;
        case 'login':
        go_to_view("login");
        break;
        case 'list_ws':
        go_to_view("list_ws");
        break;
        default:
        go_to_view('home_page');
        break;
    }
} else {
    go_to_view("home_page");
}