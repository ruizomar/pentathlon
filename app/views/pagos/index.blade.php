@extends('layaouts.base')

@section('titulo')
  Pagos PDMU
@endsection
@section('contenido')
<div>
      {{ Form::open(array('url' => 'pagos/buscar','role' => 'form','id' => 'fbuscar')) }}
        <div class="col-md-12">
        <h2>Pago de membresia</h2>
            <div class="col-sm-3 form-group">
              {{ Form::label('nombre', 'Nombre (s)',array('class' => 'control-label')) }}
              {{ Form::text('nombre', null, array('placeholder' => 'introduce nombre','class' => 'form-control')) }}
            </div>
            <div class="col-sm-3 form-group">
              {{ Form::label('paterno', 'Apellido paterno',array('class' => 'control-label')) }}
              {{ Form::text('paterno', null, array('placeholder' => 'introduce apellido paterno','class' => 'form-control')) }}
            </div>
            <div class="col-sm-3 form-group">
              {{ Form::label('materno', 'Apellido materno',array('class' => 'control-label')) }}
              {{ Form::text('materno', null, array('placeholder' => 'introduce apellido materno','class' => 'form-control')) }}
            </div>
            <div class="col-sm-1">
              {{ Form::button('<i class="fa fa-search fa-lg"></i> Buscar',array('class' => 'btn btn-primary','id' => 'buscar','type' => 'submit')) }}
            </div>
        </div>
      {{ Form::close() }}
      <div id="error" class="col-md-12 hidden" style="margin-top:10px;">
        <p class="alert alert-danger"><i class="fa fa-exclamation-triangle fa-lg"></i> No se encontro al Elemento
        </p>
      </div>
      <div id="activ" class="col-md-12 hidden" style="margin-top:10px;">
        <p class="alert alert-warning"><i class="fa fa-exclamation-triangle fa-lg"></i> El elemento esta inactivo
        </p>
      </div>
      <i class="fa fa-spinner fa-2x fa-spin hidden spin-form"></i>
      <div id="elemento" class="col-md-12 tabla hidden">
        <h2 style="">Elemento</h2>
        <div class="col-md-9">
          <table id="telemento"class="table">
            <thead>
              <tr>
                <th>id</th>
                <th>Nombre(s)</th>
                <th>Apellido paterno</th>
                <th>Apellido materno</th>
                <th>Fecha de nacimiento</th>
                <th>Numero de Matrícula</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-md-3 well">
          {{ Form::open(array('url' => 'pagos/registrarpago','role' => 'form','id' => 'pagar')) }}
                <div class="form-group">
                  {{ Form::label('cantidad', 'Cantidad',array('class' => 'control-label')) }}
                  {{ Form::text('cantidad', null, array('class' => 'form-control','placeholder' => 'Cantidad')) }}
                </div>
                <div class="form-group">
                  {{ Form::label('concepto', 'Concepto',array('class' => 'control-label')) }}
                  {{ Form::select('concepto', array('' => 'Concepto','Matricula' => 'Matrícula'),null,array('placeholder' => 'Concepto','class' => 'form-control')) }}
                </div>
                {{ Form::text('id', null, array('class' => 'hidden form-control')) }}
                <div class="form-group">
                {{ Form::button('Registrar pago',array('class' => 'pagar btn btn-success','type' => 'submit','id' => 'bpagar')) }}
                </div>
                {{form::close()}}

        </div>
      </div>
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">
            <i class="fa fa-floppy-o"></i> Pago membresia
            <i class="fa fa-spinner fa-2x fa-spin hidden spin-modal"></i>
          </h4>
        </div>
        <div class="modal-body">

            <div id='pagoerror'class=" hidden alert alert-danger" role="alert">
              <label id="message">
            </label>
            </div>

        </div>
        <div class="modal-footer">
          {{ Form::open(array('url' => 'pagos/recibo','role' => 'form','id' => 'recibo','class' => 'form-inline')) }}
              {{ Form::text('id', null, array('class' => 'hidden form-control')) }}
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
            {{ Form::button('Imprimir recibo',array('class' => 'btn btn-success','type' => 'submit','id' => 'imprimir')) }}
          {{form::close()}}
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal -->
    <!-- Modal -->
  <div class="modal fade bs-example-modal-lg" id="Elementos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="Elementos">
            <i class="fa fa-eye"></i> Elementos
          </h4>
        </div>
        <div class="modal-body">

          <table id="elementos" class="table">
            <thead>
              <tr>
                <th>id</th>
                <th>Nombre(s)</th>
                <th>Apellido paterno</th>
                <th>Apellido materno</th>
                <th>Fecha de nacimiento</th>
                <th>Matrícula</th>
                <th>seleccionar</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>

        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal -->
</div>
@endsection
@section('scripts')
<style type="text/css">
.cantidad{
    right: -27px !important;
}

</style>
<script src="js/bootstrapValidator.js" type="text/javascript"></script>
<script src="js/es_ES.js" type="text/javascript"></script>
<script src="js/buscar.js" type="text/javascript"></script>
@endsection