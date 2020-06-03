@extends('layouts.app')
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/Chart.min.js') }}" defer></script>

@section('content')
<div class="d-flex justify-content-center">
    <div class="container col-xl-8 row m-0 flex-center ">
        <div class="card col-xl-12">
            <div class="card-body row">
                <div class="col-xl-8">
                    <div class="row justify-content-center ">
                        <h2><img  height="50px" width="50px"
                                src="{{ asset('images/emp_logos').'/'.$emp->logo }}" /></h2> 
                        <h2 class="text-center align-middle">{{$proj->nom_projecte}}</h2>
                    </div>
                    <div class="row ml-3">Telf: <a  class="ml-3" href="tel:{{$emp->telf}}">{{$emp->telf}}</a></div>
                    <div class="row ml-3">Web: <a class="ml-3" href="https://{{$emp->web}}">{{$emp->web}}</a></div>
                    <div class="m-3">
                        <h5 class="text-uppercase">{{__('messages.details')}}:</h5>
                        <div class="row">
                            <span class="ml-3">{{__('messages.company')}}:</span><label class="ml-3">{{$emp->nom_empresa}}</label>
                        </div> 
                        <div class="row">
                            <span class="ml-3">{{__('messages.location')}}:</span><label class="ml-3">{{$emp->ciutat}}</label>
                        </div>
                        <div class="row">
                            <span class="ml-3">Feedback:</span><label class="ml-3">{{$proj->feedback}}</label>
                        </div>
                    </div>
                    <hr>
                    <h5>{{__('messages.proddesc')}}:</h5>
                    <p class="ml-3">{{$proj->descripcio}}</p>
                </div>
                <div class="col-xl-4">
                    <h1 class="text-center"></h1>
                    <canvas id="chart-area" width="400" height="400"></canvas>

                </div>
            </div>
        </div>
        <div class="card col-xl-12 mt-3">
            <div class="card-body row">
                <div class="col-xl-8">
                    <h2 class="m-2">{{__('messages.contribution')}}</h2>
                    <div class="row"> 
                        <table id="conts" class="table">
                            <tr>
                                <td><h5><b>{{__('messages.username')}}</b></h5></td>
                                <td><h5><b>{{__('messages.contributed')}}</b></h5></td>
                            </tr>
                        </table>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script type="text/javascript">
    // No es fa en arxiu a part per utilitzar la id que tenia
    window.addEventListener('load', getMessage);
    let config;

    function getMessage() {
        let ops = 0;
        $.ajax({
            type: 'GET',
            url: '/getops/{{$proj->id}}',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $.each(data, function (i) {
                    ops = ops + parseFloat(data[i].quantitat);
                });
                chart(ops);
            }
        });
        $.ajax({
            type: 'GET',
            url: '/getopsus/{{$proj->id}}',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                console.log(data);
                $.each(data, function (i) {
                    $( "#conts" ).append( "<tr><td>"+data[i].user.nickname+"</td><td>"+data[i].quant+"</td></tr>" );
                   
                });
            }
        });
        var randomScalingFactor = function () {
            return Math.round(Math.random() * 100);
        };

        function chart(ops) {
            console.log(ops);
            config = {
                type: 'pie',
                data: {
                    datasets: [{
                        data: [ops, {{$proj->objectiu}}],
                        label: 'Dataset 1',
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.4)',
                            'rgba(54, 162, 235, 0.4)'
                        ],
                    }],
                    labels: ['{{__('messages.achieved')}}', '{{__('messages.target')}}'
                    ]
                },
                options: {
                    responsive: true
                }
            };
            var ctx = document.getElementById('chart-area').getContext('2d');
            window.myPie = new Chart(ctx, config);
        }
    }
</script>
