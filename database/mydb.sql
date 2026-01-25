-- Step: 01
-- Goal: Create a new database aryanDBassignment
-- **********************************************************************************
-- Version    Date:        Author:         Description:
-- ******* ********** **************** ******************
--    01   10-02-2025      Omid Mhr       Requested new database
-- **********************************************************************************/
-- Check if the database exists
DROP DATABASE IF EXISTS `aryanDBassignment`;

-- Create a new Database
CREATE DATABASE IF NOT EXISTS `aryanDBassignment` DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- Use database aryanDBassignment
USE `aryanDBassignment`;

-- Step: 02
-- Goal: Create a new table allergeen
-- **********************************************************************************
-- Version    Date:        Author:         Description:
-- ******* ********** **************** ******************
--    01   10-02-2025      Omid Mhr       Requested new table
-- **********************************************************************************/
-- Drop table allergeen
DROP TABLE IF EXISTS ProductPerAllergeen;
DROP TABLE IF EXISTS Allergeen;

CREATE TABLE IF NOT EXISTS Allergeen
(
    Id              SMALLINT         UNSIGNED       NOT NULL    AUTO_INCREMENT
   ,Naam            VARCHAR(30)                     NOT NULL
   ,Omschrijving    VARCHAR(100)                    NOT NULL
   ,IsActief        BIT                             NOT NULL    DEFAULT 1
   ,Opmerkingen     VARCHAR(250)                        NULL    DEFAULT NULL
   ,DatumAangemaakt DateTime(6)                     NOT NULL    DEFAULT CURRENT_TIMESTAMP(6)
   ,DatumGewijzigd  DateTime(6)                     NOT NULL    DEFAULT CURRENT_TIMESTAMP(6)
   ,CONSTRAINT      PK_Allergeen_Id   PRIMARY KEY CLUSTERED(Id)
) ENGINE=InnoDB;

-- Step: 03
-- Goal: Fill table Allergeen with data
-- **********************************************************************************
-- Version    Date:        Author:         Description:
-- ******* ********** **************** ******************
--    01   10-12-2025      Omid Mhr       Requested new insert
-- **********************************************************************************/
INSERT INTO Allergeen
(
     Naam
    ,Omschrijving
)
VALUES
     ('Gluten', 'Dit product bevat gluten')
    ,('Gelatine', 'Dit product bevat gelatine')
    ,('AZO-kleurstof', 'Dit product bevat AZO-kleurstof')
    ,('Lactose', 'Dit product bevat lactose')
    ,('Soja', 'Dit product bevat soja');

-- Step: 04
-- Goal: Create a new table product
-- **********************************************************************************
-- Version    Date:        Author:         Description:
-- ******* ********** **************** ******************
--    01   10-12-2025      Omid Mhr       Requested new table
-- **********************************************************************************
DROP TABLE IF EXISTS Magazijn;
DROP TABLE IF EXISTS Product;

CREATE TABLE IF NOT EXISTS Product
(
     Id              MEDIUMINT             UNSIGNED        NOT NULL      AUTO_INCREMENT
    ,Naam            VARCHAR(255)                          NOT NULL
    ,Barcode         VARCHAR(13)                           NOT NULL
    ,IsActief        BIT                                   NOT NULL      DEFAULT 1
    ,Opmerkingen     VARCHAR(255)                              NULL      DEFAULT NULL
    ,DatumAangemaakt Datetime(6)                           NOT NULL      DEFAULT CURRENT_TIMESTAMP(6)
    ,DatumGewijzigd  Datetime(6)                           NOT NULL      DEFAULT CURRENT_TIMESTAMP(6)
    ,CONSTRAINT      PK_Product_Id        PRIMARY KEY CLUSTERED (Id)
) ENGINE=InnoDB   AUTO_INCREMENT=1;


-- Step: 05
-- Goal: Fill table product with data
-- **********************************************************************************
-- Version    Date:        Author:         Description:
-- ******* ********** **************** ******************
--    01   10-12-2025      Omid Mhr       Requested new insert
-- **********************************************************************************
INSERT INTO Product
(
     Naam
    ,Barcode
)
VALUES
     ('Mintnopjes', '8719587231278')
    ,('Schoolkrijt', '8719587326713')
    ,('Honingdrop', '8719587327836')
    ,('Zure Beren', '8719587321441')
    ,('Cola Flesjes', '8719587321237')
    ,('Turtles', '8719587322245')
    ,('Witte Muizen', '8719587328256')
    ,('Reuzen Slangen', '8719587325641')
    ,('Zoute Rijen', '8719587322739')
    ,('Winegums', '8719587327527')
    ,('Drop Munten', '8719587322345')
    ,('Kruis Drop', '8719587322265')
    ,('Zoute Ruitjes', '8719587323256');


