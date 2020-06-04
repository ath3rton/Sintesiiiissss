@extends('layouts.app')
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/Chart.min.js') }}" defer></script>

@section('content')
@if(session()->has('user'))
    @if(session()->get('user')->rol!=1)
        <script>window.location = "/";</script>
    @endif
@else
    <script>window.location = "/";</script>
@endif
<div class="text-center">
    <div class="col-xl-12 row m-0 justify-content-center">
        @foreach ($projs as $proj)
            <div class="card projcards col-xl-3 col-md-5 col-xs-12 m-3">
                <img class="card-img-top" src="{{ asset('images/proj_images/') }}/{{$proj->img}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{$proj->nom_projecte}}</h5>
                    <p class="text-left card-text description ">{{$proj->descripcio}}</p>
                    <p class="text-left card-text description ">{{$proj->feedback}}</p>
                    <a href="projdenuncias/{{$proj->id}}" class="m-1 btn btn-primary">{{__('messages.view')}}</a>
                </div>
            </div>
        @endforeach
        <div class="col-xl-12 row justify-content-center">
            <div class="justify-content-center projcards col-xl-5 col-md-5 col-xs-5 m-3"><?php echo $projs->render(); ?></div>
        </div>
    </div>
</div>
@endsection

