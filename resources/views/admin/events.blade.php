@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <h6 class="text-right font-weight-bold"> 
            <a href="{{route('adminCreateEvent')}}"><i class="fa fa-plus-circle"></i> Add New</a>
        </h6>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th width="130">Image</th> 
                        <th width="">Event</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Views</th>                                             
                        <th width="130">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($events as $event)
                    <tr>
                        <td>{{$event->id}}</td> 
                        <td>
                        @if($event['image'])
                            <img src="{{asset ('storage')}}{{$event['image']}}" alt="{{asset ('storage')}}{{$event['image']}}" style="max-height:37px" >
                        @endif                     
                        <td>{{$event->name}}</td>                      
                        <td>
                            From: {{ Carbon\Carbon::parse($event->start_date)->format('d M Y') }} <br/> 
                            To: {{ Carbon\Carbon::parse($event->end_date)->format('d M Y') }}
                        </td>                      
                        <td>
                            Start: {{ Carbon\Carbon::parse($event->start_time)->format('h:i:s A') }}<br/> 
                            End: {{ Carbon\Carbon::parse($event->end_time)->format('h:i:s A') }}
                        </td>                      
                        <td>{{$event->views}}</td>                      
                         
                        <td>
                            <a href="{{route('adminEditEvent',['id' => $event->id])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                            <a href="{{route('adminDeleteEvent',['id' => $event->id])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        </td>                    
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$events->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