-- Step: 06
-- Goal: Create a new table Magazijn
-- **********************************************************************************
-- Version    Date:        Author:         Description:
-- ******* ********** **************** ******************
--    01   10-12-2025      Omid Mhr       Requested new table
-- **********************************************************************************
CREATE TABLE IF NOT EXISTS Magazijn
(
     Id                   MEDIUMINT       UNSIGNED          NOT NULL      AUTO_INCREMENT
    ,ProductId            MEDIUMINT       UNSIGNED          NOT NULL
    ,VerpakkingsEenheid   DECIMAL(4,1)                      NOT NULL
    ,AantalAanwezig       SMALLINT        UNSIGNED          NOT NULL
    ,IsActief             BIT                               NOT NULL      DEFAULT 1
    ,Opmerkingen          VARCHAR(255)                          NULL      DEFAULT NULL
    ,DatumAangemaakt      Datetime(6)                       NOT NULL      DEFAULT CURRENT_TIMESTAMP(6)
    ,DatumGewijzigd       Datetime(6)                       NOT NULL      DEFAULT CURRENT_TIMESTAMP(6)
    ,CONSTRAINT           PK_Magazijn_Id                    PRIMARY KEY CLUSTERED (Id)
    ,CONSTRAINT           FK_Magazijn_ProductId_Product_Id  FOREIGN KEY (ProductId) REFERENCES Product(Id)
) ENGINE=InnoDB   AUTO_INCREMENT=1;

-- Step: 07
-- Goal: Fill table Magazijn with data
-- **********************************************************************************
-- Version    Date:        Author:         Description:
-- ******* ********** **************** ******************
--    01   10-12-2025      Omid Mhr       Requested new insert
-- **********************************************************************************

INSERT INTO Magazijn
(
     ProductId
    ,VerpakkingsEenheid
    ,AantalAanwezig
)
VALUES
     (1, 5, 453)
    ,(2, 2.5, 400)
    ,(3, 5, 1)
    ,(4, 1, 800)
    ,(5, 3, 234)
    ,(6, 2, 345)
    ,(7, 1, 795)
    ,(8, 10, 233)
    ,(9, 2.5, 123)
    ,(10, 3, 0)
    ,(11, 2, 367)
    ,(12, 1, 467)
    ,(13, 5, 20);

-- Step: 08
-- Goal: Create a new table Contact
-- **********************************************************************************
-- Version    Date:        Author:         Description:
-- ******* ********** **************** ******************
--    01   1-25-2026      Omid Mhr       Requested new table
-- **********************************************************************************
DROP TABLE IF EXISTS ProductPerLeverancier;
DROP TABLE IF EXISTS Leverancier;
DROP TABLE IF EXISTS Contact;

CREATE TABLE IF NOT EXISTS Contact
(
        Id                  SMALLINT             UNSIGNED        NOT NULL      AUTO_INCREMENT
        ,Straat             VARCHAR(60)                          NOT NULL
        ,Huisnummer         INT                                  NOT NULL
        ,Postcode           VARCHAR(10)                          NOT NULL
        ,Stad               VARCHAR(60)                          NOT NULL
        ,IsActief           BIT                                  NOT NULL      DEFAULT 1
        ,Opmerkingen        VARCHAR(255)                             NULL      DEFAULT NULL
        ,DatumAangemaakt    Datetime(6)                          NOT NULL      DEFAULT CURRENT_TIMESTAMP(6)
        ,DatumGewijzigd     Datetime(6)                          NOT NULL      DEFAULT CURRENT_TIMESTAMP(6)
        ,CONSTRAINT         PK_Contact_Id        PRIMARY KEY CLUSTERED (Id)
) ENGINE=InnoDB   AUTO_INCREMENT=1;

