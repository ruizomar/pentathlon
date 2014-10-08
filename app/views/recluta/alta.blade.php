@extends('layaouts.base')
@section('titulo')
	PDMU
@endsection
@section('link')
	<link href="css/ui-lightness/jquery-ui-1.10.0.custom.css" rel="stylesheet">
@endsection
@section('contenido')
<form id="formularioalta" role="form" method="POST">
	<div class="col-md-12">
		<div class="col-md-12">
			<h3>Registro del recluta</h3>
			<div class="col-md-4 form-group">
				{{ Form::label('reclunombre', 'Nombre (s)',array('class' => 'control-label')) }}
				{{ Form::text('reclunombre', null, array('placeholder' => 'introduce nombre','class' => 'form-control')) }}
			</div>
			<div class="col-md-4 form-group">
				{{ Form::label('reclupaterno', 'Apellido paterno') }}
				{{ Form::text('reclupaterno', null, array('placeholder' => 'introduce apellido paterno','class' => 'form-control')) }}
			</div>
			<div class="col-md-4 form-group">
				{{ Form::label('reclumaterno', 'Apellido materno') }}
				{{ Form::text('reclumaterno', null, array('placeholder' => 'introduce apellido materno','class' => 'form-control')) }}
			</div>
			<div class="col-md-2 form-group">
				{{ Form::label('reclusexo', 'Sexo') }}
				{{Form::select('reclusexo', array('H' => 'Hombre','M' => 'Mujer',),null,array('placeholder' => '','class' => 'form-control')) }}
			</div>
			<div class="col-md-3 form-group">
				{{ Form::label('birthday', 'Fecha nacimiento') }}
				{{ Form::input('date','birthday', null,array('placeholder' => 'DD/MM/AAAA','class' => 'form-control')) }}
			</div>
			<div class="col-md-4 form-group">
				{{ Form::label('domicilio', 'Calle y número') }}
				{{ Form::text('domicilio', null, array('placeholder' => 'Wallaby Way 42','class' => 'form-control')) }}
			</div>
			<div class="col-md-3 form-group">
				{{ Form::label('colonia', 'Colonia') }}
				{{ Form::text('colonia', null, array('placeholder' => 'Sydney','class' => 'form-control')) }}
			</div>
			<div class="col-md-4 form-group">
				{{ Form::label('municipio', 'Municipio') }}
				{{ Form::text('municipio', null, array('placeholder' => 'introduce municipio','class' => 'form-control')) }}
			</div>
			<div class="col-md-2 form-group">
				{{ Form::label('estado', 'Estado') }}
				{{Form::select('estado', array('Oaxaca' => 'Oaxaca',),null,array('placeholder' => '','class' => 'form-control')) }}
			</div>
			<div class="col-md-2 form-group">
				{{ Form::label('postal', 'C. P.',array('class' => 'control-label')) }}
				{{ Form::text('postal', null, array('placeholder' => '00000','class' => 'form-control')) }}
			</div>
			<div class="col-md-4 form-group">
				{{ Form::label('lugnac', 'Lugar nacimiento') }}
				{{ Form::text('lugnac', null, array('placeholder' => 'introduce lugar nacimiento','class' => 'form-control')) }}
			</div>
			<div class="col-md-4 form-group">
				{{ Form::label('curp', 'CURP') }}
				{{ Form::text('curp', null, array('placeholder' => 'XXXXXXXXXXXXXXXXXX','class' => 'form-control')) }}
			</div>
			<div class="col-md-4 form-group">
				{{ Form::label('email', 'e-mail') }}
				{{ Form::email('email', null, array('placeholder' => 'ejemplo@ejemplo.com','class' => 'form-control')) }}
			</div>
			<div class="col-md-4 form-group">
				{{ Form::label('reclutelefonofijo', 'Teléfono casa') }}
				{{ Form::text('reclutelefonofijo', null, array('placeholder' => '(XXX) XXX XX XX','class' => 'form-control')) }}
			</div>
			<div class="col-md-4 form-group">
				{{ Form::label('reclutelefonomovil', 'Teléfono móvil') }}
				{{ Form::text('reclutelefonomovil', null, array('placeholder' => '(XXX) XXX XX XX','class' => 'form-control')) }}
			</div>

			<div id="reclusociales" style="display: none;">
				<div class="col-md-4 form-group">
					{{ Form::label('reclufacebook', 'Facebook') }}
					{{ Form::text('reclufacebook', null, array('placeholder' => 'facebook.com/','class' => 'form-control')) }}
				</div>

				<div class="col-md-4 form-group">
					{{ Form::label('reclutwitter', 'Twitter') }}
					{{ Form::text('reclutwitter', null, array('placeholder' => '@usuario','class' => 'form-control')) }}
				</div>
			</div>
			<div class="col-md-2">
			</br>
				<button type="button" class="btn btn-success btn-sm" data-toggle="#reclusociales">
					Redes sociales
				</button>
			</div>

		</div>
		<div class="col-md-12">
		<h3>Personales</h3>
			<div class="col-md-2 form-group">
				{{ Form::label('estatura', 'Estatura') }}
				{{ Form::text('estatura', null, array('placeholder' => 'cm','class' => 'form-control')) }}
			</div>
			<div class="col-md-2 form-group">
				{{ Form::label('peso', 'peso') }}
				{{ Form::text('peso', null, array('placeholder' => 'kg','class' => 'form-control')) }}
			</div>
			<div class="col-md-2 form-group">
			{{ Form::label('tiposangre', 'Tipo Sangre') }}
			{{Form::select('tiposangre', array('A+' => 'A+','A-' => 'A-','B+' => 'B+','B-' => 'B-','AB+' => 'AB+','AB-' => 'AB-','O+' => 'O+','O-' => 'O-',),null,array('placeholder' => '','class' => 'form-control')) }}
			</div>
			<div class="col-md-2 form-group">
				{{ Form::label('ocupacion', 'Ocupación') }}
				{{ Form::text('ocupacion', null, array('placeholder' => '','class' => 'form-control')) }}
			</div>
			<div class="col-md-2 form-group">
				{{ Form::label('estadocivil', 'Estado Civil') }}
				{{ Form::text('estadocivil', null, array('placeholder' => '','class' => 'form-control')) }}
			</div>
			<div class="col-md-2 form-group">
				{{ Form::label('escolaridad', 'Escolaridad') }}
				{{Form::select('escolaridad', array('primaria' => 'primaria','secundaria' => 'secundaria','bachillerato' => 'bachillerato','universidad' => 'universidad','licenciatura' => 'licenciatura','maestria' => 'maestria','doctorado' => 'doctorado',),null,array('placeholder' => '','class' => 'form-control')) }}
			</div>
			<div class="col-md-4 form-group">
				{{ Form::label('escuela', 'Escuela') }}
				{{ Form::text('escuela', null, array('placeholder' => 'Nombre de la escuela','class' => 'form-control')) }}
			</div>
			<div class="col-md-3 form-group">
				{{ Form::label('alergia', 'Alergias') }}
				{{ Form::text('alergia', null, array('placeholder' => '','class' => 'form-control')) }}
			</div>
			<div class="col-md-3 form-group">
				{{ Form::label('vicios', 'Vicios') }}
				{{ Form::text('vicios', null, array('placeholder' => '','class' => 'form-control')) }}
			</div>
			<div class="col-md-2 form-group">
			{{ Form::label('arma', 'Arma') }} <br>
			{{Form::select('arma', array('1' => 'Infantería',),null,array('placeholder' => '','class' => 'form-control')) }}
			</div>
			<div class="col-md-2 form-group">
			{{ Form::label('cuerpo', 'Cuerpo') }} <br>
			{{Form::select('cuerpo', array('1' => 'Ninguno','2' => 'Policía Militar','3' => 'Banda de Guerra',),null,array('placeholder' => '','class' => 'form-control')) }}
			</div>
			<div class="col-md-2 form-group">
			{{ Form::label('compania', 'Compañia - Subzona') }} <br>
			{{Form::select('compania', array('1' => 'Flores Magón','2'=>'Tecnológico','3'=>'Unidad C. U.','4'=>'Pendiente','5'=>'Unidad deportiva Carlos Gracida','6'=>'Cuilapam','7'=>'Canteras','8'=>'Sub Zona Nochixtlán','9'=>'Sub Zona Hajuapan','10'=>'Sub Zona Tlacolula',),null,array('placeholder' => '','class' => 'form-control')) }}
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<h3>Registro del padre o tutor</h3>
		<div class="col-md-4 form-group">
			{{ Form::label('contactonombre', 'Nombre (s)') }}
			{{ Form::text('contactonombre', null, array('placeholder' => 'introduce nombre','class' => 'form-control')) }}
		</div>
		<div class="col-md-4 form-group">
			{{ Form::label('contactopaterno', 'Apellido paterno') }}
			{{ Form::text('contactopaterno', null, array('placeholder' => 'introduce apellido paterno','class' => 'form-control')) }}
		</div>
		<div class="col-md-4 form-group">
			{{ Form::label('contactomaterno', 'Apellido materno') }}
			{{ Form::text('contactomaterno', null, array('placeholder' => 'introduce apellido materno','class' => 'form-control')) }}
		</div>
		<div class="col-md-4 form-group">
			{{ Form::label('contactotelefonofijo', 'Teléfono de casa') }}
			{{ Form::text('contactotelefonofijo', null, array('placeholder' => '(XXX) XXX XX XX','class' => 'form-control')) }}
		</div>
		<div class="col-md-4 form-group">
			{{ Form::label('contactotelefonomovil', 'Teléfono de movil') }}
			{{ Form::text('contactotelefonomovil', null, array('placeholder' => '(XXX) XXX XX XX','class' => 'form-control')) }}
		</div>
		<div class="col-md-2 form-group">
			{{ Form::label('contactosexo', 'Sexo') }}
			{{Form::select('contactosexo', array('H' => 'Hombre','M' => 'Mujer',),null,array('placeholder' => '','class' => 'form-control')) }}
		</div>
		<div class="col-md-4 form-group">
			{{ Form::label('contactorelacion', 'Relación con el recluta') }}
			{{ Form::text('contactorelacion', null, array('placeholder' => 'padre, madre, hermano, etc.','class' => 'form-control')) }}
		</div>
		<div id="sociales" style="display: none;">
			<div class="col-md-4 form-group">
				{{ Form::label('contactofacebook', 'Facebook') }}
				{{ Form::text('contactofacebook', null, array('placeholder' => 'facebook.com/','class' => 'form-control')) }}
			</div>

			<div class="col-md-4 form-group">
				{{ Form::label('contactotwitter', 'Twitter') }}
				{{ Form::text('contactotwitter', null, array('placeholder' => '@usuario','class' => 'form-control')) }}
			</div>
		</div>
		<div class="col-md-2">
		</br>
			<button type="button" class="btn btn-success btn-sm" data-toggle="#sociales">
				Redes sociales
			</button>
		</div>

	</div>
	<div class="col-md-2">
		{{ Form::submit('Click Me', array('placeholder' => '','class' => 'btn btn-primary')) }}
	</div>
