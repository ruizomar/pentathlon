@extends('layaouts.public')
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
        <h1 style="margin-bottom:20px;"><i class="fa fa-trophy"></i> Concurso Nacional de Escoltas</h1>
    </div>
    <div class="hidden col-sm-offset-3 col-sm-6 scol-sm-1 escoltas" style="margin-top:18px;" onclick="escoltas()">
        <a href="#" class="requisitoss col-sm-12 text-center">
            <h4>Concurso de escoltas</h4>
            <i class="fa fa-flag-o fa-5x"></i>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aliquam error sint optio alias minus, nisi officia, aperiam dignissimos molestias necessitatibus. Temporibus, possimus laudantium iure. Veniam voluptatum laudantium natus enim.</p>
        </a>
    </div>
    <div id="formulario" class="col-md-offset-2 col-md-8">
        <div class="col-md-12">
            <div class="row">
                <h4>Registro datos del equipo</h4>
                <div class="col-md-4 form-group">
                    {{ Form::label('escuela', 'Escuela') }}
                    {{ Form::text('escuela', null, array('class' => 'form-control','autofocus')) }}
                </div>
                <div class="col-md-4 form-group">
                    {{ Form::label('Nivel', 'Nivel Académico') }}
                    <select class="form-control" name="nivel" id="nivel">
                        <option value="Secundaria">Secundaria</option>
                        <option value="Bachillerato">Bachillerato</option>
                        <option value="Licenciatura">Licenciatura</option>
                    </select>
                </div>
                <div class="col-md-4 form-group">
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
            </div>
        </div>
        <div class="col-md-12">
            <hr>
            <div class="row">
                <h4>Registro del responsable</h4>
                <div class="col-md-4 form-group">
                    {{ Form::label('nombre', 'Nombre (s)',array('class' => 'control-label')) }}
                    {{ Form::text('nombre', null, array('class' => 'form-control')) }}
                </div>
                <div class="col-md-4 form-group">
                    {{ Form::label('paterno', 'Apellido paterno') }}
                    {{ Form::text('paterno', null, array('class' => 'form-control')) }}
                </div>
                <div class="col-md-4 form-group">
                    {{ Form::label('materno', 'Apellido materno') }}
                    {{ Form::text('materno', null, array('class' => 'form-control')) }}
                </div>
            </div>
            <div class="row">
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
        </div>
        <div class="col-md-12">
            <hr>
            <h4 onclick="ejemplo()">Registro de integrantes del equipo</h4>
            <div class="anadidos col-md-12" style="margin-top:10px;">
            </div>
            <div class="botonagregar col-md-4" data-toggle="modal" data-target="#myModal" onclick="limpio();">
                <a class="anadir"><i class="fa fa-plus"></i></a>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
            <h4>Acompañante del PDMU</h4>
            <div class="row">
                <div class="col-md-4 form-group">
                    {{ Form::label('nombrePDMU', 'Nombre (s)',array('class' => 'control-label')) }}
                    {{ Form::text('nombrePDMU', null, array('class' => 'form-control','autofocus')) }}
                </div>
                <div class="col-md-4 form-group">
                    {{ Form::label('paternoPDMU', 'Apellido paterno') }}
                    {{ Form::text('paternoPDMU', null, array('class' => 'form-control')) }}
                </div>
                <div class="col-md-4 form-group">
                    {{ Form::label('maternoPDMU', 'Apellido materno') }}
                    {{ Form::text('maternoPDMU', null, array('class' => 'form-control')) }}
                </div>
            </div>
        </div>
        <button type="button" class="pull-right btn btn-primary" data-dismiss="modal" onclick="btnenviar()">Enviar</button>
    </div>
    <div id="formulariomodal" class="col-md-offset-2 col-md-8">
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
                        <div id="cargo">
                            {{ Form::label('posicion', 'Posición') }}
                            <select class="form-control" name="posicion" id="posicion">
                                <option value="Abanderado">Abanderado</option>
                                <option value="Sargento">Sargento</option>
                                <option value="Escolta derecho">Escolta derecho</option>
                                <option value="Escolta izquierdo">Escolta izquierdo</option>
                                <option value="Guardia derecho">Guardia derecho</option>
                                <option value="Guardia izquierdo">Guardia izquierdo</option>
                            </select>
                            <label class="pull-right label label-warning">Una vez elegido, no puedes cambiarlo</label>
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
@stop
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#formulariomodal').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    concursantenombre: {
                        validators: {
                            notEmpty: {}
                        }
                    },
                    concursantepaterno: {
                        validators: {
                            notEmpty: {}
                        }
                    },
                }
            });
            $('#formulario').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    escuela:{
                        validators:{
                            notEmpty :{},
                        }
                    },
                    nombre:{
                        validators:{
                            notEmpty :{},
                        }
                    },
                    paterno:{
                        validators:{
                            notEmpty :{},
                        }
                    },
                    telefono: {
                        validators: {
                            integer:{
                            },
                            stringLength: {
                                min: 7,
                                max:10,
                            },
                        }
                    },
                    email:{
                        validators:{
                            notEmpty :{},
                            emailAddress: {}
                        }
                    },
                    nombrePDMU:{
                        validators:{
                            notEmpty :{},
                        }
                    },
                    paternoPDMU:{
                        validators:{
                            notEmpty :{},
                        }
                    },
                }
            });
        });
    </script>
    <script>
        var count = 0;
        var arr = [];
        function escoltas () {
            $('.escoltas').addClass('hidden');
            $('#formulario').removeClass('hidden');
        }
        function addintegrante() {
            nombre = $( "input[name$='concursantenombre']" ).val();
            paterno = $( "input[name$='concursantepaterno']" ).val();
            materno = $( "input[name$='concursantematerno']" ).val();
            posicion = $( "#posicion" ).val();
            $('.anadidos').append('<div id="'+count+'" class="col-md-4" style="margin-top: 10px;"><div class="persona col-md-4" data-toggle="modal" data-target="#myModal" onclick="mostrarmodal('+count+')"><a class="anadir"><i class="fa fa-user"></i></a></div><div class="col-md-8" style="top:-5px;"><p><h4><span class="text-capitalize spannombre">'+nombre+'</span><span class="text-capitalize spanpaterno"> '+paterno+'</span><span class="text-capitalize spanmaterno"> '+materno+'</span><br><label class="label label-success text-capitalize"> '+posicion+'</label></h4></p></div></div>');
            guardar(count);
            count++;
            $("#posicion").find("option:selected").remove();
        }
        function mostrarmodal (id) {
            nombre = $( "input[name$='concursantenombre']" ).val(arr[id].nombre);
            paterno = $( "input[name$='concursantepaterno']" ).val(arr[id].paterno);
            materno = $( "input[name$='concursantematerno']" ).val(arr[id].materno);
            posicion = $( "#posicion" ).val();
            $('.guardar').addClass('hidden');
            $('#cargo').addClass('hidden');
            $('#actualizar').html('<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="actualizar('+id+')" style="margin-top: 0px">Actualizar</button>');

        }
        function actualizar (id) {
            nombre = $( "input[name$='concursantenombre']" ).val();
            paterno = $( "input[name$='concursantepaterno']" ).val();
            materno = $( "input[name$='concursantematerno']" ).val();
            posicion = arr[id].posicion;
            guardar(id);
            $('#'+id+'').html('<div class="persona col-md-4" data-toggle="modal" data-target="#myModal" onclick="mostrarmodal('+id+')"><a class="anadir"><i class="fa fa-user"></i></a></div><div class="col-md-8" style="top:-5px;"><p><h4><span class="text-capitalize spannombre">'+nombre+'</span><span class="text-capitalize spanpaterno"> '+paterno+'</span><span class="text-capitalize spanmaterno"> '+materno+'</span><br><label class="label label-success text-capitalize"> '+arr[id].posicion+'</label></h4></p></div>');
        }
        function limpio () {
            $( "input[name$='concursantenombre']" ).val('');
            $( "input[name$='concursantepaterno']" ).val('');
            $( "input[name$='concursantematerno']" ).val('');
            $('.guardar').removeClass('hidden');
            $('#cargo').removeClass('hidden');
            $('#actualizar').html('');
            if (arr.length == 5) {
                $('.botonagregar').addClass('hidden');
            };
        }
        function guardar (id) {
            arr[id] = {
                nombre:nombre,
                paterno:paterno,
                materno:materno,
                posicion:posicion,
            };
        }
        function btnenviar () {
            swal({
                    title: '¿Estás seguro?',
                    text: 'Se guardarán tus datos para el día del evento',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#AEDEF4',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No, regresar a revisar',
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm){
                        nombre = $( "input[name$='nombre']" ).val();
                        paterno = $( "input[name$='paterno']" ).val();
                        materno = $( "input[name$='materno']" ).val();
                        telefono = $( "input[name$='telefono']" ).val();
                        email = $( "input[name$='email']" ).val();
                        estado = $( "#state" ).val();
                        escuela = $( "input[name$='escuela']" ).val();
                        nivel = $( "#nivel" ).val();
                        nombrePDMU = $("input[name$='nombrePDMU']").val();
                        paternoPDMU = $("input[name$='paternoPDMU']").val();
                        maternoPDMU = $("input[name$='maternoPDMU']").val();
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
                                nivel:nivel
                            },
                            pdmu:{
                                nombre:nombrePDMU,
                                paterno:paternoPDMU,
                                materno:maternoPDMU,
                            }
                        }
                        $.post('concursos/guardar',{data:data}, function(json) {
                            if (json.success) {
                                swal('!Hecho!', 'Se ha guardado el cargo', 'success');
                                location.reload();
                            }
                            else{
                                sweetAlert("Oops...", json.errormessage, "error");
                            }
                        }, 'json');
                    }
                    else {
                        swal({
                            title:'Cancelado',
                            text:'No se ha guardado ningun cambio',
                            type: 'error',
                            timer: 1000
                        });
                    }
                });
        }
    </script>
@endsection