Movie API

Introduction
This is a RESTful API for managing movies. It provides endpoints to create, retrieve, and list movies. The API is built using Laravel and utilizes MySQL as the database.

Authentication
API endpoints are authenticated using a session_token field associated with users. Each request must include a valid session_token for authentication. Users can obtain this token through a separate login mechanism, which is assumed to be implemented outside of this API. The session_token has an unlimited time-to-live (TTL) and remains valid until explicitly revoked.

Installation
Clone the repository to your local machine:

bash
Copy code
git clone https://github.com/raja-dayo/RestAPI-.git
Install dependencies using Composer:

bash
Copy code
composer install
Copy the .env.example file to .env and configure your database connection:

bash
Copy code
cp .env.example .env
Generate an application key:

bash
Copy code
php artisan key:generate
Run database migrations to create the necessary tables:

bash
Copy code
php artisan migrate
Serve the application:

bash
Copy code
php artisan serve
You can now access the API at http://localhost:8000.

API Endpoints
Create Movie
URL: /api/v1/movies

Method: POST

Payload:

json
Copy code
{
    "name": "The Titanic",
    "casts": ["DiCaprio", "Kate Winslet"],
    "release_date": "1998-01-18",
    "director": "James Cameron",
    "ratings": {
        "imdb": 7.8,
        "rotten_tomato": 8.2
    },
    "session_token": "valid_session_token"
}
Response: Status code 201 Created

Retrieve Movie by ID
URL: /api/v1/movies/{id}
Method: GET
Response: Details of the movie with the specified ID
Retrieve All Movies
URL: /api/v1/movies
Method: GET
Response: List of all movies
Testing
To run the PHPUnit tests, use the following command:

bash
Copy code
php artisan test
Dependencies
Laravel Framework
MySQL Database
Composer (for dependency management)
Contributors
Ghulam Hyder