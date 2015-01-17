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
</style>
@endsection
@section('contenido')
<?php $status=Session::get('status'); ?>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h1 style="margin-bottom:20px;"><i class="fa  fa-clock-o"></i> Historial</h1>
    </div>
    <div class="col-sm-2 text-center">
        <p class="" href="#enteros" data-toggle="tab" title="Enteros"><i class="btn btn-warning fa  fa-money fa-3x"></i></p>
        <p class="" href="#condecoraciones" data-toggle="tab" title="Condecoraciones"><i class="btn btn-warning fa  fa-shield fa-3x"></i></p>
        <p class="" href="#eventos" data-toggle="tab" title="Eventos"><i class="btn btn-warning fa  fa-calendar fa-3x"></i></p>
        <p class="" href="#examenes" data-toggle="tab" title="Examenes"><i class="btn btn-warning fa  fa-file-text-o fa-3x"></i></p>
    </div>
    <div class="col-sm-7 contenedor">
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
    <div class="col-sm-2 text-center">
        <p class="" href="#asistencias" data-toggle="tab" title="Asistencias"><i class="btn btn-warning fa  fa-calendar-o fa-3x"></i></p>
        <p class="" href="#cargos" data-toggle="tab" title="Cargos"><i class="btn btn-warning fa  fa-magic fa-3x"></i></p>
        <p class="" href="#ascensos" data-toggle="tab" title="Ascensos"><i class="btn btn-warning fa  fa-line-chart fa-3x"></i></p>
        <p class="" href="#arrestos" data-toggle="tab" title="Arrestos"><i class="btn btn-warning fa  fa-gavel fa-3x"></i></p>
    </div>
    <div id="reportes" class="tab-content">
        <div id="enteros" class="col-sm-6 col-sm-offset-3 tab-pane active">
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
        <div id="condecoraciones" class="col-sm-6 col-sm-offset-3 tab-pane">
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
        <div id="eventos" class="col-sm-6 col-sm-offset-3 tab-pane">
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
        <div id="examenes" class="col-sm-6 col-sm-offset-3 tab-pane">
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
        <div id="asistencias" class="col-sm-6 col-sm-offset-3 tab-pane">
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
        <div id="cargos" class="col-sm-6 col-sm-offset-3 tab-pane">
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
        <div id="ascensos" class="col-sm-6 col-sm-offset-3 tab-pane">
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
        <div id="arrestos" class="col-sm-6 col-sm-offset-3 tab-pane">
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
<script type="text/javascript">
    $('#armas').dataTable( {
        "language": {
            "lengthMenu": "Exámenes por página _MENU_",
            "zeroRecords": "No se encontro",
            "info": "Pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(Ver _MAX_ total records)",
            'search': 'Buscar: ',
            "paginate": {
        "first":      "Inicio",
        "last":       "Fin",
        "next":       "Siguiente",
        "previous":   "Anterior"
    },
        }
} );
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#nueva-arma').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok nombre',
            invalid: 'glyphicon glyphicon-remove nombre',
            validating: 'glyphicon glyphicon-refresh nombre'
        },
        fields: {
            enabled: false,
            nombre: {
                validators: {
                    notEmpty: {
                    }
                }
            },
            enabled: false,
            precio: {
                validators: {
                    notEmpty: {
                    },
                    integer: {
                    }
                }
            }
        }
    })
    .on('success.form.bv', function(e) {
        $('.fa-refresh').removeClass('hidden');
    });
    $('#edit').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok nombre',
            invalid: 'glyphicon glyphicon-remove nombre',
            validating: 'glyphicon glyphicon-refresh nombre'
        },
        fields: {
            enabled: false,
            nombre: {
                validators: {
                    notEmpty: {
                    }
                }
            },
            enabled: false,
            precio: {
                validators: {
                    notEmpty: {
                    },
                    integer: {
                    }
                }
            }
        }
    })
    .on('success.form.bv', function(e) {
        $('.fa-refresh').removeClass('hidden');
    });
});
$('#bnuevo').click(function(){
    $('#nuevo').modal('show');
    $("tbody").find('tr').removeClass('danger').find('button').attr('disabled',false);
    $('[name = name]').html('<i class="fa fa-pencil"></i> Nueva Arma');
    $('[name = nombre]').val('');
});
$('#nuevo').on('hide.bs.modal', function() {
    $('#nueva-arma').bootstrapValidator('resetForm', true);
});
$('#editar').on('hide.bs.modal', function() {
    $('#edit').bootstrapValidator('resetForm', true);
    $("tbody").find('tr').removeClass('danger').find('button').attr('disabled',false);
});
$('#Historial, #2Historial').addClass('active');
function editar(btn){
	$(btn).closest("tbody").find('tr').removeClass('danger').find('button').attr('disabled',false);
	$(btn).attr('disabled',true).closest("tr").addClass('danger');
	$('#editar').modal('show');
	$('[name = name]').text($(btn).closest("tr").find("td:nth-child(2)").text());
	$('[name = id]').val($(btn).closest("tr").find("td:nth-child(1)").text());
	$('[name = nombre]').val($(btn).closest("tr").find("td:nth-child(2)").text());
}
</script>
@endsection