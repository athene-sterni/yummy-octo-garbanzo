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
	private $salt = null;
	private $tmp_pw_hash = null;
	private $last_login = null;
	private $last_update = null;
	

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

	public function insert() {
		$this->validate(); 

		$stmt = $this->dbConnection->prepare("
			INSERT INTO tbl_accounts(
				username, email, pw_hash,
				salt, tmp_pw_hash,
				last_login, last_update)
			VALUES (
				:username, :email, :pw_hash,
				:salt, :tmp_pw_hash, :last_login, NOW());");

		$stmt->bindParam(':username', $this->username, PDO::PARAM_STR);
		$stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
		$stmt->bindParam(':pw_hash', $this->pw_hash, PDO::PARAM_STR);
		$stmt->bindParam(':salt', $this->salt, PDO::PARAM_STR);
		$stmt->bindParam(':tmp_pw_hash', $this->tmp_pw_hash, PDO::PARAM_STR);
		$stmt->bindParam(':last_login', $this->last_login, PDO::PARAM_STR);
		
		if(!$stmt->execute())
			$this->queryFail($stmt);
	}

	public function update() {
		$stmt = $this->dbConnection->prepare("
			UPDATE tbl_accounts SET
				username = :username,
				email = :email,
				pw_hash = :pw_hash,
				salt = :salt,
				tmp_pw_hash = :tmp_pw_hash,
				last_login = :last_login,
				last_update = NOW()
			WHERE id = :id");

		$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
		$stmt->bindParam(':username', $this->username, PDO::PARAM_STR);
		$stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
		$stmt->bindParam(':pw_hash', $this->pw_hash, PDO::PARAM_STR);
		$stmt->bindParam(':salt', $this->salt, PDO::PARAM_STR);
		$stmt->bindParam(':tmp_pw_hash', $this->tmp_pw_hash, PDO::PARAM_STR);
		$stmt->bindParam(':last_login', $this->last_login, PDO::PARAM_STR);
		
		if(!$stmt->execute())
			$this->queryFail($stmt);
	}

	public function byId($id) {
		$stmt = $this->dbConnection->prepare("SELECT * FROM tbl_accounts WHERE id = :id");
		$stmt->bindParam(':id', intval($id), PDO::PARAM_INT);

		if(!$stmt->execute())
			 $this->queryFail($stmt);

		if($row = $stmt->fetch()) {
			$this->username = $row['username'];
			$this->email = $row['email'];
			$this->pw_hash = $row['pw_hash'];
			$this->tmp_pw_hash = $row['tmp_pw_hash'];
			$this->last_login = $row['last_login'];
			$this->last_update = $row['last_update'];
			$this->salt = $row['salt'];
			$this->id = intval($row['id']);

			return TRUE;
		}
		else {
			return FALSE;
		}
	}

	public function byUsername($username) {
		$stmt = $this->dbConnection->prepare("SELECT * FROM tbl_accounts WHERE username = :username");
		$stmt->bindParam(':username', $username, PDO::PARAM_STR);

		if(!$stmt->execute())
			 $this->queryFail($stmt);

		if($row = $stmt->fetch()) {
			$this->username = $row['username'];
			$this->email = $row['email'];
			$this->pw_hash = $row['pw_hash'];
			$this->tmp_pw_hash = $row['tmp_pw_hash'];
			$this->last_login = $row['last_login'];
			$this->last_update = $row['last_update'];
			$this->salt = $row['salt'];
			$this->id = intval($row['id']);

			return TRUE;
		}
		else {
			return FALSE;
		}
	}

	public function byEmail($email) {
		$stmt = $this->dbConnection->prepare("SELECT * FROM tbl_accounts WHERE email = :email");
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);

		if(!$stmt->execute())
			 $this->queryFail($stmt);

		if($row = $stmt->fetch()) {
			$this->username = $row['username'];
			$this->email = $row['email'];
			$this->pw_hash = $row['pw_hash'];
			$this->tmp_pw_hash = $row['tmp_pw_hash'];
			$this->last_login = $row['last_login'];
			$this->last_update = $row['last_update'];
			$this->salt = $row['salt'];
			$this->id = intval($row['id']);

			return TRUE;
		}
		else {
			return FALSE;
		}
	}

	public function queryFail($stmt) {
		throw new Exception('Query failed: ' . var_export($this->dbConnection->errorInfo(), TRUE) . ';' . var_export($stmt->errorInfo(), TRUE));
	}

	public function getUsername() { return $this->username; }
	public function getEmail() { return $this->email; }
	public function getPwHash() { return $this->pw_hash; }
	public function getTmpPwHash() { return $this->tmp_pw_hash; }
	public function getLastLogin() { return $this->last_login; }
	public function getLastUpdate() { return $this->last_update; }
	public function getSalt() { return $this->salt; }

	public function setLastLogin($value) {
		if($value !== null)
			Validation::isValidDateTime_($value);

		$this->last_login = $value;
	}

	public function setLastLoginToNow() {
		$this->setLastLogin(date('Y-m-d H:i:s'));
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function setUsername($username) {
		$this->username = $username;
	}

	public function setPassword($password) {
		$this->setSalt('123');
		$this->setPwHash(sha1($this->getSalt() . $password));
	}

	public function setPwHash($pw_hash) {
		$this->pw_hash = $pw_hash;
	}

	public function setSalt($salt) {
		$this->salt = $salt;
	}

}

?>
