-- Source File: dbscript.sql
-- Name:Robert Foltz
-- Last Modified By: Robert Foltz
-- Website Name: Robert Folt's Portfolio
-- File Description: This is the script used to create my database this also includes some inserts for information.


CREATE DATABASE robertfo_advweb;

CREATE TABLE robertfo_advweb.users
(
UserId INT NOT NULL AUTO_INCREMENT,
Username VARCHAR(30) NOT NULL,
Password VARCHAR(40) NOT NULL, 
AdminUser CHAR(1) DEFAULT 'N',
PRIMARY KEY (UserId)
);

CREATE TABLE robertfo_advweb.contacts
(
ContactId INT NOT NULL AUTO_INCREMENT,
ContactName VARCHAR(60) NOT NULL, 
PhoneNum VARCHAR(11) NOT NULL, 
Address VARCHAR(200) NOT NULL,
Email VARCHAR(50) NOT NULL,
PRIMARY KEY (ContactId)
);


INSERT INTO robertfo_advweb.users (Username, Password, AdminUser)
VALUES ('admin','09c0a300a137693e18d4b80aa23bbcaf74247090','Y'), -- Password = 123456
('robert','09c0a300a137693e18d4b80aa23bbcaf74247090','Y'), -- Password = 123456
('tom','09c0a300a137693e18d4b80aa23bbcaf74247090','N'); -- Password = 123456

INSERT INTO robertfo_advweb.contacts (ContactName, PhoneNum, Address, Email)
VALUES ('Robert Harris','17057964981','One Georgian Drive Barrie, ON L4M 3X9','rharris@robertfoltz.com'),
('Kyle Bran','17057964981','One Georgian Drive Barrie, ON L4M 3X9','kbran@robertfoltz.com'),
('Kaitlyn Rush','17057964981','One Georgian Drive Barrie, ON L4M 3X9','krush@robertfoltz.com'),
('Mikhaela Brown','17057964981','One Georgian Drive Barrie, ON L4M 3X9','mbrown@robertfoltz.com'),
('Brandon Sanderson','17057964981','One Georgian Drive Barrie, ON L4M 3X9','bsanderson@robertfoltz.com');