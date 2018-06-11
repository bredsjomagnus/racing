-- CREATE DATABASE race CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- DROP DATABASE race;
use race;

show tables;

CREATE TABLE IF NOT EXISTS trackdatas (
	id INTEGER AUTO_INCREMENT,
    `name` VARCHAR(255),
    lap_time TIME,
    speed FLOAT(4,1),
    elapsed_time TIME,
    hits INTEGER,
    strength INTEGER,
    noice INTEGER,
    photocell_time TIME,
    transponder INTEGER,
    backup_tx INTEGER,
    backup_passing_time TIME,
    
    PRIMARY KEY (id)
);


