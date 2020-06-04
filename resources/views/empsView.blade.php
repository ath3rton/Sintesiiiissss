@extends('layouts.app')
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/Chart.min.js') }}" defer></script>

@section('content')

@if(session()->has('user'))
    @if(session()->get('user')->rol!=2)
        <script>window.location = "/";</script>
    @endif
@else
    <script>window.location = "/";</script>
@endif
<div class="text-center">
    <h1 class="projtitl col-xl-12 text-center">{{ __('messages.emps') }}</h1>
    <div class="col-xl-12 row m-0 justify-content-center">
        @foreach ($emps as $emp)
            <div class="card projcards col-xl-3 col-md-5 col-xs-12 m-3">
                <img class="card-img-top" src="{{ asset('images/emp_logos/') }}/{{$emp->logo}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{$emp->nom_empresa}}</h5>
                    
                    <div class="row">
                            <span class="ml-3">{{__('messages.city')}}:</span><span class="ml-3">{{$emp->ciutat}}</span>
                    </div>
                    <div class="row">
                            <span class="ml-3">CIF:</span><span class="ml-3">{{$emp->cif}}</span>
                    </div>
                    <div class="row">
                            <span class="ml-3">Telf:</span><span class="ml-3">{{$emp->telf}}</span>
                    </div>
                    <div class="row">
                            <span class="ml-3">Web:</span><span class="ml-3">{{$emp->web}}</span>
                    </div>
                </div>
                <a href="{{route('modemp',$emp->id)}}" class="m-1 btn btn-primary">{{__('messages.modify')}}</a>
            </div>
        @endforeach
        
    </div>
</div>
@endsection

