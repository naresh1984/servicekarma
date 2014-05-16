-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 16, 2013 at 06:58 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `leavemgnt`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ChangePassword`(IN `oldpwd` VARCHAR(50), IN `newpwd` VARCHAR(50), IN `empid` INT(11), OUT `msg` VARCHAR(150))
    NO SQL
BEGIN
DECLARE temppwd VARCHAR(50);
SELECT password INTO temppwd FROM employees WHERE emptblno = empid;
IF temppwd = oldpwd THEN
UPDATE employees SET password = newpwd,modifiedby = empid,modifiedon = now() WHERE emptblno = empid;
SET msg = "Password updated successfully";
ELSE
SET msg = "Invalid OLD passwod";
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EditEmployeeDetails`(IN `empid1` VARCHAR(11), IN `firstname1` VARCHAR(50), IN `lastname1` VARCHAR(50), IN `email1` VARCHAR(120), IN `contactno1` VARCHAR(20), IN `address1` TEXT, IN `managerid1` INT(11), IN `password1` TEXT, IN `createdby1` INT(11), IN `createdon1` DATE, IN `modifiedby1` INT(11), IN `modifiedon1` DATE, IN `status1` INT(11), IN `roles` VARCHAR(50), OUT `msg` VARCHAR(500), IN `id` INT(11))
BEGIN
DECLARE empused VARCHAR(120);
DECLARE tempemp INT DEFAULT 0;
DECLARE x INT DEFAULT 0;
DECLARE y INT DEFAULT 0;
SET y = 1;
SELECT email INTO empused FROM employees WHERE emptblno != id limit 1;
 IF empused = email1 THEN
    SET msg = 'Email is already in used';
 ELSE
    UPDATE employees SET empid = empid1,firstname = firstname1,lastname = lastname1,email = email1,contactno = contactno1,address = address1,managerid = managerid1,modifiedby = modifiedby1,modifiedon = modifiedon1,status = status1 WHERE emptblno = id;
    IF id > 0 THEN
      DELETE FROM employees_roles WHERE emptblno = id;
      SET msg = 'Employee details saved successfully'; 
      SELECT LENGTH(roles) - LENGTH(REPLACE(roles, '|', '')) INTO @noOfCommas;
      IF  @noOfCommas = 0  THEN
	INSERT INTO employees_roles(emptblno,roleid,createdby,createdon,modifiedby,modifiedon,status) VALUES(id,roles,createdby1,now(),createdby1,now(),1);
      ELSE
	SET x = @noOfCommas + 1;
	WHILE y  <=  x DO
	   SELECT split(roles, '|', y) INTO @engName;
	   INSERT INTO employees_roles(emptblno,roleid,createdby,createdon,modifiedby,modifiedon,status) VALUES(id,@engName,createdby1,now(),createdby1,now(),1);
	   SET  y = y + 1;
	END WHILE;
       END IF;
    END IF;
 END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EditLeavesByEmpId`(IN `empid` INT(11), IN `createdby1` INT(11), IN `els1` FLOAT, IN `nels1` FLOAT, OUT `msg` VARCHAR(50))
    NO SQL
BEGIN
DECLARE tempempid INT DEFAULT 0;
SET msg = 'Saved Successfully';
SELECT emptblno INTO tempempid FROM leaves WHERE emptblno = empid;
IF tempempid > 0 THEN
UPDATE leaves SET els = els1,nels = nels1,modifiedby = createdby1,modifiedon = now() WHERE emptblno = empid;
ELSE
INSERT INTO leaves(emptblno,els,nels,createdby,createdon,modifiedby,modifiedon) VALUES(empid,els1,nels1,createdby1,now(),createdby1,now());
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllEmployees`(IN `empid1` VARCHAR(50), IN `name` VARCHAR(50), IN `start1` INT(11), IN `limit1` INT(11))
    NO SQL
    DETERMINISTIC
