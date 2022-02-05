<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Eat Show</title>
  @yield('styles')
  <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<header>
  <nav class="my-navbar">
    <a class="my-navbar-brand" href="/">Eat Show</a>
    <div class="my-navbar-control">
      <li><a href="{{ route('movie.create.file') }}">動画を投稿する</a></li>
    </div>
  </nav>
</header>
<main>
  @yield('content')
</main>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="{{ asset('/js/common.js') }}"></script>
@yield('scripts')
</body>
</html>