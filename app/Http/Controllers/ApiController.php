<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'name' => 'John Doe',
            'age' => 30,
            'email' => ''
        ]);
    }
}
