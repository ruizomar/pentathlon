@extends('layaouts.base')
@section('titulo')
	Lista de personas
@endsection
@section('head')
	<style>
		.bg-success {
			margin-top: 10px;
		}
	</style>
@endsection
@section('contenido')
	<div class="bg-success col-md-offset-2 col-md-8">
		<div class="col-md-6">
			<img src="{{ asset($fotoperfil) }}" alt="Responsive image" class="img-responsive img-thumbnail">
		</div>
		<div class="col-md-6">
			</p>
			<strong>
				<h2 class="text-left">{{$persona->nombre}} {{$persona->apellidopaterno}} {{$persona->apellidomaterno}}<i class="fa fa-check"></i> </h2>
			</strong>
			{{$elemento->calle}} <br>
			{{$elemento->colonia}} <br>
			{{$elemento->cp}} <br>
			{{$elemento->municipio}} <br>
			{{$elemento->estado}} <br>
			{{$elemento->curp}} <br>
			<h6>{{date("d-m-Y")}}</h6>
		</div>
	</div>
@endsection

