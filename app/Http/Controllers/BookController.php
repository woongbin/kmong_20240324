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

    public function show(Request $request, Book $book)
    {
        return $book;
    }

    public function post(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|numeric',
            'page' => 'required',
        ]);

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

    public function update(Request $request, Book $book)
    {
        $name = $request->input('name');

        //ORM Instance
//        $book->name = $name;
//        $book->save();

        //builder
        Book::where('id', '=', $book->id)
            ->update(['name' => $name]);
    }

    public function destroy(Request $request, Book $book)
    {
        //ORK
//        $book->delete();

        //builder
        Book::where('id', '=', $book->id)
            ->delete();
    }
}
