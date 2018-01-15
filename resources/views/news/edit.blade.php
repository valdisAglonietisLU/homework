@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form method="POST" action="{{url('/'.App::getLocale().'/news/edit/'.$item->id)}}" id="submitForm" >
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name">@lang('common.name')</label>
                                <input value="{{$item->name}}" type="text" class="form-control" name="name" aria-describedby="nameHelp" placeholder="@lang('common.enter_name')">
                            </div>

                            <div class="form-group">
                                <label for="content">@lang('common.content')</label>
                                <textarea class="form-control" name="content">{{$item->content}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="active">@lang('common.active')</label>
                                <input name="active" type="checkbox" {{$item->active?'checked':''}}>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="col-md-6 btn btn-block btn-success">@lang('common.submit')</button>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{url('/'.App::getLocale().'/news/show/'.$item->id)}}" class="btn btn-block">@lang('common.cancel')</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')

@endsection

@section('scripts')
    <script type="text/javascript" src="//cdn.ckeditor.com/4.8.0/full/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('content');
    </script>
@endsection
