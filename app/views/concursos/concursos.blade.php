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
        .agregar{
            width: 50px;
            height: 50px;
            background: #39a1f4;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 3px 3px 4px #aab2bd;
            -moz-box-shadow: 3px 3px 4px #aab2bd;
            -webkit-box-shadow: 3px 3px 4px #aab2bd;
        }
        .agregar:hover{
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
    <div class="hidden col-md-offset-3 col-md-6" style="margin-top:18px;">
        <a href="#" class="requisitos col-md-12 text-center" onclick="ejemplo()">
            <h4>Concurso de escoltas</h4>
            <i class="fa fa-flag-o fa-5x"></i>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aliquam error sint optio alias minus, nisi officia, aperiam dignissimos molestias necessitatibus. Temporibus, possimus laudantium iure. Veniam voluptatum laudantium natus enim.</p>
        </a>
    </div>
    {{ Form::open(array('id' => 'formularioalta','url'=>'#','class'=>'col-md-offset-1 col-md-10 form-group')) }}
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
            <h4>Registro del integrantes del equipo</h4>
            <div class="row"></div>

            <div class="botonagregar agregar col-md-4" data-toggle="modal" data-target="#myModal">
                <a class="anadir"><i class="fa fa-plus"></i></a>
            </div>
            <!-- Modal -->
            <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Registro de integrante</h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-4 form-group">
                                {{ Form::label('concursantenombr', 'Nombre (s)',array('class' => 'control-label')) }}
                                {{ Form::text('concursantenombr', null, array('class' => 'form-control')) }}
                            </div>
                            <div class="col-md-4 form-group">
                                {{ Form::label('concursantepatero', 'Apellido paterno') }}
                                {{ Form::text('concursantepatero', null, array('class' => 'form-control')) }}
                            </div>
                            <div class="col-md-4 form-group">
                                {{ Form::label('concursantematero', 'Apellido materno') }}
                                {{ Form::text('concursantematero', null, array('class' => 'form-control')) }}
                            </div>
                            <div class="col-md-4 form-group">
                                {{ Form::label('concursantedomicilio', 'Telefono') }}
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                    {{ Form::text('concursantedomicilio', null, array('class' => 'form-control mayuscula')) }}
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                {{ Form::label('concursanteemail', 'email') }}
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-at"></i></div>
                                    {{ Form::text('concursanteemail', null, array('class' => 'form-control mayuscula')) }}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-info" data-dismiss="modal">Close</button> -->
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
            <h4>Registro datos del equipo</h4>
            <div class="col-md-2 form-group">
                {{ Form::label('reclumaterno', 'Estado') }}
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
                {{ Form::label('reclumaterno', 'Escuela') }}
                {{ Form::text('reclumaterno', null, array('class' => 'form-control')) }}
            </div>
        </div>
    {{Form::close()}}
@stop
@section('scripts')
    <script>
        function mas(id) {
            $('.botonagregar').addClass('hidden');
            $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').focus()
              })
            // $( ".integrante" ).clone().append( ".otrointegrante" );
        }
        function otro () {
            console.log('sdsd');
        }
    </script>
@endsection