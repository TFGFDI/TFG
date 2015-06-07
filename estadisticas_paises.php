<?php 
session_start();

if (($_SESSION["id"]=="")){ 

header("Location: login.php");

}
require_once("clases.php"); 

$alumnos= new clsUsuario();

$json=$alumnos->getNacionalidadJSON();
$file=fopen("nacionalidades.json","w");
fwrite($file,$json);

?>
<script type="text/javascript"  src="js/jquery-1.8.1.min.js"></script>
<script src="http://code.highcharts.com/maps/highmaps.js"></script>
<script src="http://code.highcharts.com/maps/modules/data.js"></script>
<script src="http://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="http://code.highcharts.com/mapdata/custom/world.js"></script>


<link rel="stylesheet" type="text/css" href="http://cloud.github.com/downloads/lafeber/world-flags-sprite/flags32.css" />
<style>
.highcharts-tooltip>span {
	padding: 10px;
	white-space: normal !important;
	width: 200px;
}

.loading {
	margin-top: 10em;
	text-align: center;
	color: gray;
}

.f32 .flag {
	vertical-align: middle !important;
}
#highcharts-0 > svg > text:nth-child(17){
	display:none;
}

</style>
<script>

$(function () {

    $.getJSON("nacionalidades.json", function (data) {

        // Add lower case codes to the data set for inclusion in the tooltip.pointFormat
        $.each(data, function () {
            this.flag = this.code.replace('UK', 'GB').toLowerCase();
        });

        // Initiate the chart
        $('#container_paises').highcharts('Map', {

            title: {
                text: 'Alumnos por pa\u00EDses'
            },

            legend: {
                title: {
                    text: 'Alumnos por pa\u00EDs',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
                    }
                }
            },

            mapNavigation: {
                enabled: true,
                buttonOptions: {
                    verticalAlign: 'bottom'
                }
            },

            tooltip: {
                backgroundColor: 'none',
                borderWidth: 0,
                shadow: false,
                useHTML: true,
                padding: 0,
                pointFormat: '<span class="f32"><span class="flag {point.flag}"></span></span>'
                    + ' {point.name}: <b>{point.value}</b>',
                positioner: function () {
                    return { x: 0, y: 250 };
                }
            },

            colorAxis: {
                min: 1,
                max: 1000,
                type: 'logarithmic'
            },

            series : [{
                data : data,
                mapData: Highcharts.maps['custom/world'],
                joinBy: ['iso-a2', 'code'],
                name: 'N\u00famero de alumnos',
                states: {
                    hover: {
                        color: '#BADA55'
                    }
                }
            }]
        });
    });
});
</script>
<div style="float:right;margin:-5px 40px -6px 0;">
	<form name="exportar" method="post" action="do.php">
		<input type="hidden" name="op" value="exportar_paises">
		<input type="submit" value="Exportar">
	</form>
</div>
<div id="container_paises" style="width:890px;height: 380px"></div>
