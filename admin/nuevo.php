<?php 
session_start();
include_once("../modelos/clsUsuario.php");
if (($_SESSION["id"]=="")){ 

header("Location: login.php");

}

require_once("top.php"); 
$lang='es';

?>

<script>
$(function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  yearRange: "1970:2015",
	  showAnim: "explode"
		});
	  });
	
</script>

	<div id="central">
		<form name="formulario" method="POST" action="../do.php">
			<input type="hidden" name="op" value="altaUsuario">

			<div id="sidebar">
				<div >
					<label for="nombre">Nombre</label>
					<input type="text" name="nombre" id="nombre" />
				</div><br>
				<div >
					<label for="apellidos">Apellidos</label>
					<input type="text" name="apellidos" id="apellidos" />
				</div>
				<br>
				<div >
					<label for="nacionalidad">Nacionalidad</label>					
					<select name="nacionalidad" id="nacionalidad">
					<?php 
						$util=new ClsUtil();
						$ar_nacionalidades= $util->getNacionalidades();
						foreach($ar_nacionalidades as $nacionalidad){ ?>
						
							<option value="<?php echo $nacionalidad?>" ><?php echo $nacionalidad?></option>
						<?php }	?>
					
						
					</select>
				</div><br>
				<div >
					<label for="fechanacimiento">Fecha Nacimiento</label>
					<input type="text" name="fechanacimiento" id="datepicker"  />
				</div><br>
				<div >
					<label for="sexo">Sexo</label>
					<select name="sexo" id="sexo">
						<option value="F" >Femenino</option>
						<option value="M" >Masculino</option>
					</select>
				</div>
				<br>
				<div>
					<label for="email">Email</label>
					<input type="text" name="email" id="email"  />
				</div><br>
				<div >
					<label for="contrasena">Contrase&ntilde;a</label>
					<input type="text" name="contrasena" id="contrasena" />
				</div><br>
				<div >
					<label for="rol">Rol</label>
					<select name="rol">
						<option value="E" >Estudiante</option>
						<option value="P" >Profesor</option>
						
					</select>
				</div><br>
				<div >
					<label for="rol">Activo</label>
					<select name="activo">
						<option value="1" >Si</option>
						<option value="0" >No</option>
					</select>
				</div><br>
				
				
				<input type="button" value="Insertar" onclick="formulario.submit()" style="margin:15px;">
				
			</div>
		</form>
		
		
	</div>
<?php

require_once("bottom.php"); 

?>