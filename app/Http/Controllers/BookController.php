<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        //조건에 맞는 모델 전부 조회
        $result = Book::get();

        //조건에 맞는 모델을 (어떤 기준으로 정렬 된 첫번째) 하나만 조회
        $result = Book::orderBy('id', 'desc')->first();
        $result = Book::query()->orderBy('id')->first();

        // price 1000인 전체
        $result = Book::query()->where('price', '=', 1000)->get();

        // price 1000인 하나
        $result = Book::query()->where('price', '=', 1000)->first();



//        $query = Book::query()->where('price', '=', 6000);
//        dd($query->toSql(), $query->getBindings());

        //and where
        $result = Book::query()
            ->where('price', '>=', 1000)
            ->where('page', '>=', 50)
            ->get();

        //or where
        $result = Book::query()
            ->where('price', '>=', 1000)
            ->orWhere('page', '>=', 50)
            ->get();


        //(이름=책이면서 가격이 1000원이상) 이거나 가격이 30000이상
        $result = Book::query()
            ->where(function ($query) {
                $query->where('name', '=', '책')
                    ->where('price', '>=', 1000);
            })
            ->orWhere('price', '>=', 30000)
            ->get();

        return $result;
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
