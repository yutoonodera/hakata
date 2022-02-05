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
          <div class="panel-heading">登録する（２/２）</div>
          <div class="panel-body">
            @if($errors->any())
              {{-- <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div> --}}
            @endif
            {!! Form::open(['route' => ['movie.create.sale','id' => $id],'enctype'=>'multipart/form-data', 'method' => 'post'])
            !!}
              @csrf
              <div class="form-group">
                <label for="minutes">タイトル</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" />
                @if ($errors->has('title'))
                <p class="text-danger">{{$errors->first('title')}}</p>
                @endif
              </div>
             <div class="form-group">
              <label for="start_date">公開開始</label>
              <input type="text" class="form-control" name="start_date" id="start_date" value="{{ old('start_date') }}" />
              @if ($errors->has('start_date'))
              <p class="text-danger">{{$errors->first('start_date')}}</p>
              @endif
            </div>
            <div class="form-group">
              <label for="end_date">公開終了</label>
              <input type="text" class="form-control" name="end_date" id="end_date" value="{{ old('end_date') }}" />
              @if ($errors->has('end_date'))
              <p class="text-danger">{{$errors->first('end_date')}}</p>
              @endif
            </div>
            <div class="form-group">
              <label for="minutes">公開時間</label>
              <input type="text" class="form-control" name="minutes" id="minutes" value="{{ old('minutes') }}" />
              @if ($errors->has('minutes'))
              <p class="text-danger">{{$errors->first('minutes')}}</p>
              @endif
            </div>
            <div class="form-group">
              <label for="product1">商品１</label>
              <input type="text" class="form-control" name="product1" id="product1" value="{{ old('product1') }}" />
              @if ($errors->has('product1'))
              <p class="text-danger">{{$errors->first('product1')}}</p>
              @endif
            </div>
            <div class="form-group">
              <label for="price1">商品１の価格</label>
              <input type="text" class="form-control" name="price1" id="price1" value="{{ old('price1') }}" />
              @if ($errors->has('price1'))
              <p class="text-danger">{{$errors->first('price1')}}</p>
              @endif
            </div>
            <div class="form-group">
              <label for="product2">商品２</label>
              <input type="text" class="form-control" name="product2" id="product2" value="{{ old('product2') }}" />
              @if ($errors->has('product2'))
              <p class="text-danger">{{$errors->first('product2')}}</p>
              @endif
            </div>
            <div class="form-group">
              <label for="price2">商品２の価格</label>
              <input type="text" class="form-control" name="price2" id="price2" value="{{ old('price2') }}" />
              @if ($errors->has('price2'))
              <p class="text-danger">{{$errors->first('price2')}}</p>
              @endif
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