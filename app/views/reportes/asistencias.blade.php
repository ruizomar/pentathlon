@extends('layaouts.base')

@section('titulo')
  Reporte |Asistencias | PDMU
@endsection
@section('contenido')
    <div class="row" style='padding-top:10px;'>
        <div class="col-md-2">
        @foreach ($companias as $compania)
                <div class="col-md-12" style='margin-bottom: 15px;'>
                    @if($compania->estatus == 'Activa')
                        <button type="button" id='{{ $compania->id }}' onclick="grafica(this)" class="btn btn-info btn-block ">{{ $compania->tipo.' '.$compania->nombre }}</button>
                        
                    @else 
                        <button type="button" id='{{ $compania->id }}' class="btn btn-info  btn-block " disabled='disabled'>{{ $compania->tipo.' '.$compania->nombre }}</button>
                    @endif      
                </div>
        @endforeach
        </div>
        <div class="col-md-8">
        <div class="chart-wrapper">
            <div id="chart">
            </div>
        </div>
        </div>
    </div>
    
@endsection
@section('scripts')
<link href="/css/kendo.common.min.css" rel="stylesheet" />
    <script src="/js/kendo.all.min.js"></script>
<script type="text/javascript">
function createChart(p,f,n){
    $("#chart").kendoChart({
        title:{
            text:n},
            theme:"flat",
            legend:{
                position:"bottom"},
                seriesDefaults:{
                    type:"line"},
                    series:p,
                    valueAxis:{
                        labels:{
                            format:"{0}"
                        }
                    },
                    categoryAxis:{
                        categories:f}}
                        )}
function grafica(btn){
    var id = btn.id;
    var series=[];
    var categories=[];
    var fech;
    var datos=[];
    $.post('compania','id='+id, function(json) {
        for (var i = json[0].length-1; i >= 0; i--) {
            fech = json[0][i].fecha;
            categories.push(fech);
            datos.push(json[1][i]);
        };
        series.push({data:datos});
        createChart(series,categories,$(btn).text());
    }, 'json');
    
}            
</script>
@endsection