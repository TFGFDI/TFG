<div id="bloqueMenu"> 

	<ul>
	<!-- <a href="index.php?menu=0" >	<li <?php if((isset($dict['menu']))&&($dict['menu']=='0')){?> class="activo" <?php } ?>>Inicio</li></a> -->
		<li <?php if((isset($dict['menu']))&&($dict['menu']=='0')){?> class="activo" <?php } ?>><a href="index.php?menu=0" >Inicio</a></li>
		<li <?php if((isset($dict['menu']))&&($dict['menu']=='1')){?> class="activo" <?php } ?>><a href="alumnos.php?menu=1" >Alumnos</a></li>
		<li <?php if((isset($dict['menu']))&&($dict['menu']=='2')){?> class="activo" <?php } ?>><a href="ls_examenes_profesor.php?menu=2">Ex&aacute;menes</a></li>
		<li <?php if((isset($dict['menu']))&&($dict['menu']=='3')){?> class="activo" <?php } ?>><a href="ls_examenes_pendientes.php?menu=3">Ex&aacute;menes Pendientes</a></li>
		<li <?php if((isset($dict['menu']))&&($dict['menu']=='4')){?> class="activo" <?php } ?>><a href="estadisticas.php?menu=4">Estad&iacute;sticas</a></li>
		<li <?php if((isset($dict['menu']))&&($dict['menu']=='5')){?> class="activo" <?php } ?>><a href="historial_examenes.php?menu=5">Historial</a></li>
		<li <?php if((isset($dict['menu']))&&($dict['menu']=='6')){?> class="activo" <?php } ?>><a href="modificar_perfil.php?menu=6">Perfil</a></li>
	</ul>

</div>
