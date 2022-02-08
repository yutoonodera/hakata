@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-4">
        {{-- <nav class="panel panel-default"> --}}
          {{-- <div class="panel-heading">Eat Show</div> --}}
           {{-- <div class="list-group"> --}}
            @foreach($movies as $movie)
              {{-- <a href="{{ route('top.index', ['id' => $movie->id]) }}" class="list-group-item"> --}}
              @if ($movie->movie_file)
              <!-- posterでサムネイル指定 -->
              <video width="500" height="500" controls src="{{ cdn('storage'.$uploadDir.$movie->id.'/'.$movie->movie_file) }}"></video>
              @endif
              <a href="{{ route('movie.detail.index', $movie->id) }}" class="text-muted"> <h4>{{$movie->title}}</h4></a>
            @endforeach
            
          {{-- </div>
        </nav>
      </div> --}}
      <div class="column col-md-8">
        <!-- ここにタスクが表示される -->
      </div>
    </div>
  </div>
@endsection