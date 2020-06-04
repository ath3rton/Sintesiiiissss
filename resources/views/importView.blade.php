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
        <div class="card projcards col-xl-6 col-md-5 col-xs-12 m-5 p-5">
            <form class="login-form log m-4" action="{{route('useri')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <label for="userim">{{__('messages.import')." ".__('messages.users')}}</label>
                <input type="file" id="userim" name="userim"/>
                <button>{{__('messages.import')}}</button>
            </form>
                <hr>
            <form class="login-form log m-4" action="{{route('projecti')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <label for="projectim">{{__('messages.import')." ".__('messages.projects')}}</label>
                <input type="file" id="projectim" name="projectim"/>
                <button>{{__('messages.import')}}</button>
            </form>
            <hr>
            <form class="login-form log m-4" action="{{route('companyi')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <label for="companyim">{{__('messages.import')." ".__('messages.projects')}}</label>
                <input type="file" id="companyim" name="companyim"/>
                <button>{{__('messages.import')}}</button>
            </form>
               
                <hr>
            <form class="login-form log m-4" action="{{route('opsi')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <label for="investim">{{__('messages.import')." ".__('messages.investments')}}</label>
                <input type="file" id="investim" name="investim"/>
                <button>{{__('messages.import')}}</button>
            </form>
        </div>
    </div>
</div>
@endsection

