@extends('layaouts.base')
@section('titulo')
	Concurso de escoltas
@endsection
@section('head')
	{{  HTML::script('js/tables/jquery.dataTables.min.js')}}
	{{  HTML::script('js/tables/dataTables.responsive.js')}}
	{{  HTML::style('css/jquery.dataTables.css')}}
	{{  HTML::style('css/dataTables.tableTools.css')}}
	{{  HTML::style('css/dataTables.responsive.css')}}
	{{  HTML::script('js/dataTables.tableTools.min.js')}}
@endsection
@section('contenido')
	<a class="label label-success pull-right" href="#" onclick="parte1()" style="font-size:15px; margin-top:25px;">Búsqueda por escuelas</a>
	<a class="label label-success pull-right" href="#" onclick="parte2()" style="font-size:15px; margin-top:25px;">Búsqueda por estado</a>
	<a class="label label-warning pull-right" href="#" onclick="parte3()" style="font-size:15px; margin-top:25px;">Reporte general</a>
	<br><br>
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
		<div class="table-responsive" id="tsecundaria"></div>
	</div>
	<div class="parte1 col-md-12">
		<h1 class="hidden text-center titulo">Bachillerato</h1>
		<div class="table-responsive" id="tbachillerato"></div>
	</div>
	<div class="parte1 col-md-12">
		<h1 class="hidden text-center titulo">Licenciatura</h1>
		<div class="table-responsive" id="tlicenciatura"></div>
	</div>
	<div class="parte2 hidden">
		<div class="col-md-2 form-group">
			{{ Form::label('estado', 'Estado') }}
			<select class="form-control" name="state" id="estado">
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
			{{ Form::label('estado', 'Nivel') }}
			<select class="form-control" name="state" id="nivel">
                <option value="Secundaria">Secundaria</option>
                <option value="Bachillerato">Bachillerato</option>
                <option value="Licenciatura">Licenciatura</option>
			</select>
		</div>
		<div class="col-md-3 form-group">
			{{ Form::label('estado', 'Escuela') }}
			<select class="form-control" name="state" id="escuelas">
			</select>
			<input class="escuela btn btn-success pull-right hidden" type="button" value="Ver datos de la escuela">
		</div>
		<div class="col-md-2">
			<input class="btn btn-primary" type="button" value="Ver lista de escuelas" onclick="escuelas();">
		</div>
		<div class="table-responsive" id="tescuela"></div>
	</div>
	<div class="parte3 hidden2">
		<br>
		<div class="table-responsive" id="testados"></div>
		<div class="col-md 12 totales"></div>
	</div>
@stop
@section('scripts')
	<script>
		$('#escoltas,#2escoltas').addClass('active');
		$("#reporte").submit(function(e){
			e.preventDefault();
			$.post($(this).attr('action'),$(this).serialize(), function(json) {
				$('.titulo').removeClass('hidden');
				$('#tsecundaria').html('<table id="tabla1" class="table table-hover"></table>');
				$('#tabla1').dataTable( {
		            "data": json.secundaria,
		            responsive: true,
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
		            responsive: true,
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
		            responsive: true,
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
		function parte1 () {
			$('.parte1').addClass('hidden');
			$('.parte3').addClass('hidden');
			$('.parte2').removeClass('hidden');
		};
		function parte2 () {
			$('.parte2').addClass('hidden');
			$('.parte3').addClass('hidden');
			$('.parte1').removeClass('hidden');
		};
		function parte3 () {
			$('.parte1').addClass('hidden');
			$('.parte2').addClass('hidden');
			$('.parte3').removeClass('hidden');
			$.get('total', function(json) {
				$('#testados').html('<table id="tabla4" class="table table-hover"></table>');
				$('#tabla4').dataTable( {
		            "data": json.data,
		            responsive: true,
		            "columns": [
		                { "title": "Nombre" },
		                { "title": "Secundaria" },
		                { "title": "Bachillerato" },
		                { "title": "Licenciatura" },
		                { "title": "Total" },
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
				$('.totales').html('<h2>Total de secundarias: <span class="label label-danger">'+json.secundaria+'</span></h2><h2>Total de bachilletaros: <span class="label label-danger">'+json.bachillerato+'</span></h2><h2>Total de licenciaturas: <span class="label label-danger">'+json.licenciatura+'</span></h2>');
			},'json');
		};
		function escuelas () {
			$('#escuelas').html('');
			$('.escuela').addClass('hidden');
			estado = $('#estado').val();
			nivel = $('#nivel').val();
			$.post('escuelas',{estado:estado,nivel:nivel}, function(json) {
				if(json.length){
					$.each(json,function(index,escuela){
						$('#escuelas').append('<option value=' + escuela.id + '>' + escuela.escuela + '</option>');
					});
					$('.escuela').removeClass('hidden');
				};
			},'json');
		};
		$('.escuela').click(function() {
			id = ($('#escuelas').val());
			$.post('escuela',{id:id}, function(json) {
				$('#tescuela').html('<table id="tabla4" class="table table-hover"></table>');
				$('#tabla4').dataTable( {
		            "data": json,
		            responsive: true,
		            "columns": [
		                { "title": "Nombre" },
		                { "title": "Paterno" },
		                { "title": "Materno" },
		                { "title": "Rol" },
		                { "title": "Estado" },
		                { "title": "Escuela" },
		                { "title": "Nivel" },
		                { "title": "Email" },
		                { "title": "Teléfono" },
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
			},'json');
		});
		$("#estado").change(function() {
			$('.escuela').addClass('hidden');
			$('#escuelas').html('');
		});
		$("#nivel").change(function() {
			$('.escuela').addClass('hidden');
			$('#escuelas').html('');
		});
	</script>
@endsection