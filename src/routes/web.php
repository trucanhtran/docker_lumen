<?php

use Illuminate\Http\Request;
use App\Models\User;
use Predis\Client as Redis;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return view('index');
});

$router->group(['prefix' => 'api'], function () use ($router){
    $router->get(uri:'/users', action:'UsersController@index');
    $router->post(uri:'/users', action:'UsersController@store');
    $router->put(uri:'/users/{id}', action:'UsersController@update');
    $router->delete(uri:'/users/{id}', action:'UsersController@destroy');
});

$router->get('/books', 'BooksController@index');
$router->get('/books/{id:[\d]+}', [
    'as' => 'books.show',
    'uses' => 'BooksController@show'
]);
$router->post('/books', 'BooksController@store');
$router->put('/books/{id:[\d]+}', 'BooksController@update');
$router->delete('/books/{id:[\d]+}', 'BooksController@destroy');

$router->get('/home', [
    'uses' => 'TestController@home'
]);

$router->get('/signup', function () use ($router) {
    return view('signup');
});

$router->post('/signup', [
    'uses' => 'TestController@signup'
]);

$router->get('/login', function () use ($router){
    $client = new Redis([
        'scheme' => 'tcp',
        'host'   => env('REDIS_HOST'),
        'port'   => env('REDIS_PORT'),
    ]);
    // $client->set('test', 123);
    // print (env('APP_KEY'));
    // print ($client->get('test'));
    return view('login');
});

$router->post('/login', [
    'uses' => 'TestController@login'
]);

$router->delete(uri:'/signout/{token}', action:'TestController@signout');

// $router->post('/login1', function(Request $request) use ($router) {
//     print($request->name);
//     $credentials = $request->only(['email', 'password']);
//     $users = User::where('email','like',$request->email);
//     $authorModel = User::where('email' , '=', $request->email)->first();
//     print(json_encode($request->email));
//     print(json_encode($credentials));
//     print(json_encode($authorModel));
//     print(json_encode($users));
//     return view('show', ['quote' => 10]);
// });
