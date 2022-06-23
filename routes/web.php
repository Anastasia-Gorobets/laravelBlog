<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PostsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view("posts", ['posts'=>Post::all()]);
})->name('home.index');


Route::get('/contact',  'HomeController@contact')->name('contact');
Route::get('/secret',  'HomeController@secret')->name('secret')->middleware('can:home.secret');

Route::get('/posts/tag/{id}',  'PostTagController@index')->name('posts.tags.index');


/*Route::get('posts/{post}', function ($slug) {
    return view("post", [
        'post'=>Post::find($slug)
    ]);
})->whereAlpha('post');*/


/*Route::get('posts/{id}', function ($id) use ($posts){

    abort_if(!isset($posts[$id]), 404);

    return view("posts.show", [
        'post'=>$posts[$id]
    ]);
})->name('posts.show');*/

/*
Route::get('/posts', function () use ($posts){


    $request = request()->all();
  //  dd((int)request()->input('page'));

    if(request()->filled('page')){
        echo "yes";
    }else{
        echo "no";
    }


    if(request()->has('pageTest')){
        echo "yes";
    }else{
        echo "no";
    }


    return view("posts.index", [
        'posts'=>$posts
    ]);
});*/


Route::resource('posts','PostsController');

Route::resource('posts.comments','PostCommentController')->only('store');

Route::resource('users','UserController');



/*Route::get('/test/{id?}', function ($id = 0) {

    return "Id = $id";
});*/


/*
Route::prefix('/fun')->name('fun.')->group(function () use ($posts){



    Route::get('responses', function () use ($posts) {

        return response($posts, 201)->header('Content-Type', 'application/json')->cookie('MY_COOKIE','Nastya', 3600);

    });


    Route::get('redirect', function (){
        return redirect('contact');
    });

    Route::get('back', function (){
        return back();
    });

    Route::get('named-route', function (){
        return redirect()->route('posts.show', ['id'=>1]);
    });

    Route::get('away', function (){
        return redirect('https://google.com');
    });


    Route::get('json', function () use ($posts){
        return response()->json($posts);
    });


    Route::get('download', function (){
        return response()->download(public_path('/image.jpg'), 'face.jpg');
    });





});*/

/*
Route::get('/home', function () {
    return view("home.index",[]);
})->name('home.index');*/

/*Route::view('/home','home.index')->name('home.index');;
Route::view('/contact','contact')->name('contact');;*/

Route::get('/home', [HomeController::class, 'home']);
/*Route::get('/contact', [HomeController::class, 'contact']);*/

/*Route::get('/contact', function () {
    return view("contact");
})->name('contact');*/

Route::get('/test', function (){
    return view('test');
});


Auth::routes();

/*Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');*/
