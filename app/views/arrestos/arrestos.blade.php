@extends('layaouts.buscar')
@section('titulo')
  Arrestos
@endsection
@section('head')
{{  HTML::style('css/bootstrap-datetimepicker.min.css');  }}
{{  HTML::style('css/sweet-alert.css');  }}
<style type="text/css">
  .fecha i{
    right: 55px !important;
  }
</style>
@endsection
@section('h2')
<div class="row">
    <div class="pull-left" style="font-size:40px;">Arrestos</div>
    <div class="pull-right">
        <a class="label label-success" href="{{URL::to('arrestos/reportes');}}"><i class="fa fa-line-chart"></i> Reporte</a>
    </div>
</div>
@endsection
@section('elemento')
	<div class="col-sm-8 col-sm-offset-2 contenedor" style="top:20px">
		{{ Form::open(array('id' => 'form-arresto','class' => '','url' => 'ascensos/update','files' => true)) }}
				<div class="col-sm-3 col-sm-offset-1" id="fotoperfil" style="padding-top:20px">
				</div>
				<div class="col-sm-7 col-sm-offset-1">
					<div class="col-sm-12">
						{{ Form::text('id', 'id',array('class' => 'hidden')) }}
						<h2 id="nombreelemento" name="nombre"></h2>
						<h4>
							{{ Form::label(null,'Matrícula: ',array('class' => 'small')) }}
							{{ Form::label('matricula',null,array('class' => 'pull-right label label-default')) }}
						</h4>
						<h4>
							{{ Form::label(null,'Ubicación: ',array('class' => 'small')) }}
							{{ Form::label('companiasysubzonas',null,array('class' => 'pull-right label label-default')) }}
						</h4>
						<h4>
							{{ Form::label(null,'Grado actual: ',array('class' => 'small')) }}
							{{ Form::label('grado',null,array('class' => 'pull-right label label-danger')) }}
						</h4>
						<h4>
							{{ Form::label(null,'Desde: ',array('class' => 'small')) }}
							{{ Form::label('fechagrado',null,array('class' => 'pull-right label label-default')) }}
						</h4>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="form-group col-sm-4 fecha">
			          {{ Form::label('Fecha', 'Fecha',array('class' => 'control-label')) }}
			          <div class="input-group date" id="datetimePicker">
			            {{ Form::text('Fecha', null, array('class' => 'form-control','placeholder' => 'YYYY-MM-DD', 'data-date-format' => 'YYYY-MM-DD')) }}
			            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			          </div>
			        </div>
					<div class="form-group col-sm-5">
						{{ Form::label('motivo', 'Motivo',array('class' => 'control-label')) }}
						{{ Form::text('motivo', null, array('class' => 'form-control')) }}
					</div>
					<div class="form-group col-sm-7">
						{{ Form::label('sancion', 'Sanción',array('class' => 'control-label')) }}
						{{ Form::textarea('sancion', null, array('class' => 'form-control','rows' => '3','style' => 'resize:none;')) }}
					</div>
				</div>
				{{ Form::button('<i class="fa fa-gavel fa-lg"></i> Guardar',array('id' =>'btnupdate','class' => 'pull-right btn btn-info','type' => 'submit')) }}
		{{Form::close()}}
	</div>
@stop
@section('scripts2')
	{{  HTML::script('js/bootstrapValidator.js'); }}
	{{  HTML::script('js/es_ES.js'); }}
	{{  HTML::script('js/moment.js'); }}
	{{  HTML::script('js/bootstrap-datetimepicker.js'); }}
	{{  HTML::script('js/bootstrap-datetimepicker.es.js'); }}
	{{  HTML::script('js/sweet-alert.min.js'); }}
	<script>
$(document).ready(function() {
    $('#datetimePicker').datetimepicker({
        language: 'es',
        pickTime: false
    });

    $('#form-arresto').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok fecha',
            invalid: 'glyphicon glyphicon-remove fecha',
            validating: 'glyphicon glyphicon-refresh fecha'
        },
        fields: {
            Fecha: {
                validators: {
                    notEmpty: {
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                    }
                }
            },
            motivo: {
                validators: {
                    notEmpty: {
                    },
                    stringLength:{
                      max: 100,
                    }
                }
            },
            sancion: {
                validators: {
                    notEmpty: {
                    },
                    stringLength:{
                      max: 140,
                    }
                }
            }
        }
    })
    .on('success.form.bv', function(e) {
      e.preventDefault();
        $('.fa-spin').removeClass('hidden');
          $.post('{{ URL::to("arrestos/nuevo"); }}',$('#form-arresto').serialize(), function(json) {
				if(json.success){
					$('.fa-spin').addClass('hidden');
					swal('Operacion completada correctamente',null, "success");
				}
				else{
					swal('Error',json.errormessage, "error");
				}
			}, 'json');
    });

    $('#datetimePicker').on('dp.change dp.show', function(e) {
        $('#form-arresto').bootstrapValidator('revalidateField', 'Fecha');
    });
});
$('#Arrestos, #2Arrestos').addClass('active');
    function encontrado (id) {
			$('#graficaAsistencias').html('');
			$('#calificaciones').html('');
			$('#reconocimientos').html('');
			$.post('ascensos/buscar',{id:id}, function(json) {
				$('.fa-spinner').addClass('hidden');
				$('#elemento').removeClass('hidden');
				$('[name=id]').val(json.id);
				$('#nombreelemento').text(json.nombre+' '+json.paterno+' '+json.materno);
				$('label[for=matricula]').text(json.matricula);
				$('label[for=companiasysubzonas]').text(json.companiasysubzonas);
				$('label[for=grado]').text(json.grado);
				$('label[for=fechagrado]').text(json.fechagrado);
				if(!json.cargo){
					$('label[for=cargo]').text('Cargo: Sin cargo');
				}
				$('#fotoperfil').html('<img id="theImg" class="img-responsive img-circle" src="'+json.fotoperfil+'" alt="Responsive image"/>');
			}, 'json');
		}
	</script>
@endsection