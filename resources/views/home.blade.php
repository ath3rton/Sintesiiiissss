@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-xl-12 row">
        @foreach ($projs as $proj)
            <div class="card col-xl-3 m-3">
                <div class="card-body">
                    <h5 class="card-title">{{$proj->nom_projecte}}</h5>
                    <p class="card-text description mt-3">{{$proj->descripcio}}</p>
                    <a href="projecte/{{$proj->id}}/{{$proj->emp_id}}" class="btn btn-primary">{{__('messages.view')}}</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
