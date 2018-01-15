@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form method="POST" action="{{url('/'.App::getLocale().'/profile/update/')}}" id="submitForm" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name">@lang('common.name')</label>
                                <input value="{{$item->name}}" type="text" class="form-control" name="name" aria-describedby="nameHelp" placeholder="@lang('common.enter_name')">
                            </div>

                            <div class="form-group">
                                <label for="name">@lang('common.image')</label>
                                <input type="file" name="image" id="fileToUpload" onchange="changeImage(this.value)">
                                <div class="image_container" >
                                    <img id="imageViewer" class="image" src="{{url($item->image)}}">
                                </div>
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
<script>
    function changeImage(image){
        var imageViewer = document.getElementById("imageViewer");
        imageViewer.setAttribute("src", image);
        alert(JSON.stringify(image));
    }
</script>

@endsection
