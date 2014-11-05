@extends('layaouts.buscar')
@section('titulo')
  Ascensos
@endsection
@section('head')
	<style>
		#contenedor {
			padding: 10px;
			margin-bottom: 20px;
			background-color: #E0F8D8;
			border: 1px solid #83B373;
			border-radius: 10px;
			-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
			box-shadow: 5px 5px rgba(211, 207, 207, 1);
		}
		.fa-paperclip {
			position: absolute;
			top: -15px;
			left: -15px;
			z-index: 10;
		}
	</style>
	{{  HTML::style('css/sweet-alert.css');  }}
	{{  HTML::script('js/jspdf.js'); }}
	{{  HTML::script('js/chart/Chart.min.js'); }}

@endsection
@section('elemento')
	<div class="col-md-1" style="width:auto">
		<div id="canvas-holder">
			<canvas id="canvas" width="100%" height="100%"/>
		</div>
	</div>
	{{ Form::open(array('id' => 'formulariocargos','url'=>'ascensos/update','files'=>true)) }}
		<div id="contenedor" class="col-md-8 form-group">
			<i class="pull-left fa fa-paperclip fa-5x"></i>
			<div class="col-md-3" id="fotoperfil">
			</div>
			<div class="col-md-9">
				<div class="col-md-7">
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
			{{ Form::button('<i class="fa fa-floppy-o"></i> Guardar',array('id' =>'btnupdate','class' => 'pull-right btn btn-info')) }}
		</div>
	{{Form::close()}}
@stop
@section('scripts2')
	{{  HTML::script('js/sweet-alert.min.js'); }}
	<script>
		function encontrado (id) {
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
			var doughnutData = [
					{
						value:asistencias,
						color:"#4CD964",
						highlight: "#FF5A5E",
						label: "Asistencias"
					},
					{
						value:faltas,
						color:"#FF2D55",
						highlight: "#000",
						label: "Faltas"
					},
					{
						value:permisos,
						color:"#FF9500",
						highlight: "#000",
						label: "Permisos"
					},

				];
				// window.onload = function(){
					var ctx = document.getElementById("canvas").getContext("2d");
					window.myDoughnut = new Chart(ctx).Doughnut(doughnutData, {
						responsive : false,
						animateRotate : true,
					});
				// };
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