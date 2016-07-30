<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/posts', function () {
    $posts = \App\Post::all();
    return view('posts.index', compact('posts'));
});

Route::get('/posts/submit', function () {
    return view('posts.submit');
});

Route::post('/posts/submit', function(Request $request) {
    $validator = Validator::make($request->all(), [
        'title' => 'required|max:255',
        'slug' => 'required|max:255',
        'description' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return back()
            ->withInput()
            ->withErrors($validator);
    }

    $post = new \App\Post;
    $post->title = $request->title;
    $post->slug = $request->slug;
    $post->description = $request->description;
    $post->save();

    return redirect('/');
});
