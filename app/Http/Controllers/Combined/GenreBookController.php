<?php

namespace App\Http\Controllers\Combined;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class GenreBookController extends Controller
{
    public function index($genre_id)
    {
        $books = Book::get()->where('genre_id', $genre_id);
        if (is_null($books)) {
            return response()->json('There are no books for this genre', 404);
        }
        return response()->json($books);
    }
}
