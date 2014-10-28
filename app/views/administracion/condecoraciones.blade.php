@extends('layaouts.buscar')

@section('titulo')
  Condecoraciones PDMU
@endsection
@section('head')
<style type="text/css">
    .cantidad{
        top: 0 !important;
    }
    .cheked{
        opacity: .4;
    }
</style>
@endsection
@section('h2')
Condecoraciones
@endsection
@section('elemento')
    <div class="col-md-8 col-md-offset-2 well">
        <div class="row" style='margin-bottom:15px;'>
            <div class="col-md-2">
                <img src="" class="img-circle img-responsive img-thumbnail" id='foto' alt="Responsive image">
            </div>
            <div class="col-md-5" id='datos'>
                <label id='lnombre'></label>
                <label id='lmatricula'></label>
                <label id='lfecha'></label>
            </div>
            <div class="col-md-5">
                <div id='insignias'>
                    
                </div>
                <button class='btn btn-info btn-xs' onClick='formulario()'><i class="fa fa-plus"></i> agregar</button>
            </div>
        </div>
        {{ Form::open(array('url' => 'condecoraciones/agregar','role' => 'form','id' => 'agregar','class' => 'hidden')) }}
            <div class="form-group col-md-2 pull-right">
            {{ Form::button('Guardar',array('class' => 'btn btn-success btn-sm','type' => 'submit','id' => 'bpagar')) }}
            </div>
            {{ Form::text('id', null, array('class' => 'hidden form-control')) }}
        {{form::close()}}
    </div>
@endsection
@section('scripts2')
    <script type="text/javascript">
    var elemento;
        $('#main-menu').find('li').removeClass('active');
        $('#sidebar-nav').find('li').removeClass('active');
        $('#sidebar-nav ul li:nth-child(3)').addClass('active');
    function encontrado(id){
        elemento=id;
        $('.fa-spinner').removeClass('hidden');
        $('#agregar').addClass('hidden');
        $('#elemento').addClass('hidden');
            $.post('condecoraciones/elemento', 'id='+id, function(json) {
                $('#lnombre').html('<strong>Nombre:</strong> '+json.persona.nombre);
                $('#lmatricula').html('<strong>Matricula:</strong> '+json.persona.matricula);
                $('#lfecha').html('<strong>Fecha de nacimiento:</strong> '+json.persona.fecha);
                $('#foto').attr('src',json.persona.foto);
                $('#insignias').html("");
                if(json.success == false)
                    $('#insignias').append('<h2>Sin condecoraciones asignadas</h2>');
                $(json.condecoraciones).each(function() {
                    $('#insignias').append('<label><img src="imgs/pdmu.png" class="img-circle img-responsive img-thumbnail" alt="Responsive image"><small>'+this.nombre+'</small></label>');
                    $('#insignias').append('<label><small>Fecha: '+this.fecha+'</small></label>');
                  });
                $('[name=id]').val(id);
                
                $('.fa-spinner').addClass('hidden');
                $('#elemento').removeClass('hidden');
        }, 'json');
    }
    function formulario(){
        $('.fa-spinner').removeClass('hidden');
        $.post('condecoraciones/nueva', 'id='+elemento, function(json) {
            $('.check').remove();
            if(json.success == false)
                $('#insignias').append('<h2>No se pueden agregar condecoraciones</h2>');
            else{
                for (var i = 0; i < json.length; i++) {
                    $('#agregar').append('<label class="check"><img src="imgs/pdmu.png" class="img-circle img-responsive img-thumbnail cheked" alt="Responsive image"><input class="hidden" type="checkbox" onchange="check(this)" name="'+json[i]+'">Condecoracion por '+json[i]+' años</label>');
                };
                $('#agregar').removeClass('hidden');
            }
            $('.fa-spinner').addClass('hidden');
        }, 'json');        
    }
    function check(ck){
        if($(ck).is(":checked")) {
            $(ck).closest("label").find('img').removeClass('cheked');
         }else{
             $(ck).closest("label").find('img').addClass('cheked');
         }
    }
    $( "#agregar" ).submit(function( event ) {
        event.preventDefault();
      $.post('condecoraciones/agregar', $( "#agregar" ).serialize(), function(json) {
            if(json.success == true)
                encontrado($('[name = id]').val())
        }, 'json');
    });
    </script>
@endsection