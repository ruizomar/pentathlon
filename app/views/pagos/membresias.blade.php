@extends('layaouts.base')
@section('titulo')
	Reporte de membresias
@endsection
@section('head')
	<style>
	</style>
	{{  HTML::script('js/tables/jquery.dataTables.min.js')}}
	{{  HTML::script('js/tables/jquery.tabletojson.min.js')}}
	{{  HTML::style('css/sweet-alert.css')}}
	{{  HTML::style('css/jquery.dataTables.css')}}
	{{  HTML::style('css/bootstrap-datetimepicker.min.css');  }}
	{{  HTML::script('js/bootstrapValidator.js'); }}
	{{  HTML::script('js/es_ES.js'); }}
	<style type="text/css" media="screen">
		.fecha{
			top:0 !important;
			right: 50px !important;
		}
	</style>
@endsection
@section('contenido')
	<div id="reportes" class="col-md-12">
		<br>
		    <label class="label label-primary"><i class="fa fa-chevron-circle-right"></i> Rengo de fechas</label><br>
		<br>
		<div class="col-sm-offset-3 col-sm-6">
			<div class="col-md-6 form-group">
			    <div class="input-group" id="datetimePicker">
			        {{ Form::text('birthday', null, array('id' => 'fechainicio','class' => 'form-control', 'placeholder' => 'Inicio', 'data-date-format' => 'YYYY-MM-DD')) }}
			        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			    </div>
			</div>
			<div class="col-md-6 form-group">
			    <div class="input-group" id="datetimePicker2">
			        {{ Form::text('birthday2', null, array('id' => 'fechafin','class' => 'form-control', 'placeholder' => 'Fin', 'data-date-format' => 'YYYY-MM-DD')) }}
			        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			    </div>
			</div>
		</div>
		<button class="boton pull-right btn-sm btn btn-success" onclick="$('#reportes').data('bootstrapValidator').validate(); if($('#reportes').data('bootstrapValidator').isValid()) generar()"><i class="fa fa-bars"></i> Mostrar lista</button>
		<div class="total row">
		</div>
		<table id="telementos" class="hidden col-md-offset-1 col-md-10 display" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Paterno</th>
					<th>Materno</th>
					<th>Membresia</th>
					<th>Fecha</th>
					<th>Zona</th>
					<th>Grado</th>
				</tr>
			</thead>
			<tbody id="elementobody">
			</tbody>
		</table>
	</div>
@stop
@section('scripts')
	<script>
		$(document).ready(function() {
		    $('#datetimePicker ,#datetimePicker2').datetimepicker({
		        language: 'es',
		        pickTime: false,
		    });
		    $('#reportes').bootstrapValidator({
		        feedbackIcons: {
		            valid: 'glyphicon glyphicon-ok fecha',
		            invalid: 'glyphicon glyphicon-remove fecha',
		            validating: 'glyphicon glyphicon-refresh fecha'
		        },
		        fields: {
		            'membresia[]': {
		                validators: {
		                    choice :{
		                        min : 1,
		                    }
		                }
		            },
		            birthday: {
		                validators: {
		                    notEmpty: {},
		                    date: {
		                        format: 'YYYY-MM-DD',
		                    }
		                }
		            },
		            birthday2: {
		                validators: {
		                    notEmpty: {},
		                    date: {
		                        format: 'YYYY-MM-DD',
		                    }
		                }
		            },
		        }
		    });
		    $('#datetimePicker').on('dp.change dp.show', function(e) {
		        $('#reportes').bootstrapValidator('revalidateField', 'birthday');
		    });
		    $('#datetimePicker2').on('dp.change dp.show', function(e) {
		        $('#reportes').bootstrapValidator('revalidateField', 'birthday2');
		    });
		});
		function generar () {
			$('.boton').addClass('hidden');
			i = $('#fechainicio').val();
			f = $('#fechafin').val();
			$.post('membresias',{i:i,f:f}, function(json) {
				$.each(json,function(index,pago){
					$('#elementobody').append('<tr>'+
						'<td>'+pago.nombre+'</td>'+
						'<td>'+pago.paterno+'</td>'+
						'<td>'+pago.materno+'</td>'+
						'<td>'+pago.membresia+'</td>'+
						'<td>'+pago.fecha+'</td>'+
						'<td>'+pago.zona+'</td>'+
						'<td>'+pago.grado+'</td>');
				});
				table = $('#telementos').DataTable( {
				    "language": {
				        "sProcessing": "Procesando...",
				        "sLengthMenu": "Mostrar _MENU_ registros",
				        "sZeroRecords": "No se encontraron resultados",
				        "sEmptyTable": "Ningún dato disponible en esta tabla",
				        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
				        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
				        "sInfoPostFix": "",
				        "sSearch": "Buscar:",
				        "sUrl": "",
				        "sInfoThousands": ",",
				        "sLoadingRecords": "Cargando...",
				        "oPaginate": {
				        "sFirst": "Primero",
				        "sLast": "Último",
				        "sNext": "Siguiente",
				        "sPrevious": "Anterior"
				        },
				        "oAria": {
				        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
				        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
				        }
				    },
				    paging: true,
				    searching: true,
				    dom: 'T<"clear">lfrtip',
				});
			}, 'json');
			$('#telementos').removeClass('hidden');
		}
	</script>
	{{  HTML::script('js/moment.js'); }}
	{{  HTML::script('js/bootstrap-datetimepicker.js'); }}
	{{  HTML::script('js/bootstrap-datetimepicker.es.js'); }}
@endsection