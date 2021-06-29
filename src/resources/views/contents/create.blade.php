@extends('layouts.default')

@section('title', __('content.create'))

@section('content')

<div class="row justify-content-center">
    <div class="col-md-11">
        <div class="card">
            <div class="card-header"><b>{{ __('lara-cms-lite::content.create') }}</b></div>
            <form method="POST" action="{{ route('contents.store') }}" accept-charset="UTF-8"
            enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group row">
                    <label for="display_title" class="col-sm-4 col-form-label">{{ __('lara-cms-lite::content.displayed') }} </label>
                        <div class="col-sm-8">
                        {{-- <select id="displayed" class="form-control{{ $errors->has('displayed') ? ' is-invalid' : '' }}"
                            name="displayed" value="{{ old('displayed') }}" required> --}}
                        <select id="displayed" name="displayed" class="custom-select" required>
                            <option selected value="1">{{ __('lara-cms-lite::content.yes') }}</option>
                            <option value="0">{{ __('lara-cms-lite::content.no') }}</option>
                        </select>
                        {!! $errors->first('displayed', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="display_title" class="col-sm-4 col-form-label">{{ __('lara-cms-lite::content.display_title') }}</label>
                        <div class="col-sm-8">
                            <select id="display_title" name="display_title" class="custom-select" required>
                                <option selected value="1">{{ __('lara-cms-lite::content.yes') }}
                                </option>
                                <option value="0">{{ __('lara-cms-lite::content.no') }}
                                </option>
                            </select>
                            {!! $errors->first('display_title', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="display_footer"
                        class="col-sm-4 col-form-label">{{ __('lara-cms-lite::content.display_footer') }}</label>
                        <div class="col-sm-8">
                            <select id="display_footer" name="display_footer" class="custom-select" required>
                                <option selected value="1">{{ __('lara-cms-lite::content.yes') }}
                                </option>
                                <option value="0">
                                    {{ __('lara-cms-lite::content.no') }}
                                </option>
                            </select>
                            {!! $errors->first('display_footer', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text"
                            for="route">{{ __('lara-cms-lite::content.route') }}</label>
                        </div>
                        <select class="custom-select" id="route" name="route">
                            <option selected>{{__('lara-cms-lite::content.select')}}</option>
                            @foreach ($routes as $route)
                            @if ($route->getname())
                            <option value="{{ $route->getname() }}">
                                {{ $route->uri() }}
                            </option>
                            @endif

                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="weight" class="col-sm-4 col-form-label">{{ __('lara-cms-lite::content.weight') }} </label>
                        <div class="col-sm-8">
                            <input id="weight" type="integer"
                                class="form-control{{ $errors->has('weight') ? ' is-invalid' : '' }}" name="weight"
                                value="{{ old('weight', 0) }}">
                            {!! $errors->first('weight', '<span class="invalid-feedback" role="alert">:message</span>')
                            !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('lara-cms-lite::content.name') }} <span
                            class="form-required">*</span></label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                            name="name" value="{{ old('name') }}" required>
                            {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>

                        <textarea class="description" name="description"></textarea>

                    </div>
                    <div class="card-footer">
                        <input type="submit" value="{{ __('lara-cms-lite::content.create') }}" class="btn btn-success">
                        <a href="{{ route('contents.index') }}" class="btn btn-link">{{ __('lara-cms-lite::content.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @endsection

    @section('scripts')
    <script src="{{ asset(config('lara-cms-lite.tinymce_url')) }}"></script>

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

    @endsection
