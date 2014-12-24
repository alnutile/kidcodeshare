<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>KidCodeShare.io</title>
    <!-- Bootstrap core CSS -->
    <link href="/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/bower_components/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="/assets/app.css" rel="stylesheet">

</head>
<body>

@include('layouts.nav')

@if(Request::is('/'))
  @include('layouts.banner')
@endif

<div class="container">
      <!-- Example row of columns -->
      <div class="row">
        @if (Session::get('notice'))
            <div class="alert alert-success">{{ Session::get('notice') }}</div>
        @endif
      </div>
      <div class="row">
        @yield('content')
      </div>
      <hr>
      <footer>
          <ul class="nav nav-pills">
            <li><a href="/users/create"><i class="glyphicon glyphicon-user">&nbsp;</i>about</a></li>
            @if(Auth::guest())
              <li><a href="/users/create"><i class="glyphicon glyphicon-user">&nbsp;</i>sign up</a></li>
              <li><a href="/users/login"><i class="glyphicon glyphicon-user">&nbsp;</i>log in</a></li>
            @endif
          </ul>
      </footer>
</div>

</body>

    <script src="/bower_components/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
</html>
