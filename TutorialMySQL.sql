

create DATABASE tutorial;

USE tutorial;


-- Creating the SaleData table
-- ** prefix "wp_" is very important at your LIVE Hosting
-- DROP TABLE IF EXISTS wp_Custom_SaleData; 
CREATE TABLE IF NOT EXISTS wp_Custom_SaleData (
	Id INT NOT NULL AUTO_INCREMENT, 
	Month VARCHAR(30), 
    SaleAmount DECIMAL(16, 2),
    PRIMARY KEY (ID) 
); 


-- Inserting Data into table
INSERT INTO wp_Custom_SaleData
(Month, SaleAmount) 
VALUES 
('Jan', 3000), 
('Feb', 3134),  
('Mar', 4199), 
('Apl', 1999), 
('May', 700), 
('Jun', 300), 
('Jul', 450), 
('Aug', 1024), 
('Sep', 2456),
('Oct', 4579), 
('Nov', 5104), 
('Dec', 5456)
; 

SELECT * FROM wp_Custom_SaleData; 

