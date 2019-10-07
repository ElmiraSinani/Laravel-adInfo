@extends('layouts.dashboard')

@section('content')

<form action="{{ route('adminUpdateQuestion',['id' => $question->id ])}}" method="post" enctype="multipart/form-data"  class="w-100">
    @csrf
    <div class="row ">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">{{ __('Edit Question') }}</div>
                <div class="form py-4">
                    <div class="form-group row">
                        <label for="question" class="col-md-2 col-form-label text-md-right">{{ __('Question') }}</label>
                        <div class="col-md-8">
                            <input id="question" type="text" class="form-control @error('question') is-invalid @enderror" name="question" value="{{ $question->question }}" required autofocus>
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
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" >{{ $question->description }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>                     
                </div>
            </div> <!-- / .card -->
            <div class="card">
                <div class="card-header">
                    {{ __('Question Options') }}
                    <a href="#" class="pull-right"  data-toggle="modal" data-target="#add-question-option"><i class="fa fa-plus-circle"></i>Add</a>
                </div>
                <div class="py-4 px-4">
                    @foreach($question->options as $option)                       
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="option[{{$option->id}}]" value="{{$option->option}}" />
                        </div>
                        <div class="col-md-1">
                            @if($option->image)
                                <img src="{{asset ('storage')}}/{{$option->image}}" alt="{{asset ('storage')}}/{{$option->image}}" style="max-width:100%" >
                            @endif
                        </div>
                        <div class="col-md-1">
                            <a href="{{route('adminDeleteQuestionOption',['questionId'=>$question->id, 'optionId'=>$option->id])}}" class="text-danger removeOption"><i class="fa fa-minus-circle"></i></a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div> <!-- / .card -->
        </div> <!-- / .col-md-8 -->       

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <button type="submit" class="btn btn-primary">{{ __('Update Question') }}</button>
                    <a href="{{route('adminDeleteQuestion',['id'=>$question->id])}}" class="text-danger pull-right mt-2">{{ __('Delete') }}</a>
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
                            <input id="category" name="categories[]" type="checkbox" class="@error('question') is-invalid @enderror" name="category" value="{{$category->id}}" @if(in_array($category->id, $selectedCatIds)) checked='checked' @endif>
                            {{$category->name}}
                        </label>
                        @endforeach
                    </select>
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
                    <a href="#" class="btn btn-danger btn-sm pull-right">Remove Image</a>
                </div>
                <div class="form-group py-4">
                    <div class="col-md-12">
                        @if($question->image)
                            <img src="{{asset ('storage')}}/{{$question->image}}" alt="{{asset ('storage')}}/{{$question->image}}" style="max-width:100%" >
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


<!-- Modal Add Question Option -->
<div class="modal fade bd-example-modal-lg" id="add-question-option" tabindex="-1" role="dialog" aria-labelledby="add-question-option" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title font-weight-bold" id="exampleModalLabel">{{ __('Add New Option') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('adminAddQuestionOption',['questionId' => $question->id ])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-2">
                    <label for="option" class="d-block font-weight-bold">{{ __('Option') }}</label>
                    <input id="option" type="text" class="form-control @error('option') is-invalid @enderror" name="option" value="" required>
                    @error('option')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="" class="d-block font-weight-bold">Is Option Correct?</label>
                    <label for="yes">
                        <input id="yes" type="radio" class="" name="correct" value="1" > Yes
                    </label>
                    <label for="no">
                        <input id="no" type="radio" class="" name="correct" value="0" checked> No
                    </label>
                    @error('correct')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-2">
                    <div class="form-group">
                        <label for="" class="d-block font-weight-bold">{{ __('Option Image') }}</label>
                        <input type="file" name="optionImage">
                        @error('optionImage')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
               
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>

@endsection
