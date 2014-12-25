@extends('layouts.default')

@include('layouts.banner')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-12">
                <hr>
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">{{$code->title}}</h3>
                  </div>
                  <div class="panel-body">
                    <script src="https://gist.github.com/{{$account}}/{{$code->gist_id}}.js"></script>
                  </div>
                </div>
            </div>
    </div>
</div>
@stop