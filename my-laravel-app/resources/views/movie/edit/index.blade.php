@extends('layout')

@section('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
  @endsection

  @section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">編集する</div>
          <div class="panel-body">
              @csrf
              {!! Form::open(['route' => ['movie.edit.index','id' => $movie->id],'enctype'=>'multipart/form-data'])
              !!}
                @csrf
                <div class="form-group">
                  <label for="movie_file">動画（必須）</label>
                  {!! Form::file('movie_file') !!}
                  @if ($movie->thumbnail_file)
                  <video height="400px" controls src="{{ cdn('storage'.$uploadDir.$movie->id.'/'.$movie->movie_file) }}"></video>
                  <br>@endif
                  @if ($errors->has('movie_file'))
                  <p class="text-danger">{{$errors->first('movie_file')}}</p>
                  @endif
                  <label for="thumbnail_file">サムネイル</label>
                  {!! Form::file('thumbnail_file') !!}
                  @if ($movie->thumbnail_file)
                  <img src="{{ cdn('storage'.$uploadDir.$movie->id.'/'.$movie->thumbnail_file) }}" alt="" style="max-width:100%;">
                  <br>@endif
                  @if ($errors->has('thumbnail_file'))
                  <p class="text-danger">{{$errors->first('thumbnail_file')}}</p>
                  @endif
                  <label for="title">タイトル</label>
                  {!! Form::text('title', $movie->title, ['class' => 'form-control','id' => 'title']) !!}
                  @if ($errors->has('title'))<p class="text-danger">{{ $errors->first('title') }}</p>
                  @endif
                  <label for="start_date">公開開始</label>
                  {!! Form::text('start_date', $movie->start_date, ['class' => 'form-control','id' => 'start_date']) !!}
                  @if ($errors->has('start_date'))<p class="text-danger">{{ $errors->first('start_date') }}</p>
                  @endif
                  <label for="end_date">公開終了</label>
                  {!! Form::text('end_date', $movie->end_date, ['class' => 'form-control','id' => 'end_date']) !!}
                  @if ($errors->has('end_date'))<p class="text-danger">{{ $errors->first('end_date') }}</p>
                  @endif
                  <label for="title">公開時間</label>
                  {!! Form::text('minutes', $movie->minutes, ['class' => 'form-control','id' => 'minutes']) !!}
                  @if ($errors->has('minutes'))<p class="text-danger">{{ $errors->first('minutes') }}</p>
                  @endif
                  <label for="title">商品1</label>
                  {!! Form::text('product1', $movie->product1, ['class' => 'form-control','id' => 'product1']) !!}
                  @if ($errors->has('product1'))<p class="text-danger">{{ $errors->first('product1') }}</p>
                  @endif
                  <label for="title">商品１の価格</label>
                  {!! Form::text('price1', $movie->price1, ['class' => 'form-control','id' => 'price1']) !!}
                  @if ($errors->has('price1'))<p class="text-danger">{{ $errors->first('price1') }}</p>
                  @endif
                  <label for="title">商品2</label>
                  {!! Form::text('product2', $movie->product2, ['class' => 'form-control','id' => 'product2']) !!}
                  @if ($errors->has('product2'))<p class="text-danger">{{ $errors->first('product2') }}</p>
                  @endif
                  <label for="title">商品2の価格</label>
                  {!! Form::text('price2', $movie->price1, ['class' => 'form-control','id' => 'price2']) !!}
                  @if ($errors->has('price2'))<p class="text-danger">{{ $errors->first('price2') }}</p>
                  @endif

               </div>
                <div class="text-right">
                  <button type="submit" class="btn btn-primary">更新する</button>
                </div>
              {!! Form::close() !!}
          </div>
        </nav>
      </div>
    </div>
  </div>
  @endsection
@section('scripts')
    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
    <script>
      flatpickr(document.getElementById('start_date'), {
        locale: 'ja',
        dateFormat: "Y/m/d",
        minDate: new Date()
      });
      flatpickr(document.getElementById('end_date'), {
        locale: 'ja',
        dateFormat: "Y/m/d",
        minDate: new Date()
      });
      flatpickr(document.getElementById('minutes'), {
        locale: 'ja',
        enableTime: true,   // 時間の選択可否
        noCalendar: true,   // カレンダー非表示
        dateFormat: "H:i",  
        time_24hr: true
      });
    </script>
@endsection