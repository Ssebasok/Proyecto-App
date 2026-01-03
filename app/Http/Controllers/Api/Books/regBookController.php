<?php

namespace App\Http\Controllers\Api\Books;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\createBookRequest;
use App\Models\Book;


class regBookController extends Controller
{
    public function createBook(createBookRequest $request){
        try{
            $user = auth('api')->user();

            if(!$user){
                return response()->json([
                    'success' => 0,
                    'message' => 'User not authenticated'
                ], 401);
            }

            $validated = $request->validated();
            $createBooks = Book::create([
                'user_id' => $user->id,
                'title' => $validated['title'],
                'description' => $validated['description'],
                'published_year' => $validated['published_year'],
                'authors' => $validated['authors'],
                'categories' => $validated['categories'],
            ]);

            return response()->json([
                'success' => 1,
                'message' => 'Book created successfully',
                'data' => $createBooks
            ], 201);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => 0,
                'message' => 'Error creating book: ' . $e->getMessage()
            ], 500);
        }
    }
}