<?php

namespace App\Http\Controllers;

use App\Http\Resources\Genre\GenreCollection;
use App\Http\Resources\Genre\GenreResource;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genre::all();
        return response()->json([
            'genres' => new GenreCollection($genres)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:genres'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $genre = Genre::create([
            'name' => $request->name
        ]);

        return response()->json([
            'message' => 'Genre inserted',
            'genre' => new GenreResource($genre)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function show($genre_id)
    {
        $genre = Genre::find($genre_id);
        if (is_null($genre)) {
            return response()->json('Genre not found', 404);
        }
        return response()->json([
            'genre' => new GenreResource($genre)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genre $genre)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:genres'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $genre->name = $request->name;

        $genre->save();

        return response()->json([
            'message' => 'Genre updated',
            'genre' => new GenreResource($genre)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();

        return response()->json('Genre deleted');
    }
}
