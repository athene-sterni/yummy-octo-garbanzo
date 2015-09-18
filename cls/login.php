<?
if(!defined('YOG_INCLUDE'))
   die('Direct access not permitted');
?>

<?

class LoginHandler {
	public static function login($username, $password, $dbConnection) {
		$account = new Account($dbConnection);
		if(!$account->byUsername($username))
			return FALSE;
		else
			return self::loginWithAccount($account, $password);
	}

	public static function loginWithAccount($account, $password) {
		$h = sha1($account->getSalt() . $password);
		$r = $h === $account->getPwHash();
		if($r) {
			$_SESSION['username'] = $account->getUsername();
		} else { unset($_SESSION['username']); session_destroy(); }
		return $r;
	}
}

?>
