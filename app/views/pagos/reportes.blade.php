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
	<style type="text/css" media="screen">
		.fecha{
			top:0 !important;
			right: 50px !important;
		}
	</style>
@endsection
@section('contenido')
	<div id="reportes" class="col-md-12">
		<h1>Reporte de enteros</h1>
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
			    <div class="input-group" id="datetimePicker2">
			        {{ Form::text('birthday2', null, array('id' => 'fechafin','class' => 'form-control', 'placeholder' => 'Fecha de fin', 'data-date-format' => 'YYYY-MM-DD')) }}
			        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			    </div>
			</div>
		</div>
		<button class="boton pull-right btn-sm btn btn-success" onclick="$('#reportes').data('bootstrapValidator').validate(); if($('#reportes').data('bootstrapValidator').isValid()) generar()"><i class="fa fa-bar-chart"></i> Generar</button>
		<div id="dtabla">
		</div>
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
		            valid: 'glyphicon glyphicon-ok fecha',
		            invalid: 'glyphicon glyphicon-remove fecha',
		            validating: 'glyphicon glyphicon-refresh fecha'
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
		    $('#datetimePicker').on('dp.change dp.show', function(e) {
		        $('#reportes').bootstrapValidator('revalidateField', 'birthday');
		    });
		    $('#datetimePicker2').on('dp.change dp.show', function(e) {
		        $('#reportes').bootstrapValidator('revalidateField', 'birthday2');
		    });
		});
		function generar () {
			$('#elementobody').html('');
			//$('.boton').addClass('hidden');
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
				total = 0;
				$.each(json,function(index,pago){
						total += pago[2];
				});
				$('#dtabla').html('<table id="tabla" class="table table-hover table-first-column-number data-table display full"></table>');
		        $('#tabla').dataTable( {
		            "data": json,
		            "columns": [
		                { "title": "Concepto" },
		                { "title": "Fecha" },
		                { "title": "Cantidad" },
		            ],
		            "language": {
		              "lengthMenu": "Elementos por página _MENU_",
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
				$('.total').html('<strong>Total: $'+total+'</strong>');
			}, 'json');
			//$('#telementos').removeClass('hidden');
		}
	</script>
	{{  HTML::script('js/moment.js'); }}
	{{  HTML::script('js/bootstrap-datetimepicker.js'); }}
	{{  HTML::script('js/bootstrap-datetimepicker.es.js'); }}
@endsection