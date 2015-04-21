@extends('layaouts.base')

@section('titulo')
  Calificaciones | PDMU
@endsection
@section('head')
<style type="text/css">
    .grado{
        background-color: #5B8DB8;
    }
    .up{
        top: 0 !important;
    }
    .fecha i{
        right: 55px !important;
    }
</style>
{{  HTML::style('css/bootstrap-datetimepicker.min.css');  }}
{{  HTML::style('css/sweet-alert.css');  }}
@endsection
@section('contenido')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h1 style="margin-bottom:20px;">Registro de calificaciones Por compañia</h1>
    </div>
    <div class="message col-md-3 col-md-offset-3" style="">
        <form >
            {{ Form::select('compania',$companias, null, array('class' => 'form-control')) }}
            <a id="compania" href="" class="btn btn-success">Siguiente</a>
        </form>
    </div>
@endsection
@section('scripts')
{{  HTML::script('js/bootstrapValidator.js'); }}
{{  HTML::script('js/es_ES.js'); }}
<script type="text/javascript">
$(document).ready(function() {
    $('[name = compania]').change(function(){
        $('#compania').attr('href','{{ URL::to("examenes/asignar"); }}'+'/'+$('[name = compania]').val());
    }).change();
    $('#Examenes, #2Examenes').addClass('active');
});
</script>
@endsection