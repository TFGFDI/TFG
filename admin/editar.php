<?php 
session_start();
include_once("../clases.php");
if (($_SESSION["id"]=="")){ 

header("Location: login.php");

}
if(!isset($_GET['origen'])){
	header("Location: index.php");
}
require_once("top.php"); 
$lang='es';

if(($dict['origen'])){
	$examen= new clsExamenes();
	$examen->estableceCampos($dict);
	$exam = $examen->getExamenesById();
}else{
	$usuario= new clsUsuario();
	$usuario->estableceCampos($dict);
	$user = $usuario->getUsuarioById();
}
?>

<script>

$(document).ready(function() {
	ocultar();
});


	function ocultar(){
		var e = $('#estado').val();
		if (e==0){
			$('#activado').hide();
			$('#activo').val('0');
		}else{
			$('#activado').show();
		}
	}
</script>

	<div id="central">
	
		<?php if(($dict['origen']=="examenes")){ ?>
			<form name="formularioExamn" method="POST" action="../do.php">
			<input type="hidden" name="op" value="editarExamen">			
			<input type="hidden" name="id" value="<?php echo $dict['id']?>">
			<div id="sidebar">
				<div>
					<?php 
						$profesores = new ClsUsuario();
						$ar_profesores = $profesores->getProfesores("","1","","","");
					?>
					
					<label for="nombre">Profesor</label>
						<select name="profesor">
							<?php while ($rowEmp = mysqli_fetch_assoc($ar_profesores)) { ?>
									<option value="<?php echo $rowEmp["id"]?>_<?php echo $rowEmp["nombre"]?> <?php echo $rowEmp["apellidos"]?>" <?php if($rowEmp['id']==$exam['id_profesor']){?>selected<?php }?>><?php echo $rowEmp["nombre"]?> <?php echo $rowEmp["apellidos"]?></option>
							<?php }?>
						</select>
				</div><br>
				<div >
					<label for="nombre">Fecha</label>
					<input type="text" name="fecha" id="fecha" value="<?php echo $exam['fecha']?>" />
				</div><br>
				<div >
					<label for="nombre">Curso</label>
					<input type="text" name="curso" id="curso" value="<?php echo $exam['curso']?>" />
				</div><br>
				<div >
					<label for="nombre">Tipo</label>
					<select name="tipo">
						<option value="Intensivo" <?php if($exam['tipo']=="Intensivo"){?>selected<?php }?>>Intensivo</option>
						<option value="Anual" <?php if($exam['tipo']=="Anual"){?>selected<?php }?>>Anual</option>
						<option value="Semestral" <?php if($exam['tipo']=="Semestral"){?>selected<?php }?>>Semestral</option>
					</select>
				</div><br>
				<div >
					<label for="nombre">Estado</label>
					<select name="estado" onchange="ocultar()" id="estado">
						<option value="1" <?php if($exam['estado']=="1"){?>selected<?php }?>>P&uacute;blico</option>
						<option value="0" <?php if($exam['estado']=="0"){?>selected<?php }?>>Privado</option>						
					</select>
				</div><br>
				<div >
					<label for="nombre">Tiempo</label>
					<input type="text" name="tiempo" id="tiempo" value="<?php echo $exam['tiempo']?>" style="width:10%"/> min
				</div><br>
				<div id="activado">
					<label for="nombre">Activo</label>
					<select name="activo" id="activo">
						<option value="1" <?php if($exam['activo']=="1"){?>selected<?php }?>>Activado</option>
						<option value="0" <?php if($exam['activo']=="0"){?>selected<?php }?>>Desactivado</option>
						
					</select>
				</div><br>
				<input type="button" value="Modificar" onclick="formularioExamn.submit()" style="margin:15px;">
				<input type="button" value="Volver" onclick="history.back();" style="margin:15px;">
			</div>
			
			</form>
		<?php }else{?>
	
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
		<?php }?>
		
	</div>
<?php

require_once("bottom.php"); 

?>