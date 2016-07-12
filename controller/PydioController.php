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

	public function add_pydio_path ($pydio_path)
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
			if (!file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "pydio_path", $pydio_path)) {
				$this->_send_json("Can't create the file to save your pydio path !! Maybe a permission problem ??", null);
			} else {
				$this->_send_json(null, null);
			}
		} else {
			$this->_send_json("Not a Pydio Path !!", null);
			return false;
		}
	}
}