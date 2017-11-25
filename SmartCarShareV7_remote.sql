
/*
SmartCarShare.sql
PURPOSE
Rebuild and populate the SmartCarShare database
*/

DROP TABLE IF EXISTS arch_bookings;
DROP TABLE IF EXISTS arch_members;
DROP TABLE IF EXISTS damage_reports;
DROP TABLE IF EXISTS reviews;
DROP TABLE IF EXISTS bookings;
DROP TABLE IF EXISTS payments;
DROP TABLE IF EXISTS member_memberships;
DROP TABLE IF EXISTS members;
DROP TABLE IF EXISTS membership_rates;
DROP TABLE IF EXISTS membership_types;
DROP TABLE IF EXISTS vehicles;
DROP TABLE IF EXISTS vehicle_types;
DROP TABLE IF EXISTS locations;
DROP TABLE IF EXISTS staff;
DROP TABLE IF EXISTS migrations;
DROP TABLE IF EXISTS password_resets;

CREATE TABLE staff
(
	Staff_No 			INT NOT NULL AUTO_INCREMENT,
	Last_Name			varchar(50) NOT NULL,
	First_Name			varchar(50) NOT NULL,
	Street_Address		varchar(50) NOT NULL,
	Suburb				varchar(50) NOT NULL,
	Postcode			Numeric(4)	NOT NULL,
	Phone_No			varchar(15),
	Email_Add			varchar(255) NOT NULL,
	Position			varchar(20) NOT NULL,
	Date_Birth			datetime NOT NULL,
	username			varchar(191) NOT NULL UNIQUE,
	password			varchar(191) NOT NULL,
	remember_token		varchar(100),
	PRIMARY KEY(Staff_No),
	CONSTRAINT ck_staff_pos CHECK(Position IN ('Manager', 'Admin', 'Senior Admin', 'Staff'))
);

INSERT INTO staff VALUES(1000,'Strident','Mary','HIT','Chadstone',3088,'03912345678','marystrident@hit.com','Admin','2000-01-01','marys','',NULL);
INSERT INTO staff VALUES(1001,'Trudent','Sam','3 Rose st','Fitzroy',3068,'03912345678','samtrudent@gmail.com','Admin','1980-08-07','samt','',NULL);

INSERT INTO staff VALUES(1002,'Wilson','Ian','123 Alans Schenk','Lake Hylia',3003,'0400123123','alan@schenk.edu.au','Manager','1992-01-01','alans','',NULL);
INSERT INTO staff VALUES(1003,'Pearce','Ebony','47 Woodhouse Gve','Ikana Canyon',3004,'0400456456','darkwood@yahoo.com','Manager','1994-03-12','ebonyp','',NULL);
INSERT INTO staff VALUES(1004,'Duffield','Christine','8 Santa Rd','Lake Hylia',3003,'0400789789','cartoonbeer@gmail.com','Senior Admin','1987-05-16','christined','',NULL);
INSERT INTO staff VALUES(1005,'Johncock','Billy','9 Mikey Way','Ikana Canyon',3004,'0400121212','bass@chemical.com','Staff','1985-04-04','billyj','',NULL);
INSERT INTO staff VALUES(1006,'Houston','Amanda','5 Gerard Way','Snowhead',3005,'0400131313','sing@chemical.com','Admin','1986-05-05','amandah','',NULL);

INSERT INTO staff VALUES(1007,'Jonas','Tom','12A Zora Domain','Lake Hylia',3003,'0401407582','ivorcatt@mail.com','Senior Admin','1948-12-03','tom1','$2y$10$ZGlHj4ujoLcvh.7ZASVdU./2Cs3XKVZ6Q0dEpnisemOr4uxLKm.5u',NULL);
INSERT INTO staff VALUES(1008,'Perchetta','Tomina','13 Nils St','Nils',3102,'0412789789','miniperchiti@nilsmail.net','Staff','1968-06-21','tom0','$2y$10$ozQJiYZTLwlcu3jKS5BFJO1rfpmm2miOV2lIpObcBkfSjZH.DIpB2',NULL);
INSERT INTO staff VALUES(1009,'Pietersen','Tomagener','14 Peters Ln','Poiter',3202,'0456234234','tomagener@nilsmail.net','Manager','1992-07-20','tom2','$2y$10$gYgf61N.PuzW9lKgDkL.teeYpj7iCmGGTehJXXB0g1ranq7UoTWvW',NULL);

