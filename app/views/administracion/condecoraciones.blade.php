@extends('layaouts.buscar')

@section('titulo')
  Condecoraciones PDMU
@endsection
@section('head')
<style type="text/css">
    .new{
        position: relative;
    }
    @media screen and (max-device-width: 767px) and (orientation : portrait){
        .fa-certificate{
            position: absolute;
            left: 25.5%;
            top:-9px;
            color: #FFCC00;
        }
        .fa-circle{
            position: absolute;
            left:26%;
            top:-9px;
            color: #4CD964;
            opacity: .85;
        }
        .fa-check{
            position: absolute;
            left:40.5%;
            top:11px;
            color: #f5f5f5;
        }
    }
    @media screen and (max-device-width: 767px) and (orientation : landscape){
        .fa-certificate{
            position: absolute;
            left: 37.5%;
            top:-9px;
            color: #FFCC00;
        }
        .fa-circle{
            position: absolute;
            left:37.5%;
            top:-9px;
            color: #4CD964;
            opacity: .85;
        }
        .fa-check{
            position: absolute;
            left:44.5%;
            top:11px;
            color: #f5f5f5;
        }
    }
    @media screen and (min-device-width : 768px) and (orientation : landscape){
        .fa-certificate{
            position: absolute;
            left: 40%;
            top:-9px;
            color: #FFCC00;
        }
        .fa-circle{
            position: absolute;
            left: 40%;
            top:-5px;
            color: #4CD964;
            opacity: .85;
        }
        .fa-check{
            position: absolute;
            left: 45.5%;
            top:16px;
            color: #f5f5f5;
        }
    }
    @media screen and (min-device-width : 768px) and (orientation : portrait){
        .fa-certificate{
            position: absolute;
            left: 36%;
            top:-9px;
            color: #ffcc00;
        }
        .fa-circle{
            position: absolute;
            left:36%;
            top:-5px;
            color: #4CD964;
            opacity: .85;
        }
        .fa-check{
            position: absolute;
            left:44.5%;
            top:16px;
            color: #f5f5f5;
        }
    }
    @media screen and (min-device-width: 1200px) {
        .fa-certificate{
            position: absolute;
            left: 41.5%;
            top:-9px;
            color: #FFCC00;
        }
        .fa-circle{
            position: absolute;
            left:149px;
            top:-5px;
            color: #4CD964;
            opacity: .85;
        }
        .fa-check{
            position: absolute;
            left:166px;
            top:16px;
            color: #f5f5f5;
        }
    }
</style>
@endsection
@section('h2')
Condecoraciones
@endsection
@section('elemento')
    <div class="col-sm-8 col-sm-offset-2 contenedor">
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
                <div class="text-center">
                    <label><img src="{{ asset('imgs/condecoraciones/badge.png') }}" class="img-circle img-responsive " alt="Responsive image"></label>
                </div>
                <button class='btn btn-info btn-sm pull-right' onClick='formulario()'><i class="fa fa-plus"></i> agregar</button>
            </div>
        </div>
        <div id='insignias' class='row text-center'>
        </div>
        <div class="row">
            {{ Form::open(array('url' => 'condecoraciones/agregar','role' => 'form','id' => 'agregar','class' => 'hidden')) }}
                <div id="checks" class='text-center'></div>
                <div class="form-group col-sm-2 pull-right">
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
                    $('#insignias').append('<div class="col-sm-6 col-xs-6"><label><img src="{{ asset("imgs/condecoraciones") }}/'+this.nombre.match(/\d+/)+'.png" class="img-circle img-responsive" alt="Responsive image"></label><p>'+this.nombre+'<br><small>'+this.fecha+'</small></p></div>');
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
                    html +='<div class="col-sm-6 col-xs-6"><label><i class="fa fa-certificate fa-5x"></i><img src="{{ asset("imgs/condecoraciones") }}/'+json[i]+'.png" class="img-circle img-responsive new" alt="Responsive image"><input class="hidden" type="checkbox" onchange="check(this)" name="'+json[i]+'"></label><p>Condecoracion por '+json[i]+' años</p></div>';
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
            $(ck).closest("label").find('.fa-certificate').remove();
            $(ck).closest("label").append('<i class="fa fa-circle fa-5x"></i><i class="fa fa-check fa-2x"></i>');
            $(ck).closest("label").find('img').attr('style','opacity:0');
         }else{
             $(ck).closest("label").find('i').remove();
             $(ck).closest("label").prepend('<i class="fa fa-certificate fa-5x"></i>');
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