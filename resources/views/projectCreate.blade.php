@extends('layouts.app')

@section('content')
<div class="container">

    <div class="col-xl-12 row">
        @if(count($emps)==0)
        <h1 class="projtitl col-xl-12 text-center">{{ __('messages.noemps') }}</h1>
        @else
        <h1 class="projtitl col-xl-12 text-center">{{ __('messages.createproj') }}</h1>
        <div class="card col-xl-12 m-3">
            <form class="login-form log m-4" action="{{$proj?route('projmodficar',$proj):route('projadd')}}" enctype="multipart/form-data" method="POST">
            {{ method_field($proj?'PUT':'POST') }}
                {{ csrf_field() }}
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">{{__('messages.projname')}}</label>
                        <input type="text" class="form-control" id="nom_projecte"  name="nom_projecte" value="{{$proj?$proj->nom_projecte:''}}" placeholder="{{__('messages.projname')}}" required/>
                        <div class="form-group mt-2">
                            <label for="inputAddress">{{__('messages.target')}}</label>
                            <input type="number" step="0.001" class="form-control" id="objectiu" name="objectiu" value="{{$proj?$proj->objectiu:''}}" placeholder="{{__('messages.target')}}" required/>
                        </div>
                        <div class="form-group ">
                            <label for="inputAddress">{{__('messages.fraction')}}</label>
                            <input type="number" step="0.001" class="form-control" id="fraccio" name="fraccio" value="{{$proj?$proj->fraccio:''}}" placeholder="{{__('messages.fraction')}}" required/>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="image" class="col-12">{{__('messages.pimage')}}</label>
                        <label class="btn col-12 text-center form-control btn-success">
                            Browse  <input type="file" name="img" style="display:none"/>
                        </label>
                        <label for="emps">{{__('messages.emps')}}</label>
                        <select id="emps" class="form-control" name="emp_id">
                            @foreach($emps as $emp)
                            <option value="{{$emp->id}}">{{$emp->nom_empresa}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>
                <div class="form-group">
                    <label for="descripcio">{{__('messages.description')}}:</label>
                    <textarea class="form-control" rows="5" id="descripcio"  name="descripcio"  placeholder="{{__('messages.description')}}" required>{{$proj?$proj->descripcio:''}}</textarea>
                </div>
                <div class="form-group">
                    <label for="feedback">Feedback:</label>
                    <textarea class="form-control" rows="5" id="feedback"  name="feedback" required>{{$proj?$proj->feedback:''}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary filelogo" >
                    @if($proj)
                        {{__('messages.modify')}}
                    @else
                        {{__('messages.create')}}
                    @endif
                </button>
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
        @endif
    </div>
</div>
@endsection
