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
  .eventos-titulo {
    color: #ffffff;
    font-size: 16px;
    padding: 0 10px;
    line-height: 60px;
    margin: 0;
    background: #326380;
    text-align: center;
    border-top-right-radius: 4px;
    border-top-left-radius: 4px;
    font-weight: bold;
  }
  </style>
@endsection
@section('contenido')
<div class="row">
    <div class="col-sm-6 col-sm-offset-3 col-xs-7">
        <h1 style="margin-bottom:20px;">Eventos <i class="fa fa-refresh fa-spin hidden"></i></h1>
    </div>
    <div class="col-sm-3 pull-right">
      <a Class="btn btn-primary" href="{{URL::to('eventos/inscripciones');}}" title="">Inscripciones</a>
    </div>
</div>
    <div class="contenedor col-md-8">
      {{ Form::open(array('url' => 'eventos/nuevoevento','role' => 'form','id' => 'form-nueva','class' => '')) }}
      {{ Form::text('id', null, array('class' => 'hidden')) }}
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
          {{ Form::label('Precio', 'Entero',array('class' => 'control-label')) }}
          <div class="input-group">
             <span class="input-group-addon"><i class="fa fa-usd fa-fw"></i></span>
            {{ Form::text('Precio', null, array('class' => 'form-control')) }}
          </div>
        </div>
        <div class="form-group col-sm-7">
          {{ Form::label('Descripcion', 'Descripción',array('class' => 'control-label')) }}
          {{ Form::textarea('Descripcion', null, array('class' => 'form-control','rows' => '3')) }}
        </div>
        <div class="col-sm-3" style='top:25px;'>
          {{ Form::button('OK', array('class' => 'btn btn-success','id' => 'ok','type' => 'submit')) }}
        </div>
        <div class="col-sm-3 hidden update" style='top:25px;'>
          <button type="button" class="btn btn-success" onClick="$('#form-nueva').data('bootstrapValidator').validate();" style="min-width:93px;">Update</button>
        </div>
        <div class="col-sm-3 hidden update" style='top:30px;'>
          <button type="button" class="btn btn-warning" onClick="cancel()" style="min-width:93px;">Cancelar</button>
        </div>
      {{ Form::close() }}
    </div>
    <div class="pull-right col-md-4" id="eventos">
      @if(isset($eventos))
      <h2 class="eventos-titulo">Eventos próximos</h2>
          @foreach($eventos as $evento)
            <div class="contenedor" style="border-top-style:none !important;">
              <i class="fa fa-clock-o pull-left"></i>
              <strong>{{ $evento->nombre }}</strong>
              <i class="fa fa-pencil fa-lg pull-right" style="cursor:pointer;" onClick="update('{{ $evento->id }}')"></i>
              <label class="label label-info pull-right">{{ $tipos[$evento->tipoevento_id] }} </label>
              <p><small>Fecha: {{ $evento -> fecha }}</small></p>
              <p>Lugar: {{ $evento->lugar }}</p>
              <p>{{ $evento->descripcion }}</p>
              <p>Entero: ${{ $evento->precio }}</p>
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
                    },
                    stringLength:{
                      max: 45,
                    }
                }
            },
            Lugar: {
                validators: {
                    notEmpty: {
                    },
                    stringLength:{
                      max: 45,
                    }
                }
            },
            Precio: {
                validators: {
                    integer: {
                    },
                    notEmpty: {
                    },
                    stringLength:{
                      max: 5,
                    }
                }
            }
        }
    })
    .on('success.form.bv', function(e) {
      e.preventDefault();
        $('.fa-spin').removeClass('hidden');
        if($('[name = id]').val() == ''){
          save('{{ URL::to("eventos/nuevoevento"); }}');
        }
        if($('[name = id]').val() != ''){
          save('{{ URL::to("eventos/update"); }}');
        }  
    });

    $('#datetimePicker').on('dp.change dp.show', function(e) {
        $('#form-nueva').bootstrapValidator('revalidateField', 'Fecha');
    });
    $('#Eventos, #2Eventos').addClass('active');
});
  </script>
  <script type="text/javascript">
  function update(id){
    $('.fa-spin').removeClass('hidden');
    $.post('{{ URL::to("eventos/evento"); }}', "id="+id, function(json) {
      if(json.success == false)
        swal('Error', json.errormessage, "error");
      else{
        $('[name = id]').val(json.id);
        $('[name = Nombre]').val(json.nombre);
        $('[name = Fecha]').val(json.fecha);
        $('[name = Lugar]').val(json.lugar);
        $('[name = Precio]').val(json.precio);
        $('[name = Descripcion]').val(json.descripcion);
        $('[name = Tipo] option[value='+json.tipoevento_id+']').attr('selected', true);
        
        $('.update').removeClass('hidden');
        $('#ok').addClass('hidden');
        $('.fa-spin').addClass('hidden');
      }
    }, 'json');
  }
  function cancel(){
    $('#form-nueva').data('bootstrapValidator').resetForm(true);
    $('[name = id]').val('');
    $('[name = Descripcion]').val('');
    $('#ok').removeClass('hidden');
    $('.update').addClass('hidden');
  }
  function save(url){
    $.post(url, $('#form-nueva').serialize(), function(json) {
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
  $('.fa-spin').addClass('hidden');
  }
  </script>
@endsection