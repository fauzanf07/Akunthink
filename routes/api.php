<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\BlogService;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| These routes are typically stateless and use the "api" middleware group.
|
*/

Route::get('/blog', function (BlogService $blog) {
    // returns list of docs (array of files)
    return response()->json($blog->listDocuments());
});

Route::get('/blog/{id}', function ($id, BlogService $blog) {
    return response()->json([
        'html' => $blog->getDocumentHtml($id)
    ]);
});
