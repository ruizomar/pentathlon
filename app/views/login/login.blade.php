<!DOCTYPE html>
<html>
  <head>
    <title>Inicio</title>
      <meta charset="utf-8">
      {{HTML::style('css/login.css')}}
      {{  HTML::style('css/bootstrap.css');  }}
  </head>
  <body>
    <div class="main">
      <div class="login-form">
        <div class="col-md-5" style="margin-top:1em; margin-bottom:1em;">
          <img src="imgs/penta.png" class="img-responsive" alt="Responsive image">
        </div>
          <form>
              <input type="text" class="text" value="Usuario" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'USERNAME';}" >
              <input type="password" value="Contraseña" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
              <div class="submit">
                <input type="submit" onclick="myFunction()" value="Entrar" >
            </div>
              <a href="#">¿Contraseña Olvidada?</a>
          </form>
        </div>
      </div>
  </body>
</html>