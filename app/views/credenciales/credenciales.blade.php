@extends('layaouts.base')

@section('titulo')
  Eventos|Inscripciones PDMU
@endsection
@section('head')
{{  HTML::style('css/bootstrap-datetimepicker.min.css');  }}
{{  HTML::style('css/sweet-alert.css');  }}
@endsection
@section('contenido')
<div class="row">
    <div class="col-sm-6 col-sm-offset-3 col-xs-7">
        <h1 style="margin-bottom:20px;">Imprecion de credenciales <small><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-user fa-stack-1x fa-inverse"></i></small></span>
        </h1>
    </div>
</div>
<div class="row">
  <div class="col-sm-4">
    <select name="compania" class="form-control">
      @foreach($companias as $compania)
        <option value="{{$compania->id}}">{{$compania->tipo}} {{$compania->nombre}}</option>
      @endforeach
      </select>
    </div>
    <div class="col-sm-2">
      <button type="button" class="btn btn-primary btn-md" style="margin-top: 0;" id="imprimir">Imprimir <i class="fa fa-print"></i></button>
    </div>
    <div class="col-sm-2"><i class="fa fa-refresh fa-spin fa-2x"></i></div>
</div>
<div class="col-sm-5 contenedor" style="min-height:700px; top:50px;">
  <div id="delementos"></div>
</div>
<div class="col-sm-5 col-sm-offset-1 contenedor">
  {{ Form::open(array('url' => 'credenciales/imprimir','role' => 'form','id' => 'credenciales','class' => 'form-control')) }}
  {{ Form::close() }}
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
    $(document).ready(function(){
      $('[name = compania]').change(function(){
        $('.fa-spin').removeClass('hidden');
          $.post("{{ URL::to('credenciales/elementos'); }}", {compania:$('[name = compania]').val()}, function(json) {
            if(json.success == true){
              $('#delementos').html('<table id="elementos" class="table table-hover table-first-column-number data-table display full"></table>');
              $('#elementos').dataTable( {
                  "data": json.elementos,
                  "columns": [
                      { "title": "id" },
                      { "title": "Matricula" },
                      { "title": "Nombre" },
                      { "title": "Grado" }
                  ],
                  "language": {
                    "lengthMenu": "Elementos por página _MENU_",
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
                swal('Error', json.message, "error");
            }
              $('#elementos').find('tbody').find('tr').on( 'click', function () {
                $(this).toggleClass('success');
              } );
              $('.fa-spin').addClass('hidden');
          }, 'json');
      }).change();
    });
$('#imprimir').click(function(){
  if($('#elementos').DataTable().rows('.success').data().length == 0){
    swal('Error', "Ningun elemento seleccionado", "error");
  }
  else{
    var elementos = '';
    $('#elementos').DataTable().rows('.success').data().each(function( row ) {
      elementos += '<input class="" type="checkbox" checked name="'+row[0]+'">';
    });
    $('#credenciales').html(elementos);
    $('#credenciales').submit();
  }
});
$('#Credenciales, #Credenciales').addClass('active');
  </script>
@endsection