@extends('layaouts.base')
@section('titulo')
  Convocatorias
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
            margin-left: 0px;
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
    </style>
    {{  HTML::script('js/bootstrapValidator.js'); }}
@endsection
@section('contenido')
    <div class="titulo1 col-md-11 col-md-offset-1">
        <h1 style="margin-bottom:20px;"><i class="fa fa-trophy"></i> Convocatorias</h1>
    </div>
    <div class="col-sm-offset-3 col-sm-6 scol-sm-1 escoltas" style="margin-top:18px;" onclick="escoltas()">
        <a href="#" class="requisitoss col-sm-12 text-center">
            <h4>Concurso de escoltas</h4>
            <i class="fa fa-flag-o fa-5x"></i>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aliquam error sint optio alias minus, nisi officia, aperiam dignissimos molestias necessitatibus. Temporibus, possimus laudantium iure. Veniam voluptatum laudantium natus enim.</p>
        </a>
    </div>
    {{ Form::open(array('id' => 'formulario','url'=>'#','class'=>'hidden col-md-offset-1 col-md-10 form-group')) }}
    <!-- <div id="formulario" class="hidden2 col-md-offset-1 col-md-10 form-group"> -->
        <div class="col-md-12">
            <h4>Registro del responsable</h4>
            <div class="col-md-4 form-group">
                {{ Form::label('nombre', 'Nombre (s)',array('class' => 'control-label')) }}
                {{ Form::text('nombre', null, array('class' => 'form-control','autofocus')) }}
            </div>
            <div class="col-md-4 form-group">
                {{ Form::label('paterno', 'Apellido paterno') }}
                {{ Form::text('paterno', null, array('class' => 'form-control')) }}
            </div>
            <div class="col-md-4 form-group">
                {{ Form::label('materno', 'Apellido materno') }}
                {{ Form::text('materno', null, array('class' => 'form-control')) }}
            </div>
            <div class="col-md-4 form-group">
                {{ Form::label('telefono', 'Telefono') }}
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                    {{ Form::text('telefono', null, array('class' => 'form-control mayuscula')) }}
                </div>
            </div>
            <div class="col-md-4 form-group">
                {{ Form::label('email', 'email') }}
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-at"></i></div>
                    {{ Form::text('email', null, array('class' => 'form-control mayuscula')) }}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
            <h4 onclick="ejemplo()">Registro de integrantes del equipo</h4>
            <div class="anadidos col-md-12" style="margin-top:10px;">
            </div>
            <div class="botonagregar col-md-4" data-toggle="modal" data-target="#myModal" onclick="limpio();">
                <a class="anadir"><i class="fa fa-plus"></i></a>
            </div>
            <div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Registro de integrante</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                {{ Form::label('concursantenombre', 'Nombre (s)',array('class' => 'control-label')) }}
                                {{ Form::text('concursantenombre', null, array('class' => 'form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('concursantepaterno', 'Apellido paterno') }}
                                {{ Form::text('concursantepaterno', null, array('class' => 'form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('concursantematerno', 'Apellido materno') }}
                                {{ Form::text('concursantematerno', null, array('class' => 'form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('concursantetelefono', 'Telefono') }}
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                    {{ Form::text('concursantetelefono', null, array('class' => 'form-control mayuscula')) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('concursanteemail', 'email') }}
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-at"></i></div>
                                    {{ Form::text('concursanteemail', null, array('class' => 'form-control mayuscula')) }}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary guardar" data-dismiss="modal" onclick="addintegrante()">Guardar</button>
                            <span id="actualizar"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
            <h4>Registro datos del equipo</h4>
            <div class="col-md-3 form-group">
                {{ Form::label('estado', 'Estado') }}
                <select class="form-control" name="state" id="state">
                    <option value="Aguascalientes">Aguascalientes</option>
                    <option value="Baja California">Baja California</option>
                    <option value="Baja California Sur">Baja California Sur</option>
                    <option value="Campeche">Campeche</option>
                    <option value="Chiapas">Chiapas</option>
                    <option value="Chihuahua">Chihuahua</option>
                    <option value="Coahuila">Coahuila</option>
                    <option value="Colima">Colima</option>
                    <option value="Distrito Federal">Distrito Federal</option>
                    <option value="Durango">Durango</option>
                    <option value="Estado de México">Estado de México</option>
                    <option value="Guanajuato">Guanajuato</option>
                    <option value="Guerrero">Guerrero</option>
                    <option value="Hidalgo">Hidalgo</option>
                    <option value="Jalisco">Jalisco</option>
                    <option value="Michoacán">Michoacán</option>
                    <option value="Morelos">Morelos</option>
                    <option value="Nayarit">Nayarit</option>
                    <option value="Nuevo León">Nuevo León</option>
                    <option value="Oaxaca">Oaxaca</option>
                    <option value="Puebla">Puebla</option>
                    <option value="Querétaro">Querétaro</option>
                    <option value="Quintana Roo">Quintana Roo</option>
                    <option value="San Luis Potosí">San Luis Potosí</option>
                    <option value="Sinaloa">Sinaloa</option>
                    <option value="Sonora">Sonora</option>
                    <option value="Tabasco">Tabasco</option>
                    <option value="Tamaulipas">Tamaulipas</option>
                    <option value="Tlaxcala">Tlaxcala</option>
                    <option value="Veracruz">Veracruz</option>
                    <option value="Yucatán">Yucatán</option>
                    <option value="Zacatecas">Zacatecas</option>
                </select>
            </div>
            <div class="col-md-4 form-group">
                {{ Form::label('escuela', 'Escuela') }}
                {{ Form::text('escuela', null, array('class' => 'form-control')) }}
            </div>
        </div>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="btnenviar()">Enviar</button>
    <!-- </div> -->
    {{Form::close()}}
@stop
@section('scripts')
    <script>
        var id = 0;
        var arr = [];
        function escoltas () {
            $('.escoltas').addClass('hidden');
            $('#formulario').removeClass('hidden');
        }
        function addintegrante() {
            nombre = $( "input[name$='concursantenombre']" ).val();
            paterno = $( "input[name$='concursantepaterno']" ).val();
            materno = $( "input[name$='concursantematerno']" ).val();
            telefono = $( "input[name$='concursantetelefono']" ).val();
            email = $( "input[name$='concursanteemail']" ).val();
            $('.anadidos').append('<div id="'+id+'" class="col-md-4" style="margin-top: 10px;"><div class="persona col-md-4" data-toggle="modal" data-target="#myModal" onclick="mostrarmodal('+id+')"><a class="anadir"><i class="fa fa-user"></i></a></div><div class="col-md-8" style="top:-5px;"><p><h4><span class="text-capitalize spannombre">'+nombre+'</span><span class="text-capitalize spanpaterno"> '+paterno+'</span><span class="text-capitalize spanmaterno"> '+materno+'</span><span class="text-capitalize hidden spantelefono"> '+telefono+'</span><span class="text-capitalize hidden spanemail"> '+email+'</span></h4></p></div></div>');
            guardar(id);
            id++;
        }
        function mostrarmodal (id) {
            nombre = $( "input[name$='concursantenombre']" ).val(arr[id].nombre);
            paterno = $( "input[name$='concursantepaterno']" ).val(arr[id].paterno);
            materno = $( "input[name$='concursantematerno']" ).val(arr[id].materno);
            telefono = $( "input[name$='concursantetelefono']" ).val(arr[id].telefono);
            email = $( "input[name$='concursanteemail']" ).val(arr[id].email);
            $('.guardar').addClass('hidden');
            $('#actualizar').html('<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="eliminar('+id+')">Eliminar</button><button type="button" class="btn btn-primary" data-dismiss="modal" onclick="actualizar('+id+')" style="margin-top: 0px">Actualizar</button>');

        }
        function actualizar (id) {
            nombre = $( "input[name$='concursantenombre']" ).val();
            paterno = $( "input[name$='concursantepaterno']" ).val();
            materno = $( "input[name$='concursantematerno']" ).val();
            telefono = $( "input[name$='concursantetelefono']" ).val();
            email = $( "input[name$='concursanteemail']" ).val();
            guardar(id);
            $('#'+id+'').html('<div class="persona col-md-4" data-toggle="modal" data-target="#myModal" onclick="mostrarmodal('+id+')"><a class="anadir"><i class="fa fa-user"></i></a></div><div class="col-md-8" style="top:-5px;"><p><h4><span class="text-capitalize spannombre">'+nombre+'</span><span class="text-capitalize spanpaterno"> '+paterno+'</span><span class="text-capitalize spanmaterno"> '+materno+'</span><span class="text-capitalize hidden spantelefono"> '+telefono+'</span><span class="text-capitalize hidden spanemail"> '+email+'</span></h4></p></div>');

        }
        function eliminar (id) {
            if(arr.length == 1){
                arr = [];
            }else{
                delete arr[id];
            }
            $('#'+id+'').addClass('hidden');
        }
        function limpio () {
            $( "input[name$='concursantenombre']" ).val('');
            $( "input[name$='concursantepaterno']" ).val('');
            $( "input[name$='concursantematerno']" ).val('');
            $( "input[name$='concursantetelefono']" ).val('');
            $( "input[name$='concursanteemail']" ).val('');
            $('.guardar').removeClass('hidden');
            $('#actualizar').html('');
        }
        function guardar (id) {
            arr[id] = {
                nombre:nombre,
                paterno:paterno,
                materno:materno,
                telefono:telefono,
                email:email,
            };
        }
        function btnenviar () {
            nombre = $( "input[name$='nombre']" ).val();
            paterno = $( "input[name$='paterno']" ).val();
            materno = $( "input[name$='materno']" ).val();
            telefono = $( "input[name$='telefono']" ).val();
            email = $( "input[name$='email']" ).val();
            estado = $( "#state" ).val();
            escuela = $( "input[name$='escuela']" ).val();
            data = {
                lider:{
                    nombre:nombre,
                    paterno:paterno,
                    materno:materno,
                    telefono:telefono,
                    email:email,
                },
                integrantes:arr,
                equipo:{
                    estado:estado,
                    escuela:escuela,
                }
            }
            // console.log(arr);
            $.post('concursos/guardar',{data:data}, function(json) {
                console.log(json);
            }, 'json');
        }
        $(document).ready(function() {
            $('#dashboard-menu').addClass('hidden');
            $('#formulario2').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    nombre: {
                        validators: {
                            notEmpty: {}
                        }
                    },
                    concursantenombre:{
                        validators: {
                            notEmpty: {}
                        }
                    },
                }
            })
        });
    </script>
@endsection