@extends('layaouts.base')
@section('titulo')
	Reporte de asistencias
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
	<div class="row">
	<div class="col-md-2">
		<div class="radio">
			<label class="checkbox-inline option1">
				<input class="option1" type="radio" name="optionsRadios" value="option1" checked> Reporte por fechas
			</label>
		</div>
		<div class="radio">
			<label class="checkbox-inline option2">
				<input class="option2" type="radio" name="optionsRadios" value="option2"> Reporte por día
			</label>
		</div>
	</div>
	<div class="col-md-8" id="form">
		<br>
		<div class="col-md-4 form-group fecha1">
		    <div class="input-group" id="datetimePicker">
		        {{ Form::text('birthday', '2015-01-24', array('id' => 'fechainicio','class' => 'form-control', 'placeholder' => 'Fecha de inicio', 'data-date-format' => 'YYYY-MM-DD')) }}
		        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		    </div>
		</div>
		<div class="col-md-4 form-group fecha2">
		    <div class="input-group" id="datetimePicker2">
		        {{ Form::text('birthday2', '2016-01-01', array('id' => 'fechafin','class' => 'form-control', 'placeholder' => 'Fecha de fin', 'data-date-format' => 'YYYY-MM-DD')) }}
		        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		    </div>
		</div>
		<div class="col-md-4">
			{{ Form::select('lugar',$compania,null,array('id' => 'lugares','class' => 'form-control col-md-2')) }}
		</div>
	</div>
	<div class="col-md-2">
		<br>
		<button class="boton btn-sm btn btn-success" onclick="$('#reportes').data('bootstrapValidator').validate(); if($('#reportes').data('bootstrapValidator').isValid()) generar()"><i class="fa fa-bar-chart"></i> Generar</button>
	</div>
	</div>
		<table id="telementos" class="hidden col-md-12 display" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Paterno</th>
					<th>Materno</th>
					<th>Asistencias</th>
					<th class="hidden falta">Faltas</th>
					<th class="hidden permiso">Permisos</th>
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
		    $('#Arrestos, #2Arrestos').addClass('active');
		});
		$( ".option1" ).click(function() {
			$( ".fecha2" ).removeClass('hidden');
			$( ".fecha2" ).fadeIn( 300, function() {});
		});
		$( ".option2" ).click(function() {
			$( ".fecha2" ).fadeOut( 300, function() {
				$( ".fecha2" ).addClass('hidden');
			});
		});
		function generar () {
			i = $('#fechainicio').val();
			f = $('#fechafin').val();
			lugar = $( "[name=lugar]" ).val();
			if ($('.option2').is(':checked')) {
				$.post('dia',{i:i,lugar:lugar}, function(json) {
					$.each(json,function(index,data){
						$('#elementobody').append('<tr>'+
							'<td>'+data.nombre+'</td>'+
							'<td>'+data.paterno+'</td>'+
							'<td>'+data.materno+'</td>'+
							'<td>'+data.asistencias+'</td>'+
							'<td class="hidden">'+data.faltas+'</td>'+
							'<td class="hidden">'+data.permisos+'</td>');
					});
					$('#telementos').DataTable( {
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
			};
			if ($('.option1').is(':checked')) {
				$.post('rango',{i:i,f:f,lugar:lugar}, function(json) {
					$('.falta').removeClass('hidden');
					$('.permiso').removeClass('hidden');
					$.each(json,function(index,data){
						$('#elementobody').append('<tr>'+
							'<td>'+data.nombre+'</td>'+
							'<td>'+data.paterno+'</td>'+
							'<td>'+data.materno+'</td>'+
							'<td>'+data.asistencias+'</td>'+
							'<td>'+data.faltas+'</td>'+
							'<td>'+data.permisos+'</td>');
					});
					$('#telementos').DataTable( {
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
			};
			$('#telementos').removeClass('hidden');
		}
	</script>
	{{  HTML::script('js/moment.js'); }}
	{{  HTML::script('js/bootstrap-datetimepicker.js'); }}
	{{  HTML::script('js/bootstrap-datetimepicker.es.js'); }}
@endsection