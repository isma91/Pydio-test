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
$pydio_path_exist = PydioController::check_pydio_path();
function go_to_view ($page) {
    if ($page === "home_page") {
        if (PydioController::check_pydio_path() === true) {
            include "./view/test.php";
        } else {
            include "./view/home_page.php";
        }
    } else {
        if (PydioController::check_pydio_path() === true) {
            include "./view/" . $page . ".php";
        } else {
            include "./view/home_page.php";
        }
    }
}
if ($_GET) {
    switch ($_GET["page"]) {
        case 'home':
        go_to_view("home_page");
        break;
        case 'test':
        go_to_view("test");
        break;
        default:
        go_to_view('home_page');
        break;
    }
} else {
    go_to_view("home_page");
}