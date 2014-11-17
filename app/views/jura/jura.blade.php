@extends('layaouts.base')
@section('titulo')
  Ascensos
@endsection
@section('head')
	<style>
	</style>
	{{  HTML::style('css/sweet-alert.css');  }}
	{{  HTML::script('js/tables/jquery.dataTables.min.js'); }}
	<!-- {{  HTML::script('css/jquery.dataTables.css'); }} -->
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.css">
@endsection
@section('contenido')
	<div class="container col-md-12 form-horizontal">
		<div class="col-md-4" style="margin-top:1em;">
			{{ Form::select('lugar',$lugares,null,array('class' => 'form-control col-md-2')) }}
		</div>
		<div class="col-md-2" style="margin-top:1em;">
			{{ Form::button('<i class="pull-left fa fa-list"></i>Consultar',array('id' => 'listar','class' => 'form-control col-md-2 btn btn-info')) }}
		</div>
		<div class="col-md-offset-4 col-md-2" style="margin-top:1em;">
			{{ Form::button('<i class="pull-left fa fa-flag"></i>Guardar',array('id' => 'jurar','class' => 'form-control btn btn-success')) }}
		</div>
		<div class="col-md-12" style="margin-top:1em;">
			<table id="telementos" class="col-md-12 display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Paterno</th>
						<th>Materno</th>
						<th>Matricula</th>
						<th class="hidden">elemento_id</th>
						<th class="hidden">persona_id</th>
					</tr>
				</thead>

				<tbody id="elementobody">
				</tbody>
			</table>
		</div>
	</div>
@stop
@section('scripts')
	<script>
		(function(){
			$('#listar').on('click', function(e) {
				id = $( "[name=lugar]" ).val();
				$.post('jura/llenartabla',{id:id}, function(json) {
					$.each(json,function(index,elementos){
						$('#elementobody').append('<tr>'+
							'<td>'+elementos.nombre+'</td>'+
							'<td>'+elementos.paterno+'</td>'+
							'<td>'+elementos.materno+'</td>'+
							'<td>'+elementos.matricula+'</td>'+
							'<td class="hidden">'+elementos.elemento_id+'</td>'+
							'<td class="hidden">'+elementos.persona_id+'</td></tr>');
					});
					tabla = $('#telementos').dataTable( {
						"language": {
							"sProcessing":     "Procesando...",
							"sLengthMenu":     "Mostrar _MENU_ registros",
							"sZeroRecords":    "No se encontraron resultados",
							"sEmptyTable":     "Ningún dato disponible en esta tabla",
							"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
							"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
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
					} );
				}, 'json');
			});
		})();
	</script>
@endsection