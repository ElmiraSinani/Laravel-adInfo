@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <h6 class="text-right font-weight-bold"> 
            <a href="{{route('adminCreateService')}}"><i class="fa fa-plus-circle"></i> Add New</a>
        </h6>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th width="130">Image</th> 
                        <th width="">Service</th>
                        <th>Phone</th>
                        <th>Email</th>                                            
                        <th width="130">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($services as $service)
                    <tr>
                        <td>{{$service->id}}</td> 
                        <td>
                        @if($service['image'])
                            <img src="{{asset ('storage')}}{{$service['image']}}" alt="{{asset ('storage')}}{{$service['image']}}" style="max-height:37px" >
                        @endif                     
                        <td>{{$service->name}}</td>                      
                        <td>{{$service->phone}}</td>                      
                        <td>{{$service->email}}</td>  
                        <td>
                            <a href="{{route('adminEditService',['id' => $service->id])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                            <a href="{{route('adminDeleteService',['id' => $service->id])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        </td>                    
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$services->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
