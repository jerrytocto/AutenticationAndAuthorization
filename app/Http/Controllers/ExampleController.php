<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function index()
    {
        return response()->json('Bienvenido al sistema web',200);
    }

    public function notAuthorized ()
    {
        return response()->json('NO tienes acceso',404);
    }
}
