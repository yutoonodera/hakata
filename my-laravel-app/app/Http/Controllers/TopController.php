<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;

/*トップページ表示するController*/

class TopController extends Controller
{
    public function index()
    {
        $movies = Movie::where('status', '=', Movie::OPEN_STATUS)->orderBy('created_at', 'desc')->get();
        return view('top.index', [
            'movies' => $movies,
            'uploadDir' => Movie::UPLOAD_DIR
        ]);
    }
}
