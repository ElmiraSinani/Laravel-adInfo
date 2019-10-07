@extends('layouts.dashboard')

@section('content')

<form action="{{ route('adminUpdateService', ['id' =>$service->id ])}}" method="post" enctype="multipart/form-data"  class="w-100">
    @csrf
    <div class="row ">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">{{ __('Update Service') }}</div>
                <div class="form py-4">
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Service Name') }}</label>
                        <div class="col-md-8">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$service->name}}" required autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Description') }}</label>
                        <div class="col-md-8">
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" >{{$service->description}}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>    
                    
                    <div class="form-group row">
                        <label for="address" class="col-md-2 col-form-label text-md-right">{{ __('Address') }}</label>
                        <div class="col-md-8">
                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{$service->address}}">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="phone" class="col-md-2 col-form-label text-md-right">{{ __('Phone') }}</label>
                        <div class="col-md-8">
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$service->phone}}">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('Email') }}</label>
                        <div class="col-md-8">
                            <input id="city" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$service->email}}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    
                    
                </div>
            </div> <!-- / .card -->
        </div> <!-- / .col-md-8 -->       

        <div class="col-md-4">
            
            <div class="card mb-4">
                <div class="card-header">
                    <button type="submit" class="btn btn-primary">{{ __('Update Service') }}</button>
                </div>                
            </div> <!-- / .card -->
                             
            
            <div class="card">
                <div class="card-header">
                    {{ __('Image') }}
                </div>
                <div class="form-group py-4">
                    <div class="col-md-12">
                        @if($service->image)
                            <img src="{{asset ('storage')}}/{{$service->image}}" alt="{{asset ('storage')}}/{{$service->image}}" style="max-width:100%" >
                        @endif
                        <input id="image" type="file" class="form-control" name="image">
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>                
            </div><!-- / .card -->  
            
        </div><!-- / .col-md-4 -->

    </div> <!-- / .row -->
</form>


@endsection
