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
            @foreach($backups as $backup)
                <p><a href="admin/download/{{$backup}}" title="">{{$backup}}</a></p>
            @endforeach
        </div>
    </div>
    <div class="row">  
        <div class="col-sm-2">
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
$(document).ready(function() {
    $('#update').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok nombre',
            invalid: 'glyphicon glyphicon-remove nombre',
            validating: 'glyphicon glyphicon-refresh nombre'
        },
        fields: {
            nombre: {
                validators: {
                    notEmpty: {
                    }
                }
            },
            id: {
                validators: {
                    integer: {
                    }
                }
            }
        }
    })
    .on('success.field.bv', function(e, data) {
            if (data.bv.getSubmitButton()) {
                data.bv.disableSubmitButtons(false);
            }
        })
    .on('success.form.bv', function(e) {
        $('.fa-refresh').removeClass('hidden');
    });
});
$('[name=estatus]').change(function() {
  if ($('[name=id]').val() != '' && $('[name=estatus]').val() == 'Inactiva') {
    $('#nueva').modal('hide');
    $tipe = $('#tipo').val();
    $('#malert').html('<h2 class=""><i class="fa fa-exclamation-triangle fa-lg text-danger"></i>  Esta operacion dara de baja a los elementos inscritos en esta '+$tipe+'.</h2>');
    $('#confirmar').modal('show');
    }
});
$('#bconfirmar').click(function(){
    $('#nueva').modal('show');
    $('#confirmar').modal('hide');
});
$('#bcancelar').click(function(){
    $("tbody").find('tr').removeClass('danger') .find('button').attr('disabled',false);
});
$('#status').change(function(){
    setTimeout (function () {
        swal($('#status_title').text(), $('#message').text(), $('#status').text())
    }, 1000);
}).change();
$('#bnueva').click(function(){
        $('#nueva').modal('show');
        $('[name=name]').html('<i class="fa fa-pencil"></i> Nueva Subzona/Compañía');
        $('[name=id]').val("");
        $('[name=nombre]').val("");
        $("tbody").find('tr').removeClass('danger') .find('button').attr('disabled',false);
    });
$('#nueva').on('hide.bs.modal', function() {
    if($('[name=id]').val() == '')
        $('#update').bootstrapValidator('resetForm', true);
    $('#update').bootstrapValidator('resetForm');
});
$('#Companias, #2Companias').addClass('active');
function editar(btn){
	$(btn).closest("tbody").find('tr').removeClass('danger').find('button').attr('disabled',false);
	$(btn).attr('disabled',true).closest("tr").addClass('danger');
	$('.message').addClass('hidden');
	$('#nueva').modal('show');
	$('[name=name]').text($(btn).closest("tr").find("td:nth-child(2)").text());
	$('[name=id]').val($(btn).closest("tr").find("td:nth-child(1)").text());
	$('[name=nombre]').val($(btn).closest("tr").find("td:nth-child(2)").text());
	$('[name=tipo] option[value='+$(btn).closest("tr").find("td:nth-child(3)").text()+']').attr('selected', true);
	$('[name=estatus] option[value='+$(btn).closest("tr").find("td:nth-child(4)").text()+']').attr('selected', true);
}
</script>
@endsection