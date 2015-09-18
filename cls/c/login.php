<?
if(!defined('YOG_INCLUDE'))
   die('Direct access not permitted');
?>

<?

class LoginController {  
  
    private $request = null;  
    private $template = '';  
  
    /* constructor */
    public function __construct($request, $action, $dbConnection){  
        $this->request = $request;
		switch($action) {
			case 'login':
				$this->template = 'login' . DIRECTORY_SEPARATOR . 'login';
				LoginHandler::login($request['username'], $request['password'], $dbConnection);
				break;
			default:
				$this->template = 'login' . DIRECTORY_SEPARATOR . 'default';
				break;
		}
    }  
  
    /* for display */
    public function display(){  
        $view = new View($this->template);  
        return $view->loadTemplate();  
    }  
}  

?>