BEGIN
  DECLARE count INT DEFAULT 0;
  IF (trim(empid1)!='') AND (trim(name)!='') THEN
    SELECT *,(SELECT count(*) FROM employees WHERE empid LIKE CONCAT(empid1, '%') OR firstname LIKE CONCAT(name, '%') OR lastname LIKE CONCAT(name, '%')) as count FROM employees WHERE empid LIKE CONCAT(empid1, '%') OR firstname LIKE CONCAT(name, '%') OR lastname LIKE CONCAT(name, '%') ORDER BY firstname ASC, lastname ASC limit start1,limit1 ;
  ELSEIF (trim(empid1)!='') THEN
    SELECT *,(SELECT count(*) FROM employees WHERE empid LIKE CONCAT(empid1, '%')) as count FROM employees WHERE empid LIKE CONCAT(empid1, '%') ORDER BY firstname ASC, lastname ASC limit start1,limit1 ;
  ELSEIF (trim(name)!='') THEN
    SELECT *,(SELECT count(*) FROM employees WHERE firstname LIKE CONCAT(name, '%') OR lastname LIKE CONCAT(name, '%')) as count FROM employees WHERE firstname LIKE CONCAT(name, '%') OR lastname LIKE CONCAT(name, '%') ORDER BY firstname ASC, lastname ASC limit start1,limit1 ;
  ELSE
    SELECT *,(SELECT count(*) FROM employees) as count FROM employees  ORDER BY firstname ASC, lastname ASC limit start1,limit1 ;
  END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllRoles`()
    NO SQL
SELECT * FROM roles WHERE status='Active'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetEmployeeDetails`(IN `empid` INT(11))
    NO SQL
BEGIN
IF empid !='' THEN
SELECT * FROM employees WHERE emptblno = empid;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetEmployeesByRoleId`(IN `rID` INT)
    NO SQL
SELECT e.*, er.roleid, er.emptblno FROM employees as e, employees_roles as er WHERE e.emptblno = er.emptblno AND er.roleid = rID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetLeavesByEmpid`(IN `empid` VARCHAR(11))
BEGIN
SELECT * FROM leaves WHERE emptblno = empid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetLogin`(IN `eml` VARCHAR(50), IN `pwd` VARCHAR(250), IN `id` VARCHAR(12))
    NO SQL
BEGIN
IF id="" THEN
SELECT e.*, er.* FROM employees as e, employees_roles as er WHERE e.email = eml AND e.password = pwd AND er.emptblno = e.emptblno;
ELSEIF id!='' THEN
UPDATE employees SET password=pwd WHERE emptblno=id;
SELECT e.*, er.* FROM employees as e, employees_roles as er WHERE e.email = eml AND e.password = pwd AND er.emptblno = e.emptblno;
END IF ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetLoginAdmin`(IN `eml` VARCHAR(50), IN `pwd` VARCHAR(250))
    NO SQL
