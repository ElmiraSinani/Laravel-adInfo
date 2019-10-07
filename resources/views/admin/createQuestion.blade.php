@extends('layouts.dashboard')

@section('content')

<form action="{{ route('adminInsertQuestion')}}" method="post" enctype="multipart/form-data"  class="w-100">
    @csrf
    <div class="row ">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">{{ __('Add Question') }}</div>
                <div class="form py-4">
                    <div class="form-group row">
                        <label for="question" class="col-md-2 col-form-label text-md-right">{{ __('Question') }}</label>
                        <div class="col-md-8">
                            <input id="question" type="text" class="form-control @error('question') is-invalid @enderror" name="question" value="" required autofocus>
                            @error('question')
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
                    <button type="submit" class="btn btn-primary">{{ __('Update Question') }}</button>
                </div>                
            </div> <!-- / .card -->
            <div class="card  mb-4">
                <div class="card-header">
                    {{ __('Categories') }} 
                    <a href="{{route('adminCreateCategory')}}" class="pull-right"><i class="fa fa-plus-circle"></i>Add</a>
                </div>
                <div class="form-group py-4">
                    <div class="col-md-12">                        
                        @foreach($categories as $category)
                        <label class="label d-block">
                            <input id="category" name="categories[]" type="checkbox" class="@error('question') is-invalid @enderror" name="category" value="{{$category->id}}" />
                            {{$category->name}}
                        </label>
                        @endforeach
                    
						@error('category')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
                    </div>
                </div>                
            </div><!-- / .card -->
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
