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
			<div class="col-md-7">
			@if(isset($datos))	
				<center><h3>Recibo de pago membrecía</h3></center>
				<h4>Elemento</h4>
				<div class="col-md-5">
					<label>Nombre: {{ $datos['name'] }}</label>
				</div>
				<div class="col-md-4">
					<label>Grado: {{ $datos['grado'] }}</label>
				</div>
				<div class="col-md-3">	
					<label>Reclutamiento: {{ $datos['reclutamiento'] }} </label>
				</div>	
					<label>fecha ingreso: {{ $datos['fecha'] }}</label>
				<h4>Titular de hacienda</h4>
				<div class="col-md-5">
					<label>Nombre: {{ $datos['hacienda'] }}</label>
				</div>
				<div class="col-md-4">
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