</form>

@endsection
@section('scripts')
<!-- Para Bootstrap Validator -->
<script>
$(document).ready(function() {
    $('#formularioalta2').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            nombre: {
                validators: {
                    notEmpty: {}
                }
            },
            reclunombre: {
                validators: {
                    notEmpty: {}
                }
            },
            postal:{
                validators: {
                    integer: {},
					stringLength:{
						min: 5,
						max: 5,
						message: 'El Código Postal es de 5 dígitos'
					}
                }
            },
            curp:{
				validators:{
                    stringLength: {
                        min: 18,
                        max:18,
                        message:'La CURP esta formada por 18 caracteres'
                    },
                    notEmpty:{}
				}
            },
            paterno: {
                validators: {
                    notEmpty: {}
                }
            },
            reclupaterno: {
                validators: {
                    notEmpty: {}
                }
            },
            email: {
                validators: {
                    emailAddress: {}
                }
            },
            birthday: {
                validators: {
                    notEmpty: {},
                }
            },
            telefono: {
                validators: {
                    notEmpty: {},
					integer:{
						message:'introduce solo números para el teléfono'
					}
                }
            },
            estatura:{
				validators:{
					notEmpty: {},
					integer:{},
					between:{
						min: 100,
						max: 300,
						message: 'Establece una altura mínima a 100 cm'
					}
				}
            },
            peso:{
				validators:{
					notEmpty:{},
					integer:{}
				}
            },
            contactonombre:{
				validators:{
					notEmpty:{}
				}
            },
            contactopaterno:{
				validators:{
					notEmpty:{}
				}
            },
            contactorelacion:{
				validators:{
					notEmpty:{}
				}
            }
        }
    })
    .find('button[data-toggle]')
        .on('click', function() {
            var $target = $($(this).attr('data-toggle'));
            // Show or hide the additional fields
            // They will or will not be validated based on their visibilities
            $target.toggle();
            if (!$target.is(':visible')) {
                // Enable the submit buttons in case additional fields are not valid
                $('#togglingForm').data('bootstrapValidator').disableSubmitButtons(false);
            }
        });
}
);
</script>
<script type="text/javascript" src="../js/bootstrapValidator.js"></script>
<script type="text/javascript" src="../js/language/es_ES.js"></script>
<!-- Para type="Date" en IE Mozilla JS -->
	<script src="../js/jquery-ui.custom.js"></script>
	<script src="../js/modernizr.js"></script>
	<script>
		Modernizr.load({
			test: Modernizr.inputtypes.date,
			nope: "../js/jquery-ui.custom.js",
			callback: function() {
				$("input[type=date]").datepicker();
			}
		});
	</script>
@endsection