@extends('layaouts.base')

@section('titulo')
  Eventos PDMU
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
@section('contenido')
<?php $status=Session::get('status'); ?>
<div class="row">
    <div class="col-sm-6 col-sm-offset-3 col-xs-7">
        <h1 style="margin-bottom:20px;">Eventos</h1>
    </div>
    <div class="col-sm-2 col-xs-4" style="margin-top:20px;">
        <button type="button" class="btn btn-success btn-lg" id="bnueva"><i class="fa fa-plus fa-lg"></i> Nuevo</button>
    </div>
</div>   
  <div class="col-md-2">
    @if(isset($eventos))
    <h2>Eventos proximos</h2>
        @foreach($eventos as $evento)   
          <h3>{{ $evento->nombre }}</h3>
          <h4>{{ $evento->fecha }}</h4>
          <p>{{ $evento->descripcion }}</p>
        @endforeach
    @endif      
  </div> 
    <div class="message col-md-6 col-md-offset-3">
        @if($status == 'fail_create')
        <div id="error" style="margin-top:10px;">
            <p class="alert alert-danger"><i class="fa fa-exclamation-triangle fa-lg"></i> Ocurrio un error 
            </p>
        </div>
        @elseif(($status == 'ok_create'))
        <div id="error" style="margin-top:10px;">
            <p class="alert alert-success"><i class="fa fa-check-square-o fa-lg"></i> Operacion completada correctamente
            </p>
        </div>
        @endif
    </div>
  
	<div class="col-md-8">
    {{ Form::open(array('url' => 'eventos/nuevoevento','role' => 'form','id' => 'form-nueva','class' => '')) }}
      <div class="form-group col-sm-6">
        {{ Form::label('Nombre', 'Nombre',array('class' => 'control-label')) }}
        {{ Form::text('Nombre', null, array('class' => 'form-control')) }}
      </div>
      <div class="form-group col-sm-4 fecha">                            
        {{ Form::label('Fecha', 'Fecha',array('class' => 'control-label')) }}
        <div class="input-group date" id="datetimePicker">
          {{ Form::text('Fecha', null, array('class' => 'form-control','placeholder' => 'YYYY-MM-DD', 'data-date-format' => 'YYYY-MM-DD')) }}
          <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
      </div>
      <div class="form-group col-sm-3">
        {{ Form::label('Tipo', 'Tipo',array('class' => 'control-label')) }}
        {{ Form::select('Tipo',$tipos, null, array('class' => 'form-control')) }}
      </div>
      <div class="form-group col-sm-4">
        {{ Form::label('Lugar', 'Lugar',array('class' => 'control-label')) }}
        {{ Form::text('Lugar', null, array('class' => 'form-control')) }}
      </div>
      
      <div class="form-group col-sm-3">
        {{ Form::label('Costo', 'Costo',array('class' => 'control-label')) }}
        {{ Form::text('Costo', null, array('class' => 'form-control')) }}
      </div>
      <div class="form-group col-sm-6">
        {{ Form::label('Descripcion', 'Descripcion',array('class' => 'control-label')) }}
        {{ Form::textarea('Descripcion', null, array('class' => 'form-control','rows' => '3')) }}
      </div>
      <div class="col-sm-2" style='top:25px;'>
        {{ Form::button('OK', array('class' => 'btn btn-success','id' => 'id','type' => 'submit')) }}
      </div>
    {{ Form::close() }}
	</div>
