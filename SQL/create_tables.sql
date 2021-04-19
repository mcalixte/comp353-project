create table Alert_Level(
    alert_level INT PRIMARY KEY,
    stage VARCHAR(100),
    measures Text
);

create table Region(
    region_name VARCHAR(50) PRIMARY KEY
);

create table Alert_History(
    region_name VARCHAR(50),
    alert_level INT,
    date_issued Date,
    is_active Boolean,
    FOREIGN KEY (region_name) REFERENCES Region(region_name) ON DELETE CASCADE,
    FOREIGN KEY (alert_level) REFERENCES Alert_Level(alert_level) ON DELETE CASCADE,
    PRIMARY KEY (region_name, alert_level, date_issued)
);

create table City(
    city_name VARCHAR(50),
    province VARCHAR(2),
    region_name VARCHAR(50),
    FOREIGN KEY (region_name) REFERENCES Region(region_name) ON DELETE CASCADE,
    PRIMARY KEY (city_name)
);

create table Postal_Code(
    postal_code VARCHAR(7),
    city_name VARCHAR(50),
    FOREIGN KEY (city_name) REFERENCES City(city_name) ON DELETE CASCADE,
    PRIMARY KEY (postal_code)
);

create table Person (
    medicare_num VARCHAR(50) PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    phone_num VARCHAR(20),
    postal_code VARCHAR(7),
    dob DATE,
    citizenship VARCHAR(50),
    email VARCHAR(50),
    FOREIGN KEY (postal_code) REFERENCES Postal_Code(postal_code) ON DELETE CASCADE
);

create table Message(
    msg_id INT PRIMARY KEY AUTO_INCREMENT,
    date_time DateTime,
    description Text,
    old_alert INT,
    new_alert INT,
    person VARCHAR(50),
    region_name VARCHAR(50),
    FOREIGN KEY (person) REFERENCES Person(medicare_num) ON DELETE CASCADE,
    FOREIGN KEY (region_name) REFERENCES Region(region_name) ON DELETE CASCADE,
    FOREIGN KEY (old_alert) REFERENCES Alert_Level(alert_level) ON DELETE CASCADE,
    FOREIGN KEY (new_alert) REFERENCES Alert_Level(alert_level) ON DELETE CASCADE
);
 
create table Parent (
    child VARCHAR(50),
    parent VARCHAR(50),
    relation ENUM('Father','Mother'),
    FOREIGN KEY (child) REFERENCES Person(medicare_num) ON DELETE CASCADE,
    FOREIGN KEY (parent) REFERENCES Person(medicare_num) ON DELETE CASCADE,
    PRIMARY KEY (child, parent)
);

create table PHF(
    phf_id INT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    address VARCHAR(100) NOT NULL,
    web_address VARCHAR(50) NOT NULL,
    phone_num VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    drive_thru Boolean,
    type ENUM('clinic','hospital','special installment') NOT NULL,
    acceptance_method ENUM('appointment','walk-in','both') NOT NULL
);

create table PHW(
    phw_id INT PRIMARY KEY,
    person VARCHAR(50),
    phf_id INT,
    FOREIGN KEY (person) REFERENCES Person(medicare_num) ON DELETE CASCADE,
    FOREIGN KEY (phf_id) REFERENCES PHF(phf_id) ON DELETE CASCADE
);

create table Service_History(
    service_date Date,
    phw_id INT,
    FOREIGN KEY (phw_id) REFERENCES PHW(phw_id) ON DELETE CASCADE,
    PRIMARY KEY (service_date, phw_id)
);


CREATE TABLE Test(
    test_id INT PRIMARY KEY,
    conducted_on VARCHAR(50),
    conducted_by INT,
    conducted_at INT,
    results ENUM('POS','NEG'),
    test_date DATE,
    result_date DATE,
    FOREIGN KEY (conducted_on) REFERENCES Person(medicare_num) ON DELETE CASCADE,
    FOREIGN KEY (conducted_by) REFERENCES PHW(phw_id) ON DELETE CASCADE,
    FOREIGN KEY (conducted_at) REFERENCES PHF(phf_id) ON DELETE CASCADE
);

create table groupZone(
    gz_name VARCHAR(50) PRIMARY KEY
);

create table groupZoneMember(
    group_name VARCHAR(50),
    member VARCHAR(50),
    FOREIGN KEY (member) REFERENCES Person(medicare_num) ON DELETE CASCADE,
    FOREIGN KEY (group_name) REFERENCES groupZone(gz_name) ON DELETE CASCADE,
    PRIMARY KEY (group_name,member)
);

create table Recommendation(
    id INT PRIMARY KEY NOT NULL,
    description Text
);

create table Symptom_history(
    date_time DateTime,
    person VARCHAR(50),
    fever boolean,
    cough boolean,
    breath_difficulty boolean,
    taste_loss boolean,
    nausea boolean,
    stomach_aches boolean,
    vomitting boolean,
    headache boolean,
    muscle_pain boolean,
    diarrhea boolean,
    sore_throat boolean,
    other TEXT,
    FOREIGN KEY (person) REFERENCES Person(medicare_num) ON DELETE CASCADE,
    PRIMARY KEY (date_time,person)
);