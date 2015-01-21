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
		<table id="telementos" class="hidden col-md-6 display" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Paterno</th>
					<th>Materno</th>
					<th>Matricula</th>
					<th>Membresia</th>
					<th>Zona</th>
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
		            valid: 'glyphicon glyphicon-ok',
		            invalid: 'glyphicon glyphicon-remove',
		            validating: 'glyphicon glyphicon-refresh'
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
		});
		function generar () {
			i = $('#fechainicio').val();
			f = $('#fechafin').val();
			$.post('membresias',{i:i,f:f}, function(json) {
				console.log(json);
			}, 'json');
			$('#telementos').removeClass('hidden');
		}
	</script>
	{{  HTML::script('js/moment.js'); }}
	{{  HTML::script('js/bootstrap-datetimepicker.js'); }}
	{{  HTML::script('js/bootstrap-datetimepicker.es.js'); }}
@endsection