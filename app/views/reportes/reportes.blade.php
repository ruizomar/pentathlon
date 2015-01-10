@extends('layaouts.base')
@section('titulo')
  Reportes
@endsection
@section('head')
    <style>
        .contenido {
            background: #fff;
            padding: 10px;
            border-top-width: 2px;
            border-top-style: solid;
            padding-right: 20px;
            box-shadow: 0px 3px 2px #aab2bd;
            -moz-box-shadow: 0px 3px 2px #aab2bd;
            -webkit-box-shadow: 0px 3px 2px #aab2bd;
            margin-left: 25px;
            margin-bottom: 30px;
        }
        .seleccion {
            background: #fff;
            padding: 10px;
            border-top-width: 3px;
            /*border-top-style: solid;*/
            border-top-color: #7797DD;
            padding-right: 20px;
            box-shadow: 0px 10px 10px #606264;
            -moz-box-shadow: 0px 10px 10px #606264;
            -webkit-box-shadow: 0px 10px 10px #606264;
            margin-left: 25px;
            margin-bottom: 25px;
        }
        .informacion{
            font-size: 14px;
        }
        .requisitos{
            background: #fff;
            border-top-width: 3px;
            border-top-style: solid;
            padding: 15px;
            box-shadow: 0px 1px 1px #aab2bd;
            -moz-box-shadow: 0px 1px 1px #aab2bd;
            -webkit-box-shadow: 0px 1px 1px #aab2bd;
            border-top-left-radius: .1em;
            border-top-right-radius: .1em;
            border-top-color: #000;
            color: #525050;
        }
        .requisitos:hover{
            background: #fbb03b;
            color:#fff;
            border-top-color: #fbb03b;
            cursor: pointer;
        }

        #grafica {
            background: #fff;
            height: 400px;
            margin-bottom: 20px;
        }
    </style>
    {{  HTML::style('css/sweet-alert.css')}}
    {{  HTML::style('css/tour/bootstrap-tour.min.css')}}
    {{  HTML::script('js/tour/bootstrap-tour.min.js')}}
    {{  HTML::script('js/chart/morris.min.js')}}
    {{  HTML::script('js/chart/raphael-min.js')}}
@endsection
@section('contenido')
    <div class="titulo1 col-md-11 col-md-offset-1">
        <h1 style="margin-bottom:20px;"><i class="fa fa-bar-chart"></i> Reportes</h1>
    </div>
    <div class="menu col-md-offset-1 col-md-10" style="margin-top:18px;">
        <a href="#" class="requisitos col-md-6 text-center" onclick="companias()">
            <h4>Reporte por compañía</h4>
            <i class="fa fa-map-marker fa-5x"></i>
            <div id="reconocimientos"></div>
        </a>
        <a href="{{ URL::to('history'); }}" class="requisitos col-md-6 text-center">
            <h4>Reporte por elemento</h4>
            <i class="fa fa-user fa-5x"></i>
            <div id="reconocimientos"></div>
        </a>
    </div>
    <div class="col-md-3">
      <!--   {{ Form::select('lugar',array(null),null,array('id' => 'lugares','class' => 'form-control col-msd-2')) }}
      {{ Form::button('<i class="fa fa-eye"></i> Buscar',array('class' => 'pull-right btn btn-info col-msd-4','id' => 'buscarext')) }} -->
    </div>
    <div class="col-md-12" id="companias" style="margin-left:80px;">
    </div>
    <div class="hidden col-md-12" id="compania">
        <h1 id="nombre" style="margin-bottom:20px;"><i class="fa fa-bar-chart"></i></h1>
        <div class="form-group col-md-12">
            <label class="checkbox-inline">
                <input id="1" type="checkbox"> Masculino Menor
            </label>
            <label class="checkbox-inline">
                <input id="2" type="checkbox"> Masculino Juvenil
            </label>
            <label class="checkbox-inline">
                <input id="3" type="checkbox"> Masculino Mayor
            </label>
            <label class="checkbox-inline">
                <input id="4" type="checkbox"> Femenino Menor
            </label>
            <label class="checkbox-inline">
                <input id="5" type="checkbox"> Femenino Juvenil
            </label>
            <label class="checkbox-inline">
                <input id="6" type="checkbox"> Femenino Mayor
            </label>
            <div id="generar">
            </div>
        </div>
        <div id="grafica" class="col-md-9" style="background:#f2f2f2;">
        </div>
    </div>
@stop
@section('scripts')
    <script>
        function companias () {
            $('.menu').addClass('hidden');
            $.get('reportes/lugares', function(json) {
              $('#companias').html('');
              $.each(json,function(index,lugar){
                if(lugar.status == 'Activa'){
                    $('#companias').append('<div id="seleccion'+lugar.id+'" class="contenido col-md-3" onclick="seleccionar('+lugar.id+')"><h4>'+lugar.nombre+'</h4><br><i class="fa fa-users">'+lugar.numelementos+'</i><br><label class="informacion label label-success">'+lugar.status+'</label><br><label class="informacion label label-primary">'+lugar.tipo+'</label><label class="pull-right label label-default" style="cursor:pointer;" onclick="masInformacion('+lugar.id+')">Más información...</label></div>');
                }else{
                    $('#companias').append('<div id="seleccion'+lugar.id+'" class="contenido col-md-3" onclick="seleccionar('+lugar.id+')"><h4>'+lugar.nombre+'</h4><br><i class="fa fa-users">'+lugar.numelementos+'</i><br><label class="informacion label label-danger">'+lugar.status+'</label><br><label class="informacion label label-primary">'+lugar.tipo+'</label><label class="pull-right label label-default" style="cursor:pointer;" onclick="masInformacion('+lugar.id+')">Más información...</label></div>');
                }
              });
            }, 'json');

        }
        function seleccionar(id) {
            // console.log(id);
            $('#seleccion'+id).toggleClass('seleccion');
        };
        function masInformacion(id) {
            // console.log(id);
            // $('#grafica').html('');
            // dibujagrafica(111,111,111);
            $('#companias').addClass('hidden');
            $('.titulo1').addClass('hidden');
            $.post('reportes/nombre',{id:id}, function(json) {
                // console.log(json);
                $('#nombre').html(json.nombre);
                $('#generar').html('<button class="pull-right btn-xs btn btn-success" onclick="dibujagrafica('+id+')"><i class="fa fa-bar-chart"></i> Generar reporte</button>');
            }, 'json');
            $('#compania').removeClass('hidden');
        };
    </script>
    <script>
        function dibujagrafica(id) {
            $.post('reportes/compania',{id:id}, function(json) {
                var lista = [
                    {nombre:"Menor M.",cantidad:json.menorMasculino},
                    {nombre:"Juvenil M.",cantidad:json.juvenilMasculino},
                    {nombre:"Mayor M.",cantidad:json.mayorMasculino},
                    {nombre:"Menor F.",cantidad:json.menorFemenino},
                    {nombre:"Juvenil F.",cantidad:json.juvenilFemenino},
                    {nombre:"Mayor F.",cantidad:json.mayorFemenino},
                ];
                var data = [];
                $("input:checkbox:checked").each(function(){
                    data.push(lista[$(this).attr('id')-1]);
                });
                // console.log(data);
                // console.log(lista);
                $('#grafica').html('');
                Morris.Bar({
                    element: 'grafica',
                    data: data,
                    xkey: 'nombre',
                    ykeys: ['cantidad',],
                    labels: ['Cantidad'],
                    barColors:['#E91E63'],
                });
            }, 'json');
        }
    </script>
@endsection