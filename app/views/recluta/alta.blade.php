@extends('layaouts.base')
@section('titulo')
	Registro
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

	.progress {
		position: relative;
		height: 5px;
		margin-top: 10px;
	}

	.progress > .progress-type {
		padding: 3px 30px 2px 10px;
		color: rgb(255, 255, 255);
		background-color: rgba(25, 25, 25, 0.2);
	}

	.progress > .progress-completed {
		position: absolute;
		right: 0px;
		font-weight: 800;
		padding: 3px 10px 2px;
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
	{{  HTML::script('js/fileinput.js'); }}
  	{{  HTML::style('css/fileinput.css');  }}
  	{{  HTML::style('css/bootstrap-datetimepicker.min.css');  }}
@endsection
@section('contenido')
	{{ Form::open(array('id' => 'formularioalta','url'=>'recluta/alta','files'=>true)) }}
		<div class="col-md-2 step">
			<div id="div1" class="seleccion activestep" onclick="javascript: resetActive(event, 33, 'step-1');">
				<span class="fa fa-user"></span>
				<p>Básicos</p>
			</div>
			<div class="seleccion" onclick="javascript: resetActive(event, 66, 'step-2');">
				<span class="fa fa-pencil"></span>
				<p>Datos de elemento</p>
			</div>
			<div class="seleccion" onclick="javascript: resetActive(event, 100, 'step-3');">
				<span class="fa fa-plus-square"></span>
				<p>Contacto/Tutor</p>
			</div>
		</div>
		<div class="col-md-10">
			<div class="setup-content activeStepInfo" id="step-1">
				<div class="col-md-12">
					<div class="col-md-4 form-group">
						{{ Form::label('reclunombre', 'Nombre (s)',array('class' => 'control-label')) }}
						{{ Form::text('reclunombre', null, array('class' => 'form-control mayuscula','autofocus')) }}
					</div>
					<div class="col-md-4 form-group">
						{{ Form::label('reclupaterno', 'Apellido paterno') }}
						{{ Form::text('reclupaterno', null, array('class' => 'form-control mayuscula')) }}
					</div>
					<div class="col-md-4 form-group">
						{{ Form::label('reclumaterno', 'Apellido materno') }}
						{{ Form::text('reclumaterno', null, array('class' => 'form-control mayuscula')) }}
					</div>
					<div class="col-md-2 form-group">
						{{ Form::label('reclusexo', 'Sexo') }}
						{{Form::select('reclusexo', array('Hombre' => 'Hombre','Mujer' => 'Mujer',),null,array('placeholder' => '','class' => 'form-control')) }}
					</div>
					<div class="col-md-3 form-group fecha">
						{{ Form::label('birthday', 'Fecha nacimiento') }}
						<div class="input-group date" id="datetimePicker">
                            {{ Form::text('birthday', null, array('class' => 'form-control', 'placeholder' => 'YYYY-MM-DD', 'data-date-format' => 'YYYY-MM-DD')) }}
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
					</div>
					<div class="col-md-4 form-group">
						{{ Form::label('domicilio', 'Calle y número') }}
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-home"></i></div>
							{{ Form::text('domicilio', null, array('class' => 'form-control mayuscula')) }}
						</div>
					</div>
					<div class="col-md-3 form-group">
						{{ Form::label('colonia', 'Colonia') }}
						{{ Form::text('colonia', null, array('class' => 'form-control mayuscula')) }}
					</div>
					<div class="col-md-4 form-group">
						{{ Form::label('municipio', 'Municipio') }}
						{{ Form::text('municipio', null, array('class' => 'form-control mayuscula')) }}
					</div>
					<div class="col-md-2 form-group">
						{{ Form::label('estado', 'Estado') }}
						{{Form::select('estado', array('Oaxaca' => 'Oaxaca',),null,array('class' => 'form-control')) }}
					</div>
					<div class="col-md-2 form-group">
						{{ Form::label('postal', 'C. P.',array('class' => 'control-label')) }}
						{{ Form::text('postal', null, array('placeholder' => '00000','class' => 'form-control')) }}
					</div>
					<div class="col-md-4 form-group">
						{{ Form::label('lugnac', 'Lugar nacimiento') }}
						{{ Form::text('lugnac', null, array('class' => 'form-control mayuscula')) }}
					</div>
					<div id="idcurp" class="col-md-4 form-group">
						{{ Form::label('curp', 'CURP') }}
						{{ Form::text('curp', null, array('id' => 'curp','class' => 'form-control mayuscula')) }}
					</div>
					<div class="col-md-4 form-group">
						{{ Form::label('email', 'e-mail') }}
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
							{{ Form::email('recluemail', null, array('placeholder' => 'ejemplo@ejemplo.com','class' => 'form-control')) }}
						</div>
					</div>
					<div class="col-md-4 form-group">
						{{ Form::label('reclutelefonofijo', 'Teléfono casa') }}
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-phone"></i></div>
							{{ Form::text('reclutelefonofijo', null, array('placeholder' => '9511234567','class' => 'form-control')) }}
						</div>
					</div>
					<div class="col-md-4 form-group">
						{{ Form::label('reclutelefonomovil', 'Teléfono móvil') }}
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-mobile"></i></div>
							{{ Form::text('reclutelefonomovil', null, array('placeholder' => '9511234567','class' => 'form-control')) }}
						</div>
					</div>
					<div class="col-md-3">
					<br><br>
						{{Form::button('<i class="fa fa-plus"></i> Redes Sociales',array('class' => 'btn btn-success btn-xs','id' => 'recluredes'))}}
					</div>
					<div class="col-md-12" id="fbtw" style="display: none;">
						<div class="col-md-4 form-group">
							{{ Form::label('reclufacebook', 'Facebook') }}
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-facebook"></i></div>
								{{ Form::text('reclufacebook', null, array('placeholder' => 'facebook.com/','class' => 'form-control')) }}
							</div>
						</div>

						<div class="col-md-4 form-group">
							{{ Form::label('reclutwitter', 'Twitter') }}
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-twitter"></i></div>
								{{ Form::text('reclutwitter', null, array('placeholder' => '@usuario','class' => 'form-control')) }}
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row setup-content hiddenStepInfo" id="step-2">
				<div class="col-md-12">
					<div class="col-md-3 form-group">
						{{ Form::label('estatura', 'Estatura') }}
						<div class="input-group">
							<div class="input-group-addon">cm:</div>
							{{ Form::text('estatura', null, array('class' => 'form-control')) }}
						</div>
					</div>
					<div class="col-md-3 form-group">
						{{ Form::label('peso', 'Peso') }}
						<div class="input-group">
							<div class="input-group-addon">kg:</div>
							{{ Form::text('peso', null, array('class' => 'form-control')) }}
						</div>
					</div>
					<div class="col-md-2 form-group">
						{{Form::label('tiposangre', 'Tipo Sangre') }}
						{{Form::select('tiposangre', array('Opositivo' => 'O+','Onegativo' => 'O-','Apositivo' => 'A+','Anegativo' => 'A-','Bpositivo' => 'B+','Bnegativo' => 'B-','ABpositivo' => 'AB+','ABnegativo' => 'AB-',),null,array('placeholder' => '','class' => 'form-control')) }}
					</div>
					<div class="col-md-2 form-group">
						{{ Form::label('ocupacion', 'Ocupación') }}
						{{ Form::text('ocupacion', null, array('class' => 'form-control mayuscula')) }}
					</div>
					<div class="col-md-2 form-group">
						{{ Form::label('estadocivil', 'Estado Civil') }}
						{{ Form::text('estadocivil', null, array('class' => 'form-control mayuscula')) }}
					</div>
					<div class="col-md-2 form-group">
						{{ Form::label('escolaridad', 'Escolaridad') }}
						{{Form::select('escolaridad', array('primaria' => 'primaria','secundaria' => 'secundaria','bachillerato' => 'bachillerato','universidad' => 'universidad','licenciatura' => 'licenciatura','maestria' => 'maestria','doctorado' => 'doctorado',),null,array('placeholder' => '','class' => 'form-control')) }}
					</div>
					<div class="col-md-4 form-group">
						{{ Form::label('escuela', 'Escuela') }}
						{{ Form::text('escuela', null, array('class' => 'form-control mayuscula')) }}
					</div>
					<div class="col-md-3 form-group">
						{{ Form::label('alergia', 'Alergias') }}
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-ambulance"></i></div>
							{{ Form::text('alergia', null, array('class' => 'form-control mayuscula')) }}
						</div>
					</div>
					<div class="col-md-3 form-group">
						{{ Form::label('vicios', 'Vicios') }}
						{{ Form::text('vicios', null, array('class' => 'form-control mayuscula')) }}
					</div>
					<div class="col-md-2 form-group">
						{{ Form::label('arma', 'Arma') }} <br>
						{{ Form::select('arma', $armas,null,array('class' => 'form-control')) }}
					</div>
					<div class="col-md-2 form-group">
						{{ Form::label('cuerpo', 'Cuerpo') }} <br>
						{{Form::select('cuerpo',$cuerpos,null,array('placeholder' => '','class' => 'form-control')) }}
					</div>
					<div class="col-md-3 form-group">
						{{ Form::label('compania', 'Compañia - Subzona') }} <br>
						{{Form::select('compania',$companiasysubzonas,null,array('placeholder' => '','class' => 'form-control')) }}
					</div>
					<div class="col-md-4 form-group">
						{{ Form::file('fotoperfil',array('id' => 'filefoto')) }}
					</div>
				</div>
			</div>
			<div class="row setup-content hiddenStepInfo" id="step-3">
				<div class="col-md-12 ">
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
						{{Form::select('contactosexo', array('Hombre' => 'Hombre','Mujer' => 'Mujer',),null,array('placeholder' => '','class' => 'form-control')) }}
					</div>
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
					{{ Form::button('<i class="fa fa-floppy-o"></i> Guardar',array('id' => 'btnenviar','class' => 'btn-sm pull-right btn btn-info btn-lg','type' => 'submit')) }}
				</div>
			</div>
		</div>
	{{Form::close()}}
@endsection
@section('scripts')
	<script>
	$( "#curp" ).focusout(function() {
		var curp = $(this).val();
		$.post('curp',{curp:curp}, function(json) {
			if (!json.success) {
				console.log(json);
				$('#curperror').removeClass('hidden');
				$('#idcurp').addClass('has-error');
				$('[name=curp]').val('');
				$('#formularioalta').bootstrapValidator('revalidateField','curp');
				$('[name=curp]').focus();
				$('[name=curp]').closest('div').find('small').html(curp+' ya está registrada');

			}
		}, 'json');
	})
	</script>
	<script>
		//$('#curp').popover();
	</script>
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
			//$('#datetimePicker').datetimepicker();
			$('#formularioalta').bootstrapValidator({
		        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
		        feedbackIcons: {
		            valid: 'glyphicon glyphicon-ok',
		            invalid: 'glyphicon glyphicon-remove',
		            validating: 'glyphicon glyphicon-refresh'
		        },
		        fields: {
					fotoperfil:{
						validators: {
							file: {
								extension: 'jpeg,png,jpg,gif',
								type: 'image/jpg,image/jpeg,image/png,image/gif',
								maxSize: 2048 * 1024,   // 2 MB
							}
						}
					},
		            nombre: {
		                validators: {
		                    notEmpty: {}
		                }
		            },
		            reclunombre: {
		                validators: {
		                    notEmpty: {}
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
		            recluemail: {
		                validators: {
		                    emailAddress: {}
		                }
		            },
		            contactoemail: {
		                validators: {
		                    emailAddress: {}
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
		            reclutelefonofijo: {
		                validators: {
		                    integer:{
							},
							stringLength: {
							    min: 7,
							    max:10,
							},
		                }
		            },
		            reclutelefonomovil: {
		                validators: {
		                    integer:{
							},
							stringLength: {
							    min: 7,
							    max:10,
							},
		                }
		            },
		            contactotelefonofijo: {
		                validators: {
		                    integer:{
							},
							stringLength: {
							    min: 7,
							    max:10,
							},
		                }
		            },
		            contactotelefonomovil: {
		                validators: {
		                    integer:{
							},
							stringLength: {
							    min: 7,
							    max:10,
							},
		                }
		            },
		            estatura:{
						validators:{
							notEmpty: {},
							integer:{},
						}
		            },
		            peso:{
						validators:{
							notEmpty:{},
							integer:{}
						}
		            },
		            contactonombre:{
						validators:{
							notEmpty:{}
						}
		            },
		            contactopaterno:{
						validators:{
							notEmpty:{}
						}
		            },
		            contactorelacion:{
						validators:{
							notEmpty:{}
						}
		            }
		        }
			})
			$('#contactoredes').click(function(){
				$('#contactofbtw').toggle(80);
			})

			$('#recluredes').click(function(){
				$('#fbtw').toggle(80);

			})
			$('.mayuscula').focusout(function() {
				$(this).val($(this).val().toUpperCase());
			});
			$('#datetimePicker').on('dp.change dp.show', function(e) {
		        $('#formularioalta').bootstrapValidator('revalidateField', 'birthday');
		    });
		    $('#sidebar-nav').find('li').removeClass('active');
        	$('#Altas').addClass('active');
		});
	</script>
	<script type="text/javascript">
		function resetActive(event, percent, step) {
			//$(".progress-bar").css("width", percent + "%").attr("aria-valuenow", percent);
			//$(".progress-completed").text(percent + "%");

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
{{  HTML::script('js/bootstrapValidator.js'); }}
{{  HTML::script('js/es_ES.js'); }}
{{  HTML::script('js/moment.js'); }}
{{  HTML::script('js/bootstrap-datetimepicker.js'); }}
{{  HTML::script('js/bootstrap-datetimepicker.es.js'); }}
@endsection