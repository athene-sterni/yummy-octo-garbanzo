-- Drop the tables
DROP TABLE IF EXISTS tbl_accounts;

-- 
CREATE TABLE tbl_accounts (
	id          INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username    VARCHAR(255) NOT NULL,
	email       TEXT NOT NULL,
	pw_hash     TEXT NOT NULL,
	salt        VARCHAR(16) NOT NULL,
	tmp_pw_hash TEXT,
	last_login  DATETIME NOT NULL,
	last_update DATETIME NOT NULL
) ENGINE=INNODB;
