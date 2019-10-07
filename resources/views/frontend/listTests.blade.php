@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3 class="py-2">Գիտելիքների Ստուգման Թեսթեր</h3>
    <div class="row">
        @foreach($tests as $test)
        <div class="col-md-3">
            <a href="{{ route('dispalyTest', ['categoryId'=>$test->id]) }}">
                <div class="card mb-4 box-shadow">
                    <div class="card-body">
                        <p class="card-text">{{$test->name}}</p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>         
</div>
<div class="container">
    <h3 class="py-2">Ճանապարհային Նշանների Թեսթեր</h3>
    <div class="row">
        @foreach($tests as $test)
        <div class="col-md-3">
            <a href="{{ route('dispalyTest', ['categoryId'=>$test->id]) }}">
                <div class="card mb-4 box-shadow">
                    <div class="card-body">
                        <p class="card-text">{{$test->name}}</p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>         
</div>
@endsection