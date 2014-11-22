<!DOCTYPE html>
<html>
  <head>
    <title>Inicio</title>
      <meta charset="utf-8">
      {{  HTML::style('css/login.css')  }}
      {{  HTML::style('css/bootstrap.css');  }}
  </head>
  <body>
    <div class="main">
      <div class="login-form text-center">
        <h2 >Revisa tu correo electrónico</h2>

        <p>
        Hemos enviado un correo electrónico a {{$email}}. Haz clic en el enlace del correo electrónico para restablecer tu contraseña.
        </p>
        <p>
        Si no ves el correo electrónico, revisa otros lugares donde podría estar, como tus carpetas de correo no deseado, sociales u otras.
        </p>
      </div>
    </div>

  </body>
</html>