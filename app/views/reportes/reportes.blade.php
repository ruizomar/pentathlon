@extends('layaouts.base')
@section('titulo')
  Reportes
@endsection
@section('head')
    <style>
        .contenido {
            background: #fff;
            padding: 10px;
            border-top-width: 2px;
            border-top-style: solid;
            padding-right: 20px;
            box-shadow: 0px 3px 2px #aab2bd;
            -moz-box-shadow: 0px 3px 2px #aab2bd;
            -webkit-box-shadow: 0px 3px 2px #aab2bd;
            margin-left: 25px;
            margin-bottom: 30px;
        }
        .seleccion {
            background: #fff;
            padding: 10px;
            border-top-width: 3px;
            /*border-top-style: solid;*/
            border-top-color: #7797DD;
            padding-right: 20px;
            box-shadow: 0px 10px 10px #606264;
            -moz-box-shadow: 0px 10px 10px #606264;
            -webkit-box-shadow: 0px 10px 10px #606264;
            margin-left: 25px;
            margin-bottom: 25px;
        }
        .informacion{
            font-size: 14px;
        }
        .requisitos{
            background: #fff;
            border-top-width: 3px;
            border-top-style: solid;
            padding: 15px;
            box-shadow: 0px 1px 1px #aab2bd;
            -moz-box-shadow: 0px 1px 1px #aab2bd;
            -webkit-box-shadow: 0px 1px 1px #aab2bd;
            border-top-left-radius: .1em;
            border-top-right-radius: .1em;
            border-top-color: #000;
            color: #525050;
        }
        .requisitos:hover{
            background: #fbb03b;
            color:#fff;
            border-top-color: #fbb03b;
            cursor: pointer;
        }

        .grafica {
            /*background: #f2f2f2;*/
            height: 300px;
            margin-bottom: 20px;
        }

        .cabecera{
            margin-top: 3px;
            font-size: 14px;
        }
        .etiquetas{
            margin-top: 15px;
        }
        .fecha i{
            top:25px !important;
            right: 55px !important;
        }
    </style>
    {{  HTML::style('css/sweet-alert.css')}}
    {{  HTML::style('css/tour/bootstrap-tour.min.css')}}
    {{  HTML::script('js/tour/bootstrap-tour.min.js')}}
    {{  HTML::script('js/chart/morris.min.js')}}
    {{  HTML::script('js/chart/raphael-min.js')}}
    {{  HTML::style('css/bootstrap-datetimepicker.min.css');  }}
    {{  HTML::script('js/tables/jquery.dataTables.min.js')}}
    {{  HTML::style('css/jquery.dataTables.css')}}
    {{  HTML::style('css/dataTables.tableTools.css')}}
    {{  HTML::script('js/dataTables.tableTools.min.js')}}
    {{  HTML::script('js/bootstrapValidator.js'); }}
    {{  HTML::script('js/es_ES.js'); }}

