@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <h6 class="text-right font-weight-bold"> 
            <a href="{{route('adminCreateQuestion')}}"><i class="fa fa-plus-circle"></i> Add New</a>
        </h6>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th width="">Image</th>
                        <th>Question</th>
                        <th width="150">Category</th>                        
                        <th width="130">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($questions as $question)
                    <tr>
                        <td>{{$question['id']}}</td>
                        <td>
                        @if($question['image'])
                            <img src="{{asset ('storage')}}/{{$question['image']}}" alt="{{asset ('storage')}}/{{$questions['image']}}" style="max-height:37px" >
                        @endif
                        </td>
                        <td>{{$question['question']}}</td>
                        <td>
                        @foreach($question->categories as $cat)
                            <a href='#'>{{$cat->name}}</a>
                        @endforeach
                        </td>                     
                        <td>
                            <a href="{{route('adminEditQuestion',['id' => $question->id])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$questions->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
