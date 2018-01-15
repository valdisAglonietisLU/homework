<div class="panel panel-default">
    <div class="panel-body">
        <div class="panel-title">
            @lang('common.comments')
        </div>

        <div class="panel-body">
            @if(isset($items) && count($items))
                @foreach($items as $item)
                    <div class="form-group">
                        <h3>{{$item->user->name}}: </h3>
                        {{$item->content}}<br>
                        {{$item->created_at}}
                    </div>
                @endforeach
            @else
                @lang('common.be_first_to_comment')
            @endif
        </div>
    </div>
</div>

@guest
@else
<div class="panel panel-default">
    <div class="panel-body">
        <div class="panel-body">
                    <form method="POST" action="{{route('news.comment',$id)}}" id="submitForm" >
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="comment">@lang('common.comment')</label>
                            <textarea class="form-control" name="comment"></textarea>
                        </div>

                        <button type="submit" class="btn btn-block btn-success">@lang('common.submit')</button>
                    </form>
        </div>
    </div>
</div>
@endguest