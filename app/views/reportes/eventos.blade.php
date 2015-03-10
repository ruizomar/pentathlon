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
	{{  HTML::script('js/chart/morris.min.js')}}
	{{  HTML::script('js/chart/raphael-min.js')}}

	<style type="text/css" media="screen">
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
        .grafica {
            /*background: #f2f2f2;*/
            height: 300px;
            margin-bottom: 20px;
        }
	</style>
@endsection
@section('contenido')
{{ Form::open(array('url' => '#','role' => 'form','id' => 'edit','class' => '')) }}
	<div action="asdasd" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                <h4 class="modal-title" id="Elementos">
	                    <i class="fa fa-filter"></i> Parámetros
	                </h4>
	            </div>
	            <div class="modal-body table-responsive">
	            	<table id="elementos" class="table">
		                <thead>
		                  <tr>
							<th>Fecha Inicio</th>
							<th>Fecha Fin</th>
		                  </tr>
		                </thead>
		                <tbody>
		                	<tr>
							<th>
								<div class="form-group">
								    <div class="input-group" id="datetimePicker">
								        {{ Form::text('fechainicio', null, array('id' => 'fechainicio','class' => 'form-control', 'placeholder' => 'AAAA-MM-DD', 'data-date-format' => 'YYYY-MM-DD')) }}
								        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
								    </div>
								</div>
							</th>
							<th>
						        <div class="form-group">
						            <div class="input-group" id="datetimePicker2">
						                {{ Form::text('fechafin', null, array('id' => 'fechafin','class' => 'form-control', 'placeholder' => 'AAAA-MM-DD', 'data-date-format' => 'YYYY-MM-DD')) }}
						                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						            </div>
						        </div>
							</th>
		                  </tr>
		                </tbody>
	              </table>
	            </div>
	            <div class="modal-footer">
		            {{ Form::button('Buscar',array('class' => 'btn btn-success','onclick' => '','type' => 'submit')) }}
	            </div>
	        </div>
	    </div>
	</div>
	{{ Form::close() }}
	<div class="col-md-12">
		<h4>Reporte de eventos</h4>
		<label class="informacion pull-right label label-danger" onclick="modal()"><i class="fa fa-chevron-circle-right"></i> Ver datos de todos los eventos</label><br>
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
		<div class="col-md-12">
			<div id="graficasexos" class="grafica col-md-3" style="max-width: 360px;float: left;"></div>
			<div id="graficagrados" class="grafica col-md-9" style="float: left;height: 400px;"></div>
		</div>
	</div>
@stop
@section('scripts')
	<script>
		$(document).ready(function() {
		    $('#fechafin ,#fechainicio').datetimepicker({
		        language: 'es',
		        pickTime: false,
		    });
		    $('#Reportes, #2Reportes').addClass('active');
		    $('#datetimePicker').on('dp.change dp.show', function(e) {
		        $('#edit').bootstrapValidator('revalidateField', 'fechafin');
		    });
		    $('#datetimePicker2').on('dp.change dp.show', function(e) {
		        $('#edit').bootstrapValidator('revalidateField', 'fechainicio');
		    });
		    $('#edit').bootstrapValidator({
		        feedbackIcons: {
		            valid: 'glyphicon glyphicon-ok',
		            invalid: 'glyphicon glyphicon-remove',
		            validating: 'glyphicon glyphicon-refresh'
		        },
		        fields: {
		            fechafin: {
		                validators: {
		                    notEmpty: {},
		                    date: {
		                        format: 'YYYY-MM-DD',
		                    }
		                }
		            },
		            fechainicio: {
		                validators: {
		                    notEmpty: {},
		                    date: {
		                        format: 'YYYY-MM-DD',
		                    }
		                }
		            },
		        }
		    })
		    .on('success.form.bv', function(e) {
		    	e.preventDefault();
		    	todos();
		    	$('#myModal').modal('hide');
		    });
		});
		function modal () {
			$('#myModal').modal('show');
		}
		function todos () {
			var inicio = $('#fechainicio').val();
			var fin = $('#fechafin').val();
			$('#graficasexos').html('');
			$('#graficagrados').html('');
			$.post('todos',{inicio:inicio,fin:fin}, function(json) {
				console.log(json.grafica);
				$('#dtabla').html('<table id="tabla" class="table table-hover table-first-column-number data-table display full"></table>');
		        $('#tabla').dataTable({
		            "data": json.tabla,
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
						"infoEmpty": "No hay resgistros",
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
                        {
                            "sExtends": "pdf",
                            "sPdfOrientation": "landscape",
                        },
                    ]
			        },
		        });
				// console.log(json.grafica);
				if (typeof json.tabla != "undefined") {
					graficar(json.grafica);
				};
			}, 'json');
		}
		function evento (id) {
			$.post('evento',{id:id}, function(json) {
				$('#graficasexos').html('');
				$('#graficagrados').html('');
				$('#dtabla').html('<table id="tabla" class="table table-hover table-first-column-number data-table display full"></table>');
		        $('#tabla').dataTable({
		            "data": json.tabla,
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
						"infoEmpty": "No hay resgistros",
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
                        {
                            "sExtends": "pdf",
                            "sPdfOrientation": "landscape",
                        },
                    ]
			        },
		        });
				if (typeof json.tabla != "undefined") {
					graficar(json.grafica);
				};
			}, 'json');
		}
		function graficar (json) {
			Morris.Donut({
			    element: 'graficasexos',
			    data: [
			        {label: "Masculino", value:json.hombre},
			        {label: "Femenino", value:json.mujer},
			    ],
			    backgroundColor: '#F7F7F7',
			    labelColor: '#2B2B2B',
			    colors: [
			        '#4CD964',
			        '#FFCC00',
			        '#FF3B30',
			    ],
			});
			Morris.Bar({
			  element: 'graficagrados',
			  data: [
			  	{nombre: 'Recluta', cantidad: json.grados['Recluta'].cantidad},
			  	{nombre: 'Cadete de infanteria', cantidad: json.grados['Cadete de infanteria'].cantidad},
			  	{nombre: 'Cadete 1a', cantidad: json.grados['Cadete 1a'].cantidad},
			  	{nombre: 'Cabo', cantidad: json.grados['Cabo'].cantidad},
			  	{nombre: 'Sargento 2', cantidad: json.grados['Sargento 2'].cantidad},
			  	{nombre: 'Sargento 1', cantidad: json.grados['Sargento 1'].cantidad},
			  	{nombre: 'Sub Oficial', cantidad: json.grados['Sub Oficial'].cantidad},
			  	{nombre: '3 Oficial', cantidad: json.grados['3 Oficial'].cantidad},
			  	{nombre: '2 Oficial', cantidad: json.grados['2 Oficial'].cantidad},
			  	{nombre: '1 Oficial', cantidad: json.grados['1 Oficial'].cantidad},
			  	{nombre: '3 Comandante', cantidad: json.grados['3 Comandante'].cantidad},
			  	{nombre: '2 Comandate', cantidad: json.grados['2 Comandate'].cantidad},
			  	{nombre: '1 Comandante', cantidad: json.grados['1 Comandante'].cantidad},
			  	],
			  xkey: 'nombre',
			  ykeys: ['cantidad'],
			  labels: ['Cantidad'],
			  xLabelAngle: 90
			});
		}
	</script>
	{{  HTML::script('js/moment.js'); }}
	{{  HTML::script('js/bootstrap-datetimepicker.js'); }}
	{{  HTML::script('js/bootstrap-datetimepicker.es.js'); }}
@endsection