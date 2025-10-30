CREATE DATABASE `network`;

USE `network`;

CREATE TABLE `users` (
  `user_id` INT(11) AUTO_INCREMENT,
  `user_name` VARCHAR(50) NOT NULL,
  `user_username` VARCHAR(25) NOT NULL,
  `user_email` VARCHAR(50) NOT NULL,
  `user_password` VARCHAR(256) NOT NULL,
  `user_profile_picture` VARCHAR(256) DEFAULT 'default.png',
  `user_bio` VARCHAR(250),
  `user_joined` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (user_id)
) ENGINE=INNODB;

CREATE TABLE `remember_tokens` (
  `remember_id` INT(11) AUTO_INCREMENT,
  `remember_user` INT(11) NOT NULL,
  `remember_token` VARCHAR(255) NOT NULL,
  `user_agent` VARCHAR(255) NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `expires_at` DATETIME NOT NULL,
  PRIMARY KEY (remember_id)
  FOREIGN KEY (remember_user) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE=INNODB;

CREATE TABLE `friends` (
  `friend_id` INT(11) AUTO_INCREMENT,
  `friend_user` INT(11) NOT NULL,
  `friend_friend` INT(11) NOT NULL,
  `friend_accepted` BOOLEAN DEFAULT 0,
  PRIMARY KEY (friend_id)
) ENGINE=INNODB;

CREATE TABLE `posts` (
  `post_id` INT(11) AUTO_INCREMENT,
  `post_content` VARCHAR(1000) NOT NULL,
  `post_image` VARCHAR(256) NULL,
  `post_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `post_profile` INT(11) NOT NULL,
  `post_by` INT(11) NOT NULL,
  PRIMARY KEY (post_id)
) ENGINE=INNODB;

CREATE TABLE `comments` (
  `comment_id` INT(11) AUTO_INCREMENT,
  `comment_text` VARCHAR(500) NOT NULL,
  `comment_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `comment_post` INT(11) NOT NULL,
  `comment_by` INT(11) NOT NULL,
  PRIMARY KEY (comment_id)
) ENGINE=INNODB;

CREATE TABLE `likes` (
  `like_id` INT(11) AUTO_INCREMENT,
  `like_user` INT(11) NOT NULL,
  `like_post` INT(11) NOT NULL,
  PRIMARY KEY (like_id)
) ENGINE=INNODB;