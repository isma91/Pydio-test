<?php
/**
* PydioController.php
*
* A controller to check your Pydio
*
* PHP 7.0.4-7ubuntu2.1 (cli) ( NTS )
*
* @category Controller
* @package  Controller
* @author   isma91 <ismaydogmus@gmail.com>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
*/
namespace controller;
use model\Pydio;
class PydioController extends Pydio
{
	private function _send_json($error, $data)
	{
		echo json_encode(array("error" => $error, "data" => $data));
	}

	static public function check_pydio_path ()
	{
		$file_to_search = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "pydio_path";
		if (!file_exists($file_to_search)) {
			return false;
		} else {
			return true;
		}
	}

	static public function is_connected ()
	{
		if (!self::check_pydio_path()) {
			return false;
		}
		if (!empty($_SESSION["pydio_test_login"]) && !empty($_SESSION["pydio_test_password"])) {
			return true;
		} else {
			return false;
		}
	}

	public function add_pydio_path ($pydio_path, $pydio_url)
	{
		if (self::check_pydio_path()) {
			$this->_send_json("You have already added a Pydio Path !!", null);
			return false;
		}
		$pydio_path = realpath($pydio_path);
		$pydio_version = file_get_contents(rtrim($pydio_path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . "conf" . DIRECTORY_SEPARATOR . "VERSION.php");
		if ($pydio_version === false) {
			$this->_send_json("Not a Pydio Path !!", null);
			return false;
		}
		preg_match_all('/define\("(.*?)"/', $pydio_version, $pydio_version_matches);
		if ($pydio_version_matches[1][0] === "AJXP_VERSION" && $pydio_version_matches[1][1] === "AJXP_VERSION_DATE" && $pydio_version_matches[1][2] === "AJXP_VERSION_REV" && $pydio_version_matches[1][3] === "AJXP_VERSION_DB") {
			$pydio_server = file_get_contents($pydio_url);
			if ($pydio_server !== '<?xml version="1.0" encoding="UTF-8"?><tree ><require_auth/></tree>') {
				$this->_send_json("The URL is not redirected to a Pydio !!", null);
				return false;
			}
			if (!file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "pydio_path", "path=" . $pydio_path . "\nurl=" . rtrim($pydio_url, "/") . "/")) {
				$this->_send_json("Can't create the file to save your pydio path !! Maybe a permission problem ??", null);
			} else {
				$this->_send_json(null, null);
			}
		} else {
			$this->_send_json("Not a Pydio Path !!", null);
			return false;
		}
	}

	private function _get_pydio_url ()
	{
		if (!self::check_pydio_path()) {
			return false;
		}
		$pydio_path = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "pydio_path");
		preg_match('/url=(.*?)$/', $pydio_path, $pydio_url);
		return $pydio_url[1];
	}

	public function good_user_pass ($login, $password)
	{
		$pydio_url = $this->_get_pydio_url();
		$url_api = "api/0/state/user?format=json";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $pydio_url . $url_api);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/xml", "Ajxp-Force-Login: true"));
		curl_setopt($curl, CURLOPT_USERPWD, $login . ":" . $password);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$return = json_decode(curl_exec($curl), true);
		curl_close($curl);
		if ($return === null) {
			return false;
		} else {
			return true;
		}
	}

	public function is_admin($login, $password)
	{
		$pydio_url = $this->_get_pydio_url();
		$url_is_admin = "api/0/state/user/special_rights?format=json";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $pydio_url . $url_is_admin);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/xml", "Ajxp-Force-Login: true"));
		curl_setopt($curl, CURLOPT_USERPWD, $login . ":" . $password);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$return = json_decode(curl_exec($curl), true);
		curl_close($curl);
		if ($return["special_rights"]["@is_admin"] == 1) {
			return true;
		} else {
			return false;
		}
	}

	public function login($login, $password)
	{
		if (!self::good_user_pass($login, $password)) {
			$this->_send_json("Bad login or password !!", null);
			return false;
		}
		if (!self::is_admin($login, $password)) {
			$this->_send_json("You are not an admin in your Pydio !!", null);
			return false;
		}
		$_SESSION["pydio_test_login"] = $login;
		$_SESSION["pydio_test_password"] = $password;
		$this->_send_json(null, null);
	}

	public function list_workspace ($login, $password)
	{
		if (!self::good_user_pass($login, $password)) {
			$this->_send_json("Bad login or password !!", null);
			return false;
		}
		if (!self::is_admin($login, $password)) {
			$this->_send_json("You are not an admin in your Pydio !!", null);
			return false;
		}
		$pydio_url = $this->_get_pydio_url();
		$url_list_workspace = "api/0/state/user/repositories?format=json";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $pydio_url . $url_list_workspace);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/xml", "Ajxp-Force-Login: true"));
		curl_setopt($curl, CURLOPT_USERPWD, $login . ":" . $password);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$return = json_decode(curl_exec($curl), true);
		curl_close($curl);
		$this->_send_json(null, $return["repositories"]["repo"]);
	}
}