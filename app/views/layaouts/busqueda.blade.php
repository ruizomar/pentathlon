@extends('layaouts.buscar')
@section('titulo')
  Búsqueda
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
	<div id="parte1" class="col-md-12 hidden" style="right: 10px;">
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
	<div id="parte2" class="col-md-12 hidden">
	  <div id="listalugares" class="col-md-offset-4 col-md-4">
	    {{ Form::select('lugar',array(null),null,array('id' => 'lugares','class' => 'form-control col-md-2')) }}
	    {{ Form::button('<i class="fa fa-eye"></i> Buscar',array('class' => 'pull-right btn btn-info col-md-4','id' => 'buscarext')) }}
	  </div>
	  <table id="telementos" class="hidden col-md-12 table table-hover" cellspacing="0" width="100%">
	    <thead>
	      <tr class="tour-3">
	        <th class="tour-5">Nombre</th>
	        <th class="tour-6">Paterno</th>
	        <th class="tour-7">Materno</th>
	        <th class="tour-8">Fecha Nacimiento</th>
	        <th class="tour-8">Matricula</th>
	        <th class="tour-8">Ubicación</th>
	        <th class="hidden">elemento_id</th>
	      </tr>
	    </thead>
	    <tbody id="elementobody">
	    </tbody>
	  </table>
	</div>
	
@stop
@section('scripts2')
	<script>
	$('#Buscar,#2Buscar').addClass('active');
	$('#error').html('<p class="alert alert-danger"><i class="fa fa-exclamation-triangle fa-lg"></i> No se encontró al Elemento<strong><a id="buscarmas" style="color:#a94442;" class="pull-right" href="#">¿Usar otro método de búsqueda?</a></strong></p>');
	var ascenso_id = 0;
	var elemento_id = 0;
		function encontrado (id) {
			$('#parte1').removeClass('hidden');
			$('#parte2').addClass('hidden');
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
		$('#buscarmas').click( function(e) {
		  e.preventDefault();
		  $('#elemento').removeClass('hidden');
		  $('#parte2').removeClass('hidden');
		  $('#parte1').addClass('hidden');
		  $('#error').addClass('hidden');
		  $.get('buscar/lugares', function(json) {
		  	// console.log(json);
		    $('#lugares').html('');
		    $.each(json,function(index,lugar){
		      $('#lugares').append('<option value="'+lugar.id+'">'+lugar.nombre+'</option>');
		    });
		  }, 'json');
		});
		$('#buscarext').click(function(){
		  $('#extendida').removeClass('hidden');
		  id = $('#lugares').val();
		  $('#telementos').removeClass('hidden');
		  $('#elementobody').html('');
		  $.post('buscar/extendidos',{id:id}, function(json) {
		  	console.log(json);
		    $.each(json,function(index,elemento){
		      $('#elementobody').append('<tr class="info" onclick="encontrado('+elemento.id+')">'+
		        '<td>'+elemento.nombre+'</td>'+
		        '<td>'+elemento.paterno+'</td>'+
		        '<td>'+elemento.materno+'</td>'+
		        '<td>'+elemento.fecha+'</td>'+
		        '<td>'+elemento.matricula.id+'</td>'+
		        '<td>'+elemento.ubicacion+'</td></tr>');
		    });
		  }, 'json');
		});
	</script>
@endsection