@extends('layouts.default')

@section('content')
    <hr>
    <div class="container">
        <div class="row">
            @foreach($code as $item)
                <div class="col-md-6">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">{{$item->title}} <a href="/codes/{{$item->id}}" class="pull-right"><i class="glyphicon glyphicon-align-left"></i>&nbsp;view</a></h3>
                      </div>
                      <div class="panel-body">
                        <script src="https://gist.github.com/{{$account}}/{{$item->gist_id}}.js"></script>
                      </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@stop