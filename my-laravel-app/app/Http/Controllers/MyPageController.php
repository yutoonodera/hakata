<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;

class MyPageController extends Controller
{
    //ステータスをプルダウン、一覧で表示する変数
    protected $statuses = [
        '0' => '非公開',
        '1' => '公開',
    ];

    public function index()
    {
        $movies = Movie::all();
        return view('my.index', [
            'movies' => $movies,
            'uploadDir' => Movie::UPLOAD_DIR,
            'statuses' =>  $this->statuses,
        ]);
    }
}
