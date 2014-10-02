@extends('layaouts.base')

@section('titulo')
  Pagos PDMU
@endsection
@section('contenido')
<div>

      {{ Form::open(array('url' => 'elemento','role' => 'form','id' => 'fbuscar')) }}
        <div class="col-md-12">
        <h2>Pago de membresia</h2>
            <div class="col-md-3 form-group">  
              {{ Form::label('nombre', 'Nombre (s)',array('class' => 'control-label')) }}
              {{ Form::text('nombre', null, array('placeholder' => 'introduce nombre','class' => 'form-control')) }}
            </div>
            <div class="col-md-3 form-group">
              {{ Form::label('paterno', 'Apellido paterno',array('class' => 'control-label')) }}
              {{ Form::text('paterno', null, array('placeholder' => 'introduce apellido paterno','class' => 'form-control')) }}
            </div>
            <div class="col-md-3 form-group">
              {{ Form::label('materno', 'Apellido materno',array('class' => 'control-label')) }}
              {{ Form::text('materno', null, array('placeholder' => 'introduce apellido materno','class' => 'form-control')) }}
            </div>
            <div class="col-md-1">
              {{ Form::button('<i class="fa fa-search fa-lg"></i> Buscar',array('class' => 'btn btn-primary','id' => 'buscar','type' => 'submit')) }}
            </div>
        </div>       
      {{ Form::close() }}
      <div id="error" class="col-md-12 hidden" style="margin-top:15px;">
        <p class="alert alert-danger">No se encontro al Elemento</p>
      </div>
      <i class="fa fa-spinner fa-2x fa-spin hidden"></i>
      <div class="col-md-12 tabla hidden">
        <h2 style="">Elementos</h2>
        <table class="table">
          <thead>
            <tr>
              <th>id</th>
              <th>Nombre</th>
              <th>Apellido paterno</th>
              <th>Apellido materno</th>
              <th>Fecha de nacimiento</th>
              <th>Matricula</th>
              <th>Operaciones</th>
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
              <td><a class="btn btn-success" href="" data-toggle="modal" data-target="#myModal">Registrar pago</a></span></td>
            </tr>
          </tbody>
        </table>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa icon-plus"></i> Pago membresia</h4>
      </div>
      <div class="modal-body">

        {{ Form::open(array('url' => 'imprimir/recibo','role' => 'form')) }}
      <form role="form" action="imprimir/recibomembresia" method="post">
        <div class="form-group">
          El pago se a registrado:
          <label for="exampleInputEmail1">1</label>
          <label for="exampleInputEmail1">Omar</label>
          <label for="exampleInputEmail1">Ruiz</label>
          <label for="exampleInputEmail1">Meza</label>
          <label for="exampleInputEmail1"><strong>20015</strong></label>
          <label for="exampleInputEmail1">2014</label>
        </div>

      </div>
      <div class="modal-footer">
        {{ Form::button('Cancelar',array('class' => 'btn btn-warning','data-dismiss' => 'modal')) }}
        {{ Form::button('Imprimir recibo',array('class' => 'btn btn-success','type' => 'submit')) }}
    </form> 
    {{form::close()}}
      </div>
    </div>
  </div>
</div>
</div>
<!-- End Modal -->
@endsection
@section('scripts')
<script src="js/bootstrapValidator.js" type="text/javascript"></script>
<script src="js/es_ES.js" type="text/javascript"></script>
<script src="js/buscar.js" type="text/javascript"></script>
@endsection