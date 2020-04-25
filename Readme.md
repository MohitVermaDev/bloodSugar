# Steps to Follow

1 Config Your DataBase
  > Oper DBcon.class.php in Classes folder and add you database info.
  
    define('DB_SERVER','localhost');// Your hostname
    
    define('DB_USER','root'); // Databse username
    
    define('DB_PASS' ,''); // Database Password
    
    define('DB_NAME', 'database');// Database name
 

2 Import the Database
  > Import bstest.sql in your database
  

3 Add Your Url
  > Open autoload.php file from root folder and add you url.
    define('weburl','http://localhost/foldername');


# URLs and Credentials
1 Admin
  http://localhost/foldername/admin
  Login: admin@gmail.com
  Password: 123


2 User
  http://localhost/foldername/
  Register Your Account and
  Verify Your Mail
