<html>
<head>
	<title>Historial</title>
</head>
<style type="text/css" media="screen">
	table {
	  border-collapse: collapse;
	  border-spacing: 0;
	}
	td,
	th {
	  padding: 0;
	}
	.table td,
	  .table th {
	    background-color: #fff !important;
	  }
	.table {
	    border-collapse: collapse !important;
	  }
	  .table {
  width: 100%;
  max-width: 100%;
  margin-bottom: 20px;
}
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
  padding: 8px;
  line-height: 1.42857143;
  vertical-align: top;
  border-top: 1px solid #dddddd;
}
.table > thead > tr > th {
  vertical-align: bottom;
  border-bottom: 2px solid #dddddd;
  text-align: left;
}
.table > caption + thead > tr:first-child > th,
.table > colgroup + thead > tr:first-child > th,
.table > thead:first-child > tr:first-child > th,
.table > caption + thead > tr:first-child > td,
.table > colgroup + thead > tr:first-child > td,
.table > thead:first-child > tr:first-child > td {
  border-top: 0;
}
.table > tbody + tbody {
  border-top: 2px solid #dddddd;
}
.table .table {
  background-color: #ffffff;
}
.table-bordered th,
  .table-bordered td {
    border: 1px solid #ddd !important;
  }
</style>
<body>
		<img src="{{ asset('imgs/pdmu.jpg') }}" alt="" style="position: absolute;">
		<center>
		<p class='azul'>PENTATHLÓN DEPORTIVO MILITARIZADO UNIVERSITARIO <br>
			20/a. ZONA OAXACA <br>
			Hitorial <br>
		</p>
		</center>
	<h3>Nombre: {{ $elemento->persona->nombre }} {{ $elemento->persona->apellidopaterno }} {{ $elemento->persona->apellidomaterno }}</h3>
	<h3>Matricula: {{ $elemento->matricula->id;}}</h3>
	<h3>Grado: {{ $elemento->grados->last()->nombre;}}</h3>
	<h2>Eventos</h2>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Fecha</th>
				<th>Entero</th>
			</tr>
		</thead>
		<tbody>
			@foreach($elemento->eventos()->get() as $evento)
				<tr>
					<td>{{$evento->nombre}}</td>
					<td>{{$evento->fecha}}</td>
					<td>{{$evento->precio}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<h2>Examenes</h2>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Grado</th>
				<th>Nombre</th>
				<th>Fecha</th>
				<th>Entero</th>
				<th>Calificacion</th>
			</tr>
		</thead>
		<tbody>
			@foreach($elemento->examenes()->get() as $examen)
				<tr>
					<td>{{$examen->grado->nombre}}</td>
					<td>{{$examen->nombre}}</td>
					<td>{{$examen->pivot->fecha}}</td>
					<td>{{$examen->precio}}</td>
					<td>{{$examen->pivot->calificacion}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<h2>Asistencias</h2>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Compaia/Subzona</th>
				<th>Fecha</th>
				<th>Tipo</th>
			</tr>
		</thead>
		<tbody>
			@foreach($elemento->asistencias()->get() as $asistencia)
				<tr>
					<td>{{$asistencia->companiasysubzona->tipo }} {{$asistencia->companiasysubzona->nombre }}</td>
					<td>{{$asistencia->fecha}}</td>
					@if($asistencia->tipo == 1)
						<td>Asistencia</td>
					@elseif($asistencia->tipo == 2)
						<td>Permiso</td>
					@else
						<td>Falta</td>
					@endif
				</tr>
			@endforeach
		</tbody>
	</table>

	<h2>Cargos</h2>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Cargo</th>
				<th>Fecha de inicio</th>
				<th>Fecha de termino</th>
				<th>Compañia/Subzona</th>
			</tr>
		</thead>
		<tbody>
			@foreach($elemento->cargos()->get() as $cargo)
				<tr>
					<td>{{$cargo->nombre }}</td>
					<td>{{$cargo->pivot->fecha_inicio}}</td>
					@if($cargo->pivot->fecha_fin == null)
					    <td>-</td>
					@else
					    <td>{{ $cargo->pivot-> fecha_fin}}</td>
					@endif
					@if($cargo->nombre == 'Instructor')
					    @if($cargo->pivot->fecha_fin == null)
					        <td>{{$elemento->companiasysubzona->nombre}}</td>
					    @else
					    <?php $compania = $elemento->asistencias()->where('fecha','<',$cargo->pivot->fecha_fin)->where('fecha','>',$cargo->pivot->fecha_inicio)->first(); ?>
					        @if(!is_null($compania))
					            <td>{{ $compania->companiasysubzona->nombre }}</td>
					        @else
					            <td>-</td>
					        @endif    
					    @endif
					@else
					    <td>-</td>
					@endif
				</tr>
			@endforeach
		</tbody>
	</table>

	<h2>Ascensos</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Grado</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($elemento->grados()->orderby('fecha','asc')->get() as $grado)
            <tr>
                <td>{{ $grado-> nombre}}</td>
                <td>{{ $grado->pivot-> fecha}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Arrestos</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Motivo</th>
                <th>Sanción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($elemento->arrestos()->orderby('fecha','desc')->get() as $arresto)
            <tr>
                <td>{{ $arresto-> motivo}}</td>
                <td>{{ $arresto-> sancion}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>