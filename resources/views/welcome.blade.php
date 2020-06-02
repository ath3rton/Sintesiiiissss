<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sintesi</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/login.css')}}">
    <script type="text/javascript" src="{{ URL::asset('js/login.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</head>

<body>
    
    <div class="all">
        <div class="wrapper fadeInDown">
            <h1 class="titl col-xl-12 text-center mt-5">{{ __('messages.login') }}</h1>
            <div class="login-page">
                <div class="form">
                    <form class="login-form log" action="{{ route('login')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('user_mail')? 'text-danger':'' }}">
                            <input type="text" class="form-control" id="user_mail" name="user_mail"
                                value="{{ old('user_mail') }}" placeholder="{{ __('messages.mail') }}" required />
                            {!! $errors->first('user_mail','<span class="help-block">:message</span>') !!}

                        </div>
                        <div class="form-group {{ $errors->has('password')? 'text-danger':'' }}">
                            <input type="password" class="form-control" placeholder="{{ __('messages.password') }}"
                                value="{{ old('user_password') }}" name="user_password" id="user_password" required />
                            {!! $errors->first('password','<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group">
                            <div class="row col-xl-12">
                                <input type="checkbox" class="col-1 mt-1" id="lshowpas"/>
                                <label for="lshowpas "class="col-11 text-left" >{{__('messages.showpass')}}</label>
                            </div>
                        </div>
                        <p class='info text-danger'>{{__('messages.capslock')}}</p>
                        <button type="submit" class="btn">{{ __('messages.login') }}</button>
                        <button type="button" id="breg" class="btn">{{ __('messages.register') }}</button>
                    {{ Form::close() }}
                </div>
            </div>
            <div class="reg-page">
                <div class="form reg col-xl-12">
                    <form class="login-form" action="{{ route('registre')}}" method="POST">
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
            <div class="form log reg" id="vis">
                <form class="login-form col-xl-12" action="{{ route('visitor')}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <input  name="nickname" placeholder="Nickname" required/>
                        <button class="btn">{{ __('messages.visitor') }}</button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="{{ URL::asset('js/jquerylogin.js')}}"></script>
</html>
