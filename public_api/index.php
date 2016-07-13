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
	case 'list_workspace':
	$pydio->list_workspace($_POST["login"], $_POST["password"]);
	break;
}