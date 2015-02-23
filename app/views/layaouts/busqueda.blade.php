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
			-moz-box-shadow: 0px 3px 2px #aab2bd;
			-webkit-box-shadow: 0px 3px 2px #aab2bd;
			left: 12px;
			border-top-width: 5px;
			border-top-style: solid;
			border-top-left-radius: .1em;
			border-top-right-radius: .1em;
		}

		.requisitos{
			background: #fff;
			border-top-width: 3px;
			border-top-style: solid;
			padding: 15px;
			box-shadow: 0px 1px 1px #aab2bd;
			-moz-box-shadow: 0px 1px 1px #aab2bd;
			-webkit-box-shadow: 0px 1px 1px #aab2bd;
			border-top-left-radius: .1em;
			border-top-right-radius: .1em;
			border-top-color: #76a7fa;
		}

		.ascensos{
			background: #fff;
			border-top-width: 3px;
			border-top-style: solid;
			padding: 15px;
			box-shadow: 3px 3px 3px #aab2bd;
			-moz-box-shadow: 3px 3px 3px #aab2bd;
			-webkit-box-shadow: 3px 3px 3px #aab2bd;
			border-top-left-radius: .1em;
			border-top-right-radius: .1em;
			border-top-color: #5cb85c;
			left:24px;
		}
		.ascensos:hover{
			cursor:pointer; cursor: hand;
		}

		.error {
			box-shadow: 0px 0px 10px red;
			border-top-color: white;
		}

		#graficaAsistencias {
			background: #fff;
			height: 200px;
			margin-bottom: 20px;
		}

		.titulo {
			margin-top: -10px;
		}

		.listado {
			padding: 5px;
			margin-left: 0px;
		}

		.calificacion {
			font-size: 80%;
		}

		#calificaciones {
			margin-left: -14px;
			margin-right: -14px;
		}
	</style>
@endsection
@section('elemento')
	<div class="col-md-12" style="right: 10px;">
		<div class="contenedor col-md-offset-2 col-md-7">
			<div class="form-group">
				<div class="col-md-4" id="fotoperfil">
				</div>
				<div class="col-md-8">
					<div class="col-md-10">
						{{ Form::text('id', 'id',array('class' => 'hidden')) }}
						<h3 id="nombreelemento" name="nombre"></h3>
						<h4>
							{{ Form::label(null,'Matrícula: ',array('class' => 'small')) }}
							{{ Form::label('matricula',null,array('class' => 'pull-right label label-default')) }}
						</h4>
						<h4>
							{{ Form::label(null,'Ubicación: ',array('class' => 'small')) }}
							{{ Form::label('companiasysubzonas',null,array('class' => 'pull-right label label-default')) }}
						</h4>
						<h4>
							{{ Form::label(null,'Grado actual: ',array('class' => 'small')) }}
							{{ Form::label('grado',null,array('class' => 'tour-2 pull-right label label-danger')) }}
						</h4>
						<h4>
							{{ Form::label(null,'Fecha Nacimiento: ',array('class' => 'small')) }}
							{{ Form::label('fechagrado',null,array('class' => 'pull-right label label-default')) }}
						</h4>
						<h4>
							{{ Form::label(null,'Tipo de sangre: ',array('class' => 'small')) }}
							{{ Form::label('sangre',null,array('class' => 'pull-right label label-default')) }}
						</h4>
						<h4>
							{{ Form::label(null,'Adicción: ',array('class' => 'small')) }}
							{{ Form::label('adiccion',null,array('class' => 'pull-right label label-default')) }}
						</h4>
						<h4>
							{{ Form::label(null,'Alergias: ',array('class' => 'small')) }}
							{{ Form::label('alergia',null,array('class' => 'pull-right label label-default')) }}
						</h4>
						<h3>Contacto</h3>
						<h4>
							{{ Form::label(null,'Nombre: ',array('class' => 'small')) }}
							{{ Form::label('nombrecontacto',null,array('class' => 'pull-right label label-default')) }}
						</h4>
						<h4>
							{{ Form::label(null,'Teléfono: ',array('class' => 'small')) }}
							{{ Form::label('telfonocontacto',null,array('class' => 'pull-right label label-default')) }}
						</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
@section('scripts2')
	<script>
	var ascenso_id = 0;
	var elemento_id = 0;
		function encontrado (id) {
			$.post('buscar/elemento',{id:id}, function(json) {
				console.log(json);
				$('label[for=telfonocontacto]').text('');
				$('.fa-spinner').addClass('hidden');
				$('#elemento').removeClass('hidden');
				$('[name=id]').val(json.id);
				$('#nombreelemento').text(json.nombre+' '+json.paterno+' '+json.materno);
				$('label[for=matricula]').text(json.matricula);
				$('label[for=companiasysubzonas]').text(json.companiasysubzonas);
				$('label[for=fechagrado]').text(json.nace);
				$('label[for=sangre]').text(json.sangre);
				$('label[for=nombrecontacto]').text(json.tutor);
				$('label[for=grado]').text(json.grado);
				if(json.adiccion != ''){
					$('label[for=adiccion]').text(json.adiccion);
				}
				else{
					$('label[for=adiccion]').text('Ninguna');
				}
				if(json.alergia != ''){
					$('label[for=alergia]').text(json.alergia);
				}
				else{
					$('label[for=alergia]').text('Ninguna');
				}
				if(json.telcontacto.length > 0){
					$.each(json.telcontacto,function(index,tel){
						$('label[for=telfonocontacto]').append('<span class="pull-left">'+tel.tipo+':    </span><span class="pull-right">'+tel.telefono +'</span><br>');
					});
				}
				$('#fotoperfil').html('<img id="theImg" class="img-responsive img-thumbnail img-circle" src="'+json.fotoperfil+'" alt="Responsive image"/>');
			}, 'json');
		}
	</script>
@endsection