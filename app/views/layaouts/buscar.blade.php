@extends('layaouts.base')

@section('contenido')

    {{ Form::open(array('url' => 'buscar','role' => 'form','id' => 'fbuscar')) }}
        <div class="col-sm-12">
            <h2>@yield('h2')</h2>
            <div class="col-sm-3 form-group">
              {{ Form::label('nombre', 'Nombre (s)',array('class' => 'control-label')) }}
              {{ Form::text('nombre', null, array('class' => 'form-control','autofocus')) }}
            </div>
            <div class="col-sm-3 form-group">
              {{ Form::label('paterno', 'Apellido paterno',array('class' => 'control-label')) }}
              {{ Form::text('paterno', null, array('class' => 'form-control')) }}
            </div>
            <div class="col-sm-3 form-group">
              {{ Form::label('materno', 'Apellido materno',array('class' => 'control-label')) }}
              {{ Form::text('materno', null, array('class' => 'form-control')) }}
            </div>
            <div class="col-sm-1">
              {{ Form::button('<i class="fa fa-search fa-lg"></i> Buscar',array('class' => 'btn btn-primary','id' => 'buscar','type' => 'submit')) }}
            </div>
        </div>
    {{ Form::close() }}
        <div id="error" class="col-sm-12 hidden" style="margin-top:10px;">
        <p class="alert alert-danger"><i class="fa fa-exclamation-triangle fa-lg"></i> No se encontró al Elemento
        </p>
        </div>
        <div id="activ" class="col-sm-12 hidden" style="margin-top:10px;">
        <p class="alert alert-warning"><i class="fa fa-exclamation-triangle fa-lg"></i> El elemento esta inactivo
        </p>
        </div>
        <i class="fa fa-spinner fa-2x fa-spin hidden spin-form"></i>
        <div id="elemento" class="col-md-12 hidden">
            @yield('elemento')
        </div>
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
        <div class="modal-body table-responsive">

          <table id="elementos" class="table">
            <thead>
              <tr>
                <th>id</th>
                <th>Nombre(s)</th>
                <th>Apellido paterno</th>
                <th>Apellido materno</th>
                <th>Fecha de nacimiento</th>
                <th>Matrícula</th>
                <th>Ubicación</th>
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
@endsection
@section('scripts')
{{  HTML::script('js/bootstrapValidator.js'); }}
{{  HTML::script('js/es_ES.js'); }}

<script type="text/javascript">
$(document).ready(function() {
   $('#fbuscar').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            nombre: {
                validators: {
                    notEmpty: {
                    },
                    regexp: {
                        regexp:/^[a-zA-Z áéíóúñÑÁÉÍÓÚ]+$/,
                        message: 'Por favor verifica el campo'
                    },
                    stringLength:{
                      max: 30,
                    }
                }
            },
            paterno: {
                validators: {
                    regexp: {
                        regexp:/^[a-zA-Z áéíóúñÑÁÉÍÓÚ]+$/,
                        message: 'Por favor verifica el campo'
                    },
                    stringLength:{
                      max: 30,
                    }
                }
            },
            materno: {
                validators: {
                    regexp: {
                        regexp:/^[a-zA-Z áéíóúñÑÁÉÍÓÚ]+$/
                        ,
                        message: 'Por favor verifica el campo'
                    },
                    stringLength:{
                      max: 30,
                    }
                }
            },
        }
    })
    .on('success.form.bv', function(e) {
            e.preventDefault();
            var $form = $(e.target);
            var bv = $form.data('bootstrapValidator');

            $('.spin-form').removeClass('hidden');
            $.post($form.attr('action'), $form.serialize(), function(json) {
                // // console.log(json)
                if (json.success) {
                    $('#error').addClass('hidden');
                    $('#activ').addClass('hidden');
                    encontrado(json.id);
                }
                else if(json.success == false){
                   if (json.ms){
                        $('#activ').removeClass('hidden');
                        $('#error').addClass('hidden');
                    }
                    else{
                        $('#activ').addClass('hidden');
                        $('#error').removeClass('hidden');
                    }
                    $('#elemento').addClass('hidden');
                    $('.fa-spin').addClass('hidden');
                }
                else{
                    $( "#elementos tbody" ).html('');
                    for (var i = json.length - 1; i >= 0; i--) {
                        var matricula = '';
                        if(json[i].matricula!=null)
                                matricula=json[i].matricula.id;
                        $( "<tr>" ).append(
                            "<td>"+json[i].id+'</td>'+
                            "<td>"+json[i].nombre+'</td>'+
                            "<td>"+json[i].paterno+'</td>'+
                            "<td>"+json[i].materno+'</td>'+
                            "<td>"+json[i].fecha+'</td>'+
                            "<td>"+matricula+'</td>'+
                            "<td>"+json[i].ubicacion+'</td>'+
                            '<td><button type="button" onclick="select(this)" class="btn btn-info select btn-sm">seleccionar</button></td>').appendTo( "#elementos tbody" );
                    };
                    $('#Elementos').modal('show');
                    $('#error').addClass('hidden');
                    $('#activ').addClass('hidden');
                    $('.fa-spin').addClass('hidden');
                }
                
    }, 'json');
    });
});
    function select(btn) {
        $('#Elementos').modal('hide');
        encontrado($(btn).closest("tr").find("td:nth-child(1)").text());
    }
</script>
 @yield('scripts2')
@endsection