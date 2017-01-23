<!DOCTYPE html>
<html>
  <head>
    <title>Inicio</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
      {{  HTML::style('css/login.css')  }}
      {{  HTML::style('css/bootstrap.css');  }}
  </head>
  <body>
    <div class="main">
      <div class="login-form text-center">
          <img src="{{ asset('imgs/penta.png') }}" class="img-responsive col-sm-6 col-sm-offset-3" alt="Responsive image" style="margin-top:1em; margin-bottom:1em;">
          <form action="reunion" method="get" accept-charset="UTF-8" role="form">
            <p>¡Bienvenido!</p>
            <p>Reunión Nacional de Comandantes, Estados Mayores y Directoras</p>
              <div class="submit">
                <input type="submit" value="Registrarse">
                <!-- <a href="{{ URL::to('logout'); }}"><i class="fa fa-sign-out"></i> Logout</a> -->
            </div>
          </form>
        </div>
      </div>
  </body>
</html>