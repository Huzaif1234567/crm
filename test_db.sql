-- Create the managerTeam table
CREATE TABLE managerTeam (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL,
    manager VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX idx_manager ON managerTeam (manager);

    -- Create the leadformenduser table
CREATE TABLE leadformenduser (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Date DATE NOT NULL,
    cname VARCHAR(255) NOT NULL,
    cnumber VARCHAR(20) NOT NULL,
    acnumber VARCHAR(20) NOT NULL,
    type VARCHAR(20) NOT NULL,
    platform VARCHAR(20) NOT NULL,
    campaign VARCHAR(50) NOT NULL,
    interest VARCHAR(255) NOT NULL,
    teammember VARCHAR(255) NOT NULL,
    response TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Create the leadformteamlead table
CREATE TABLE leadformteamlead (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Date DATE NOT NULL,
    cname VARCHAR(255) NOT NULL,
    cnumber VARCHAR(20) NOT NULL,
    acnumber VARCHAR(20) NOT NULL,
    type VARCHAR(20) NOT NULL,
    platform VARCHAR(20) NOT NULL,
    campaign VARCHAR(50) NOT NULL,
    interest VARCHAR(255) NOT NULL,
    teamlead VARCHAR(255) NOT NULL,
    response TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the leadformdistributor table
CREATE TABLE leadformdistributor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Date DATE NOT NULL,
    cname VARCHAR(255) NOT NULL,
    cnumber VARCHAR(20) NOT NULL,
    acnumber VARCHAR(20) NOT NULL,
    type VARCHAR(20) NOT NULL,
    platform VARCHAR(20) NOT NULL,
    campaign VARCHAR(50) NOT NULL,
    interest VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the leadformmanager table
CREATE TABLE leadformmanager (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Date DATE NOT NULL,
    cname VARCHAR(255) NOT NULL,
    cnumber VARCHAR(20) NOT NULL,
    acnumber VARCHAR(20) NOT NULL,
    type VARCHAR(20) NOT NULL,
    platform VARCHAR(20) NOT NULL,
    campaign VARCHAR(50) NOT NULL,
    interest VARCHAR(255) NOT NULL,
    manager VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE users_all (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    type VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users_all (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    type VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    
);
-- Create the users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Table creation query
CREATE TABLE IF NOT EXISTS usersdistributer (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
    -- Add other columns as needed
);

-- Update password query
-- UPDATE usersdistributer
-- SET password = 'your_new_password'
-- WHERE id = 'your_user_id';
-- Table creation query
CREATE TABLE IF NOT EXISTS loginenduser (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
    -- Add other columns as needed
);

-- Update password query
-- UPDATE loginenduser
-- SET password = 'your_new_password'
-- WHERE id = 'your_user_id';
-- Table creation query
CREATE TABLE IF NOT EXISTS teamlead (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
    -- Add other columns as needed
);

-- Update password query
-- UPDATE teamlead
-- SET password = 'your_new_password'
-- WHERE id = 'your_user_id'


CREATE TABLE IF NOT EXISTS users_all (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    type VARCHAR(255) NOT NULL
    -- Add other columns as needed
);

-- INSERT INTO users_all (user_name, password, name, type)
-- VALUES ('your_user_name', 'your_password', 'your_name', 'your_type');

CREATE TABLE IF NOT EXISTS weeklyroster (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    Monday VARCHAR(255) NOT NULL,
    Tuesday VARCHAR(255) NOT NULL,
    Wednesday VARCHAR(255) NOT NULL,
    Thursday VARCHAR(255) NOT NULL,
    Friday VARCHAR(255) NOT NULL,
    Saturday VARCHAR(255) NOT NULL,
    Sunday VARCHAR(255) NOT NULL,
    manager VARCHAR(255) NOT NULL
    -- Add other columns as needed
);

-- INSERT INTO weeklyroster (name, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday, Sunday, manager)
-- VALUES ('your_name', 'your_monday', 'your_tuesday', 'your_wednesday', 'your_thursday', 'your_friday', 'your_saturday', 'your_sunday', 'your_manager');

CREATE TABLE IF NOT EXISTS leadform (
    id INT PRIMARY KEY AUTO_INCREMENT,
    Date DATE NOT NULL,
    cname VARCHAR(255) NOT NULL,
    cnumber VARCHAR(255) NOT NULL,
    acnumber VARCHAR(255) NOT NULL,
    type VARCHAR(255) NOT NULL,
    platform VARCHAR(255) NOT NULL,
    campaign VARCHAR(255) NOT NULL,
    interest VARCHAR(255) NOT NULL
    -- Add other columns as needed
);

CREATE TABLE IF NOT EXISTS leadform (
    id INT PRIMARY KEY AUTO_INCREMENT,
    Date DATE NOT NULL,
    cname VARCHAR(255) NOT NULL,
    cnumber VARCHAR(255) NOT NULL,
    acnumber VARCHAR(255) NOT NULL,
    type VARCHAR(255) NOT NULL,
    platform VARCHAR(255) NOT NULL,
    campaign VARCHAR(255) NOT NULL,
    interest VARCHAR(255) NOT NULL
    -- Add other columns as needed
);

CREATE TABLE IF NOT EXISTS leadform (
    id INT PRIMARY KEY AUTO_INCREMENT,
    Date DATE NOT NULL,
    cname VARCHAR(255) NOT NULL,
    cnumber VARCHAR(255) NOT NULL,
    acnumber VARCHAR(255) NOT NULL,
    type VARCHAR(255) NOT NULL,
    platform VARCHAR(255) NOT NULL,
    campaign VARCHAR(255) NOT NULL,
    interest VARCHAR(255) NOT NULL
    -- Add other columns as needed
);
-- INSERT INTO leadform (Date, cname, cnumber, acnumber, type, platform, campaign, interest)
-- VALUES ('2023-12-22', 'John Doe', '123456789', '987654321', 'Personal', 'Facebook', 'Sofia Sapphire', 'Some interest');
-- DELETE FROM leadform WHERE id = {the_value_of_$ids};
-- DELETE FROM weeklyroster WHERE id = {the_value_of_$ids};
-- DELETE FROM managerteam WHERE id = {the_value_of_$ids};
-- SELECT * FROM managerteam WHERE manager = ?;
-- SELECT * FROM leadform WHERE type = ? AND platform = ? AND campaign = ?

-- SELECT * FROM leadformdistributor
-- WHERE Date = CURRENT_DATE
-- AND type = ?
-- AND platform = ?
-- AND campaign = ?

-- SELECT * FROM leadformmanager
-- WHERE Date = ?
-- AND type = ?
-- AND platform = ?
-- AND campaign = ?

-- SELECT * FROM leadformmanager
-- WHERE type = :type
-- AND platform = :platform
-- AND campaign = :campaign

-- SELECT * FROM leadform
-- WHERE type = :type
-- AND platform = :platform
-- AND campaign = :campaign

-- SELECT *
-- FROM leadformenduser
-- WHERE teamlead = :user
--   AND Date = :date
--   AND type = :type
--   AND platform = :platform
--   AND campaign = :campaign

--   SELECT *
-- FROM leadformenduser
-- WHERE type = :type
--   AND platform = :platform
--   AND campaign = :campaign
  