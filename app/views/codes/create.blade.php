@extends('layouts.default')


@section('content')

<div class="col-lg-2"></div>
<div class="col-lg-8">
<form role="form"
          method="POST"
          action="{{{ URL::to('/codes') }}}"
          accept-charset="UTF-8"
          >
           <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
            <div class="form-group">
              <input required="required" class="form-control" tabindex="1" placeholder="Title" type="text" name="title" id="title" value="{{{ Input::old('title') }}}">
               @if($errors->first('title'))
                <div class="alert alert-danger">{{$errors->first('title')}}</div>
               @endif
            </div>
            <div class="form-group">
              <input required="required" class="form-control" tabindex="2" placeholder="file_name.php" type="text" name="name" id="name" value="{{{ Input::old('name') }}}">
             @if($errors->first('name'))
              <div class="alert alert-danger">{{$errors->first('name')}}</div>
             @endif
              <div class="help-block">
              Name your file. Make sure to include the ending file type.
              Use only characters, numbers and _
              </div>
            </div>
            <div class="form-group">
              <textarea
              class="form-control" rows="3"
              tabindex="3" placeholder="your code"
              name="code" id="code" value="{{ Input::old('code') }}" required="required">{{ Input::old('code') }}</textarea>
             @if($errors->first('code'))
              <div class="alert alert-danger">{{$errors->first('code')}}</div>
             @endif
            </div>
            <button type="submit" class="btn btn-success">Share Code</button>
</form>
</div>
<div class="col-lg-2"></div>

@stop