<!DOCTYPE html>
<html lang="es">
<head>
    <title>Recibo de Donativos</title>
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
			@for($inicio; $inicio <= $fin; $inicio++)
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
					<h3 class="azul" style="margin-bottom:-5px;">${{ Donativo::find($inicio)->donativo; }} PESOS 00/100 M.N.</h3>
					<h2 class="azul" style="margin-top:-10px;">Donativo
					</h2>
				</center>
				<div class="folio">
					<label>Folio: <strong class="rojo">{{ Donativo::find($inicio)->id }}</strong></label>
				</div>
				<!------------>
				<div class="pure-u-3-5">
					<label class="azul">Nombre: </label><label><u>{{ Donativo::find($inicio)->nombre }} {{ Donativo::find($inicio)->paterno }} {{ Donativo::find($inicio)->materno }}</u></label>
				</div>
				<!------------>
				<br>
				<br>
				<div class="pure-u-1">
					<?php setlocale(LC_ALL,"Spanish"); ?>
					<label><u>Oaxaca, Oax., a {{ strftime("%d de %B del %Y",strtotime(Donativo::find($inicio)->fecha)); }}</u></label>
				</div>
				<br>
				<h4>Titular de hacienda</h4>
				<div class="pure-u-3-5">
					<label class="azul">Nombre: </label><u>{{ $hacienda }}</u></label>
				</div>
				<div style="height:200px;"></div>
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
						<h3 class="azul" style="margin-bottom:-5px;">${{ Donativo::find($inicio)->donativo; }} PESOS 00/100 M.N.</h3>
						<h2 class="azul" style="margin-top:-10px;">Donativo
						</h2>
					</center>
					<div class="folio">
						<label>Folio: <strong class="rojo">{{ Donativo::find($inicio)->id }}</strong></label>
					</div>
					<!------------>
					<div class="pure-u-3-5">
						<label class="azul">Nombre: </label><label><u>{{ Donativo::find($inicio)->nombre }} {{ Donativo::find($inicio)->paterno }} {{ Donativo::find($inicio)->materno }}</u></label>
					</div>
					<!------------>
					<br>
					<br>
					<div class="pure-u-1">
						<?php setlocale(LC_ALL,"Spanish"); ?>
						<label><u>Oaxaca, Oax., a {{ strftime("%d de %B del %Y",strtotime(Donativo::find($inicio)->fecha)); }}</u></label>
					</div>
					<br>
					<h4>Titular de hacienda</h4>
					<div class="pure-u-3-5">
						<label class="azul">Nombre: </label><u>{{ $hacienda }}</u></label>
					</div>
					@if($inicio != $fin)
					<div style="page-break-after:always;"></div>
					@endif
			@endfor	
			</div>
		</div>
	</div>
</body>
</html>