@extends('layouts.dashboard')

@section('content')

<form action="{{route('adminInsertCategory')}}" method="post" enctype="multipart/form-data"  class="w-100">
    @csrf
    <div class="row ">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">{{ __('Add Category') }}</div>
                <div class="form py-4">

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Name') }}</label>
                        <div class="col-md-8">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" required autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="slug" class="col-md-2 col-form-label text-md-right">{{ __('Slug') }}</label>
                        <div class="col-md-8">
                            <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="" />
                            @error('slug')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Description') }}</label>
                        <div class="col-md-8">
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" ></textarea>
                            @error('description')
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
                    <button type="submit" class="btn btn-primary">{{ __('Update Categoy') }}</button>
                </div>                
            </div> <!-- / .card -->
            
            <div class="card">
                <div class="card-header">
                    {{ __('Image') }}
                </div>
                <div class="form-group py-4">
                    <div class="col-md-12">
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
