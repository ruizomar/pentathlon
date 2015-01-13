@extends('layaouts.base')
@section('titulo')
  Eventos PDMU
@endsection
@section('head')
  <style>
    .sd{
    }
  </style>
@endsection
@section('contenido')
  {{ Form::open(array('id' => 'formularioalta','url'=>'pagos/donativos','files'=>true)) }}
    <div class="col-md-10 col-md-offset-1">
      <div class="row">
      <div class="col-md-4 form-group">
        {{ Form::label('nombre', 'Nombre (s)',array('class' => 'control-label')) }}
        {{ Form::text('nombre', null, array('class' => 'form-control mayuscula','autofocus')) }}
      </div>
      <div class="col-md-4 form-group">
        {{ Form::label('paterno', 'Apellido paterno') }}
        {{ Form::text('paterno', null, array('class' => 'form-control mayuscula')) }}
      </div>
      <div class="col-md-4 form-group">
        {{ Form::label('materno', 'Apellido materno') }}
        {{ Form::text('materno', null, array('class' => 'form-control mayuscula')) }}
      </div>
      </div>
      <div class="row">
      <div class="col-md-4 form-group">
        {{ Form::label('donativo ', 'Donativo') }}
        {{ Form::text('donativo', null, array('class' => 'form-control mayuscula')) }}
      </div>
      <div class="col-md-8 form-group">
        <br>
        {{Form::button('<i class="fa fa-credit-card"></i> Guardar',array('id' => 'btnenviar','class' => 'pull-right btn btn-success','type' => 'submit'))}}
      </div>
      </div>
    </div>
  {{Form::close()}}
@endsection
@section('scripts')
{{  HTML::script('js/bootstrapValidator.js'); }}
{{  HTML::script('js/es_ES.js'); }}
<script type="text/javascript">
$(document).ready(function() {
    $('#formularioalta').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok cantidad',
            invalid: 'glyphicon glyphicon-remove cantidad',
            validating: 'glyphicon glyphicon-refresh cantidad'
        },
        fields: {
            enabled: false,
            donativo: {
                validators: {
                    notEmpty: {
                    },
                    regexp: {
                        regexp:/^[0-9]*\.?[0-9]+$/,
                        message: 'Por favor introduce una cantidad'
                    }
                }
            },
            nombre: {
                validators: {
                    notEmpty: {
                    },
                    regexp: {
                        regexp:/^[a-zA-Z áéíóúñÑÁÉÍÓÚ]+$/,
                        message: 'Por favor verifica el campo'
                    }
                }
            },
            paterno: {
                validators: {
                    notEmpty: {
                    },
                    regexp: {
                        regexp:/^[a-zA-Z áéíóúñÑÁÉÍÓÚ]+$/,
                        message: 'Por favor verifica el campo'
                    }
                }
            },
            materno: {
                validators: {
                    regexp: {
                        regexp:/^[a-zA-Z áéíóúñÑÁÉÍÓÚ]+$/,
                        message: 'Por favor verifica el campo'
                    }                }
            }
        }
    });
  });
</script>
@endsection