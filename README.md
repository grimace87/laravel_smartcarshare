# Laravel SmartCarShare
Staff Web Portal for fictional SmartCarShare business

## About
SmartCarShare is a fictional car-rental business aimed at people who wish to use a car without owning one themselves. The business owns vehicles around Melbourne and negotiates with councils for parking locations where the cars are kept when not in use.
The staff web portal is intended for use by staff, to manage the business' members and their bookings, along with business assets including the vehicles and parking locations.
The project is currenly deployed on Heroku for testing purposes and may be accessed via [this link](http://smartcarshare-thing.herokuapp.com). The system can be logged in to with the highest-level authority using the username/password credentials of 'tom2'/'tom234'

## Installation Requirements
The project runs with the Laravel framework. To install the framework, you will require Composer.
To run the project on a server, you will require PHP version 7.0.0 or later. You will also need the following PHP extensions:
* OpenSSL
* PDO
* Mbstring
* Tokenizer
* XML

Additionally, the application interacts with a MySQL database. The database may be constructed with the 'SmartCarShareV7_remote.sql' script included with the project.

## Installation Instructions
* Clone this repository
* Install the dependencies by running a 'composer update' command in the root directory
* Import the provided MySQL script onto any accessible MySQL server, after creating a database for the purpose, and take note of the server's URL, the database name, and the database username/password
* Set up the environment:
  * Rename the '.env.example' file to '.env' and set variables as needed - in particular those beginning with 'DB_' which must be changed
  * Generate a valid App key by running the command 'php artisan key:generate' in the root directory (this sets the 'APP_KEY' variable)
