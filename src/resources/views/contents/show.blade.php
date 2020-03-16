@extends('layouts.default')

@section('title', __('content.detail'))

@section('content')

@php
    // dd($content);
@endphp


<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">{{ __('content.detail') }}</div>
            <div class="card-body">
                <table class="table table-sm table-hover">
                    <tbody>
                        <tr>
                            <td style="width: 25%">{{ __('content.creator') }}</td>
                            <td>{{ $content->user->username }}</td>
                        </tr>
                        <tr>
                            <td style="width: 25%">{{ __('content.displayed') }}</td>
                            <td>{{ $content->displayed ? __('app.yes') : __('app.no') }}</td>
                        </tr>
                        <tr>
                            <td style="width: 25%">{{ __('app.created') }}</td>
                            <td>{{ $content->created_at }}</td>
                        </tr>
                        <tr>
                            <td style="width: 25%">{{ __('app.updated') }}</td>
                            <td>{{ $content->updated_at }}</td>
                        </tr>
                        <tr>
                            <td style="width: 25%">{{ __('content.name') }}</td>
                            <td>{{ $content->name }}</td>
                        </tr>
                    </tbody>
                </table>

                <div>
                    {{-- <div class="embed-responsive embed-responsive-16by9"> --}}
                    {!! $content->description !!}
                </div>
            </div>



            <div class="collapse" id="collapseExample">
                <div class="card card-body">

                    <div class="container">
                        <div class="row">
                            <h5>Attach file</h5>
                            {!! Form::open(['route' => ['contents.upload', $content], 'files' => true]) !!}
                            <div class="input-group mb-3 ml-2">
                                <div class="input-group-prepend mb-3">
                                    <span class="input-group-text">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="newFile"
                                        class="custom-file-input {{$errors->first('newFile')?'is-invalid':''}}"
                                        id="inputGroupFile01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>

                                </div>
                                @error('newFile')
                                {{ $message }}
                                @enderror
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Title</span>
                                    </div>
                                    <input name="fileTitle"
                                        class="form-control {{$errors->first('fileTitle')?'is-invalid':''}}"
                                        aria-label="Title">
                                    @if($errors->has('fileTitle'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('fileTitle')}}
                                    </div>
                                    @endif
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Description</span>
                                    </div>
                                    <textarea name="fileDescription"
                                        class="form-control {{$errors->first('fileDescription')?'is-invalid':''}}"
                                        aria-label="Description"></textarea>
                                    @if($errors->has('fileDescription'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('fileDescription')}}
                                    </div>
                                    @endif
                                </div>
                                <input type="submit" value="Upload" class="btn btn-success ml-4">
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

            {{-- https://medium.com/@diegovogel/create-a-lightbox-gallery-with-standard-bootstrap-components-b9de322ddb9e --}}
            <!-- Gallery -->
            <!-- 
    Gallery is linked to lightbox using data attributes.
    
    To open lightbox, this is added to the gallery element: {data-toggle="modal" data-target="#exampleModal"}.
    
    To open carousel on correct image, this is added to each image element: {data-target="#carouselExample" data-slide-to="0"}.
    Replace '0' with corresponding slide number.
-->

            <div class="row" id="gallery" data-toggle="modal" data-target="#exampleModal">

                @foreach ($mediaItems as $item)
                <div class="col-6 col-md-4 col-lg-3">
                    <img class="w-100 img-thumbnail" src="{{asset($item->getUrl('thumb'))}}"
                        data-target=”#carouselExample” data-slide-to="{{$loop->iteration}}">
                </div>
                @endforeach
            </div>

            <!-- Modal -->
            <!-- 
    This part is straight out of Bootstrap docs. Just a carousel inside a modal.
-->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="carouselExample" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @foreach ($mediaItems as $item)
                                    <li data-target="#carouselExample" data-slide-to="{{$loop->iteration}}"
                                        {{($loop->iteration == 1)?' class=\"active\"':''}}></li>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    @foreach ($mediaItems as $item)
                                    <div class="carousel-item {{($loop->iteration == 1)?'active':''}}">
                                        <img class="d-block w-100" src="{{asset($item->getUrl())}}">
                                        <h4>Titre : {{$item->getCustomProperty('title')}}</h4>
                                        <span class="mr-4">Description :
                                            {{$item->getCustomProperty('description')}}</span>
                                    </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselExample" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExample" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- https://medium.com/@diegovogel/create-a-lightbox-gallery-with-standard-bootstrap-components-b9de322ddb9e --}}

            <!-- Modal removeFiles -->
            <div class="modal fade" id="removeFiles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{route('contents.removeFile')}}">
                                @csrf
                                <input name="content_id" type="hidden" value="{{ $content->id }}" accept-charset="UTF-8"
                                    onsubmit="return confirm(&quot;{{ __('app.delete_files_confirm') }}&quot;)" class="del-form
                    float-right" style="display: inline;">

                                @foreach ($mediaItems as $item)
                                <a><img src="{{asset($item->getUrl('thumb'))}}" alt="..."
                                        class="img-thumbnail img-fluid z-depth-1" data-toggle="modal"
                                        data-target="#modal{{$loop->iteration}}"></a>
                                <input type="checkbox" name="medias[]" value={{$item->id}}>
                                @endforeach

                                <button type="submit" class="btn btn-danger">{{ __('app.delete_button') }}</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                @can('update', $content)
                <a href="{{ route('contents.edit', $content) }}" id="content-help-{{ $content->id }}"
                    class="btn btn-primary">{{ __('content.edit') }}</a>

                <a class="btn btn-success" data-toggle="collapse" href="#collapseExample" role="button"
                    aria-expanded="false" aria-controls="collapseExample">
                    {{__('app.add_file')}}
                </a>

                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#removeFiles">
                    {{__('app.remove_file')}}
                </button>
                @endcan
                <a href="{{ route('contents.index') }}" class="btn btn-link">{{ __('content.back_to_index') }}</a>
            </div>
        </div>
    </div>
</div>

@endsection
