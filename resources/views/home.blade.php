@extends('layouts.app')
@section('content')
<div class="text-center">
        @if($mod)
            <h1 class="projtitl col-xl-12 text-center">{{ __('messages.myprojects') }}</h1>
        @else
            <h1 class="projtitl col-xl-12 text-center">{{ __('messages.projects') }}</h1>
        @endif
    <div class="col-xl-12 row justify-content-center">
        @foreach ($projs as $proj)
            <div class="card projcards col-xl-3 col-md-5 col-xs-12 m-3">
                <img class="card-img-top" src="{{ asset('images/emp_images/') }}/{{$proj->img}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{$proj->nom_projecte}}</h5>
                    <p class="text-left card-text description ">{{$proj->descripcio}}</p>
                    <p class="text-left card-text description ">{{$proj->feedback}}</p>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{($proj->quantitat/$proj->objectiu)*100}}%;" aria-valuenow="{{$proj->quantitat}}" aria-valuemin="0" aria-valuemax="{{$proj->objectiu}}">{{$proj->quantitat}}</div>
                        <div class="progress-bar bg-secondary" role="progressbar" style="width: {{100-(($proj->quantitat/$proj->objectiu)*100)}}%;" aria-valuenow="{{$proj->quantitat}}" aria-valuemin="0" aria-valuemax="{{$proj->objectiu}}">{{$proj->objectiu}}</div>
                    </div>
                    <a href="projecte/{{$proj->id}}/{{$proj->emp_id}}" class="m-1 btn btn-primary">{{__('messages.view')}}</a>
                    @if($mod)
                        <a href="{{ route('projmodify',$proj->id) }}" class="btn btn-outline-info m-1">{{__('messages.modify')}}</a>
                        <form action="{{ route('projdel',$proj->id) }}" method="GET">
                            {{ csrf_field() }}
                            {{ method_field('GET') }} 
                            <button type="submit" class="ml-1 btn btn-outline-danger">{{__('messages.delete')}}</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
        <div class="col-xl-12 row justify-content-center">
            <div class="justify-content-center projcards col-xl-5 col-md-5 col-xs-5 m-3"><?php echo $projs->render(); ?></div>
        </div>
    </div>
</div>
@endsection

