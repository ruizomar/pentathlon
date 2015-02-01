@extends('layaouts.base')
@section('titulo')
	Concurso de escoltas
@endsection
@section('head')
	<style>
	</style>
	{{  HTML::script('js/tables/jquery.dataTables.min.js')}}
	{{  HTML::style('css/jquery.dataTables.css')}}
	{{  HTML::style('css/dataTables.tableTools.css')}}
	{{  HTML::script('js/dataTables.tableTools.min.js')}}
@endsection
@section('contenido')
	<a class="label label-success pull-right" href="#" onclick="equipos()" style="font-size:15px; margin-top:5px;">Búsqueda por Equipos</a>
	{{ Form::open(array('id' => 'reporte','url'=>'concursos/reporte','class'=>'parte1')) }}
		<div class="col-md-3 form-group">
		    {{ Form::label('estado', 'Estado') }}
		    <select class="form-control" name="state" id="state">
		        <option value="Aguascalientes">Aguascalientes</option>
		        <option value="Baja California">Baja California</option>
		        <option value="Baja California Sur">Baja California Sur</option>
		        <option value="Campeche">Campeche</option>
		        <option value="Chiapas">Chiapas</option>
		        <option value="Chihuahua">Chihuahua</option>
		        <option value="Coahuila">Coahuila</option>
		        <option value="Colima">Colima</option>
		        <option value="Distrito Federal">Distrito Federal</option>
		        <option value="Durango">Durango</option>
		        <option value="Estado de México">Estado de México</option>
		        <option value="Guanajuato">Guanajuato</option>
		        <option value="Guerrero">Guerrero</option>
		        <option value="Hidalgo">Hidalgo</option>
		        <option value="Jalisco">Jalisco</option>
		        <option value="Michoacán">Michoacán</option>
		        <option value="Morelos">Morelos</option>
		        <option value="Nayarit">Nayarit</option>
		        <option value="Nuevo León">Nuevo León</option>
		        <option value="Oaxaca">Oaxaca</option>
		        <option value="Puebla">Puebla</option>
		        <option value="Querétaro">Querétaro</option>
		        <option value="Quintana Roo">Quintana Roo</option>
		        <option value="San Luis Potosí">San Luis Potosí</option>
		        <option value="Sinaloa">Sinaloa</option>
		        <option value="Sonora">Sonora</option>
		        <option value="Tabasco">Tabasco</option>
		        <option value="Tamaulipas">Tamaulipas</option>
		        <option value="Tlaxcala">Tlaxcala</option>
		        <option value="Veracruz">Veracruz</option>
		        <option value="Yucatán">Yucatán</option>
		        <option value="Zacatecas">Zacatecas</option>
		    </select>
		</div>
		<br>
		<input class="btn btn-info" type="submit" value="Ver lista">
	{{Form::close()}}
	<div class="parte1 col-md-12">
		<h1 class="hidden text-center titulo">Secundaria</h1>
		<div class="col-md-offset-1 col-md-10" id="tsecundaria"></div>
		<h1 class="hidden text-center titulo">Bachillerato</h1>
		<div class="col-md-offset-1 col-md-10" id="tbachillerato"></div>
		<h1 class="hidden text-center titulo">Licenciatura</h1>
		<div class="col-md-offset-1 col-md-10" id="tlicenciatura"></div>
	</div>
@stop
@section('scripts')
	<script>
		$("#reporte").submit(function(e){
			e.preventDefault();
			$.post($(this).attr('action'),$(this).serialize(), function(json) {
				$('.titulo').removeClass('hidden');
				$('#tsecundaria').html('<table id="tabla1" class="table table-hover"></table>');
				$('#tabla1').dataTable( {
		            "data": json.secundaria,
		            "columns": [
		                { "title": "Nombre" },
		                { "title": "Paterno" },
		                { "title": "Materno" },
		                { "title": "Rol" },
		                { "title": "Estado" },
		                { "title": "Escuela" },
		                { "title": "Nivel" },
		            ],
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
				$('#tbachillerato').html('<table id="tabla2" class="table table-hover"></table>');
				$('#tabla2').dataTable( {
		            "data": json.bachillerato,
		            "columns": [
		                { "title": "Nombre" },
		                { "title": "Paterno" },
		                { "title": "Materno" },
		                { "title": "Rol" },
		                { "title": "Estado" },
		                { "title": "Escuela" },
		                { "title": "Nivel" },
		            ],
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
					dom: 'T<"clear">lfrtip',
					tableTools : {
					    aButtons: [
					        "copy",
					        {
                                "sExtends": "xls",
                                "sFileName": "Concursantes_Bachillerato.csv",
                                "bFooter": false
                            },
					    ]
					},
				} );
				$('#tlicenciatura').html('<table id="tabla3" class="table table-hover"></table>');
				$('#tabla3').dataTable( {
		            "data": json.licenciatura,
		            "columns": [
		                { "title": "Nombre" },
		                { "title": "Paterno" },
		                { "title": "Materno" },
		                { "title": "Rol" },
		                { "title": "Estado" },
		                { "title": "Escuela" },
		                { "title": "Nivel" },
		            ],
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
					dom: 'T<"clear">lfrtip',
					tableTools : {
					    aButtons: [
					        "copy",
					        {
                                "sExtends": "xls",
                                "sFileName": "Concursantes_Licenciatura.csv",
                                "bFooter": false
                            },
					    ]
					},
				} );
			}, 'json');
		});
		function equipos () {
			$('.parte1').addClass('hidden');
		}
	</script>
@endsection