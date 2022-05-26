<p align="center"><a href="https://symfony.com" target="_blank">
    <img src="https://symfony.com/logos/symfony_black_02.svg">
</a></p>

The [Symfony binary][1] is a must-have tool when developing Symfony applications
on your local machine. It provides:

* The best way to [create new Symfony applications][2];
* A powerful [local web server][3] to develop your projects with support for [TLS certificates][4];
* A tool to [check for security vulnerabilities][5];
* Seamless integration with [Platform.sh][6].

Installation Guide
----------------------

1) Read the installation instructions on [symfony.com][7] and run command  composer create-project symfony/website-skeleton api_rest_application
2) Run command for installation of doctrine ORM composer require symfony/orm-pack
3) Run command for installation of api platform bundles  composer require api
4) For creating database entities first i need to run the command of composer require --dev symfony/maker-bundle
5) set the database DATABASE_URL in .env file  
6) Run the command for database create php bin/console doctrine:database:create
7) FOr creating entities run the command of php bin/console make:entity after that i added the name of the entity Category then next step add all property name (name,products) same goes to product entity creation .
8) After creating entities run the command for migration php bin/console make:migration
   and another command is  php bin/console doctrine:migrations:migrate
   also i run this command for schema validate php bin/console doctrine:schema:validate

9) Then i create command console for category and product
 php bin/console make:command add-category
 php bin/console make:command add-product

10) I added symphony cli in project folder and run command of symfony serve
11) with the reference of point 9 i have created category:import   
    And product:import command console for importing json file records in database and i have place product.json and categories.json in public folder of project and then write code in configure() and execute() function for saving record in database with hitting of api that i have created using api.platform.
12) Thank you.