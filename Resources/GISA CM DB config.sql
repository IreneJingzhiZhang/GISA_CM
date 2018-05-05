CREATE TABLE Addresses (
   AddressID MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
   StreetAddressLine1 VARCHAR(48),
   StreetAddressLine2 VARCHAR(48),
   City VARCHAR(24),
   State VARCHAR(24),
   ZipCode CHAR(5),
   PRIMARY KEY (AddressID)
   );   

CREATE TABLE Contacts (
   ContactID MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
   FirstName VARCHAR(24) NOT NULL,
   LastName VARCHAR(24) NOT NULL,
   Email VARCHAR(255) NOT NULL,
   OfficePhone CHAR(10),
   CellPhone CHAR(10),
   Address MEDIUMINT UNSIGNED NOT NULL,
   FOREIGN KEY (Address) REFERENCES Addresses(AddressID),
   PRIMARY KEY (ContactID)
   );
  
CREATE TABLE Users (
   UserID MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
   Username VARCHAR(16) NOT NULL,
   PasswordHash CHAR(128) NOT NULL,
   SaltHash CHAR(64) NOT NULL,
   PasswordSetDate DATE,
   SessionToken CHAR(128),
   TokenTimeOut DATETIME,
   FailedLogins TINYINT UNSIGNED,

   Contact MEDIUMINT UNSIGNED NOT NULL,

   Title TINYINT UNSIGNED NOT NULL,
   FOREIGN KEY (Contact) REFERENCES Contacts(ContactID),
   FOREIGN KEY (Title) REFERENCES Titles(TitleID),
   PRIMARY KEY (UserID),
   UNIQUE KEY Username_UNIQUE (Username)
   );

CREATE TABLE Titles (
   TitleID TINYINT UNSIGNED NOT NULL,
   TitleName VARCHAR(32),
   PRIMARY KEY (TitleID)
   );

CREATE TABLE Events (
   EventID MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,

   EventName VARCHAR(32) NOT NULL,

   EventManager MEDIUMINT UNSIGNED NOT NULL,

   StartDateTime DATETIME,

   EndDateTime DATETIME,

   Venue MEDIUMINT UNSIGNED,

   Notes TEXT(1024),

   Status VARCHAR(8),

   FOREIGN KEY (EventManager) REFERENCES Users(UserID),

   PRIMARY KEY (EventID)
   );
 
CREATE TABLE Bands (
   BandID MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,

   BandName VARCHAR(32) NOT NULL,

   LeaderContact MEDIUMINT UNSIGNED,

   AgentContact MEDIUMINT UNSIGNED,

   Rate DECIMAL(10,4) UNSIGNED NOT NULL,

   FOREIGN KEY (LeaderContact) REFERENCES Contacts(ContactID),

   FOREIGN KEY (AgentContact) REFERENCES Contacts(ContactID),

   PRIMARY KEY (BandID)
   );

CREATE TABLE Vendors (
   VendorID MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
   VendorType VARCHAR(16) NOT NULL,
   VendorName VARCHAR(32) NOT NULL,
   Address MEDIUMINT UNSIGNED NOT NULL,
   Contact MEDIUMINT UNSIGNED NOT NULL,
   FOREIGN KEY (Address) REFERENCES Addresses(AddressID),
   FOREIGN KEY (Contact) REFERENCES Contacts(ContactID),
   PRIMARY KEY (VendorID)
   );

CREATE TABLE EventVendors (

   Event MEDIUMINT UNSIGNED NOT NULL,

   Vendor MEDIUMINT UNSIGNED NOT NULL,

   FOREIGN KEY (Event) REFERENCES Events(EventID),

   FOREIGN KEY (Vendor) REFERENCES Vendors(VendorID),

   PRIMARY KEY (Event,Vendor)

   );


CREATE TABLE BandMembers (

   MemberID MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,

   Band MEDIUMINT UNSIGNED NOT NULL,

   FirstName VARCHAR(24) NOT NULL,

   LastName VARCHAR(24) NOT NULL,

   FOREIGN KEY (Band) REFERENCES Bands(BandID),

   PRIMARY KEY (MemberID)

   );



CREATE TABLE EventBands (

   Event MEDIUMINT UNSIGNED NOT NULL,

   Band MEDIUMINT UNSIGNED NOT NULL,

   FOREIGN KEY (Event) REFERENCES Events(EventID),

   FOREIGN KEY (Band) REFERENCES Bands(BandID),

   PRIMARY KEY (Event,Band)

   );



CREATE TABLE BandLogos (

   Band MEDIUMINT UNSIGNED NOT NULL,

   Position SMALLINT UNSIGNED NOT NULL,

   DataPiece BLOB(8000),

   FOREIGN KEY (Band) REFERENCES Bands(BandID),

   PRIMARY KEY (Band,Position)

   );
   
CREATE TABLE PreviousPasswords (
   PreviousPasswordID MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
   User MEDIUMINT UNSIGNED NOT NULL,
   PasswordHash BLOB(512) NOT NULL,
   FOREIGN KEY (User) REFERENCES Users(UserID),
   PRIMARY KEY (PreviousPasswordID)
   );
   
CREATE TABLE LoginAttempts (
   IP VARCHAR(45),
   Attempts TINYINT UNSIGNED,
   Remaining DATETIME,
   PRIMARY KEY (IP)
   );