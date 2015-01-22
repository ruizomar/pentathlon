<!DOCTYPE html>
<html lang="es">
<head>
    <title>Credenciales</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	{{  HTML::style('css/pure-min.css');  }}
	<style type="text/css" media="screen">
		.rojo{
			color: red;
		}
		.negro{
			color: #000;
			font-size: 9px;
		}
		.azul{
			color: #2d6ca2;
			font-weight: bold;
			font-size: 8px;
		}
		img.logo{
			position: absolute;
			margin:30px 0 0 250px;
			max-height: 30px;
		}
		label{
			font-size: 9px;		
		}
	</style>
</head>
<body>
	@foreach($elementos as $elemento)
		<center>
			<img class="logo" src="{{ asset('imgs/pdmu.jpg') }}" alt="">
			<p class='azul'>PENTATHLÓN DEPORTIVO MILITARIZADO UNIVERSITARIO <br>
				20/a. ZONA OAXACA <br>
			</p>
	
		<!------------>
			<?php $foto = $elemento->documentos()->where('tipo','=','fotoperfil')->first()->ruta; ?>
			<img src="{{ asset($foto) }}" style="max-height:70px" alt="">

			<div style="max-width: 150px;margin:10px auto;">
				<label>{{$elemento->persona->nombre}} {{$elemento->persona->apellidopaterno}} {{$elemento->persona->apellidomaterno}}</label>
			</div>

			<label class="azul">{{$elemento->companiasysubzona->tipo}} {{$elemento->companiasysubzona->nombre}}</label>
			<br>
			<br>
			<label class="azul">Grado: </label><label><u>{{$elemento->grados->last()->nombre}}</u></label>
		</center>
		<div style="height:200px;"></div>
		<div style="page-break-after:always;"></div>
	@endforeach
</body>
</html>