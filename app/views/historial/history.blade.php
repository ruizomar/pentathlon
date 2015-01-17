@extends('layaouts.buscar')

@section('titulo')
  Historial PDMU
@endsection
@section('head')
<style type="text/css">
    .cantidad{
        top: 0 !important;
    }
</style>
@endsection
@section('h2')
Historial
@endsection
@section('elemento')
    {{ Form::open(array('url' => 'historial/elemento','role' => 'form','id' => 'hitoria','class' => 'class')) }}
        {{ Form::text('id', null, array('class' => '')) }}
    {{ Form::close() }}
@endsection
@section('scripts2')
<script type="text/javascript">
    function encontrado(id){
        console.log("asd");
        $('[name=id]').val(id);
        $( "#hitoria" ).submit();
    }
    $('#Historial, #2Historial').addClass('active');
</script>
@endsection