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
  <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="/inicio"><img src="{{ asset('imgs/pdmu.png') }}" alt=""> PDMU</a>
          </div>
          <div class="hidden-xs">
                  <ul class="nav navbar-nav navbar-right">
                      <li id="fat-menu" class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            @if(Auth::id())
                              {{ Elemento::find(Auth::user()->elemento_id)->persona->nombre." ".Elemento::find(Auth::user()->elemento_id)->persona->apellidopaterno }}
                            @endif  
                              <i class="fa fa-user"></i>
                              <i class="fa fa-caret-down"></i>
                          </a>

                          <ul class="dropdown-menu">
                              <li><a href="{{ URL::to('historial/me'); }}">Mi perfil</a></li>
                              <li class="divider"></li>
                              <li><a class="visible-phone" href="{{ URL::to('settings'); }}"><i class="fa fa-cogs"></i> Settings</a></li>
                              <!-- <li><a class="visible-phone" href="#"><i class="fa fa-clock-o"></i> Historial</a></li> -->
                              <li class="divider"></li>
                              <li><a href="{{ URL::to('logout'); }}"><i class="fa fa-sign-out"></i> Logout</a></li>
                          </ul>
                      </li>
                  </ul>
          </div>
      </div>
  </div>

<div class="navbar-collapse collapse">
  <div id="main-menu">
    <div id="phone-navigation" class="visible-xs">
      <ul id="dashboard-menu" class="nav nav-list">
        @if(!is_null(User::find(Auth::id())->roles()->where('id','=',1)->first()))
          <li id="2Administracion" class=" "><a rel="tooltip" data-placement="right" data-original-title="Icons" href="{{ URL::to('admin'); }}"><i class="fa fa-tachometer"></i> <span class="caption">Administracion</span></a></li>

          <li id="2Armas"><a rel="tooltip" data-placement="right" data-original-title="Tables" href="{{ URL::to('armas'); }}"><i class="fa  fa-crosshairs"></i> <span class="caption">Armas</span></a></li>

          <li id="2Cuerpos"><a rel="tooltip" data-placement="right" data-original-title="Mobile" href="{{ URL::to('cuerpos'); }}"><i class="fa fa-child"></i> <span class="caption">Cuerpos</span></a></li>
        @endif
        @if(!is_null(User::find(Auth::id())->roles()->where('id','=',2)->first()))
          <li id="2Enteros"><a rel="tooltip" data-placement="right" data-original-title="Dashboard" href="{{ URL::to('pagos'); }}"><i class="fa fa-money"></i> <span class="caption">Enteros</span></a></li>
        @endif  
        @if(!is_null(User::find(Auth::id())->roles()->where('id','=',3)->first()))
          <li id="2Condecoraciones"><a rel="tooltip" data-placement="right" data-original-title="UI Features" href="{{ URL::to('condecoraciones'); }}"><i class="fa fa-shield"></i> <span class="caption">Condecoraciones</span></a></li>

          <li id="2Eventos"><a rel="tooltip" data-placement="right" data-original-title="Pricing" href="{{ URL::to('eventos'); }}"><i class="fa fa-calendar-o"></i> <span class="caption">Eventos</span></a></li>

          <li id="2Ascensos"><a rel="tooltip" data-placement="right" data-original-title="Calendar" href="{{ URL::to('ascensos'); }}"><i class="fa fa-line-chart"></i> <span class="caption">Ascensos</span></a></li>
        @endif
        @if(!is_null(User::find(Auth::id())->roles()->where('id','=',4)->first()))
          <li id="2Companias"><a rel="tooltip" data-placement="right" data-original-title="Reports" href="{{ URL::to('companias'); }}"><i class="fa fa-map-marker"></i> <span class="caption">Companias</span></a></li>
          
          <li id="2Cargos"><a rel="tooltip" data-placement="right" data-original-title="Faq" href="{{ URL::to('cargos'); }}"><i class="fa fa-magic"></i> <span class="caption">Cargos</span></a></li>
          
          <li id="2Arrestos"><a rel="tooltip" data-placement="right" data-original-title="Forms" href="{{ URL::to('arrestos'); }}"><i class="fa fa-gavel"></i> <span class="caption">Arrestos</span></a></li>
          
          <li id="2Juras"><a rel="tooltip" data-placement="right" data-original-title="Forms" href="{{ URL::to('jura'); }}"><i class="fa fa-flag"></i> <span class="caption">Juras</span></a></li>
        @endif
        @if(!is_null(User::find(Auth::id())->roles()->where('id','=',8)->first()))
          <li id="2Asistencias"><a rel="tooltip" data-placement="right" data-original-title="Blog" href="{{ URL::to('asistencias'); }}"><i class="fa fa-calendar"></i> <span class="caption">Asistencias</span></a></li>
        @endif
        @if(!is_null(User::find(Auth::id())->roles()->where('id','=',4)->first()) || !is_null(User::find(Auth::id())->roles()->where('id','=',6)->first()))
          <li id="2Asistencias"><a rel="tooltip" data-placement="right" data-original-title="Blog" href="{{ URL::to('asistencias/reporte'); }}"><i class="fa fa-calendar"></i> <span class="caption">Asistencias</span></a></li>
        @endif
        @if(!is_null(User::find(Auth::id())->roles()->where('id','<',8)->first()))
          <li id="2Altas"><a rel="tooltip" data-placement="right" data-original-title="Blog Entry" href="{{ URL::to('recluta/alta'); }}"><i class="fa fa-plus"></i> <span class="caption">Altas</span></a></li>

          <li id="2Editar"><a rel="tooltip" data-placement="right" data-original-title="Help" href="{{ URL::to('recluta/editar'); }}"><i class="fa fa-pencil"></i> <span class="caption">Editar</span></a></li>

          <li id="2Historial" class=" "><a rel="tooltip" data-placement="right" data-original-title="Icons" href="{{ URL::to('historial'); }}"><i class="fa fa-clock-o"></i> <span class="caption">Historial</span></a></li>
        <li id="2Reportes" class=" "><a rel="tooltip" data-placement="right" data-original-title="Icons" href="{{ URL::to('reportes'); }}"><i class="fa fa-bar-chart"></i> <span class="caption">Reportes</span></a></li> 
        @endif

        @if(!is_null(User::find(Auth::id())->roles()->where('id','>',2)->where('id','<',6)->first()))
          <li id="2Examenes"><a rel="tooltip" data-placement="right" data-original-title="Media" href="{{ URL::to('examenes'); }}"><i class="fa  fa-file-text-o"></i> <span class="caption">Exámenes</span></a></li>
        @endif
      </ul>
    </div>
  </div>
