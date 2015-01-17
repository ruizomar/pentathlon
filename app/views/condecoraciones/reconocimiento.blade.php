<!DOCTYPE html>
<html lang="es">
<head>
    <title>Condecoraciones</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	{{  HTML::style('css/pure-min.css');  }}
	<style type="text/css" media="screen">
		.rojo{
			color: red;
		}
		.negro{
			color: #000;
		}
		.azul{
			color: #2d6ca2;
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
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			@foreach ($condecoraciones as $key => $value)
			@if(is_numeric($key))
			<div>
				<center>
					<img src="{{ asset('imgs/pdmu.jpg') }}" alt="">
					<p class='azul'>PENTATHLÓN DEPORTIVO MILITARIZADO UNIVERSITARIO <br>
						20/a. ZONA OAXACA <br>
						Estado Mayor de Zona <br>
						SECCIÓN DE HACIENDA <br>
					</p>
				</center>	
			</div>	
				<center>
					<h2 class="azul" style="margin-top:-10px;">{{Reconocimiento::find($key)->nombre}}
					</h2>
				</center>

				<!------------>
				<div class="pure-u-3-5">
					<label class="azul">Nombre: </label><label><u>{{ Reconocimiento::find($key)->elemento->persona->nombre }} {{ Reconocimiento::find($key)->elemento->persona->apellidopaterno }} {{ Reconocimiento::find($key)->elemento->persona->apellidomaterno }}</u></label>
				</div>
				<!------------>
				<br>
				<br>
				<div class="pure-u-1">
					<?php setlocale(LC_ALL,"Spanish"); ?>
					<label><u>Oaxaca, Oax., a {{ strftime("%d de %B del %Y",strtotime(Reconocimiento::find($key)->fecha)); }}</u></label>
				</div>
				<?php end($condecoraciones); ?>
				@if (key($condecoraciones) != $key)
					<div style="page-break-after:always;"></div>
				@endif
			@endif
			@endforeach
			</div>
		</div>
	</div>
</body>
</html>