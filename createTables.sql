DROP TABLE IF EXISTS frs_Cash;
DROP TABLE IF EXISTS frs_Cheque;
DROP TABLE IF EXISTS frs_CreditCard;
DROP TABLE IF EXISTS frs_DebitCard;
DROP TABLE IF EXISTS frs_FilmRental;
DROP TABLE IF EXISTS frs_RentalStatus;
DROP TABLE IF EXISTS frs_Payment;
DROP TABLE IF EXISTS frs_PaymentType;
DROP TABLE IF EXISTS frs_PaymentStatus;
DROP TABLE IF EXISTS frs_DVD;
DROP TABLE IF EXISTS frs_ShopFilm;
DROP TABLE IF EXISTS frs_Film;
DROP TABLE IF EXISTS frs_Customer;
DROP TABLE IF EXISTS frs_Employee;
DROP TABLE IF EXISTS frs_Shop;
DROP TABLE IF EXISTS frs_Distributor;

CREATE TABLE frs_Distributor
(
distid INTEGER NOT NULL,
distname VARCHAR(30),
diststreet VARCHAR(30),
distcity VARCHAR(20),
distpostcode CHAR(6),
distphone CHAR(12),
PRIMARY KEY (distid)
);

CREATE TABLE frs_Shop
(
shopid INTEGER NOT NULL,
shopname VARCHAR(20),
shopstreet VARCHAR(30),
shopcity VARCHAR(20),
shoppostcode CHAR(6),
shopphone CHAR(12),
distid INTEGER NOT NULL,
PRIMARY KEY (shopid),
FOREIGN KEY (distid) REFERENCES frs_Distributor (distid)
);

CREATE TABLE frs_Employee
(
empnin CHAR(9) NOT NULL,
mgrnin CHAR(9),
empname VARCHAR(20),
empstreet VARCHAR(30),
empcity VARCHAR(20),
emppostcode CHAR(6),
empphone CHAR(12),
emphiredate DATE,
shopid INTEGER NOT NULL,
PRIMARY KEY (empnin),
FOREIGN KEY (mgrnin) REFERENCES frs_Employee (empnin),
FOREIGN KEY (shopid) REFERENCES frs_Shop (shopid)
);

CREATE TABLE frs_Customer
(
custid INTEGER NOT NULL,
custname VARCHAR(40),
custstreet VARCHAR(40),
custcity VARCHAR(30),
custpostcode CHAR(8),
custphone CHAR(12),
PRIMARY KEY (custid)
);

CREATE TABLE frs_Film
(
filmid INTEGER NOT NULL,
filmtitle VARCHAR(50),
filmdescription VARCHAR(500),
filmdirector VARCHAR(20),
filmrating VARCHAR(5),
filmstarname VARCHAR(20),
PRIMARY KEY (filmid)
);

CREATE TABLE frs_ShopFilm
(
filmid INTEGER NOT NULL,
shopid INTEGER NOT NULL,
PRIMARY KEY (filmid, shopid),
FOREIGN KEY (filmid) REFERENCES frs_Film (filmid),
FOREIGN KEY (shopid) REFERENCES frs_Shop (shopid)
);

CREATE TABLE frs_DVD
(
dvdid INTEGER NOT NULL,
filmid INTEGER NOT NULL,
shopid INTEGER NOT NULL,
dvdstate VARCHAR(20),
PRIMARY KEY (dvdid, filmid, shopid),
FOREIGN KEY (filmid, shopid) REFERENCES frs_ShopFilm (filmid, shopid)
);

CREATE TABLE frs_PaymentStatus
(
pstatusid INTEGER NOT NULL,
pdescription VARCHAR(20),
PRIMARY KEY (pstatusid)
);

CREATE TABLE frs_PaymentType
(
ptid INTEGER NOT NULL,
ptdescription VARCHAR(12),
PRIMARY KEY (ptid)
);

CREATE TABLE frs_Payment
(
payid INTEGER NOT NULL AUTO_INCREMENT,
amount DECIMAL(8, 2),
paydatetime TIMESTAMP,
empnin CHAR(9) NOT NULL,
custid INTEGER NOT NULL,
pstatusid INTEGER NOT NULL,
ptid INTEGER NOT NULL,
PRIMARY KEY (payid),
FOREIGN KEY (empnin) REFERENCES frs_Employee (empnin),
FOREIGN KEY (custid) REFERENCES frs_Customer (custid),
FOREIGN KEY (pstatusid) REFERENCES frs_PaymentStatus (pstatusid),
FOREIGN KEY (ptid) REFERENCES frs_PaymentType (ptid)
);

CREATE TABLE frs_RentalStatus
(
rstatusid INTEGER NOT NULL,
rdescription VARCHAR(20),
PRIMARY KEY (rstatusid)
);

CREATE TABLE frs_FilmRental
(
dvdid INTEGER NOT NULL,
filmid INTEGER NOT NULL,
shopid INTEGER NOT NULL,
retdatetime TIMESTAMP,
duedate DATE NOT NULL,
overduecharge DECIMAL(8, 2),
empnin CHAR(9) NOT NULL,
custid INTEGER NOT NULL,
rentalrate DECIMAL(8, 2),
payid INTEGER NOT NULL AUTO_INCREMENT,
rstatusid INTEGER NOT NULL,
PRIMARY KEY (dvdid, filmid, shopid, retdatetime),
FOREIGN KEY (empnin) REFERENCES frs_Employee (empnin),
FOREIGN KEY (custid) REFERENCES frs_Customer (custid),
FOREIGN KEY (dvdid, filmid, shopid) REFERENCES frs_DVD (dvdid, filmid, shopid),
FOREIGN KEY (payid) REFERENCES frs_Payment (payid),
FOREIGN KEY (rstatusid) REFERENCES frs_RentalStatus (rstatusid)
);

CREATE TABLE frs_DebitCard
(
payid INTEGER NOT NULL,
dcno INTEGER,
dctype VARCHAR(20),
dcexpr CHAR(5),
PRIMARY KEY (payid),
FOREIGN KEY (payid) REFERENCES frs_Payment (payid)
);

CREATE TABLE frs_CreditCard
(
payid INTEGER NOT NULL,
ccno INTEGER,
cctype VARCHAR(20),
ccexpr CHAR(5),
PRIMARY KEY (payid),
FOREIGN KEY (payid) REFERENCES frs_Payment (payid)
);

CREATE TABLE frs_Cheque
(
payid INTEGER NOT NULL,
chequeno VARCHAR(30),
bankno VARCHAR(20),
bankname VARCHAR(30),
PRIMARY KEY (payid),
FOREIGN KEY (payid) REFERENCES frs_Payment (payid)
);

CREATE TABLE frs_Cash
(
payid INTEGER NOT NULL,
PRIMARY KEY (payid),
FOREIGN KEY (payid) REFERENCES frs_Payment (payid)
);