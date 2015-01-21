@extends('layaouts.buscar')

@section('titulo')
  Enteros PDMU
@endsection
@section('head')
<style type="text/css">
    .cantidad{
        top: 0 !important;
    }
</style>
@endsection
@section('h2')
    <div class="row">
        <div class="pull-left" style="font-size:40px;">Enteros</div>
        <div class="pull-right">
            <a class="label label-primary" href="{{URL::to('pagos/donativos');}}">Donativo de un civil</a> <a class="label label-success" href="{{URL::to('pagos/reportes');}}"><i class="fa fa-line-chart"></i> Reporte general</a> <a class="label label-warning" href="{{URL::to('pagos/membresias');}}"><i class="fa fa-bars"></i> Reporte de membresias</a>
        </div>
    </div>
@endsection
@section('elemento')
    <div class="col-sm-7 col-sm-offset-2 contenedor">
        <div class="col-sm-3" style="margin-top: 20px;">
            <img id="fotoperfil" class="img-responsive img-thumbnail img-circle" alt="Responsive image"/>
        </div>
        <div class="col-sm-8 col-sm-offset-1">
                <h2 id='lnombre'></h2>
                <p id='lmatricula'></p>
                <p id='lfecha'></p>
                <p id='lgrado'></p>
                <p id='ladscripcion'></p>
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
                  <option value="Donativo">Donativo</option>
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
              {{ Form::text('cantidad', null, array('class' => 'form-control','placeholder' => 'Entero')) }}
                </div>
            </div>
            {{ Form::text('id', null, array('class' => 'hidden form-control')) }}
            <div class="form-group col-md-3 pull-right">
            {{ Form::button('Registrar entero',array('class' => 'btn btn-success','type' => 'submit','id' => 'bpagar')) }}
            {{ Form::button('Imprimir',array('class' => 'btn btn-success hidden','type' => 'submit','id' => 'donativo')) }}
            
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
            <i class="fa fa-floppy-o"></i> Enteros
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
            if($("[name = tipo] option:selected").val() != "Donativo")
            e.preventDefault();
            var $form = $(e.target);
            var bv = $form.data('bootstrapValidator');
            $('#myModal').modal('show')
            $('.spin-modal').removeClass('hidden');
            $('.alert').addClass('hidden');
            if($("[name = tipo] option:selected").val() != "Donativo")
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
                $('[name = concepto]').html('');
                $("[name = concepto]").closest('div').addClass('hidden');
    }, 'json');
    });
    });
$('#Enteros, #2Enteros').addClass('active');
    function encontrado(id){
            $.post('{{ URL::to("pagos/elemento"); }}', 'id='+id, function(json) {
                $('#lnombre').html('<strong>'+json.nombre+'</strong>');
                $('#lmatricula').html('<strong>Matrícula:</strong> '+json.matricula);
                $('#lfecha').html('<strong>Fecha de nacimiento:</strong> '+json.fecha);
                $('[name=id]').val(id);
                $('#fotoperfil').attr('src',json.foto);
                $('#lgrado').html('<strong>Grado:</strong> '+json.grado);
                $('#ladscripcion').html('<strong>Adscripción:</strong> '+json.compania);

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
        if($("[name = tipo] option:selected").val() == "Donativo"){
                $('#donativo').removeClass('hidden');
                $('#bpagar').addClass('hidden');
        }
        else{
            $('#donativo').addClass('hidden');
            $('#bpagar').removeClass('hidden');
        }
        if($("[name = tipo] option:selected").val() == "Evento"){
            llenarConcepto("{{ URL::to('eventos/eventos'); }}");
        }
        else if($("[name = tipo] option:selected").val() == "Examen"){
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
            if(options == "")
                $("#bpagar").attr("disabled","disabled");
            else{
                $("[name = cantidad]").val(conceptos[0].precio);
                $("#bpagar").removeAttr("disabled");
            }
            $("[name = concepto]").html(options);
            $("[name = concepto]").closest('div').removeClass('hidden');
            $("[name = cantidad]").attr("disabled","disabled");
        }, 'json');
    }
    </script>
@endsection