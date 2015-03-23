<div id="bloqueMenu"> 

	<ul>
	<!-- <a href="index.php?menu=0" >	<li <?php if((isset($dict['menu']))&&($dict['menu']=='0')){?> class="activo" <?php } ?>>Inicio</li></a> -->
		<li <?php if((isset($dict['menu']))&&($dict['menu']=='0')){?> class="activo" <?php } ?>><a href="index.php?menu=0" >Inicio</a></li>
		<li <?php if((isset($dict['menu']))&&($dict['menu']=='1')){?> class="activo" <?php } ?>><a href="alumnos.php?menu=1" >Alumnos</a></li>
		<li <?php if((isset($dict['menu']))&&($dict['menu']=='2')){?> class="activo" <?php } ?>><a href="profesores.php?menu=2">Profesores</a></li>
		<li <?php if((isset($dict['menu']))&&($dict['menu']=='3')){?> class="activo" <?php } ?>><a href="examenes.php?menu=3">Ex&aacute;menes</a></li>
		<li><a href="#">Estad&iacute;sticas</a></li>
	</ul>

</div>
