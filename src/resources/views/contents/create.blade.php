@extends('layouts.default')

@section('title', __('content.create'))

@section('content')

<div class="row justify-content-center">
    <div class="col-md-11">
        <div class="card">
            <div class="card-header"><b>{{ __('content.create') }}</b></div>
            <form method="POST" action="{{ route('contents.store') }}" accept-charset="UTF-8"
            enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group">
                    <label for="displayed" class="form-label">{{ __('content.displayed') }} <span
                        class="form-required">*</span></label>
                        <select id="displayed" class="form-control{{ $errors->has('displayed') ? ' is-invalid' : '' }}"
                            name="displayed" value="{{ old('displayed') }}" required>
                            <option selected value="1">{{ __('app.yes') }}</option>
                            <option value="0">{{ __('app.no') }}</option>
                        </select>
                        {!! $errors->first('displayed', '<span class="invalid-feedback" role="alert">:message</span>')
                        !!}
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text"
                            for="route">{{ __('content.content_type') }}</label>
                        </div>
                        <select class="custom-select" id="route" name="route">
                            <option selected>{{__('app.choose')}}</option>
                            @foreach ($routes as $route)
                            @if ($route->getname())
                            <option value="{{ $route->getname() }}">
                                {{ $route->uri() }}
                            </option>
                            @endif
                            
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('content.name') }} <span
                            class="form-required">*</span></label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                            name="name" value="{{ old('name') }}" required>
                            {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>
                        
                        <textarea class="description" name="description"></textarea>
                        
                        
                        
                        <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
                        {{-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> --}}

                        <script>
                            tinymce.init({
                                selector: 'textarea',
                                plugins: [
                                "advlist autolink lists link image charmap print preview anchor",
                                "searchreplace visualblocks code fullscreen",
                                "insertdatetime media table contextmenu paste imagetools"
                                ],
                                toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                                file_picker_types: 'image',
                                relative_urls: false,
                                image_class_list: [{
                                    title: 'None',
                                    value: ''
                                },
                                
                                {
                                    title: 'Responsive',
                                    value: 'img-responsive'
                                },
                                {
                                    title: 'Fluid',
                                    value: 'img-fluid'
                                },
                                ],
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
                    </div>
                    <div class="card-footer">
                        <input type="submit" value="{{ __('content.create') }}" class="btn btn-success">
                        <a href="{{ route('contents.index') }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    {{-- <script>
        ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
    </script> --}}
    
    {{-- @include('mceImageUpload::upload_form') --}}
    
    
    @endsection
    