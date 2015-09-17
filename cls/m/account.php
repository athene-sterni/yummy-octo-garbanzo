<?
if(!defined('YOG_INCLUDE'))
   die('Direct access not permitted');
?>

<?

class Account {

	private static $dbConnection = null;

	private $username = null;
	private $email = null;
	private $pw_hash = null;
	private $tmp_pw_hash = null;
	private $last_login = null;
	private $last_update = null;

	public function __construct($dbConnection) {
		$this->dbConnection = $dbConnection;
	}

	public function byId($id) {
		$stmt = $this->dbConnection->prepare("SELECT * FROM tbl_accounts WHERE id = :id");
		$stmt->bindParam(':id', intval($id), PDO::PARAM_INT);
		$stmt->execute() or die('Query failed (account::byId)');
		if($row = $stmt->fetch()) {

			$this->username = $row['username'];
			$this->email = $row['email'];
			$this->pw_hash = $row['pw_hash'];
			$this->tmp_pw_hash = $row['tmp_pw_hash'];
			$this->last_login = $row['last_login'];
			$this->last_update = $row['last_update'];

			return TRUE;
		}
		else {
			return FALSE;
		}
	}

	public function getUsername() { return $this->username; }
	public function getEmail() { return $this->email; }
	public function getPwHash() { return $this->pw_hash; }
	public function getTmpPwHash() { return $this->tmp_pw_hash; }
	public function getLastLogin() { return $this->last_login; }
	public function getLastUpdate() { return $this->last_update; }

	public function setLastLogin($value) {
		Validation::isValidDateTime($value) or die('Invalid format (account::setLastLogin)');

		$this->last_login = $value;
	}

	

}

?>
