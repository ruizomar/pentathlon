@extends('layaouts.base')
@section('titulo')
	PDMU
@endsection
@section('link')
	<link href="css/ui-lightness/jquery-ui-1.10.0.custom.css" rel="stylesheet">
@endsection
@section('contenido')
    <form id="buscarelemento" role="form" method="POST" action="buscar">
        <div class="col-md-12">
            <h3>Búsqueda por datos</h3>
            <div class="col-md-3 form-group">
                {{ Form::label('reclunombre', 'Nombre (s)',array('class' => 'control-label')) }}
                {{ Form::text('reclunombre', null, array('placeholder' => 'introduce nombre','class' => 'form-control')) }}
            </div>
            <div class="col-md-3 form-group">
                {{ Form::label('reclupaterno', 'Apellido paterno') }}
                {{ Form::text('reclupaterno', null, array('placeholder' => 'introduce apellido paterno','class' => 'form-control')) }}
            </div>
            <div class="col-md-3 form-group">
                {{ Form::label('reclumaterno', 'Apellido materno') }}
                {{ Form::text('reclumaterno', null, array('placeholder' => 'introduce apellido materno','class' => 'form-control')) }}
            </div>
            <div class="col-md-2">
                {{ Form::submit('Buscar', array('placeholder' => '','class' => 'btn btn-primary')) }}
            </div>
        </div>
    </form>
    <form id="buscarconmatricula" role="form" method="POST">
        <div class="col-md-12">
            <h3>Búsqueda por matricula</h3>
            <div class="col-md-3 form-group">
                {{ Form::label('matricula', 'Nombre (s)',array('class' => 'control-label')) }}
                {{ Form::text('matricula', null, array('placeholder' => 'introduce nombre','class' => 'form-control')) }}
            </div>
            <div class="col-md-2">
                {{ Form::submit('Buscar', array('placeholder' => '','class' => 'btn btn-primary'))}}
            </div>
        </div>
    </form>
    <!--44444444444444444444444444444444444444444444444444444444 -->
    <div id="error" class="col-md-12 hidden" style="margin-top:10px;">
        <p class="alert alert-danger"><i class="fa fa-exclamation-triangle fa-lg"></i> No se encontro al Elemento
        </p>
    </div>
    <i class="fa fa-spinner fa-2x fa-spin hidden spin-form"></i>
    <div id="elemento" class="col-md-12 tabla hidden">
        <h2 style="">Elemento</h2>
        <table id="telemento"class="table">
          <thead>
            <tr>
              <th>id</th>
              <th>Nombre(s)</th>
              <th>Apellido paterno</th>
              <th>Apellido materno</th>
              <th>Fecha de nacimiento</th>
              <th>Numero de Matrícula</th>
              <th>Cantidad</th>
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
                  <td>
                    {{ Form::open(array('url' => 'pagos/registrarpago','role' => 'form','id' => 'pagar','class' => 'form-inline')) }}
                    <div class="form-group">
                    {{ Form::text('cantidad', null, array('class' => 'form-control','placeholder' => 'Cantidad')) }}
                    {{ Form::text('id', null, array('class' => 'hidden form-control')) }}
                    </div>
                    {{ Form::button('Registrar pago',array('class' => 'pagar btn btn-success','type' => 'submit','id' => 'bpagar')) }}
                    {{form::close()}}
                  </td>
                </tr>
              </tbody>
        </table>
    </div>
    <div class="modal fade bs-example-modal-lg" id="Elementos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="Elementos">
                        <i class="fa fa-eye"></i> Elementoss
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
@endsection
@section('scripts')
<!-- Para Bootstrap Validator -->
<script>
$(document).ready(function() {
    $('#buscarelemento').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            reclunombre: {
                validators: {
                    notEmpty: {}
                }
            },
            reclupaterno: {
                validators: {
                    notEmpty: {}
                }
            }
        }
    })
	$('#buscarconmatricula').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            matricula: {
                validators: {
                    notEmpty: {}
                }
            }
        }
    })
}
);
</script>
<script type="text/javascript" src="../js/bootstrapValidator.js"></script>
<script type="text/javascript" src="../js/language/es_ES.js"></script>
<script src="../js/mio.js" type="text/javascript"></script>

@endsection