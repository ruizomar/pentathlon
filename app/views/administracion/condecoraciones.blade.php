@extends('layaouts.buscar')

@section('titulo')
  Condecoraciones PDMU
@endsection
@section('head')
<style type="text/css">
    .new{
        position: relative;
    }
    .fa-sun-o{
        position: absolute;
        left:9px;
        top:-5px;
        color: #FFCC00;
    }
    .fa-circle{
        position: absolute;
        left:14px;
        top:-5px;
        color: #4CD964;
        opacity: .85;
    }
    .fa-check{
        position: absolute;
        left:31px;
        top:15px;
        color: #f5f5f5;
        opacity: 1;
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
                <div class="text-center">
                    <label><img src="{{ asset('imgs/condecoraciones/badge.png') }}" class="img-circle img-responsive " alt="Responsive image"></label>
                </div>
                <button class='btn btn-info btn-sm pull-right' onClick='formulario()'><i class="fa fa-plus"></i> agregar</button>
            </div>
        </div>
        <div id='insignias' class='row'>
        </div>
        <div class="row">
            {{ Form::open(array('url' => 'condecoraciones/agregar','role' => 'form','id' => 'agregar','class' => 'hidden')) }}
                <div id="checks"></div>
                <div class="form-group col-md-2 pull-right">
                {{ Form::button('Guardar',array('class' => 'btn btn-success btn-sm','type' => 'submit','id' => 'bpagar')) }}
                </div>
                {{ Form::text('id', null, array('class' => 'hidden form-control')) }}
            {{form::close()}}
        </div>
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
            $.post("{{ URL::to('condecoraciones/elemento'); }}", 'id='+id, function(json) {
                $('#lnombre').html('<strong>Nombre:</strong> '+json.persona.nombre);
                $('#lmatricula').html('<strong>Matricula:</strong> '+json.persona.matricula);
                $('#lfecha').html('<strong>Fecha de nacimiento:</strong> '+json.persona.fecha);
                $('#foto').attr('src',json.persona.foto);
                $('#insignias').html('');
                if(json.success == false)
                    $('#insignias').append('<h2>Sin condecoraciones asignadas</h2>');
                $(json.condecoraciones).each(function() {
                    $('#insignias').append('<div class="col-md-6"><label><img src="{{ asset("imgs/condecoraciones/badge.png") }}" class="img-circle img-responsive img-thumbnail" alt="Responsive image"> '+this.nombre+'<br><small>'+this.fecha+'</small></label></div>');
                  });
                $('[name=id]').val(id);
                
                $('.fa-spinner').addClass('hidden');
                $('#elemento').removeClass('hidden');
                $('.btn-info').removeClass('hidden');
        }, 'json');
    }
    function formulario(){
        $('.fa-spinner').removeClass('hidden');
        $.post("{{ URL::to('condecoraciones/nueva'); }}", 'id='+elemento, function(json) {
            $('.check').remove();
            if(json.success == false)
                $('#insignias').prepend('<cener><h2 class="text-danger">No se pueden asignar condecoraciones</h2></cener>');
            else{
                var html='';
                for (var i = 0; i < json.length; i++) {
                    html +='<div class="col-md-6"><label class="check"><i class="fa fa-sun-o fa-5x"></i><img src="{{ asset("imgs/condecoraciones/badge.png") }}" class="img-circle img-responsive img-thumbnail new" alt="Responsive image"><input class="hidden" type="checkbox" onchange="check(this)" name="'+json[i]+'"> Condecoracion por '+json[i]+' años</label></div>';
                };
                $('#checks').html(html);
                $('#agregar').removeClass('hidden');
            }
            $('.fa-spinner').addClass('hidden');
            $('.btn-info').addClass('hidden');
        }, 'json');        
    }
    function check(ck){
        if($(ck).is(":checked")) {
            $(ck).closest("label").find('.fa-sun-o').remove();
            $(ck).closest("label").append('<i class="fa fa-circle fa-5x"></i><i class="fa fa-check fa-2x"></i>');
            $(ck).closest("label").find('img').attr('style','opacity:0');
         }else{
             $(ck).closest("label").find('i').remove();
             $(ck).closest("label").prepend('<i class="fa fa-sun-o fa-5x"></i>');
             $(ck).closest("label").find('img').attr('style','opacity:1');
         }
    }
    $( "#agregar" ).submit(function( event ) {
        event.preventDefault();
      $.post("{{ URL::to('condecoraciones/agregar'); }}", $( "#agregar" ).serialize(), function(json) {
            if(json.success == true){
                encontrado($('[name = id]').val())
            }
        }, 'json');
    });
    </script>
@endsection