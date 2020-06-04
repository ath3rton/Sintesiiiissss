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
        <div class="card projcards col-xl-3 col-md-5 col-xs-12 m-5 p-5">
            <label for="users">{{__('messages.export')." ".__('messages.users')}}</label>
            <a href="{{ url('userexport') }}" class="filelogo" target="_blank">{{__('messages.export')}}</a>
            <hr>
            <label for="users">{{__('messages.export')." ".__('messages.projects')}}</label>
            <a href="{{ url('projectexport') }}" class="filelogo" target="_blank">{{__('messages.export')}}</a>
            <hr>
            <label for="users">{{__('messages.export')." ".__('messages.emps')}}</label>
            <a href="{{ url('companyexport') }}" class="filelogo" target="_blank">{{__('messages.export')}}</a>
            <hr>
            <label for="users">{{__('messages.export')." ".__('messages.investments')}}</label>
            <a href="{{ url('opsexport') }}" class="filelogo" target="_blank">{{__('messages.export')}}</a>
        </div>
    </div>
</div>
@endsection

