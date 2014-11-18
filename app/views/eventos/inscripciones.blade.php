@extends('layaouts.base')

@section('titulo')
  Eventos|Inscripciones PDMU
@endsection
@section('head')
{{  HTML::style('css/bootstrap-datetimepicker.min.css');  }}
{{  HTML::style('css/sweet-alert.css');  }}
<style type="text/css">
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
<?php $status=Session::get('status'); ?>
<div class="row">
    <div class="col-sm-6 col-sm-offset-3 col-xs-7">
        <h1 style="margin-bottom:20px;">Elementos_Eventos <i class="fa fa-refresh fa-spin hidden"></i></h1>
    </div>
</div>
    <div class="contenedor col-sm-8 col-sm-offset-2">
      {{ Form::open(array('url' => 'eventos/inscritos','role' => 'form','id' => 'form-inscritos','class' => '')) }}
      {{ Form::text('id', null, array('class' => 'hidden')) }}
        <div class="form-group col-sm-4">
          {{ Form::label('Tipo', 'Tipo',array('class' => 'control-label')) }}
          {{ Form::select('Tipo',$tipos, null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group col-sm-6">
          {{ Form::label('Nombre', 'Nombre',array('class' => 'control-label')) }}
          {{ Form::select('Nombre', array(), null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group col-sm-6">
          {{ Form::label('Lugar', 'Lugar',array('class' => 'control-label')) }}
          <div class="input-group">
             <span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i></span>
            {{ Form::text('Lugar', null, array('class' => 'form-control','disabled')) }}
          </div>
        </div>
        <div class="form-group col-sm-4 fecha">
          {{ Form::label('Fecha', 'Fecha',array('class' => 'control-label')) }}
          {{ Form::text('Fecha', null, array('class' => 'form-control','disabled')) }}
        </div>
        <div class="form-group col-sm-7">
          {{ Form::label('Descripcion', 'Descripcion',array('class' => 'control-label')) }}
          {{ Form::textarea('Descripcion', null, array('class' => 'form-control','rows' => '3','disabled')) }}
        </div>
      {{ Form::close() }}
    </div>
    <div class="col-sm-5 contenedor" style="min-height:610px;">
      <h2>No inscritos</h2>
      <div id="dnoinscritos"></div>
    </div>
    <div class="col-sm-1" style="top:20px; margin-bottom:60px;">
      <button id="agregar" type="button" class="btn btn-info" style="margin-top:20px;">Agregar</button>
      <i class="fa fa-refresh fa-spin fa-4x hidden"></i>
      <button id="remover" type="button" class="btn btn-warning" style="margin-top:20px;">Remover</button>
    </div>
    <div class="col-sm-5 contenedor" style="min-height:610px;">
      <h2>Inscritos</h2>
      <div id="dinscritos"></div>
    </div>
@endsection
@section('scripts')
{{  HTML::script('js/tables/jquery.dataTables.min.js'); }}
{{  HTML::script('js/tables/jquery.dataTables.bootstrap.js'); }}
  {{  HTML::script('js/bootstrapValidator.js'); }}
  {{  HTML::script('js/es_ES.js'); }}
  {{  HTML::script('js/moment.js'); }}
  {{  HTML::script('js/bootstrap-datetimepicker.js'); }}
  {{  HTML::script('js/bootstrap-datetimepicker.es.js'); }}
  {{  HTML::script('js/sweet-alert.min.js'); }}
  <script type="text/javascript">
  var eventos = [];
    @foreach($eventos as $evento)
      eventos.push({{$evento}});
    @endforeach
    $(document).ready(function(){
      $('[name = Tipo]').change(function(){
        var selects='<option value="x">Selecciona uno</option>';
        $.each(eventos,function(index,evento){
          if($('[name = Tipo] option:selected').val() == evento.tipoevento_id){
            selects += '<option value="'+evento.id+'">'+evento.nombre+'</option>';
          }
        });
          $('[name = id]').val("");
          $('[name = Lugar]').val("");
          $('[name = Fecha]').val("");
          $('[name = Descripcion]').val("");

        $('[name = Nombre]').html(selects);
      }).change();
      $('[name = Nombre]').change(function(){
        $('[name = Nombre] option[value = "x"]').remove();
        $.each(eventos,function(index,evento){
          if($('[name = Nombre] option:selected').val() == evento.id){
            $('[name = id]').val(evento.id);
            $('[name = Lugar]').val(evento.lugar);
            $('[name = Fecha]').val(evento.fecha);
            $('[name = Descripcion]').val(evento.descripcion);
            $('#form-inscritos').submit();
          }   
        });
      }).change();
    });
  $('#form-inscritos').submit(function( event ) {
    event.preventDefault();
    $('.fa-spin').removeClass('hidden');
    $.post($('#form-inscritos').attr('action'), $('#form-inscritos').serialize(), function(json) {
      if(json.success == true){
        $('#dnoinscritos').html('<table id="noinscritos" class="table table-hover table-first-column-number data-table display full"></table>');
        $('#dinscritos').html('<table id="inscritos" class="table table-hover table-first-column-number data-table display full"></table>');
        $('#noinscritos').dataTable( {
            "data": json.elementosnoinscritos,
            "columns": [
                { "title": "id" },
                { "title": "Matricula" },
                { "title": "Nombre" },
                { "title": "Compañia" }
            ],
            "language": {
              "lengthMenu": "Subzonas por página _MENU_",
              "zeroRecords": "No se encontro",
              "info": "Pagina _PAGE_ de _PAGES_",
              "infoEmpty": "No records available",
              "infoFiltered": "(Ver _MAX_ total records)",
              'search': 'Buscar: ',
              "paginate": {
                "first":      "Inicio",
                "last":       "Fin",
                "next":       "Siguiente",
                "previous":   "Anterior"
              },
        }
        } );
        $('#inscritos').dataTable( {
            "data": json.elementosinscritos,
            "columns": [
                { "title": "id" },
                { "title": "Matricula" },
                { "title": "Nombre" },
                { "title": "Compañia" }
            ],
            "language": {
              "lengthMenu": "Subzonas por página _MENU_",
              "zeroRecords": "No se encontro",
              "info": "Pagina _PAGE_ de _PAGES_",
              "infoEmpty": "No records available",
              "infoFiltered": "(Ver _MAX_ total records)",
              'search': 'Buscar: ',
              "paginate": {
                "first":      "Inicio",
                "last":       "Fin",
                "next":       "Siguiente",
                "previous":   "Anterior"
              },
        }
        } );   
      }
      else{
          swal('Error', json.errormessage, "error");
      }
        $('#noinscritos, #inscritos').find('tbody').find('tr').on( 'click', function () {
          $(this).toggleClass('success');
        } );
        $('.fa-spin').addClass('hidden');
    }, 'json');
  });
$('#agregar').click(function(){
  if($('#noinscritos').DataTable().rows('.success').data().length == 0){
    swal('Error', "Ningun elemento seleccionado", "error");
  }
  else{
    var elementos = '';
    $('#noinscritos').DataTable().rows('.success').data().each(function( row ) {
      elementos += row[0]+"=on&";
    });
    evento_elemento("{{ URL::to('eventos/inscribir'); }}",elementos);
  }
});
$('#remover').click(function(){
  if($('#inscritos').DataTable().rows('.success').data().length == 0){
    swal('Error', "Ningun elemento seleccionado", "error");
  }
  else{
    var elementos = '';
    $('#inscritos').DataTable().rows('.success').data().each(function( row ) {
      elementos += row[0]+"=on&";
    });
    evento_elemento("{{ URL::to('eventos/desinscribir'); }}",elementos);
  }
});
function evento_elemento(action, elementos){
  $.post(action, elementos+'id='+$('[name = id]').val(), function(json) {
      if(json.success){
        swal('Operacion completada correctamente', null, "success");
      }
      else
        swal('Error', "Ocurrio un error intenta nuevamente", "error");
      $('#form-inscritos').submit();
      }, 'json');
}
  </script>
@endsection