</div>

  <div id="sidebar-nav" class="hidden-xs">
      <ul id="dashboard-menu" class="nav nav-list">
        @if(!is_null(User::find(Auth::id())->roles()->where('id','=',1)->first()))
          <li id="2Administracion" class=" "><a rel="tooltip" data-placement="right" data-original-title="Icons" href="www.admin.pentathlonoaxaca.com"><i class="fa fa-tachometer"></i> <span class="caption">Administracion</span></a></li>

          <li id="2Armas"><a rel="tooltip" data-placement="right" data-original-title="Tables" href="{{ URL::to('armas'); }}"><i class="fa  fa-crosshairs"></i> <span class="caption">Armas</span></a></li>

          <li id="2Cuerpos"><a rel="tooltip" data-placement="right" data-original-title="Mobile" href="{{ URL::to('cuerpos'); }}"><i class="fa fa-child"></i> <span class="caption">Cuerpos</span></a></li>
        @endif
        @if(!is_null(User::find(Auth::id())->roles()->where('id','=',2)->first()))
          <li id="Enteros"><a rel="tooltip" data-placement="right" data-original-title="Dashboard" href="{{ URL::to('pagos'); }}"><i class="fa fa-money"></i> <span class="caption">Enteros</span></a></li>
        @endif  
        @if(!is_null(User::find(Auth::id())->roles()->where('id','=',3)->first()))
          <li id="Condecoraciones"><a rel="tooltip" data-placement="right" data-original-title="UI Features" href="{{ URL::to('condecoraciones'); }}"><i class="fa fa-shield"></i> <span class="caption">Condecoraciones</span></a></li>

          <li id="Eventos"><a rel="tooltip" data-placement="right" data-original-title="Pricing" href="{{ URL::to('eventos'); }}"><i class="fa fa-calendar-o"></i> <span class="caption">Eventos</span></a></li>

          <li id="Ascensos"><a rel="tooltip" data-placement="right" data-original-title="Calendar" href="{{ URL::to('ascensos'); }}"><i class="fa fa-line-chart"></i> <span class="caption">Ascensos</span></a></li>
        @endif
        @if(!is_null(User::find(Auth::id())->roles()->where('id','=',4)->first()))
          <li id="Companias"><a rel="tooltip" data-placement="right" data-original-title="Reports" href="{{ URL::to('companias'); }}"><i class="fa fa-map-marker"></i> <span class="caption">Companias</span></a></li>
          
          <li id="Cargos"><a rel="tooltip" data-placement="right" data-original-title="Faq" href="{{ URL::to('cargos'); }}"><i class="fa fa-magic"></i> <span class="caption">Cargos</span></a></li>
          
          <li id="Arrestos"><a rel="tooltip" data-placement="right" data-original-title="Forms" href="{{ URL::to('arrestos'); }}"><i class="fa fa-gavel"></i> <span class="caption">Arrestos</span></a></li>
          
          <li id="Juras"><a rel="tooltip" data-placement="right" data-original-title="Forms" href="{{ URL::to('jura'); }}"><i class="fa fa-flag"></i> <span class="caption">Juras</span></a></li>
        @endif
        @if(!is_null(User::find(Auth::id())->roles()->where('id','=',8)->first()))
          <li id="Asistencias"><a rel="tooltip" data-placement="right" data-original-title="Blog" href="{{ URL::to('asistencias'); }}"><i class="fa fa-calendar"></i> <span class="caption">Asistencias</span></a></li>
        @endif
        @if(!is_null(User::find(Auth::id())->roles()->where('id','=',4)->first()) || !is_null(User::find(Auth::id())->roles()->where('id','=',6)->first()))
          <li id="Asistencias"><a rel="tooltip" data-placement="right" data-original-title="Blog" href="{{ URL::to('asistencias/reporte'); }}"><i class="fa fa-calendar"></i> <span class="caption">Asistencias</span></a></li>
        @endif
        @if(!is_null(User::find(Auth::id())->roles()->where('id','<',8)->first()))
          <li id="2Altas"><a rel="tooltip" data-placement="right" data-original-title="Blog Entry" href="{{ URL::to('recluta/alta'); }}"><i class="fa fa-plus"></i> <span class="caption">Altas</span></a></li>

          <li id="2Editar"><a rel="tooltip" data-placement="right" data-original-title="Help" href="{{ URL::to('recluta/editar'); }}"><i class="fa fa-pencil"></i> <span class="caption">Editar</span></a></li>

          <li id="2Historial" class=" "><a rel="tooltip" data-placement="right" data-original-title="Icons" href="{{ URL::to('historial'); }}"><i class="fa fa-clock-o"></i> <span class="caption">Historial</span></a></li>
        <li id="Reportes" class=" "><a rel="tooltip" data-placement="right" data-original-title="Icons" href="{{ URL::to('reportes'); }}"><i class="fa fa-bar-chart"></i> <span class="caption">Reportes</span></a></li> 
        @endif

        @if(!is_null(User::find(Auth::id())->roles()->where('id','>',2)->where('id','<',6)->first()))
          <li id="Examenes"><a rel="tooltip" data-placement="right" data-original-title="Media" href="{{ URL::to('examenes'); }}"><i class="fa  fa-file-text-o"></i> <span class="caption">Exámenes</span></a></li>
        @endif
      </ul>
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
