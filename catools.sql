-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 192.168.4.8
-- Generation Time: Jun 29, 2018 at 01:06 PM
-- Server version: 5.6.40-log
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `catools`
--

DELIMITER $$
--
-- Procedures
--
CREATE  PROCEDURE `add_new_heading` (IN `p_data_id` INT(11), IN `p_heading_no` INT(11), IN `p_heading_name` VARCHAR(255), IN `p_tspec_family` VARCHAR(255), IN `p_tspec_category` VARCHAR(255), IN `p_hqs` VARCHAR(255))  BEGIN
DECLARE v_acc_no int(11) default null;
DECLARE v_heading_no int(11) default null;
declare v_heading_data_id int(11) default null;

select count(*) into v_heading_no from account_heading_data where heading_no=p_heading_no and data_id = p_data_id;

if(v_heading_no = 0) then

	select acc_no into v_acc_no from account_data where data_id = p_data_id;

	Insert INTO account_heading_data (heading_no,heading_name,data_id,acc_no,status,group_status)
	values (p_heading_no,p_heading_name,p_data_id,v_acc_no,1,0);

	select last_insert_id() into v_heading_data_id;

	INSERT INTO heading_updated_data(heading_data_id,tspec_family,tspec_category,hqs,created_date)
	values(v_heading_data_id,p_tspec_family,p_tspec_category,p_hqs,now());
    

select 'heading has been added successfully for current account.' as status;
else    
select 'heading is already exist for current account.' as status;
    
end if;

END$$

CREATE  PROCEDURE `delete_group` (IN `p_group_id` INT(11))  BEGIN
declare v_heading_data_id varchar(255);

delete from group_data where group_id = p_group_id;

select group_concat(heading_data_id) into v_heading_data_id from heading_group_relation where group_id = p_group_id;

-- select v_heading_data_id;

delete from heading_group_relation where group_id = p_group_id;

-- delete from  heading_updated_data where FIND_IN_SET(heading_data_id,CONCAT(''',CONCAT('0',',',v_heading_data_id,',','0'),'''));

END$$

CREATE  PROCEDURE `get_account_data_for_update` (IN `p_data_id` INT(11))  BEGIN
DECLARE v_count INT(11) default null;
DECLARE v_heading_data_id INT(11) default null;

select count(*) into v_count from account_heading_data ahd where ahd.heading_data_id not in 
	(select hgr.heading_data_id from heading_group_relation hgr join account_heading_data ahd1 
	where ahd1.heading_data_id = hgr.heading_data_id and ahd1.data_id = p_data_id ) 
and data_id = p_data_id and ahd.group_status =0 ;

 
if(v_count = 0) then
	select distinct gd.group_id,gd.group_name,gd.updated_pdm_text from group_data gd 
    join heading_group_relation hgr on (gd.group_id=hgr.group_id) 
    join account_heading_data ahd on(ahd.heading_data_id=hgr.heading_data_id)
    where ahd.data_id=p_data_id ORDER by gd.group_id DESC ;
else 
	SELECT 0 as status, 'Add all heading data into group' as error;
end if;    


END$$

CREATE  PROCEDURE `set_account_data` ()  BEGIN

declare v_data_id INT(11) default null;
declare v_account_data_id INT(11) default null;

SELECT data_id into v_account_data_id FROM account_data
where acc_no = (select acc_no from temp_data limit 1);

if(v_account_data_id is null) then
	INSERT INTO account_data(	acc_no,
								acc_name,
								url,
								copro,
								suffix,
								legalname,
								address1,
								address2,
								address3,
								address4,
								city,
								province,
								postcode,
								created_date
							)
			(	select distinct acc_no,
								acc_name,
								url,
								copro,
								suffix,
								legal_name,
								address1,
								address2,
								address3,
								address4,
								city,
								province,
								postcode,
								now() 
				from temp_data
			);

	select last_insert_id() into v_data_id;

	Insert into account_heading_data(	heading_no,
										heading_name,
										pdmtextnum,
										pdmtext,
										link,
										business_activity,
										data_id,
										acc_no,
										status,
										created_date
									)
					   (select distinct heading_no,
										heading_name,
										pdmtextnum,
										pdmtext,
										link,
										business_acitivity,
										v_data_id,
										acc_no,
										0,
										now() 
						from temp_data
						);
    select 'Data has been imported successfully.' as status;                        
else 
	select 'This Account is already exists.' as status;
end if;                        

truncate table temp_data;

END$$

CREATE  PROCEDURE `set_group_heading` (IN `p_group_name` VARCHAR(255), IN `p_updated_business_activity` VARCHAR(255), IN `p_updated_heading_link` VARCHAR(255), IN `p_heading_data_id` VARCHAR(255), IN `p_data_id` INT(11))  BEGIN