CREATE TABLE locations
(
	Location_Id 		INT NOT NULL AUTO_INCREMENT,
	Council_Name		varchar(100)NOT NULL,
	Contact_Name		varchar(100)NOT NULL,
	Phone_No			varchar(15) NOT NULL,
	Email_Add			varchar(50) NOT NULL,
	Street_Address		varchar(50) NOT NULL,
	Suburb				varchar(50) NOT NULL,
	Postcode			Numeric(4)	NOT NULL,
	Parking_Levy_Amt	DECIMAL(6,2) NOT NULL,
	Staff_No 			INT NOT NULL,
	Latitude			DECIMAL(9,6),
	Longitude			DECIMAL(9,6),
	PRIMARY KEY(Location_Id),
	FOREIGN KEY (Staff_No) REFERENCES staff (Staff_No)
);

INSERT INTO locations VALUES(1,'Boroondara','Gandalf','039999999999','gandalf@lordoftherings.com','38 Taylor St','Ashburton','3147',50.00,1003,'-37.872212','145.072729');

INSERT INTO locations VALUES(2,'Stonnington','Ganondorf','666','nuffin@why.com','77 Chadstone Rd','Malvern East','3145',12.00,1003,'-37.881425','145.078996');
INSERT INTO locations VALUES(3,'Monash','Ganondorf','666','nuffin@why.com','45 Batesford Rd','Chadstone','3148',12.00,1004,'-37.875209','145.100013');
INSERT INTO locations VALUES(4,'Monash','Ganondorf','666','nuffin@why.com','60 Watsons Rd','Glen Waverley','3150',12.00,1004,'-37.897050','145.169203');
INSERT INTO locations VALUES(5,'Monash','Ganondorf','666','nuffin@why.com','49 Viewpoint Ave','Kakariko Village','3003',12.00,1006,'-37.889502','145.171422');

CREATE TABLE vehicle_types
(
	Type_Id 			INT NOT NULL AUTO_INCREMENT,
	Make				varchar(20) NOT NULL,
	Model				varchar(20) NOT NULL,
	Eng_Cap				Numeric(4) NOT NULL,
	Body_Type			varchar(20) NOT NULL,
	Class				varchar(20) NOT NULL,
	Colour				varchar(20) NOT NULL,
	PRIMARY KEY(Type_Id),
	CONSTRAINT ck_vtype_body CHECK(Body_Type IN ('Hatchback', 'Sedan', '4WD', 'Myth')),
	CONSTRAINT ck_vtype_class CHECK(Class IN ('Small', 'Large'))
);

INSERT INTO vehicle_types VALUES(1,'Hyundai','i30',4000,'Hatchback','Small','Red');
INSERT INTO vehicle_types VALUES(2,'Toyota','Yaris',4000,'Hatchback','Small','Red');

INSERT INTO vehicle_types VALUES(3,'Nissan','Shortbox',1200,'Sedan','Small','White');
INSERT INTO vehicle_types VALUES(4,'Honda','Accent',6000,'Sedan','Small','Silver');
INSERT INTO vehicle_types VALUES(5,'Toyota','Corolla',4500,'Sedan','Small','Blue');
INSERT INTO vehicle_types VALUES(6,'Toyota','Yaris',4000,'Hatchback','Small','Pink');
INSERT INTO vehicle_types VALUES(7,'Zeus','Ascension',12000,'Myth','Large','Black');
INSERT INTO vehicle_types VALUES(8,'Ford','Territory',8700,'4WD','Large','White');

CREATE TABLE vehicles
(
	Rego_No 			varchar(10),
	Type_Id 			INT NOT NULL,
	VIN_No				varchar(20) NOT NULL UNIQUE,
	Odo_Reading			Numeric (6)	NOT NULL,
	Year 				Numeric(4)	NOT NULL,
	Location_Id 		INT 		NOT NULL,
	Date_Acquired		datetime NOT NULL,
	Date_Disposed		datetime,
	Staff_No 			INT NOT NULL,
	PRIMARY KEY(Rego_no),
	FOREIGN KEY (Location_Id) REFERENCES locations (Location_Id),
	FOREIGN KEY (Type_Id) REFERENCES vehicle_types (Type_Id),
	FOREIGN KEY (Staff_No) REFERENCES staff (Staff_No)
);

