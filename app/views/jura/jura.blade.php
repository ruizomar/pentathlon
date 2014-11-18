@extends('layaouts.base')
@section('titulo')
  Ascensos
@endsection
@section('head')
	<style>
	</style>
	{{  HTML::style('css/sweet-alert.css');  }}
	{{  HTML::script('js/tables/jquery.dataTables.min.js')}}
	{{  HTML::script('js/tables/jquery.tabletojson.min.js')}}
	<!-- {{  HTML::script('css/jquery.dataTables.css'); }} -->
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.css">
@endsection
@section('contenido')
	<div class="container col-md-12 form-horizontal">
		<div class="col-md-4" style="margin-top:1em;">
			{{ Form::select('lugar',$lugares,null,array('id' => 'lugares','class' => 'form-control col-md-2')) }}
		</div>
		<div class="col-md-2" style="margin-top:1em;">
			{{ Form::button('<i class="pull-left fa fa-list"></i>Consultar',array('id' => 'listar','class' => 'form-control col-md-2 btn btn-info')) }}
		</div>
		<div class="col-md-offset-4 col-md-2" style="margin-top:1em;">
			{{ Form::button('<i class="fa fa-trash"></i>  Eliminar',array('id' => 'eliminar','class' => 'hidden disabled pull-right btn btn-danger btn-xs')) }}
		</div>
		<div class="cargando col-md-12" style="margin-top:10em; display:none;">
			<p class="text-center"><i class="fa fa-3x fa-cog fa-spin"></i></p>
		</div>
		<div class="col-md-12" style="margin-top:1em;">
			<table id="telementos" class="hidden col-md-12 display" cellspacing="0" width="100%">
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
		<div class="col-md-12" style="margin-top:1em;">
			{{ Form::button('<i class="fa fa-flag"></i> Jurar',array('id' => 'jurar','class' => 'pull-right col-md-1 hidden btn btn-success')) }}
		</div>
	</div>
@stop
@section('scripts')
	{{  HTML::script('js/sweet-alert.min.js')}}
	<script>
		$('#listar').on('click', function(e) {
			$('#eliminar').removeClass('hidden');
			$('#elementobody').html('');
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
					paging: false,
					searching: false,
				});
			}, 'json');
			$('#listar').prop( "disabled",true);
			$('#jurar').removeClass('hidden');
			$('#telementos').removeClass('hidden');
		});
		$('#telementos tbody').on( 'click', 'tr', function () {
			if ( $(this).hasClass('selected') ) {
				$(this).removeClass('selected');
				$('#eliminar').addClass('disabled');
			}
			else {
				tabla.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
				$('#eliminar').removeClass('disabled');
			}
		});
		$('#eliminar').click( function () {
			tabla.row('.selected').remove().draw( false );
			$('#eliminar').addClass('disabled');
		});
		$('#lugares').change(function(){
			if (typeof tabla !== 'undefined') {
				tabla.destroy();
				$('#elementobody').html('');
				$('#telementos').addClass('hidden');
				$('#listar').prop( "disabled",false);
				$('#jurar').addClass('hidden');
				$('#eliminar').addClass('disabled');
				$('#eliminar').addClass('hidden');
			}
		})
	</script>
	<script>
		$('#jurar').on('click', function(e) {
			swal({
					title: '¿Estás seguro?',
					text: 'Se agregará Jura de Bandera a los Elementos seleccionados',
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#AEDEF4',
					confirmButtonText: 'Si',
					cancelButtonText: 'No, regresar a revisar',
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm){
						jurarBandera();
					}
					else {
						swal({
							title:'Cancelado',
							text:'No se ha guardado ningun cambio',
							type: 'error',
							timer: 1000
						});
					}
				});
		});
		function jurarBandera () {
			// var JSONObj = new Object();
			var data = $('#telementos').tableToJSON({
				onlyColumns:[4,5],
			});
			// console.log(JSONObj);
			// $.each(data,function(index,ele){
				// console.log(ele);
			// });
			$.post('jura/jurar',{data:data}, function(json) {
				console.log(json);
			}, 'json');
			swal('!Hecho!', 'Se han guardado los cambios', 'success');
		}
	</script>
@endsection