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
      <div class="col-md-4 form-group">
        {{ Form::label('donativo ', 'Donativo') }}
        {{ Form::text('donativo', null, array('class' => 'form-control mayuscula')) }}
      </div>
      <div class="col-md-8 form-group">
        <br>
        {{Form::button('<i class="fa fa-credit-card"></i> Guardar',array('id' => 'btnenviar','class' => 'pull-right btn btn-success','type' => 'submit'))}}
      </div>
    </div>
  {{Form::close()}}
@endsection
@section('scripts')
@endsection