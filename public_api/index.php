<?php
/**
* Index.php
*
* All ajax request go here and be sended to different Controller
*
* PHP 7.0.4-7ubuntu2.1 (cli) ( NTS )
*
* @category Controller
* @package  Controller
* @author   isma91 <ismaydogmus@gmail.com>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
*/
session_start();
require '../autoload.php';
use controller\PydioController;
$pydio = new PydioController();
switch ($_POST["action"]) {
	case 'add_pydio_path':
	$pydio->add_pydio_path($_POST["pydio_path"], $_POST["pydio_url"]);
	break;
	case 'login':
	$pydio->login($_POST["login"], $_POST["password"]);
	break;
	case 'logout':
	$pydio->logout();
	break;
	case 'list_workspace':
	$pydio->list_workspace();
	break;
	case 'select_ws':
	$pydio->select_ws($_POST["id_ws"]);
	break;
	case 'get_workspace_name':
	$pydio->get_workspace_name();
	break;
	case 'api_create_file':
	$pydio->api_create_file($_POST["file_name"]);
	break;
	case 'api_create_folder':
	$pydio->api_create_folder();
	break;
	case 'api_rename_file':
	$pydio->api_rename_file();
	break;
	case 'api_copy_file':
	$pydio->api_copy_file();
	break;
	case 'api_delete_file':
	$pydio->api_delete_file();
	break;
	case 'api_move_file':
	$pydio->api_move_file();
	break;
	default:
	echo json_encode(array("error" => "Not a valid action !!", "data" => null));
	break;
}