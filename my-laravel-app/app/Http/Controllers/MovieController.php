<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateMovieRequest;
use App\Http\Requests\UpdateMovieSaleRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Movie;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function createFileForm()
    {
        return view('movie/create/file');
    }

    // public function confirmFile($id)
    // {
    //     $movie = Movie::findOrFail($id);
    //     return view('movie/confirm/file', [
    //     'movie' => $movie,
    //     'uploadDir' => Movie::UPLOAD_DIR,
    //     ]);
    // }

    public function createFile(CreateMovieRequest $request)
    {
        $movie = Movie::create($request->all());
        $thumbFile = $request->file('thumbnail_file');
        $uploadDir = Movie::UPLOAD_DIR . $movie->id . '/';
        $fileName_thumbnail = Movie::THUMBNAIL_FILE_PREFIX . '_' . uniqid() . '.' . $thumbFile->getClientOriginalExtension();
        Storage::disk('public')->put($uploadDir . $fileName_thumbnail, file_get_contents($thumbFile->getPathname()));
        $movie->thumbnail_file = $fileName_thumbnail;
        $movieFile = $request->file('movie_file');
        $uploadDir = Movie::UPLOAD_DIR . $movie->id . '/';
        $fileName_movie = Movie::MOVIE_FILE_PREFIX . '_' . uniqid() . '.' . $movieFile->getClientOriginalExtension();
        Storage::disk('public')->put($uploadDir . $fileName_movie, file_get_contents($movieFile->getPathname()));
        $movie->movie_file = $fileName_movie;
        $movie->save();
        //dd($movie);
        return redirect()->route('movie.create.sale', [
        'id' => $movie->id
        ]);
    }
    public function createSaleForm($id)
    {
        return view('movie/create/sale', [
        'id' => $id
        ]);
    }

    public function createSale(UpdateMovieSaleRequest $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->fill($request->all())->save();

        return redirect()->route('movie.confirm.index', [
        'id' => $id,
        ]);
    }
    public function detail($id)
    {
        $movie = Movie::findOrFail($id);
        $days = $this->dayDiff($movie->end_date, $movie->start_date) + 1;
        //TODO
        return view('movie.detail.index', [
            'id' => $id,
            'movie' => $movie,
            'days' => $days,
            'open' => Movie::OPEN_STATUS,
            'uploadDir' => Movie::UPLOAD_DIR,
        ]);
    }

    public function confirm($id)
    {
        $movie = Movie::findOrFail($id);
        $days = $this->dayDiff($movie->end_date, $movie->start_date) + 1;
        //TODO
        return view('movie.confirm.index', [
            'id' => $id,
            'movie' => $movie,
            'days' => $days,
            'open' => Movie::OPEN_STATUS,
            'uploadDir' => Movie::UPLOAD_DIR,
        ]);
    }
    public function preview($id)
    {
        $movie = Movie::findOrFail($id);
        $days = $this->dayDiff($movie->end_date, $movie->start_date) + 1;
        //TODO
        return view('movie.preview.index', [
            'id' => $id,
            'movie' => $movie,
            'days' => $days,
            'open' => Movie::OPEN_STATUS,
            'uploadDir' => Movie::UPLOAD_DIR,
        ]);
    }

    private function dayDiff($day1, $day2)
    {
        $timestamp1 = strtotime($day1);
        $timestamp2 = strtotime($day2);
        $seconddiff = abs($timestamp2 - $timestamp1);
        $daydiff = $seconddiff / (60 * 60 * 24);
        return $daydiff;
    }

    public function open(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->status = $request->status;
        $movie->save();
        return redirect()->route('my.index');
    }

    public function delete($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->destroy($id);
        Storage::disk('public')->deleteDirectory(Movie::UPLOAD_DIR . $movie->id . '/');
        return back();
    }

    public function editForm($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movie/edit/index')
        ->with('id', $id)
        ->with('movie', $movie)
        ->with('uploadDir', Movie::UPLOAD_DIR);
    }
    public function edit(UpdateMovieRequest $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->fill($request->all())->save();

        // ファイル保存
        $uploadDir = Movie::UPLOAD_DIR . $movie->id . '/';
        if ($request->hasFile('thumbnail_file') && $request->file('thumbnail_file')->isValid()) {
            $thumbFile = $request->file('thumbnail_file');
            $fileName = Movie::THUMBNAIL_FILE_PREFIX . '_' . uniqid() . '.' . $thumbFile->getClientOriginalExtension();
            if (!empty($movie->thumbnail_file) && Storage::disk('public')->exists($uploadDir . $movie->thumbnail_file)) {
                Storage::disk('public')->delete($uploadDir . $movie->thumbnail_file);
            }
            Storage::disk('public')->put($uploadDir . $fileName, file_get_contents($thumbFile->getPathname()));
            $movie->thumbnail_file = $fileName;
        }
        if ($request->hasFile('movie_file') && $request->file('movie_file')->isValid()) {
            $thumbFile = $request->file('movie_file');
            $fileName = Movie::MOVIE_FILE_PREFIX . '_' . uniqid() . '.' . $thumbFile->getClientOriginalExtension();
            if (!empty($movie->movie_file) && Storage::disk('public')->exists($uploadDir . $movie->movie_file)) {
                Storage::disk('public')->delete($uploadDir . $movie->movie_file);
            }
            Storage::disk('public')->put($uploadDir . $fileName, file_get_contents($thumbFile->getPathname()));
            $movie->movie_file = $fileName;
        }
        $movie->title = $request->title;
        $movie->start_date = $request->start_date;
        $movie->end_date = $request->end_date;
        $movie->minutes = $request->minutes;
        $movie->product1 = $request->product1;
        $movie->price1 = $request->price1;
        $movie->product2 = $request->product2;
        $movie->price2 = $request->price2;
        $movie->save();

        return redirect()->route('movie.confirm.index', [
            'id' => $id,
            ]);
    }
}
