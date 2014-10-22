@extends('layaouts.base')

@section('titulo')
  Condecoraciones | PDMU
@endsection
@section('contenido')
<div class="row">
    <div class="col-md-12">
        <h2>Registro de Condecoraciones</h2>
    </div>
    <div class="col-md-12">
        {{ Form::open(array('url' => 'pagos/buscar','role' => 'form','id' => 'fbuscar')) }}
            <div class="col-sm-3 form-group">
              {{ Form::label('nombre', 'Nombre (s)',array('class' => 'control-label')) }}
              {{ Form::text('nombre', null, array('placeholder' => 'introduce nombre','class' => 'form-control')) }}
            </div>
            <div class="col-sm-3 form-group">
              {{ Form::label('paterno', 'Apellido paterno',array('class' => 'control-label')) }}
              {{ Form::text('paterno', null, array('placeholder' => 'introduce apellido paterno','class' => 'form-control')) }}
            </div>
            <div class="col-sm-3 form-group">
              {{ Form::label('materno', 'Apellido materno',array('class' => 'control-label')) }}
              {{ Form::text('materno', null, array('placeholder' => 'introduce apellido materno','class' => 'form-control')) }}
            </div>
            <div class="col-sm-1">
              {{ Form::button('<i class="fa fa-search fa-lg"></i> Buscar',array('class' => 'btn btn-primary','id' => 'buscar','type' => 'submit')) }}
            </div>
      {{ Form::close() }}
    </div>
    <div id="error" class="col-md-12 hidden" style="margin-top:10px;">
        <p class="alert alert-danger"><i class="fa fa-exclamation-triangle fa-lg"></i> No se encontro al Elemento
        </p>
    </div>
    <div id="activ" class="col-md-12 hidden" style="margin-top:10px;">
        <p class="alert alert-warning"><i class="fa fa-exclamation-triangle fa-lg"></i> El elemento esta inactivo
        </p>
    </div>
    <i class="fa fa-spinner fa-2x fa-spin hidden spin-form"></i>
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
<!-- End Modal -->
</div>
@endsection
@section('scripts')
<style type="text/css">
.fech,.bv-no-label{
    margin-right: 65px !important;
}
.boton{
    margin-left: 10px !important;
}
</style>
<script type="text/javascript" src="/js/tables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/js/tables/jquery.dataTables.bootstrap.js"></script>
<script src="/js/bootstrapValidator.js" type="text/javascript"></script>
<script src="/js/es_ES.js" type="text/javascript"></script>
<script src="/js/jquery-ui.custom.js"></script>
<script src="/js/modernizr.js"></script>
<script src="js/buscar.js" type="text/javascript"></script>
<script>
    Modernizr.load({
        test: Modernizr.inputtypes.date,
        nope: "/js/jquery-ui.custom.js",
        callback: function() {
            $("input[type=date]").datepicker();
        }
    });
</script>
<script type="text/javascript">
    $('#elementos').dataTable( {
        "paging": false,
        "info":false,
        "language": {
            "lengthMenu": "Subzonas por página _MENU_",
            "zeroRecords": "No se encontro",
            "info": "Pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(Ver _MAX_ total records)",
            'search': 'Buscar: ',
        }
} );
</script>
<script type="text/javascript">
</script>
@endsection