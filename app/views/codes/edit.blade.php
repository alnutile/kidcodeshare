@extends('layouts.default')


@section('content')

<div class="col-lg-2"></div>
<div class="col-lg-8">
{{ Form::open(array('url' => 'codes/' . $code->id, 'method' => 'put')) }}
    <div class="form-group">
    {{Form::label('title', 'Code Share Title')}}
        {{ Form::text('title', $code->title, array('class' => 'form-control')) }}
        @if($errors->first('title'))
         <div class="alert alert-danger">{{$errors->first('title')}}</div>
        @endif
    </div>
    <div class="form-group">
    {{Form::label('code', 'Code')}}
        {{ Form::textarea('code', $gist['content'], array('class' => 'form-control')) }}
        @if($errors->first('code'))
            <div class="alert alert-danger">{{$errors->first('code')}}</div>
        @endif
    </div>
    {{ Form::hidden('name', $gist['filename']) }}

    {{ Form::submit('Update Code', array('class' => 'btn btn-warning')); }}
{{ Form::close() }}

</div>
<div class="col-lg-2"></div>

@stop