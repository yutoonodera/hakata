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
          <div class="panel-heading">登録する（１/２）</div>
          <div class="panel-body">
            @if($errors->any())
              {{-- <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div> --}}
            @endif
            {!! Form::open(['route' => ['movie.create.file'],'enctype'=>'multipart/form-data'])
            !!}
              @csrf
              <div class="form-group">
                <label for="start_date">動画（必須）</label>
                {!! Form::file('movie_file') !!}
                @if ($errors->has('movie_file'))
                <p class="text-danger">{{$errors->first('movie_file')}}</p>
                @endif
               </div>
              <div class="form-group">
                <label for="start_date">サムネイル</label>
              {!! Form::file('thumbnail_file') !!}
              @if ($errors->has('thumbnail_file'))<p class="text-danger">{{
                  $errors->first('thumbnail_file')
                  }}</p>@endif
             </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">登録する</button>
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