INSERT INTO vehicles VALUES('XPV601',1,'ABC123DEF45612345',19000,2016,1,'2016-11-01',NULL,1000);
INSERT INTO vehicles VALUES('MFD601',2,'ZCY123ZCY45623456',34000,2016,1,'2016-11-01',NULL,1001);

INSERT INTO vehicles VALUES('ELM678',3,'JCRUD7E00H0497230',179000,1984,2,'2014-03-27 00:00:00',NULL,1003);
INSERT INTO vehicles VALUES('HWY365',4,'JTNGU37E01H049791',32000,2013,3,'2016-11-12 00:00:00',NULL,1002);
INSERT INTO vehicles VALUES('YOG455',5,'SANBU59E20Y087221',85000,2008,4,'2016-11-12 00:00:00',NULL,1004);
INSERT INTO vehicles VALUES('CAR101',3,'JCRUD7E00H049724',248000,1981,5,'2015-07-30 00:00:00',NULL,1003);
INSERT INTO vehicles VALUES('WND888',7,'JTNGU37E01H049792',12000,2016,4,'2017-06-19 00:00:00',NULL,1002);
INSERT INTO vehicles VALUES('POW111',6,'SANBU59E20Y087222',85000,2007,3,'2017-04-01 00:00:00',NULL,1004);
INSERT INTO vehicles VALUES('GOA237',8,'JCRUD7E00H049725',179000,2001,5,'2016-10-03 00:00:00',NULL,1003);
INSERT INTO vehicles VALUES('IOF389',8,'JTNGU37E01H049793',32000,2005,4,'2017-02-05 00:00:00',NULL,1002);
INSERT INTO vehicles VALUES('FJE350',4,'SANBU59E20Y087223',85000,1998,2,'2016-08-09 00:00:00',NULL,1004);

CREATE TABLE membership_types
(
	MemType_Id 			INT NOT NULL AUTO_INCREMENT,
	Type_Name			varchar(50) NOT NULL,
	Valid_From			datetime NOT NULL,
	Valid_To			datetime,
	Description			varchar(300) NOT NULL,
	Annual_Fee			DECIMAL(6,2)  NOT NULL,
	Add_Driver_Fee		DECIMAL(6,2)  NOT NULL,
	Auth_Amount			DECIMAL(6,2)  NOT NULL,
	Included_Klm		DECIMAL(6,2)  NOT NULL,
	Add_Klm_Charge		DECIMAL(6,2)  NOT NULL,
	SmallVch_HrRate		DECIMAL(6,2)  NOT NULL,
	SmallVch_Dly_Rate	DECIMAL(6,2)  NOT NULL,
	LargeVch_HrRate		DECIMAL(6,2)  NOT NULL,
	LargeVch_Dly_Rate	DECIMAL(6,2)  NOT NULL,
	PRIMARY KEY(MemType_Id),
	CONSTRAINT ck_memtype_type CHECK(Type_Name IN ('Casual', 'Budget', 'Regular'))
);
INSERT INTO membership_types VALUES(1,'Casual','2016-01-01 00:00:01','2016-12-31 23:59:29','This type of membership is best suited for people who want to use a vehicle up to 10 or 12 times a year.',70.00,24.00,480.00,95.00,0.41,10.20,87.00,13.80,105.00);
INSERT INTO membership_types VALUES(2,'Budget','2016-01-01 00:00:01','2016-12-31 23:59:29','This type of membership is best suited for people who want to use a vehicle 3 or 4 times a month.',130.00,18.00,220.00,135.00,0.39,9.10,78.00,13.20,96.00);
INSERT INTO membership_types VALUES(3,'Regular','2016-01-01 00:00:01','2016-12-31 23:59:29','This type of membership is best suited for people who want to use a vehicle on a regular basis.',260.00,14.20,360.00,190.00,0.37,7.10,60.00,9.80,77.00);
INSERT INTO membership_types VALUES(4,'Casual','2017-01-01 00:00:01','2017-12-31 23:59:29','This type of membership is best suited for people who want to use a vehicle up to 10 or 12 times a year.',75.00,25.00,500.00,100.00,0.43,10.50,90.00,14.50,112.00);
INSERT INTO membership_types VALUES(5,'Budget','2017-01-01 00:00:01','2017-12-31 23:59:29','This type of membership is best suited for people who want to use a vehicle 3 or 4 times a month.',150.00,20.00,250.00,150.00,0.41,9.50,81.00,13.80,103.00);
INSERT INTO membership_types VALUES(6,'Regular','2017-01-01 00:00:01','2017-12-31 23:59:29','This type of membership is best suited for people who want to use a vehicle on a regular basis.',300.00,15.00,400.00,200.00,0.39,7.50,63.00,10.50,85.00);

