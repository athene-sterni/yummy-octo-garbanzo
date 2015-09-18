-- Drop the tables
DROP TABLE IF EXISTS tbl_accounts;

-- 
CREATE TABLE tbl_accounts (
	id          INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username    VARCHAR(255) NOT NULL UNIQUE,
	email       VARCHAR(255) NOT NULL UNIQUE,
	pw_hash     TEXT NOT NULL,
	salt        VARCHAR(16) NOT NULL,
	tmp_pw_hash TEXT,
	last_login  DATETIME,
	last_update DATETIME NOT NULL
) ENGINE=INNODB;

INSERT INTO tbl_accounts(
	username, email, pw_hash,
	salt, tmp_pw_hash,
	last_login, last_update)
VALUES (
	'demo', 'demo@mroman.ch', '0de084f38ace8e3d82597f55cc6ad5d6001568e6',
	'123', NULL, NOW(), NOW());

--
CREATE TABLE tbl_discussions (
	id          INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	tag	        VARCHAR(63) NOT NULL,
	title       VARCHAR(255) NOT NULL,
	contents    TEXT NOT NULL,
	author      INT NOT NULL,
	last_update DATETIME NOT NULL,

	FOREIGN KEY (author) REFERENCES tbl_accounts(id)
	  ON DELETE CASCADE
) ENGINE=INNODB;

--
CREATE TABLE tbl_answers (
	id          INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	contents    TEXT NOT NULL,
	author      INT NOT NULL,
    parent      INT,

    FOREIGN KEY (author) REFERENCES tbl_accounts(id)
	  ON DELETE CASCADE,
	FOREIGN KEY (parent) REFERENCES tbl_answers(id)
	  ON DELETE CASCADE      
) ENGINE=INNODB;
