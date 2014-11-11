@extends('layaouts.buscar')
@section('titulo')
  Cargos
@endsection
@section('head')
	<style>
	.contenedor {
		background: #fff;
		padding: 10px;
		margin-bottom: 15px;
		box-shadow: 0px 3px 2px #aab2bd;
		-moz-box-shadow: 0px 3px 2px #aab2bd;
		-webkit-box-shadow: 0px 3px 2px #aab2bd;
		left: 12px;
		border-top-width: 5px;
		border-top-style: solid;
		border-top-left-radius: .1em;
		border-top-right-radius: .1em;
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

@endsection
@section('elemento')
	{{ Form::open(array('id' => 'formulariocargos','url'=>'cargos/update','files'=>true)) }}
		<div class="contenedor col-md-offset-2 col-md-8 form-group">
			<i class="pull-left fa fa-paperclip fa-5x"></i>
			<div class="col-md-3" id="fotoperfil">
			</div>
			<div class="col-md-9">
				<div class="col-md-7">
					{{ Form::text('id', 'id',array('class' => 'hidden')) }}
					<h3 id="nombreelemento" name="nombre"></h3>
					<h4>
						{{ Form::label(null,'Matricula: ',array('class' => 'small')) }}
						<ul>
							<li>
								{{ Form::label('matricula',null,array('class' => 'label label-default')) }}
							</li>
						</ul>
					</h4>
					<h4>
						{{ Form::label(null,'Cargo actual: ',array('class' => 'small')) }}
						<ul id="cargos"></ul>
					</h4>
					<h4>
						{{ Form::label(null,'Ubicación actual: ',array('class' => 'small')) }}
						<ul>
							<li>
								{{ Form::label('companiasysubzonas',null,array('class' => 'label label-default')) }}
							</li>
						</ul>
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
				$('#cargos').html('');
				$(".fa-spinner").addClass("hidden");
				$("#elemento").removeClass("hidden");
				$('[name=id]').val(json.id);
				$('#nombreelemento').text(json.nombre+' '+json.paterno+' '+json.materno);
				$('label[for=matricula]').text(json.matricula);
				$.each(json.cargo,function(index,value){
					$('#cargos').append('<li><label class="label label-success">'+value+'</label></li>');
				});
				$('label[for=companiasysubzonas]').text(json.companiasysubzonas);
				$('#fotoperfil').html('<img id="theImg" class="img-responsive img-thumbnail img-circle" src="imgs/fotos/'+json.fotoperfil+'" alt="Responsive image"/>');
			}, 'json');
		}
	</script>
	<script>
		(function(){
			$('#btnupdate').on('click', function(e) {
				e.preventDefault();
				$.post('cargos/confirma',$("#formulariocargos").serialize(), function(json) {
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
									insertar();
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
					}
					else if (json.success) {
						insertar();
					};
				}, 'json');
			});
		})();
		function insertar () {
			$.post('cargos/update',$("#formulariocargos").serialize(), function(json) {
				// console.log(json);
				if(json.success){
					$('#cargos').html('');
					$.each(json.cargo,function(index,value){
						$('#cargos').append('<li><label class="label label-success">'+value+'</label></li>');
					});
					swal('!Hecho!', 'Se ha guardado el cargo', 'success');
				}
			}, 'json');
		}
		function capitalise(string) {
			return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
		}
	</script>
@endsection