@extends('layaouts.base')
@section('titulo')
  Ascensos
@endsection
@section('head')
	<style>
		.contenedor {
			background: #fff;
			padding: 10px;
			margin-bottom: 15px;
			box-shadow: 0px 3px 2px #aab2bd;
			-moz-box-shadow: 0px 3px 2px #aab2bd;
			-webkit-box-shadow: 0px 3px 2px #aab2bd;
			left: 12px;
			border-top-width: 5px;
			border-top-style: solid;
			border-top-left-radius: .1em;
			border-top-right-radius: .1em;
		}

		.requisitos{
			background: #fff;
			border-top-width: 3px;
			border-top-style: solid;
			padding: 15px;
			box-shadow: 0px 1px 1px #aab2bd;
			-moz-box-shadow: 0px 1px 1px #aab2bd;
			-webkit-box-shadow: 0px 1px 1px #aab2bd;
			border-top-left-radius: .1em;
			border-top-right-radius: .1em;
			border-top-color: #76a7fa;
		}

		.error {
			box-shadow: 0px 0px 10px red;
			border-top-color: white;
		}

		#graficaAsistencias {
			background: #fff;
			height: 200px;
			margin-bottom: 20px;
		}

		.titulo {
			margin-top: -10px;
		}

		.listado {
			padding: 5px;
			margin-left: 0px;
		}

		.calificacion {
			font-size: 80%;
		}

		#calificaciones {
			margin-left: -14px;
			margin-right: -14px;
		}
	</style>
	{{  HTML::style('css/sweet-alert.css');  }}
	{{  HTML::script('js/jspdf.js'); }}
	{{  HTML::script('js/chart/morris.min.js'); }}
	{{  HTML::script('js/chart/raphael-min.js'); }}
@endsection
@section('contenido')
	<table class="table table-hover">
		<!-- <caption>Basic Table Layout</caption> -->
		<thead>
			<tr>
				<th>Check</th>
				<th>Nombre</th>
				<th>Paterno</th>
				<th>Materno</th>
				<th>Matricula</th>
				<th>id_Elemento</th>
				<th>id_Persona</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($elementos as $elemento)
				<tr class="success">
					<td>
						<input type="checkbox" value="" checked>
					</td>
					@foreach ($elemento as $element)
						<td>{{($element)}}</td>
					@endforeach
				</tr>
			@endforeach
		</tbody>
	</table>
@stop
@section('scripts')
@endsection