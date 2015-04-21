@extends('layaouts.base')
@section('titulo')
  Inicio
@endsection
@section('head')
  <style>
    .blockquote-reverse {
    font-size: 12.5px;
    border-right: 3px solid #000;
  }
  </style>
  {{  HTML::script('js/moment.js'); }}
  {{  HTML::script('js/clock.js'); }}
  {{  HTML::style('css/clock.css');  }}
@endsection
@section('contenido')
  <div id="clock" class="dark">
    <div class="display">
      <div class="weekdays"></div>
      <div class="ampm"></div>
      <div class="alarm"></div>
      <div class="digits"></div>
    </div>
  </div>
  <div>
    <blockquote class="blockquote-reverse">
      <p id="palabrasyvidasFrase"></p>
      <footer style="padding-top:0px;">
        <p id="palabrasyvidasAutor"></p><cite title="Source Title"><p id="palabrasyvidasComentario"></p></cite>
        <p id="palabrasyvidasContEnlace">
          <a href="http://palabrasyvidas.com/frases-celebres.html" id="palabrasyvidasEnlace" title="Frases célebres" target="_blank"></a>
        </p>
      </footer>
    </blockquote>
  </div>
  <script type="text/javascript" src="http://palabrasyvidas.com/frase-al-azar.html"></script>
@stop
@section('scripts')
@endsection