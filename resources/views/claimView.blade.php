@extends('layouts.app')
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/Chart.min.js') }}" defer></script>

@section('content')
@if(session()->has('user'))
    @if(session()->get('user')->rol!=3)
        <script>window.location = "/";</script>
    @endif
@else
    <script>window.location = "/";</script>
@endif
<div class="d-flex justify-content-center">
    <div class="container col-xl-8 row m-0 flex-center ">
    <div class="reg-page">
                <div class="form reg col-xl-12">
                    <form class="login-form" action="{{ route('claimuser')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="row form-group flex-center {{ $errors->has('user_mail')? 'text-danger':'' }}">
                            <input type="mail" class="col-xl-12 form-control" id="user_mail" name="user_mail"
                                value="{{ old('user_mail') }}" placeholder="{{ __('messages.mail') }}*" required />

                            <input type="password" class="col-xl-12 form-control"
                                placeholder="{{ __('messages.password') }}*" value="{{ old('user_password') }}"
                                name="user_password" id="user_password" required />

                            <input type="password" class="col-xl-12 form-control"
                                placeholder="{{ __('messages.repassword') }}*" value="{{ old('repassword') }}"
                                name="repassword" id="repassword" required />

                            <input type="text" class="form-control col-xl-6" id="fname" name="fname"
                                value="{{ old('fname') }}" placeholder="{{ __('messages.fname') }}*" required />

                            <input type="text" class="form-control col-xl-6" id="lname" name="lname"
                                value="{{ old('lname') }}" placeholder="{{ __('messages.lname') }}" />

                            <input type="text" class="form-control col-xl-12" id="dni" name="dni"
                                value="{{ old('dni') }}" placeholder="DNI*" required />

                        </div>
                        <p class='info text-danger'>{{__('messages.capslock')}}</p>
                        <button class="btn" type="submit">{{ __('messages.register') }}</button>
                    {{ Form::close() }}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <button class="btn" id="lbtn" type="button">{{ __('messages.login') }}</button>
                    </form>
                </div>
            </div>
    </div>
</div>

@endsection