-- Step: Fill table Contact with data
-- **********************************************************************************
-- Version    Date:        Author:         Description:
-- ******* ********** **************** ******************
--    01   1-25-2026      Omid Mhr       Requested new insert
-- **********************************************************************************
INSERT INTO Contact
(
     Straat
    ,Huisnummer
    ,Postcode
    ,Stad
)
VALUES
     ('Van Gilslaan', 34, '1045CB', 'Hilvarenbeek')
    ,('Den Dolderpad', 2, '1067RC', 'Utrecht')
    ,('Fredo Raalteweg', 257, '1236OP', 'Nijmegen')
    ,('Bertrand Russellhof', 21, '2034AP', 'Den Haag')
    ,('Leon van Bonstraat', 213, '145XC', 'Lunteren')
    ,('Bea van Lingenlaan', 234, '2197FG', 'Sint Pancras');

-- Step: 09
-- Goal: Create a new table Leverancier
-- **********************************************************************************
-- Version    Date:        Author:         Description:
-- ******* ********** **************** ******************
--    01   10-12-2025      Omid Mhr       Requested new table
-- **********************************************************************************

CREATE TABLE IF NOT EXISTS Leverancier
(
     Id                 SMALLINT             UNSIGNED        NOT NULL      AUTO_INCREMENT
    ,fk_ContactId       SMALLINT             UNSIGNED        NOT NULL
    ,Naam               VARCHAR(60)                          NOT NULL
    ,Contactpersoon     VARCHAR(60)                          NOT NULL
    ,Leveranciernummer  VARCHAR(11)                          NOT NULL
    ,Mobiel             VARCHAR(11)                          NOT NULL
    ,IsActief           BIT                                  NOT NULL      DEFAULT 1
    ,Opmerkingen        VARCHAR(255)                             NULL      DEFAULT NULL
    ,DatumAangemaakt Datetime(6)                             NOT NULL      DEFAULT CURRENT_TIMESTAMP(6)
    ,DatumGewijzigd  Datetime(6)                             NOT NULL      DEFAULT CURRENT_TIMESTAMP(6)
    ,CONSTRAINT      PK_Levrancier_Id        PRIMARY KEY CLUSTERED (Id)
    ,CONSTRAINT      FK_Levrancier_ContactId_Contact_Id  FOREIGN KEY (fk_ContactId) REFERENCES Contact(Id)
) ENGINE=InnoDB   AUTO_INCREMENT=1;

-- Step: 10
-- Goal: Fill table Leverancier with data
-- **********************************************************************************
-- Version    Date:        Author:         Description:
-- ******* ********** **************** ******************
--    01   10-12-2025      Omid Mhr       Requested new insert
-- **********************************************************************************
INSERT INTO Leverancier
(
     fk_ContactId
    ,Naam
    ,Contactpersoon
    ,Leveranciernummer
    ,Mobiel
)
VALUES
     (1, 'Venco', 'Bert van Linge', 'L1029384719', '06-28493827')
    ,(2, 'Astra Sweets', 'Jasper del Monte', 'L1029284315', '06-39398734')
    ,(3, 'Haribo', 'Sven Stalman', 'L1029324748', '06-24383291')
    ,(4, 'Basset', 'Joyce Stelterberg', 'L1023845773', '06-48293823')
    ,(5, 'De Bron', 'Remco Veenstra', 'L1023857736', '06-34291234')
    ,(6, 'Quality Street', 'Johan Nooij', 'L1029234586', '06-23458456');

-- Step: 11
CREATE TABLE IF NOT EXISTS ProductPerLeverancier
(
     Id                             MEDIUMINT       UNSIGNED          NOT NULL      AUTO_INCREMENT
    ,LeverancierId                  SMALLINT        UNSIGNED          NOT NULL
    ,ProductId                      MEDIUMINT       UNSIGNED          NOT NULL
    ,DatumLevering                  DATE                              NOT NULL
    ,Aantal                         INT             UNSIGNED          NOT NULL
    ,DatumEerstVolgendeLevering     DATE                                  NULL
    ,IsActief                       BIT                               NOT NULL      DEFAULT 1
    ,Opmerkingen                    VARCHAR(255)                          NULL      DEFAULT NULL
    ,DatumAangemaakt                Datetime(6)                       NOT NULL      DEFAULT CURRENT_TIMESTAMP(6)
    ,DatumGewijzigd                 Datetime(6)                       NOT NULL      DEFAULT CURRENT_TIMESTAMP(6)
    ,CONSTRAINT                     PK_ProductPerLeverancier_Id       PRIMARY KEY CLUSTERED (Id)
    ,CONSTRAINT                     FK_ProductPerLeverancier_LeverancierId_Leverancier_Id  FOREIGN KEY (LeverancierId) REFERENCES Leverancier (Id)
) ENGINE=InnoDB   AUTO_INCREMENT=1;

-- Step: 11
-- Goal: Fill table ProductPerLeverancier with data
-- **********************************************************************************
-- Version    Date:        Author:         Description:
-- ******* ********** **************** ******************
--    01   10-12-2025      Omid Mhr       Requested new insert
-- **********************************************************************************
INSERT INTO ProductPerLeverancier
(
     LeverancierId
    ,ProductID
    ,DatumLevering
    ,Aantal
    ,DatumEerstVolgendeLevering
)
VALUES
 (1, 1, '2024-10-09', 23, '2024-10-16')
,(1, 1, '2024-10-18', 21, '2024-10-25')
,(1, 2, '2024-10-09', 12, '2024-10-16')
,(1, 3, '2024-10-10', 11, '2024-10-17')
,(2, 4, '2024-10-14', 16, '2024-10-21')
,(2, 4, '2024-10-21', 23, '2024-10-28')
,(2, 5, '2024-10-14', 45, '2024-10-21')
,(2, 6, '2024-10-14', 30, '2024-10-21')
,(3, 7, '2024-10-12', 12, '2024-10-19')
,(3, 7, '2024-10-19', 23, '2024-10-26')
,(3, 8, '2024-10-10', 12, '2024-10-17')
,(3, 9, '2024-10-11', 1, '2024-10-18')
,(4, 10, '2024-10-16', 24, '2024-10-30')
,(5, 11, '2024-10-10', 47, '2024-10-17')
,(5, 11, '2024-10-19', 60, '2024-10-26')
,(5, 12, '2024-10-11', 45, NULL)
,(5, 13, '2024-10-12', 23, NULL);


-- Step: 12
-- Goal: Create a new table ProductPerAllergeen
-- **********************************************************************************
-- Version    Date:        Author:         Description:
-- ******* ********** **************** ******************
--    01   10-12-2025      Omid Mhr       Requested new table
-- **********************************************************************************
CREATE TABLE IF NOT EXISTS ProductPerAllergeen
(
     Id                             MEDIUMINT       UNSIGNED          NOT NULL      AUTO_INCREMENT
    ,ProductId                      MEDIUMINT       UNSIGNED          NOT NULL
    ,AllergeenId                    SMALLINT        UNSIGNED          NOT NULL
    ,IsActief                       BIT                               NOT NULL      DEFAULT 1
    ,Opmerkingen                    VARCHAR(255)                          NULL      DEFAULT NULL
    ,DatumAangemaakt                Datetime(6)                       NOT NULL      DEFAULT CURRENT_TIMESTAMP(6)
    ,DatumGewijzigd                 Datetime(6)                       NOT NULL      DEFAULT CURRENT_TIMESTAMP(6)
    ,CONSTRAINT           PK_ProductPerAllergeen_Id  PRIMARY KEY CLUSTERED (Id)
    ,CONSTRAINT           FK_ProductPerAllergeen_ProductId_Product_Id  FOREIGN KEY (ProductId) REFERENCES Product (Id)
    ,CONSTRAINT           FK_ProductPerAllergeen_AllergeenId_Allergeen_Id  FOREIGN KEY (AllergeenId) REFERENCES Allergeen (Id)
) ENGINE=InnoDB   AUTO_INCREMENT=1;

-- Step: 13
-- Goal: Fill table ProductPerAllergeen with data
-- **********************************************************************************
-- Version    Date:        Author:         Description:
-- ******* ********** **************** ******************
--    01   10-12-2025      Omid Mhr       Requested new insert
-- **********************************************************************************

INSERT INTO ProductPerAllergeen
(
     ProductId
    ,AllergeenId
)
VALUES
  (1, 2)
 ,(1, 1)
 ,(1, 3)
 ,(3, 4)
 ,(6, 5)
 ,(9, 2)
 ,(9, 5)
 ,(10, 2)
 ,(12, 4)
 ,(13, 1)
 ,(13, 4)
 ,(13, 5);