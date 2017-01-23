@extends('layaouts.public')
@section('titulo')
  Reunión
@endsection
@section('head')
    <style>
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
        .content{
            margin-left: 5px;
            margin-right: 5px;
        }
        .botonagregar{
            margin-left:15px;
            width: 50px;
            height: 50px;
            background: #39a1f4;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 3px 3px 4px #aab2bd;
            -moz-box-shadow: 3px 3px 4px #aab2bd;
            -webkit-box-shadow: 3px 3px 4px #aab2bd;
        }
        .botonagregar:hover{
            margin-left:15px;
            width: 50px;
            height: 50px;
            background: #2196F3;
            border-radius: 100%;
            cursor: pointer;
            box-shadow: 4px 6px 6px #aab2bd;
            -moz-box-shadow: 4px 6px 6px #aab2bd;
            -webkit-box-shadow: 4px 6px 6px #aab2bd;
        }
        .anadir{
            color: #fff;
            text-align: center;
            color: #FFF;
            position: relative;
            top: 9px;
            font-size: 25px;
        }
        .anadir:hover{
            color: #fff;
            text-align: center;
            color: #FFF;
            position: relative;
            top: 9px;
            font-size: 25px;
        }
        .persona{
            margin-left:15px;
            width: 50px;
            height: 50px;
            background: #F44336;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 3px 3px 4px #aab2bd;
            -moz-box-shadow: 3px 3px 4px #aab2bd;
            -webkit-box-shadow: 3px 3px 4px #aab2bd;
        }
        .persona:hover{
            margin-left:15px;
            width: 50px;
            height: 50px;
            background: #C5261A;
            border-radius: 100%;
            cursor: pointer;
            box-shadow: 4px 6px 6px #aab2bd;
            -moz-box-shadow: 4px 6px 6px #aab2bd;
            -webkit-box-shadow: 4px 6px 6px #aab2bd;
        }
        h1{
            color: #41414c;
            font-family: 'Aguafina Script', sans-serif;
            font-size: 30px;
            text-align: center;
        }
    </style>
    {{  HTML::script('js/bootstrapValidator.js'); }}
    {{  HTML::script('js/es_ES.js'); }}
    {{  HTML::style('css/sweet-alert.css');  }}
    {{  HTML::script('js/sweet-alert.min.js')}}
@endsection
@section('contenido')
    <div class="col-md-12">
        <h1 style="margin-bottom:20px;"><i class="fa fa-trophy"></i> Reunión Nacional de Comandantes, Estados Mayores y Directoras</h1>
    </div>
    {{ Form::open(array('url' => 'reunion/guardar','role' => 'form','id' => 'credenciales','onsubmit' =>"return confirm('Se guardaran los datos capturados');")) }}
        <div id="formulario" class="col-md-offset-2 col-md-8">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4 form-group">
                        {{ Form::label('zona', 'Zona participante') }}
                        {{ Form::text('zona', null, array('class' => 'form-control','autofocus')) }}
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <h4>Registro de elementos</h4>
                <hr>
                <div class="row" id="original">
                    <div class="col-md-4 form-group">
                        {{ Form::label('grado', 'Grado') }}
                        <select class="form-control" name="grado[]" id="grado">
                            <option value="1">Cadete</option>
                            <option value="2">Cadete 1/a</option>
                            <option value="3">Cabo</option>
                            <option value="4">Sargento 2/o</option>
                            <option value="5">Sargento 1/o</option>
                            <option value="6">SubOficial</option>
                            <option value="7">3/er Oficial</option>
                            <option value="8">2/o Oficial</option>
                            <option value="9">1/er Oficial</option>
                            <option value="10">3/er Comandante</option>
                            <option value="11">2/o Comandante</option>
                            <option value="12">1/er Comandante</option>
                            <option value="13">Acompañante</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        {{ Form::label('arma', 'Arma') }}
                        <select class="form-control" name="arma[]" id="arma">
                            <option value="1">Caballería</option>
                            <option value="2">Infantería</option>
                            <option value="3">Infantería de Marina</option>
                            <option value="4">Acompañante</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        {{ Form::label('nombre', 'Nombre (s)',array('class' => 'control-label')) }}
                        {{ Form::text('nombre[]', null, array('class' => 'form-control')) }}
                    </div>
                    <div class="col-md-4 form-group">
                        {{ Form::label('reunion', 'Reunión') }}
                        <select class="form-control" name="reunion[]" id="reunion">
                            <option value="1">Comandantes</option>
                            <option value="2">Estados Mayores</option>
                            <option value="3">Directoras Femenil</option>
                            <option value="4">Acompañante</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        {{ Form::label('cargo', 'Cargo') }}
                        <select class="form-control" name="cargo[]" id="cargo">
                            <option value="1">Comandante de Zona</option>
                            <option value="2">Jefe</option>
                            <option value="3">Subjefe</option>
                            <option value="4">Ayudante</option>
                            <option value="5">Acompañante</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        {{ Form::label('seccion', 'Sección') }}
                        <select class="form-control" name="seccion[]" id="seccion">
                            <option value="1">Jefe E.M.G.</option>
                            <option value="2">Jefe E.M.Z.</option>
                            <option value="3">Sección Técnica</option>
                            <option value="4">Sección Militar</option>
                            <option value="5">Sección Deportiva</option>
                            <option value="6">Sección de Org. y Prop</option>
                            <option value="7">sección de Inv. y Est.</option>
                            <option value="8">Sección de Archivo</option>
                            <option value="9">Sección de hacienda</option>
                            <option value="10">Acompañante</option>
                            <option value="11">Comandante de zona</option>
                        </select>
                    </div>
                    <div class="col-md-12"><hr>
                    </div>
                </div>
                <div id="copia"></div>
                <div class="botonagregar col-md-4" onclick="agregar();">
                    <a class="anadir"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <button type="submit" class="pull-right btn btn-primary">Enviar</button>
        </div>
    {{ Form::close() }}
@stop
@section('scripts')
    <script>
        function agregar () {
            $( "#original" ).clone().appendTo( "#copia" );
        }
    </script>
@endsection