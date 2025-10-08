<?php

namespace App\Http\Controllers;
use App\Models\Room;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}
