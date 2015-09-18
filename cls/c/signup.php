<?
if(!defined('YOG_INCLUDE'))
   die('Direct access not permitted');
?>

<?

class SignUpController {  
  
    private $request = null;  
    private $template = '';  
	private $view = null;
  
    /* constructor */
    public function __construct($request, $action, $dbConnection){  
        $this->request = $request;
		$this->view = new View('');
		switch($action) {
			case 'signup':
				$this->template = 'signup' . DIRECTORY_SEPARATOR . 'default';
				
				$this->doSignUp($request, $dbConnection);

				break;
			default:
				$this->template = 'signup' . DIRECTORY_SEPARATOR . 'default';
				$this->view->setVar('password', Lang::$L_PASSWORD);
				$this->view->setVar('email', Lang::$L_EMAIL);
				$this->view->setVar('username', Lang::$L_USERNAME);
				break;
		}
		$this->view->setTemplate($this->template);
    }  
  
    /* for display */
    public function display(){  
        return $this->view->loadTemplate();  
    }  

	public function doSignUp($request, $dbConnection) {
		$account = new Account($dbConnection);
		$account->setPassword($request['password']);
		$account->setUsername($request['username']);
		$account->setEmail($request['email']);
		$account->insert();
	}
}  

?>
