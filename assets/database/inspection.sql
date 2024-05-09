CREATE TABLE owner ( 
	owner_id int NOT NULL AUTO_INCREMENT,
	owner_firstname varchar(100) NOT NULL,
	owner_midname varchar(100) DEFAULT NULL,
	owner_lastname varchar(100) NOT NULL,
	owner_suffix varchar(10) DEFAULT NULL,
	contact_number varchar(11) NOT NULL,
	email varchar(100) DEFAULT NULL,
	owner_img_url varchar(45) NOT NULL DEFAULT 'default.png',
	PRIMARY KEY(owner_id)
);

CREATE TABLE business (
	bus_id int NOT NULL AUTO_INCREMENT,
	owner_id int NOT NULL,
	bus_name varchar(100) NOT NULL,
	bus_address varchar(100) NOT NULL,
	bus_type varchar(50) DEFAULT NULL,
	bus_contact_number varchar(11) NOT NULL,
    bus_group varchar(100) NOT NULL,
    character_of_occupancy varchar(100) NOT NULL, 
	email varchar(50) DEFAULT NULL,
	floor_area double DEFAULT NULL,
	signage_area double DEFAULT NULL,
	bus_img_url varchar(50) DEFAULT 'no-image.png',
	PRIMARY KEY(bus_id),
	FOREIGN KEY(owner_id) REFERENCES owner(owner_id)
); 

CREATE TABLE category_list (
	category_id int NOT NULL AUTO_INCREMENT,
	category_name varchar(100) NOT NULL,
	category_img_url varchar(50) NOT NULL DEFAULT 'default-img.png',
	PRIMARY KEY(category_id)
);
    
CREATE TABLE item_list (
	item_id int NOT NULL AUTO_INCREMENT,
	category_id int NOT NULL,        
	item_name varchar(100) NOT NULL,
    section varchar(100) NOT NULL,
    img_url varchar(100) NOT NULL,
	PRIMARY KEY(item_id),
	FOREIGN KEY(category_id) REFERENCES category_list(category_id)
);
    
CREATE TABLE inspector ( 
	inspector_id int NOT NULL AUTO_INCREMENT,
	inspector_firstname varchar(100) NOT NULL,
	inspector_midname varchar(100) DEFAULT NULL,
	inspector_lastname varchar(100) NOT NULL,
	inspector_suffix varchar(100) DEFAULT NULL,
	contact_number varchar(11) NOT NULL,
	email varchar(50) DEFAULT NULL,
	inspector_img_url varchar(100) DEFAULT 'default.png',
	PRIMARY KEY(inspector_id)
);

CREATE TABLE building_billing (
	bldg_billing_id int NOT NULL AUTO_INCREMENT,
    bldg_section varchar(100) NOT NULL,
    bldg_property_attribute varchar(100) NOT NULL,
	bldg_fee decimal(10, 2) NOT NULL,
	PRIMARY KEY(bldg_billing_id)
);

CREATE TABLE signage_billing (
	signage_id int NOT NULL AUTO_INCREMENT,
	display_type varchar(100) NOT NULL,
    sign_type varchar(100) NOT NULL,
    signage_fee decimal(10, 2) NOT NULL,
    PRIMARY KEY(signage_id)
);

CREATE TABLE sanitary_billing (
	sanitary_id int NOT NULL AUTO_INCREMENT,
    sanitary_section varchar(100) NOT NULL,
    sanitary_fee decimal(11, 2) NOT NULL,
    PRIMARY KEY(sanitary_id)
);

INSERT INTO sanitary_billing (sanitary_id, sanitary_section, sanitary_fee) VALUES (1, 'Plumbing', 60.00);

CREATE TABLE inspection ( 
	inspection_id int NOT NULL AUTO_INCREMENT,
	owner_id int NOT NULL,
	bus_id int NOT NULL,
    signage_id int NOT NULL,
    bldg_billing_id int NOT NULL,
	application_type varchar(50) NOT NULL DEFAULT 'Annual',
    remarks varchar(50) NOT NULL,
	date_inspected datetime NOT NULL default current_timestamp(),
	date_signed datetime NOT NULL,
	PRIMARY KEY(inspection_id),
	FOREIGN KEY(owner_id) REFERENCES owner(owner_id),
	FOREIGN KEY(bus_id) REFERENCES business(bus_id),
    FOREIGN KEY(signage_id) REFERENCES signage_billing(signage_id),
    FOREIGN KEY(bldg_billing_id) REFERENCES building_billing(bldg_billing_id)
);

