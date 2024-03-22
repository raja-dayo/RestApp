<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Validator;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::all();
        return response()->json($movies);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'casts' => 'required|array',
            'release_date' => 'required|date_format:d-m-Y',
            'director' => 'required|string',
            'ratings' => 'required|array'
        ]);

        if ($validator->fails()) {
            $data = [
                $validator->errors(),
                422
            ];
            return $data; 
        }

        $movie = new Movie([
            'name' => $request->input('name'),
            'casts' => json_encode($request->input('casts')),
            'release_date' => $request->input('release_date'),
            'director' => $request->input('director'),
            'ratings' => json_encode($request->input('ratings'))
        ]);

        $movie->save();

        return response()->json($movie, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = Movie::findOrFail($id);

        return response()->json($movie);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
