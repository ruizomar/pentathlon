@extends('layaouts.base')
@section('titulo')
  PDMU
@endsection
@section('head')
  <style>
    .hiddenStepInfo {
      display: none;
    }

    .activeStepInfo {
      display: block !important;
    }

    .setup-content {
      margin-top: 10px;
    }

    .step {
      text-align: center;
    }

    .step .seleccion {
      background-color: #fff;
      border: 1px solid #C0C0C0;
      border-radius: 5px 5px 5px 5px;
      margin-top: 10px;
    }

    .step .seleccion:last-child {
      border: 1px solid #C0C0C0;
      border-radius: 5px 5px 5px 5px;
      margin-top: 10px;
    }

    .step .seleccion:first-child {
      border-radius: 5px 5px 5px 5px;
      margin-top: 10px;
    }

    .step .seleccion:last-child {
      border-radius: 5px 5px 5px 5px;
      margin-top: 10px;
    }

    .step .seleccion:hover {
      color: #F58723;
      cursor: pointer;
    }

    .setup-content {
      background-color: #f2f2f2;
    }

    .step .activestep {
      color: #F58723;
      border-left: 2px solid #5CB85C !important;
      border-right: 2px solid #5CB85C !important;
      border-top: 2px solid #5CB85C !important;
      border-bottom: 2px solid #5CB85C !important;
      vertical-align: central;
    }

    .step .fa {
      padding-top: 15px;
      font-size: 40px;
    }
    .fecha i{
      right: 60px !important;
  }
  </style>
  {{  HTML::script('js/fileinput.js')}}
  {{  HTML::script('js/tour/bootstrap-tour.min.js')}}
  {{  HTML::style('css/tour/bootstrap-tour.min.css')}}
  {{  HTML::style('css/fileinput.css')}}
  {{  HTML::script('js/tables/jquery.dataTables.min.js')}}
  {{  HTML::style('css/jquery.dataTables.css')}}
  {{  HTML::style('css/bootstrap-datetimepicker.min.css');  }}