CREATE TABLE members
(
	Membership_No 		INT NOT NULL AUTO_INCREMENT,
	Date_Received		datetime NOT NULL,
	Last_Name			varchar(50) NOT NULL,
	First_Name			varchar(50) NOT NULL,
	Street_Address		varchar(50) NOT NULL,
	Suburb				varchar(50) NOT NULL,
	Postcode			Numeric(4)  NOT NULL,
	Phone_No			varchar(15),
	Email_Add			varchar(50) NOT NULL,
	Type				varchar(10) NOT NULL,
	Licence_No			varchar(10) NOT NULL UNIQUE,
	Licence_Exp			datetime 	NOT NULL,
	Terms_Accepted		TINYINT 	NOT NULL,
	Terms_File_Loc		varchar(100) NOT NULL,
	Acceptance_Date		datetime NOT NULL,
	User_Name			varchar(100) NOT NULL UNIQUE,
	Password			varchar(200) NOT NULL,
	PRIMARY KEY(Membership_No)
);

INSERT INTO members VALUES(100000,'2017-02-23','Baggins','Frodo','1 Hill Top','Bag End','1111','0412345678','frodo@gmail.com','Member','1234567','2021-05-21',1,'/Terms/Mem100000_TC.pdf','2017-02-24','frodo',								'abde6eac60da5cc8653367da0d18a78e6230a3fcecd01cbc2a4e554f7fc51925');
INSERT INTO members VALUES(100001,'2017-03-18','Schonk','Aaron','50 Pole Street','Collingwood','3066','0424491529','aschonk@gmail.com','Member','8734560','2021-05-21',1,'/Terms/Mem100001_TC.pdf','2017-03-18','aschonk',					'1bf860475e57f65b7cac9a28a8eb7f58f18bf62a45ffeaa3504a05135e73d8a2');

INSERT INTO members VALUES(100002,'2017-01-01','Robinson','Taylor','123 Fake St','Gerudo Valley','3002','0412345678','tales@tmail.com','Member','10010001000','2019-12-31',1,'/Terms/Mem100002_TC.pdf','2017-01-03','tales',				'ebc227538330d260a6c7680cdfbc78ed06d02355bcd3600f53c88e675f174442');
INSERT INTO members VALUES(100003,'2017-01-03','Toad','Releasio','87 Ah St','Kakariko Village','3003','0487654321','imthebest@yahoo.com','Member','10020003456','2018-11-17',1,'/Terms/Mem100003_TC.pdf','2017-01-04','herewegoyahoookay',	'f5cf5194f2f0a71515709a6df1d25b3f49f4ce21d4b166c45f7d5886a0bb4f09');
INSERT INTO members VALUES(100004,'2016-08-14','McLachlan','Jade','245 Sterling St','Lake Hylia','3005','0456565656','jademl@hotmail.com','Member','10020003009','2019-02-08',1,'/Terms/Mem100004_TC.pdf','2016-08-14','jademl',			'9feb9195d2664e1c2f65e973af64f163b2457279da4fb16313e79a7829cd8340');

