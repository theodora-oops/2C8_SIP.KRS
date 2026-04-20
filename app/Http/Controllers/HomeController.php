<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'nama' => 'Enif Azzahra',
            'pekerjaan' => 'Developer',
        ];
        return view('home', $data);
    }
    public function contact()

    {
        return view('contact');
    }
}
