<?php 
session_start();

if (($_SESSION["id"]=="")){ 

header("Location: login.php");

}
require_once("clases.php"); 

$calificacion= new clsExamenesRealizados();
$media = $calificacion->getMedia();
$notas="";
$sep="";
for ($i=0;$i<10;$i++){
	$nota = $calificacion->getNotaBloque($i,$i+1);
	$notas.=$sep.$nota;
	$sep=",";
}


?>
<script type="text/javascript"  src="js/jquery-1.8.1.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/highcharts-3d.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<style>
#container {
	height: 400px; 
	min-width: 310px; 
	max-width: 800px;
	margin: 0 auto;
}

#highcharts-0 > svg > text:nth-child(19){
	display:none;
}
</style>
<script>

$(function () {
    $('#container_notas').highcharts({
        chart: {
            type: 'column',
            margin: 75,
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: 'Notas obtenidas por los alumnos'
        },
        subtitle: {
            text: 'Media: <?php echo $media?>'
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        xAxis: {
			categories: ['0-1','1-2','2-3','3-4','4-5','5-6','6-7','7-8','8-9','9-10']           
        },
        yAxis: {
            categories: {
                text: null
            }
        },
        series: [{
            name: 'Notas por rangos',
            data: [<?php echo $notas?>]
        }]
    });
});
</script>
<div style="float:right;">
	<form name="exportar" method="post" action="do.php">
		<input type="hidden" name="op" value="exportar_notas">
		<input type="hidden" name="notas" value="<?php echo $notas?>">
		<input type="submit" value="Exportar">
	</form>
</div>
<div id="container_notas" style="width:590px;height: 290px"></div>
