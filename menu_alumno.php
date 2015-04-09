<div id="bloqueMenu"> 

	<ul>
	<!-- <a href="index.php?menu=0" >	<li <?php if((isset($dict['menu']))&&($dict['menu']=='0')){?> class="activo" <?php } ?>>Inicio</li></a> -->
		<li <?php if((isset($dict['menu']))&&($dict['menu']=='1')){?> class="activo" <?php } ?>><a href="examen.php" >Hacer Ex&aacute;men</a></li>
		<li <?php if((isset($dict['menu']))&&($dict['menu']=='2')){?> class="activo" <?php } ?>><a href="">Historial</a></li>
		<li <?php if((isset($dict['menu']))&&($dict['menu']=='3')){?> class="activo" <?php } ?>><a href="modificar_perfil.php">Perfil</a></li>
	
	</ul>

</div>