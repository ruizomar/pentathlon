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
    <div class="col-sm-8 col-sm-offset-2 well">
        <div class="row">
            <div class="col-sm-4">
                <label id='lnombre'></label>
            </div>
            <div class="col-sm-3">
                <label id='lmatricula'></label>
            </div>
            <div class="col-sm-5">
                <label id='lfecha'></label>
            </div>
        </div>
        <div class="row" style="margin-top: 10px;">
        {{ Form::open(array('url' => 'pagos/registrarpago','role' => 'form','id' => 'pagar')) }}
            <div class="form-group col-md-4">
              <select name="tipo" class='form-control'>
                  <option value="">Concepto</option>
                  <option value="Membresia">Membresia</option>
                  <option value="Credencial">Credencial</option>
                  <option value="Evento">Evento</option>
                  <option value="Examen">Examen</option>
              </select>
            </div>
            <div class="form-group col-md-4 hidden">
              <select name="concepto" class='form-control'>
                  <option value=""></option>
              </select>
            </div>
            <div class="form-group col-md-4">
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-usd fa-fw"></i></span>
              {{ Form::text('cantidad', null, array('class' => 'form-control','placeholder' => 'Cantidad')) }}
                </div>
            </div>
            {{ Form::text('id', null, array('class' => 'hidden form-control')) }}
            <div class="form-group col-md-3 pull-right">
            {{ Form::button('Registrar pago',array('class' => 'btn btn-success','type' => 'submit','id' => 'bpagar')) }}
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
            <i class="fa fa-floppy-o"></i> Pagos
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
    var conceptos = [];
    $(document).ready(function() {
        $('#pagar').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok cantidad',
            invalid: 'glyphicon glyphicon-remove cantidad',
            validating: 'glyphicon glyphicon-refresh cantidad'
        },
        fields: {
            enabled: false,
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
            tipo: {
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
                    $('#imprimir').removeClass('hidden');
                } else {
                    $('#message').html(json.errormessage);
                    $('#pagoerror').removeClass('hidden alert-success');
                    $('#pagoerror').addClass('alert-danger');
                    $('#imprimir').addClass('hidden');
                }
                $('#pag').val(json.pago);
                $('.spin-modal').addClass('hidden');
                $('#pagar').data('bootstrapValidator').resetField('cantidad', true);
                $('#pagar').data('bootstrapValidator').resetField('tipo', true);
    }, 'json');
    });
    });
        $('#main-menu').find('li').removeClass('active');
        $('#main-menu ul li:nth-child(2)').addClass('active');
        $('#sidebar-nav').find('li').removeClass('active');
        $('#sidebar-nav ul li:nth-child(1)').addClass('active');
    function encontrado(id){
            $.post('{{ URL::to("pagos/elemento"); }}', 'id='+id, function(json) {
                $('#lnombre').html('<strong>Nombre:</strong> '+json.nombre);
                $('#lmatricula').html('<strong>Matricula:</strong> '+json.matricula);
                $('#lfecha').html('<strong>Fecha de nacimiento:</strong> '+json.fecha);
                $('[name=id]').val(id);
                
                $('.fa-spinner').addClass('hidden');
                $('#elemento').removeClass('hidden');
        }, 'json');
    }
    $("[name = concepto]").change(function(){
            $("[name = cantidad]").attr("disabled","disabled");
            $.each(conceptos, function( index, concepto ) {
                if(concepto.id == $("[name = concepto] option:selected").val()){
                    $("[name = cantidad]").val(concepto.precio);
                }
            });
    });
    $("[name = tipo]").change(function(){
        $('#pagar').data('bootstrapValidator').resetField('cantidad', true);
        if($("[name = tipo] option:selected").val() == "evento"){
            llenarConcepto("{{ URL::to('eventos/eventos'); }}");
        }
        else if($("[name = tipo] option:selected").val() == "examen"){
            llenarConcepto("{{ URL::to('examenes/examenes'); }}");
        }
        else{
            $("[name = concepto]").closest('div').addClass('hidden');
            $("[name = cantidad]").removeAttr("disabled");
        }
    });
    function llenarConcepto(url){
        conceptos = [];
        $.post(url, $('#pagar').serialize(), function(json) {
            options = "";
            $.each(json, function( index, concepto ) {
                options += "<option value="+concepto.id+">"+concepto.nombre+"</option>";
                conceptos.push({id:concepto.id,precio:concepto.precio});
            });
            $("[name = concepto]").html(options);
            $("[name = cantidad]").val(conceptos[0].precio);
            $("[name = concepto]").closest('div').removeClass('hidden');
            $("[name = cantidad]").attr("disabled","disabled");
            $("#bpagar").removeAttr("disabled");
        }, 'json');
    }
    </script>
@endsection