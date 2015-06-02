<div id="bloqueMenu"> 

<script>
	function empezar(){
		window.location="do.php?op=empezar_examen";
	}
</script>
<?php 
$examen = new ClsExamenes();
$realizado = new ClsExamenesRealizados();
$activo = $examen->getExamenActivo();
$usuario = $_SESSION['id'];
if($activo==NULL){
	$puede_examinarse = false;
}else{
	$puede_examinarse = $realizado->puedeExaminarse($activo,$usuario);
}
?>
	<ul>
		<li <?php if((isset($dict['menu']))&&($dict['menu']=='0')){?> class="activo" <?php } ?>><a href="alumno.php?menu=0" ><?php echo $util->trad("inicio",$lang);?></a></li>
		<?php if($puede_examinarse){?>
			<li <?php if((isset($dict['menu']))&&($dict['menu']=='1')){?> class="activo" <?php } ?> onclick="empezar();"><a><?php echo $util->trad("examen",$lang);?></a></li>
		<?php }?>
		<?php if(isset($_SESSION['empezado'])){?>
			<?php if($_SESSION['empezado']==true){?>
				<li <?php if((isset($dict['menu']))&&($dict['menu']=='1')){?> class="activo" <?php } ?>><a href="examen.php">Hacer Ex&aacute;men</a></li>
			<?php }?>
		<?php }?>
		<li <?php if((isset($dict['menu']))&&($dict['menu']=='2')){?> class="activo" <?php } ?>><a href="historial_alumnos.php?menu=2"><?php echo $util->trad("historial_alumno",$lang);?></a></li>
	
	
	</ul>

</div>