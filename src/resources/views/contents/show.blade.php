@extends('layouts.default')

@section('title', __('lara-cms-lite::content.detail'))

@section('content')

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">{{ __('lara-cms-lite::content.detail') }}</div>
            <div class="card-body">
                <table class="table table-sm table-hover">
                    <tbody>
                        <tr>
                            <td style="width: 25%">{{ __('lara-cms-lite::content.creator') }}</td>
                            <td>{{ $content->user->{config('lara-cms-lite::content.user.displayFieldName')} }}</td>
                        </tr>
                        <tr>
                            <td style="width: 25%">{{ __('lara-cms-lite::content.displayed') }}</td>
                            <td>{{ $content->displayed ? __('lara-cms-lite::content.yes') : __('lara-cms-lite::content.no') }}</td>
                        </tr>
                        <tr>
                            <td style="width: 25%">{{ __('lara-cms-lite::content.created') }}</td>
                            <td>{{ $content->created_at }}</td>
                        </tr>
                        <tr>
                            <td style="width: 25%">{{ __('lara-cms-lite::content.updated') }}</td>
                            <td>{{ $content->updated_at }}</td>
                        </tr>
                        <tr>
                            <td style="width: 25%">{{ __('lara-cms-lite::content.name') }}</td>
                            <td>{{ $content->name }}</td>
                        </tr>
                    </tbody>
                </table>
                
                <div>
                    {!! $content->description !!}
                </div>
            </div>
            
            <div class="card-footer">
                
                <a href="{{ route('contents.edit', $content) }}" id="content-help-{{ $content->id }}"
                    class="btn btn-primary">{{ __('lara-cms-lite::content.edit') }}</a>
                    <a href="{{ route('contents.index') }}" class="btn btn-link">{{ __('lara-cms-lite::content.back_to_index') }}</a>
                </div>
            </div>
        </div>
    </div>
    
    @endsection
    