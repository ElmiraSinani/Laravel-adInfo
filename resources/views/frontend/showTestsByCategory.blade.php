@extends('layouts.app')

@section('content')

    <div class="container py-5">

    <h3 class="text-center">{{$test->name}}</h3>
    <h6 class="text-center">(Թեսթերը կազմված են Կալիֆորնիայի վարորդի ձեռնարկից)</h6>
    <div class="border-top border-bottom my-3 py-4">
        <span class="font-weight-bold">Ցուցումներ.</span> Թեստը հանձնելուց առաջ ուսումնասիրեք 
        <a target="_blank" href="https://www.dmv.ca.gov/portal/wcm/connect/09a5b933-9869-4504-ac90-fe54366771b3/dl600A.pdf?MOD=AJPERES">Կալիֆորնիայի վարորդի ձեռնարկը</a>
    </div>
  
    <form action="{{route('adminUpdateCategory',['id' => $test->id ])}}" method="post">
    @foreach($test->questions as $question)
        
        <div class="row font-weight-bold py-2">
            <div class="col-md-12">{{$number++}}. {{$question->question}}</div>
        </div>
        <div class="row">
            <div class="col-md-1">
            @if($question->image)
                <img src="{{asset ('storage')}}{{$question->image}}" class="img-fluid img-thumbnail" />
            @endif
            </div>
            <div class="col-md-11">
                @foreach($question->options as $option)
                <div class="row">
                    <div class="col-md-11"><label for="{{$option->id}}">{{$option->option}}</label></div>
                    <div class="col-md-1 text-right">
                    <input id="{{$option->id}}" type="radio" name="question[{{$question->id}}}]" value="{{$option->correct}}" />
                    <input type="hidden" name="question[{{$question->id}}][option][{{$option->id}}]" />
                    </div>                    
                </div>
                @endforeach
            </div>
        </div>
    @endforeach
    <div class="my-2 text-center">
        <button type="submit" class="btn btn-success">{{ __('Submit') }}</button>
    </div>
    </form>

    </div>

@endsection