SELECT e.*, er.* FROM employees as e, employees_roles as er WHERE e.email = eml AND e.password = pwd AND er.emptblno = e.emptblno AND er.roleid = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetrolesByempid`(IN `empid` VARCHAR(11))
    NO SQL
BEGIN
SELECT * FROM employees_roles WHERE emptblno = empid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_users`()
BEGIN
SELECT *
FROM users;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertEmployeeDetails`(IN `empid1` VARCHAR(11), IN `firstname1` VARCHAR(50), IN `lastname1` VARCHAR(50), IN `email1` VARCHAR(120), IN `contactno1` VARCHAR(20), IN `address1` TEXT, IN `managerid1` INT(11), IN `password1` TEXT, IN `createdby1` INT(11), IN `createdon1` DATE, IN `modifiedby1` INT(11), IN `modifiedon1` DATE, IN `status1` INT(11), IN `roles` VARCHAR(50), OUT `msg` VARCHAR(500))
    NO SQL
BEGIN
DECLARE empused VARCHAR(120);
DECLARE tempemp INT DEFAULT 0;
DECLARE x INT DEFAULT 0;
DECLARE y INT DEFAULT 0;
SET y = 1;
SELECT email INTO empused FROM employees WHERE email = email1;
 IF empused = email1 THEN
    SET msg = 'Email is already in used';
 ELSE
    INSERT INTO employees(empid,firstname,lastname,email,contactno,address,managerid,password,createdby,createdon,modifiedby,modifiedon,status)values(empid1,firstname1,lastname1,email1,contactno1,address1,managerid1,password1,createdby1,createdon1,modifiedby1,modifiedon1,status1);
    SELECT emptblno INTO tempemp FROM employees WHERE email = email1;
    IF tempemp > 0 THEN
      INSERT INTO leaves(emptblno,els,nels,createdby,createdon,modifiedby,modifiedon) VALUES(tempemp,0,0,createdby1,createdon1,createdby1,createdon1);
      SET msg = 'Employee details saved successfully'; 
      SELECT LENGTH(roles) - LENGTH(REPLACE(roles, '|', '')) INTO @noOfCommas;
      IF  @noOfCommas = 0  THEN
	INSERT INTO employees_roles(emptblno,roleid,createdby,createdon,modifiedby,modifiedon,status) VALUES(tempemp,roles,createdby1,now(),createdby1,now(),1);
      ELSE
	SET x = @noOfCommas + 1;
	WHILE y  <=  x DO
	   SELECT split(roles, '|', y) INTO @engName;
	   INSERT INTO employees_roles(emptblno,roleid,createdby,createdon,modifiedby,modifiedon,status) VALUES(tempemp,@engName,createdby1,now(),createdby1,now(),1);
	   SET  y = y + 1;
	END WHILE;
       END IF;
    END IF;
 END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertForcedLeaves`(IN `empid` INT(11), IN `els1` FLOAT, IN `nels1` FLOAT, IN `lops1` FLOAT, IN `compoffs1` FLOAT, IN `reason1` VARCHAR(500), IN `processedby1` INT(11), OUT `msg` VARCHAR(500))
    NO SQL
