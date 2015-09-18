<?
if(!defined('YOG_INCLUDE'))
   die('Direct access not permitted');
?>

<?

class View {  

	/* path and default template */
	private $path = 'templates';
	private $template = 'default';

	/* Template variables */
	private $_ = array();  

	
	/* Constructor */
	public function __construct($template) {
		$this->template = $template;
	}

	public function setTemplate($template) {
		$this->template = $template;
	}

	/* Set the value of a template variable */
	public function setVar($key, $value){  
		$this->_[$key] = $value;  
	}  

	
	/* Load the template (through include) */
	public function loadTemplate(){  
		$tpl = $this->template;   
		$file = $this->path . DIRECTORY_SEPARATOR . $tpl . '.php';  
		$exists = file_exists($file);  

		if ($exists){  
	  
			//Buffer output (you can even stack those)
			ob_start();  
      
 			include $file;  
			$output = ob_get_contents();  

			ob_end_clean();  
  
			return $output;  
		}  
		else {  
			die('Template file does not exist!');
		}  
	}
}  

?>
