@extends('layaouts.base')
@section('titulo')
	Reporte de enteros
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
@endsection
@section('contenido')
	<div id="reportes" class="col-md-12">
		<br>
		<div class="form-group col-md-6">
		    <label class="label label-primary"><i class="fa fa-chevron-circle-right"></i> Parámetros</label><br>
		        <label class="checkbox-inline">
		            <input id="1" name="tipo[]" type="checkbox" value="Membresia">Membresia
		        </label>
		        <label class="checkbox-inline">
		            <input id="2" name="tipo[]" type="checkbox" value="Credencial">Credencial
		        </label>
		        <label class="checkbox-inline">
		            <input id="3" name="tipo[]" type="checkbox" value="Evento">Evento
		        </label>
		        <label class="checkbox-inline">
		            <input id="4" name="tipo[]" type="checkbox" value="Examen">Examen
		        </label>
		        <label class="checkbox-inline">
		            <input id="5" name="tipo[]" type="checkbox" value="Donativo">Donativo
		        </label>
		</div>
		<br>
		<div class="col-md-6">
			<div class="col-md-6 form-group">
			    <div class="input-group" id="datetimePicker">
			        {{ Form::text('birthday', null, array('id' => 'fechainicio','class' => 'form-control', 'placeholder' => 'Fecha de inicio', 'data-date-format' => 'YYYY-MM-DD')) }}
			        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			    </div>
			</div>
			<div class="col-md-6 form-group">
			    <div class="input-group" id="datetimePicker">
			        {{ Form::text('birthday2', null, array('id' => 'fechafin','class' => 'form-control', 'placeholder' => 'Fecha de fin', 'data-date-format' => 'YYYY-MM-DD')) }}
			        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			    </div>
			</div>
		</div>
		<button class="boton pull-right btn-sm btn btn-success" onclick="$('#reportes').data('bootstrapValidator').validate(); if($('#reportes').data('bootstrapValidator').isValid()) generar()"><i class="fa fa-bar-chart"></i> Generar</button>
		<table id="telementos" class="hidden col-md-12 display" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Concepto</th>
					<th>Fecha</th>
					<th>Cantidad</th>
				</tr>
			</thead>
			<tbody id="elementobody">
			</tbody>
		</table>
		<div class="total row">
		</div>
	</div>
@stop
@section('scripts')
	<script>
		$(document).ready(function() {
		    $('#datetimePicker ,#datetimePicker2').datetimepicker({
		        language: 'es',
		        pickTime: false
		    });
		    $('#reportes').bootstrapValidator({
		        feedbackIcons: {
		            valid: 'glyphicon glyphicon-ok',
		            invalid: 'glyphicon glyphicon-remove',
		            validating: 'glyphicon glyphicon-refresh'
		        },
		        fields: {
		            'tipo[]': {
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
		});
		function generar () {
			$('#elementobody').html('');
			// $('.boton').addClass('hidden');
			i = $('#fechainicio').val();
			f = $('#fechafin').val();
			mem = '.';
			cre = '.';
			eve = '.';
			exa = '.';
			don = '.';
			if ($('#1').is(':checked')) {mem = $('#1').val();};
			if ($('#2').is(':checked')) {cre = $('#2').val();};
			if ($('#3').is(':checked')) {eve = $('#3').val();};
			if ($('#4').is(':checked')) {exa = $('#4').val();};
			if ($('#5').is(':checked')) {don = $('#5').val();};
			$.post('reportes',{i:i,f:f,mem:mem,cre:cre,eve:eve,exa:exa,don:don}, function(json) {
				console.log(json);
				total = 0;
				$.each(json,function(index,pago){
					$('#elementobody').append('<tr>'+
						'<td>'+pago.concepto+'</td>'+
						'<td>'+pago.fecha+'</td>'+
						'<td>'+pago.cantidad+'</td>');
						total += pago.cantidad;
				});
				tabla = $('#telementos').DataTable( {
					"language": {
						"sProcessing":     "Procesando...",
						"sLengthMenu":     "Mostrar _MENU_ registros",
						"sZeroRecords":    "No se encontraron resultados",
						"sEmptyTable":     "Ningún dato disponible en esta tabla",
						"sInfo":           "Mostrando un total de _TOTAL_ registros",
						"sInfoEmpty":      "Mostrando un total de 0 registros",
						"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
						"sInfoPostFix":    "",
						"sSearch":         "Buscar:",
						"sUrl":            "",
						"sInfoThousands":  ",",
						"sLoadingRecords": "Cargando...",
						"oPaginate": {
							"sFirst":    "Primero",
							"sLast":     "Último",
							"sNext":     "Siguiente",
							"sPrevious": "Anterior"
						},
						"oAria": {
							"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
							"sSortDescending": ": Activar para ordenar la columna de manera descendente"
						}
					},
					paging: true,
					searching: true,
				});
				$('.total').html('<strong>Total: '+total+'</strong>');
			}, 'json');
			$('#telementos').removeClass('hidden');
		}
	</script>
	{{  HTML::script('js/moment.js'); }}
	{{  HTML::script('js/bootstrap-datetimepicker.js'); }}
	{{  HTML::script('js/bootstrap-datetimepicker.es.js'); }}
@endsection