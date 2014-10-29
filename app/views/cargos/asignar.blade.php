@extends('layaouts.buscar')
@section('titulo')
  Cargos
@endsection
@section('head')
@endsection
@section('elemento')
	{{ Form::open(array('id' => 'formulariocargos','url'=>'cargos/update','files'=>true)) }}
		<div class="col-md-10 form-group">
			<div class="col-md-4" id="imagen">
			</div>
			<div class="col-md-4">
				{{ Form::label('id', 'id') }}
				{{ Form::label('nombre', 'Nombre') }}
				{{ Form::label('paterno', 'Paterno') }}
				{{ Form::label('materno', 'Materno') }}
			</div>
			<div class="col-md-4">
				{{ Form::label('cargos', 'Cargo a asignar') }}
				{{ Form::select('cargo', $cargos,null,array('class' => 'form-control')) }}
				{{ Form::select('companiasysubzona', $companiasysubzonas,null,array('class' => 'form-control')) }}
			</div>
			<div class="col-md-12">
				{{ Form::button('<i class="fa fa-floppy-o"></i> Guardar',array('class' => 'btn-sm pull-right btn btn-info btn-lg','type' => 'submit')) }}
			</div>
		</div>
	{{Form::close()}}
@stop
@section('scripts2')
	<script>
		function encontrado (id) {
			$.post('buscar',{id:id}, function(json) {
				console.log(json);
				$('label[for=id]').text(id);
				$('label[for=nombre]').text(json.nombre);
				$('label[for=paterno]').text(json.paterno);
				$('label[for=materno]').text(json.materno);
				$('#imagen').html('<img id="theImg" src="../imgs/'+json.fotoperfil+'"/>');
				$("#spin").addClass("hidden");
				$("#elemento").removeClass("hidden");
			}, 'json');
		}
	</script>
@endsection