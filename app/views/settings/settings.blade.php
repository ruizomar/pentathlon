@extends('layaouts.base')

@section('titulo')
  Ajustes
@endsection
@section('head')
{{  HTML::style('css/login.css')  }}
{{  HTML::style('css/bootstrap-datetimepicker.min.css');  }}
{{  HTML::style('css/sweet-alert.css');  }}
<style type="text/css">
.login-form {
  margin: 0 auto 4% auto;
}
</style>
@endsection
@section('contenido')
<div class="main">
      <div class="text-center col-sm-6 col-sm-offset-3">
        <h2 style="font-size: 30px;font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif"><i class="fa fa-cogs "></i> Ajustes</h2>
          {{ Form::open(array('url' => 'settings/update','role' => 'form','id' => 'update','class' => 'form-horizontal')) }}
          <div class="form-group">
              <label class="col-sm-2 control-label"><strong>Correo: </strong></label>
              <div class="col-sm-10">
                @if(Elemento::find(Auth::user()->elemento_id)->persona->email)
                <input type="text" name="email" value="{{ Elemento::find(Auth::user()->elemento_id)->persona->email->email}}" class="text">
                @else
                <input type="text" name="email" value="" class="text">
                @endif
              </div>  
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label"><strong>Password: </strong></label>
              <div class="col-sm-10">
                <input type="password" class="text" onblur="if (this.value == '') {this.value = '';}" name="password" autocomplete="off">
                </div>  
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label"><strong>Password: </strong></label>
              <div class="col-sm-10">
              <input type="password" class="text" onblur="if (this.value == '') {this.value = '';}" name="password_confirmation" autocomplete="off">
              </div>  
          </div>
              <?php $status=Session::get('mensaje_error'); ?> 
              @if (!is_null($status))
                <p style='color:#FB1D1D' >{{$status}}</p>
              @endif
              <div class="submit">
                <input type="submit" value="Guardar" >
            </div>
          {{ Form::close() }}
        </div>
      </div>
@endsection
@section('scripts')
  {{  HTML::script('js/bootstrapValidator.js'); }}
  {{  HTML::script('js/es_ES.js'); }}
  {{  HTML::script('js/moment.js'); }}
  {{  HTML::script('js/bootstrap-datetimepicker.js'); }}
  {{  HTML::script('js/bootstrap-datetimepicker.es.js'); }}
  {{  HTML::script('js/sweet-alert.min.js'); }}
  <script type="text/javascript">
    $('#update').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            enabled: false,
            email: {
                validators: {
                    notEmpty: {
                    },
                    emailAddress: {},
                }
            },
            enabled: false,
            password: {
                validators: {
                    stringLength: {
                      min: 7,
                      max:10,
                  }
                }
            },
            enabled: false,
            password_confirmation: {
                validators: {
                  identical: {
                    field: 'password'
                  }
                }
            },
        }
    })
  </script>
@endsection