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

		.closes{
			margin-right: 5px;
			color: white;
			cursor:pointer; cursor: hand;
		}
	</style>
	{{  HTML::script('js/tour/bootstrap-tour.min.js')}}
	{{  HTML::style('css/tour/bootstrap-tour.min.css')}}
	{{  HTML::style('css/sweet-alert.css')}}
@endsection
@section('elemento')
	{{ Form::button('<i class="fa fa-question"></i>',array('id' => 'tour','class' => 'pull-right btn btn-warning btn-xs', 'style' => 'margin-top:-90px')) }}
	{{ Form::open(array('id' => 'formulariocargos','url'=>'cargos/update','files'=>true)) }}
		<div class="contenedor col-md-offset-2 col-md-8 form-group">
			<i class="pull-left fa fa-paperclip fa-5x"></i>
			<div class="col-md-3" id="fotoperfil">
			</div>
			<div class="col-md-9">
				<div class="col-md-7 tour-1">
					{{ Form::text('id', 'id',array('class' => 'hidden')) }}
					<h3 id="nombreelemento" name="nombre"></h3>
					<h4>
						{{ Form::label(null,'Matrícula: ',array('class' => 'small')) }}
						<ul>
							<li style="list-style-type: none; margin-left: -40px;">
							{{ Form::label('matricula',null,array('class' => 'label label-default')) }}
							</li>
						</ul>
					</h4>
					<h4>
						{{ Form::label(null,'Cargo actual: ',array('class' => 'small')) }}
						<ul id="cargos" class="tour-3"></ul>
					</h4>
					<h4>
						{{ Form::label(null,'Ubicación actual: ',array('class' => 'small')) }}
						<ul>
							<li style="list-style-type: none; margin-left: -40px;">
								{{ Form::label('companiasysubzonas',null,array('class' => 'label label-default')) }}
							</li>
						</ul>
					</h4>
				</div>
				<div class="cargos col-md-5 tour-2">
					<h3>Cargo a asignar</h3>
					{{ Form::select('cargo', $cargos,null,array('id' => 'cargo', 'class' => 'form-control')) }}
					<div id="ubicacion" class="hidden">
						<h3>Ubicación</h3>
						{{ Form::select('companiasysubzona', $companiasysubzonas,null,array('class' => 'form-control')) }}
						{{ Form::label('msginstructor','El elemento cambiará su ubicación',array('class' => 'label label-danger')) }}
					</div>
				</div>
			</div>
			{{ Form::button('<i class="fa fa-floppy-o"></i> Guardar',array('id' =>'btnupdate','class' => 'pull-right btn btn-info')) }}
		</div>
	{{Form::close()}}
@stop
@section('scripts2')
	{{  HTML::script('js/sweet-alert.min.js')}}
	<script>
		function encontrado (id) {
			$.post('cargos/buscar',{id:id}, function(json) {
				$('#cargos').html('');
				$('.fa-spinner').addClass('hidden');
				$('#elemento').removeClass('hidden');
				$('[name=id]').val(json.id);
				$('#nombreelemento').text(json.nombre+' '+json.paterno+' '+json.materno);
				$('label[for=matricula]').text(json.matricula);
				$('[name=companiasysubzona] option[value='+json.compania+']').attr('selected', true);
				if (!json.matricula) {
					$('label[for=matricula]').text('Sin registro');
					$('label[for=matricula]').removeClass('label-success');
					$('label[for=matricula]').addClass('label-danger');
					$('#btnupdate').addClass('hidden');
					$('.cargos').html('<h2><label class="label label-default label-warning"><i class="fa fa-exclamation-circle"></i> No puede asignarse cargo</label></h2>');
				}
				i = 0;
				// // // console.log(json.cargo);
				$.each(json.cargo,function(index,value){
					$('#cargos').append('<li class="cargolabel'+i+'" style="list-style-type: none; margin-left: -40px; margin-top:5px;"><label class="label label-success"><a class="closes" data-dismiss="alert2" onclick="eliminar('+id+','+value.cargo_id+','+i+')"><i class="fa fa-times"></i></a>'+value.nombre+'</label></li>');
					i++;
				});
				$('label[for=companiasysubzonas]').text(json.companiasysubzonas);
				$('#fotoperfil').html('<img id="theImg" class="img-responsive img-thumbnail img-circle" src="'+json.fotoperfil+'" alt="Responsive image"/>');
			}, 'json');
		}
	</script>
	<script>
		(function(){
			$('#btnupdate').on('click', function(e) {
				e.preventDefault();
				$.post('cargos/confirma',$("#formulariocargos").serialize(), function(json) {
					// // // console.log(json);
					if (!json.success) {
						swal({
							title: '¿Estás seguro?',
							text: 'Parece que '+capitalise(json.nombre)+' '+capitalise(json.paterno)+' '+capitalise(json.materno)+' tiene ese cargo.',
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
			// // // console.log('1');
			$.post('cargos/update',$("#formulariocargos").serialize(), function(json) {
				// // // console.log(2);
				// // // console.log(json.ubicacion);
				if(json.success){
					$('label[for=companiasysubzonas]').text(json.ubicacion);
					$('#cargos').html('');
					i = 0;
					$.each(json.cargo,function(index,value){
						$('#cargos').append('<li class="cargolabel'+i+'" style="list-style-type: none; margin-left: -40px; margin-top:5px;"><label class="label label-success"><a class="closes" data-dismiss="alert2" onclick="eliminar('+value.elemento_id+','+value.cargo_id+','+i+')"><i class="fa fa-times"></i></a>'+value.nombre+'</label></li>');
						i++;
					});
					swal('!Hecho!', 'Se ha guardado el cargo', 'success');
				}
			}, 'json');
		}
		function capitalise(string) {
			return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
		}
	</script>
	<script>
		$('#cargo').change(function(){
			if ($('#cargo').val() == '12') {
				$('#ubicacion').removeClass('hidden');
			}
			else {
				$('#ubicacion').addClass('hidden');
			}
		});
	</script>
	<script>
		function eliminar(id,cargo,clase) {
			swal({
				title: '¿Estás seguro?',
				text: 'Se eliminará del cargo a este elemento',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#DD6B55',
				cancelButtonText: 'Cancelar',
				confirmButtonText: 'Quitar el cargo',
				closeOnConfirm: false,
			},
			function(){
				$.post('cargos/eliminar',{id:id,cargo:cargo}, function(json) {
					if(json.success){
						// // console.log(json.message);
						if (json.message == 0){
							swal('¡Hecho!', 'Se ha eliminado el cargo', 'success');
						}
						else
							swal('¡Hecho!', 'Se ha eliminado el cargo, y no se ha registrado en su historial por su corta duración en él.', 'success');
						$('.cargolabel'+clase).remove();
					}
				}, 'json');
			});
		}
	</script>
	<script>
	$('#Cargos, #2Cargos').addClass('active');
	  $('#tour').on('click', function(e) {
	    var tour = new Tour({
	      steps: [
	        {
	          element: '.tour-1',
	          title: 'Detalles del elemento',
	          content: 'Se muestra información del elemento',
	          placement :'bottom',
	        },
	        {
	          element: '.tour-2',
	          title: 'Cargo',
	          content: 'Elige el cargo y el lugar que se le asignará a este elemento',
	          placement: 'left',
	        },
	        {
	          element: '.tour-3',
	          title: 'Elimina el cargo',
	          content: 'Dá click en la X para remover el cargo del elemento',
	          placement: 'left',
	        },
	      ],
	      backdrop: false,
	      storage: false,
	    });
	    tour.init();
	    tour.start();
	  });
	</script>
@endsection