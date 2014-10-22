<!DOCTYPE html>
<html lang="es">
<head>
    <title>Recibo de Membrecia</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			@if(isset($datos))	
				<center><h3>Recibo de pago membrecía</h3></center>
				<h4>Elemento</h4>
				<div class="col-md-4">
					<label>Nombre: {{ $datos['name'] }}</label>
				</div>
				<div class="col-md-2">
					<label>Grado: {{ $datos['grado'] }}</label>
				</div>
				<div class="col-md-2">	
					<label>Reclutamiento: {{ $datos['reclutamiento'] }} </label>
				</div>
				<div class="col-md-2">
					<label>Fecha: {{ $datos['fecha'] }}</label>
				</div>
				<div class="col-md-2">
					<label>Folio: {{ $datos['folio'] }}</label>
				</div>
				<div class="col-md-3">
					<label>Adscripción: {{ $datos['zona'] }}</label>
				</div>
				<div class="col-md-3">
					<label>Concepto: {{ $datos['concepto'] }}</label>
				</div>	
				<h4>Titular de hacienda</h4>
				<div class="col-md-3">
					<label>Nombre: {{ $datos['hacienda'] }}</label>
				</div>
				<div class="col-md-2">
					<label>Grado: {{ $datos['gradohacienda'] }}</label>
				</div>
			@else
			<div class="alert alert-danger fade in">
			<strong>Error </strong>Algo salio mal X_x.
			</div>
			@endif	
			</div>
		</div>
	</div>
</body>
</html>