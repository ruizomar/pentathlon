@extends('layaouts.base')

@section('titulo')
  Asistencias | PDMU
@endsection
@section('head')
<style type="text/css">
.fecha{
    right: 120px !important;
}
.boton{
    margin-left: 10px !important;
}
</style>
{{  HTML::style('css/bootstrap-datetimepicker.min.css');  }}
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
    <form action="{{ URL::to('asistencias/nueva'); }}" method="POST" accept-charset="utf-8" id="asis">
		<table id='elementos'class="table table-bordered table-hover table-first-column-number data-table display full">
			<thead>
				<tr>
                    <th>
                    <div class="form-group">
                        <div class="input-group date" id="datetimePicker">
                            <input type="text" class="form-control" name="fecha" placeholder="YYYY-MM-DD" data-date-format="YYYY-MM-DD"/>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                        <input type="text" class="hidden"name="instructor" value="{{ $id }}">
                                <button type="submit" class="btn btn-success btn-sm boton">Guardar</button>
                    </div>
                    </th>
					<th>Matricula <i class="fa fa-sort-desc"></i></th>
					<th>Nombre <i class="fa fa-sort-desc"></i></th>
                    @if(isset($fechas))
                        @foreach($fechas as $fecha)
					       <th>{{ $fecha->fecha }}</th>
                        @endforeach
                    @endif
                    
				</tr>
			</thead>
			<tbody>
                @if(isset($elementos))
                    @foreach($elementos as $elemento)
                        @if ($elemento->status()->orderBy('inicio','desc')->first()->tipo == 'Activo') 
                            <tr>
                                <td>
                                    <select name="{{ $elemento->id }}" class="form-control">
                                        <option value="1">Asistencia</option>
                                        <option value="0">Falta</option>
                                        <option value="2">Permiso</option>
                                    </select> 
                                </td>      
                            <td>
                                @if(is_null($elemento->matricula))
                                    Sin matricula
                                @else
                                    {{  $elemento->matricula->id }}
                                @endif    
                            </td>
                            <td>{{ $elemento->persona->nombre }} {{ $elemento->persona->apellidopaterno }} {{ $elemento->persona->apellidomaterno }}</td>
                            <?php $asistencias = $elemento->asistencias()
                                                    ->orderBy('fecha','desc')
                                                    ->take(4)->get();
                            ?>
                            @if(count($asistencias) > 0)
                                @foreach($asistencias as $asistencia)
                                    <td>{{ $asistencia->tipo }}</td>
                                @endforeach
                            <?php   $i = count($asistencias);   ?> 
                            @else
                            <?php  $i=0 ?>
                            @endif
                                @for ($i; $i < count($fechas); $i++)
                                    <td> - </td>
                                @endfor
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
<!-- Modal -->
  <div class="modal fade" id="Elemento" tabindex="-1" role="dialog" aria-labelledby="Elemento" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="Elemento">
            <i class="fa fa-eye"></i> Inasistencia prolongada
          </h4>
        </div>
        <div class="modal-body">

          

        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal --> 
@endsection
@section('scripts')
{{  HTML::script('js/tables/jquery.dataTables.min.js'); }}
{{  HTML::script('js/tables/jquery.dataTables.bootstrap.js'); }}
{{  HTML::script('js/bootstrapValidator.js'); }}
{{  HTML::script('js/es_ES.js'); }}
{{  HTML::script('js/moment.js'); }}
{{  HTML::script('js/bootstrap-datetimepicker.js'); }}
{{  HTML::script('js/bootstrap-datetimepicker.es.js'); }}
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
    $('#datetimePicker').datetimepicker({
        language: 'es',
        pickTime: false
    });

    $('#asis').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok fecha',
            invalid: 'glyphicon glyphicon-remove fecha',
            validating: 'glyphicon glyphicon-refresh fecha'
        },
        fields: {
            fecha: {
                validators: {
                    notEmpty: {
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                    }
                }
            }
        }
    })
    .on('success.form.bv', function(e) {
            $('.fa-spin').removeClass('hidden');
    });

    $('#datetimePicker').on('dp.change dp.show', function(e) {
        $('#asis').bootstrapValidator('revalidateField', 'fecha');
    });
    $('#main-menu').find('li').removeClass('active');
    $('#main-menu ul li:nth-child(4)').addClass('active');
});
</script>
<script type="text/javascript" charset="utf-8">
    $( "select" ).change(function () {
        if($(this).val() == 0 && $(this).closest("tr").find("td:nth-child(4)").text() == 0 && $(this).closest("tr").find("td:nth-child(5)").text() == 0 && $(this).closest("tr").find("td:nth-child(6)").text() == 0 && $(this).closest("tr").find("td").length >= 6)
            message($(this).attr('name'))
  });
function message(id){
    $.post("{{ URL::to('asistencias/elemento'); }}", 'id='+id, function(json) {
            $('.modal-body').html('');
            $('.modal-body').append('<h2>Elemento:</h2>');
            $('.modal-body').append('<label><strong>'+json.elemento.nombre+' '+json.elemento.apellidopaterno+' '+json.elemento.apellidomaterno+'</strong></label>');
            $(json.telefonosElemento).each(function() {
                $('.modal-body').append('<p>'+this.tipo+': '+this.telefono+'</p>');
            });
            if (json.correoElemento)
                $('.modal-body').append('<p>Email: '+json.correoElemento+'</p>');
            $('.modal-body').append('<h2>'+json.relacion+':</h2>');
            $('.modal-body').append('<label><strong>'+json.tutor.nombre+' '+json.tutor.apellidopaterno+' '+json.tutor.apellidomaterno+'</strong></label>');
            $(json.telefonosTutor).each(function() {
                $('.modal-body').append('<p>'+this.tipo+': '+this.telefono+'</p>');
            });
            if (json.correotutor)
                $('.modal-body').append('<p>Email: '+json.correotutor+'</p>');
        }, 'json');
    $('#Elemento').modal('show');
}    
</script>
@endsection