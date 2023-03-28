<?php

namespace App\Http\Controllers;

use App\Http\Resources\Book\BookCollection;
use App\Http\Resources\Book\BookResource;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return response()->json([
            'books' => new BookCollection($books)
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
            'title' => 'required|string|max:255',
            'abstract' => 'required|string|max:255',
            'year' => 'required|integer|between:1400,2023',
            'writer_id' => 'required|integer',
            'genre_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $writer = Writer::find($request->writer_id);
        if (is_null($writer)) {
            return response()->json('No such writer exist', 404);
        }
        $genre = Genre::find($request->genre_id);
        if (is_null($genre)) {
            return response()->json('No such genre exist', 404);
        }

        $book = Book::create([
            'title' => $request->title,
            'abstract' => $request->abstract,
            'year' => $request->year,
            'writer_id' => $request->writer_id,
            'genre_id' => $request->genre_id,
        ]);

        return response()->json([
            'message' => 'Book inserted',
            'book' => new BookResource($book)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($book_id)
    {
        $book = Book::find($book_id);
        if (is_null($book)) {
            return response()->json('Book not found', 404);
        }
        return response()->json([
            'book' => new BookResource($book)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'abstract' => 'required|string|max:255',
            'year' => 'required|integer|between:1400,2023',
            'writer_id' => 'required|integer',
            'genre_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $writer = Writer::find($request->writer_id);
        if (is_null($writer)) {
            return response()->json('No such writer exist', 404);
        }
        $genre = Genre::find($request->genre_id);
        if (is_null($genre)) {
            return response()->json('No such genre exist', 404);
        }

        $book->title = $request->title;
        $book->abstract = $request->abstract;
        $book->year = $request->year;
        $book->writer_id = $request->writer_id;
        $book->genre_id = $request->genre_id;

        $book->save();

        return response()->json([
            'message' => 'Book updated',
            'book' => new BookResource($book)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json('Book was deleted');
    }
}
