@extends('layaouts.base')

@section('titulo')
  Subzonas|Compañias PDMU
@endsection
@section('contenido')
<?php $status=Session::get('status'); ?>
<div class="row">
    <div class="col-md-8 col-md-offset-1">
        <h1 style="margin-bottom:20px;">Subzonas y Compañias</h1>
    </div>
    <div class="col-md-2" style="margin-top:20px;">
        <button type="button" class="btn btn-success btn-lg" id="bnueva"><i class="fa fa-plus fa-lg"></i> Nueva</button>
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
	<div class="col-md-10 col-md-offset-1">
		<table id='companias'class="table table-hover table-first-column-number data-table display full">
			<thead>
				<tr>
					<th><i class="fa fa-sort-desc"></i></th>
					<th>Nombre <i class="fa fa-sort-desc"></i></th>
					<th>Tipo <i class="fa fa-sort-desc"></i></th>
					<th>Estatus <i class="fa fa-sort-desc"></i></th>
					<th>Editar</th>
				</tr>
			</thead>
			<tbody>
				@if(isset($companias))
				@foreach($companias as $compania)
				<tr>
				<td>{{ $compania->id }}</td>
				<td>{{ $compania->nombre }}</td>
				<td>{{ $compania->tipo }}</td>
				<td>{{ $compania->estatus }}</td>
				<td>
					<button type="button" onclick="editar(this)" class="btn btn-info select btn-xs">Editar</button></td>
				</tr>  
				@endforeach 
				@else
				<div class="alert alert-danger fade in">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<strong>Error</strong>Todavia no hay Compañias registradas.
				</div>
				@endif	
			</tbody>
		</table>
	</div>
<!-- Modal -->
  <div class="modal fade" id="nueva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="companias">
            <i class="fa fa-pencil-square-o fa-lg"></i> Subzonas/Compañias
          </h4>
        </div>
        {{ Form::open(array('url' => 'companias/update','role' => 'form','id' => 'update','class' => '')) }}
        <div class="modal-body">
            <center>
            <h2 name="name"><i class="fa fa-pencil"></i> Nueva Subzona/Compañia</h2>
            <i class="fa fa-refresh fa-spin hidden fa-2x"></i>
            </center>
            <div class="form-group">
                {{ Form::text('id', null, array('class' => 'form-control hidden')) }}
            </div>
            
            <div class="form-group">  
              {{ Form::label('nombre', 'Nombre',array('class' => 'control-label')) }}
              {{ Form::text('nombre', null, array('placeholder' => 'introduce nombre','class' => 'form-control')) }}
            </div>
            <div class="form-group">
              {{ Form::label('tipo', 'Tipo',array('class' => 'control-label','name' => 'tipo')) }}
              {{ Form::select('tipo', array('Subzona' => 'Subzona','Compañia' => 'Compañia'),null,array('placeholder' => '','class' => 'form-control')) }}
            </div>
            <div class="form-group">
              {{ Form::label('estatus', 'Estatus',array('class' => 'control-label')) }}
              {{Form::select('estatus', array('Activa' => 'Activa','Inactiva' => 'Inactiva'),null,array('placeholder' => '','class' => 'form-control')) }}
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
  <div class="modal fade" id="confirmar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content ">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="companias">
            <i class="fa fa-exclamation-triangle fa-lg text-danger"></i> Alerta
          </h4>
        </div>

        <div id="malert" class="modal-body">
            
            <h2 class=""><i class="fa fa-exclamation-triangle fa-lg text-danger"></i>  Esta operacion dara de baja a los elementos inscritos en esta 
            </h2>
           
        </div>

        <div class="modal-footer">
            <button id='bconfirmar' type="button" class="btn btn-info" data-dismiss="modal">OK</button>
        </div> 

      </div>
    </div>
  </div>
  <!-- End Modal -->  
</div>
@endsection
@section('scripts')
<style type="text/css">
.nombre{
	top: 20px !important;
}
</style>
<script type="text/javascript" src="js/tables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/tables/jquery.dataTables.bootstrap.js"></script>
<script src="js/bootstrapValidator.js" type="text/javascript"></script>
<script type="text/javascript">
    $('#companias').dataTable( {
        "language": {
            "lengthMenu": "Subzonas por página _MENU_",
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
    $('#update').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok nombre',
            invalid: 'glyphicon glyphicon-remove nombre',
            validating: 'glyphicon glyphicon-refresh nombre'
        },
        fields: {
            nombre: {
                validators: {
                    notEmpty: {
                    }
                }
            },
            id: {
                validators: {
                    integer: {
                    }
                }
            }
        }
    })
    .on('success.field.bv', function(e, data) {
            if (data.bv.getSubmitButton()) {
                data.bv.disableSubmitButtons(false);
            }
        })
    .on('success.form.bv', function(e) {
        $('.fa-refresh').removeClass('hidden');
    });
});
$('[name=estatus]').change(function() {
  if ($('[name=id]').val() != '' && $('[name=estatus]').val() == 'Inactiva') {
    $('#nueva').modal('hide');
    $tipe = $('#tipo').val();
    $('#malert').html('<h2 class=""><i class="fa fa-exclamation-triangle fa-lg text-danger"></i>  Esta operacion dara de baja a los elementos inscritos en esta '+$tipe+'.</h2>');
    $('#confirmar').modal('show');
    }
});
$('#bconfirmar').click(function(){
    $('#nueva').modal('show');
    $('#confirmar').modal('hide');
});
$('#bcancelar').click(function(){
    $("tbody").find('tr').removeClass('danger') .find('button').attr('disabled',false);
});
$('#bnueva').click(function(){
        $('#nueva').modal('show');
        $('[name=name]').html('<i class="fa fa-pencil"></i> Nueva Subzona/Compañia');
        $('[name=id]').val("");
        $('[name=nombre]').val("");
        $("tbody").find('tr').removeClass('danger') .find('button').attr('disabled',false);
    });
function editar(btn){
	$(btn).closest("tbody").find('tr').removeClass('danger').find('button').attr('disabled',false);
	$(btn).attr('disabled',true).closest("tr").addClass('danger');
	$('.message').addClass('hidden');
	$('#nueva').modal('show');
	$('[name=name]').text($(btn).closest("tr").find("td:nth-child(2)").text());
	$('[name=id]').val($(btn).closest("tr").find("td:nth-child(1)").text());
	$('[name=nombre]').val($(btn).closest("tr").find("td:nth-child(2)").text());
	$('[name=tipo] option[value='+$(btn).closest("tr").find("td:nth-child(3)").text()+']').attr('selected', true);
	$('[name=estatus] option[value='+$(btn).closest("tr").find("td:nth-child(4)").text()+']').attr('selected', true);
}
</script>
@endsection