BEGIN
INSERT INTO forced_leaves(emptblno,els,nels,lops,compoffs,reason,processedby,processedon) VALUES(empid,els1,nels1,lops1,compoffs1,reason1,processedby1,now());
UPDATE leaves SET els = els - els1,nels = nels - nels1,lops = lops + lops1,compoffs = compoffs + compoffs1 WHERE emptblno = empid; 
SET msg = 'Successfully Saved';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Leaverequest`(IN `emptblno1` VARCHAR(250), IN `fromdate1` DATE, IN `todate1` DATE, IN `numdays1` VARCHAR(120), IN `resumeon1` DATE, IN `els1` TINYINT(1), IN `nels1` TINYINT(1), IN `reason1` TEXT, IN `contactno1` VARCHAR(250), IN `address1` TEXT, IN `currentproject1` VARCHAR(250), IN `managerid1` INT(11), IN `createdby1` INT(12), IN `createdon1` DATETIME, IN `modifiedby1` INT(12), IN `modifiedon1` DATETIME, IN `status1` ENUM('Pending','Approved','Rejected','Cancelled'), IN `type` INT(12), IN `id` INT(12), IN `start_point` INT(12), IN `limits` INT(12))
BEGIN
 DECLARE _statement VARCHAR(500);
 DECLARE _statement1 VARCHAR(500);
 IF type=1 THEN
 INSERT INTO leave_requests(emptblno,fromdate,todate,numdays,resumeon,els,nels,reason,contactno,address,currentproject,managerid,createdby,createdon,modifiedby,modifiedon,status)values(emptblno1,fromdate1,todate1,numdays1,resumeon1,els1,nels1,reason1,contactno1,address1,currentproject1,managerid1,createdby1,createdon1,modifiedby1,modifiedon1,status1);
 ELSEIF type=2 THEN 
 SELECT * FROM leave_requests WHERE leaveid=id;
 ELSEIF type=3 THEN
 UPDATE leave_requests SET emptblno=emptblno1,fromdate=fromdate1,todate=todate1,numdays=numdays1,resumeon=resumeon1,els=els1,nels=nels1,reason=reason1,contactno=contactno1,address=address1,currentproject=currentproject1,managerid=managerid1,createdby=createdby1,createdon=createdon1,modifiedby=modifiedby1,modifiedon=modifiedon1,status=status1 WHERE leaveid=id;
 ELSEIF type=4 THEN
 UPDATE leave_requests SET status='Cancelled' WHERE leaveid=id;
 ELSEIF type=5 THEN
 SET _statement = "SELECT lr.*,e.emptblno,e.empid,e.firstname,( SELECT count(*) FROM leave_requests lr ,employees e WHERE lr.status='Pending' AND lr.emptblno=e.emptblno ";
 IF emptblno1 IS NOT NULL THEN
 SET _statement = CONCAT(_statement, emptblno1); 
 END IF;
 SET _statement1 = " )as count FROM leave_requests lr ,employees e WHERE lr.status='Pending' AND lr.emptblno=e.emptblno";
 IF emptblno1 IS NOT NULL THEN 
 SET _statement1 = CONCAT(_statement1, emptblno1);
 END IF;
 SET _statement1= CONCAT(_statement1, ' LIMIT ');
 SET _statement1= CONCAT(_statement1, start_point);
 SET _statement1= CONCAT(_statement1, ",");
 SET _statement1= CONCAT(_statement1, limits);


#SELECT _statement;
#SELECT _statement1;

SET @statement = CONCAT(_statement, _statement1);
PREPARE dynquery FROM @statement;
EXECUTE dynquery;
DEALLOCATE PREPARE dynquery;
 ELSEIF type=6 THEN
 SET _statement = "SELECT lr.*,e.emptblno,e.empid,e.firstname,( SELECT count(*) FROM leave_requests lr ,employees e WHERE lr.emptblno=e.emptblno AND (fromdate>=CURDATE() AND CURDATE()<=todate) AND lr.status='Approved'";
 IF emptblno1 IS NOT NULL THEN
 SET _statement = CONCAT(_statement, emptblno1); 
 END IF;
 SET _statement1 = ")as count FROM leave_requests lr ,employees e  WHERE  lr.emptblno=e.emptblno AND (fromdate>=CURDATE() AND CURDATE()<=todate) AND lr.status='Approved' ";
 IF emptblno1 IS NOT NULL THEN 
 SET _statement1 = CONCAT(_statement1, emptblno1);
 END IF;
 SET _statement1= CONCAT(_statement1, ' LIMIT ');
 SET _statement1= CONCAT(_statement1, start_point);
 SET _statement1= CONCAT(_statement1, ",");
 SET _statement1= CONCAT(_statement1, limits);


#SELECT _statement;
#SELECT _statement1;

SET @statement = CONCAT(_statement, _statement1);
PREPARE dynquery FROM @statement;
EXECUTE dynquery;
DEALLOCATE PREPARE dynquery;
 
 ELSEIF type=7 THEN
 SELECT * ,( SELECT count(*) FROM leave_requests WHERE emptblno=id ) as count FROM leave_requests WHERE emptblno=id  ORDER BY fromdate DESC LIMIT start_point,limits ;
END IF;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `split`(`str` VARCHAR(500), `delchar` VARCHAR(2), `x` INT(11)) RETURNS varchar(500) CHARSET latin1
    NO SQL
RETURN SUBSTR(SUBSTRING_INDEX(str, delchar, x), 
LENGTH(SUBSTRING_INDEX(str, delchar, x-1))+IF(x > 1, 2, 1))$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `emptblno` int(12) NOT NULL AUTO_INCREMENT,
  `empid` varchar(10) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `contactno` varchar(15) NOT NULL,
  `address` varchar(250) NOT NULL,
  `email` varchar(50) NOT NULL,
  `managerid` int(11) NOT NULL,
  `password` varchar(250) NOT NULL,
  `createdby` int(12) NOT NULL,
  `createdon` datetime NOT NULL,
  `modifiedby` int(12) NOT NULL,
  `modifiedon` datetime NOT NULL,
  `status` enum('Active','Inactive') NOT NULL COMMENT 'Active/Inactive	',
  PRIMARY KEY (`emptblno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emptblno`, `empid`, `firstname`, `lastname`, `contactno`, `address`, `email`, `managerid`, `password`, `createdby`, `createdon`, `modifiedby`, `modifiedon`, `status`) VALUES
(1, 'LT/149', 'Srikanth', 'Adapa', '9550705652', 'Logictree IT Solutions Inc., Hyderabad, India', 'sri@logictree.com', 2, 'admin', 0, '2013-04-01 10:50:49', 1, '2013-04-10 10:53:01', 'Active'),
(2, 'LT/119', 'Soma', 'Sekhar', '9550705656', 'Logictree IT Solutions Inc., Hyderabad, India', 'somu@gmail.com', 1, 'admin', 0, '2013-04-01 10:50:49', 1, '2013-04-09 00:00:00', 'Active'),
(43, 'LT/120', 'soma', 'Rupesh', '9550705652', 'test', 'rupesh0086@gmail.com', 1, 'admin', 0, '2013-04-08 00:00:00', 45, '2013-04-10 00:00:00', 'Active'),
(44, 'LT/108', 'Ramesh', 'G', '9550705658', 'Logictree', 'ramesh@gmail.com', 2, 'admin', 1, '2013-04-10 00:00:00', 1, '2013-04-10 00:00:00', 'Active'),
(45, 'LT/148', 'Kiran', 'G', '9550705658', 'logictree,\r\nBanjara Hills,\r\nRoad No:7,\r\nHyderabad', 'kiran@logictreeit.com', 1, 'admin', 1, '2013-04-10 00:00:00', 1, '2013-04-15 00:00:00', 'Active'),
(46, 'LT/129', 'Vittal', 'Banda', '9550705658', 'logictree', 'vit@logictreeit.com', 44, 'admin', 45, '2013-04-10 00:00:00', 45, '2013-04-10 00:00:00', 'Active'),
(47, 'LT/156', 'Naresh', 'Nookal', '9550705658', 'Logictree', 'naresh.babu@logictreeit.com', 2, 'admin', 1, '2013-04-16 00:00:00', 1, '2013-04-16 00:00:00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `employees_roles`
--

CREATE TABLE IF NOT EXISTS `employees_roles` (
  `sno` int(12) NOT NULL,
  `emptblno` int(12) NOT NULL,
  `roleid` int(12) NOT NULL,
  `createdby` int(12) NOT NULL,
  `createdon` datetime NOT NULL,
  `modifiedby` int(12) NOT NULL,
  `modifiedon` datetime NOT NULL,
  `status` enum('Active','Inactive') NOT NULL COMMENT 'Active/Inactive	'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees_roles`
