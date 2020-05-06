
@if(!empty($contents))
<div class="card-body">{{ $contents->appends(Request::except('page'))->render() }}</div>
@foreach ($contents as $content)
<div class="card">
    @if ($content->display_title)
    <div class="card-header">
        {!! $content->name !!}
    </div>        
    @endif
    <div class="card-body">
        <blockquote class="blockquote mb-0">
            {!! $content->description !!}
            @if ($content->display_footer)
            <footer class="blockquote-footer">{{$content->created_at}} <cite title="Source Title">by
                {{$content->getUserDisplayName()}}</cite></footer>                
                @endif
            </blockquote>
        </div>
    </div>
    
    @endforeach
    <div class="card-body">{{ $contents->appends(Request::except('page'))->render() }}</div>
    @endif
    