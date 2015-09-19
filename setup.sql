-- Drop the tables
DROP VIEW IF EXISTS vw_discussions;

DROP TABLE IF EXISTS tbl_answers;
DROP TABLE IF EXISTS tbl_discussions;
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


CREATE TABLE tbl_discussions (
	id          INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	tag	        VARCHAR(63) NOT NULL,
	title       VARCHAR(255) NOT NULL,
	contents    TEXT NOT NULL,
	author      INT NOT NULL,
	create_date DATETIME NOT NULL,
	last_update DATETIME NOT NULL,
	recent_date DATETIME NOT NULL,

	FOREIGN KEY (author) REFERENCES tbl_accounts(id)
	  ON DELETE CASCADE
) ENGINE=INNODB;


CREATE TABLE tbl_answers (
	id          INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	contents    TEXT NOT NULL,
	author      INT NOT NULL,
    parent      INT,
    discussion	INT NOT NULL,
	create_date DATETIME NOT NULL,
	last_update DATETIME NOT NULL,

	FOREIGN KEY (author) REFERENCES tbl_accounts(id)
	  ON DELETE CASCADE,
	FOREIGN KEY (parent) REFERENCES tbl_answers(id)
	  ON DELETE CASCADE,
	FOREIGN KEY (discussion) REFERENCES tbl_discussions(id)
	  ON DELETE CASCADE
) ENGINE=INNODB;

INSERT INTO tbl_discussions(
	tag, title, contents, author,
	create_date, last_update, recent_date)
VALUES(
	'yolo', 'title#1', 'discussion#1', 1,
	NOW(), NOW(), NOW());

INSERT INTO tbl_discussions(
	tag, title, contents, author,
	create_date, last_update, recent_date)
VALUES(
	'yolo', 'title#2', 'discussion#2', 1,
	NOW(), NOW(), NOW());

INSERT INTO tbl_answers(
	contents, author, parent, discussion,
	create_date, last_update)
VALUES(
	'hi there', 1, NULL, 1, NOW(), NOW());

INSERT INTO tbl_answers(
	contents, author, parent, discussion,
	create_date, last_update)
VALUES(
	'hi there too', 1, 1, 1, NOW(), NOW());

INSERT INTO tbl_answers(
	contents, author, parent, discussion,
	create_date, last_update)
VALUES(
	'hi there as well', 1, 2, 1, NOW(), NOW());

CREATE VIEW vw_discussions AS
SELECT
	tbl_discussions.id as discussion_id, 
	tbl_accounts.id as account_id, 
	tbl_accounts.username as author_username,
	tbl_discussions.recent_date as recent_date,
	tbl_discussions.title as discussion_title,
	(SELECT COUNT(tbl_answers.id) 
	 FROM tbl_answers
	 WHERE tbl_answers.discussion = tbl_discussions.id) as num_answers
FROM tbl_discussions 
LEFT JOIN tbl_accounts 
ON tbl_accounts.id = tbl_discussions.author
ORDER BY tbl_discussions.recent_date, tbl_discussions.create_date;
