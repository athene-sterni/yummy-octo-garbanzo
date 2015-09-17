<? define('YOG_INCLUDE', '42'); ?>

<?

include('config.php');

include('cls/validation.php');

include('cls/c/main.php');
include('cls/c/login.php');
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
if($account->byId(1) === FALSE)
	die('not found');

$controller = null;

switch($rqController) {
	case 'login':
		$controller = new LoginController($request, $rqAction, $dbConnection);
		break;
	default:
		$controller = new MainController($request, $rqAction, $dbConnection);
		break;
}
echo $controller->display(); 

?>