CREATE TABLE member_memberships
(
	Membership_No 			INT NOT NULL,
	MemType_Id 				INT NOT NULL, 
	Date_Joined				datetime NOT NULL,
	Last_Renewed			datetime,
	Expiry_Date				datetime NOT NULL,
	Status					varchar(15) NOT NULL,
	SmartCard_Issued		TINYINT NOT NULL,
	SmartCard_No			INT,
	PRIMARY KEY (Membership_No, MemType_Id),
	FOREIGN KEY (Membership_No) REFERENCES members (Membership_No),
	FOREIGN KEY (MemType_Id) REFERENCES membership_types (MemType_Id),
	CONSTRAINT ck_memberships_status CHECK(Status IN ('Pending', 'Approved', 'Suspended', 'Expired', 'Cancelled'))
);

INSERT INTO member_memberships VALUES(100000,6,'2017-01-01',NULL,'2018-01-01','Pending',1,100000);
INSERT INTO member_memberships VALUES(100001,6,'2017-01-01',NULL,'2018-01-01','Suspended',1,100001);

INSERT INTO member_memberships VALUES(100002,5,'2017-01-01',NULL,'2018-01-01','Approved',1,100002);
INSERT INTO member_memberships VALUES(100003,4,'2017-01-01',NULL,'2018-01-01','Approved',1,100003);
INSERT INTO member_memberships VALUES(100004,1,'2017-01-01',NULL,'2018-01-01','Expired',1,100003);

CREATE TABLE payments
(
	Payment_No 			INT NOT NULL AUTO_INCREMENT,
	Membership_No 		INT 		NOT NULL,
	Date				datetime 	NOT NULL,
	Payment_Type		varchar(10) NOT NULL,
	Payment_Amount		DECIMAL(6,2) NOT NULL,
	Card_Name			varchar(50) NOT NULL,
	Card_Number			Numeric(20)	NOT NULL,
	Exp_Date			datetime	NOT NULL,
	CCV_No				Numeric (4)	NOT NULL,
	Auth_Code			varchar(10) NOT NULL,
	Staff_No 			INT 		NOT NULL,
	PRIMARY KEY(Payment_No),
	FOREIGN KEY (Membership_No) REFERENCES members (Membership_No),
	FOREIGN KEY (Staff_No) REFERENCES staff (Staff_No)
);

INSERT INTO payments VALUES(1,100000,'2017-01-05 14:31:05','Credit',172.50,'F BAGGINS',1234678912346789,'2019-08-01',202,'A123456',1000);
INSERT INTO payments VALUES(2,100001,'2017-01-10 09:17:32','Credit',172.50,'A SCHONK',4639231932,'2019-07-01',478,'A123456',1000);

INSERT INTO payments VALUES(3,100000,'2017-05-12 21:51:43','Credit',200.00,'F BAGGINS',1234678912346789,'2019-08-01',202,'A123457',1004);
INSERT INTO payments VALUES(4,100003,'2017-09-05 08:12:24','Credit',200.00,'TOAD TOAD TOAD',102304506708,'2019-07-01',122,'A123458',1003);
INSERT INTO payments VALUES(5,100002,'2017-08-12 21:53:58','Credit',200.00,'T ROBINSON',109807605403,'2017-12-01',367,'A123459',1004);
INSERT INTO payments VALUES(6,100001,'2017-10-23 07:47:05','Credit',220.00,'A SCHONK',4639231932,'2019-07-01',478,'A123460',1004);
INSERT INTO payments VALUES(7,100004,'2017-10-21 14:17:52','Credit',220.00,'J MCLACHLAN',8563265345963,'2020-05-01',589,'A123461',1004);

INSERT INTO payments VALUES(8,100003,'2017-07-24 16:43:28','Credit',220.00,'TOAD TOAD TOAD',102304506708,'2019-07-01',122,'A123457',1004);
INSERT INTO payments VALUES(9,100002,'2017-08-02 13:23:35','Credit',220.00,'T ROBINSON',109807605403,'2017-12-01',367,'A123458',1004);
INSERT INTO payments VALUES(10,100003,'2017-08-03 09:27:39','Credit',220.00,'TOAD TOAD TOAD',102304506708,'2019-07-01',122,'A123459',1004);
INSERT INTO payments VALUES(11,100003,'2017-09-03 11:35:53','Credit',220.00,'TOAD TOAD TOAD',102304506708,'2019-07-01',122,'A123460',1004);
INSERT INTO payments VALUES(12,100002,'2017-09-12 22:12:02','Credit',220.00,'T ROBINSON',109807605403,'2017-12-01',367,'A123461',1004);

