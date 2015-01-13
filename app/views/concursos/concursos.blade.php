@extends('layaouts.base')
@section('titulo')
  Convocatorias
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
        .content{
            margin-left: 0px;
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
        <h1 style="margin-bottom:20px;"><i class="fa fa-trophy"></i> Convocatorias</h1>
    </div>
    <div class="col-md-offset-3 col-md-6" style="margin-top:18px;">
        <a href="#" class="requisitos col-md-12 text-center" onclick="ejemplo()">
            <h4>Concurso de escoltas</h4>
            <i class="fa fa-flag-o fa-5x"></i>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aliquam error sint optio alias minus, nisi officia, aperiam dignissimos molestias necessitatibus. Temporibus, possimus laudantium iure. Veniam voluptatum laudantium natus enim.</p>
        </a>
    </div>
@stop
@section('scripts')
    <script>
    $('#sidebar-nav').addClass('hidden');
        function ejemplo () {
            $.post('concurso/evento', function(json) {
            }, 'json');
        }
    </script>
@endsection