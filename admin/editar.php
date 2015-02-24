<?php 
session_start();
include_once("../modelos/clsUsuario.php");
if (($_SESSION["id"]=="")){ 

header("Location: login.php");

}
if(!isset($_GET['origen'])){
	header("Location: index.php");
}
require_once("top.php"); 
$lang='es';

$usuario= new clsUsuario();
$usuario->estableceCampos($dict);
$user = $usuario->getUsuarioById();

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
			<input type="hidden" name="op" value="editarUsuario">
			<input type="hidden" name="origen" value="<?php echo $_GET['origen']?>">
			<input type="hidden" name="id" value="<?php echo $dict['id']?>">
			<div id="sidebar">
				<div >
					<label for="nombre">Nombre</label>
					<input type="text" name="nombre" id="nombre" value="<?php echo $user['nombre']?>" />
				</div><br>
				<div >
					<label for="apellidos">Apellidos</label>
					<input type="text" name="apellidos" id="apellidos" value="<?php echo $user['apellidos']?>" />
				</div>
				<br>
				<div >
					<label for="nacionalidad">Nacionalidad</label>					
					<select name="nacionalidad" id="nacionalidad">
					<?php 
						$util=new ClsUtil();
						$ar_nacionalidades= $util->getNacionalidades();
						foreach($ar_nacionalidades as $nacionalidad){ ?>
						
							<option value="<?php echo $nacionalidad?>" <?php if($user['nacionalidad']==$nacionalidad){?>selected<?php }?>><?php echo $nacionalidad?></option>
						<?php }	?>
					
						
					</select>
				</div><br>
				<div >
					<label for="fechanacimiento">Fecha Nacimiento</label>
					<input type="text" name="fechanacimiento" id="datepicker" value="<?php echo $user['fechanacimiento']?>" />
				</div><br>
				<div >
					<label for="sexo">Sexo</label>
					<select name="sexo" id="sexo">
						<option value="F" <?php if($user['sexo']=='F'){?>selected<?php }?>>Femenino</option>
						<option value="M" <?php if($user['sexo']=='M'){?>selected<?php }?>>Masculino</option>
					</select>
				</div>
				<br>
				<div>
					<label for="email">Email</label>
					<input type="text" name="email" id="email" value="<?php echo $user['email']?>" />
				</div><br>
				<div >
					<label for="contrasena">Contrase&ntilde;a</label>
					<input type="text" name="contrasena" id="contrasena" value="<?php echo $user['contrasena']?>" />
				</div><br>
				<div >
					<label for="rol">Rol</label>
					<select name="rol">
						<option value="E" <?php if($user['rol']=='E'){?>selected<?php }?>>Estudiante</option>
						<option value="P" <?php if($user['rol']=='P'){?>selected<?php }?>>Profesor</option>
						
					</select>
				</div><br>
				<div >
					<label for="rol">Activo</label>
					<select name="activo">
						<option value="1" <?php if($user['activo']=='1'){?>selected<?php }?>>Si</option>
						<option value="0" <?php if($user['activo']=='0'){?>selected<?php }?>>No</option>
					</select>
				</div><br>
				
				
				<input type="button" value="Modificar" onclick="formulario.submit()" style="margin:15px;">
				
			</div>
		</form>
		
		
	</div>
<?php

require_once("bottom.php"); 

?>