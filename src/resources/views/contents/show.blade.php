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
                            <td>{{ $content->user->{config('lara-cms-lite.user.displayFieldName')} }}</td>
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
                
                <div class="card-footer">
                    
                    <a href="{{ route('contents.edit', $content) }}" id="content-help-{{ $content->id }}"
                        class="btn btn-primary">{{ __('content.edit') }}</a>
                        <a href="{{ route('contents.index') }}" class="btn btn-link">{{ __('content.back_to_index') }}</a>
                    </div>
                </div>
            </div>
        </div>
        
        @endsection
        