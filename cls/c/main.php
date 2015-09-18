<?
if(!defined('YOG_INCLUDE'))
   die('Direct access not permitted');
?>

<?

class MainController {  
  
	private $request = null;  
	private $template = '';  
  
	/* constructor */
	public function __construct($request, $action){  
		$this->request = $request;  
		$this->template = 'main' . DIRECTORY_SEPARATOR . 'default';
	}  
  
	/* for display */
	public function display(){  
		$view = new View($this->template);  
		return $view->loadTemplate();  
	}  
}  

?>
