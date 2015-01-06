@extends('layaouts.base')
@section('titulo')
  Reportes
@endsection
@section('head')
    <style>
        .contenido {
            background: #fff;
            padding: 10px;
            border-top-width: 3px;
            border-top-style: solid;
            padding-right: 20px;
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

        .error {
            box-shadow: 0px 0px 10px red;
            border-top-color: white;
        }
    </style>
    {{  HTML::style('css/sweet-alert.css')}}
    {{  HTML::style('css/tour/bootstrap-tour.min.css')}}
    {{  HTML::script('js/tour/bootstrap-tour.min.js')}}
    {{  HTML::script('js/chart/morris.min.js')}}
    {{  HTML::script('js/chart/raphael-min.js')}}
@endsection
@section('contenido')
    <div class="col-md-11 col-md-offset-1">
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
    <div class="col-md-12" id="companias">
    </div>
@stop
@section('scripts')
    <script>
        function companias () {
            $('.menu').addClass('hidden');
            $.get('reportes/lugares', function(json) {
              $('#companias').html('');
              $.each(json,function(index,lugar){
                $('#companias').append('<div class="contenido col-md-4" onclick="verMas('+lugar.id+')"><h4>'+lugar.nombre+'</h4><br><i class="fa fa-users"> 3</i><label class="label label-default label-success">Activa</label><label class="label label-default label-primary">Compania</label></div>');
              });
            }, 'json');

        }
        function verMas(id) {
            console.log(id);
        };
    </script>
@endsection