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
        <div class="card projcards col-xl-8 col-md-5 col-xs-12 m-5 p-5">
            <table>
                <tr>
                    <td>ID</td>
                    <td>{{__('messages.mail')}}</td>
                    <td>ROL</td>
                    <td>{{__('messages.createdat')}}</td>
                    <td>Actions</td>
                </tr>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->user_mail}}</td>
                    <td>{{$user->rol}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>
                        @if($user->actiu)
                            <a href="bloqueja/{{$user->id}}">{{__('messages.block')}}</a>
                        @else
                            <a href="desbloqueja/{{$user->id}}">{{__('messages.unlock')}}</a>
                        @endif
                    <td></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection

