<?
if(!defined('YOG_INCLUDE'))
   die('Direct access not permitted');
?>

<?

class Validation {

	public static function isValidDateTime($dt) {
		$result = preg_match('/[0-9]{4}\\-[0-9]{2}\\-[0-9]{2}\\s[0-9]{2}:[0-9]{2}:[0-9]{2}/', $dt);

		if($result !== 1)
			return FALSE;
		
		return TRUE;
	}

}

?>
