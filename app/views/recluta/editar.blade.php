@extends('layaouts.base')
@section('titulo')
	PDMU
@endsection
@section('link')
	<link href="css/ui-lightness/jquery-ui-1.10.0.custom.css" rel="stylesheet">
@endsection
@section('contenido')
<form id="buscarcondatos" role="form" method="POST">
	<div class="col-md-12">
		<h3>Búsqueda por datos</h3>
		<div class="col-md-3 form-group">
			{{ Form::label('reclunombre', 'Nombre (s)',array('class' => 'control-label')) }}
			{{ Form::text('reclunombre', null, array('placeholder' => 'introduce nombre','class' => 'form-control')) }}
		</div>
		<div class="col-md-3 form-group">
			{{ Form::label('reclupaterno', 'Apellido paterno') }}
			{{ Form::text('reclupaterno', null, array('placeholder' => 'introduce apellido paterno','class' => 'form-control')) }}
		</div>
		<div class="col-md-3 form-group">
			{{ Form::label('reclumaterno', 'Apellido materno') }}
			{{ Form::text('reclumaterno', null, array('placeholder' => 'introduce apellido materno','class' => 'form-control')) }}
		</div>
		<div class="col-md-2">
			{{ Form::submit('Buscar', array('placeholder' => '','class' => 'btn btn-primary')) }}
		</div>
	</div>
</form>
<form id="buscarconmatricula" role="form" method="POST">
	<div class="col-md-12">
		<h3>Búsqueda por matricula</h3>
		<div class="col-md-3 form-group">
			{{ Form::label('matricula', 'Nombre (s)',array('class' => 'control-label')) }}
			{{ Form::text('matricula', null, array('placeholder' => 'introduce nombre','class' => 'form-control')) }}
		</div>
		<div class="col-md-2">
			{{ Form::submit('Buscar', array('placeholder' => '','class' => 'btn btn-primary'))}}
		</div>
	</div>
</form>
@endsection
@section('scripts')
<!-- Para Bootstrap Validator -->
<script>
$(document).ready(function() {
    $('#buscarcondatos').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            reclunombre: {
                validators: {
                    notEmpty: {}
                }
            },
            reclupaterno: {
                validators: {
                    notEmpty: {}
                }
            }
        }
    })
	$('#buscarconmatricula').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            matricula: {
                validators: {
                    notEmpty: {}
                }
            }
        }
    })
}
);
</script>
<script type="text/javascript" src="../js/bootstrapValidator.js"></script>
<script type="text/javascript" src="../js/language/es_ES.js"></script>

@endsection