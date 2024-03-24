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
        $name = $request->input('name');
        $price = $request->input('price');

        //1. 빌더
//        Book::create([
//            'name' => $name,
//            'price' => $price
//        ]);

        // ORM instance
        $book = new Book();
        $book->name = $name;
        $book->price = $price;
        $book->save();
    }
}
