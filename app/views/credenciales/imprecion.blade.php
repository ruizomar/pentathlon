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
		.datos label{
			margin:0 0 -5px 5px;
		}
	</style>
</head>
<body>
	@foreach($elementos as $key => $elemento)
		<center>
			<img class="logo" src="{{ asset('imgs/pdmu.jpg') }}" alt="">
			<p class='azul'>PENTATHLÓN DEPORTIVO MILITARIZADO UNIVERSITARIO <br>
				20/a. ZONA OAXACA <br>
			</p>
	
		<!------------>
			<img src="{{ asset($elemento['foto']) }}" style="max-height:70px" alt="">

			<div style="max-width: 150px;margin:10px auto;">
				<label>{{$elemento['nombre']}}</label>
			</div>

			<label class="azul">{{$elemento['compania']}}</label>
			<br>
			<label class="azul">Grado: </label><label><u>{{$elemento['grado']}}</u></label>
			<div class="datos" style="max-width: 200px; text-align: left;margin:0 auto;">
				<label class="azul">CURP: </label><label><u>{{$elemento['curp']}}</u></label><br>
				<label class="azul">Calle: </label><label><u>{{$elemento['calle']}}</u></label><br>
				<label class="azul">Colonia: </label><label><u>{{$elemento['colonia']}}</u></label><br>
				<label class="azul">Municipio: </label><label><u>{{$elemento['municipio']}}</u></label><br>
				<label class="azul">Tipo de sangre: </label><label><u>{{$elemento['sangre']}}</u></label>
			</div>
		</center>
		<div style="height:60px;"></div>
		@if(($key+1)%3 == 0 && $key+1 < count($elementos))
			<div style="page-break-after:always;"></div>
		@endif
	@endforeach
</body>
</html>