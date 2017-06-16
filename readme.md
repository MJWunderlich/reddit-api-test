# Reddit API Test

This is a simple Reddit API test.

## Architecture

This is a simple project that utilizes Laravel, AngularJS, Bootstrap, and jQuery.

### Backend

The backend is a very simple API layer I created, that interfaces with Reddit's API and returns the results as JSON.

**The project's main files**

* Main controller:
  - `app/Http/Controllers/ApiController`

### Frontend

The frontend uses AngularJS and uses AJAX to query the simple API. It also uses Bootstrap for the responsive aspect.

**The project's main files**

* Main Javascript (this is the Angular code):
  - Application: `public/js/app.js`
  - Controller: `public/js/reddit.js`
* Custom CSS:
  - `public/css/default.css`
* Main view (html):
  - `resources/views/index.html`

## Installation

* Obtain a copy of the source code
  - Either via GIT: `git clone https://github.com/MJWunderlich/reddit-api-test.git`
  - Obtain a ZIPPED archive from Mario Wunderlich
  - If you obtain the code using GIT, you will need to have **composer** installed, please view the Composer website for more info (https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)
* Once the source code is extracted, go into the directory, then:
  - If you obatined the code using GIT, run `composer install`
  - To run the project, run `php artisan serve --port=8000`
* Finally, point your browser to the following URL: **http://localhost:8000**
  - The reddit test app should appear :)