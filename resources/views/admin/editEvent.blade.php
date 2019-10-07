@extends('layouts.dashboard')

@section('content')

<form action="{{ route('adminUpdateEvent', ['id' =>$event->id ])}}" method="post" enctype="multipart/form-data"  class="w-100">
    @csrf
    <div class="row ">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">{{ __('Update Event') }}</div>
                <div class="form py-4">
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Event Name') }}</label>
                        <div class="col-md-8">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$event->name}}" required autofocus>
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
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" >{{$event->description}}</textarea>
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
                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{$event->address}}">
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
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$event->phone}}">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="city" class="col-md-2 col-form-label text-md-right">{{ __('City') }}</label>
                        <div class="col-md-8">
                            <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{$event->city}}">
                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="state" class="col-md-2 col-form-label text-md-right">{{ __('State') }}</label>
                        <div class="col-md-8">
                            <input id="state" type="text" class="form-control @error('state') is-invalid @enderror" name="state" value="{{$event->state}}">
                            @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="zip" class="col-md-2 col-form-label text-md-right">{{ __('Zip') }}</label>
                        <div class="col-md-8">
                            <input id="zip" type="number" class="form-control @error('zip') is-invalid @enderror" name="zip" value="{{$event->zip}}" />
                            @error('zip')
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
                    <button type="submit" class="btn btn-primary">{{ __('Update Event') }}</button>
                </div>                
            </div> <!-- / .card -->
            
            <div class="card  mb-4">
                <div class="card-header">
                    {{ __('Event Date/Time') }} 
                </div>
                <div class="col-md-12 py-4 dateTime-block">
                    <div class="row ">
                        <div class="col-md-6">
                            <label for="start_date" class="">{{ __('Start Date') }}</label>
                            <input id="start_date" type="date" class="@error('start_date') is-invalid @enderror" name="start_date" value="{{$event->start_date}}">
                            @error('end_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>                        
                        <div class="col-md-6">
                            <label for="end_date" class="">{{ __('End Date') }}</label>
                            <input id="end_date" type="date" class="@error('end_date') is-invalid @enderror" name="end_date" value="{{$event->end_date}}">
                            @error('end_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
               
                    <div class="row ">
                        <div class="col-md-6">
                            <label for="start_time" class="">{{ __('Start Time') }}</label>                       
                            <input id="start_time" type="time" class="@error('start_time') is-invalid @enderror" name="start_time" value="{{$event->start_time}}">
                            @error('start_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                       
                        </div>                        
                        <div class="col-md-6">
                            <label for="end_time" class="">{{ __('End Time') }}</label>                        
                            <input id="end_time" type="time" class="@error('end_time') is-invalid @enderror" name="end_time" value="{{$event->end_time}}">
                            @error('end_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                        
                        </div>                        

                    </div>
                </div>
            </div><!-- / .card -->  
                             
            
            <div class="card">
                <div class="card-header">
                    {{ __('Image') }}
                </div>
                <div class="form-group py-4">
                    <div class="col-md-12">
                        @if($event->image)
                            <img src="{{asset ('storage')}}/{{$event->image}}" alt="{{asset ('storage')}}/{{$event->image}}" style="max-width:100%" >
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
