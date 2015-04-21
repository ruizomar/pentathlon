<!DOCTYPE html>
<html lang="es">
<head>
    <title>@yield('titulo')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    {{  HTML::style('css/bootstrap.css');  }}
    {{  HTML::style('css/bootstrap-theme.min.css');  }}
    {{  HTML::style('font-awesome/css/font-awesome.css');  }}
    {{  HTML::style('css/theme.css');  }}
    {{  HTML::script('js/jquery-1.11.1.js'); }}
    {{  HTML::script('js/bootstrap.js'); }}
    @yield('head')
  </head>
  <body>
    @yield('login')
<!-- navbar -->
  <div class="navbar navbar-inverse navbar-fixed-top" style="margin-bottom: -20px;  padding-bottom: 40px">
    <div class="navbar-header">
      <a class="navbar-brand" href="{{URL::to('/')}}"><img src="{{asset('imgs/pdmu.png')}}"> PDMU</a>
    </div>
  </div>

<!-- end sidenavbar -->
    <div class="content">
    @yield('contenido')
      <footer>
          <hr>
          <p class="pull-right"><a href="#" target="_blank">Patria, Honor y Fuerza</a></p>
          <p>2014</p>
      </footer>
    </div>
  </body>


  
  @yield('scripts')
</html>
