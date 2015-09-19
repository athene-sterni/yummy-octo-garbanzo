<?
if(!defined('YOG_INCLUDE'))
   die('Direct access not permitted');
?>

<?

class DiscussionsController {  
  
	private $request = null;  
	private $template = '';  
	private $view = null;
  
	/* constructor */
	public function __construct($request, $action, $dbConnection){  
		$this->request = $request;
		$this->view = new View('');
		switch($action) {
			default:
				$this->template = 'discussions' . DIRECTORY_SEPARATOR . 'default';
				$this->showOverview($dbConnection);
				break;
		}
		$this->view->setTemplate($this->template);
	}  
  
	/* for display */
	public function display(){  
		return $this->view->loadTemplate();  
	}

	public function showOverview($dbConnection) {
		$this->view->setVar('entries', (new VDiscussions($dbConnection))->load());
	}

}  

?>
