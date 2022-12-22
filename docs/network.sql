CREATE DATABASE `network`;

USE `network`;

CREATE TABLE `users` (
  `user_id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_name` VARCHAR(50) NOT NULL,
  `user_username` VARCHAR(25) NOT NULL,
  `user_email` VARCHAR(50) NOT NULL,
  `user_password` VARCHAR(256) NOT NULL,
  `user_profile_picture` VARCHAR(256) DEFAULT 'default.png',
  `user_joined` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (user_id)
) ENGINE=INNODB;

CREATE TABLE `posts` (
  `post_id` INT(11) NOT NULL AUTO_INCREMENT,
  `post_content` VARCHAR(1000) NOT NULL,
  `post_image` VARCHAR(256) NULL,
  `post_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `post_profile` INT(11) NOT NULL,
  `post_by` INT(11) NOT NULL,
  PRIMARY KEY (post_id)
) ENGINE=INNODB;

CREATE TABLE `comments` (
  `comment_id` INT(11) NOT NULL AUTO_INCREMENT,
  `comment_text` VARCHAR(500) NOT NULL,
  `comment_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `comment_post` INT(11) NOT NULL,
  `comment_by` INT(11) NOT NULL,
  PRIMARY KEY (comment_id)
) ENGINE=INNODB;

CREATE TABLE `follows` (
  `follow_id` INT(11) NOT NULL AUTO_INCREMENT,
  `follow_user` INT(11) NOT NULL,
  `follow_follow` INT(11) NOT NULL,
  PRIMARY KEY (follow_id)
) ENGINE=INNODB;

CREATE TABLE `likes` (
  `like_id` INT(11) NOT NULL AUTO_INCREMENT,
  `like_user` INT(11) NOT NULL,
  `like_post` INT(11) NOT NULL,
  PRIMARY KEY (like_id)
) ENGINE=INNODB;