@endsection
@section('contenido')
  <form id="buscarelemento" role="form" method="POST" action="buscar">
    {{ Form::button('<i class="fa fa-question"></i>',array('id' => 'tour','class' => 'pull-right btn btn-warning btn-xs')) }}
    <div class="col-md-10">
      <div class="col-md-3 form-group">
        {{ Form::label('nombre', 'Nombre (s)',array('class' => 'control-label')) }}
        {{ Form::text('nombre', null, array('class' => 'form-control','autofocus')) }}
      </div>
      <div class="col-md-3 form-group">
        {{ Form::label('paterno', 'Apellido paterno') }}
        {{ Form::text('paterno', null, array('class' => 'form-control')) }}
      </div>
      <div class="col-md-3 form-group">
        {{ Form::label('materno', 'Apellido materno') }}
        {{ Form::text('materno', null, array('class' => 'form-control')) }}
      </div>
      <div class="col-md-2">
        {{ Form::submit('Buscar', array('id' => 'busqueda','class' => 'btn btn-primary')) }}
      </div>
    </div>
  </form>
  <div id="error" class="col-md-12 hidden" style="margin-top:10px;">
      <p class="alert alert-danger"><i class="fa fa-exclamation-triangle fa-lg"></i> No se encontró al elemento<strong><a id="buscarmas" style="color:#a94442;" class="pull-right" href="#">¿Usar otro método de búsqueda?</a></strong></p>
  </div>
  <div id="extendida" class="col-md-12 hidden">
    <div id="listalugares" class="col-md-offset-4 col-md-4">
      {{ Form::select('lugar',array(null),null,array('id' => 'lugares','class' => 'form-control col-md-2')) }}
      {{ Form::button('<i class="fa fa-eye"></i> Buscar',array('class' => 'pull-right btn btn-info col-md-4','id' => 'buscarext')) }}
    </div>
    <table id="telementos" class="hidden col-md-12 table table-hover" cellspacing="0" width="100%">
      <thead>
        <tr class="tour-3">
          <th class="tour-5">Nombre</th>
          <th class="tour-6">Paterno</th>
          <th class="tour-7">Materno</th>
          <th class="tour-8">Matricula</th>
          <th class="hidden">elemento_id</th>
        </tr>
      </thead>
      <tbody id="elementobody">
      </tbody>
    </table>
  </div>
  <i class="fa fa-spinner fa-2x fa-spin hidden spin-form"></i>
  <form id="buscarelemento" role="form" method="POST" action="update">
    <div id="elemento" class="col-mds-12 tabla hidden">
    <div class="col-md-10">
      <div class="col-md-2 step">
        <div id="div1" class="tour-1 seleccion activestep" onclick="javascript: resetActive(event, 33, 'step-1');">
          <span class="fa fa-user"></span>
          <p>Básicos</p>
        </div>
        <div class="tour-2 seleccion" onclick="javascript: resetActive(event, 66, 'step-2');">
          <span class="fa fa-pencil"></span>
          <p>Datos</p>
        </div>
        <div class="tour-3 seleccion" onclick="javascript: resetActive(event, 100, 'step-3');">
          <span class="fa fa-plus-square"></span>
          <p>Contacto/Tutor</p>
        </div>
      </div>
      <div class="col-md-10 row setup-content activeStepInfo" id="step-1">
        <div class="row">
          <div class="col-md-4 form-group">
            {{ Form::label('reclunombre', 'Nombre (s)',array('class' => 'control-label')) }}
            {{ Form::text('reclunombre', null, array('placeholder' => 'introduce nombre','class' => 'form-control')) }}
            {{ Form::text('persona_id', null, array('placeholder' => 'id','class' => 'hidden form-control')) }}
          </div>
          <div class="col-md-3 form-group">
            {{ Form::label('reclupaterno', 'Apellido paterno') }}
            {{ Form::text('reclupaterno', null, array('placeholder' => 'introduce apellido paterno','class' => 'form-control')) }}
          </div>
          <div class="col-md-3 form-group">
            {{ Form::label('reclumaterno', 'Apellido materno') }}
            {{ Form::text('reclumaterno', null, array('placeholder' => 'introduce apellido materno','class' => 'form-control')) }}
          </div>
          <div class="col-md-2 form-group">
            {{ Form::label('reclusexo', 'Sexo') }}
            {{Form::select('reclusexo', array('Masculino' => 'Masculino','Femenino' => 'Femenino',),null,array('class' => 'form-control')) }}
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 form-group fecha">
            {{ Form::label('birthday', 'Fecha nacimiento') }}
            <div class="input-group date" id="datetimePicker">
                {{ Form::text('birthday', null, array('class' => 'form-control', 'placeholder' => 'YYYY-MM-DD', 'data-date-format' => 'YYYY-MM-DD')) }}
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
          </div>
          <div class="col-md-5 form-group">
            {{ Form::label('domicilio', 'Calle y número') }}
            {{ Form::text('domicilio', null, array('placeholder' => 'Wallaby Way 42','class' => 'form-control')) }}
          </div>
          <div class="col-md-3 form-group">
            {{ Form::label('colonia', 'Colonia') }}
            {{ Form::text('colonia', null, array('placeholder' => 'Sydney','class' => 'form-control')) }}
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 form-group">
            {{ Form::label('municipio', 'Municipio') }}
            {{ Form::text('municipio', null, array('placeholder' => 'introduce municipio','class' => 'form-control')) }}
          </div>
          <div class="col-md-2 form-group">
            {{ Form::label('estado', 'Estado') }}
            {{Form::select('estado', array('Oaxaca' => 'Oaxaca',),null,array('placeholder' => '','class' => 'form-control')) }}
          </div>
          <div class="col-md-2 form-group">
            {{ Form::label('postal', 'C. P.',array('class' => 'control-label')) }}
            {{ Form::text('postal', null, array('placeholder' => '00000','class' => 'form-control')) }}
          </div>
          <div class="col-md-4 form-group">
            {{ Form::label('lugnac', 'Lugar nacimiento') }}
            {{ Form::text('lugnac', null, array('placeholder' => 'introduce lugar nacimiento','class' => 'form-control')) }}
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 form-group">
            {{ Form::label('curp', 'CURP') }}
            {{ Form::text('curp', null, array('placeholder' => '','class' => 'form-control')) }}
          </div>
          <div class="col-md-4 form-group">
            {{ Form::label('email', 'e-mail') }}
            {{ Form::email('email', null, array('placeholder' => 'ejemplo@ejemplo.com','class' => 'form-control')) }}
          </div>
          <div class="col-md-4 form-group">
            {{ Form::label('reclutelefonofijo', 'Teléfono casa') }}
            {{ Form::text('reclutelefonofijo', null, array('placeholder' => '','class' => 'form-control')) }}
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 form-group">
            {{ Form::label('reclutelefonomovil', 'Teléfono móvil') }}
            {{ Form::text('reclutelefonomovil', null, array('placeholder' => '','class' => 'form-control')) }}
          </div>
          <div id="fbtw" style="display: none;">
            <div class="col-md-4 form-group">
              {{ Form::label('reclufacebook', 'Facebook') }}
              {{ Form::text('reclufacebook', null, array('placeholder' => 'facebook.com/','class' => 'form-control')) }}
            </div>
            <div class="col-md-4 form-group">
              {{ Form::label('reclutwitter', 'Twitter') }}
              {{ Form::text('reclutwitter', null, array('placeholder' => '@usuario','class' => 'form-control')) }}
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <button type="button" class="hidden btn btn-success btn-sm" data-toggle="#reclusociales">
            Redes sociales
          </button>
          {{Form::button('<i class="fa fa-plus"></i> Redes Sociales',array('class' => 'btn btn-success btn-xs','id' => 'redes'))}}
        </div>
      </div>
      <div class="col-md-10 row setup-content hiddenStepInfo" id="step-2">
        <div class="row">
          <div class="col-md-2 form-group">
            {{ Form::label('estatura', 'Estatura') }}
            {{ Form::text('estatura', null, array('placeholder' => 'cm','class' => 'form-control')) }}
          </div>
          <div class="col-md-2 form-group">
            {{ Form::label('peso', 'peso') }}
            {{ Form::text('peso', null, array('placeholder' => 'kg','class' => 'form-control')) }}
          </div>
          <div class="col-md-2 form-group">
          {{Form::label('tiposangre', 'Tipo Sangre') }}
          {{Form::select('tiposangre', array('Apositivo' => 'A+','Anegativo' => 'A-','Bpositivo' => 'B+','Bnegativo' => 'B-','ABpositivo' => 'AB+','ABnegativo' => 'AB-','Opositivo' => 'O+','Onegativo' => 'O-',),null,array('placeholder' => '','class' => 'form-control')) }}
          </div>
          <div class="col-md-3 form-group">
            {{ Form::label('ocupacion', 'Ocupación') }}
            {{ Form::text('ocupacion', null, array('placeholder' => '','class' => 'form-control')) }}
          </div>
          <div class="col-md-3 form-group">
            {{ Form::label('estadocivil', 'Estado Civil') }}
            {{ Form::text('estadocivil', null, array('placeholder' => '','class' => 'form-control')) }}
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 form-group">
            {{ Form::label('escolaridad', 'Escolaridad') }}
            {{Form::select('escolaridad', array('primaria' => 'primaria','secundaria' => 'secundaria','bachillerato' => 'bachillerato','universidad' => 'universidad','licenciatura' => 'licenciatura','maestria' => 'maestria','doctorado' => 'doctorado',),null,array('placeholder' => '','class' => 'form-control')) }}
          </div>
          <div class="col-md-5 form-group">
            {{ Form::label('escuela', 'Escuela') }}
            {{ Form::text('escuela', null, array('placeholder' => 'Nombre de la escuela','class' => 'form-control')) }}
          </div>
          <div class="col-md-4 form-group">
            {{ Form::label('alergia', 'Alergias') }}
            {{ Form::text('alergia', null, array('placeholder' => '','class' => 'form-control')) }}
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 form-group">
            {{ Form::label('vicios', 'Vicios') }}
            {{ Form::text('vicios', null, array('placeholder' => '','class' => 'form-control')) }}
          </div>
          <div class="col-md-3 form-group">
            {{ Form::label('arma', 'Arma') }} <br>
            {{ Form::select('arma', $armas,null,array('class' => 'form-control')) }}
          </div>
          <div class="col-md-3 form-group">
            {{ Form::label('cuerpo', 'Cuerpo') }} <br>
            {{Form::select('cuerpo',$cuerpos,null,array('placeholder' => '','class' => 'form-control')) }}
          </div>
          <div class="col-md-3 form-group">
            {{ Form::label('compania', 'Compañia - Subzona') }} <br>
            {{Form::select('compania',$companiasysubzonas,null,array('placeholder' => '','class' => 'form-control')) }}
            {{ Form::label('msginstructor','El elemento es instructor',array('id' => 'msginstructor' ,'class' => 'hidden label label-danger')) }}
          </div>
        </div>
      </div>
      <div class="col-md-10 row setup-content hiddenStepInfo" id="step-3">
        <div class="row">
          <div class="col-md-4 form-group">
            {{ Form::label('contactonombre', 'Nombre (s)') }}
            {{ Form::text('contactonombre', null, array('class' => 'form-control mayuscula')) }}
          </div>
          <div class="col-md-4 form-group">
            {{ Form::label('contactopaterno', 'Apellido paterno') }}
            {{ Form::text('contactopaterno', null, array('class' => 'form-control mayuscula')) }}
          </div>
          <div class="col-md-4 form-group">
            {{ Form::label('contactomaterno', 'Apellido materno') }}
            {{ Form::text('contactomaterno', null, array('class' => 'form-control mayuscula')) }}
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 form-group">
            {{ Form::label('email', 'e-mail') }}
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
              {{ Form::email('contactoemail', null, array('placeholder' => 'ejemplo@ejemplo.com','class' => 'form-control')) }}
            </div>
          </div>
          <div class="col-md-3 form-group">
            {{ Form::label('contactotelefonofijo', 'Teléfono de casa') }}
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-phone"></i></div>
              {{ Form::text('contactotelefonofijo', null, array('placeholder' => '9511234567','class' => 'form-control')) }}
            </div>
          </div>
          <div class="col-md-3 form-group">
            {{ Form::label('contactotelefonomovil', 'Teléfono de movil') }}
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-mobile"></i></div>
              {{ Form::text('contactotelefonomovil', null, array('placeholder' => '9511234567','class' => 'form-control')) }}
            </div>
          </div>
          <div class="col-md-2 form-group">
            {{ Form::label('contactosexo', 'Sexo') }}
            {{Form::select('contactosexo', array('Masculino' => 'Masculino','Femenino' => 'Femenino',),null,array('placeholder' => '','class' => 'form-control')) }}
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 form-group">
            {{ Form::label('contactorelacion', 'Relación con el recluta') }}
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-link"></i></div>
              {{ Form::text('contactorelacion', null, array('placeholder' => 'padre, madre, hermano, etc.','class' => 'form-control mayuscula')) }}
            </div>
          </div>
          <div class="col-md-2">
            <br><br>
            {{Form::button('<i class="fa fa-plus"></i> Redes Sociales',array('class' => 'btn btn-success btn-xs','id' => 'contactoredes'))}}
          </div>
          <div id="contactofbtw" style="display: none;">
            <div class="col-md-4 form-group">
              {{ Form::label('contactofacebook', 'Facebook') }}
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-facebook"></i></div>
                {{ Form::text('contactofacebook', null, array('placeholder' => 'facebook.com/','class' => 'form-control')) }}
              </div>
            </div>
            <div class="col-md-4 form-group">
              {{ Form::label('contactotwitter', 'Twitter') }}
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-twitter"></i></div>
                {{ Form::text('contactotwitter', null, array('placeholder' => '@usuario','class' => 'form-control')) }}
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          {{ Form::button('<i class="fa fa-floppy-o"></i> Guardar',array('class' => 'btn-sm pull-right btn btn-info btn-lg','type' => 'submit')) }}
        </div>
      </div>
    </div>
    <div class="col-md-2">
          {{ Form::image('imgs/fotos/default.png','fotoperfil',array('class' => 'img-responsive img-circle','alt' => 'Responsive image')) }}
          {{ Form::file('fotoperfil',array('id' => 'filefoto')) }}
    </div>
  </form>
    <!-- {{form::close()}} -->
  </div>
    <div class="modal fade bs-example-modal-lg" id="Elementos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="Elementos">
                        <i class="fa fa-eye"></i> Elementos
                    </h4>
                </div>
                <div class="modal-body">
                    <table id="elementos" class="table">
                        <thead>
                            <tr>
                            <th>Matricula</th>
                            <th>Nombre(s)</th>
                            <th>Apellido paterno</th>
                            <th>Apellido materno</th>
                            <th>Fecha de nacimiento</th>
                            <th></th>
                            </tr>
                        </thead>
                    <tbody>
                    </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
  <!-- Para Bootstrap Validator -->
  <script>
    $("#filefoto").fileinput({
      showUpload: false,
      showCaption: false,
      showRemove : false,
      fileType: "any"
    });
    $(document).ready(function() {
      $('#datetimePicker').datetimepicker({
        language: 'es',
        pickTime: false
      });
      $("#test-upload").fileinput({
        'showPreview' : true,
        'allowedFileExtensions' : ['jpg', 'png','gif'],
        'elErrorContainer': '#errorBlock'
      });
      $('#buscarelemento').bootstrapValidator({
          // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
          feedbackIcons: {
              valid: 'glyphicon glyphicon-ok',
              invalid: 'glyphicon glyphicon-remove',
              validating: 'glyphicon glyphicon-refresh'
          },
          fields: {
              nombre: {
              validators: {
                      notEmpty: {}
                  }
              },
              paterno: {
                  validators: {
                      notEmpty: {}
                  }
              }
          }
      })
      $('#elemento').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
          nombre: {
            validators: {
              notEmpty: {},
            }
          },
          reclunombre: {
            validators: {
              notEmpty: {},
            }
          },
          postal:{
            validators: {
              integer: {},
              stringLength:{
                min: 5,
                max: 5,
                message: 'El Código Postal es de 5 dígitos'
              }
            }
          },
          curp:{
            validators:{
              stringLength: {
                min: 18,
                max:18,
                message:'La CURP esta formada por 18 caracteres'
              },
              notEmpty:{}
            }
          },
          paterno: {
            validators: {
              notEmpty: {}
            }
          },
          reclupaterno: {
            validators: {
              notEmpty: {}
            }
          },
          email: {
            validators: {
              emailAddress: {}
            }
          },
          birthday: {
            validators: {
              notEmpty: {},
            }
          },
          telefono: {
            validators: {
              notEmpty: {},
              integer:{
                message:'introduce solo números para el teléfono'
              }
            }
          },
          estatura:{
            validators:{
              notEmpty: {},
              integer:{},
              between:{
                min: 100,
                max: 300,
                message: 'Establece una altura mínima a 100 cm'
              }
            }
          },
          peso:{
            validators:{
              notEmpty:{},
              integer:{},
            }
          },
          contactonombre:{
            validators:{
              notEmpty:{},
            }
          },
          contactopaterno:{
            validators:{
              notEmpty:{},
            }
          },
          contactorelacion:{
            validators:{
              notEmpty:{},
            }
          }
        }
      })
      $('#bnext1').click(function(){
        $('#parte1').toggle(100);
        $('#parte2').toggle(200);

      })
      $('#bback1').click(function(){
        $('#parte1').toggle(100);
        $('#parte2').toggle(200);

      })
      $('#redes').click(function(){
        $('#fbtw').toggle(80);
      })
      $('#contactoredes').click(function(){
        $('#contactofbtw').toggle(80);
      })
      .find('button[data-toggle]')
      .on('click', function() {
          var $target = $($(this).attr('data-toggle'));
          $target.toggle();
          if (!$target.is(':visible')) {
              $('#togglingForm').data('bootstrapValidator').disableSubmitButtons(false);
          }
      });
    });
  </script>
  <script type="text/javascript">
    function resetActive(event, percent, step) {
      $("div").each(function () {
      if ($(this).hasClass("activestep")) {
      $(this).removeClass("activestep");
      }
      });

      if (event.target.className == "seleccion") {
      $(event.target).addClass("activestep");
      }
      else {
      $(event.target.parentNode).addClass("activestep");
      }

      hideSteps();
      showCurrentStepInfo(step);
    }

    function hideSteps() {
      $("div").each(function () {
      if ($(this).hasClass("activeStepInfo")) {
      $(this).removeClass("activeStepInfo");
      $(this).addClass("hiddenStepInfo");
      }
      });
    }

    function showCurrentStepInfo(step) {
      var id = "#" + step;
      $(id).addClass("activeStepInfo");
    }
  </script>
  <script>
    $('#tour').on('click', function(e) {
      var tour = new Tour({
        steps: [
          {
            element: '.tour-1',
            title: 'Datos básicos del elementos',
            content: 'Ingresa la información del elemento',
          },
          {
            element: '.tour-2',
            title: 'Datos del elemento',
            content: 'Dá click aquí para mostrar el formulario',
          },
          {
            element: '.tour-3',
            title: 'Datos de contacto',
            content: 'Dá click aquí para mostrar el formulario',
          },
        ],
        backdrop: true,
        storage: false,
      });
      tour.init();
      tour.start();
    });
  </script>
  <script>
    $('#buscarmas').click( function(e) {
      e.preventDefault();
      $('#extendida').removeClass('hidden');
      $('#error').addClass('hidden');
      $.get('lugares', function(json) {
        $('#lugares').html('');
        $.each(json,function(index,lugar){
          $('#lugares').append('<option value="'+lugar.id+'">'+lugar.nombre+'</option>');
        });
      }, 'json');
    });
    $('#Editar,#2Editar').addClass('active');
  </script>
  <script>
    $('#buscarext').click(function(){
      $('#extendida').removeClass('hidden');
      id = $('#lugares').val();
      $('#telementos').removeClass('hidden');
      $('#elementobody').html('');
      $.post('extendidos',{id:id}, function(json) {
        $.each(json,function(index,elementos){
          $('#elementobody').append('<tr class="info" onclick="eliminar(\''+elementos.nombre+'\', \''+elementos.paterno+'\', \''+elementos.materno+'\')">'+
            '<td>'+elementos.nombre+'</td>'+
            '<td>'+elementos.paterno+'</td>'+
            '<td>'+elementos.materno+'</td>'+
            '<td>'+elementos.matricula+'</td></tr>');
        });
      }, 'json');
    });
    function eliminar(nombre,paterno,materno) {
      $('[name=nombre]').val(nombre);
      $('[name=paterno]').val(paterno);
      $('[name=materno]').val(materno);
      $('#busqueda').removeAttr("disabled").trigger("click");
      $('#telementos').addClass('hidden');
      $('#extendida').addClass('hidden');
    };
  </script>
  <script>
    $('#compania').focus(function(){
      compania = $('[name=compania]').val();
      persona_id = $('[name=persona_id]').val();
      $.post('cargos',{compania:compania,persona_id:persona_id}, function(json) {
        console.log(json);
        if (json.success){
          $('[name=compania]').text('');
          $('[name=compania]').append('<option value="'+json.companiasysubzona_id+'">'+json.compania+'</option>');
          $('#msginstructor').removeClass('hidden');
        }
      }, 'json');
    });
  </script>
  {{  HTML::script('js/bootstrapValidator.js'); }}
  {{  HTML::script('js/es_ES.js'); }}
  {{  HTML::script('js/mio.js'); }}
  {{  HTML::script('js/moment.js'); }}
  {{  HTML::script('js/bootstrap-datetimepicker.js'); }}
  {{  HTML::script('js/bootstrap-datetimepicker.es.js'); }}
@endsection