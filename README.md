# Hypnos

## Useful links

GitHub link : [https://github.com/David-51/Hypnos.git](https://github.com/David-51/Hypnos.git)

Trello : [ECF 2022](https://trello.com/invite/b/qj4otr8J/f5005c1adbf0b05f8ea5d01bcda8c4cc/organisation-ecf)

PDF Technical documentation : You can find this PDF document in the folder "/documentation" of the repository. You will find :

- Informations about working environment
- UML diagrams (use cases, class diagrams)
- Graphics informations (color palette, fonts, wireframes)

## Technical specifications

**Server**
- Apache 2.4
- PHP 8.0 / PDO
- MySql 8.0

**Frontend**
- HTML 5
- CSS 3
- Bootstrap V5
- Javascript

**Backend**
- PHP 8.0 with PDO
- MySQL 8.0

## How to install Hypnos Application
Clone the repository at the Racine of your DocumentRoot Directory. The index.php must to be at the racine.
for exemple if your directory is var/www/html

       /var/www/html
       |-- index.php
       |      
       |-- Client
       |       |-- Assets
       |       |-- Config
       |       |-- Controller
       |       `-- public
       |-- API
       |     |-- Assets
       |     |-- Config
       |     |-- Controller
       |     |-- Model
       |     `-- public
       |-- Sql
       |
       `-- ...

Maybe you have to create a Virtualhost
You can follow the step on the official website [Apache VirtualHost](https://httpd.apache.org/docs/2.4/vhosts/)

## How to install database
- Run your terminal.
- Go to your application folder
- run your sql server (for an example with MySql : ```mysql.server start```)
- connect to your server (```mysql -u username -p```)
then you have probably to type your password
- run the script at the prompt
```source sql/db.sql```

### Creating an Administrator
There is three level of permission in this application :
- Administrator = "adm"
- Manager = "man"
- User = "use"

At Mysql prompt run the following command using your own details :

```INSERT INTO users (firstname, lastname, email, password, role) VALUES ("John", "Doe", "JohnDoe@example.com", "bcryptpassword", "adm");```

Be carreful, you have to insert your hashed password. You can hash your password using the website [bcrypt.fr](https://www.bcrypt.fr/) 

## Configure your Database on Hypnos application
Go to the application folder API/Model/Manager.

Edit "DatabaseManager.php"

You have to modify DSN, PASSWORD and USERNAME.

Hypnos application use PHP PDO to connect to the database. Most of the time you only have to enter the username you use for your database and your password. Maybe you have to modify the DSN.

For more information about DSN, you can use the official PHP PDO documentation for your database.
[PHP PDO](https://www.php.net/manual/fr/pdo.drivers.php)


## How to test Hypnos Application

## Quick démos
You can quickly create a demo with establishments, suites, users and other features.
run the script demos : `source sql/hypnos.sql`
All the users passwords created are 12345678.