CREATE TABLE bookings
(
	Booking_No 			INT NOT NULL AUTO_INCREMENT,
	Rego_No 			varchar(10) NOT NULL,
	Membership_No 		INT 		NOT NULL,
	Booking_Date		datetime 	NOT NULL,
	Start_Date			datetime 	NOT NULL,
	Start_Klm			Numeric (6),
	Return_Date			datetime,
	Actual_Return_Date	datetime,
	Return_Klm			Numeric (6),
	Actual_Return_Klm	Numeric (6),
	Fuel_Fee			DECIMAL(6,2) NOT NULL,
	Insurance_Fee		DECIMAL(6,2) NOT NULL,
	Total_exGST			DECIMAL(6,2),
	GST_Amount			DECIMAL(6,2),
	Booking_Notes		varchar(300),
	Payment_No 			INT 	NOT NULL,
	Staff_No 			INT,
	PRIMARY KEY(Booking_No),
	FOREIGN KEY (Rego_No) REFERENCES vehicles (Rego_No),
	FOREIGN KEY (Membership_No) REFERENCES members (Membership_No),
	FOREIGN KEY (Payment_No) REFERENCES payments (Payment_No),
	FOREIGN KEY (Staff_No) REFERENCES staff (Staff_No)
); 

INSERT INTO bookings VALUES(1,'XPV601',100000,'2017-05-12 21:51:43','2017-06-10',NULL,'2017-06-20',NULL,NULL,NULL,50.00,100.00,150.00,22.50,'Car for weekend',3,1000);
INSERT INTO bookings VALUES(16,'XPV601',100001,'2017-01-10 09:17:32','2017-02-22',20070,'2017-02-25','2017-02-25',20100,20100,50.00,100.00,150.00,22.50,'On holiday',2,1000);

INSERT INTO bookings VALUES(2,'ELM678',100002,'2017-08-12 21:53:58','2017-11-30 10:00:00',NULL,'2017-12-03 15:00:00',NULL,NULL,NULL,40.00,10.00,200.00,20.00,'Wagging school',5,1004);
INSERT INTO bookings VALUES(3,'YOG455',100000,'2017-01-05 14:31:05','2017-09-24 13:00:00',NULL,'2017-09-26 12:00:00',NULL,NULL,NULL,40.00,10.00,200.00,20.00,NULL,1,1003);
INSERT INTO bookings VALUES(5,'ELM678',100003,'2017-07-24 16:43:28','2017-09-19 22:30:00',NULL,'2017-09-20 09:45:00',NULL,NULL,NULL,40.00,10.00,200.00,20.00,'Doughies in a rental car',8,1004);
INSERT INTO bookings VALUES(6,'HWY365',100002,'2017-08-02 13:23:35','2017-08-21 12:30:00',31500,'2017-08-22 12:30:00','2017-08-22 12:24:57',31500,31800,40.00,10.00,200.00,20.00,NULL,9,1004);
INSERT INTO bookings VALUES(7,'WND888',100003,'2017-08-03 09:27:39','2017-08-25 16:30:00',31800,'2017-08-28 16:00:00','2017-08-28 16:31:22',32500,32000,40.00,10.00,200.00,20.00,'YAHOO',10,1004);
INSERT INTO bookings VALUES(8,'FJE350',100003,'2017-09-03 11:35:53','2017-10-19 07:30:00',NULL,'2017-10-21 08:30:00',NULL,NULL,NULL,40.00,10.00,200.00,20.00,'Trip to Bairnsdale',11,1004);
INSERT INTO bookings VALUES(9,'GOA237',100003,'2017-09-05 08:12:24','2017-10-19 11:30:00',NULL,'2017-10-22 12:00:00',NULL,NULL,NULL,40.00,10.00,200.00,20.00,'Goin to Bonnie Doon',4,1004);
INSERT INTO bookings VALUES(10,'FJE350',100002,'2017-09-12 22:12:02','2017-12-19 09:30:00',NULL,'2017-12-19 16:30:00',NULL,NULL,NULL,40.00,10.00,200.00,20.00,NULL,12,1004);
INSERT INTO bookings VALUES(11,'YOG455',100001,'2017-10-23 07:47:05','2017-11-01 14:00:00',87000,'2017-11-04 18:00:00','2017-11-04 17:53:07',31500,31800,40.00,10.00,200.00,20.00,'Great Ocean Rd',6,1004);
INSERT INTO bookings VALUES(12,'ELM678',100004,'2017-10-21 14:17:52','2017-11-03 09:30:00',35800,'2017-11-04 17:00:00','2017-11-04 17:12:40',32500,32000,40.00,10.00,200.00,20.00,'Torquay',7,1004);

