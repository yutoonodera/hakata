@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-offset-3 col-md-6">
            <nav class="panel panel-default">
                <div class="panel-heading"></div>
                <table class="table">
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
                             公開
                            </td>
                            <td>
                                <a href="{{ route('movie.edit', $movie->id) }}" class="btn btn-primary btn-xs">プレビュー</a>
                            </td>
                            <td>
                                <a href="{{ route('movie.edit', $movie->id) }}" class="btn btn-primary btn-xs">編集</a>
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