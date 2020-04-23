
@if(!empty($contents))
<div class="card-body">{{ $contents->appends(Request::except('page'))->render() }}</div>
@foreach ($contents as $content)
<div class="card">
    <div class="card-header">
        {!! $content->name !!}
    </div>
    <div class="card-body">
        <blockquote class="blockquote mb-0">
            {!! $content->description !!}
            <footer class="blockquote-footer">{{$content->created_at}} <cite title="Source Title">by {{$content->creator}}</cite></footer>
        </blockquote>
    </div>
</div>

@endforeach
<div class="card-body">{{ $contents->appends(Request::except('page'))->render() }}</div>
@endif
