@extends('layaouts.buscar')

@section('titulo')
  Eventos PDMU
@endsection
@section('head')
<style type="text/css">

</style>
@endsection
@section('h2')
Eventos
@endsection
@section('elemento')
    <div class="col-sm-8 col-sm-offset-2 well">
        <div class="row" style='margin-bottom:15px;'>
            <div class="col-sm-2 col-xs-5">
                <img src="" class="img-circle img-responsive img-thumbnail" id='foto' alt="Responsive image">
            </div>
            <div class="col-sm-6" id='datos'>
                <p id='lnombre'></p>
                <p id='lmatricula'></p>
                <p id='lfecha'></p>
            </div>
            <div class="col-sm-4">
                {{ Form::open(array('url' => 'url','role' => 'form','id' => 'evento','class' => '')) }}
                <div class="form-group">
                    {{ Form::label('Evento', 'Evento',array('class' => 'control-label')) }}
                    <select name="evento" class="form-control">
                        @foreach($eventos as $evento)
                            <option value="{{ $evento->id }}">{{ $evento->nombre }}</option>
                        @endforeach
                    </select>
                </div>    
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
@section('scripts2')
    <script type="text/javascript">
    function encontrado(id){
        elemento=id;
        $('.fa-spinner').removeClass('hidden');
        $('#agregar').addClass('hidden');
        $('#elemento').addClass('hidden');
            $.post("{{ URL::to('condecoraciones/elemento'); }}", 'id='+id, function(json) {
                $('#lnombre').html('<strong>Nombre:</strong> '+json.persona.nombre);
                $('#lmatricula').html('<strong>Matricula:</strong> '+json.persona.matricula);
                $('#lfecha').html('<strong>Fecha de nacimiento:</strong> '+json.persona.fecha);
                $('#foto').attr('src',"/"+json.persona.foto);
                $('[name=id]').val(id);
                
                $('.fa-spinner').addClass('hidden');
                $('#elemento').removeClass('hidden');
                $('.btn-info').removeClass('hidden');
        }, 'json');
    }
    </script>
@endsection