DECLARE v_heading_id INT(11) default null;
DECLARE v_k INT(11) default 1;
DECLARE v_group_id INT(11) default null;
DECLARE v_group_name VARCHAR(50) default null;
declare v_zero_heading_no INT(11) default null;
declare v_zero_group_id INT(11) default null;
declare v_heading_name VARCHAR(255) default null;
declare v_count int(11) default null;

SELECT group_name INTO v_group_name from group_data where group_name=p_group_name;

if(v_group_name is null) then

	select count(*) into v_count from group_data gd join heading_group_relation hgr on (hgr.group_id = gd.group_id) join account_heading_data ahd on (ahd.heading_data_id = hgr.heading_data_id) where ahd.data_id = p_data_id;

	if(v_count=0) then 
		select heading_data_id,heading_name into v_zero_heading_no,v_heading_name 
		from account_heading_data ahd where data_id = p_data_id and heading_no=0;
		
		INSERT INTO group_data(	group_name,
								created_date
							 )
					  values ( 	v_heading_name,
								now()
							);
		SELECT LAST_INSERT_ID() INTO v_zero_group_id; 
    
		INSERT INTO heading_group_relation(group_id,heading_data_id,created_date)
		values(v_zero_group_id,v_zero_heading_no,now());
	end if;   

	INSERT INTO group_data(	group_name,
							updated_business_activity,
							updated_heading_link,
							created_date
						 )
				  values ( 	p_group_name,
							p_updated_business_activity,
							p_updated_heading_link,
							now()
						);
						
	SELECT LAST_INSERT_ID() INTO v_group_id;              

	SET v_heading_id = strSplit(p_heading_data_id,'~',v_k);
    
	main_loop:LOOP

	INSERT INTO heading_group_relation(group_id,heading_data_id,created_date)
	values(v_group_id,v_heading_id,now());

	SET v_k =v_k +1;
	SET v_heading_id = if(strSplit(p_heading_data_id,'~',v_k)='',0,strSplit(p_heading_data_id,'~',v_k));

	if(v_heading_id=0) then 
		leave main_loop;
	end if;

	END LOOP main_loop;
else 
	select 'Group name already exist' as error;
end if;                    

END$$

CREATE  PROCEDURE `updated_heading_data_with_hqs` (IN `p_text` LONGTEXT)  BEGIN
DECLARE v_tspec_family varchar(255);
DECLARE v_tspec_category varchar(255);
DECLARE v_substr varchar(255);
DECLARE v_hqs varchar(255);
DECLARE v_heading_data_id INT(11);
DECLARE v_new_heading_data_id INT(11);
DECLARE v_k INT(11) default 1;

main_loop:LOOP

	SET v_substr=strSplit(p_text,'^',v_k);
    
    if(v_substr = '') then
		leave main_loop;
    end if;
    
    SET v_tspec_family=strSplit(v_substr,'~',1);
    SET v_tspec_category=strSplit(v_substr,'~',2);
    SET v_hqs=strSplit(v_substr,'~',3);
    SET v_heading_data_id=strSplit(v_substr,'~',4);
    
    select count(*) into v_new_heading_data_id from heading_updated_data where heading_data_id = v_heading_data_id;
    
    if(v_new_heading_data_id = 0) then
		
		INSERT INTO heading_updated_data(heading_data_id,tspec_family,tspec_category,hqs,created_date)
		values (v_heading_data_id,v_tspec_family,v_tspec_category,v_hqs,now());
    else 
		update heading_updated_data SET tspec_family=v_tspec_family,tspec_category=v_tspec_category,hqs=v_hqs,created_date=now()
        where heading_data_id=v_heading_data_id;
    end if;    
    
    SET v_k=v_k+1;
    
END LOOP main_loop;

END$$

CREATE  PROCEDURE `update_group_heading` (IN `p_group_id` INT(11), IN `p_heading_data_id` VARCHAR(255), IN `p_updated_business_activity` VARCHAR(255), IN `p_updated_heading_link` VARCHAR(255), IN `p_group_name` VARCHAR(255))  BEGIN

DECLARE v_heading_id INT(11) default null;
DECLARE v_k INT(11) default 1;
DECLARE v_group_name VARCHAR(255) DEFAULT NULL;

select group_name into v_group_name from group_data where group_name = p_group_name;


update group_data set group_name = p_group_name , updated_business_activity = p_updated_business_activity,
updated_heading_link = p_updated_heading_link where group_id= p_group_id;

DELETE FROM heading_group_relation WHERE group_id = p_group_id;

SET v_heading_id = strSplit(p_heading_data_id,'~',v_k);

main_loop:LOOP

	INSERT INTO heading_group_relation(group_id,heading_data_id,created_date)
	values(p_group_id,v_heading_id,now());

	SET v_k =v_k +1;
    SET v_heading_id = if(strSplit(p_heading_data_id,'~',v_k)='',0,strSplit(p_heading_data_id,'~',v_k));

	if(v_heading_id=0) then 
		leave main_loop;
	end if;

