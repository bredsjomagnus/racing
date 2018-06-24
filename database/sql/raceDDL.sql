-- CREATE DATABASE racing CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- DROP DATABASE race;
show databases;
use racing;

DROP TABLE IF EXISTS teamlaps;
DROP TABLE IF EXISTS racetracks;

DROP TABLE IF EXISTS mylapsdatas;
DROP TABLE IF EXISTS hardcarddatas;
DROP TABLE IF EXISTS races;
DROP TABLE IF EXISTS teams;

DROP VIEW IF EXISTS mylapsview;


CREATE TABLE IF NOT EXISTS teams (
	id INTEGER AUTO_INCREMENT,
    teamtagg VARCHAR(255),
    `name` VARCHAR(255),
    carbrand VARCHAR(255),
    `no` INTEGER,
    class VARCHAR(255),
    updated_at DATETIME,
    deleted_at DATETIME,
    
    PRIMARY KEY (id)
);

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
    teamtagg VARCHAR(255),
    teamid INTEGER,
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
    teamid INTEGER,
    teamtagg VARCHAR(255),
    class VARCHAR(255),
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

CREATE TABLE IF NOT EXISTS teamlaps (
	id INTEGER AUTO_INCREMENT,
    raceid INTEGER,
    teamid INTEGER,
    teamname VARCHAR(255),
    carbrand VARCHAR(255),
    teamtagg VARCHAR(255),
    class VARCHAR(255),
    laps INTEGER,
    
    FOREIGN KEY (raceid) REFERENCES races (id),
    FOREIGN KEY (teamid) REFERENCES teams (id),
    PRIMARY KEY (id)
);


CREATE VIEW mylapsview AS
	SELECT 
		md.raceid AS raceid,
        md.class AS class,
        md.`no` AS teamnumber,
        md.teamtagg AS teamtagg,
        r.place AS place,
        r.`date` AS `date`,
        t.`name` AS team,
        t.id AS teamid
    FROM
		mylapsdatas AS md
	INNER JOIN races as r
		ON md.raceid = r.id
	INNER JOIN teams as t
		ON md.teamid = t.id;


DROP VIEW IF EXISTS hardcardview;
CREATE VIEW hardcardview AS
	SELECT 
		hc.raceid AS raceid,
        hc.class AS class,
        hc.competitionnumber AS teamnumber,
        r.place AS place,
        r.`date` AS `date`,
        t.`name` AS team,
        t.id AS teamid
    FROM
		hardcarddatas AS hc
	INNER JOIN races as r
		ON hc.raceid = r.id
	INNER JOIN teams as t
		ON hc.teamid = t.id;



