<?
if(!defined('YOG_INCLUDE'))
   die('Direct access not permitted');
?>

<?


/*
	Validation methods returning TRUE or FALSE. If suffixed with an underscore
	the method will not return a boolean but throw an Exception or pass. 
*/

class Validation {

	public static function isValidDateTime($dt) {
		$result = preg_match('/[0-9]{4}\\-[0-9]{2}\\-[0-9]{2}\\s[0-9]{2}:[0-9]{2}:[0-9]{2}/', $dt);

		if($result !== 1)
			return FALSE;
		
		return TRUE;
	}

	public static function isValidDateTime_($dt) {
		if(!self::isValidDateTime($dt)) throw new Exception('Invalid format');
	}

}

?>
