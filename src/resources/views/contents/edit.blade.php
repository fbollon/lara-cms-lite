@extends('layouts.default')

@section('title', __('content.edit'))

@section('content')

<script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>

<div class="row justify-content-center">
    <div class="col-md-10">
        @if (request('action') == 'delete' && $content)
        @can('delete', $content)
        <div class="card">
            <h5 class="card-header">{{ __('content.delete') }}</h5>
            <div class="card-body">
                <table class="table table-sm table-hover">
                    <tbody>
                        <tr>
                            <td>{{ __('content.creator') }}</td>
                            <td><b>{{ $content->user->username }}</b></td>
                        </tr>
                        <tr>
                            <td>{{ __('content.displayed') }}</td>
                            <td>{{ $content->displayed }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('app.created') }}</td>
                            <td>{{ $content->created_at }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('app.created') }}</td>
                            <td>{{ $content->updated_at }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('content.description') }}</td>
                            <td>
                                <p>{!! $content->description !!}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                {!! $errors->first('content_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
            </div>
            <hr style="margin:0">
            <div class="card-body text-danger">{{ __('content.delete_confirm') }}</div>
            <div class="card-footer">
                <form method="POST" action="{{ route('contents.destroy', $content) }}" accept-charset="UTF-8"
                    onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right"
                    style="display: inline;">
                    {{ csrf_field() }} {{ method_field('delete') }}
                    <input name="content_id" type="hidden" value="{{ $content->id }}">
                    <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
                </form>
                <a href="{{ route('contents.edit', $content) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
            </div>
        </div>
        @endcan
        @else
        <div class="card">
            <div class="card-header">{{ __('content.edit') }}</div>
            <form method="POST" action="{{ route('contents.update', $content) }}" accept-charset="UTF-8">
                {{ csrf_field() }} {{ method_field('patch') }}
                <div class="card-body">
                    <div class="form-group row">
                        <label for="redactor" class="col-sm-4 col-form-label">{{ __('content.creator') }}</label>
                        <div class="col-sm-8">
                            <input disabled id="redactor" type="text"
                                class="form-control{{ $errors->has('redactor') ? ' is-invalid' : '' }}" name="redactor"
                                value="{{ old('redactor', $content->user->username) }}">
                            {!! $errors->first('redactor', '<span class="invalid-feedback"
                                role="alert">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="displayed" class="col-sm-4 col-form-label">{{ __('content.displayed') }}</label>
                        <div class="col-sm-8">
                            <select id="displayed" name="displayed" class="custom-select" required>
                                <option value="1" {{ $content->displayed ? 'selected' : '' }}>{{ __('app.yes') }}</option>
                                <option value="0" {{ $content->displayed == 0 ? 'selected' : '' }}>{{ __('app.no') }}
                                </option>
                            </select>
                            {!! $errors->first('displayed', '<span class="invalid-feedback"
                                role="alert">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="created_at" class="col-sm-4 col-form-label">{{ __('app.created') }}</label>
                        <div class="col-sm-8">
                            <input disabled id="created_at" type="text"
                                class="form-control{{ $errors->has('created_at') ? ' is-invalid' : '' }}"
                                name="created_at" value="{{ old('created_at', $content->created_at) }}">
                            {!! $errors->first('created_at', '<span class="invalid-feedback"
                                role="alert">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="updated_at" class="col-sm-4 col-form-label">{{ __('app.updated') }}</label>
                        <div class="col-sm-8">
                            <input disabled id="updated_at" type="text"
                                class="form-control{{ $errors->has('updated_at') ? ' is-invalid' : '' }}"
                                name="updated_at" value="{{ old('updated_at', $content->updated_at) }}">
                            {!! $errors->first('updated_at', '<span class="invalid-feedback"
                                role="alert">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('content.name') }} <span class="form-required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                            value="{{ old('name', $content->name) }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="route">{{ __('content.route') }}</label>
                        </div>
                        <select class="custom-select" id="route" name="route">
                            <option>{{__('app.choose')}}</option>
                            {{-- @foreach ($content_types as $key => $value)
                            <option value="{{ $key }}"" {{ ( $key == $content->content_type_id) ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach --}}

                            @foreach ($routes as $route)
                            @if ($route->getname())
                            <option value="{{ $route->getname() }}" {{ ( $route->getname() == $content->route) ? 'selected' : '' }}>
                                {{ $route->uri() }}
                            </option>
                            @endif
                            
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label"><b>{{ __('content.description') }}</b></label>
                        <textarea id="editor" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                            name="description" rows="4">{{ old('description', $content->description) }}</textarea>
                        {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>')
                        !!}
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('content.update') }}" class="btn btn-success">
                    <a href="{{ route('contents.show', $content) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                    @can('delete', $content)
                    <a href="{{ route('contents.edit', [$content, 'action' => 'delete']) }}" id="del-content-{{ $content->id }}"
                        class="btn btn-danger float-right">{{ __('app.delete') }}</a>
                    @endcan
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    tinymce.init({
        selector: 'textarea',
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste imagetools",
            // "jsplusInclude jsplusBootstrapTools"       
        ],
        toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        file_picker_types: 'image',
        relative_urls: false,
        image_class_list: [
                {title: 'None', value: ''},
                // {title: 'Responsive', value: 'card-img-top embed-responsive-item'},
                {title: 'Responsive', value: 'img-responsive'},
                {title: 'Fluid', value: 'img-fluid'},
                ],
        image_caption: false,                
        images_upload_handler: function (blobInfo, success, failure) {
            let data = new FormData();
            data.append('file', blobInfo.blob(), blobInfo.filename());
            axios.post('{{url("/file-upload")}}', data)
            .then(function (res) {
            success(res.data.location);
        })
        .catch(function (err) {
            failure('HTTP Error: ' + err.message);
        });
        }

    });

</script>
@endif

@endsection
