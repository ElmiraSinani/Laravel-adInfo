@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <h6 class="text-right font-weight-bold"> 
            <a href="{{route('adminCreateCategory')}}"><i class="fa fa-plus-circle"></i> Add New</a>
        </h6>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Slug</th>                        
                        <th>Description</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{$category['id']}}</td>
                        <td>{{$category['name']}}</td>  
                        <td>{{$category['slug']}}</td>                                              
                        <td>{{$category['description']}}</td>   
                        <td>
                        @if($category['image'])
                            <img src="{{asset ('storage')}}/{{$category['image']}}" alt="{{asset ('storage')}}/{{$category['image']}}" style="max-height:37px" >
                        @endif
                        </td>                     
                        <td width='120'>
                            <a href="{{route('adminEditCategory',['id' => $category->id])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$categories->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
