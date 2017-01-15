CREATE DATABASE `news` CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE `news`.`posts`(
	id              smallint unsigned NOT NULL auto_increment,
	publicationDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,  
	title           varchar(255) NOT NULL,                      
	summary         text NOT NULL,                              
	content         mediumtext NOT NULL,  
	category				smallint NOT NULL,
	status          smallint NOT NULL,           

	PRIMARY KEY     (id)
);