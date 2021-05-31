CREATE TABLE User
(
  employeeID INT NOT NULL AUTO_INCREMENT,
  Name varchar(25) NOT NULL,
  Surname varchar(25) NOT NULL,
  PhoneNo INT NOT NULL,
  StreetNo INT NOT NULL,
  ApartamentNo INT NOT NULL,
  Role varchar(25) NOT NULL,
  PRIMARY KEY (employeeID)
);

CREATE TABLE RestaurantInvoice
(
  rInvoiceID INT NOT NULL AUTO_INCREMENT,
  time TIME NOT NULL,
  date DATE NOT NULL,
  employeeID INT NOT NULL,
  PRIMARY KEY (rInvoiceID),
  FOREIGN KEY (employeeID) REFERENCES User(employeeID)
);

CREATE TABLE ManageSupplies
(  
transactionID INT NOT NULL AUTO_INCREMENT,
  Date DATE NOT NULL,
  Quantity INT NOT NULL,

  employeeID INT NOT NULL,
  PRIMARY KEY (transactionID),
  FOREIGN KEY (employeeID) REFERENCES User(employeeID)
);

CREATE TABLE RoomType
(
  price DECIMAL NOT NULL,
  typeName varchar(25) NOT NULL,
  typeID INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (typeID)
);

CREATE TABLE Client
(
  TimeOfRegs TIME NOT NULL,
  DateOfRegs DATE NOT NULL,
  clientID INT NOT NULL,
  Name varchar(25) NOT NULL,
  Surname varchar(25) NOT NULL,
  employeeID INT NOT NULL,
  PRIMARY KEY (clientID),
  FOREIGN KEY (employeeID) REFERENCES User(employeeID)
);

CREATE TABLE Room
(
  RoomNo INT NOT NULL,
  Floor INT NOT NULL,
  Occupied BOOLEAN NOT NULL,
  typeID INT NOT NULL,
  PRIMARY KEY (RoomNo),
  FOREIGN KEY (typeID) REFERENCES RoomType(typeID)
);

CREATE TABLE ClientRoom
(
  RequestTime TIME NOT NULL,
  stayStartDate DATE NOT NULL,
  stayEndDate DATE NOT NULL,
  requestID INT NOT NULL,
  clientID INT NOT NULL AUTO_INCREMENT,
  RoomNo INT,
  employeeID INT NOT NULL,
  PRIMARY KEY (requestID),
  FOREIGN KEY (clientID) REFERENCES Client(clientID),
  FOREIGN KEY (RoomNo) REFERENCES Room(RoomNo),
  FOREIGN KEY (employeeID) REFERENCES User(employeeID)
);

CREATE TABLE Inventory
(
  productID INT NOT NULL AUTO_INCREMENT,
  productName varchar(25) NOT NULL,
  productQuantity INT NOT NULL,
  purchasePrice DECIMAL NOT NULL,
  
  sellingPrice DECIMAL NOT NULL,
  description varchar(100) NOT NULL,
  employeeID INT NOT NULL,
  transactionID INT,
  PRIMARY KEY (productID),
  FOREIGN KEY (employeeID) REFERENCES User(employeeID),
  FOREIGN KEY (transactionID) REFERENCES ManageSupplies(transactionID)
);

CREATE TABLE OrderProduct
(
  rInvoiceID INT NOT NULL AUTO_INCREMENT,
  productID INT,
  PRIMARY KEY (rInvoiceID, productID),
  FOREIGN KEY (rInvoiceID) REFERENCES RestaurantInvoice(rInvoiceID),
  FOREIGN KEY (productID) REFERENCES Inventory(productID)
);