CREATE TABLE inspection_sanitary_billing (
    inspection_id int NOT NULL,
    sanitary_id int NOT NULL,
    sanitary_quantity int NOT NULL,
    FOREIGN KEY (inspection_id) REFERENCES inspection (inspection_id),
    FOREIGN KEY (sanitary_id) REFERENCES sanitary_billing (sanitary_id)
);


CREATE TABLE inspection_inspector (
	inspector_id int NOT NULL,
    inspection_id int NOT NULL,
    FOREIGN KEY (inspector_id) REFERENCES inspector (inspector_id),
    FOREIGN KEY (inspection_id) REFERENCES inspection (inspection_id)
);

CREATE TABLE violation (
        violation_id int NOT NULL AUTO_INCREMENT,
        description varchar(100) NOT NULL,
        PRIMARY KEY(violation_id)
);

CREATE TABLE inspection_violation (
	inspection_id int NOT NULL,
    violation_id int NOT NULL,
    FOREIGN KEY(inspection_id) REFERENCES inspection(inspection_id),
	FOREIGN KEY(violation_id) REFERENCES violation(violation_id)
);

CREATE TABLE equipment_billing (
	billing_id int NOT NULL AUTO_INCREMENT,
    category_id int NOT NULL,
	section varchar(100) NOT NULL,
    capacity varchar(100) NULL DEFAULT NULL,
	fee decimal(11, 2) NOT NULL,
    PRIMARY KEY(billing_id),
    FOREIGN KEY(category_id) REFERENCES category_list(category_id)
);

CREATE TABLE inspection_item (
	inspection_id int NOT NULL,
    item_id int NOT NULL,
    billing_id int NULL,
	power_rating varchar(100) DEFAULT NULL,
    quantity int NOT NULL,
	fee decimal(11, 2) NOT NULL,
    FOREIGN KEY(inspection_id) REFERENCES inspection(inspection_id),
	FOREIGN KEY(item_id) REFERENCES item_list(item_id),
    FOREIGN KEY(billing_id) REFERENCES equipment_billing(billing_id)
);

CREATE TABLE annual_inspection_certificate (
	certificate_id int NOT NULL AUTO_INCREMENT,
	bus_id int NOT NULL,
	owner_id int NOT NULL,
    application_type varchar(50) NOT NULL,
    bin varchar(100) NULL DEFAULT NULL,
	bus_group varchar(10) NOT NULL,    
    character_of_occupancy varchar(100) NOT NULL,
    occupancy_no varchar(50) NOT NULL,
    date_complied date NOT NULL,
	issued_on datetime NULL,
    date_inspected datetime NOT NULL default current_timestamp(),
	PRIMARY KEY(certificate_id),
	FOREIGN KEY(bus_id) REFERENCES business(bus_id),
	FOREIGN KEY(owner_id) REFERENCES owner(owner_id)
);

CREATE TABLE annual_inspection_certificate_inspector (
	certificate_id int NOT NULL,
    inspector_id int NOT NULL,
    category varchar(100) NOT NULL,
    date_signed date NOT NULL,
    time_in time NULL,
    time_out time NULL,
    FOREIGN KEY(certificate_id) REFERENCES annual_inspection_certificate(certificate_id),
	FOREIGN KEY(inspector_id) REFERENCES inspector(inspector_id)
); 

CREATE TABLE users ( 
	user_id int NOT NULL AUTO_INCREMENT,
	inspector_id int DEFAULT NULL,
	username varchar(100) NOT NULL,
	password varchar(255) NOT NULL,
	role varchar(20) NOT NULL,
	PRIMARY KEY(user_id),
	FOREIGN KEY (inspector_id) REFERENCES inspector (inspector_id)
);

