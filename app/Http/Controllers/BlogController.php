<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blog\CreateBlogRequest;
use App\Http\Requests\Blog\UpdateBlogRequest;
use App\Http\Responses\ApiResponse;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //Método para listar todos los blog 
    public function getAllBlogs(){
        return ApiResponse::success('Lista de todos los blogs',200,Blog::all());
    }

    //Método para listar todos los blog por usuario 
    public function listAllBlogs(){
        $user_id = auth()->user()->id;
        $blogs = Blog::where('user_id',$user_id)->get();
        return ApiResponse::success('Lista de todos los blog',200,$blogs);
    }

    //Método para listar un blog por id
    public function listBlogById($id){
        return ApiResponse::success('Usuario por id',200,Blog::findOrFile($id));
    }

    //Método para crear un blog
    public function createBlog(CreateBlogRequest $request){
        //$blog=Blog::create($request->all());
        $blog = new Blog([
            'title'=>$request->title,
            'content'=>$request->content,
            'user_id'=>auth()->user()->id
        ]);
        $blog->save();
        return ApiResponse::success('Blog creado exitosamente',200,$blog);
    }

    //Método para actualizar un blog
    public function updateBlog(Request $request,$id){
        $user_id = auth()->user()->id;
        if(Blog::where(['id'=>$id, 'user_id'=>$user_id])->exists()){

            $blog = Blog::find($id);
            $blog->title = isset($request->title) ? $request->title : $blog->title ;
            $blog->content = isset($request->content) ? $request->content : $blog->content ;
            $blog->save();
            return ApiResponse::success('Actualización exitosa',200,$blog);
        }else{
            return ApiResponse::error('Blog no encontrado',404);
        }
    }

    //Método para eliminar un blog
    public function deleteBlog($id){
        $user_id = auth()->user()->id;
        if(Blog::where(['id'=>$id,'user_id'=>$user_id])->exists()){
            Blog::findOrFail($id)->delete();
            return ApiResponse::success('Blog eliminado correctamente',200);
        }else{
            return ApiResponse::error('Blog no encontrado',404);
        }
    }
}
