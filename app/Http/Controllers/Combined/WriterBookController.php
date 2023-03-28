<?php

namespace App\Http\Controllers\Combined;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class WriterBookController extends Controller
{
    public function index($writer_id)
    {
        $books = Book::get()->where('writer_id', $writer_id);
        if (is_null($books)) {
            return response()->json('There are no books for this writer', 404);
        }
        return response()->json($books);
    }
}
