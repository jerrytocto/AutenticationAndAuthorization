<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Función para crear un usuario 
    public function registerUser(CreateUserRequest $request)
    {
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password) 
        ]);    
        return ApiResponse::success('Usuario registrado exitosamente',200);
    }
    //función para editar un usuario
    public function updateUser(Request $request, $id){
        //verificar si el usuario existe en la base de datos
        $user = User::find($id);
        if(isset($user->id)){
            $user->name = isset($request->name)?$request->name: $user->name; 
            $user->email = isset($request->email)?$request->email: $user->email;
            $user->password = isset($request->password)?$request->password:$user->password;
            $user->save();
            return ApiResponse::success('Usuario actualizado exitosamente',200,$user);
        }else{
            return ApiResponse::error('Usuario no encontrado',404);
        }
    }

    //Función para logear un usuario 
    public function loginUser(LoginUserRequest $request)
    {
        /*
        $user = User::where('email',$request->email)->first();

        if(isset($user->id)){
            if(Hash::check($request->password,$user->password)){
                $token = $user->createToken("auth_token")->plainTextToken;
                return ApiResponse::success('Inicio de sesión exitoso',200,['user'=>$user,'token'=>$token]);
            }else{
                return ApiResponse::error('La contraseña es incorrecta',401);
            }
        }else{
            return ApiResponse::error('El usuario no se encuentra registrado',401);
        } */

        //OTRO FORMA DE AUTENTICAR UN USAURIO
        if(!Auth::attempt($request->only(['email','password']))){
            return ApiResponse::error('Las credenciales son incorrectas',401);
        }
        $user = User::where('email',$request->email)->first();
        $token = $user->createToken("auth_token")->plainTextToken ;
        return ApiResponse::success('Login exitosamente',200,['user'=>$user,'token'=>$token]);
    }

    //Función para ver un usuario 
    public function viewUser()
    {
        $datUser = auth()->user();
        
        return ApiResponse::success('User logeado datos',200,$datUser);
    }

    //Función para cerrar sesión 
    public function logout()
    {
        auth()->user()->tokens()->delete('Token');
        return ApiResponse::success('Sesión serreda exitosamente',200);
    }
    
   
}
