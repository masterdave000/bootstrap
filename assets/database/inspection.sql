 CREATE TABLE violation (
        violation_id int NOT NULL AUTO_INCREMENT,
        findings varchar(100) NOT NULL,
        major_violation varchar(100) NOT NULL,
        other varchar(100) NOT NULL,
        PRIMARY KEY(violation_id)
    );
    
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
        PRIMARY KEY(item_id),
        FOREIGN KEY(category_id) REFERENCES category_list(category_id)
);
    
CREATE TABLE inspection ( 
        inspection_id int NOT NULL AUTO_INCREMENT,
        bus_id int NOT NULL,
        application_type varchar(50) NOT NULL DEFAULT 'Annual',
        rating varchar(100) DEFAULT NULL,
        quantity int NOT NULL,
        fee decimal(10, 2) NOT NULL,
        violation text NOT NULL,
        date_inspected datetime NOT NULL default current_timestamp(),
        date_signed datetime NOT NULL,
        time_received time NOT NULL,
        PRIMARY KEY(inspection_id),
        FOREIGN KEY(bus_id) REFERENCES business(bus_id)
);
    
CREATE TABLE item_inspection (
	item_id int NOT NULL,
    inspection_id int NOT NULL,
    FOREIGN KEY (item_id) REFERENCES item_list(item_id),
    FOREIGN KEY (inspection_id) REFERENCES inspection(inspection_id)
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

CREATE TABLE inspection_inspector (
	inspector_id int NOT NULL,
    inspection_id int NOT NULL,
    FOREIGN KEY (inspector_id) REFERENCES inspector (inspector_id),
    FOREIGN KEY (inspection_id) REFERENCES inspection (inspection_id)
);
    
CREATE TABLE fee (
        fee_id int NOT NULL AUTO_INCREMENT,
        building_fee decimal(10, 2) NOT NULL,
        plumbing_fee decimal(10, 2) NOT NULL,
        signage_fee decimal(10, 2) NOT NULL,
        PRIMARY KEY(fee_id)
);

CREATE TABLE annual_fees ( 
        annualfee_id int NOT NULL AUTO_INCREMENT,
        fee_id int NOT NULL,
        total_fee int NOT NULL,
        PRIMARY KEY(annualfee_id),
        FOREIGN KEY(fee_id) REFERENCES fees(fee_id)
);
    
CREATE TABLE equipment_list_report (
        report_id int NOT NULL AUTO_INCREMENT,
        bus_id int NOT NULL,
        equipment_id int NOT NULL,
        fee_id int NOT NULL,
        violation_id int NOT NULL,
        annualfee_id int NOT NULL,
        inspector_id int NOT NULL,        
        floor_area varchar(100) NOT NULL,
        signage_area varchar(100) NOT NULL,
        inspect_date datetime  NOT NULL default current_timestamp(),
        PRIMARY KEY(report_id),
        FOREIGN KEY(bus_id) REFERENCES business(bus_id),
        FOREIGN KEY(equipment_id) REFERENCES equipment_list(equipment_id),
        FOREIGN KEY(fee_id) REFERENCES fees(fee_id),
        FOREIGN KEY(violation_id) REFERENCES violation(violation_id),
        FOREIGN KEY(annualfee_id) REFERENCES annual_fees(annualfee_id),
        FOREIGN KEY(inspector_id) REFERENCES inspector(inspector_id)
    );
    
CREATE TABLE certificate (
        certificate_id int NOT NULL AUTO_INCREMENT,
        bus_id int NOT NULL,
        annualfee_id int NOT NULL,
        inspector_id int NOT NULL,
        certificate_no int NOT NULL,        
        date_issued datetime  NOT NULL default current_timestamp(),
        PRIMARY KEY(certificate_id),
        FOREIGN KEY(bus_id) REFERENCES business(bus_id),
        FOREIGN KEY(annualfee_id) REFERENCES annual_fees(annualfee_id),
        FOREIGN KEY(inspector_id) REFERENCES inspector(inspector_id)
    );

    
CREATE TABLE annual_ins ( 
        annual_id int NOT NULL AUTO_INCREMENT,
        inspector_id int NOT NULL,
        violation_id int NOT NULL,
        bus_id int NOT NULL,
        description varchar(100) NOT NULL,
        rating int NOT NULL,
        remarks varchar(100) NOT NULL,
        date_inspect datetime  NOT NULL default current_timestamp(),
        PRIMARY KEY(annual_id),
        FOREIGN KEY(inspector_id) REFERENCES inspector(inspector_id),
        FOREIGN KEY(violation_id) REFERENCES violation(violation_id),
        FOREIGN KEY(bus_id) REFERENCES business(bus_id)
);
    
CREATE TABLE annual_bus_ins ( 
        annualbl_id int NOT NULL AUTO_INCREMENT,
        inspection_id int NOT NULL,
        violation_id int NOT NULL,
        annualfee_id int NOT NULL,
        floor_area varchar(100) NOT NULL,
        signage_area varchar(100) NOT NULL,
        PRIMARY KEY(annualbl_id),
        FOREIGN KEY(inspection_id) REFERENCES inspection(inspection_id),
        FOREIGN KEY(violation_id) REFERENCES violation(violation_id),
        FOREIGN KEY(annualfee_id) REFERENCES annual_fees(annualfee_id)
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
SELECT bus_id, owner.owner_id, bus_name, bus_address, bus_type, bus.bus_contact_number, bus.email, floor_area, signage_area, bus_img_url, 
owner.owner_firstname, owner.owner_midname, owner.owner_lastname, owner.owner_suffix 
FROM business bus
LEFT JOIN owner ON bus.owner_id = owner.owner_id;

CREATE VIEW item_view AS 
SELECT i.item_id, i.item_name, i.img_url, c.category_name 
FROM item_list i
LEFT JOIN category_list c ON i.category_id = c.category_id;