@endsection
@section('contenido')
    <div class="titulo1 col-md-11 col-md-offset-1">
        <h1 style="margin-bottom:20px;"><i class="fa fa-bar-chart"></i> Reportes</h1>
    </div>
    <div class="menu col-md-offset-1 col-md-10" style="margin-top:18px;">
        <a href="#" class="requisitos col-md-12 text-center" onclick="companias()">
            <h4>Reporte por compañía</h4>
            <i class="fa fa-map-marker fa-5x"></i>
            <div id="reconocimientos"></div>
        </a>
        <a href="{{ URL::to('history'); }}" class="hidden requisitos col-md-6 text-center">
            <h4>Reporte por evento</h4>
            <i class="fa fa-crosshairs fa-5x"></i>
            <div id="reconocimientos"></div>
        </a>
    </div>
    <div class="col-md-3">
    </div>
    <div class="menucompanias hidden">
        <div class="col-md-offset-10 col-md-1" style="margin-top: -50px;">
            <button class="pull-right btn-sm btn btn-success" onclick="coleccion()"><i class="fa fa-bar-chart"></i> Generar reporte</button>
        </div>
        <div class="col-md-12 form-group" id="companias" style="margin-left:80px;">
        </div>
    </div>
    <div class="hidden col-md-12 form-horizontal" id="compania" style="left:10;">
        <h1 id="nombre" style="margin-bottom:20px;"><i class="fa fa-bar-chart"></i></h1>
        <button class="pull-right btn-sm btn btn-success" onclick="$('#compania').data('bootstrapValidator').validate(); if($('#compania').data('bootstrapValidator').isValid()) dibujagrafica()"><i class="fa fa-bar-chart"></i> Generar</button>
        <div class="col-md-3 form-group fecha">
            {{ Form::label('birthday', 'Fecha de inicio') }}
            <div class="input-group" id="datetimePicker">
                {{ Form::text('birthday', null, array('id' => 'fechainicio','class' => 'form-control', 'placeholder' => 'AAAA-MM-DD', 'data-date-format' => 'YYYY-MM-DD')) }}
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>
        <div class="col-md-3 form-group fecha">
            {{ Form::label('birthday', 'Fecha de fin') }}
            <div class="input-group" id="datetimePicker2">
                {{ Form::text('birthday2', null, array('id' => 'fechafin','class' => 'form-control', 'placeholder' => 'AAAA-MM-DD', 'data-date-format' => 'YYYY-MM-DD')) }}
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>
        <div class="form-group col-md-12">
            <hr>
            <label class="label label-primary"> Género <i class="fa fa-female"></i> / <i class="fa fa-male"></i></label><br>
            <div class="col-md-2 etiquetas">
                <label class="checkbox-inline">
                    <input id="1" name="sexo[]" type="checkbox">Masculino
                </label>
            </div>
            <div class="col-md-2 etiquetas">
                <label class="checkbox-inline">
                    <input id="2" name="sexo[]" type="checkbox">Femenino
                </label>
            </div>
        </div>
        <div class="form-group col-md-12">
            <hr>
            <label class="label label-primary"> Edad <i class="fa fa-child"></i></label><br>
            <div class="col-md-2 etiquetas">
                <label class="checkbox-inline">
                    <input id="3" name="edad[]" type="checkbox">Menor
                </label>
            </div>
            <div class="col-md-2 etiquetas">
                <label class="checkbox-inline">
                    <input id="4" name="edad[]" type="checkbox">Juvenil
                </label>
            </div>
            <div class="col-md-2 etiquetas">
                <label class="checkbox-inline">
                    <input id="5" name="edad[]" type="checkbox">Mayor
                </label>
            </div>
        </div>
        <div class="form-group col-md-12">
            <hr>
            <label class="label label-primary"> Grados <i class="fa fa-star"></i></label><br>
            <div class="col-md-3 etiquetas">
                <label class="checkbox-inline">
                    <input id="6" name="grado[]" type="checkbox"> Recluta
                </label>
            </div>
            <div class="col-md-3 etiquetas">
                <label class="checkbox-inline">
                    <input id="7" name="grado[]" type="checkbox"> Cadete de infantería
                </label>
            </div>
            <div class="col-md-3 etiquetas">
                <label class="checkbox-inline">
                    <input id="8" name="grado[]" type="checkbox"> Cadete 1a
                </label>
            </div>
            <div class="col-md-3 etiquetas">
                <label class="checkbox-inline">
                    <input id="9" name="grado[]" type="checkbox"> Cabo
                </label>
            </div>
            <div class="col-md-3 etiquetas">
                <label class="checkbox-inline">
                    <input id="10" name="grado[]" type="checkbox"> Sargento 2
                </label>
            </div>
            <div class="col-md-3 etiquetas">
                <label class="checkbox-inline">
                    <input id="11" name="grado[]" type="checkbox"> Sargento 1
                </label>
            </div>
            <div class="col-md-3 etiquetas">
                <label class="checkbox-inline">
                    <input id="12" name="grado[]" type="checkbox"> Sub Oficial
                </label>
            </div>
            <div class="col-md-3 etiquetas">
                <label class="checkbox-inline">
                    <input id="13" name="grado[]" type="checkbox"> 3 Oficial
                </label>
            </div>
            <div class="col-md-3 etiquetas">
                <label class="checkbox-inline">
                    <input id="14" name="grado[]" type="checkbox"> 2 Oficial
                </label>
            </div>
            <div class="col-md-3 etiquetas">
                <label class="checkbox-inline">
                    <input id="15" name="grado[]" type="checkbox"> 1 Oficial
                </label>
            </div>
            <div class="col-md-3 etiquetas">
                <label class="checkbox-inline">
                    <input id="16" name="grado[]" type="checkbox"> 3 Comandante
                </label>
            </div>
            <div class="col-md-3 etiquetas">
                <label class="checkbox-inline">
                    <input id="17" name="grado[]" type="checkbox"> 2 Comandante
                </label>
            </div>
            <div class="col-md-3 etiquetas">
                <label class="checkbox-inline">
                    <input id="18" name="grado[]" type="checkbox"> 1 Comandante
                </label>
            </div>
            <!-- <div id="generar">
            </div> -->
        </div>
        <div id="datos" class="col-md-6">
        </div>
        <div class="col-md-12">
            <button id="imprimir" class="hidden pull-right btn btn-primary" onclick="window.print();return false;"><i class="fa fa-print"></i></button>
        </div>
    </div>
    <div id="spin" class="hidden col-md-12 text-center" style="padding: 200px;">
        <i class="fa fa-cog fa-spin fa-5x"></i>
    </div>
    <div class="col-md-12">
        <div id="graficasexos" class="grafica col-md-4">
        </div>
        <div id="graficaedades" class="grafica col-md-4">
        </div>
        <div id="graficagrados" class="grafica col-md-4">
        </div>
    </div>
    <div class="row">
        <table id="telementos" class="contenido hidden col-md-12 display" cellspacing="0" width="100%">
            <thead>
                <tr class="tour-3">
                <th>Nombre</th>
                <th>Paterno</th>
                <th>Materno</th>
                <th>Matrícula</th>
                <th>Grado</th>
                <th>Fecha</th>
                <th>Sexo</th>
                <th>Edad</th>
                <th>Zona</th>
                </tr>
            </thead>
            <tbody id="elementobody">
            </tbody>
        </table>
    </div>
