@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form method="POST" action="{{route('news.store')}}" id="submitForm" >
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name">@lang('common.name')</label>
                                <input type="text" class="form-control" name="name" aria-describedby="nameHelp" placeholder="@lang('common.enter_name')">
                            </div>
                            <div class="form-group">
                                <label for="content">@lang('common.content')</label>
                                <textarea class="form-control" name="content"></textarea>
                            </div>

                            <button type="submit" class="btn btn-block btn-success">@lang('common.submit')</button>
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
