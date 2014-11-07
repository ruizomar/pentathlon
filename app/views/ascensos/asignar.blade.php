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
			border-top-color: #FE563B;
			border-top-left-radius: .1em;
			border-top-right-radius: .1em;
		}

		.asistencias {
			background: #fff;
			border-top-width: 3px;
			border-top-style: solid;
			padding: 15px;
			box-shadow: 0px 1px 1px #aab2bd;
			border-top-left-radius: .1em;
			border-top-right-radius: .1em;
		}
		.detalles{
			background: #fff;
			border-top-width: 3px;
			border-top-style: solid;
			left: 12px;
			right: 12px;
			padding: 15px;
			box-shadow: 0px 1px 1px #aab2bd;
			border-top-left-radius: .1em;
			border-top-right-radius: .1em;
		}
		#graficas {
			background: #fff;
			height: 200px;
			margin-bottom: 20px;
		}
		.titulo {
			margin-top: -10px;
		}
	</style>
	{{  HTML::style('css/sweet-alert.css');  }}
	{{  HTML::script('js/jspdf.js'); }}
	{{  HTML::script('js/chart/morris.min.js'); }}
	{{  HTML::script('js/chart/raphael-min.js'); }}
@endsection
@section('elemento')
	<div class="col-md-12" style="right: 10px;">
		<div id="graficas" class="asistencias col-md-2" style="border-top-color: #76a7fa;">
		</div>
		{{ Form::open(array('id' => 'formulariocargos','class' => 'col-md-8 contenedor','url' => 'ascensos/update','files' => true)) }}
			<div class="form-group">
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
							{{ Form::label(null,'Ubicación: ',array('class' => 'small')) }}
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
		<div class="detalles col-md-2" style="left:24px; border-top-color: #53a93f;">
			<h3 class="titulo">Exámenes</h3>
			<div id="calificaciones"></div>
			<!-- <h4>
				{{ Form::label('examen','Examen realizado',array('class' => 'label label-success')) }}
			</h4>
			<h4>
				{{ Form::label('fechaexamen','12-12-2014',array('class' => 'label label-info')) }}
			</h4>
			<h4>
				{{ Form::label('calificacion','7.0',array('class' => 'label label-info')) }}
			</h4> -->
		</div>
	</div>
@stop
@section('scripts2')
	{{  HTML::script('js/sweet-alert.min.js'); }}
	<script>
		function encontrado (id) {
			$("#graficas").html('');
			$("#calificaciones").html('');
			$.post('ascensos/buscar',{id:id}, function(json) {
				// console.log(json.examenes);
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
				examenesVista(json.examenes);
			}, 'json');
		}
		function porcentajeAsistencia (faltas,permisos,asistencias) {
			total = faltas + permisos + asistencias;
			var mo = Morris.Donut({
				element: 'graficas',
				data: [
					{value: asistencias, label: 'Asistencias', formatted: (asistencias/total)*100+'%' },
					{value: permisos, label: 'Permisos', formatted: (permisos/total)*100+'%' },
					{value: faltas, label: 'Faltas', formatted: (faltas/total)*100+'%' },
				],
				backgroundColor: '#F7F7F7',
				labelColor: '#2B2B2B',
				colors: [
					'#4CD964',
					'#FFCC00',
					'#FF3B30',
				],
				resize: true,
				formatter: function (x, data) { return data.formatted; }
			});
		}
		function examenesVista (data) {
			$.each(data,function(index, val){
				$("#calificaciones").append('<h4><label class="label label-success">'+val.nombre+'</label></h4><h4><label class="label label-default">'+val.pivot.fecha+'</label></h4><h5><label class="pull-right label label-danger">'+val.pivot.calificacion+'</label></h5>');
				console.log(val);
			});
			// $('label[for=examen]').text(data[1].nombre);
			// $('label[for=examen]').text(data.nombre);
			// $('label[for=fechaexamen]').text(data.matricula);
			// $('label[for=calificacion]').text(data.matricula);
			// console.log(data);
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