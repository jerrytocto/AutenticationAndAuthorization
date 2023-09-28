<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ExampleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('example')->get('/',[ExampleController::class,'index']);
Route::get('no-authorized',[ExampleController::class,'notAuthorized'])->name('no-access');

//Rutas para la autenticación del usuario
Route::post('user/register',[AuthController::class,'registerUser'])->middleware('can:user.register');
Route::post('user/login',[AuthController::class,'loginUser']);

Route::middleware('auth:sanctum')->group(function(){
    //Rutas para auth
    Route::get('view-user',[AuthController::class,'viewUser'])->middleware('can:user.view.user');
    Route::get('user/logout',[AuthController::class,'logout'])->middleware('can:user.logout');

    //Rutas para el blog, se agregan dentro de este middleware auth:sanctum debido a que 
    //para crear, ver, actualizar, eliminar una ruta este debe haber iniciado sesión
    Route::post('create-blog',[BlogController::class,'createBlog'])->middleware('can:blog.create');
    Route::get('list-blog',[BlogController::class,'listAllBlogs'])->middleware('can:blog.view');
    Route::get('list-blog/{id}',[BlogController::class,'listBlogById']);
    Route::put('edit-blog/{id}',[BlogController::class,'updateBlog'])->middleware('can:blog.update');
    Route::delete('delete-blog/{id}',[BlogController::class,'deleteBlog'])->middleware('can:blog.delete');
    Route::get('blog/all',[BlogController::class,'getAllBlogs'])->middleware('can:blog.all');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
