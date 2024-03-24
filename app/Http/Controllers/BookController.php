<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return Book::get();
    }

    public function post(Request $request)
    {
        $name = $request->input('nama');

        dd($request->all());
    }
}
