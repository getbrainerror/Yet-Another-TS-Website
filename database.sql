-- Create database
CREATE SCHEMA `yatw` DEFAULT CHARACTER SET utf8mb4 ;

-- User TABLE
CREATE TABLE `yatw`.`user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nickname` VARCHAR(255) NOT NULL,
  `mail` VARCHAR(255) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `password_salt` VARCHAR(255) NOT NULL,
  `verified` TINYINT(1) NULL DEFAULT 0,
  PRIMARY KEY (`id`))
COMMENT = 'Stores user specific data like mail, password_hashes, nickname and more';

-- Group TABLE
CREATE TABLE `yatw`.`group` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `groupname` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
COMMENT = 'Group Table';


-- User Group Assignment TABLE
CREATE TABLE `yatw`.`user_group_assign` (
  `id` INT(11) NOT NULL,
  `user_id` INT(11) NULL,
  `group_id` INT(11) NULL,
  PRIMARY KEY (`id`))
COMMENT = 'User group assignment';
