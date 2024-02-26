CREATE TABLE
    admin ( 
        admin_id int NOT NULL AUTO_INCREMENT,
        admin_name varchar(100) NOT NULL,
        PRIMARY KEY(admin_id)
    );

CREATE TABLE
    violation (
        violation_id int NOT NULL AUTO_INCREMENT,
        findings varchar(100) NOT NULL,
        major_violation varchar(100) NOT NULL,
        other varchar(100) NOT NULL,
        PRIMARY KEY(violation_id)
    );
    
CREATE TABLE
    owner ( 
        owner_id int NOT NULL AUTO_INCREMENT,
        owner_name varchar(100) NOT NULL,
        contact_no varchar(11) NOT NULL,
        PRIMARY KEY(owner_id)
    );

CREATE TABLE
    business (
        bus_id int NOT NULL AUTO_INCREMENT,
        owner_id int NOT NULL,
        bus_name varchar(100) NOT NULL,
        bus_address varchar(100) NOT NULL,
        contact_no int NOT NULL,
        floor_area double DEFAULT NULL,
        singage_area double DEFAULT NULL,
        PRIMARY KEY(bus_id),
        FOREIGN KEY(owner_id) REFERENCES owner(owner_id),
        FOREIGN KEY(location_id) REFERENCES location(location_id)
    ); 
 
CREATE TABLE
    category_list (
        category_id int NOT NULL AUTO_INCREMENT,
        category_name varchar(100) NOT NULL,
        PRIMARY KEY(category_id)
    );
    
CREATE TABLE
    item_list (
        item_id int NOT NULL AUTO_INCREMENT,
        category_id int NOT NULL,        
        equipment_name varchar(100) NOT NULL,
        PRIMARY KEY(equipment_id),
        FOREIGN KEY(category_id) REFERENCES category_list(category_id)
    );
    
CREATE TABLE
    inspection ( 
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
    
CREATE TABLE
    inspector ( 
        inspector_id int NOT NULL AUTO_INCREMENT,
        inspector_name varchar(100) NOT NULL,
        PRIMARY KEY(inspector_id)
    );

CREATE TABLE inspection_inspector (
	inspector_id int NOT NULL,
    inspection_id int NOT NULL,
    FOREIGN KEY (inspector_id) REFERENCES inspector (inspector_id),
    FOREIGN KEY (inspection_id) REFERENCES inspection (inspection_id)
);
    
CREATE TABLE
    fee (
        fee_id int NOT NULL AUTO_INCREMENT,
        building_fee decimal(10, 2) NOT NULL,
        plumbing_fee decimal(10, 2) NOT NULL,
        signage_fee decimal(10, 2) NOT NULL,
        PRIMARY KEY(fee_id)
    );

CREATE TABLE
    annual_fees ( 
        annualfee_id int NOT NULL AUTO_INCREMENT,
        fee_id int NOT NULL,
        total_fee int NOT NULL,
        PRIMARY KEY(annualfee_id),
        FOREIGN KEY(fee_id) REFERENCES fees(fee_id)
    );
    
    
CREATE TABLE
    equipment_list_report (
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
    

CREATE TABLE
    certificate (
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

    
CREATE TABLE
    annual_ins ( 
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
    
CREATE TABLE
    annual_bus_ins ( 
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