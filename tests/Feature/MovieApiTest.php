<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;
use App\Models\Movie;

class MovieApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creating a new movie.
     *
     * @return void
     */
    public function testCreateMovie()
    {
        // Create a user with a session token
        $user = User::factory()->create([
            'session_token' => 'valid_session_token',
        ]);

        // Define the movie data
        $movieData = [
            'name' => 'The Titanic',
            'casts' => ['DiCaprio', 'Kate Winslet'],
            'release_date' => '1998-01-18', // Correct date format
            'director' => 'James Cameron',
            'ratings' => [
                'imdb' => 7.8,
                'rotten_tomato' => 8.2
            ],
            'session_token' => 'valid_session_token', // Attach the session token
        ];

        // Make a POST request to create a new movie
        $response = $this->postJson('/api/v1/movies', $movieData);

        // Assert that the response is successful
        $response->assertStatus(201);

        // Assert that the movie is created in the database
        $this->assertDatabaseHas('movies', [
            'name' => 'The Titanic',
            // Add more assertions for other fields if needed
        ]);
    }

    /**
     * Test retrieving a specific movie by ID.
     *
     * @return void
     */
    public function testGetMovieById()
    {
        // Create a movie
        $movie = Movie::factory()->create([
            'name' => 'The Titanic',
            'casts' => ['DiCaprio', 'Kate Winslet'],
            'release_date' => '1998-01-18',
            'director' => 'James Cameron',
            'ratings' => [
                'imdb' => 7.8,
                'rotten_tomato' => 8.2
            ],
        ]);

        // Make a GET request to retrieve the movie by ID
        $response = $this->getJson('/api/v1/movies/' . $movie->id);

        // Assert that the response is successful
        $response->assertStatus(200);

        // Assert that the retrieved movie matches the created movie
        $response->assertJson([
            'name' => 'The Titanic',
            // Add more assertions for other fields if needed
        ]);
    }

    /**
     * Test retrieving all movies.
     *
     * @return void
     */
    public function testGetAllMovies()
    {
        // Create multiple movies
        Movie::factory()->count(3)->create();

        // Make a GET request to retrieve all movies
        $response = $this->getJson('/api/v1/movies');

        // Assert that the response is successful
        $response->assertStatus(200);

        // Assert that the correct number of movies is returned
        $response->assertJsonCount(3);

        // Assert the structure of the JSON response if needed
        // $response->assertJsonStructure([
        //     '*' => [
        //         'name',
        //         'casts',
        //         'release_date',
        //         'director',
        //         'ratings'
        //     ]
        // ]);
    }

    /**
     * Test authentication for protected endpoints.
     *
     * @return void
     */
    public function testAuthentication()
    {
        // Make a POST request to create a new movie without a session token
        $response = $this->postJson('/api/v1/movies', []);

        // Assert that the response status is 401 (Unauthorized)
        $response->assertStatus(401);

        // Make a GET request to retrieve a movie by ID without a session token
        $response = $this->getJson('/api/v1/movies/1');

        // Assert that the response status is 401 (Unauthorized)
        $response->assertStatus(401);

        // Make a GET request to retrieve all movies without a session token
        $response = $this->getJson('/api/v1/movies');

        // Assert that the response status is 401 (Unauthorized)
        $response->assertStatus(401);
    }
}
