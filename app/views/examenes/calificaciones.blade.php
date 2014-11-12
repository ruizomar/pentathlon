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
<?php $status=Session::get('status'); ?>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        @if(isset($compania))
        <h1 style="margin-bottom:20px;">Registro de calificaciones {{ $compania->tipo }} {{$compania->nombre }}</h1>
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
                <li><a href="#1" data-toggle="tab">Recluta</a></li>
                <li><a href="#2" data-toggle="tab">Cadete de infanteria</a></li>
                <li><a href="#3" data-toggle="tab">Cadete 1a</a></li>
                <li><a href="#4" data-toggle="tab">Cabo</a></li>
                <li><a href="#5" data-toggle="tab">Sargento 2</a></li>
                <li><a href="#6" data-toggle="tab">Sargento 1</a></li>
                <li><a href="#7" data-toggle="tab">Sub Oficial</a></li>
                <li><a href="#8" data-toggle="tab">3 Oficial</a></li>
                <li><a href="#9" data-toggle="tab">2 Oficial</a></li>
                <li><a href="#10" data-toggle="tab">1 Oficial</a></li>
                <li><a href="#11" data-toggle="tab">3 Comandante</a></li>
                <li><a href="#12" data-toggle="tab">2 Comandante</a></li>
                <li><a href="#13" data-toggle="tab">1 Comandante</a></li>
            </ul>
        </div>
        <div class="tab-content col-md-12">
            @foreach(Grado::all() as $grado)
                <div class="tab-pane" id="{{$grado->id}}">
                    <div class="titulo">
                        <h3>{{$grado->nombre}}</h3>
                    </div>
                @foreach ($grado->examenes()->get() as $examen)
                    <div class="examen col-sm-7">
                        <h2>Examen {{$examen->nombre}}</h2>
                        {{ Form::open(array('url' => 'examenes/','role' => 'form','id' => 'id','class' => 'id')) }}
                        <input type="text" name="examen" class="hidden" value="{{$examen->id}}">
                        <div class="form-group col-md-5 fecha">
                            <div class="input-group date datetimePicker">
                                <input type="text" class="form-control" name="fecha" placeholder="YYYY-MM-DD" data-date-format="YYYY-MM-DD" data-bv-date="true" data-bv-date-format="YYYY-MM-DD" data-bv-notempty/>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>
                        <div class="col-sm-1"><i class="fa fa-refresh fa-spin fa-3x hidden"></i></div>
                            <table class="table">
                            <thead>
                                <tr>
                                    <th>Matricula</th>
                                    <th>Nombre</th>
                                    <th>Calificacion</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($elementos as $elemento)
                                <?php
                                    $ele = $examen->elementos()
                                    ->where('id','=',$elemento->id)->first();
                                ?>
                                @if(!is_null($ele))
                                    <tr>
                                        @if(is_null($ele->matricula))
                                            <td>Sin Matricula</td>
                                        @else    
                                            <td>{{$elemento->matricula->id}}</td>
                                        @endif
                                        <td>{{$ele->persona->nombre}} {{$ele->persona->apellidopaterno}} {{$ele->persona->apellidomaterno}}</td>
                                        @if($ele->pivot->calificacion == null)
                                            <td><div class="form-group"><input type="text" name="{{$elemento->id}}" placeholder="Calificacion" class="form-control"  data-bv-notempty min="0" max="100"></div></td>
                                        @else
                                            <td><input type="text" name="{{$elemento->id}}" value="{{$ele->pivot->calificacion}}" class="form-control" disabled></td>
                                        @endif
                                    </tr>    
                                @elseif(is_null($ele) && $examen->grado_id == $elemento->grados()->orderBy('fecha','desc')->first()->id)
                                    <tr>
                                            @if(is_null($elemento->matricula))
                                                <td>Sin Matricula</td>
                                            @else    
                                                <td>{{$elemento->matricula->id}}</td>
                                            @endif
                                            <td>{{$elemento->persona->nombre}} {{$elemento->persona->apellidopaterno}} {{$elemento->persona->apellidomaterno}}</td>   
                                           <td><input type="text" name="{{$elemento->id}}" value="No entero" class="form-control" disabled></td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                            </table>
                        <button type="submit" class="btn btn-info pull-right">Guardar</button>
                        {{ Form::close() }}
                    </div>
                @endforeach
                </div>
            @endforeach
        </div>
<!------------------------form ----------------------------!-->  
	</div>
</div>

@endsection
@section('scripts')
{{  HTML::script('js/bootstrapValidator.js'); }}
{{  HTML::script('js/es_ES.js'); }}
{{  HTML::script('js/moment.js'); }}
{{  HTML::script('js/bootstrap-datetimepicker.js'); }}
{{  HTML::script('js/bootstrap-datetimepicker.es.js'); }}
{{  HTML::script('js/sweet-alert.min.js'); }}
<script type="text/javascript">
$(document).ready(function() {
    asd();
    $('.datetimePicker').datetimepicker({
        language: 'es',
        pickTime: false
    });

    $('.id').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok up',
            invalid: 'glyphicon glyphicon-remove up',
            validating: 'glyphicon glyphicon-refresh up'
        }
    })
    .on('success.form.bv', function(e) {
        e.preventDefault();
        formulario = $(this);
        formulario.closest('div').find('.fa-spin').removeClass('hidden');
        $.post('{{ URL::to("examenes/asignar"); }}', $(this).serialize(), function(json) {
                if(json.success){
                    formulario.data('bootstrapValidator').resetForm();
                    formulario.find('input').attr('disabled','disabled');
                    formulario.closest('div').find('button').attr('disabled','disabled');
                    swal('Operacion completada correctamente', null, 'success')
                }
                else
                    swal('Error', 'Ocurrio un error', 'error')
                formulario.closest('div').find('.fa-spin').addClass('hidden');
        }, 'json');
    });
    $('.datetimePicker').on('dp.change dp.show', function(e) {
        $(this).closest('form').bootstrapValidator('revalidateField', 'fecha');
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
    $('.tab-content').find('tbody').each(function( index ) {
        if( $( this ).find('input:enabled').length == 0){
            $( this ).closest('div').find('button').attr('disabled','disabled');
            $( this ).closest('div').find('input').attr('disabled','disabled');
        }
    });
}
</script>
@endsection