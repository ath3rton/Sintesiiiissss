@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-xl-12 row">
        @foreach ($projs as $proj)
            <div class="card col-xl-3 m-4">
                <div class="card-body">
                    <h5 class="card-title">{{$proj->nom_projecte}}</h5>
                    <p class="card-text description mt-3">{{$proj->descripcio}}</p>
                    <a href="{{route('valid',$proj->id)}}" class="m-1 btn btn-primary">{{__('messages.validate')}}</a>
                </div>
            </div>
        @endforeach
        @if(!$projs)    
            <h1>{{__('messages.novalidate')}}</h1>
        @endif
    </div>
</div>
@endsection

