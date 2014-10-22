@extends('layaouts.buscar')

@section('titulo')
  pruebas PDMU
@endsection
@section('contenidoo')
    <h1>Hola que Hace?</h1>
    <a href="#" Onclick="asds()">email me</a>
    <form action="asd_submit" method="get" accept-charset="utf-8">
        <input type="text" name="id" value="" placeholder="id">
        <input type="text" name="asd" value="" placeholder="asda">
    </form> 
@endsection
@section('scriptss')
    <script type="text/javascript">
    function asds(){
        console.log($('#telemento tbody tr td:nth-child(1)').text());
        $('[name = id]').val($('#telemento tbody tr td:nth-child(1)').text());
    }
        $('#main-menu').find('li').removeClass('active');
        $('#main-menu ul li:nth-child(3)').addClass('active');
    </script>
@endsection