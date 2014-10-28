@extends('layaouts.buscar')

@section('titulo')
  pagos2 PDMU
@endsection
@section('head')
<style type="text/css">
    .cantidad{
        top: 0 !important;
    }
</style>
@endsection
@section('h2')
Pagos
@endsection
@section('elemento')
    <div class="col-md-8 col-md-offset-2 well">
        <div class="row" style='margin-bottom:15px;'>
            <div class="col-md-4">
                <label id='lnombre'></label>
            </div>
            <div class="col-md-3">
                <label id='lmatricula'></label>
            </div>
            <div class="col-md-5">
                <label id='lfecha'></label>
            </div>
        </div>
        {{ Form::open(array('url' => 'pagos/registrarpago','role' => 'form','id' => 'pagar')) }}
            <div class="form-group col-md-4">
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-usd fa-fw"></i></span>
              {{ Form::text('cantidad', null, array('class' => 'form-control','placeholder' => 'Cantidad')) }}
                </div>
            </div>
            <div class="form-group col-md-4">
              {{ Form::select('concepto', array('' => 'Concepto','Matricula' => 'Matrícula','Credencial' => 'Credencial'),null,array('class' => 'form-control')) }}
            </div>
            {{ Form::text('id', null, array('class' => 'hidden form-control')) }}
            <div class="form-group col-md-3">
            {{ Form::button('Registrar pago',array('class' => 'btn btn-success','type' => 'submit','id' => 'bpagar')) }}
            </div>
        {{form::close()}}
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
              {{ Form::text('id', null, array('id' => 'pag','class' => 'hidden form-control')) }}
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
            {{ Form::button('Imprimir recibo',array('class' => 'btn btn-success','type' => 'submit','id' => 'imprimir')) }}
          {{form::close()}}
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal -->
@endsection
@section('scripts2')
    <script type="text/javascript">
    $(document).ready(function() {
        $('#pagar').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok cantidad',
            invalid: 'glyphicon glyphicon-remove cantidad',
            validating: 'glyphicon glyphicon-refresh cantidad'
        },
        fields: {
            cantidad: {
                validators: {
                    notEmpty: {
                    },
                    regexp: {
                        regexp:/^[0-9]*\.?[0-9]+$/,
                        message: 'Por favor introduce una cantidad'
                    }
                }
            },
            concepto: {
                validators: {
                    notEmpty: {
                    }
                }
            }
        }
    })
    .on('success.form.bv', function(e) {
            e.preventDefault();
            var $form = $(e.target);
            var bv = $form.data('bootstrapValidator');
            $('#myModal').modal('show')
            $('.spin-modal').removeClass('hidden');
            $('.alert').addClass('hidden');
            $.post($form.attr('action'), $form.serialize(), function(json) {
                if (json.success) {
                    $('#message').html(json.message+json.matricula);
                    $('#pagoerror').removeClass('hidden alert-danger');
                    $('#pagoerror').addClass('alert-success');
                } else {
                    $('#message').html(json.errormessage);
                    $('#pagoerror').removeClass('hidden alert-success');
                    $('#pagoerror').addClass('alert-danger');
                }
                $('#pag').val(json.pago);
                $('.spin-modal').addClass('hidden');
                $('#pagar').data('bootstrapValidator').resetField('cantidad', true);
                $('#pagar').data('bootstrapValidator').resetField('concepto', true);
    }, 'json');
    });
    });
        $('#main-menu').find('li').removeClass('active');
        $('#main-menu ul li:nth-child(2)').addClass('active');
    function encontrado(id){
            $.post('pagos/elemento', 'id='+id, function(json) {
                $('#lnombre').html('<strong>Nombre:</strong> '+json.nombre);
                $('#lmatricula').html('<strong>Matricula:</strong> '+json.matricula);
                $('#lfecha').html('<strong>Fecha de nacimiento:</strong> '+json.fecha);
                $('[name=id]').val(id);
                
                $('.fa-spinner').addClass('hidden');
                $('#elemento').removeClass('hidden');
        }, 'json');
    }
    </script>
@endsection