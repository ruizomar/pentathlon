<!DOCTYPE html>
<html lang="es">
<head>
    <title>Recibo de Membrecia</title>
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
			@if(isset($datos))
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
					<h3 class="azul" style="margin-bottom:-5px;">${{ $datos['cantidad'] }} PESOS 00/100 M.N.</h3>
					<h2 class="azul" style="margin-top:-10px;">{{ $datos['concepto'] }}
					</h2>
				</center>
				<div class="folio">
					<label>Folio: <strong class="rojo">{{ $datos['folio'] }}</strong></label>
				</div>
				<!------------>
				<div class="pure-u-3-5">
					<label class="azul">Nombre: </label><label>{{ $datos['name'] }}</label>
				</div>
				<div class="pure-u-2-5">
					<label class="azul">Grado: </label><label>{{ $datos['grado'] }}</label>
				</div>
				<!------------>
				<br>
				<div class="pure-u-3-5">
					<label class="azul">Matrícula: </label>
					<label>
						@if(!is_null($datos['matricula']))
							{{ $datos['matricula']->id }}
						@else
							sin asignar
						@endif		
					</label>
				</div>
				<div class="pure-u-2-5">
					<label class="azul">No. Reclutamiento: </label><label>{{ $datos['reclutamiento'] }}</label>
				</div>
				<!------------>
				<br>
				<div class="pure-u-3-5">
					<label class="azul">Adscripción: </label><label>{{ $datos['zona'] }}</label>
				</div>
				<!------------>
				<br>
				<br>
				<div class="pure-u-1">
					<?php setlocale(LC_TIME, "Spanish"); ?>
					<label>Oaxaca, Oax., a {{ strftime("%d de %B del %Y",strtotime($datos['fecha'])); }}</label>
				</div>
				<br>
				<h4>Titular de hacienda</h4>
				<div class="pure-u-3-5">
					<label class="azul">Nombre: </label>{{ $datos['hacienda'] }}</label>
				</div>
				<div class="pure-u-2-5">
					<label class="azul">Grado: </label><label>{{ $datos['gradohacienda'] }}</label>
				</div>
				<h2 style="margin-top:100px;"></h2>
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
					<h3 class="azul" style="margin-bottom:-5px;">${{ $datos['cantidad'] }} PESOS 00/100 M.N.</h3>
					<h2 class="azul" style="margin-top:-10px;">{{ $datos['concepto'] }}
					</h2>
				</center>
				<div class="folio">
					<label>Folio: <strong class="rojo">{{ $datos['folio'] }}</strong></label>
				</div>
				<!------------>
				<div class="pure-u-3-5">
					<label class="azul">Nombre: </label><label>{{ $datos['name'] }}</label>
				</div>
				<div class="pure-u-2-5">
					<label class="azul">Grado: </label><label>{{ $datos['grado'] }}</label>
				</div>
				<!------------>
				<br>
				<div class="pure-u-3-5">
					<label class="azul">Matrícula: </label>
					<label>
						@if(!is_null($datos['matricula']))
							{{ $datos['matricula']->id }}
						@else
							sin asignar
						@endif		
					</label>
				</div>
				<div class="pure-u-2-5">
					<label class="azul">No. Reclutamiento: </label><label>{{ $datos['reclutamiento'] }}</label>
				</div>
				<!------------>
				<br>
				<div class="pure-u-3-5">
					<label class="azul">Adscripción: </label><label>{{ $datos['zona'] }}</label>
				</div>
				<!------------>
				<br>
				<br>
				<div class="pure-u-1">
					<?php setlocale(LC_TIME, "Spanish"); ?>
					<label>Oaxaca, Oax., a {{ strftime("%d de %B del %Y",strtotime($datos['fecha'])); }}</label>
				</div>
				<br>
				<h4>Titular de hacienda</h4>
				<div class="pure-u-3-5">
					<label class="azul">Nombre: </label>{{ $datos['hacienda'] }}</label>
				</div>
				<div class="pure-u-2-5">
					<label class="azul">Grado: </label><label>{{ $datos['gradohacienda'] }}</label>
				</div>
			@else
			<div class="alert alert-danger fade in">
			<strong>Error </strong>Algo salió mal X_x.
			</div>
			@endif	
			</div>
		</div>
	</div>
</body>
</html>