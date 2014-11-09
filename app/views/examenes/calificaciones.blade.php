@extends('layaouts.base')

@section('titulo')
  Calificaciones | PDMU
@endsection
@section('head')
<style type="text/css">
    .grado{
        background-color: #5B8DB8;
    }
    .titulo{
        background-color: #ddd;
    }
    .barra ul li{
        position: relative;
        float: left;
        list-style: none;
    }
    .barra ul li a{
        font-weight: bold;
        font-size: 17px;
        margin:5px;
    }
</style>
{{  HTML::style('css/bootstrap-datetimepicker.min.css');  }}
@endsection
@section('contenido')
<?php $status=Session::get('status'); ?>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        @if(isset($compania))
        <h1 style="margin-bottom:20px;">Registro de calificaciones {{ $compania->tipo }} {{$compania->nombre }}  <i class="fa fa-refresh fa-spin hidden"></i></h1>
        @endif
    </div>
    <div class="message col-md-6 col-md-offset-3" style="">
        @if($status == 'fail_create')
        <div id="error" style="margin-top:10px;">
            <p class="alert alert-danger"><i class="fa fa-exclamation-triangle fa-lg"></i> Ocurrio un error 
            </p>
        </div>
        @elseif(($status == 'ok_create'))
        <div id="error" style="margin-top:10px;">
            <p class="alert alert-success"><i class="fa fa-check-square-o fa-lg"></i> Operacion completada correctamente
            </p>
        </div>
        @endif
    </div> 
	<div class="col-md-12">
<!------------------------form ----------------------------!-->
        <div class='col-sm-12 barra'>
            <ul class="">
                <li class=""><a href="#Recluta" data-toggle="tab" onClick="asd()">Recluta</a></li>
                <li class="divider"></li>
                <li><a href="#cabo" data-toggle="tab">Cabo</a></li>
            </ul>
        </div>
        <div class="tab-content col-sm-12">
                @if(isset($elementos))
                    @foreach (Grado::all() as $grado)
                    <div class="tab-pane" id="{{$grado->nombre}}">
                        <div class="titulo">
                            <label>{{$grado->nombre}}</label>
                        </div>
                        @foreach($grado->examenes()->get() as $examen)
                        <div class="examen col-sm-7">
                            <h2>
                            Examen {{$examen->nombre}}
                            </h2>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Matricula</th>
                                        <th>Nombre</th>
                                        <th>Calificacion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <input type="text" name="examen" value="{{$examen->id}}">
                            @foreach($elementos as $elemento)
                            <?php $att = $examen->elementos()->where('elemento_id','=',$elemento->id)->first();
                            ?>
                            @foreach (Grado::find($elemento->grados()->orderBy('fecha','desc')->first()->id)->examenes()->get() as $examenn)
                                @foreach ($examen->elementos()->where('Calificacion','=',null)->where('id','!=',1)->get() as $elemental)
                                {{$elemental->persona->nombre}}
                                    @endforeach
                            @endforeach
                                @if(!is_null($att))
                                    @if($att->pivot->calificacion == null)
                                    <tr>
                                        <td>{{$elemento->id}}</td>
                                        <td>{{$elemento->matricula->id}}</td>
                                        <td>{{$elemento->persona->nombre}}</td>
                                        <td>
                                            <input type="text" name="{{$elemento->id}}" placeholder="Calificacion" class="form-control">
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td>{{$elemento->id}}</td>
                                        <td>{{$elemento->matricula->id}}</td>
                                        <td>{{$elemento->persona->nombre}}</td>
                                        <td>
                                            {{$att->pivot->calificacion}}
                                        </td>
                                    </tr>
                                   @endif 
                                @elseif(is_null($att) && $elemento->grados()->orderBy('fecha','desc')->first()->id == $grado->id)
                                <tr>
                                    <td>{{$elemento->id}}</td>
                                    <td>{{$elemento->matricula->id}}</td>
                                    <td>{{$elemento->persona->nombre}}</td>
                                    <td>
                                        El elemento no a pagado
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                            </table>
                            <button type="button" class="btn btn-info">Guardar</button>
                        </div>
                        @endforeach
                        </div>
                    @endforeach 
                @else
                    <div class="alert alert-danger fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>Error</strong>Todavia no hay Compañias registradas.
                    </div>
                @endif
        </div>
        <div class="col-md-12">
             @foreach($elementos as $elemento)
                @foreach (Grado::find($elemento->grados()->orderBy('fecha','desc')->first()->id)->examenes()->get() as $examenn)
                    <?php
                    $ele = $examenn->elementos()->where('id','=',$elemento->id)->first();
                    ?>
                    {{$examenn->nombre}}
                    <p>
                    @if(!is_null($ele))
                        {{$ele->persona->nombre}} {{$ele->pivot->calificacion}}
                    @elseif(is_null($ele))
                        No a pagado {{$elemento->persona->nombre}}
                    @endif
                    </p>
                @endforeach
            @endforeach
        </div>
