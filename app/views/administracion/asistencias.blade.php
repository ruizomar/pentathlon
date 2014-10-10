@extends('layaouts.base')

@section('titulo')
  Asistencias | PDMU
@endsection
@section('contenido')
<?php $status=Session::get('status'); ?>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        @if(isset($compania))
        <h1 style="margin-bottom:20px;">Registro de asistencias {{ $compania->tipo }} {{$compania->nombre }}  <i class="fa fa-refresh fa-spin hidden"></i></h1>
        @endif
    </div>
    <div class="message col-md-6 col-md-offset-3" style="">
        @if($status == 'fail_create')
        <div id="error" style="margin-top:10px;">
            <p class="alert alert-danger"><i class="fa fa-exclamation-triangle fa-lg"></i> Ocurrio un error 
            </p>
        </div>
        @elseif(($status == 'ok_create'))
        <div id="error" style="margin-top:10px;">
            <p class="alert alert-success"><i class="fa fa-check-square-o fa-lg"></i> Operacion completada correctamente
            </p>
        </div>
        @endif
    </div> 
	<div class="col-md-12 table-responsive">
<!------------------------form ----------------------------!-->        
    <form action="/asistencias/nueva" method="POST" accept-charset="utf-8" id="asis">
		<table id='elementos'class="table table-bordered table-hover table-first-column-number data-table display full">
			<thead>
				<tr>
					<th>Matricula <i class="fa fa-sort-desc"></i></th>
					<th>Nombre <i class="fa fa-sort-desc"></i></th>
                    @if(isset($fechas))
                        @foreach($fechas as $fecha)
					       <th>{{ $fecha->fecha }}</th>
                        @endforeach
                    @endif
                    <th>
                    <div class="form-group"> 
                        <input type="date" name="fecha" class="form-control input-sm"/>
                        <input type="text" class="hidden"name="instructor" value="{{ $fecha->elemento_id }}">
                        <button type="submit" class="btn btn-success btn-sm boton">Guardar</button>
                    </div>
                    </th>
				</tr>
			</thead>
			<tbody>
                @if(isset($elementos))
                    @foreach($elementos as $elemento)
                        @if ($elemento->status()->orderBy('inicio','desc')->first()->tipo == 'Activo') 
                            <tr>
                            <td>002579</td>
                            <td>{{ $elemento->persona->nombre }} {{ $elemento->persona->apellidopaterno }} {{ $elemento->persona->apellidomaterno }}</td>
                            <?php $asistencias = $elemento->asistencias()
                                                    ->orderBy('fecha','asc')
                                                    ->get();
                            ?>
                            @if(count($asistencias) > 0)
                                @foreach($elemento->asistencias()->orderBy('fecha','asc')->get() as $asistencia)
                                    <td>{{ $asistencia->tipo }}</td>
                                @endforeach
                                <td>
                                    <select name="{{ $elemento->persona->id }}" class="form-control">
                                        <option value="0">Falta</option>
                                        <option value="1">Asistencia</option>
                                        <option value="2">Permiso</option>
                                    </select>  
                                </td>
                            @endif    
                            </tr>
                        @endif  
                    @endforeach 
                @else
                    <div class="alert alert-danger fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>Error</strong>Todavia no hay Compañias registradas.
                    </div>
                @endif
			</tbody>
		</table>
    </form>
<!------------------------form ----------------------------!-->  
	</div>
</div>
@endsection
@section('scripts')
<style type="text/css">
.fech,.bv-no-label{
    margin-right: 65px !important;
}
.boton{
    margin-left: 10px !important;
}
</style>
<script type="text/javascript" src="/js/tables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/js/tables/jquery.dataTables.bootstrap.js"></script>
<script src="/js/bootstrapValidator.js" type="text/javascript"></script>
<script src="/js/es_ES.js" type="text/javascript"></script>
<script type="text/javascript">
    $('#elementos').dataTable( {
        "paging": false,
        "info":false,
        "language": {
            "lengthMenu": "Subzonas por página _MENU_",
            "zeroRecords": "No se encontro",
            "info": "Pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(Ver _MAX_ total records)",
            'search': 'Buscar: ',
        }
} );
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#asis').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok fech',
            invalid: 'glyphicon glyphicon-remove fech',
            validating: 'glyphicon glyphicon-refresh fech'
        },
        fields: {
            fecha: {
                validators: {
                    notEmpty: {
                    },
                    date:{
                        format: 'DD/MM/YYYY'
                    }
                }
            }
        }
    })
    .on('success.form.bv', function(e) {
            $('.fa-spin').removeClass('hidden');
        });
    $('#main-menu').find('li').removeClass('active');
    $('#main-menu ul li:nth-child(4)').addClass('active');
});
</script>
@endsection