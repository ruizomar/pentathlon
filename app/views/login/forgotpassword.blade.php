<!DOCTYPE html>
<html>
  <head>
    <title>Restablecer contraseña</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
      {{  HTML::style('css/login.css')  }}
      {{  HTML::style('css/bootstrap.css');  }}
  </head>
  <body>
    <div class="main">
      <div class="login-form text-center">
          <img src="{{ asset('imgs/penta.png') }}" class="img-responsive col-sm-6 col-sm-offset-3" alt="Responsive image" style="margin-top:1em; margin-bottom:1em;">
          {{ Form::open(array('url' => 'forgot','role' => 'form','id' => 'forgot','class' => 'class')) }}
            <div class="form-group">
              <input type="text" class="text" placeholder="Matricula" onfocus="this.value = '';"  name="username" autocomplete="off">
            </div>
            <?php $status=Session::get('mensaje_error'); ?> 
          @if (!is_null($status))
            <p style='color:#FB1D1D' >{{$status}}</p>
          @else
            <p>Introduzca su matricula continuar.</p>
          @endif
              <div class="submit">
                <input type="submit" value="Recuperar" >
            </div>
          {{ Form::close() }}
        </div>
      </div>
  </body>
{{  HTML::script('js/jquery-1.11.1.js'); }}
{{  HTML::script('js/bootstrapValidator.js'); }}
{{  HTML::script('js/es_ES.js'); }}
<script type="text/javascript">
$(document).ready(function() {
    $('#forgot').bootstrapValidator({
        fields: {
            username: {
                validators: {
                    notEmpty: {
                    },
                    integer: {message: 'Intriduce una Matricula valida'
                    },
                    stringLength:{
                      max: 15,
                    }
                }
            }
        }
    });
});
</script>
</html>