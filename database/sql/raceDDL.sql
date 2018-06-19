-- CREATE DATABASE racing CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- DROP DATABASE race;
show databases;
use racing;

DROP TABLE IF EXISTS trackdrivers;
DROP TABLE IF EXISTS racetracks;
DROP TABLE IF EXISTS racedrivers;

DROP TABLE IF EXISTS mylapsdatas;
DROP TABLE IF EXISTS hardcarddatas;
DROP TABLE IF EXISTS races;
DROP TABLE IF EXISTS drivers;



CREATE TABLE IF NOT EXISTS races (
	id INTEGER AUTO_INCREMENT,
    place VARCHAR(255),
    `date` DATETIME,
    weather VARCHAR(255),
    temp INTEGER,
    
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS mylapsdatas (
	id INTEGER AUTO_INCREMENT,
    raceid INTEGER,
    `no` INTEGER,
    `name` VARCHAR(255),
    laps INTEGER,
    lead INTEGER,
    lap_time TIME(3),
    speed FLOAT,
    elapsed_time TIME(3),
    passing_time VARCHAR(255),
    hits INTEGER,
    strength INTEGER,
    noice INTEGER,
    photocell_time TIME(6),
    transponder INTEGER,
    backup_tx INTEGER,
    backup_passing_time TIME,
    class VARCHAR(255),
    `deleted` VARCHAR(255),
    
    FOREIGN KEY (raceid) REFERENCES races (id),
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS hardcarddatas (
	id INTEGER AUTO_INCREMENT,
    raceid INTEGER,
    tagid INTEGER,
    frequency FLOAT,
    signalstrength FLOAT,
    antenna INTEGER,
    `time` VARCHAR(255),
    `datetime` VARCHAR(255),
    hits INTEGER,
    competitorid INTEGER,
	competitionnumber INTEGER,
    firstname VARCHAR(255),
    lastname VARCHAR(255),
    lap_time TIME(3),
    `deleted` VARCHAR(255),
    
    FOREIGN KEY (raceid) REFERENCES races (id),
    PRIMARY KEY (id)
);

-- CREATE TABLE IF NOT EXISTS drivers (
-- 	id INTEGER AUTO_INCREMENT,
--     `name` VARCHAR(255),
--     
--     PRIMARY KEY (id)
-- );

CREATE TABLE IF NOT EXISTS racetracks (
	id INTEGER AUTO_INCREMENT,
    raceid INTEGER,
    mylapsid INTEGER,
    hardcardid INTEGER,
    datatype VARCHAR(255),
    
    FOREIGN KEY (raceid) REFERENCES races (id),
    FOREIGN KEY (mylapsid) REFERENCES mylapsdatas (id),
    FOREIGN KEY (hardcardid) REFERENCES hardcarddatas (id),
    PRIMARY KEY (id)
);

-- CREATE TABLE IF NOT EXISTS racedrivers (
-- 	id INTEGER AUTO_INCREMENT,
--     raceid INTEGER,
--     driverid INTEGER,
--     
--     FOREIGN KEY (raceid) REFERENCES races (id),
--     FOREIGN KEY (driverid) REFERENCES drivers (id),
--     PRIMARY KEY (id)
-- );

-- CREATE TABLE IF NOT EXISTS trackdrivers (
-- 	id INTEGER AUTO_INCREMENT,
--     trackid INTEGER,
--     driverid INTEGER,
--     
--     FOREIGN KEY (trackid) REFERENCES trackdatas (id),
--     FOREIGN KEY (driverid) REFERENCES drivers (id),
--     PRIMARY KEY (id)
-- );

