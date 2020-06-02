@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-xl-12 row">
        @foreach ($projs as $proj)
            <div class="card col-xl-3 m-4">
                <div class="card-body">
                    <h5 class="card-title">{{$proj->nom_projecte}}</h5>
                    <p class="card-text description mt-3">{{$proj->descripcio}}</p>
                    
                    <a href="projecte/{{$proj->id}}/{{$proj->emp_id}}" class="m-1 btn btn-primary">{{__('messages.view')}}</a>
                    @if($mod)
                        <a href="{{ route('projmodify',$proj->id) }}" class="btn btn-outline-info m-1">{{__('messages.modify')}}</a>
                        <form action="{{ route('projdel',$proj) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }} 
                            <button type="submit" class="ml-1 btn btn-outline-danger">{{__('messages.delete')}}</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

