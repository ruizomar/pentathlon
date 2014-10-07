@extends('layaouts.base')
@section('titulo')
	Lista de personas
@endsection
@section('contenido')
	@foreach ($personas as $persona)
		id: {{$persona->id}} <br/>
		Nombre: {{$persona->nombre}} <br/>
		Paterno: {{$persona->apellidopaterno}} <br/>
		Materno: {{$persona->apellidomaterno}} <br/>
		Sexo: {{$persona->sexo}} <br/>
	@endforeach
@endsection
