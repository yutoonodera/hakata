<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;

class MyPageController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('my.index', [
            'movies' => $movies,
            'uploadDir' => Movie::UPLOAD_DIR
        ]);
    }
}
