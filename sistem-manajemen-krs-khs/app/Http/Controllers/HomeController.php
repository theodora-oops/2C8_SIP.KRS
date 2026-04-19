<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'nama' => 'Yohana',
            'pekerjaan' => 'Developer',
        ];
        return view('home', $data);
    }
    public function contact()

    {
        return view('contact');
    }
}