<!-- Modal -->
  <div class="modal fade" id="nueva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="companias">
            <i class="fa fa-pencil-square-o fa-lg"></i> Subzonas/Compañias
          </h4>
        </div>
        {{ Form::open(array('url' => 'companias/update','role' => 'form','id' => 'update','class' => '')) }}
        <div class="modal-body">
            <center>
            <h2 name="name"><i class="fa fa-pencil"></i> Nueva Subzona/Compañia</h2>
            <i class="fa fa-refresh fa-spin hidden fa-2x"></i>
            </center>
            <div class="form-group">
                {{ Form::text('id', null, array('class' => 'form-control hidden')) }}
            </div>
            
            <div class="form-group">  
              {{ Form::label('nombre', 'Nombre',array('class' => 'control-label')) }}
              {{ Form::text('nombre', null, array('placeholder' => 'introduce nombre','class' => 'form-control')) }}
            </div>
            <div class="form-group">
              {{ Form::label('tipo', 'Tipo',array('class' => 'control-label','name' => 'tipo')) }}
              {{ Form::select('tipo', array('Subzona' => 'Subzona','Compañia' => 'Compañia'),null,array('placeholder' => '','class' => 'form-control')) }}
            </div>
            <div class="form-group">
              {{ Form::label('estatus', 'Estatus',array('class' => 'control-label')) }}
              {{Form::select('estatus', array('Activa' => 'Activa','Inactiva' => 'Inactiva'),null,array('placeholder' => '','class' => 'form-control')) }}
            </div>

        </div>
        <div class="modal-footer">
            <button id='bcancelar' type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
            {{ Form::button('<i class="fa fa-floppy-o "></i> Guardar',array('class' => 'btn btn-success','id' => 'guardar','type' => 'submit')) }}
        </div> 
        {{ Form::close() }}
      </div>
    </div>
  </div>
  <!-- End Modal -->
  <!-- Modal -->
  <div class="modal fade" id="confirmar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content ">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="companias">
            <i class="fa fa-exclamation-triangle fa-lg text-danger"></i> Alerta
          </h4>
        </div>

        <div id="malert" class="modal-body">
            
            <h2 class=""><i class="fa fa-exclamation-triangle fa-lg text-danger"></i>  Esta operacion dará de baja a los elementos inscritos en esta 
            </h2>
           
        </div>

        <div class="modal-footer">
            <button id='bconfirmar' type="button" class="btn btn-info" data-dismiss="modal">OK</button>
        </div> 

      </div>
    </div>
  </div>
  <!-- End Modal -->  

@endsection
@section('scripts')
  {{  HTML::script('js/bootstrapValidator.js'); }}
  {{  HTML::script('js/es_ES.js'); }}
  {{  HTML::script('js/moment.js'); }}
  {{  HTML::script('js/bootstrap-datetimepicker.js'); }}
  {{  HTML::script('js/bootstrap-datetimepicker.es.js'); }}
  {{  HTML::script('js/sweet-alert.min.js'); }}
  <script type="text/javascript">
  $(document).ready(function() {
    $('#datetimePicker').datetimepicker({
        language: 'es',
        pickTime: false
    });

    $('#form-nueva').bootstrapValidator({
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
            Nombre: {
                validators: {
                    notEmpty: {
                    }
                }
            },
            Lugar: {
                validators: {
                    notEmpty: {
                    }
                }
            },
            Costo: {
                validators: {
                    integer: {
                    },
                    notEmpty: {
                    }
                }
            }
        }
    })
    .on('success.form.bv', function(e) {
      e.preventDefault();
            $('.fa-spin').removeClass('hidden');
            $.post($(this).attr('action'), $(this).serialize(), function(json) {
                  if(json.success == true){
                      swal(json.message, null, "success");
                      $('#form-nueva').data('bootstrapValidator').resetForm(true);
                  }
                  if(json.success == false){
                      swal('Error', json.errormessage, "error");
                      $('[name = Nombre]').val('');
                      $('#form-nueva').data('bootstrapValidator').resetForm();
                  }
              }, 'json');
    });

    $('#datetimePicker').on('dp.change dp.show', function(e) {
        $('#form-nueva').bootstrapValidator('revalidateField', 'Fecha');
    });
    $('#main-menu').find('li').removeClass('active');
    $('#main-menu ul li:nth-child(4)').addClass('active');
});
  </script>
@endsection