<!------------------------form ----------------------------!-->  
	</div>
</div>
<!-- Modal -->
  <div class="modal fade" id="Elemento" tabindex="-1" role="dialog" aria-labelledby="Elemento" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="Elemento">
            <i class="fa fa-eye"></i> Inasistencia prolongada
          </h4>
        </div>
        <div class="modal-body">

          

        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal --> 
@endsection
@section('scripts')
{{  HTML::script('js/tables/jquery.dataTables.min.js'); }}
{{  HTML::script('js/tables/jquery.dataTables.bootstrap.js'); }}
{{  HTML::script('js/bootstrapValidator.js'); }}
{{  HTML::script('js/es_ES.js'); }}
{{  HTML::script('js/moment.js'); }}
{{  HTML::script('js/bootstrap-datetimepicker.js'); }}
{{  HTML::script('js/bootstrap-datetimepicker.es.js'); }}
<script type="text/javascript">
$(document).ready(function() {
    $('#datetimePicker').datetimepicker({
        language: 'es',
        pickTime: false
    });

    $('#asis').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok fecha',
            invalid: 'glyphicon glyphicon-remove fecha',
            validating: 'glyphicon glyphicon-refresh fecha'
        },
        fields: {
            fecha: {
                validators: {
                    notEmpty: {
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                    }
                }
            }
        }
    })
    .on('success.form.bv', function(e) {
            $('.fa-spin').removeClass('hidden');
    });

    $('#datetimePicker').on('dp.change dp.show', function(e) {
        $('#asis').bootstrapValidator('revalidateField', 'fecha');
    });
    $('#main-menu').find('li').removeClass('active');
    $('#main-menu ul li:nth-child(4)').addClass('active');
});
</script>
<script type="text/javascript" charset="utf-8">
function asd(){
    $('.tab-content').find('tbody').each(function( index ) {
     
        if( $( this ).find('td').length == 0)
            $( this ).closest('div').html('');
    });
}
function message(id){
    $.post("{{ URL::to('asistencias/elemento'); }}", 'id='+id, function(json) {
            $('.modal-body').html('');
            $('.modal-body').append('<h2>Elemento:</h2>');
            $('.modal-body').append('<label><strong>'+json.elemento.nombre+' '+json.elemento.apellidopaterno+' '+json.elemento.apellidomaterno+'</strong></label>');
            $(json.telefonosElemento).each(function() {
                $('.modal-body').append('<p>'+this.tipo+': '+this.telefono+'</p>');
            });
            if (json.correoElemento)
                $('.modal-body').append('<p>Email: '+json.correoElemento+'</p>');
            $('.modal-body').append('<h2>'+json.relacion+':</h2>');
            $('.modal-body').append('<label><strong>'+json.tutor.nombre+' '+json.tutor.apellidopaterno+' '+json.tutor.apellidomaterno+'</strong></label>');
            $(json.telefonosTutor).each(function() {
                $('.modal-body').append('<p>'+this.tipo+': '+this.telefono+'</p>');
            });
            if (json.correotutor)
                $('.modal-body').append('<p>Email: '+json.correotutor+'</p>');
        }, 'json');
    $('#Elemento').modal('show');
}    
</script>
@endsection