@stop
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#datetimePicker ,#datetimePicker2').datetimepicker({
                language: 'es',
                pickTime: false
            });
            $('#compania').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    'sexo[]': {
                        validators: {
                            choice :{
                                min : 1,
                            }
                        }
                    },
                    'edad[]': {
                        validators: {
                            choice :{
                                min : 1,
                            }
                        }
                    },
                    birthday: {
                        validators: {
                            notEmpty: {},
                            date: {
                                format: 'YYYY-MM-DD',
                            }
                        }
                    },
                    birthday2: {
                        validators: {
                            notEmpty: {},
                            date: {
                                format: 'YYYY-MM-DD',
                            }
                        }
                    },
                }
            });
            $('#datetimePicker').on('dp.change dp.show', function(e) {
                $('#compania').bootstrapValidator('revalidateField', 'birthday');
            });
            $('#datetimePicker2').on('dp.change dp.show', function(e) {
                $('#compania').bootstrapValidator('revalidateField', 'birthday2');
            });
            
        });
        $('#Reportes, #2Reportes').addClass('active');
        var arrayId;
        function companias () {
            $('#spin').removeClass('hidden');
            $('.menu').addClass('hidden');
            $.get('reportes/lugares', function(json) {
              $('#companias').html('');
              $('#spin').addClass('hidden');
              $.each(json,function(index,lugar){
                if(lugar.status == 'Activa'){
                    $('#companias').append('<div id="seleccion'+lugar.id+'" class="contenido col-md-3" onclick="seleccionar('+lugar.id+')"><input class=" pull-right hidden" value="'+lugar.id+'" type="checkbox" id="check-'+lugar.id+'"><h3 class="cabecera">'+lugar.nombre+'</h3><i class="fa fa-users">'+lugar.numelementos+'</i><br><label class="informacion label label-success">'+lugar.status+'</label><br><label class="informacion label label-primary">'+lugar.tipo+'</label><label class="pull-right label label-default" style="cursor:pointer;" onclick="masInformacion('+lugar.id+')">Ver reporte individual <i class="fa fa-bar-chart"></i></label></div>');
                }else{
                    $('#companias').append('<div id="seleccion'+lugar.id+'" class="contenido col-md-3" onclick="seleccionar('+lugar.id+')"><input class=" pull-right hidden" value="'+lugar.id+'" type="checkbox" id="check-'+lugar.id+'"><h3 class="cabecera">'+lugar.nombre+'</h3><i class="fa fa-users">'+lugar.numelementos+'</i><br><label class="informacion label label-danger">'+lugar.status+'</label><br><label class="informacion label label-primary">'+lugar.tipo+'</label><label class="pull-right label label-default" style="cursor:pointer;" onclick="masInformacion('+lugar.id+')">Ver reporte individual <i class="fa fa-bar-chart"></i></label></div>');
                }
              });
            }, 'json');
            $('.menucompanias').removeClass('hidden');
        }
        function seleccionar(id) {
            $('#seleccion'+id).toggleClass('seleccion');
            if($("#check-"+id).is(':checked')){
                $("#check-"+id).prop("checked", false);
            }
            else{
                $("#check-"+id).prop("checked", true);
            }
        };
        function masInformacion(id) {
            $('html, body').animate({ scrollTop: 0 }, 'slow');
            arrayId = [];
            arrayId.push($('#check-'+id).attr('value'));
            $('.menucompanias').html('');
            $('.titulo1').addClass('hidden');
            $.post('reportes/nombre',{id:id}, function(json) {
                $('#nombre').html(json.nombre);
            }, 'json');
            $('#compania').removeClass('hidden');
        };
        function coleccion () {
            $('html, body').animate({ scrollTop: 0 }, 'slow');
            arrayId = [];
            $("input:checkbox:checked").each(function(){
                arrayId.push($(this).attr('value'));
            });
            $('.menucompanias').html('');
            $('.titulo1').addClass('hidden');
            $('#nombre').addClass('hidden');
            $('#compania').removeClass('hidden');
            $('#generar').html('<button class="pull-right btn-xs btn btn-success" onclick="dibujagrafica()"><i class="fa fa-bar-chart"></i> Generar reporte</button>');
        }
    </script>
    <script>
        function dibujartabla (inicio,fin) {
            var d = new Date();
            var month = d.getMonth()+1;
            var day = d.getDate();
            var output = d.getFullYear() + '/' +
                (month<10 ? '0' : '') + month + '/' +
                (day<10 ? '0' : '') + day;
            mensaje = 'Rango de fechas: ['+inicio+' al '+fin+']    ';
            if($('#1').is(':checked')){mensaje += ' Hombres: ' +thombres};
            if($('#2').is(':checked')){mensaje += ' Mujeres: '+tmujeres};
            if($('#3').is(':checked')){mensaje += ' Menores: '+(menor + menorM)};
            if($('#4').is(':checked')){mensaje += ' Juvenil: '+(juvenil + juvenilM)};
            if($('#5').is(':checked')){mensaje += ' Mayor: '+(mayor + mayorM)};
            if($('#6').is(':checked')){mensaje += ' Reclutas: '+(recluta + reclutaM)};
            if($('#7').is(':checked')){mensaje += ' Cadete: '+(cadete + cadeteM)};
            if($('#8').is(':checked')){mensaje += ' Cadete de Primera: '+(cadete1 + cadete1M)};
            if($('#9').is(':checked')){mensaje += ' Cabo: '+(cabo + caboM)};
            if($('#10').is(':checked')){mensaje += ' Sargento: '+(sargento2 + sargento2M)};
            if($('#1').is(':checked')){mensaje += ' Sargento: '+(Sargento1 + Sargento1M)};
            if($('#12').is(':checked')){mensaje += ' Sub Oficial: '+(subOficial + subOficialM)};
            if($('#13').is(':checked')){mensaje += ' 3 Oficial: '+(Oficial1 + Oficial1M)};
            if($('#14').is(':checked')){mensaje += ' 2 Oficial: '+(Oficial2 + Oficial2M)};
            if($('#15').is(':checked')){mensaje += ' 1 Oficial: '+(Oficial3 + Oficial3M)};
            if($('#16').is(':checked')){mensaje += ' 3 Comandante: '+(Comandante1 + Comandante1M)};
            if($('#17').is(':checked')){mensaje += ' 2 Comandante: '+(Comandate2 + Comandate2M)};
            if($('#18').is(':checked')){mensaje += ' 1 Comandante: '+(Comandante3 + Comandante3M)};
            $('#telementos').DataTable( {
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                    },
                    "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                paging: true,
                searching: true,
                dom: 'T<"clear">lfrtip',
                tableTools : {
                    "sSwfPath": "{{URL::to('swf/copy_csv_xls_pdf.swf')}}",
                    aButtons: [
                        "copy",
                        "xls",
                        {
                            "sExtends": "pdf",
                            "sPdfOrientation": "landscape",
                            "sPdfMessage": mensaje,
                            "fecha": ' Fecha del reporte: '+output
                        },
                    ]
                },
            });
        }
        function dibujagrafica() {
            $('#compania').addClass('hidden');
            $('#spin').removeClass('hidden');
            $('#grafica').html('');
            $('#datos').html('');
            $('#imprimir').addClass('hidden');
            id = arrayId;
            inicio = $('#fechainicio').val();
            fin = $('#fechafin').val();
            $.post('reportes/compania',{id:id,inicio:inicio,fin:fin}, function(json) {
                // // console.log(json);
                thombres = 0;
                recluta = 0;
                cadete = 0;
                cadete1 = 0;
                cabo = 0;
                sargento2 = 0;
                Sargento1 = 0;
                subOficial = 0;
                Oficial1 = 0;
                Oficial2 = 0;
                Oficial3 = 0;
                Comandante1 = 0;
                Comandate2 = 0;
                Comandante3 = 0;
                menor = 0;
                juvenil = 0;
                mayor = 0;

                tmujeres = 0;
                reclutaM = 0;
                cadeteM = 0;
                cadete1M = 0;
                caboM = 0;
                sargento2M = 0;
                Sargento1M = 0;
                subOficialM = 0;
                Oficial1M = 0;
                Oficial2M = 0;
                Oficial3M = 0;
                Comandante1M = 0;
                Comandate2M = 0;
                Comandante3M = 0;
                menorM = 0;
                juvenilM = 0;
                mayorM = 0;
                $.each(json,function(index,lugar){
                    if ($('#1').is(':checked')) {
                        if(lugar.Masculino){
                            if ($('#1').is(':checked') && $('#3').is(':checked')) {
                                if(lugar.Masculino.Menor){
                                    $.each(lugar.Masculino.Menor,function(index,edad){
                                        menor += edad.length;
                                        if(lugar.Masculino.Menor){
                                            $.each(edad,function(index,grado){
                                                $('#elementobody').append('<tr>'+
                                                    '<td>'+grado.nombre+'</td>'+
                                                    '<td>'+grado.paterno+'</td>'+
                                                    '<td>'+grado.materno+'</td>'+
                                                    '<td>'+grado.matricula+'</td>'+
                                                    '<td>'+grado.grado+'</td>'+
                                                    '<td>'+grado.fecha+'</td>'+
                                                    '<td>'+grado.sexo+'</td>'+
                                                    '<td>'+grado.edad+'</td>'+
                                                    '<td>'+grado.zona+'</td>');
                                            });
                                        }
                                    });
                                }
                            };
                            if ($('#1').is(':checked') && $('#4').is(':checked')) {
                                if(lugar.Masculino.Juvenil){
                                    $.each(lugar.Masculino.Juvenil,function(index,edad){
                                        juvenil += edad.length;
                                        if(lugar.Masculino.Juvenil){
                                            $.each(edad,function(index,grado){
                                                $('#elementobody').append('<tr>'+
                                                    '<td>'+grado.nombre+'</td>'+
                                                    '<td>'+grado.paterno+'</td>'+
                                                    '<td>'+grado.materno+'</td>'+
                                                    '<td>'+grado.matricula+'</td>'+
                                                    '<td>'+grado.grado+'</td>'+
                                                    '<td>'+grado.fecha+'</td>'+
                                                    '<td>'+grado.sexo+'</td>'+
                                                    '<td>'+grado.edad+'</td>'+
                                                    '<td>'+grado.zona+'</td>');
                                            });
                                        }
                                    });
                                }
                            };
                            if ($('#1').is(':checked') && $('#5').is(':checked')) {
                                if(lugar.Masculino.Mayor){
                                    $.each(lugar.Masculino.Mayor,function(index,edad){
                                        mayor += edad.length;
                                        if(lugar.Masculino.Mayor){
                                            $.each(edad,function(index,grado){
                                                $('#elementobody').append('<tr>'+
                                                    '<td>'+grado.nombre+'</td>'+
                                                    '<td>'+grado.paterno+'</td>'+
                                                    '<td>'+grado.materno+'</td>'+
                                                    '<td>'+grado.matricula+'</td>'+
                                                    '<td>'+grado.grado+'</td>'+
                                                    '<td>'+grado.fecha+'</td>'+
                                                    '<td>'+grado.sexo+'</td>'+
                                                    '<td>'+grado.edad+'</td>'+
                                                    '<td>'+grado.zona+'</td>');
                                            });
                                        }
                                    });
                                }
                            };
                            $.each(lugar.Masculino,function(index,edad){
                                if($('#6').is(':checked')){recluta += edad.recluta.length;}
                                if($('#7').is(':checked')){cadete += edad.cadete.length;}
                                if($('#8').is(':checked')){cadete1 += edad.cadete1.length;}
                                if($('#9').is(':checked')){cabo += edad.cabo.length;}
                                if($('#10').is(':checked')){sargento2 += edad.sargento2.length;}
                                if($('#11').is(':checked')){Sargento1 += edad.Sargento1.length;}
                                if($('#12').is(':checked')){subOficial += edad.subOficial.length;}
                                if($('#13').is(':checked')){Oficial1 += edad.Oficial1.length;}
                                if($('#14').is(':checked')){Oficial2 += edad.Oficial2.length;}
                                if($('#15').is(':checked')){Oficial3 += edad.Oficial3.length;}
                                if($('#16').is(':checked')){Comandante1 += edad.Comandante1.length;}
                                if($('#17').is(':checked')){Comandate2 += edad.Comandate2.length;}
                                if($('#18').is(':checked')){Comandante3 += edad.Comandante3.length;}
                                $.each(edad,function(index,grado){
                                    $.each(grado,function(index,hombre){
                                        if (!$('#3').is(':checked') && !$('#4').is(':checked') && !$('#5').is(':checked')) {
                                            thombres++;
                                        }
                                        else{
                                            thombres = menor+juvenil+mayor;
                                        }
                                    });
                                });
                            });
                        }
                    };
                    if ($('#2').is(':checked')) {
                        if(lugar.Femenino){
                            if ($('#2').is(':checked') && $('#3').is(':checked')) {
                                if(lugar.Femenino.Menor){
                                    $.each(lugar.Femenino.Menor,function(index,edad){
                                        menorM += edad.length;
                                        if(lugar.Femenino.Menor){
                                            $.each(edad,function(index,grado){
                                                $('#elementobody').append('<tr>'+
                                                    '<td>'+grado.nombre+'</td>'+
                                                    '<td>'+grado.paterno+'</td>'+
                                                    '<td>'+grado.materno+'</td>'+
                                                    '<td>'+grado.matricula+'</td>'+
                                                    '<td>'+grado.grado+'</td>'+
                                                    '<td>'+grado.fecha+'</td>'+
                                                    '<td>'+grado.sexo+'</td>'+
                                                    '<td>'+grado.edad+'</td>'+
                                                    '<td>'+grado.zona+'</td>');
                                            });
                                        }
                                    });
                                }
                            };
                            if ($('#2').is(':checked') && $('#4').is(':checked')) {
                                if(lugar.Femenino.Juvenil){
                                    $.each(lugar.Femenino.Juvenil,function(index,edad){
                                        juvenilM += edad.length;
                                        if(lugar.Femenino.Juvenil){
                                            $.each(edad,function(index,grado){
                                                $('#elementobody').append('<tr>'+
                                                    '<td>'+grado.nombre+'</td>'+
                                                    '<td>'+grado.paterno+'</td>'+
                                                    '<td>'+grado.materno+'</td>'+
                                                    '<td>'+grado.matricula+'</td>'+
                                                    '<td>'+grado.grado+'</td>'+
                                                    '<td>'+grado.fecha+'</td>'+
                                                    '<td>'+grado.sexo+'</td>'+
                                                    '<td>'+grado.edad+'</td>'+
                                                    '<td>'+grado.zona+'</td>');
                                            });
                                        }
                                    });
                                }
                            };
                            if ($('#2').is(':checked') && $('#5').is(':checked')) {
                                if(lugar.Femenino.Mayor){
                                    $.each(lugar.Femenino.Mayor,function(index,edad){
                                        mayorM += edad.length;
                                        if(lugar.Femenino.Mayor){
                                            $.each(edad,function(index,grado){
                                                $('#elementobody').append('<tr>'+
                                                    '<td>'+grado.nombre+'</td>'+
                                                    '<td>'+grado.paterno+'</td>'+
                                                    '<td>'+grado.materno+'</td>'+
                                                    '<td>'+grado.matricula+'</td>'+
                                                    '<td>'+grado.grado+'</td>'+
                                                    '<td>'+grado.fecha+'</td>'+
                                                    '<td>'+grado.sexo+'</td>'+
                                                    '<td>'+grado.edad+'</td>'+
                                                    '<td>'+grado.zona+'</td>');
                                            });
                                        }
                                    });
                                }
                            };
                            $.each(lugar.Femenino,function(index,edad){
                                if($('#6').is(':checked')){reclutaM += edad.recluta.length;}
                                if($('#7').is(':checked')){cadeteM += edad.cadete.length;}
                                if($('#8').is(':checked')){cadete1M += edad.cadete1.length;}
                                if($('#9').is(':checked')){caboM += edad.cabo.length;}
                                if($('#10').is(':checked')){sargento2M += edad.sargento2.length;}
                                if($('#11').is(':checked')){Sargento1M += edad.Sargento1.length;}
                                if($('#12').is(':checked')){subOficialM += edad.subOficial.length;}
                                if($('#13').is(':checked')){Oficial1M += edad.Oficial1.length;}
                                if($('#14').is(':checked')){Oficial2M += edad.Oficial2.length;}
                                if($('#15').is(':checked')){Oficial3M += edad.Oficial3.length;}
                                if($('#16').is(':checked')){Comandante1M += edad.Comandante1.length;}
                                if($('#17').is(':checked')){Comandate2M += edad.Comandate2.length;}
                                if($('#18').is(':checked')){Comandante3M += edad.Comandante3.length;}
                                $.each(edad,function(index,grado){
                                    $.each(grado,function(index,mujer){
                                        if (!$('#3').is(':checked') && !$('#4').is(':checked') && !$('#5').is(':checked')) {
                                            tmujeres++;
                                        }
                                        else{
                                            tmujeres = menorM+juvenilM+mayorM;
                                        }
                                    });
                                });
                            });
                        }
                    };
                });
                $('#spin').addClass('hidden');
                $('#telementos').removeClass('hidden');
                dibujartabla(inicio,fin);
                Morris.Donut({
                element: 'graficasexos',
                data: [
                    {label: "Hombres", value: thombres},
                    {label: "Mujeres", value: tmujeres},
                ],
                backgroundColor: '#F7F7F7',
                labelColor: '#2B2B2B',
                colors: [
                    '#2196F3',
                    '#F50057',
                ],
                });
                Morris.Donut({
                    element: 'graficaedades',
                    data: [
                        {label: "Menor", value: menorM + menor},
                        {label: "Juvenil", value: juvenilM + juvenil},
                        {label: "Mayor", value: mayorM + mayor},
                    ],
                    backgroundColor: '#F7F7F7',
                    labelColor: '#2B2B2B',
                    colors: [
                        '#4CD964',
                        '#FFCC00',
                        '#FF3B30',
                    ],
                });
                Morris.Donut({
                    element: 'graficagrados',
                    data: [
                        {label: 'recluta', value: recluta + reclutaM},
                        {label: 'cadete', value: cadete + cadeteM},
                        {label: 'cadete de 1', value: cadete1 + cadete1M},
                        {label: 'cabo', value: cabo + caboM},
                        {label: 'sargento 2', value: sargento2 + sargento2M},
                        {label: 'Sargento 1', value: Sargento1 + Sargento1M},
                        {label: 'subOficial', value: subOficial + subOficialM},
                        {label: '1 Oficial', value: Oficial1 + Oficial1M},
                        {label: '2 Oficial', value: Oficial2 + Oficial2M},
                        {label: '3 Oficial', value: Oficial3 + Oficial3M},
                        {label: '3 Comandante', value: Comandante1 + Comandante1M},
                        {label: '2 Comandate', value: Comandate2 + Comandate2M},
                        {label: '3 Comandante', value: Comandante3 + Comandante3M},
                    ],
                    backgroundColor: '#F7F7F7',
                    labelColor: '#2B2B2B',
                    colors: [
                        '#4CD964',
                        '#FFCC00',
                        '#FF3B30',
                        '#4CD964',
                        '#FFCC00',
                        '#FF3B30',
                        '#4CD964',
                        '#FFCC00',
                        '#FF3B30',
                        '#4CD964',
                        '#FFCC00',
                        '#FF3B30',
                        '#4CD964',
                    ],
                });
            }, 'json');
        }
    </script>
    {{  HTML::script('js/moment.js'); }}
    {{  HTML::script('js/bootstrap-datetimepicker.js'); }}
    {{  HTML::script('js/bootstrap-datetimepicker.es.js'); }}
@endsection