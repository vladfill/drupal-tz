CREATE DATABASE `news` CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE `news`.`posts`(
  id              smallint unsigned NOT NULL auto_increment,
  publicationDate date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,  
  title           varchar(255) NOT NULL,                      
  summary         text NOT NULL,                              
  content         mediumtext NOT NULL,  
  category				
  status          smallint NOT NULL,           

  PRIMARY KEY     (id)
);