--

INSERT INTO `employees_roles` (`sno`, `emptblno`, `roleid`, `createdby`, `createdon`, `modifiedby`, `modifiedon`, `status`) VALUES
(0, 2, 1, 1, '2013-04-09 15:43:12', 1, '2013-04-09 15:43:12', 'Active'),
(0, 2, 2, 1, '2013-04-09 15:43:12', 1, '2013-04-09 15:43:12', 'Active'),
(0, 2, 3, 1, '2013-04-09 15:43:12', 1, '2013-04-09 15:43:12', 'Active'),
(0, 1, 1, 1, '2013-04-09 18:05:38', 1, '2013-04-09 18:05:38', 'Active'),
(0, 1, 2, 1, '2013-04-09 18:05:38', 1, '2013-04-09 18:05:38', 'Active'),
(0, 1, 3, 1, '2013-04-09 18:05:38', 1, '2013-04-09 18:05:38', 'Active'),
(0, 44, 1, 1, '2013-04-10 14:55:08', 1, '2013-04-10 14:55:08', 'Active'),
(0, 44, 2, 1, '2013-04-10 14:55:08', 1, '2013-04-10 14:55:08', 'Active'),
(0, 44, 3, 1, '2013-04-10 14:55:08', 1, '2013-04-10 14:55:08', 'Active'),
(0, 43, 2, 45, '2013-04-10 16:20:29', 45, '2013-04-10 16:20:29', 'Active'),
(0, 46, 1, 45, '2013-04-10 16:22:08', 45, '2013-04-10 16:22:08', 'Active'),
(0, 45, 1, 1, '2013-04-15 17:25:11', 1, '2013-04-15 17:25:11', 'Active'),
(0, 47, 2, 1, '2013-04-16 10:50:05', 1, '2013-04-16 10:50:05', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `forced_leaves`
--

CREATE TABLE IF NOT EXISTS `forced_leaves` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `emptblno` int(12) NOT NULL,
  `els` float NOT NULL,
  `nels` float NOT NULL,
  `lops` float NOT NULL,
  `compoffs` float NOT NULL,
  `reason` text NOT NULL,
  `processedby` int(12) NOT NULL,
  `processedon` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `forced_leaves`
--

INSERT INTO `forced_leaves` (`id`, `emptblno`, `els`, `nels`, `lops`, `compoffs`, `reason`, `processedby`, `processedon`) VALUES
(1, 45, 0, 0, 1, 1, 'test', 1, '2013-04-16 12:20:22');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE IF NOT EXISTS `leaves` (
  `emptblno` int(12) NOT NULL,
  `els` float NOT NULL,
  `nels` float NOT NULL,
  `lops` float NOT NULL,
  `compoffs` float NOT NULL,
  `createdby` int(12) NOT NULL,
  `createdon` datetime NOT NULL,
  `modifiedby` int(12) NOT NULL,
  `modifiedon` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`emptblno`, `els`, `nels`, `lops`, `compoffs`, `createdby`, `createdon`, `modifiedby`, `modifiedon`) VALUES
(1, 10.2, 22, 0, 0, 1, '2013-04-09 00:00:00', 1, '2013-04-10 11:08:55'),
(2, 9, 2, 0, 0, 0, '2013-04-09 11:10:03', 1, '2013-04-09 11:19:47'),
(2, 2, 22, 0, 0, 0, '2013-04-09 11:10:31', 1, '2013-04-09 11:28:37'),
(45, 10, 10, 1, -1, 1, '2013-04-16 10:44:21', 1, '2013-04-16 10:44:21'),
(44, 10, 10, 0, 0, 1, '2013-04-16 10:44:29', 1, '2013-04-16 10:44:29'),
(43, 10, 10, 0, 0, 1, '2013-04-16 10:44:39', 1, '2013-04-16 10:44:39'),
(46, 10, 10, 0, 0, 1, '2013-04-16 10:45:00', 1, '2013-04-16 10:45:00'),
(47, 0, 0, 0, 0, 1, '2013-04-16 00:00:00', 1, '2013-04-16 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `leaves_archived`
--

CREATE TABLE IF NOT EXISTS `leaves_archived` (
  `emptblno` int(12) NOT NULL,
  `els` float NOT NULL,
  `nels` float NOT NULL,
  `year` int(4) NOT NULL,
  `createdby` int(12) NOT NULL,
  `createdon` datetime NOT NULL,
  `modifiedby` int(12) NOT NULL,
  `modifiedon` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leaves_auditlog`
--

CREATE TABLE IF NOT EXISTS `leaves_auditlog` (
  `emptblno` int(10) NOT NULL,
  `preels` float NOT NULL,
  `prenels` float NOT NULL,
  `prelops` float NOT NULL,
  `precompoffs` float NOT NULL,
  `currentels` float NOT NULL,
  `currentnels` float NOT NULL,
  `currentlops` float NOT NULL,
  `currentcompoffs` float NOT NULL,
  `tableorscreen` varchar(64) NOT NULL COMMENT 'processedLeaves / forcedLeaves / employeeScreen',
  `tableid` int(12) NOT NULL COMMENT 'processedLeaves. Id / forcedLeaves. Id / 0',
  `premodifiedby` int(12) NOT NULL,
  `premodifiedon` datetime NOT NULL,
  `recentmodifiedby` int(12) NOT NULL,
  `recentmodifiedon` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE IF NOT EXISTS `leave_requests` (
  `leaveid` int(12) NOT NULL AUTO_INCREMENT,
  `emptblno` int(12) NOT NULL,
  `fromdate` datetime NOT NULL,
  `todate` datetime NOT NULL,
  `numdays` varchar(20) NOT NULL,
  `resumeon` datetime NOT NULL,
  `els` tinyint(1) NOT NULL COMMENT 'Checked-1; Uncheched-0',
  `nels` tinyint(1) NOT NULL COMMENT 'Checked-1; Uncheched-0',
  `reason` varchar(250) NOT NULL,
  `contactno` varchar(15) NOT NULL,
  `address` varchar(250) NOT NULL,
  `currentproject` varchar(50) NOT NULL,
  `managerid` int(11) NOT NULL,
  `createdby` int(12) NOT NULL,
  `createdon` datetime NOT NULL,
  `modifiedby` int(12) NOT NULL,
  `modifiedon` datetime NOT NULL,
  `status` enum('Pending','Approved','Rejected','Cancelled','Commited') NOT NULL COMMENT 'Pending/Approved/Rejected/Cancelled/Commited',
  PRIMARY KEY (`leaveid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`leaveid`, `emptblno`, `fromdate`, `todate`, `numdays`, `resumeon`, `els`, `nels`, `reason`, `contactno`, `address`, `currentproject`, `managerid`, `createdby`, `createdon`, `modifiedby`, `modifiedon`, `status`) VALUES
(1, 1, '2013-04-09 00:00:00', '2013-04-11 00:00:00', '1', '2013-04-11 00:00:00', 1, 0, 'Test', 'Logictree IT So', '9989755613', 'Leavemgnt', 1, 1, '2013-04-09 16:13:41', 1, '2013-04-09 16:58:29', 'Rejected'),
(2, 2, '2013-04-15 00:00:00', '2013-04-17 00:00:00', '1', '2013-04-18 00:00:00', 1, 1, 'Test', '9550705652', 'Logictree IT So', 'Test', 1, 2, '2013-04-09 16:04:18', 1, '2013-04-09 16:58:14', 'Rejected'),
(3, 1, '2013-04-15 00:00:00', '2013-04-17 00:00:00', '3', '2013-04-18 00:00:00', 1, 1, 'Test', '9989755613', 'Logictree IT So', 'Test', 1, 1, '2013-04-09 17:01:02', 1, '2013-04-09 17:07:31', 'Approved'),
(4, 1, '2013-04-16 00:00:00', '2013-04-18 00:00:00', '2', '2013-04-19 00:00:00', 0, 1, 'test', '9550705652', 'Logictree IT So', 'test', 1, 1, '2013-04-15 12:54:51', 1, '2013-04-15 12:54:51', 'Pending'),
(5, 2, '2013-04-16 00:00:00', '2013-04-18 00:00:00', '2', '2013-04-18 00:00:00', 1, 1, 'test', '9550705656', 'Logictree IT So', 'test', 2, 2, '2013-04-15 13:02:07', 2, '2013-04-15 13:02:17', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `processed_leaves`
--

CREATE TABLE IF NOT EXISTS `processed_leaves` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `leaveid` int(12) NOT NULL,
  `els` float NOT NULL,
  `nels` float NOT NULL,
  `lops` float NOT NULL,
  `compoffs` float NOT NULL,
  `processedby` int(12) NOT NULL,
  `processedon` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `roleid` int(12) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `createdby` int(12) NOT NULL,
  `createdon` datetime NOT NULL,
  `modifiedby` int(12) NOT NULL,
  `modifiedon` datetime NOT NULL,
  `status` enum('Active','Inactive') NOT NULL COMMENT 'Active/Inactive',
  PRIMARY KEY (`roleid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleid`, `title`, `createdby`, `createdon`, `modifiedby`, `modifiedon`, `status`) VALUES
(1, 'Admin', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 'Active'),
(2, 'Employee', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 'Active'),
(3, 'Manager', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 'Active'),
(4, 'Super Manager', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 'Inactive');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
