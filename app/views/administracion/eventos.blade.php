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
  .contenedor {
    padding: 10px;
    margin-bottom: 20px;
    background-color: #E0F8D8;
    border: 1px solid #83B373;
    border-radius: 10px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
    box-shadow: 5px 5px rgba(211, 207, 207, 1);
  }
  .eventos-titulo {
    color: #ffffff;
    font-size: 16px;
    padding: 0 10px;
    line-height: 60px;
    height: 60px;
    margin: 0;
    background: #83B373;
    text-align: center;
    border-top-right-radius: 4px;
    border-top-left-radius: 4px;
    font-weight: bold;
  }
  .prox-eventos {
    border-bottom: 2px solid #83B373;
    display: inline-block;
    padding: 10px;
    padding-left: 10px;
    width: 100%;
    background: #E0F8D8;
    border-bottom-right-radius: 4px;
    border-bottom-left-radius: 4px;
  }
  </style>
@endsection
@section('contenido')
<?php $status=Session::get('status'); ?>
<div class="row">
    <div class="col-sm-6 col-sm-offset-3 col-xs-7">
        <h1 style="margin-bottom:20px;">Eventos</h1>
    </div>
</div>
    <div class="contenedor col-md-8">
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
          <div class="input-group">
             <span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i></span>
            {{ Form::text('Lugar', null, array('class' => 'form-control')) }}
          </div>
        </div>
        
        <div class="form-group col-sm-3">
          {{ Form::label('Costo', 'Costo',array('class' => 'control-label')) }}
          <div class="input-group">
             <span class="input-group-addon"><i class="fa fa-usd fa-fw"></i></span>
            {{ Form::text('Costo', null, array('class' => 'form-control')) }}
          </div>
        </div>
        <div class="form-group col-sm-7">
          {{ Form::label('Descripcion', 'Descripcion',array('class' => 'control-label')) }}
          {{ Form::textarea('Descripcion', null, array('class' => 'form-control','rows' => '3')) }}
        </div>
        <div class="col-sm-2" style='top:25px;'>
          {{ Form::button('OK', array('class' => 'btn btn-success','id' => 'id','type' => 'submit')) }}
        </div>
      {{ Form::close() }}
    </div>
    <div class="pull-right col-md-4" id="eventos">
      @if(isset($eventos))
      <h2 class="eventos-titulo">Eventos próximos</h2>
          @foreach($eventos as $evento)
            <div class="prox-eventos">
              <i class="fa fa-clock-o pull-left"></i>
              <strong>{{ $evento->nombre }}</strong>
              <label class="label label-info pull-right">{{ $tipos[$evento->tipoevento_id] }}</label>
              <p><small>Fecha: {{ $evento -> fecha }}</small></p>
              <p>Lugar: {{ $evento->lugar }}</p>
              <p>{{ $evento->descripcion }}</p>
              <p>Costo: ${{ $evento->costo }}</p>
            </div>
          @endforeach    
      @endif
    </div>
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
                      $('#form-nueva').data('bootstrapValidator').resetForm(true);
                      
                      swal({
                        title: json.message,   
                        text: "",   
                        type: "success",   
                        showCancelButton: false,   
                        confirmButtonColor: "",   
                        confirmButtonText: "OK",     
                        closeOnConfirm: false,   
                        closeOnCancel: false }, 
                        function(isConfirm){
                          if (isConfirm) {     
                           window.location.reload();
                          }
                        });
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
    $('#sidebar-nav').find('li').removeClass('active');
        $('#sidebar-nav ul li:nth-child(4)').addClass('active');
});
  </script>
@endsection