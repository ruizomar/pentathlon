@extends('layaouts.base')

@section('titulo')
  Administracion PDMU
@endsection
@section('head')
{{  HTML::style('css/sweet-alert.css');  }}
<style type="text/css">
.nombre{
    top: 20px !important;
}
</style>
@endsection
@section('contenido')
    <div class="row">
        <div id="backups">
            <div class="col-sm-4 col-sm-offset-1">
                <h2><i class="fa fa-database"></i> Backup:</h2>
                @foreach($backups as $backup)
                    <h3><a href="admin/download/{{$backup}}" title="Descargar"><i class="fa fa-download"></i> {{$backup}}</a> | <a href="admin/delete/{{$backup}}" title="Eliminar"><i class="fa fa-times"></i></a> | <a href="admin/restore/{{$backup}}" title="Restaurar"><i class="fa fa-upload"></i></a></h3>
                @endforeach
            </div>
        </div>
        <!-- <div class="restor">
            <div class="col-sm-4 col-sm-offset-1">
                <h2>Restore backup</h2>
                <input type="file" name="bakup" value="" placeholder="backup.sql">
                <button type="button" class="btn btn-success">ok</button>
            </div>
        </div> -->
    </div>
    <div class="row">  
        <div class="col-sm-2 col-sm-offset-1">
            <a class="btn btn-primary" href="/admin/backup">Crear Backup</a>
        </div>
    </div>
@endsection
@section('scripts')
{{  HTML::script('js/tables/jquery.dataTables.min.js'); }}
{{  HTML::script('js/tables/jquery.dataTables.bootstrap.js'); }}
{{  HTML::script('js/bootstrapValidator.js'); }}
{{  HTML::script('js/es_ES.js'); }}
{{  HTML::script('js/sweet-alert.min.js'); }}
<script type="text/javascript">
    $('#companias').dataTable( {
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
</script>
<script type="text/javascript">
$('#Administracion, #2Administracion').addClass('active');
</script>
@endsection