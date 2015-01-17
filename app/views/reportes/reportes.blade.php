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

        .cabecera{
            margin-top: 3px;
            font-size: 14px;
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
    </div>
    <div class="menucompanias hidden">
        <div class="col-md-12 form-group" id="companias" style="margin-left:80px;">
        </div>
        <div class="col-md-12">
            <button class="pull-right btn-xs btn btn-success" onclick="coleccion()"><i class="fa fa-bar-chart"></i> Generar reporte</button>
        </div>
    </div>
    <div class="hidden col-md-12" id="compania" style="left:10;">
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
        <div id="grafica" class="col-md-12" style="background:#f2f2f2;">
        </div>
        <div id="datos" class="col-md-6">
        </div>
        <div class="col-md-12">
            <button id="imprimir" class="hidden pull-right btn btn-primary" onclick="window.print();return false;"><i class="fa fa-print"></i></button>
        </div>
    </div>
@stop
@section('scripts')
    <script>
        $('#Reportes, #2Reportes').addClass('active');
        var arrayId;
        function companias () {
            $('.menu').addClass('hidden');
            $.get('reportes/lugares', function(json) {
              $('#companias').html('');
              $.each(json,function(index,lugar){
                if(lugar.status == 'Activa'){
                    $('#companias').append('<div id="seleccion'+lugar.id+'" class="contenido col-md-3" onclick="seleccionar('+lugar.id+')"><input class=" pull-right hidden" value="'+lugar.id+'" type="checkbox" id="check-'+lugar.id+'"><h3 class="cabecera">'+lugar.nombre+'</h3><i class="fa fa-users">'+lugar.numelementos+'</i><br><label class="informacion label label-success">'+lugar.status+'</label><br><label class="informacion label label-primary">'+lugar.tipo+'</label><label class="pull-right label label-default" style="cursor:pointer;" onclick="masInformacion('+lugar.id+')">Ver reporte <i class="fa fa-bar-chart"></i></label></div>');
                }else{
                    $('#companias').append('<div id="seleccion'+lugar.id+'" class="contenido col-md-3" onclick="seleccionar('+lugar.id+')"><input class=" pull-right hidden" value="'+lugar.id+'" type="checkbox" id="check-'+lugar.id+'"><h3 class="cabecera">'+lugar.nombre+'</h3><i class="fa fa-users">'+lugar.numelementos+'</i><br><label class="informacion label label-danger">'+lugar.status+'</label><br><label class="informacion label label-primary">'+lugar.tipo+'</label><label class="pull-right label label-default" style="cursor:pointer;" onclick="masInformacion('+lugar.id+')">Ver reporte <i class="fa fa-bar-chart"></i></label></div>');
                }
              });
            }, 'json');
            $('.menucompanias').removeClass('hidden');
        }
        function seleccionar(id) {
            $('#seleccion'+id).toggleClass('seleccion');
            if($("#check-"+id).is(':checked')){
                $("#check-"+id).prop("checked", false);
            }
            else{
                $("#check-"+id).prop("checked", true);
            }
        };
        function masInformacion(id) {
            arrayId = [];
            arrayId.push($('#check-'+id).attr('value'));
            $('.menucompanias').html('');
            $('.titulo1').addClass('hidden');
            $.post('reportes/nombre',{id:id}, function(json) {
                $('#nombre').html(json.nombre);
                $('#generar').html('<button class="pull-right btn-xs btn btn-success" onclick="dibujagrafica()"><i class="fa fa-bar-chart"></i> Generar reporte</button>');
            }, 'json');
            $('#compania').removeClass('hidden');
        };
        function coleccion () {
            arrayId = [];
            $("input:checkbox:checked").each(function(){
                arrayId.push($(this).attr('value'));
                // dibujagrafica();
            });
            // console.log(arrayId);
            dibujagrafica();
            $('.menucompanias').html('');
            $('.titulo1').addClass('hidden');
            $('#compania').removeClass('hidden');
            $('#generar').html('<button class="pull-right btn-xs btn btn-success" onclick="dibujagrafica()"><i class="fa fa-bar-chart"></i> Generar reporte</button>');

        }
    </script>
    <script>
        function dibujagrafica() {
            $('#grafica').html('');
            $('#datos').html('');
            $('#imprimir').addClass('hidden');
            console.log(arrayId);
            id = arrayId;
            $.post('reportes/compania',{id:id}, function(json) {
                console.log(json);
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
                if (data.length > 0){
                    Morris.Bar({
                        element: 'grafica',
                        data: data,
                        xkey: 'nombre',
                        ykeys: ['cantidad',],
                        labels: ['nombre'],
                        barColors:['#F44336'],
                    });
                    $('.morris-default-style').addClass('hidden');
                    $('#imprimir').removeClass('hidden');
                    $.each(data,function(index,dato){
                        $('#datos').append('<h1 class="informacion label label-danger" style="margin-left: 5px;">'+dato.nombre+' = '+dato.cantidad+' elementos</h1><br><br>');
                    });
                };
            }, 'json');
        }
    </script>
@endsection