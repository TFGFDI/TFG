<?php 
session_start();

if (($_SESSION["id"]=="")){ 

header("Location: login.php");

}
require_once("clases.php"); 

$alumnos= new clsUsuario();
$masculino = $alumnos->getCountSexo('M');
$femenino = $alumnos->getCountSexo('F');

?>
<script type="text/javascript"  src="js/jquery-1.8.1.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/highcharts-3d.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<style>
#highcharts-0 > svg > text:nth-child(10){
	display:none;
}
</style>
<script>
$(function () {
    $('#container_sexo').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Sexo:'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: [
                ['Masculino',   <?php echo $masculino?>],
                ['Femenino',      <?php echo $femenino?>]
            ]
        }]
    });
});

</script>

<div id="container_sexo" style="height: 200px"></div>