@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-offset-3 col-md-6">
            <nav class="panel panel-default">
                <div class="panel-heading"></div>
                <table class="table">
                    {{Auth::user()->store_flg}}
                    <thead>
                        <tr>
                            <th scope="col">サムネイル</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($movies as $movie)
                        <tr>
                            <td>
                                <video height="100px" controls src="{{ cdn('storage'.$uploadDir.$movie->id.'/'.$movie->movie_file) }}"></video>
                            </td>
                            <td>
                                <span class="label {{ $movie->status_class }}">{{ $movie->status_label }}</span>
                            </td>
                            <td>
                                <a href="{{ route('movie.preview.index', $movie->id) }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-xs">プレビュー</a>
                            </td>
                            <td>
                                <a href="{{ route('movie.edit.index', $movie->id) }}" class="btn btn-primary btn-xs">編集</a>
                            </td>
                            <td>
                                {!! Form::open(['route' => ['movie.delete', 'id' => $movie->id], 'method' => 'delete'])
                                !!}
                                <button type="submit" class="btn btn-primary btn-xs btn_del">削除</button>
                                {!! Form::close() !!}
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </nav>
            {{-- {!! $posts->links() !!} --}}
        </div>
        <!-- </div> -->
    </div>
    @endsection