CREATE TABLE reviews
(
	Review_Id 			INT NOT NULL AUTO_INCREMENT,
	Rego_No 			varchar(10) NOT NULL,
	Membership_No 		INT 		NOT NULL,
	Rating				INT NOT NULL,
	Review_Date			datetime 	NOT NULL,
	Feedback			varchar(300) NOT NULL,
	PRIMARY KEY(Review_Id),
	FOREIGN KEY (Membership_No) REFERENCES members (Membership_No),
	FOREIGN KEY (Rego_No) REFERENCES vehicles (Rego_No)
); 

INSERT INTO reviews VALUES(1,'XPV601',100000, 5, '2017-01-04','Has terrible clutch action');
INSERT INTO reviews VALUES(2,'XPV601',100001, 3, '2017-01-05','No Guts');

INSERT INTO reviews VALUES(3,'HWY365',100002, 1, '2017-08-22 12:31:06','Terrible experience. I may book this again.');
INSERT INTO reviews VALUES(4,'HWY365',100003, 4, '2017-08-29 11:04:31','It was pretty OK I guess');

CREATE TABLE damage_reports
(
	Damage_Id 			INT NOT NULL AUTO_INCREMENT,
	Rego_No 			varchar(10) NOT NULL,
	Membership_No 		INT 		NOT NULL,
	Damage_Date			datetime 	NOT NULL,
	Feedback			varchar(300) NOT NULL,
	PRIMARY KEY(Damage_Id),
	FOREIGN KEY (Membership_No) REFERENCES members (Membership_No),
	FOREIGN KEY (Rego_No) REFERENCES vehicles (Rego_No)
);

INSERT INTO damage_reports VALUES(1,'XPV601',100000, '2017-01-04','Rear vision mirror broken');
INSERT INTO damage_reports VALUES(2,'XPV601',100001, '2017-01-05','bumper bar dented');

INSERT INTO damage_reports VALUES(3,'HWY365',100002, '2017-08-21 12:30:00','The whole rear window was gone and replaced by duct tape');

CREATE TABLE arch_members
(
	Arch_No 			INT NOT NULL AUTO_INCREMENT,
	Last_Name			varchar(50) NOT NULL,
	First_Name			varchar(50) NOT NULL,
	Street_Address		varchar(50) NOT NULL,
	Suburb				varchar(50) NOT NULL,
	Postcode			Numeric(4)  NOT NULL,
	Phone_No			varchar(15),
	Email_Add			varchar(50) NOT NULL,
	Licence_No			varchar(10) NOT NULL,
	Acceptance_Date		datetime NOT NULL,
	PRIMARY KEY(Arch_No)
);

CREATE TABLE arch_bookings
(
	Arch_No 			INT NOT NULL AUTO_INCREMENT,
	Booking_Date		datetime 	NOT NULL,
	Start_Date			datetime 	NOT NULL,
	Start_Klm			Numeric (6),
	Actual_Return_Date	datetime,
	Actual_Return_Klm	Numeric (6),
	Payment_Amount		DECIMAL(6,2) NOT NULL,
	Card_Name			varchar(50) NOT NULL,
	Exp_Date			datetime	NOT NULL,
	Last_Name			varchar(50) NOT NULL,
	First_Name			varchar(50) NOT NULL,
	Email_Add			varchar(50) NOT NULL,
	Licence_No			varchar(10) NOT NULL,
	Licence_Exp			datetime 	NOT NULL,
	Rego_No 			varchar(10),
	VIN_No				varchar(20) NOT NULL,
	Make				varchar(20) NOT NULL,
	Model				varchar(20) NOT NULL,
	PRIMARY KEY(Arch_No)
);

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_username_index` (`username`);

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
