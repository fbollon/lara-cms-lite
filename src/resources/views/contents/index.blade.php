@extends(config('lara-cms-lite.layout'))

@section('content')

<div class="mb-3">
    <div class="float-right">
        <a href="{{ route('contents.create') }}" class="btn btn-success">{{ __('lara-cms-lite::content.create') }}</a>
    </div>
    <h1 class="page-title">{{ __('lara-cms-lite::content.list') }} <small>{{ __('app.total') }} : {{ $contentsList->total() }} {{ __('lara-cms-lite::content.content') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">{{ __('lara-cms-lite::content.search') }}</label>
                        <input placeholder="{{ __('lara-cms-lite::content.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('lara-cms-lite::content.search') }}" class="btn btn-secondary">
                    <a href="{{ route('contents.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th>{{ __('lara-cms-lite::content.name') }}</th>
                        <th>{{ __('lara-cms-lite::content.route') }}</th>
                        <th>{{ __('lara-cms-lite::content.description') }}</th>
                        <th>{{ __('lara-cms-lite::content.displayed') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contentsList as $key => $content)
                    <tr class='table-row' data-href="{{ route('contents.show', $content) }}">    
                        <td>{!! $content->name_link !!}</td>
                        <td>{{ $content->route }}</td>
                        <td>{{ html_entity_decode(strip_tags(\Illuminate\Support\Str::limit($content->description, 60, $end='...'))) }}</td>
                        <td>{{ $content->displayed ? __('lara-cms-lite::content.yes') : __('lara-cms-lite::content.no') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $contentsList->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function($) {
        $(".table-row").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>

@endsection