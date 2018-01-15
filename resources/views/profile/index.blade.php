@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    @if(isset($item))
                        <div class="panel-title">
                            <h2 class="profile-header">@lang('common.user'): <a href="{{url('/'.App::getLocale().'/profile/edit/')}}">{{$item->name}}</a></h2>
                            <h3 class="profile-header">@lang('common.email'): {{$item->email}}</h3>
                        </div>
                        <div class="panel-body">
                            <h4>@lang('common.comments')</h4>
                            @foreach($item->comments as $comment)
                                <div class="form-group">
                                    <h5>{{$comment->news->name}}</h5> {{$comment->created_at}}
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <style>
        .profile-header{
            margin-left:20px;
        }
    </style>
@endsection

@section('scripts')

@endsection
