<?
if(!defined('YOG_INCLUDE'))
   die('Direct access not permitted');
?>

<?

class VDiscussions {

	private static $dbConnection = null;
	private $entries = null;
	

	public function __construct($dbConnection) {
		$this->dbConnection = $dbConnection;
	}

	public function validate() {
		if($this->username === null ||
		   $this->email === null ||
		   $this->pw_hash === null ||
		   $this->salt === null)
			throw new Exception('Invalid null fields!');
	}

	

	public function load() {
		$stmt = $this->dbConnection->prepare("SELECT * FROM vw_discussions");

		if(!$stmt->execute())
			 $this->queryFail($stmt);

		$data = array();

		while($row = $stmt->fetch()) {
			$entry = array();
			$entry['discussion_id'] = $row['discussion_id'];
			$entry['account_id'] = $row['account_id'];
			$entry['author_username'] = $row['author_username'];
			$entry['recent_date'] = $row['recent_date'];
			$entry['discussion_title'] = $row['discussion_title'];
			$entry['num_answers'] = $row['num_answers'];
			array_push($data, $entry);
		}

		$this->entries = $data;
		return $data;
	}

	public function getEntries() {
		return $this->entries;
	}
	

	public function queryFail($stmt) {
		throw new Exception('Query failed: ' . var_export($this->dbConnection->errorInfo(), TRUE) . ';' . var_export($stmt->errorInfo(), TRUE));
	}

	
}

?>
