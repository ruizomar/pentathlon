<!DOCTYPE html>
<html lang="es">
<head>
    <title>Condecoraciones</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style type="text/css" media="screen">
		.rojo{
			color: red;
		}
		.negro{
			color: #000;
		}
		.azul{
			color: #764D26;
			font-weight: bold;
		}
		img{
			position: absolute;
			Top:40px;
		}
		.folio{
			position: relative;
			top: -50;
			text-align: right;
			padding-right: 40px
		}
	</style>
</head>
<body>
	@foreach ($condecoraciones as $key => $value)
	@if(is_numeric($key))
		<center>
			<img src="{{ asset('imgs/pdmu.jpg') }}" alt="">
			<h2 class='azul'>PENTATHLÓN DEPORTIVO MILITARIZADO UNIVERSITARIO A.C.<br>
				XX/a. Zona Oaxaca <br>
				Otorga el presente 
			</h2>
			<p style="font-size:50px;">Reconocimiento</p>
			<label style="font-size:40px;">
				A: <u>{{ Reconocimiento::find($key)->elemento->persona->nombre }} {{ Reconocimiento::find($key)->elemento->persona->apellidopaterno }} {{ Reconocimiento::find($key)->elemento->persona->apellidomaterno }}</u>
			</label>
			<h1 style="">{{Reconocimiento::find($key)->nombre}}</h1>
			<?php setlocale(LC_ALL,"Spanish"); ?>
			<label>Oaxaca, Oax., a {{ strftime("%d de %B del %Y",strtotime(Reconocimiento::find($key)->fecha)); }}</label>
			<br>
			<br>
			<label style="font-size:25px;">"PATRIA, HONOR Y FUERZA"</label><br>
			<label >Comandante de la XX/a. Zona Oaxaca</label>
			<br>
			<br>
			<label style="font-size:22px;">{{$comandante->grados()->orderBy('fecha','desc')->first()->nombre}}</label>
			<br>
			<br>
			<br>
			<br>
			<label style="font-size:22px;">{{$comandante->persona->nombre}} {{$comandante->persona->apellidopaterno}} {{$comandante->persona->apellidomaterno}}</label>	
		</center>
		<?php end($condecoraciones); ?>
		@if (key($condecoraciones) != $key)
			<div style="page-break-after:always;"></div>
		@endif
	@endif
	@endforeach
</body>
</html>