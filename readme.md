# Reddit API Test

This is a simple Reddit API test.

## Features

  - Fully responsive: displays on any screen size
  - Dynamic: uses AJAX to request all Reddit listings

## Architecture

This is a simple project that utilizes the following frameworks and libraries:
  - Laravel 5.4
  - AngularJS 1.6.4
  - Bootstrap 3.3.7
  - jQuery 3.2.1

### Backend

The backend is created on top of the Laravel Framework. It contains a simple API HTTP Controller I created (MVC architecture), that interfaces with Reddit's API and returns the results as JSON.

The available API routes are:
  - `/posts/hot` responds with a json response containing a list of HOT posts
  - `/posts/new` responds with a json response containing a list of NEW posts
  - `/posts/rising` responds with a json response containing a list of RISING posts
  
The root URI displays the main webpage (`/`).

**The backend's main files**

* Main controller:
  - `app/Http/Controllers/ApiController`

### Frontend

The frontend uses AngularJS and uses AJAX to query the simple API. It also uses Bootstrap for the responsive aspect.

**The frontend's main files**

* Main Javascript (this is the Angular code):
  - Application: `public/js/app.js`
  - Controller: `public/js/reddit.js`
* Custom CSS:
  - `public/css/default.css`
* Main view (html):
  - `resources/views/index.html`

## Installation

### Dependancies

- This project uses lib_curl (php-curl) to make HTTP requests. Make sure that the curl php extension is installed.
- This project uses Laravel 5.4, which has the following requirements:
  - PHP 5.6 (or higher)
  - **composer** is required to install the project dependencies
  
### Installation Instructions

* Obtain a copy of the source code
  - Either via GIT: `git clone https://github.com/MJWunderlich/reddit-api-test.git`
  - Obtain a ZIPPED archive from Mario Wunderlich
* To install Larvel dependencies:
  - Because this is a Laravel-based project, you will need to have **composer** installed in order to install the dependencies, please view the Composer website for more info (https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)
  - Go into the project's directory, then run `composer install`

### Running the dev server (required to view the website)

There are actually several ways this can be done.

* The easiest:
  - From within the project's main directory, run command `php artisan serve --port=8000`
* Equally easy:
  - From within the project's main directory, run command `php -S localhost:8000 -t public/`
* Finally point your browser to your the URL you chose (usually localhost) and port (let's say 8000): **http://localhost:8000**
  - The reddit test app should appear :)

