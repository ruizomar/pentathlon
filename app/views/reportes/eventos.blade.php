@extends('layaouts.base')
@section('titulo')
	Reporte de eventos
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
		.cabecera{
		    margin-top: 3px;
		    font-size: 18px;
		}
		.requisitos{
		    background: #fff;
		    border-top-width: 3px;
		    border-top-style: solid;
		    padding: 15px;
		    box-shadow: 0px 1px 1px #aab2bd;
		    -moz-box-shadow: 0px 1px 1px #aab2bd;
		    -webkit-box-shadow: 0px 1px 1px #aab2bd;
		    border-top-left-radius: .1em;
		    border-top-right-radius: .1em;
		    border-top-color: #000;
		    color: #525050;
		    margin-bottom: 20px;
		}
		.requisitos:hover{
            background: #fbb03b;
            color:#fff;
            border-top-color: #fbb03b;
            cursor: pointer;
        }
        .informacion{
            font-size: 12px;
        }
        .informacion:hover{
            cursor: pointer;
        }
	</style>
@endsection
@section('contenido')
	<div class="col-md-12">
		<h4>Reporte de eventos</h4>
		<label class="informacion pull-right label label-danger" onclick="todos()"><i class="fa fa-chevron-circle-right"></i> Ver datos de todos los eventos</label><br>
		<div class="col-md-12">
			@foreach ($eventos as $evento)
				<div class="col-sm-4 requisitos" onclick="evento({{ $evento -> id }})">
					<h3 class="cabecera">{{ $evento -> nombre }}</h3>
					<p>Lugar: <label class="informacion label label-default">{{ $evento -> lugar}}</label></p>
					<p>Fecha: <label class="informacion label label-default">{{ $evento -> fecha}}</label></p>
					<p>Descripción: <label class="informacion label label-primary">{{ $evento -> descripcion}}</label></p>
					Tipo: <label class="informacion label label-success">{{ $evento -> tipoevento -> nombre}}</label>
				</div>
			@endforeach
		</div>
		<div id="dtabla"></div>
	</div>
@stop
@section('scripts')
	<script>
		$(document).ready(function() {
		    $('#datetimePicker ,#datetimePicker2').datetimepicker({
		        language: 'es',
		        pickTime: false,
		    });
		    $('#Reportes, #2Reportes').addClass('active');
		});
		function todos () {
			$.get('todos', function(json) {
				console.log(json);
				$('#dtabla').html('<table id="tabla" class="table table-hover table-first-column-number data-table display full"></table>');
		        $('#tabla').dataTable({
		            "data": json,
		            "columns": [
		                { "title": "Nombre" },
		                { "title": "Apellido Paterno" },
		                { "title": "Apellido Materno" },
		                { "title": "Sexo" },
		                { "title": "Compañia" },
		                { "title": "Edad" },
		                { "title": "Grado" },
		                { "title": "Evento" },
		                { "title": "Fecha" },
		                { "title": "Lugar" },
		            ],
		            "language": {
						"lengthMenu": "Elementos por página _MENU_",
						"zeroRecords": "No se encontraron resultados",
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
			            "sSwfPath": "{{URL::to('swf/copy_csv_xls_pdf.swf')}}",
			            aButtons: [
			                "copy",
			                "xls",
			            ]
			        },
		        });
			}, 'json');
		}
		function evento (id) {
			$.post('evento',{id:id}, function(json) {
				console.log(json);
				$('#dtabla').html('<table id="tabla" class="table table-hover table-first-column-number data-table display full"></table>');
		        $('#tabla').dataTable({
		            "data": json,
		            "columns": [
		                { "title": "Nombre" },
		                { "title": "Apellido Paterno" },
		                { "title": "Apellido Materno" },
		                { "title": "Sexo" },
		                { "title": "Compañia" },
		                { "title": "Edad" },
		                { "title": "Grado" },
		                { "title": "Evento" },
		                { "title": "Fecha" },
		                { "title": "Lugar" },
		            ],
		            "language": {
						"lengthMenu": "Elementos por página _MENU_",
						"zeroRecords": "No se encontraron resultados",
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
			            "sSwfPath": "{{URL::to('swf/copy_csv_xls_pdf.swf')}}",
			            aButtons: [
			                "copy",
			                "xls",
			            ]
			        },
		        });
			}, 'json');
		}
	</script>
	{{  HTML::script('js/moment.js'); }}
	{{  HTML::script('js/bootstrap-datetimepicker.js'); }}
	{{  HTML::script('js/bootstrap-datetimepicker.es.js'); }}
@endsection