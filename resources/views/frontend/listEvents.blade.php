@extends('layouts.app')



@section('content')


<div class="container py-5">
    <div class="jumbotron p-3 p-md-5 text-white bg-dark">
        <!-- <div class="col-md-6 px-0">
            <h1 class="display-4 font-italic">Title of a longer featured blog post</h1>
            <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what's most interesting in this post's contents.</p>
            <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p>
        </div> -->
    </div>    
    <h3 class="">Upcoming Events</h3>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-offset-2 col-sm-8">
            <ul class="event-list">
               @foreach($events as $event)
                <li>                   
                    @if($event['image'])
                    <div class="img">
                        <img src="{{asset ('storage')}}{{$event['image']}}" alt="{{asset ('storage')}}{{$event['image']}}" style="max-height:37px" >
                    </div>
                    @endif  
                    <div class="info">
                        <h2 class="title">{{ $event->name }}</h2>
                        <p class="desc">{{ $event->description }}</p> 
                        <div>
                            From: {{ Carbon\Carbon::parse($event->start_date)->format('d M Y') }}   
                            To: {{ Carbon\Carbon::parse($event->end_date)->format('d M Y') }}
                        </div>
                        <div>
                            Start: {{ Carbon\Carbon::parse($event->start_time)->format('h:i:s A') }} 
                            End: {{ Carbon\Carbon::parse($event->end_time)->format('h:i:s A') }}
                        </div>
                        <span class="badge badge-success">Available</span>
                    </div>
                   
                </li>

                @endforeach
            </ul>
        </div>
    </div>
</div>