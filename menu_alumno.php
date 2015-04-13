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
		<?php if($puede_examinarse){?>
			<li <?php if((isset($dict['menu']))&&($dict['menu']=='1')){?> class="activo" <?php } ?> onclick="empezar();"><a>Hacer Ex&aacute;men</a></li>
		<?php }?>
		<?php if(isset($_SESSION['empezado'])){?>
			<?php if($_SESSION['empezado']==true){?>
				<li <?php if((isset($dict['menu']))&&($dict['menu']=='1')){?> class="activo" <?php } ?>><a href="examen.php">Hacer Ex&aacute;men</a></li>
			<?php }?>
		<?php }?>
		<li <?php if((isset($dict['menu']))&&($dict['menu']=='2')){?> class="activo" <?php } ?>><a href="">Historial</a></li>
		<li <?php if((isset($dict['menu']))&&($dict['menu']=='3')){?> class="activo" <?php } ?>><a href="modificar_perfil.php">Perfil</a></li>
	
	</ul>

</div>