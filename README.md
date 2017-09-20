# Order-and-Bargain-system

## Introduction

An system for products order and bargain.

## Requirements

PHP Version 7.0.19  
MySQL Version 5.6.35-81.0

## System feature
I. Common feature:  
- For salesperson and customer to creating their own account.   
- Add an mechanism for checking input data when user create product, update product information, order product, or reply orders.     

II. Features for Customer:  
- List all products to order it or bargain the price.   
- List all orders which be created by this account.   

III. Features for Salesperson:    
- Create new products.    
- Update products information.    
- List all products which be built in this system.    
- List all orders which be created from every customers.    
- List the overdue orders.

## DEMO system

If you need a sample to refer, please click following url. This system is built from me.
http://jeffhsieh.byethost31.com/login.php

## How to build this system?

After install PHP and MySQL (Or go to apply an server which support PHP+MySQL for test) 
- Modify the setting in config.php:   
  (1) $db_host = 'Your MySQL hostname';     (eg. localhost)   
  (2) $db_user = 'Your MySQL account';      (eg. Test)    
  (3) $db_pass = 'Your MySQL password';     (eg. Testonly)  
  (4) $db_name = 'Your MySQL database';     (eg. DBDB)  
  (5) $tb_name = 'Your first table name';   (eg. Table1)  
  (6) $tb_name1 = 'Your second table name'; (eg. Table2)  
  (7) $tb_name2 = 'Your third table name';  (eg. Table3)  

- Create three tables in your MySQL database.   

Table 1 (First Table)       
+-----------+------------------+------+-----+-------------------+-----------------------------+   
| Field     | Type             | Null | Key | Default           | Extra                       |   
+-----------+------------------+------+-----+-------------------+-----------------------------+   
| userid    | int(10) unsigned | NO   | PRI | NULL              | auto_increment              |   
| email     | varchar(255)     | NO   |     | NULL              |                             |   
| password  | varchar(255)     | NO   |     | NULL              |                             |   
| guid      | varchar(32)      | YES  |     | NULL              |                             |   
| authority | tinyint(4)       | YES  |     | NULL              |                             |   
| Time      | timestamp        | NO   |     | CURRENT_TIMESTAMP | on update CURRENT_TIMESTAMP |   
+-----------+------------------+------+-----+-------------------+-----------------------------+     

Table 2 (Second Table)         
+---------------+------------------+------+-----+-------------------+-----------------------------+   
| Field         | Type             | Null | Key | Default           | Extra                       |   
+---------------+------------------+------+-----+-------------------+-----------------------------+   
| userid        | int(11) unsigned | NO   | PRI | NULL              | auto_increment              |   
| P_name        | varchar(255)     | NO   |     | NULL              |                             |   
| P_description | varchar(2500)    | NO   |     | NULL              |                             |   
| P_amount      | int(11)          | NO   |     | NULL              |                             |   
| P_in_price    | int(11)          | NO   |     | NULL              |                             |   
| P_out_price   | int(11)          | NO   |     | NULL              |                             |   
| P_comment     | varchar(2500)    | YES  |     | NULL              |                             |   
| email         | varchar(255)     | NO   |     | NULL              |                             |   
| P_editor      | varchar(255)     | NO   |     | NULL              |                             |   
| Time          | timestamp        | NO   |     | CURRENT_TIMESTAMP | on update CURRENT_TIMESTAMP |   
+---------------+------------------+------+-----+-------------------+-----------------------------+     
 
Table 3 (Third Table)      
+---------------+------------------+------+-----+-------------------+-----------------------------+   
| Field         | Type             | Null | Key | Default           | Extra                       |   
+---------------+------------------+------+-----+-------------------+-----------------------------+   
| userid        | int(11) unsigned | NO   | PRI | NULL              | auto_increment              |   
| nex_userid    | int(11)          | YES  |     | NULL              |                             |   
| pre_userid    | int(11) unsigned | YES  |     | NULL              |                             |   
| P_userid      | int(11) unsigned | NO   |     | NULL              |                             |   
| P_name        | varchar(255)     | NO   |     | NULL              |                             |   
| P_description | varchar(2500)    | NO   |     | NULL              |                             |   
| P_amount      | int(11)          | NO   |     | NULL              |                             |   
| P_total_price | int(11)          | NO   |     | NULL              |                             |   
| P_comment     | varchar(2500)    | YES  |     | NULL              |                             |   
| C_email       | varchar(255)     | NO   |     | NULL              |                             |   
| editor        | varchar(255)     | YES  |     | NULL              |                             |   
| status        | varchar(255)     | YES  |     | NULL              |                             |   
| Time          | timestamp        | NO   |     | CURRENT_TIMESTAMP | on update CURRENT_TIMESTAMP |   
+---------------+------------------+------+-----+-------------------+-----------------------------+   

- Set the MySQL accout can execute SELECT, INSERT, UPDATE function on table 1-3.
Then you can start to use this system.

