<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateMovieRequest;
use App\Http\Requests\UpdateMovieSaleRequest;
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
        dd('edit');
        $movie = Movie::findOrFail($id);
        return view('movie/edit')
        ->with('movie', $movie)
        ->with('uploadDir', Movie::UPLOAD_DIR);
    }
}
