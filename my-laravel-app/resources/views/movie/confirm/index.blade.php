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
          <div class="panel-heading">公開前の確認</div>
          <div class="panel-body">
            @if($errors->any())
              {{-- <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div> --}}
            @endif
              @csrf
              <div class="form-group">
                <video poster="{{ cdn('storage'.$uploadDir.$movie->id.'/'.$movie->thumbnail_file) }}" height="400px" controls src="{{ cdn('storage'.$uploadDir.$movie->id.'/'.$movie->movie_file) }}"></video>
                <h4>{{$movie->title}}</h4>
                <p>{{$movie->product1}}{{$movie->price1}}</p>
                <p>{{$movie->product2}}{{$movie->price2}}</p><br><br>

               ※公開予定 {{$movie->start_date}} {{$movie->minutes}} 〜 {{$movie->end_date}} {{$movie->minutes}}（{{$days}}日間）<br><br><br>
              </div>
              <div class="text-right">
                {!!  Form::open(['route' => ['movie.confirm.index','id' => $movie->id],'enctype'=>'multipart/form-data'])
                !!} 
                <input type="hidden" name="id" value={{$movie->id}}>
                <input type="hidden" name="status" value={{$open}}>
                <button type="submit" class="btn btn-primary">公開予約する</button>
                {!! Form::close() !!}
              </div>
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