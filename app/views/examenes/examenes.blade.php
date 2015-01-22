@extends('layaouts.base')

@section('titulo')
  Examenes | PDMU
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
    <div class="col-md-8 col-md-offset-1">
        <h1 style="margin-bottom:20px;"><i class="fa  fa-file-text-o"></i> Exámenes</h1>
    </div>
    <div class="col-md-2" style="margin-top:20px;">
        <button type="button" class="btn btn-success btn-lg" id="bnuevo"><i class="fa fa-plus fa-lg"></i> Nuevo</button>
    </div>   
    <div class="message col-md-6 col-md-offset-3 hidden">
        @if($status == 'fail_create')
        <label id="status_title">Error</label>
            <label id="status">error</label>
            <label id="message">Ocurrio un error</label>
        @elseif(($status == 'ok_create'))
        <label id="status_title">Operacion completada correctamente</label>
            <label id="status">success</label>
            <label id="message"></label>
        @elseif(($status == 'ocupado'))
        <label id="status_title">Error</label>
            <label id="status">error</label>
            <label id="message">Ya existe un examen con ese nombre y grado</label>
        @endif
    </div> 
	<div class="col-md-8 col-md-offset-2">
		<table id='companias'class="table table-hover table-first-column-number data-table display full">
			<thead>
				<tr>
					<th><i class="fa fa-sort-desc"></i></th>
					<th>Nombre <i class="fa fa-sort-desc"></i></th>
					<th>Entero <i class="fa fa-sort-desc"></i></th>
					<th>Grado <i class="fa fa-sort-desc"></i></th>
					<th>Editar</th>
				</tr>
			</thead>
			<tbody>
				@if(isset($examenes))
				@foreach($examenes as $examen)
				<tr>
				<td>{{ $examen->id }}</td>
				<td>{{ $examen->nombre }}</td>
				<td>${{ $examen->precio }}</td>
				<td>{{ $examen->grado->nombre }}</td>
				<td>
					<button type="button" onclick="editar(this)" class="btn btn-info select btn-xs">Editar</button> 
                </td>
				</tr>  
				@endforeach 
				@else
				<div class="alert alert-danger fade in">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<strong>Error</strong>Todavia no hay Exámenes registrados.
				</div>
				@endif	
			</tbody>
		</table>
	</div>
<!-- Modal -->
  <div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="examen">
            <i class="fa fa-pencil-square-o fa-lg"></i> Examen
          </h4>
        </div>
        {{ Form::open(array('url' => 'examenes/nuevo','role' => 'form','id' => 'nuevo-examen','class' => '')) }}
        <div class="modal-body">
            <center>
            <h2 name="name"><i class="fa fa-pencil"></i> Nuevo examen</h2>
            <i class="fa fa-refresh fa-spin hidden fa-2x"></i>
            </center>            
            <div class="form-group">  
              {{ Form::label('nombre', 'Nombre',array('class' => 'control-label')) }}
              {{ Form::text('nombre', null, array('placeholder' => 'introduce nombre','class' => 'form-control')) }}
            </div>
            <div class="form-group">
              {{ Form::label('grado', 'Grado',array('class' => 'control-label','name' => 'tipo')) }}
              {{ Form::select('grado', $grados,null,array('placeholder' => '','class' => 'form-control')) }}
            </div>
            <div class="form-group">
              {{ Form::label('precio', 'Entero',array('class' => 'control-label')) }}
              <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-usd fa-fw"></i></span>
                    {{ Form::text('precio', null, array('class' => 'form-control')) }}
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button id='bcancelar' type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
            {{ Form::button('<i class="fa fa-floppy-o "></i> Guardar',array('class' => 'btn btn-success','id' => 'guardar','type' => 'submit')) }}
        </div> 
        {{ Form::close() }}
      </div>
    </div>
  </div>
  <!-- End Modal -->
