
CREATE TABLE `project_mgmt_system`.`employee` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(50) NOT NULL , `email` VARCHAR(50) NOT NULL , `phone` BIGINT NOT NULL , `job_title` VARCHAR(20) NOT NULL , `pid` INT NOT NULL , `did` INT NOT NULL , PRIMARY KEY (`id`), UNIQUE (`email`), UNIQUE (`phone`)) ENGINE = InnoDB;

CREATE TABLE `project_mgmt_system`.`department` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(30) NOT NULL , `strength` INT NOT NULL , `email` VARCHAR(50) NOT NULL , PRIMARY KEY (`id`), UNIQUE (`email`)) ENGINE = InnoDB;

CREATE TABLE `project_mgmt_system`.`company` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(30) NOT NULL , `email` VARCHAR(50) NOT NULL , `address` VARCHAR(200) NOT NULL , `phone` BIGINT NOT NULL , PRIMARY KEY (`id`), UNIQUE (`email`), UNIQUE (`phone`)) ENGINE = InnoDB;

CREATE TABLE `project_mgmt_system`.`archived_projects` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(50) NOT NULL , `start_date` DATE NOT NULL , `completion_date` DATE NOT NULL , `achievement` VARCHAR(30) NOT NULL , `cid` INT NOT NULL , `did` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `project_mgmt_system`.`completed_projects` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(50) NOT NULL , `start_date` DATE NOT NULL , `completion_date` DATE NOT NULL , `cid` INT NOT NULL , `did` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `project_mgmt_system`.`ongoing_projects` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(50) NOT NULL , `start_date` DATE NOT NULL , `deadline` DATE NOT NULL , `cid` INT NOT NULL , `did` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `archived_projects` ADD FOREIGN KEY (`cid`) REFERENCES `company`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT; 

ALTER TABLE `archived_projects` ADD FOREIGN KEY (`did`) REFERENCES `department`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `completed_projects` ADD FOREIGN KEY (`cid`) REFERENCES `company`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT; 

ALTER TABLE `completed_projects` ADD FOREIGN KEY (`did`) REFERENCES `department`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `employee` ADD FOREIGN KEY (`did`) REFERENCES `department`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT; 

ALTER TABLE `employee` ADD FOREIGN KEY (`pid`) REFERENCES `ongoing_projects`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `ongoing_projects` ADD FOREIGN KEY (`cid`) REFERENCES `company`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT; 

ALTER TABLE `ongoing_projects` ADD FOREIGN KEY (`did`) REFERENCES `department`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

