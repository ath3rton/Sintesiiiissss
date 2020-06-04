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
<div class="d-flex justify-content-center">
    <div class="container col-xl-8 row m-0 flex-center ">
        <div class="card col-xl-12">
            <div class="card-body row projcontent">
                <div class="col-xl-8">
                    <div class="row justify-content-center ">
                        <h2><span class="ml-2 col-xl-6">{{$proj->nom_projecte}}</span></h2> 
                    </div>
                    <hr>
                    <div class="row">
                            <span class="ml-3">{{__('messages.proddesc')}}:</span><label class="ml-3">{{$proj->feedback}}</label>
                    </div>
                    <div class="row">
                            <span class="ml-3">Feedback:</span><label class="ml-3">{{$proj->feedback}}</label>
                    </div>
                </div>
                <div class="col-xl-4">
                    <h1 class="text-center"></h1>
                    <img  width="250" height="150" style="background-image:url({{ asset('images/proj_images').'/'.$proj->img }});background-repeat: no-repeat;background-size: cover;" />
                </div>
                <div class="col-xl-4">
                    <a class="btn btn-primary" href="{{route('unlock',$proj->id)}}">{{__('messages.unlock')}}</a>
                </div>
            </div>
        </div>
        <div class="card col-xl-12 mt-3">
            <div class="card-body row">
                <div class="col-xl-8">
                    <h2 class="m-2">{{__('messages.reports')}}</h2>
                    <div class="row">
                        <table id="conts" class="table">
                            <tr>
                                <td>{{__('messages.description')}}</td>
                                <td>{{__('messages.createdat')}}</td>
                            </tr>
                            @foreach($denuncies as $denuncia)
                                    <tr>
                                        <td>{{$denuncia->descripcio}}</td>
                                        <td>{{$denuncia->created_at}}</td>
                                    </tr>
                            @endforeach
                        </table>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

