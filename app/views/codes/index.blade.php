@extends('layouts.default')


@section('content')

        <div class="row">

    @foreach($code as $item)

            <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">{{$item->title}}</h3>
              </div>
              <div class="panel-body">
                <script src="https://gist.github.com/{{$account}}/{{$item->gist_id}}.js"></script>
                <div class="row">
                    <a href="/codes/{{$code->id}}" class="btn btn-warning">view</a>
                </div>
              </div>
            </div>
            </div>

    @endforeach
    </div>

@stop