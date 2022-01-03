<?php

namespace App\Http\Controllers\Passaver;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        return view('passaver.admin.index');
    }
    
    public function arquivo(Request $request)
    {
        echo '<pre>';
        print_r(pathinfo($request->arquivo->getClientOriginalName()));
        echo '</pre>';
        exit;
    }
}
