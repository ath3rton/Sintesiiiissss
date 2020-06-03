@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-xl-12 row">
        @foreach ($projs as $proj)
            <div class="card projcards col-xl-3 col-md-5 col-xs-12 m-3">
                <img class="card-img-top" src="{{ asset('images/emp_images/') }}/{{$proj->img}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{$proj->nom_projecte}}</h5>
                    <p class="text-left card-text description ">{{$proj->descripcio}}</p>
                    <p class="text-left card-text description ">{{$proj->feedback}}</p>
                </div>
            </div>
        @endforeach
        @if(!$projs)    
            <h1>{{__('messages.novalidate')}}</h1>
        @endif
    </div>
</div>
@endsection

