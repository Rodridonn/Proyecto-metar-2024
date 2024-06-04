<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function showMenu()
    {
        // Verifica si el usuario actual es un administrador
        if (auth()->user() && auth()->user()->is_admin) {
            return view('menu.admin');
        } else {
            return view('menu.user');
        }
    }
}
