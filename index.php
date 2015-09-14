<?

include('cls/c/main.php');
include('cls/c/login.php');
include('cls/v/view.php');
   
$request = array_merge($_GET, $_POST);   

$rqController = $request['c'];
$rqAction = $request['a'];

$controller = null;

switch($rqController) {
	case 'login':
		$controller = new LoginController($request, $rqAction);
		break;
	default:
		$controller = new MainController($request, $rqAction);
		break;
}
echo $controller->display(); 

?>
