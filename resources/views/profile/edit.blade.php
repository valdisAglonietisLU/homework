@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form method="POST" action="{{url('/'.App::getLocale().'/profile/edit/')}}" id="submitForm" >
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name">@lang('common.name')</label>
                                <input value="{{$item->name}}" type="text" class="form-control" name="name" aria-describedby="nameHelp" placeholder="@lang('common.enter_name')">
                            </div>

                            <div class="form-group">
                                <label for="email">@lang('common.email')</label>
                                <input type="email" value="{{$item->email}}" class="form-control" name="email">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="col-md-6 btn btn-block btn-success">@lang('common.submit')</button>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{url('/'.App::getLocale().'/profile/')}}" class="btn btn-block grey">@lang('common.cancel')</a>
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
@endsection
