<?php

namespace App\Http\Controllers\Passaver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('passaver.home.index');
    }
}
