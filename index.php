<? define('YOG_INCLUDE', '42'); ?>


<?
class Lang {
	public static $L_USERNAME = 'Username';
	public static $L_PASSWORD = 'Password';
	public static $L_LOGIN_TEXT = 'Please provide your credentials to log yourself in or create a new account:';
	public static $L_SIGNUP_TEXT = 'Please provide your information to sign up:';
	public static $L_EMAIL = 'E-Mail';
}
?>

<?

try { 

		include('config.php');

		include('cls/validation.php');

		include('cls/c/main.php');
		include('cls/c/login.php');
		include('cls/c/signup.php');
		include('cls/v/view.php');

		include('cls/m/account.php');
		   
		$request = array_merge($_GET, $_POST);   

		$rqController = $request['c'];
		$rqAction = $request['a'];

		$dbConnection = null;

		try {
			$dbConnection = new PDO(
				$CFG_DBO_CONNECTION_STRING,
				$CFG_DBO_CONNECTION_USER,
				$CFG_DBO_CONNECTION_PASSWORD);	
		}
		catch (PDOException $ex) {
			die('Connection to database could not be established!');
		}

		$account = new Account($dbConnection);
		if($account->byUsername('demo') === FALSE)
			die('not found');

		$controller = null;

		switch($rqController) {
			case 'login':
				$controller = new LoginController($request, $rqAction, $dbConnection);
				break;
			case 'signup':
				$controller = new SignUpController($request, $rqAction, $dbConnection);
				break;
			default:
				$controller = new MainController($request, $rqAction, $dbConnection);
				break;
		}
		echo $controller->display(); 

}
catch(Exception $ex) {
		error_log('Something went wrong:');
		error_log($ex);
		echo 'Site temporarily down. Please wait.';
}

?>