END LOOP main_loop;

END$$

--
-- Functions
--
CREATE  FUNCTION `strSplit` (`x` TEXT, `delim` VARCHAR(12), `pos` INT) RETURNS TEXT CHARSET latin1 BEGIN
   RETURN replace(substring(substring_index(x, delim, pos), 
      length(substring_index(x, delim, pos - 1)) + 1), delim, '');
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `account_data`
--

CREATE TABLE `account_data` (
  `data_id` int(11) NOT NULL,
  `acc_no` int(11) DEFAULT NULL,
  `acc_name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `copro` text,
  `suffix` varchar(255) DEFAULT NULL,
  `legalname` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `address3` varchar(255) DEFAULT NULL,
  `address4` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `postcode` int(10) DEFAULT NULL,
  `created_date` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `account_heading_data`
--

CREATE TABLE `account_heading_data` (
  `heading_data_id` int(11) NOT NULL,
  `heading_no` int(11) DEFAULT NULL,
  `heading_name` varchar(255) DEFAULT NULL,
  `pdmtextnum` varchar(255) DEFAULT NULL,
  `pdmtext` text,
  `link` varchar(255) DEFAULT NULL,
  `business_activity` varchar(255) DEFAULT NULL,
  `data_id` int(11) DEFAULT NULL,
  `acc_no` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `group_status` int(11) DEFAULT '0',
  `created_date` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `group_data`
--

CREATE TABLE `group_data` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(25) DEFAULT NULL,
  `updated_business_activity` varchar(255) DEFAULT NULL,
  `updated_heading_link` varchar(255) DEFAULT NULL,
  `updated_pdm_text` text,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `heading_group_relation`
--

CREATE TABLE `heading_group_relation` (
  `relation_id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `heading_data_id` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `heading_pdm_zero_data`
--

CREATE TABLE `heading_pdm_zero_data` (
  `zero_id` int(11) NOT NULL,
  `heading_data_id` int(11) DEFAULT NULL,
  `updated_pdm_text` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `heading_updated_data`
--

CREATE TABLE `heading_updated_data` (
  `updated_id` int(11) NOT NULL,
  `heading_data_id` varchar(45) DEFAULT NULL,
  `tspec_family` varchar(255) DEFAULT NULL,
  `tspec_category` varchar(255) DEFAULT NULL,
  `hqs` int(11) DEFAULT NULL,
  `created_date` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tax_table`
--

CREATE TABLE `tax_table` (
  `heading_id` int(11) DEFAULT NULL,
  `heading_name` varchar(255) DEFAULT NULL,
  `heading_type` varchar(255) DEFAULT NULL,
  `family` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_data`
--

CREATE TABLE `temp_data` (
  `temp_id` int(11) NOT NULL,
  `acc_no` int(11) DEFAULT NULL,
  `acc_name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `copro` text,
  `heading_no` varchar(25) DEFAULT NULL,
  `heading_name` varchar(255) DEFAULT NULL,
  `pdmtextnum` varchar(25) DEFAULT NULL,
  `pdmtext` text,
  `link` varchar(255) DEFAULT NULL,
  `business_acitivity` varchar(255) DEFAULT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `legal_name` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL COMMENT '	',
  `address3` varchar(255) DEFAULT NULL,
  `address4` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `postcode` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_data`
--
ALTER TABLE `account_data`
  ADD PRIMARY KEY (`data_id`),
  ADD UNIQUE KEY `acc_no_UNIQUE` (`acc_no`);

--
-- Indexes for table `account_heading_data`
--
ALTER TABLE `account_heading_data`
  ADD PRIMARY KEY (`heading_data_id`);

--
-- Indexes for table `group_data`
--
ALTER TABLE `group_data`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `heading_group_relation`
--
ALTER TABLE `heading_group_relation`
  ADD PRIMARY KEY (`relation_id`);

--
-- Indexes for table `heading_pdm_zero_data`
--
ALTER TABLE `heading_pdm_zero_data`
  ADD PRIMARY KEY (`zero_id`);

--
-- Indexes for table `heading_updated_data`
--
ALTER TABLE `heading_updated_data`
  ADD PRIMARY KEY (`updated_id`);

--
-- Indexes for table `temp_data`
--
ALTER TABLE `temp_data`
  ADD PRIMARY KEY (`temp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_data`
--
ALTER TABLE `account_data`
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `account_heading_data`
--
ALTER TABLE `account_heading_data`
  MODIFY `heading_data_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_data`
--
ALTER TABLE `group_data`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `heading_group_relation`
--
ALTER TABLE `heading_group_relation`
  MODIFY `relation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `heading_pdm_zero_data`
--
ALTER TABLE `heading_pdm_zero_data`
  MODIFY `zero_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `heading_updated_data`
--
ALTER TABLE `heading_updated_data`
  MODIFY `updated_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_data`
--
ALTER TABLE `temp_data`
  MODIFY `temp_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
