<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class IndexController extends Controller
{
   public function getIndex()
   {

      return view('Index');
   }

   public function getData()
   {

      $books = Book::all();
      return response()->json(['books' => $books]);
   }

   public function postBook(Request $request)
   {

      //echo "Hoşgeldin";
      //exit();

      $validateData = $request->validate(
         [
            'name' => 'required|string',
            'book_code' => 'required|integer',
            'author' => 'required|string',
         ]
      );
      //kayıt işlemleri 

      $book = new Book();
      $book->name = $request->name;
      $book->book_code = $request->book_code;
      $book->author = $request->author;
      $book->save();
      $msg = "Record is Ok.";
      return response()->json(['msg' => $msg]);
   }
   public function bookDelete(int $id)
   {
      Book::where('id', $id)->delete();
      $msg =  "Record deleted !";
      return response()->json(['msg' => $msg]);
      //return redirect() - route('index');
   }

   public function getBookEdit(int $id)
   {

      $book = Book::where('id', $id)->first();
      return response()->json(['firstbook' => $book]);
   }

   public function postBookEdit(Request $request)
   {
      $validateData = $request->validate(
         [
            'name' => 'required|string',
            'book_code' => 'required|integer',
            'author' => 'required|string',
            'id' => 'required|integer'
         ]
      );

      $book = Book::find($request->id);
      
      //print_r($book);
      //exit();
      $book->name = $request->name;
      $book->book_code = $request->book_code;
      $book->author = $request->author;
      $book->save();
     
   }
}
