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
	{{  HTML::style('css/dataTables.tableTools.css')}}
	{{  HTML::script('js/dataTables.tableTools.min.js')}}
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
		<label class="parte1 label label-primary pull-left"><i class="fa fa-chevron-circle-right"></i> Rango de fechas</label>
		<div class="parte1 col-sm-6">
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
		<button class="boton2 pull-right btn-xs btn btn-warning" onclick="sinentero()"><i class="fa fa-bars"></i> Sin registro de entero de este año</button>
		<button class="boton parte1 pull-rights btn-sm btn btn-success" onclick="$('#reportes').data('bootstrapValidator').validate(); if($('#reportes').data('bootstrapValidator').isValid()) generar()"><i class="fa fa-bars"></i> Mostrar lista</button>
		<div id="divelementos"></div>
		<div id="dtabla2"></div>
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
			i = $('#fechainicio').val();
			f = $('#fechafin').val();
			$.post('membresias',{i:i,f:f}, function(json) {
				$('#dtabla2').html('<table id="tabla2" class="table table-hover table-first-column-number data-table display full"></table>');
		        $('#tabla2').dataTable( {
		            "data": json,
		            "columns": [
		                { "title": "Nombre" },
		                { "title": "Apellido paterno" },
		                { "title": "Apellido materno" },
		                { "title": "Membresia" },
		                { "title": "Fecha" },
		                { "title": "Subzona/Compañia" },
		                { "title": "Grado" },
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
		        	},
					dom: 'T<"clear">lfrtip',
					tableTools : {
					    aButtons: [
					        "copy",
					        {
                                "sExtends": "xls",
                                "sFileName": "Concursantes_Secundaria.csv",
                                "bFooter": false
                            },
					    ]
					},
		        } );
			}, 'json');
			$('#telementos2').removeClass('hidden');
		}
		function sinentero () {
			$('.boton2, .parte1').addClass('hidden');
			$('#dtabla2').html('');
			anio = (new Date).getFullYear();;
			$.post('sinentero',{anio:anio}, function(json) {
				// // console.log(json);
				$('#divelementos').html('<table id="telementos" class="table table-hover table-first-column-number data-table display full"></table>');
				$('#telementos').dataTable( {
				    "data": json,
				    "columns": [
				        { "title": "Nombre" },
				        { "title": "Paterno" },
				        { "title": "Materno" },
				        { "title": "Membresia" },
				        { "title": "Zona" },
				        { "title": "Grado" },
				    ],
				    "language": {
					      "lengthMenu": "Elementos por página _MENU_",
					      "zeroRecords": "Ningún elemento se ha registrado",
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
					},
					dom: 'T<"clear">lfrtip',
					tableTools : {
					    aButtons: [
					        "copy",
					        {
                                "sExtends": "xls",
                                "sFileName": "Concursantes_Secundaria.csv",
                                "bFooter": false
                            },
					    ]
					},
				} );
			}, 'json');
		}
	</script>
	{{  HTML::script('js/moment.js'); }}
	{{  HTML::script('js/bootstrap-datetimepicker.js'); }}
	{{  HTML::script('js/bootstrap-datetimepicker.es.js'); }}
@endsection