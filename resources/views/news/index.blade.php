@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul id="nav-tabs-wrapper" class="nav nav-tabs nav-pills nav-stacked wells">
                            @if(isset($items) && count($items))
                                @foreach($items as $item)
                                    <li>
                                        <h2>
                                            <a href="{{url("/".App::getLocale()."/news/show/$item->id")}}">
                                                {{$item->name}} <i class="red">{{$item->deleted?Lang::get('common.deleted'):''}}</i>
                                            </a>
                                            <a href="{{url("/".App::getLocale()."/news/show/$item->id")}}">@lang('common.renew')</a>
                                        </h2>
                                        <p>@lang('common.published'): {{$item->created_at}}</p>
                                    </li>
                                @endforeach
                            @else
                                <li>
                                    <p class=" btn btn-block">@lang('common.nothing_to_display')</p>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <style>
        .red{
            color:red;
        }
    </style>
@endsection

@section('scripts')

@endsection
