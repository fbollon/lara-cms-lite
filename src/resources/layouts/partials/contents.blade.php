
@if(!empty($contents))
<div class="card-body">{{ $contents->appends(Request::except('page'))->render() }}</div>
@foreach ($contents as $content)
<div class="card">
    <div class="card-header">
        {!! $content->name !!}
    </div>
    <div class="card-body">
        <blockquote class="blockquote mb-0">
            {{-- <div class="embed-responsive embed-responsive-16by9"> --}}
                {!! $content->description !!}
                {{-- </div> --}}


{{-- Media Library --}}
@if (!empty($mediaItems[$content->id]))
            <div class="row" id="gallery{{$content->id}}" data-toggle="modal" data-target="#exampleModal{{$content->id}}">

    @foreach ($mediaItems[$content->id] as $item)
    <div class="col-6 col-md-4 col-lg-3">
        <img class="w-100 img-thumbnail" src="{{asset($item->getUrl('thumb'))}}" data-target=”#carouselExample{{$content->id}}”
            data-slide-to="{{$loop->iteration}}">
    </div>
    @endforeach
</div>

<!-- Modal -->
<!-- 
    This part is straight out of Bootstrap docs. Just a carousel inside a modal.
-->
<div class="modal fade" id="exampleModal{{$content->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="carouselExample{{$content->id}}" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($mediaItems[$content->id] as $item)
                        <li data-target="#carouselExample{{$content->id}}" data-slide-to="{{$loop->iteration}}"
                            {{($loop->iteration == 1)?' class=\"active\"':''}}></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach ($mediaItems[$content->id] as $item)
                        <div class="carousel-item {{($loop->iteration == 1)?'active':''}}">
                            <img class="d-block w-100" src="{{asset($item->getUrl())}}">
                            <h4>Titre : {{$item->getCustomProperty('title')}}</h4>
                            <span class="mr-4">Description : {{$item->getCustomProperty('description')}}</span>
                        </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExample{{$content->id}}" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExample{{$content->id}}" role="button" data-slide="next">
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
@endif




                <footer class="blockquote-footer">{{$content->created_at}} <cite title="Source Title">by {{$content->creator}}</cite></footer>
            </blockquote>
        </div>
    </div>

    @endforeach
    <div class="card-body">{{ $contents->appends(Request::except('page'))->render() }}</div>
    @endif
    