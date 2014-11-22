<!DOCTYPE html>
<html>
  <head>
    <title>Restablecer contraseña</title>
      <meta charset="utf-8">
      {{  HTML::style('css/login.css')  }}
      {{  HTML::style('css/bootstrap.css');  }}
  </head>
  <body>
    <div class="main">
      <div class="login-form text-center">
          <img src="imgs/penta.png" class="img-responsive col-md-6 col-md-offset-3" alt="Responsive image" style="margin-top:1em; margin-bottom:1em;">
          {{ Form::open(array('url' => 'forgot','role' => 'form','id' => 'id','class' => 'class')) }}
              <input type="text" class="text" placeholder="Usuario" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'USERNAME';}" name="username" autocomplete="off">
              <?php $status=Session::get('mensaje_error'); ?> 
          @if (!is_null($status))
            <p style='color:#FB1D1D' >{{$status}}</p>
          @else
            <p>Introduzca usuario continuar.</p>
          @endif
              <div class="submit">
                <input type="submit" value="Recuperar" >
            </div>
          {{ Form::close() }}
        </div>
      </div>
  </body>
</html>