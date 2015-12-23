CREATE TABLE Users(
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  role VARCHAR(255) NOT NULL,
  email VARCHAR(255),
  password VARCHAR(255) NOT NULL,
  username  VARCHAR(255) NOT NULL,
  lastName VARCHAR(255) NOT NULL,
  firstname VARCHAR(255) NOT NULL,
  created DATETIME DEFAULT NULL,
  modified DATETIME DEFAULT NULL
);

CREATE TABLE Points(
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
points INT UNSIGNED DEFAULT 0,
user_id INT UNSIGNED,
created DATETIME,
modified DATETIME,
FOREIGN KEY (user_id) 
REFERENCES Users(id)
);


CREATE TABLE Words (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    english VARCHAR(255),
    meaning VARCHAR(1000),
    completed INT(1),    
    user_id INT UNSIGNED,
    created DATETIME,
    modifed DATETIME,
    FOREIGN KEY (user_id) 
    REFERENCES Users(id)
);

CREATE TABLE Tags (
  id  INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(20) NOT NULL
);

CREATE TABLE WordsTags (
    tag_id  INT UNSIGNED,
    word_id INT UNSIGNED,
    
    FOREIGN KEY (word_id) 
    REFERENCES Words(id),
	
    FOREIGN KEY (tag_id) 
    REFERENCES Tags(id),
	
    CONSTRAINT Posts_Tags_PK
    PRIMARY KEY (word_id, tag_id)
);

CREATE TABLE Diary (
   id  INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
   subject VARCHAR(255),
   body TEXT,
  user_id INT UNSIGNED,
   created DATETIME,
   modifed DATETIME,
    FOREIGN KEY (user_id) 
    REFERENCES Users(id)
);

CREATE TABLE History  (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED,
  created DATETIME DEFAULT NULL,
  duration DATETIME DEFAULT NULL,
    FOREIGN KEY (user_id) 
    REFERENCES Users(id)
)