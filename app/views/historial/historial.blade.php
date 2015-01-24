@extends('layaouts.base')

@section('titulo')
  Historial | PDMU
@endsection
@section('head')
{{  HTML::style('css/sweet-alert.css');  }}
<style type="text/css">
.nombre{
    top: 25px !important;
}
.menu{
    background: #fff;
    padding: 10px;
    margin-bottom: 15px;
    box-shadow: 0px 3px 2px #aab2bd;
    -moz-box-shadow: 0px 3px 2px #aab2bd;
    -webkit-box-shadow: 0px 3px 2px #aab2bd;
    left: 12px;
    border-top-width: 3px;
    border-top-style: solid;
    border-top-color: #82B1FF;
    font-size: 19px;
}
.resultado{
    background: #fff;
    padding: 10px;
    margin-bottom: 15px;
    box-shadow: 0px 3px 2px #aab2bd;
    -moz-box-shadow: 0px 3px 2px #aab2bd;
    -webkit-box-shadow: 0px 3px 2px #aab2bd;
    left: 12px;
    border-top-width: 5px;
    border-top-style: solid;
    border-top-color: #F44336;
    font-size: 19px;
}
.menu:hover{
    background: #E3F2FD;
    cursor:pointer; cursor: hand;
}
</style>
@endsection
@section('contenido')
<?php $status=Session::get('status'); ?>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h1 style="margin-bottom:20px;"><i class="fa  fa-clock-o"></i> Historial</h1>
    </div>
    <div class="col-sm-3 text-center">
        <p class="menu" href="#enteros" data-toggle="tab" title="Enteros"><i class="fa fa-money pull-left"></i><span><strong> Enteros</strong></span></p>
        <p class="menu" href="#condecoraciones" data-toggle="tab" title="Condecoraciones"><i class="fa fa-shield pull-left"></i><span><strong> Condecoraciones</strong></span></p>
        <p class="menu" href="#eventos" data-toggle="tab" title="Eventos"><i class="fa fa-calendar pull-left"></i><span><strong> Eventos</strong></span></p>
        <p class="menu" href="#examenes" data-toggle="tab" title="Examenes"><i class="fa fa-file-text-o pull-left"></i><span><strong> Examenes</strong></span></p>
    </div>
    <div class="col-sm-6 contenedor" style="left:0px;">
        <div class="col-sm-3" style="margin-top: 20px;">
            <img id="fotoperfil" class="img-responsive img-thumbnail img-circle" alt="Responsive image" src="{{ asset($elemento->documentos()->where('tipo','=','fotoperfil')->first()->ruta) }}"/>
        </div>
        <div class="col-sm-8 col-sm-offset-1">
                <h2 id='lnombre'><strong>{{ $elemento->persona->nombre." ".$elemento->persona->apellidopaterno." ".$elemento->persona->apellidomaterno }}</strong></h2>
                <p id='lmatricula'><strong>Matrícula: </strong>{{  $elemento->matricula->id  }}</p>
                <p id='lfecha'><strong>Fecha de jura de bandera: </strong>{{  $elemento->status()->where('descripcion','=','Jura de Bandera')->first()->inicio  }}</p>
                <p id='lgrado'><strong>Grado: </strong>{{  $elemento->grados->last()->nombre  }}</p>
                <p id='ladscripcion'><strong>Adscripción: </strong>{{  $elemento->companiasysubzona->tipo  }}{{  $elemento->companiasysubzona->nombre  }}</p>
        </div>
    </div>
    <div class="col-sm-3 text-center">
        <p class="menu" href="#asistencias" data-toggle="tab" title="Asistencias"><i class="fa fa-calendar-o pull-left"></i><span><strong> Asistencias</strong></span></p>
        <p class="menu" href="#cargos" data-toggle="tab" title="Cargos"><i class="fa fa-magic pull-left"></i><span><strong> Cargos</strong></span></p>
        <p class="menu" href="#ascensos" data-toggle="tab" title="Ascensos"><i class="fa fa-line-chart pull-left"></i><span><strong> Ascensos</strong></span></p>
        <p class="menu" href="#arrestos" data-toggle="tab" title="Arrestos"><i class="fa fa-gavel pull-left"></i><span><strong class="font-size:23px;"> Arrestos</strong></span></p>
    </div>
    <div id="reportes" class="tab-content">
        <div id="enteros" class="resultado col-sm-6 col-sm-offset-3 tab-pane active">
            <h2>Membresías</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Membresía</th>
                        <th>Fecha</th>
                        <th>Entero</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($elemento->pagos()->where('concepto','like','Membresia%')->orderby('fecha','desc')->get() as $membresia)
                    <tr>
                        <td>{{ $membresia-> concepto}}</td>
                        <td>{{ $membresia-> fecha}}</td>
                        <td>${{ $membresia-> cantidad}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="condecoraciones" class="resultado col-sm-6 col-sm-offset-3 tab-pane">
            <h2>Condecoraciones</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($elemento->reconocimientos()->where('nombre','like','Condecoracion%')->orderby('fecha','asc')->get() as $condecoracion)
                    <tr>
                        <td>{{ $condecoracion-> nombre}}</td>
                        <td>{{ $condecoracion-> fecha}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="eventos" class="resultado col-sm-6 col-sm-offset-3 tab-pane">
            <h2>Eventos</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Entero</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($elemento->eventos()->where('fecha','<',date('Y-m-d'))->orderby('fecha','asc')->get() as $evento)
                    <tr>
                        <td>{{ $evento-> nombre}}</td>
                        <td>{{ $evento-> fecha}}</td>
                        <td>${{ $evento-> precio}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="examenes" class="resultado col-sm-6 col-sm-offset-3 tab-pane">
            <h2>Exámenes</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Examen</th>
                        <th>Fecha</th>
                        <th>Calificación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($elemento->examenes()->where('calificacion','!=','')->orderby('fecha','asc')->get() as $examen)
                    <tr>
                        <td>{{ $examen-> nombre}}</td>
                        <td>{{ $examen->pivot-> fecha}}</td>
                        <td>{{ $examen->pivot-> calificacion}}%</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="asistencias" class="resultado col-sm-6 col-sm-offset-3 tab-pane">
            <h2>Asistencias</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Compañía/Subzona</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($elemento->asistencias()->orderby('fecha','desc')->get() as $asistencia)
                    <tr>
                        <td>{{ $asistencia->companiasysubzona-> tipo}}
                            {{ $asistencia->companiasysubzona-> nombre}}</td>
                        <td>{{ $asistencia-> fecha}}</td>
                        <td>{{ $asistencia-> tipo}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="cargos" class="resultado col-sm-6 col-sm-offset-3 tab-pane">
            <h2>Cargos</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Cargo</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de fin</th>
                        <th>Compañía/subzona</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($elemento->cargos()->orderby('fecha_inicio','asc')->get() as $cargo)
                    <tr>
                        <td>{{ $cargo-> nombre}}</td>
                        <td>{{ $cargo->pivot-> fecha_inicio}}</td>
                        @if($cargo->pivot->fecha_fin == null)
                            <td>-</td>
                        @else
                            <td>{{ $cargo->pivot-> fecha_fin}}</td>
                        @endif
                        @if($cargo->nombre == 'Instructor')
                            @if($cargo->pivot->fecha_fin == null)
                                <td>{{$elemento->companiasysubzona->nombre}}</td>
                            @else
                            <?php $compania = $elemento->asistencias()->where('fecha','<',$cargo->pivot->fecha_fin)->where('fecha','>',$cargo->pivot->fecha_inicio)->first(); ?>
                                @if(!is_null($compania))
                                    <td>{{ $compania->companiasysubzona->nombre }}</td>
                                @else
                                    <td>-</td>
                                @endif    
                            @endif
                        @else
                            <td>-</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="ascensos" class="resultado col-sm-6 col-sm-offset-3 tab-pane">
            <h2>Ascensos</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Grado</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($elemento->grados()->orderby('fecha','asc')->get() as $grado)
                    <tr>
                        <td>{{ $grado-> nombre}}</td>
                        <td>{{ $grado->pivot-> fecha}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="arrestos" class="resultado col-sm-6 col-sm-offset-3 tab-pane">
            <h2>Arrestos</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Motivo</th>
                        <th>Sanción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($elemento->arrestos()->orderby('fecha','desc')->get() as $arresto)
                    <tr>
                        <td>{{ $arresto-> motivo}}</td>
                        <td>{{ $arresto-> sancion}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
{{  HTML::script('js/tables/jquery.dataTables.min.js'); }}
{{  HTML::script('js/tables/jquery.dataTables.bootstrap.js'); }}
{{  HTML::script('js/bootstrapValidator.js'); }}
{{  HTML::script('js/es_ES.js'); }}
{{  HTML::script('js/sweet-alert.min.js'); }}
@endsection