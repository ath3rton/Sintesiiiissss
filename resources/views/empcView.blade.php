@extends('layouts.app')

@section('content')
<div class="container">

    <div class="col-xl-12 row">
        <div class="card col-xl-12 m-3">
            <form class="login-form log m-4" action="{{route('creaempresa')}}" enctype="multipart/form-data" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nom_empresa">{{__('messages.emps')}}</label>
                        <input type="text" class="form-control" id="nom_empresa"  name="nom_empresa" placeholder="{{__('messages.emps')}}" required/>
                        <div class="form-group mt-2">
                            <label for="cif">CIF</label>
                            <input type="text"  class="form-control" id="cif" name="cif" placeholder="CIF" required/>
                        </div>
                        <div class="form-group">
                            <label for="ciutat">{{__('messages.city')}}</label>
                            <input type="text"  class="form-control" id="ciutat" name="ciutat"  placeholder="{{__('messages.city')}}" required/>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="image" class="col-12">Logo:</label>
                        <label class="btn col-12 text-center form-control btn-success">
                            Browse  <input type="file" name="logo" style="display:none"/>
                        </label>
                        <div class="form-group">
                            <label for="telf">Telf:</label>
                            <input type="text"  class="form-control" id="telf" name="telf"  placeholder="Telf" required/>
                        </div>
                        <div class="form-group">
                            <label for="web">Web:</label>
                            <input type="text"  class="form-control" id="web" name="web"  placeholder="Web" />
                            <input type="hidden"  class="form-control" id="owner" name="owner" value="{{session()->get('user')->id}}" />
                        </div>
                    </div>
                    <button class="btn btn-primary filelogo">{{__('messages.createemp')}}</button>
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
