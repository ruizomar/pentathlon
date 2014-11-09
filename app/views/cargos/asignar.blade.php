@extends('layaouts.buscar')
@section('titulo')
  Cargos
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

@endsection
@section('elemento')
	{{ Form::open(array('id' => 'formulariocargos','url'=>'cargos/update','files'=>true)) }}
		<div id="contenedor" class="col-md-offset-2 col-md-8 form-group">
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
						{{ Form::label(null,'Cargo actual: ',array('class' => 'small')) }}
						{{ Form::label('cargo',null,array('class' => 'pull-right label label-primary')) }}
					</h4>
					<h4>
						{{ Form::label(null,'Ubicación actual: ',array('class' => 'small')) }}
						{{ Form::label('companiasysubzonas',null,array('class' => 'pull-right label label-default')) }}
					</h4>
				</div>
				<div class="col-md-5">
					<h3>Cargo a asignar</h3>
					{{ Form::select('cargo', $cargos,null,array('class' => 'form-control')) }}
					<h3>Ubicación</h3>
					{{ Form::select('companiasysubzona', $companiasysubzonas,null,array('class' => 'form-control')) }}
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
			$.post('cargos/buscar',{id:id}, function(json) {
				$(".fa-spinner").addClass("hidden");
				$("#elemento").removeClass("hidden");
				$('[name=id]').val(json.id);
				$('#nombreelemento').text(json.nombre+' '+json.paterno+' '+json.materno);
				$('label[for=matricula]').text(json.matricula);
				$('label[for=cargo]').text(json.cargo);
				$('label[for=companiasysubzonas]').text(json.companiasysubzonas);
				if(!json.cargo){
					$('label[for=cargo]').text('Cargo: Sin cargo');
				}
				$('#fotoperfil').html('<img id="theImg" class="img-responsive img-thumbnail img-circle" src="/'+json.fotoperfil+'" alt="Responsive image"/>');
			}, 'json');
		}
	</script>
	<script>
		(function(){
			$('#btnupdate').on('click', function(e) {
				e.preventDefault();
				var str = $( "#formulariocargos" ).serialize();
				$.post('cargos/update',$("#formulariocargos").serialize(), function(json) {
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