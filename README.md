# DentalRegistry

A data-management system for dental clinics. Keeps record of patients, appointments, treatments, procedures and budgets.

This was a simple but working software for a dental clinic. It was made on request, no standards for customer dental records (if any) were followed.

## Some notes about this project

This is an old project I was working on for some local small businesses in the area. It was custom-made software; so, many things regarding dental businesses management, patient records and stuff was (and still is) unknown to me. I stopped giving assistance to this project due to other obligations.

Approach the code in the following way:

1. Every php file in the main folder is a page with an specific functionality in the system. I tried to name them according to their respective task.
2. Every php file in the main folder has an associate js file in the js folder. The reason is I wanted to do communication with the DB using Ajax.
3. Concerning DB communication. All the transactions logic is in the modules/dbhandler.php file. My approach was to group all the required queries to the database in a single file, such that modifications are only done in one place instead of looking through all the php files.
4. In modules/function.php there are plenty of common functions to all modules. It was the same logic as in modules/dbhandler.php
5. The version I posted in github is the generic version. I did some other versions based on this one with more functionalities and different DB transaction approaches. Unfortunately I lost the code of those versions. I could save the very initial one.

For sure there are better ways for doing this kind of applications. I coded this during the years when the combination Apache+MySQL+PHP has a hit and Ajax was getting stronger (around 2012).

Hope it helps.

## Login and Credentials

Since it is the generic version of a custom-made application, the login and credentials changed from implementation to implementation (I know it is not the best way, even a way for doing that). In short, you will need to add the admin user manually in a query like thi:

```SQL
INSERT INTO sonri-citas.user  (
  firstname,
  middlename,
  firstlastname,
  secondlastname,
  sex,
  documenttype,
  documentnumber,
  birthdate,
  address,
  phonehome,
  maritalstatus,
  username,
  password,
  privileges) 
VALUES (
  "admin",
  "admin",
  "admin",
  "admin",
  1,
  1,
  12345,
  "01/01/2000",
  "address",
  "000-000-000",
  1,
  "admin",
  "adminpassword",
  4);
```

Again, not the best way. From this code other versions were made.
