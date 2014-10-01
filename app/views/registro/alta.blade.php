@extends('layaouts.base')

@section('titulo')
	Titulos PDMU
@endsection
@section('contenido')
<form role="form">
		<div class="col-md-12">
			<div class="col-md-12">
				<h3>Registro del recluta</h3>
				<div class="col-md-4">
					{{ Form::label('nombre', 'Nombre (s)') }}
					{{ Form::text('nombre', null, array('placeholder' => 'introduce nombre','class' => 'form-control')) }}
				</div>
				<div class="col-md-4">
					{{ Form::label('paterno', 'Apellido paterno') }}
					{{ Form::text('paterno', null, array('placeholder' => 'introduce apellido paterno','class' => 'form-control')) }}
				</div>
				<div class="col-md-4">
					{{ Form::label('materno', 'Apellido materno') }}
					{{ Form::text('materno', null, array('placeholder' => 'introduce apellido materno','class' => 'form-control')) }}
				</div>
				<div class="col-md-2">
					{{ Form::label('sexo', 'Sexo') }}
					{{Form::select('sexo', array('1' => 'H','2' => 'M',),null,array('placeholder' => '','class' => 'form-control')) }}
				</div>
				<div class="col-md-3">
					{{ Form::label('date', 'Fecha nacimiento') }}
					{{ Form::input('date','date', null, array('class' => 'form-control')) }}
				</div>
				<div class="col-md-4">
					{{ Form::label('domicilio', 'Calle y número') }}
					{{ Form::text('domicilio', null, array('placeholder' => 'Wallaby Way 42','class' => 'form-control')) }}
				</div>
				<div class="col-md-3">
					{{ Form::label('colonia', 'Colonia') }}
					{{ Form::text('colonia', null, array('placeholder' => 'Sydney','class' => 'form-control')) }}
				</div>
				<div class="col-md-4">
					{{ Form::label('municipio', 'Municipio') }}
					{{ Form::text('municipio', null, array('placeholder' => 'introduce municipio','class' => 'form-control')) }}
				</div>
				<div class="col-md-2">
					{{ Form::label('estado', 'Estado') }}
					{{Form::select('estado', array('1' => 'Oaxaca',),null,array('placeholder' => '','class' => 'form-control','disabled' => 'disabled')) }}
				</div>
				<div class="col-md-2">
					{{ Form::label('postal', 'C. P.') }}
					{{ Form::text('postal', null, array('placeholder' => '00000','class' => 'form-control')) }}
				</div>
				<div class="col-md-4">
					{{ Form::label('lugnac', 'Lugar nacimiento') }}
					{{ Form::text('lugnac', null, array('placeholder' => 'introduce lugar nacimiento','class' => 'form-control')) }}
				</div>
				<div class="col-md-4">
					{{ Form::label('curp', 'CURP') }}
					{{ Form::text('curp', null, array('placeholder' => 'XXXXXXXXXXXXXXXXXX','class' => 'form-control')) }}
				</div>
				<div class="col-md-4">
					{{ Form::label('email', 'e-mail') }}
					{{ Form::email('email', null, array('placeholder' => 'ejemplo@ejemplo.com','class' => 'form-control')) }}
				</div>
				<div class="col-md-4">
					{{ Form::label('telefono', 'Telefono de contacto') }}
					{{ Form::text('telefono', null, array('placeholder' => '(XXX) XXX XX XX','class' => 'form-control')) }}
				</div>
			</div>
			<div class="col-md-12">
			<h3>Personales</h3>
				<div class="col-md-1">
					{{ Form::label('estatura', 'Estatura') }}
					{{ Form::text('estatura', null, array('placeholder' => 'cm','class' => 'form-control')) }}
				</div>
				<div class="col-md-1">
					{{ Form::label('peso', 'peso') }}
					{{ Form::text('peso', null, array('placeholder' => 'kg','class' => 'form-control')) }}
				</div>
				<div class="col-md-2">
				{{ Form::label('tiposangre', 'Tipo Sangre') }}
				{{Form::select('tiposangre', array('1' => 'A+','2' => 'A-','3' => 'B+','4' => 'B-','5' => 'AB+','6' => 'AB-','7' => '0+','8' => '0-',),null,array('placeholder' => '','class' => 'form-control')) }}
				</div>
				<div class="col-md-2">
					{{ Form::label('ocupación', 'Ocupación') }}
					{{ Form::text('ocupación', null, array('placeholder' => '','class' => 'form-control')) }}
				</div>
				<div class="col-md-2">
					{{ Form::label('escolaridad', 'Escolaridad') }}
					{{Form::select('escolaridad', array('1' => 'primaria','2' => 'secundaria','3' => 'bachillerato','4' => 'universidad','5' => 'licenciatura','6' => 'maestria','7' => 'doctorado',),null,array('placeholder' => '','class' => 'form-control')) }}
				</div>
				<div class="col-md-4">
					{{ Form::label('escuela', 'Escuela') }}
					{{ Form::text('escuela', null, array('placeholder' => 'Nombre de la escuela','class' => 'form-control')) }}
				</div>
				<div class="col-md-3">
					{{ Form::label('alergias', 'Alergias') }}
					{{ Form::text('alergias', null, array('placeholder' => '','class' => 'form-control')) }}
				</div>
				<div class="col-md-3">
					{{ Form::label('vicios', 'Vicios') }}
					{{ Form::text('vicios', null, array('placeholder' => '','class' => 'form-control')) }}
				</div>
				<div class="col-md-2">
				{{ Form::label('arma', 'Arma') }} <br>
				{{Form::select('arma', array('1' => 'Infantería',),null,array('placeholder' => '','class' => 'form-control','disabled' => 'disabled')) }}
				</div>
				<div class="col-md-2">
				{{ Form::label('cuerpo', 'Cuerpo') }} <br>
				{{Form::select('cuerpo', array('1' => 'Ninguno','2' => 'Policía Militar','3' => 'Banda de Guerra',),null,array('placeholder' => '','class' => 'form-control')) }}
				</div>
				<div class="col-md-2">
				{{ Form::label('compania', 'Compañia - Subzona') }} <br>
				{{Form::select('compania', array('1' => 'Flores Magón','2'=>'Tecnológico','3'=>'Unidad C. U.','4'=>'Pendiente','5'=>'Unidad deportiva Carlos Gracida','6'=>'Cuilapam','7'=>'Canteras','8'=>'Sub Zona Nochixtlán','9'=>'Sub Zona Hajuapan','10'=>'Sub Zona Tlacolula',),null,array('placeholder' => '','class' => 'form-control')) }}
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<h3>Registro del padre o tutor</h3>
			<div class="col-md-4">
				{{ Form::label('nombre', 'Nombre (s)') }}
				{{ Form::text('nombre', null, array('placeholder' => 'introduce nombre','class' => 'form-control')) }}
			</div>
			<div class="col-md-4">
				{{ Form::label('paterno', 'Apellido paterno') }}
				{{ Form::text('paterno', null, array('placeholder' => 'introduce apellido paterno','class' => 'form-control')) }}
			</div>
			<div class="col-md-4">
				{{ Form::label('materno', 'Apellido materno') }}
				{{ Form::text('materno', null, array('placeholder' => 'introduce apellido materno','class' => 'form-control')) }}
			</div>
			<div class="col-md-4">
				{{ Form::label('telefonotutor', 'Telefono de contacto') }}
				{{ Form::text('telefonotutor', null, array('placeholder' => '(XXX) XXX XX XX','class' => 'form-control')) }}
			</div>
		</div>
		<div class="col-md-2">
			{{ Form::submit('Click Me', array('placeholder' => '','class' => 'btn btn-primary')) }}
		</div>
</form>
@endsection