CREATE VIEW user_view AS
SELECT u.user_id, i.inspector_id, i.inspector_firstname, i.inspector_midname, i.inspector_lastname, i.inspector_suffix, u.username, u.role, u.password, i.inspector_img_url
FROM users u LEFT JOIN inspector i 
ON u.inspector_id = i.inspector_id;
    
CREATE VIEW business_view AS
SELECT bus_id, owner.owner_id, bus_name, bus_address, bus_type, bus.bus_contact_number, bus.bus_group, bus.character_of_occupancy, bus.email, floor_area, signage_area, bus_img_url, 
owner.owner_firstname, owner.owner_midname, owner.owner_lastname, owner.owner_suffix 
FROM business bus
LEFT JOIN owner ON bus.owner_id = owner.owner_id;

CREATE VIEW item_view AS 
SELECT i.item_id, i.item_name, c.category_name, i.section, i.img_url
FROM item_list i
LEFT JOIN category_list c ON i.category_id = c.category_id;

CREATE VIEW inspection_view AS
SELECT i.inspection_id, b.bus_id, iins.inspector_id, o.owner_firstname, o.owner_midname, o.owner_lastname, o.owner_suffix, b.bus_name, 
b.bus_type, b.bus_address, b.bus_contact_number, b.floor_area, b.signage_area, 
bb.bldg_section, bb.bldg_property_attribute, bb.bldg_fee,
sb.display_type, sb.sign_type, sb.signage_fee,
sanb.sanitary_section, isb.sanitary_quantity, sanb.sanitary_fee,
i.application_type, ii.power_rating, il.item_name, cl.category_name, eb.section, eb.capacity, ii.quantity, ii.fee, 
ins.inspector_firstname, ins.inspector_midname, ins.inspector_lastname, ins.inspector_suffix, v.description, i.remarks, b.bus_img_url, i.date_inspected
FROM inspection i 
LEFT JOIN business b ON i.bus_id = b.bus_id
LEFT JOIN owner o ON i.owner_id = o.owner_id
LEFT JOIN inspection_item ii ON i.inspection_id = ii.inspection_id
LEFT JOIN item_list il ON ii.item_id = il.item_id
LEFT JOIN category_list cl ON il.category_id = cl.category_id
LEFT JOIN building_billing bb ON i.bldg_billing_id = bb.bldg_billing_id
LEFT JOIN signage_billing sb ON i.signage_id = sb.signage_id
LEFT JOIN inspection_sanitary_billing isb ON i.inspection_id = isb.inspection_id
LEFT JOIN sanitary_billing sanb ON isb.sanitary_id = sanb.sanitary_id
LEFT JOIN equipment_billing eb ON ii.billing_id = eb.billing_id
LEFT JOIN inspection_inspector iins ON i.inspection_id = iins.inspection_id
LEFT JOIN inspector ins ON iins.inspector_id = ins.inspector_id
LEFT JOIN inspection_violation iv ON i.inspection_id = iv.inspection_id
LEFT JOIN violation v ON iv.violation_id = v.violation_id;

CREATE VIEW annual_inspection_certificate_view AS
SELECT aic.certificate_id, aic.application_type, aic.bin, b.bus_name, b.bus_address, b.bus_img_url, aic.bus_group, aic.character_of_occupancy, aic.occupancy_no, aic.issued_on,
o.owner_firstname, o.owner_midname, o.owner_lastname, o.owner_suffix,
i.inspector_firstname, i.inspector_midname, i.inspector_lastname, i.inspector_suffix, aici.category, aici.date_signed, aici.time_in, aici.time_out, aic.date_complied, aic.date_inspected
FROM annual_inspection_certificate aic 
LEFT JOIN business b ON aic.bus_id = b.bus_id
LEFT JOIN owner o ON aic.owner_id = o.owner_id
LEFT JOIN annual_inspection_certificate_inspector aici ON aic.certificate_id = aici.certificate_id
LEFT JOIN inspector i ON aici.inspector_id = i.inspector_id;

CREATE VIEW equipment_billing_view AS 
SELECT b.billing_id, c.category_id, c.category_name, b.section, b.capacity, b.fee
FROM equipment_billing b
LEFT JOIN category_list c ON b.category_id = c.category_id;