<!-- Modal -->
  <div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="examen">
            <i class="fa fa-pencil-square-o fa-lg"></i> Exámen
          </h4>
        </div>
        {{ Form::open(array('url' => 'examenes/update','role' => 'form','id' => 'edit','class' => '')) }}
        <div class="modal-body">
            <center>
            <h2 name="name"><i class="fa fa-pencil"></i> Nuevo exámen</h2>
            <i class="fa fa-refresh fa-spin hidden fa-2x"></i>
            </center>      
            {{ Form::text('id', null, array('class' => 'hidden')) }}      
            <div class="form-group">  
              {{ Form::label('nombre', 'Nombre',array('class' => 'control-label')) }}
              {{ Form::text('nombre', null, array('placeholder' => 'introduce nombre','class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('grado', 'Grado',array('class' => 'control-label','name' => 'tipo')) }}
                {{ Form::select('grado', $grados,null,array('placeholder' => '','class' => 'form-control')) }}  
            </div>
            <div class="form-group">
              {{ Form::label('precio', 'Entero',array('class' => 'control-label')) }}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-usd fa-fw"></i></span>
                    {{ Form::text('precio', null, array('class' => 'form-control')) }}
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button id='bcancelar' type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
            {{ Form::button('<i class="fa fa-floppy-o "></i> Guardar',array('class' => 'btn btn-success','id' => 'guardar','type' => 'submit')) }}
        </div> 
        {{ Form::close() }}
      </div>
    </div>
  </div>
  <!-- End Modal -->
</div>
@endsection
@section('scripts')
{{  HTML::script('js/tables/jquery.dataTables.min.js'); }}
{{  HTML::script('js/tables/jquery.dataTables.bootstrap.js'); }}
{{  HTML::script('js/bootstrapValidator.js'); }}
{{  HTML::script('js/es_ES.js'); }}
{{  HTML::script('js/sweet-alert.min.js'); }}
<script type="text/javascript">
    $('#companias').dataTable( {
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
    $('#nuevo-examen').bootstrapValidator({
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
                    },
                    stringLength:{
                      max: 15,
                    }
                }
            },
            enabled: false,
            precio: {
                validators: {
                    notEmpty: {
                    },
                    integer: {
                    },
                    stringLength:{
                      max: 4,
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
                    },
                    stringLength:{
                      max: 15,
                    }
                }
            },
            enabled: false,
            precio: {
                validators: {
                    notEmpty: {
                    },
                    integer: {
                    },
                    stringLength:{
                      max: 4,
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
});
$('#nuevo').on('hide.bs.modal', function() {
    $('#nuevo-examen').bootstrapValidator('resetForm', true);
});
$('#editar').on('hide.bs.modal', function() {
    $('#edit').bootstrapValidator('resetForm', true);
    $("tbody").find('tr').removeClass('danger').find('button').attr('disabled',false);
});
$('#Examenes,#2Examenes').addClass('active');
function editar(btn){
	$(btn).closest("tbody").find('tr').removeClass('danger').find('button').attr('disabled',false);
	$(btn).attr('disabled',true).closest("tr").addClass('danger');
	$('#editar').modal('show');
	$('[name = name]').text($(btn).closest("tr").find("td:nth-child(2)").text());
	$('[name = id]').val($(btn).closest("tr").find("td:nth-child(1)").text());
	$('[name = nombre]').val($(btn).closest("tr").find("td:nth-child(2)").text());
    $('[name = grado] option').each(function( index, opt ) {
        if($(opt).text() == $(btn).closest("tr").find("td:nth-child(4)").text() )
            $(opt).attr('selected', true);
    });
    $('[name = precio]').val($(btn).closest("tr").find("td:nth-child(3)").text().match(/\d+/));
}
$('#status').change(function(){
    setTimeout (function () {
        swal($('#status_title').text(), $('#message').text(), $('#status').text())
    }, 1000);
}).change();
</script>
@endsection