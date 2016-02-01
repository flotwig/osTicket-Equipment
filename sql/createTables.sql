CREATE TABLE IF NOT EXISTS {prefix}devices (
  id INT AUTO_INCREMENT PRIMARY KEY,
  deviceTypeId INT,
  serial TEXT,
  hostname TEXT,
  location TEXT,
  added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE IF NOT EXISTS {prefix}checkouts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  personName TEXT,
  campusId INT,
  personEmail TEXT,
  personPhone TEXT,
  sponsorName TEXT,
  checkedOut TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  checkedIn TIMESTAMP,
  technicianId INT
);
CREATE TABLE IF NOT EXISTS {prefix}ticketMappings (
  deviceId INT,
  ticketId INT,
  checkoutId INT
);
CREATE TABLE IF NOT EXISTS {prefix}deviceTypes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name TEXT,
  deviceCategoryId INT
);
CREATE TABLE IF NOT EXISTS {prefix}deviceCategories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  category TEXT
);