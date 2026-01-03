<?php

namespace App\Http\Controllers\Api\Books;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class delBookController extends Controller
{
    public function deleteBook(Request $request){
        $user = auth('api')->user();
        
        if(!$user){
            return response()->json([
                'success' => 0,
                'message' => 'User not authenticated'
            ], 401);
        }

        $book = Book::find($request->id);
        
        if(!$book){
            return response()->json([
                'success' => 0,
                'message' => 'Book not found'
            ], 404);
        }

        // Verificar que el usuario sea el dueño del libro
        if($book->user_id !== $user->id){
            return response()->json([
                'success' => 0,
                'message' => 'You do not have permission to delete this book'
            ], 403);
        }

        $book->delete();
        return response()->json([
            'success' => 1,
            'message' => 'Book deleted successfully'
        ], 200);
    }
}
