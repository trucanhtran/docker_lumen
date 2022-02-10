<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Log;
use Illuminate\Http\Request;

    /**
    * Class BooksController
    * @package App\Http\Controllers
    */

class BooksController extends Controller
{

    /** @OA\Info(title="My First API", version="0.1") */

     /**
     * @OA\Get(
     *     path="/books",
     *     tags={"Book"},
     *     summary="Show All Books",
     *     operationId="showBooks",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     ),
     * )
     */

    public function index()
    {
        return Book::all();
    }
    
     /**
     * @OA\Get(
     *     path="/books/{id}",
     *     summary="Find Book By Id",
     *     operationId="ShowBook",
     *     tags={"Book"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The category parameter in path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Returns some sample category things",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     )
     * )
     */
    
    public function show($id)
    {
        try 
        {
            return Book::findOrFail($id);
        }
        catch (ModelNotFoundException $e) 
        {
            return response()->json(
            ['error' => 
                ['message' => 'Book not found']
            ], 404);
        }
    }

    /**
     * @OA\Post(
     *     path="/books",
     *     summary="Create Book",
     *     operationId="CreateBook",
     *     tags={"Book"},
     *     @OA\Parameter(
     *         name="title",
     *         in="query",
     *         description="The title parameter in query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="The description parameter in query",
     *         required=false,
     *         @OA\Schema(type="text")
     *     ),
     *    @OA\Parameter(
     *         name="author",
     *         in="query",
     *         description="The author parameter in query",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Returns some sample category things",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     )
     * )
     */

     public function store(Request $request)
    {
        try {
            $book = new Book();
            $book->title = $request->title;
            $book->description = $request->description;
            $book->author = $request->author;
        if ($book->save()){
            return response()->json(['status' => 'success', 'message' => 'Post created successfully']);
        }
       }   catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
    
    /**
     * @OA\Put(
     *     path="/books/{id}",
     *     summary="Update Book",
     *     operationId="UpdateBook",
     *     tags={"Book"},
     *  @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The title parameter in query",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="title",
     *         in="query",
     *         description="The title parameter in query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="The description parameter in query",
     *         required=false,
     *         @OA\Schema(type="text")
     *     ),
     *    @OA\Parameter(
     *         name="author",
     *         in="query",
     *         description="The author parameter in query",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Returns some sample category things",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     )
     * )
     */

    public function update(Request $request, $id)
    {
        try 
        {
             $book = Book::findOrFail($id);
        }
        catch (ModelNotFoundException $e) 
        {
            return response()->json([
            'error' => [
            'message' => 'Book not found'
            ]], 404);
        }

        $book->fill($request->all());
        $book->save();

        return $book;
    }

    /**
     * @OA\Delete(
     *     path="/books/{id}",
     *     summary="Delete Book By Id",
     *     operationId="DeleteBook",
     *     tags={"Book"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The id parameter in path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Returns some sample category things",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     )
     * )
     */

    public function destroy($id){
        try 
        {
            $book = Book::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                    'error' => [
                    'message' => 'Book not found'
                ]
            ], 404);
        }
        
        $book->delete();

        return response(null, 204);
    }
    //
}
