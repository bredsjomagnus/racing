use racing;

SELECT * FROM mylapsdatas;

SELECT DISTINCT MAX(speed) AS speed, teamid FROM mylapsdatas GROUP BY teamid ORDER BY speed DESC;

SELECT * FROM hardcarddatas;

SELECT * FROM races;

SELECT count(*) FROM racetracks;

SELECT COUNT(datatype) FROM racetracks WHERE datatype = 'mylaps' AND raceid = 1;

SELECT * FROM racetracks;

SELECT * FROM users;

SELECT * FROM teams;

SELECT * FROM teams WHERE class = 'R1';

SELECT COUNT(`no`) FROM mylapsdatas WHERE `no` = 4 AND raceid = 5;

SELECT DISTINCT `no` FROM mylapsdatas WHERE class = 'R1';

SELECT COUNT(*) FROM mylapsview WHERE raceid = 5 AND class='R1' AND teamnumber = 30;

SELECT * FROM mylapsview;

SELECT COUNT(*) FROM hardcardview WHERE raceid = 1 AND class='R2' AND teamnumber = 44;

SELECT * FROM hardcardview;

SELECT raceid, teamtagg, COUNT(teamnumber) FROM mylapsview WHERE raceid = 1 AND teamtagg = '6R2' GROUP BY raceid;

SELECT raceid, class, team, teamtagg, teamnumber, teamid FROM mylapsview WHERE class = 'R1';

SELECT * FROM teams WHERE teamtagg = '3R1';

SELECT * FROM teamlaps WHERE class = 'R1';

SELECT * FROM teamlaps;

SELECT teamid, SUM(laps) AS sumlaps FROM teamlaps WHERE class = 'R1' GROUP BY teamid ORDER BY sumlaps DESC;

SELECT * FROM raceview;

-- UPDATE users SET role = 'admin' WHERE id = 1;