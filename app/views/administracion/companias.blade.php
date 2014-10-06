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

        
    <div class="message col-md-6" style="top:50px; margin-left:30px;">
        @if($status == 'fail_create')
        <div id="error" style="margin-top:10px;">
            <p class="alert alert-danger"><i class="fa fa-exclamation-triangle fa-lg"></i> Ocurrio un error 
            </p>
        </div>
        @elseif(($status == 'ok_create'))
        <div id="error" style="margin-top:10px;">
            <p class="alert alert-success"><i class="fa fa-check-square-o fa-lg"></i> Se agrego correctamente
            </p>
        </div>
        @endif
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
        <div class="modal-body">
            <center>
            <h2 name="name"><i class="fa fa-pencil"></i> Nueva Subzona/Compañia</h2>
            <i class="fa fa-refresh fa-spin hidden fa-2x"></i>
            </center>
            {{ Form::open(array('url' => 'companias/update','role' => 'form','id' => 'update','class' => '')) }}
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
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
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
                $('.fa-refresh').removeClass('hidden');
            }
        });
    $('#bnueva').click(function(){
        $('#nueva').modal('show');
        $('[name=name]').html('<i class="fa fa-pencil"></i> Nueva Subzona/Compañia');
        $('[name=id]').val("");
        $('[name=nombre]').val("");
    });
});
function editar(btn){
	$(btn).closest("tbody").find('tr').removeClass('danger');
	$(btn).closest("tbody").find('button').attr('disabled',false);
	$(btn).closest("tr").addClass('danger');
	$(btn).attr('disabled',true);
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