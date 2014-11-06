@extends('layaouts.buscar')
@section('titulo')
  Ascensos
@endsection
@section('head')
	<style>
		.contenedor {
			background: #fff;
			padding: 10px;
			margin-bottom: 15px;
			box-shadow: 0px 3px 2px #aab2bd;
			left: 12px;
			border-top-width: 3px;
			border-top-style: solid;
			border-top-color: #e46f61;
			border-top-left-radius: .1em;
			border-top-right-radius: .1em;
		}

		.detalles {
			border-top-width: 3px;
			border-top-style: solid;
			border-top-color: #76a7fa;
			padding: 15px;
			box-shadow: 0px 1px 1px #aab2bd;
			border-top-left-radius: .1em;
			border-top-right-radius: .1em;
		}
		#graficas {
			height: 200px;
			margin-bottom: 20px;
		}
	</style>
	{{  HTML::style('css/sweet-alert.css');  }}
	{{  HTML::script('js/jspdf.js'); }}
	{{  HTML::script('js/chart/morris.min.js'); }}
	{{  HTML::script('js/chart/raphael-min.js'); }}
@endsection
@section('elemento')
	<div id="graficas" class="detalles col-md-2">
	</div>
	{{ Form::open(array('id' => 'formulariocargos','url'=>'ascensos/update','files'=>true)) }}
		<div class="contenedor col-md-8 form-group">
			<div class="col-md-3" id="fotoperfil">
			</div>
			<div class="col-md-9">
				<div class="col-md-8">
					{{ Form::text('id', 'id',array('class' => 'hidden')) }}
					<h3 id="nombreelemento" name="nombre"></h3>
					<h4>
						{{ Form::label(null,'Matricula: ',array('class' => 'small')) }}
						{{ Form::label('matricula',null,array('class' => 'pull-right label label-success')) }}
					</h4>
					<h4>
						{{ Form::label(null,'Ubicación actual: ',array('class' => 'small')) }}
						{{ Form::label('companiasysubzonas',null,array('class' => 'pull-right label label-info')) }}
					</h4>
					<h4>
						{{ Form::label(null,'Grado actual: ',array('class' => 'small')) }}
						{{ Form::label('grado',null,array('class' => 'pull-right label label-danger')) }}
					</h4>
					<h4>
						{{ Form::label(null,'Desde: ',array('class' => 'small')) }}
						{{ Form::label('fechagrado',null,array('class' => 'pull-right label label-default')) }}
					</h4>
				</div>
			</div>
			{{ Form::button('<i class="fa fa-floppy-o"></i> Guardar',array('id' =>'btnupdate','class' => 'hidden pull-right btn btn-info')) }}
		</div>
	{{Form::close()}}
@stop
@section('scripts2')
	{{  HTML::script('js/sweet-alert.min.js'); }}
	<script>
		function encontrado (id) {
			$("#graficas").html('');
			$.post('ascensos/buscar',{id:id}, function(json) {
				$(".fa-spinner").addClass("hidden");
				$("#elemento").removeClass("hidden");
				$('[name=id]').val(json.id);
				$('#nombreelemento').text(json.nombre+' '+json.paterno+' '+json.materno);
				$('label[for=matricula]').text(json.matricula);
				$('label[for=companiasysubzonas]').text(json.companiasysubzonas);
				$('label[for=grado]').text(json.grado);
				$('label[for=fechagrado]').text(json.fechagrado);
				if(!json.cargo){
					$('label[for=cargo]').text('Cargo: Sin cargo');
				}
				$('#fotoperfil').html('<img id="theImg" class="img-responsive img-thumbnail img-circle" src="imgs/fotos/'+json.fotoperfil+'" alt="Responsive image"/>');
				porcentajeAsistencia(json.faltas,json.permisos,json.asistencias);
			}, 'json');
		}
		function porcentajeAsistencia (faltas,permisos,asistencias) {
			total = faltas + permisos + asistencias;
			var mo = Morris.Donut({
				element: 'graficas',
				data: [
					{value: faltas, label: 'Faltas', formatted: (faltas/total)*100+'%' },
					{value: permisos, label: 'Permisos', formatted: (permisos/total)*100+'%' },
					{value: asistencias, label: 'Asistencias', formatted: (asistencias/total)*100+'%' },
				],
				backgroundColor: '#ccc',
				labelColor: '#060',
				colors: [
					'#0BA462',
					'#39B580',
					'#67C69D',
				],
				resize: true,
				formatter: function (x, data) { return data.formatted; }
			});
		}
	</script>
	<script>
		(function(){
			$('#btnupdate').on('click', function(e) {
				e.preventDefault();
				var str = $( "#formulariocargos" ).serialize();
				$.post('ascensos/update',$("#formulariocargos").serialize(), function(json) {
					console.log(json);
					if (!json.success) {
						swal({
								title: '¿Estás seguro?',
								text: 'Parece que '+capitalise(json.nombre)+' '+capitalise(json.paterno)+' '+capitalise(json.materno)+' tiene ese cargo en el mismo lugar.',
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
									swal('!Hecho!', 'Se ha guardado el cargo', 'success');
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
					};
				}, 'json');
			});
		})();
		function capitalise(string) {
			return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
		}
	</script>
@endsection