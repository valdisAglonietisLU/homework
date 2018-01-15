@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="panel-title">
                            <h2>{{$item->name}}</h2>
                            @guest

                            @else
                                <a href="{{url(route($this->view.'edit',$item->id))}}">@lang('common.edit')</a>
                                <a href="{{url(route($this->view.'delete',$item->id))}}">@lang('common.delete')</a>
                            @endif
                        </div>

                        <div class="panel-body">
                            {!! $item->content !!}
                        </div>
                    </div>
                </div>
                    @include('common.comments',['items' => $item->comments,'id' => $item->id])
            </div>
        </div>
    </div>
@endsection

@section('css')

@endsection

@section('scripts')
@endsection
