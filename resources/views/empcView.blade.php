@extends('layouts.app')

@section('content')
@if(session()->has('user'))
    @if(session()->get('user')->rol!=2)
        <script>window.location = "/";</script>
    @endif
@else
    <script>window.location = "/";</script>
@endif
<div class="container">

    <div class="col-xl-12 row">
        {{$mod?$mod->logo:''}}
        <div class="card col-xl-12 m-3">
            <form class="login-form log m-4" action=" {{$mod?route('empresamod'):route('creaempresa')}}" enctype="multipart/form-data" method="POST">
            
                {{ csrf_field() }}
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nom_empresa">{{__('messages.emps')}}</label>
                        <input type="text" class="form-control" id="nom_empresa"  name="nom_empresa" value="{{$mod?$mod->nom_empresa:''}}" placeholder="{{__('messages.emps')}}" required/>
                        <div class="form-group mt-2">
                            <label for="cif">CIF</label>
                            <input type="text" class="form-control" id="cif" name="cif" placeholder="CIF" value="{{$mod?$mod->cif:''}}" required/>
                        </div>
                        <div class="form-group">
                            <label for="ciutat">{{__('messages.city')}}</label>
                            <input type="text"  class="form-control" id="ciutat" name="ciutat" value="{{$mod?$mod->ciutat:''}}" placeholder="{{__('messages.city')}}" required/>
                        </div>
                        <div class="form-group">
                            <label for="telf">Telf:</label>
                            <input type="text"  class="form-control" id="telf" name="telf"  value="{{$mod?$mod->telf:''}}" placeholder="Telf" required/>
                        </div>
                        <div class="form-group">
                            <label for="web">Web:</label>
                            <input type="text"  class="form-control" id="web" name="web" value="{{$mod?$mod->web:''}}"  placeholder="Web" />
                            
                            <input type="hidden"  class="form-control" id="owner" name="owner" value="{{session()->get('user')->id}}" />
                            
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="image" class="col-12">Logo:</label>
                        <label class="btn col-12 text-center form-control btn-success">
                            <input type="file" name="logo" style="display:none" onchange="readURL(this);"/>
                            <input type="hidden" name="logolast"/>
                            <button>{{__('messages.modify')}}</button>
                        </label>
                        @if($mod)
                            <img class="col-12" src="{{ asset('images/emp_logos/').'/'.$mod->logo }}"/>
                        @else
                            <img class="col-12" id="prev"/>
                        @endif
                    </div>
                    
                    @if($mod)
                        <button class="btn btn-primary filelogo">{{__('messages.modify')}}</button>
                    @else
                        <button class="btn btn-primary filelogo">{{__('messages.createemp')}}</button>
                    @endif
                    
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript" src="{{ URL::asset('js/imgpreview.js')}}"></script>