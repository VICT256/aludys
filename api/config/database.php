<?php

// Namecheap Username = vaughanroofing
// Namecheap password = #Image101%
// Cpanel Username = vaughanroofing 
// Cpanel URL = https://cpanel-s97.web-hosting.com
// Cpanel password = #Image101%
// Webmail URL = https://webmail.reliancepropertiesrealtor.com
// email = info@reliancepropertiesrealtor.com
// email-password = #Image101%
// tidio-email = customerservice@reliancepropertiesrealtor.com
// tidio-password =  #Image101%


// define('DB_HOST', 'localhost');
// define('DB_USER', 'vaughanroofing_relianceuser1');
// define('DB_PASS', '#Image101%');
// define('DB_NAME', 'vaughanroofing_reliance');

// define('DB_HOST', 'localhost');
// define('DB_USER', 'vaughanroofing_relianceuser1');
// define('DB_PASS', '#Image101%');
// define('DB_NAME', 'vaughanroofing_reliancetest');


define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'luxury');



// $conn = new mysqli(DB_HOST,DB_USER, DB_PASS,DB_NAME);
$conn = mysqli_connect(DB_HOST,DB_USER, DB_PASS,DB_NAME);

if ($conn->connect_error){
   die("Connection Failed".$conn->connect_error);
}

// echo "Connected";

// firstname
// lastname
// email
// password
// verify_token
// verify_status 
// created_at

// CREATE TABLE Users (
//   id int(11) NOT NULL AUTO_INCREMENT,
//   fullname varchar(255) NOT NULL ,
//   email varchar(255) NOT NULL,
//   password varchar(255) NOT NULL,
//   email_verify_token varchar(255) NOT NULL,
//   has_verified_email  varchar(255) NOT NULL DEFAULT "no", 
//   password_reset_token varchar(256),
//   created_at date,
//   phonenumber varchar(256),
//   gender varchar(256),
//   first_time_login varchar(255) NOT NULL DEFAULT "yes",
//   dateofbirth varchar(256),
//   address varchar(256),
//   country varchar(256),
//   state_city varchar(256),
//   zipcode varchar(256) ,
//   PRIMARY KEY (id)
// );

// CREATE TABLE Investments (
//   id int(11) NOT NULL AUTO_INCREMENT,
//   userid int(11) NOT NULL,
//   product varchar(255) NOT NULL,
//   amount int(11) NOT NULL,
//   interest varchar(255) NOT NULL,
//   reason varchar(255) NOT NULL,
//   period_of_investment int(1) DEFAULT 0,
//   risk_level varchar(256) NOT NULL,
//   currentincome varchar(255) NOT NULL,
//   currentnetworth varchar(256) NOT NULL,
//   status varchar(256) NOT NULL DEFAULT "inactive",
//   distribution varchar(256) NOT NULL DEFAULT "1 Month",
//   date_created date,
//   PRIMARY KEY (id),
//   FOREIGN KEY (userid) REFERENCES Users(id)
// );

// CREATE TABLE Transactions (
//   id int(11) NOT NULL AUTO_INCREMENT,
//   userid int(11) NOT NULL,
//   type varchar(255) NOT NULL,
//   description varchar(255) NOT NULL,
//   amount int(11) NOT NULL,
//   reason varchar(255) NOT NULL,
//   payment_method varchar(255) NOT NULL,
//   status varchar(256) NOT NULL,
//   date_created date,
//   PRIMARY KEY (id),
//   FOREIGN KEY (userid) REFERENCES Users(id)
// );

// CREATE TABLE Accounts (
//     id int(11) NOT NULL AUTO_INCREMENT,
//     userid int(11) NOT NULL,
//     total_interest int(11)  NOT NULL,
//     total_deposit_loaded int(11)  NOT NULL,
//     total_distribution_reinvested int(11)  NOT NULL,
//     status varchar(256) NOT NULL DEFAULT "inactive",
//     PRIMARY KEY (id),
//     FOREIGN KEY (userid) REFERENCES Users(id)
// );

// CREATE TABLE Withdrawal_History (
//    id int(11) NOT NULL AUTO_INCREMENT,
//    userid int(11) NOT NULL,
//    status varchar(256) NOT NULL,
//    type varchar(255) NOT NULL DEFAULT "withdrawal",
//    currency varchar(255) NOT NULL,
//    wallet varchar(255) NOT NULL,
//    amount int(11) NOT NULL,
//    network varchar(255) NOT NULL,
//    accountnumber varchar(255) NOT NULL,
//    routingnumber varchar(255) NOT NULL,
//    bankname varchar(255),
//    PRIMARY KEY(id),
//    FOREIGN KEY (userid) REFERENCES Users(id)
// );
